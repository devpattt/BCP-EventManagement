<?php
header('Content-Type: application/json'); // Set the response content type to JSON


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bcpevent_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $conn->connect_error]);
    exit();
}

// Assuming these are coming from a booking form
$event_title = $_POST['event_title'];
$event_date = $_POST['event_date'];
$time = $_POST['time'];
$name = $_POST['name'];
$contact = $_POST['contact'];

// Set the event status to 'Pending' by default
$stmt = $conn->prepare("INSERT INTO event_db (name, contact, event_title, time, event_date, status) VALUES (?, ?, ?, ?, ?, 'Pending')");
$stmt->bind_param("sssss", $name, $contact, $event_title, $event_date, $time); // Bind parameters

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'New booking created successfully.']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error: ' . $stmt->error]);
}

$stmt->close();
$conn->close();

