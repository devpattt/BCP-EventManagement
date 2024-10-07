<?php
// fetch_events.php

// Database connection
$connection = new mysqli("localhost", "root", "", "bcp_sms3_ems");

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Query to fetch only approved events from your event table
$sql = "SELECT id, event_title AS title, date_booked AS start FROM bcp_sms3_booking WHERE status = 'approved'";
$result = $connection->query($sql);

$events = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Push each approved event into the $events array
        $events[] = $row;
    }
}

// Return the approved events in JSON format
echo json_encode($events);

$connection->close();
?>
