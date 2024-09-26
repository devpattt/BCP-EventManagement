<?php
// Include the database connection
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect the POST data from the form
    $name = $_POST['name'] ?? null;
    $address = $_POST['address'] ?? null;
    $phone = $_POST['phone'] ?? null;
    $email = $_POST['email'] ?? null;
    $reservation_date = $_POST['reservation_date'] ?? null;
    $reservation_time = $_POST['reservation_time'] ?? null;
    $no_of_people = $_POST['no_of_people'] ?? null;

    // Check if any field is missing
    if (empty($name) || empty($address) || empty($phone) || empty($email) || empty($reservation_date) || empty($reservation_time) || empty($no_of_people)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required']);
        exit;
    }

    try {
        // Prepare the SQL statement
        $stmt = $pdo->prepare('INSERT INTO events (name, address, phone, email, reservation_date, reservation_time, no_of_people) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([$name, $address, $phone, $email, $reservation_date, $reservation_time, $no_of_people]);

        // Return success response
        echo json_encode(['status' => 'success', 'message' => 'Event booked successfully']);
    } catch (Exception $e) {
        // If there is an error, return a failure response
        echo json_encode(['status' => 'error', 'message' => 'Failed to book event: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
