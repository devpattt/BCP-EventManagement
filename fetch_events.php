// fetch_events.php
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bcpevent_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch events with 'Approved' status
$sql = "SELECT event_title, event_date, time FROM event_db WHERE status = 'Approved'";
$result = $conn->query($sql);

$events = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // You can push events into an array or directly return them in your desired format
        $events[] = array(
            'title' => $row['event_title'],
            'date' => $row['event_date'],
            'time' => $row['time'],
        );
    }
} else {
    echo "No approved events yet.";
}

$conn->close();
?>
