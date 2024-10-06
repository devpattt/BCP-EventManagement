<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bcp_sms3_ems";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Fetch events with 'Approved' status
$sql = "SELECT event_title, event_date, time FROM bcp_sms3_booking WHERE status = 'Approved'";
$result = $conn->query($sql);

$events = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $events[] = array(
            'title' => $row['event_title'],
            'date' => $row['event_date'],
            'time' => $row['time'],
        );
    }
} else {
    $events[] = ["message" => "No approved events yet."];
}

echo json_encode($events);
$conn->close();
?>
