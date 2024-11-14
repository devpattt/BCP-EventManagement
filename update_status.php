<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "bcp_sms3_ems"; 

// Establish database connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_id = intval($_POST['event_id']);
    $new_status = $_POST['status'];

    // Set date_booked to current date when approving
    $current_date = date("Y-m-d");  // Get the current date in Y-m-d format

    // Debugging: Ensure the current date is correctly set
    echo "Current Date: $current_date";  

    // Prepare the update query to set status and date_booked
    $stmt = $conn->prepare("UPDATE bcp_sms3_booking SET status = ?, date_booked = ? WHERE id = ?");
    $stmt->bind_param("ssi", $new_status, $current_date, $event_id);

    // Execute the update query
    if ($stmt->execute()) {
        // Only proceed with history insert and deletion if status is 'Cancelled' or 'Approved'
        if ($new_status == 'Cancelled' || $new_status == 'Approved') {
            // Fetch the event data for insertion into history
            $event_sql = "SELECT * FROM bcp_sms3_booking WHERE id = ?";
            $event_stmt = $conn->prepare($event_sql);
            $event_stmt->bind_param("i", $event_id);
            $event_stmt->execute();
            $event_result = $event_stmt->get_result();

            if ($event_result->num_rows > 0) {
                $event_data = $event_result->fetch_assoc();

                // Debugging: Check if the event data is correctly fetched
                echo "<pre>";
                print_r($event_data);
                echo "</pre>";

                // Check if event data exists
                if (!empty($event_data['date_booked'])) {
                    // Insert into event history
                    $history_stmt = $conn->prepare("INSERT INTO bcp_sms3_event_history (name, contact, event_title, attendees, date_booked, time, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
                    $history_stmt->bind_param("sssisss", $event_data['name'], $event_data['contact'], $event_data['event_title'], $event_data['attendees'], $event_data['date_booked'], $event_data['time'], $new_status);

                    // Execute the insert query for history
                    if ($history_stmt->execute()) {
                        // If insertion is successful, delete the booking record
                        $delete_stmt = $conn->prepare("DELETE FROM bcp_sms3_booking WHERE id = ?");
                        $delete_stmt->bind_param("i", $event_id);
                        $delete_stmt->execute();
                        $delete_stmt->close();
                    } else {
                        echo "Error inserting into history: " . $history_stmt->error;
                    }
                    $history_stmt->close();
                } else {
                    echo "Error: Missing or empty event data.";
                }
            } else {
                echo "Error: Event not found.";
            }
            $event_stmt->close();
        }

        // Redirect or send success message on successful update
        header("Location: tables-data.php?status=success");
        exit();
    } else {
        echo "Error updating status: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
