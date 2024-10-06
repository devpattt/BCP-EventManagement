<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bcp_sms3_ems";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $conn->connect_error]));
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


$role = isset($_POST['role']) ? $_POST['role'] : '';
if (empty($role)) {
    die(json_encode(['status' => 'error', 'message' => 'Role is required.']));
}


$status = 'pending'; 

$attendees = isset($_POST['attendees']) && is_numeric($_POST['attendees']) ? $_POST['attendees'] : 0;


// Prepare and bind
$stmt = $conn->prepare("INSERT INTO bcp_sms3_booking (role, name, contact, event_title, attendees, date_booked, time, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $role, $name, $contact, $event_title, $attendees, $date_booked, $time, $status);

// Execute the statement and check for success
if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Event booked successfully!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error: ' . $stmt->error]);
}


// Close the statement and connection
$stmt->close();
$conn->close();
exit();
?>
