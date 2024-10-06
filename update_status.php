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
    // Get the event ID and the new status from the form
    $event_id = intval($_POST['event_id']);
    $new_status = $_POST['status'];

    // Update the status in the database
    $stmt = $conn->prepare("UPDATE bcp_sms3_booking SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $new_status, $event_id);

    if ($stmt->execute()) {
        // Redirect back to the event bookings page or give a success message
        header("Location: tables-data.php?status=success");
        exit();
    } else {
        // Handle failure to update status
        echo "Error updating status: " . $conn->error;
    }
    
    $stmt->close();
}

$conn->close();
// After updating the status in update_status.php
header("Location: event_bookings.php?status=success");
