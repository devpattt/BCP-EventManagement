<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bcpevent_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$contact = $_POST['contact'];
$event_title = $_POST['event_title'];

// Validate date_booked
$date_booked = $_POST['date_booked'];
if (!DateTime::createFromFormat('Y-m-d', $date_booked)) {
    die(json_encode(['status' => 'error', 'message' => 'Invalid date format. Expected format: YYYY-MM-DD.']));
}

if (isset($_POST['time'])) {
    $time = $_POST['time'] . ':00'; // Append seconds
    // Validate time format
    if (!preg_match('/^([01]\d|2[0-3]):([0-5]\d):([0-5]\d)$/', $time)) {
        die(json_encode(['status' => 'error', 'message' => 'Invalid time format. Expected format: HH:MM:SS.']));
    }
} else {
    die(json_encode(['status' => 'error', 'message' => 'Time is required.']));
}


$status = 'pending'; 

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO event_db (name, contact, event_title, date_booked, time, status) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $name, $contact, $event_title, $date_booked, $time, $status);

// Execute the statement and check for success
if ($stmt->execute()) {
    echo json_encode(['Event booked successfully!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error: ' . $stmt->error]);
}

// Close the statement and connection
$stmt->close();
$conn->close();
exit();
?>
