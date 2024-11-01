<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "bcp_sms3_ems"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_id = intval($_POST['event_id']);
    $new_status = $_POST['status'];

    // Update the status in the main bookings table
    $stmt = $conn->prepare("UPDATE bcp_sms3_booking SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $new_status, $event_id);

    if ($stmt->execute()) {
        // If the status is Cancelled or Approved, move it to the history table
        if ($new_status == 'Cancelled' || $new_status == 'Approved') {
            // Get the current event data
            $event_sql = "SELECT * FROM bcp_sms3_booking WHERE id = ?";
            $event_stmt = $conn->prepare($event_sql);
            $event_stmt->bind_param("i", $event_id);
            $event_stmt->execute();
            $event_result = $event_stmt->get_result();

            if ($event_result->num_rows > 0) {
                $event_data = $event_result->fetch_assoc();

                // Insert the event into the history table
                $history_stmt = $conn->prepare("INSERT INTO bcp_sms3_event_history (name, contact, event_title, attendees, date_booked, time, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $history_stmt->bind_param("sssiiss", $event_data['name'], $event_data['contact'], $event_data['event_title'], $event_data['attendees'], $event_data['date_booked'], $event_data['time'], $new_status);
                $history_stmt->execute();

                // Delete the event from the main bookings table
                $delete_stmt = $conn->prepare("DELETE FROM bcp_sms3_booking WHERE id = ?");
                $delete_stmt->bind_param("i", $event_id);
                $delete_stmt->execute();
            }
        }
        header("Location: tables-data.php?status=success");
    } else {
        echo "Error updating status: " . $conn->error;
    }

    $stmt->close();
}


$conn->close();
// After updating the status in update_status.php
header("Location: tables-data.php?status=success");
