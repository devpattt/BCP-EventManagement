<?php
include('connection.php'); 

try {
    $today = date('Y-m-d');
    $currentMonth = date('Y-m');
    $currentYear = date('Y');

    // Fetch today's event
    $sqlToday = "SELECT event_title, attendees FROM bcp_sms3_booking WHERE date_booked = :today";
    $stmtToday = $conn->prepare($sqlToday);
    $stmtToday->execute(['today' => $today]);
    $todayEvent = $stmtToday->fetch(PDO::FETCH_ASSOC);

    // Fetch monthly data
    $sqlMonth = "SELECT COUNT(*) AS event_count, SUM(attendees) AS total_attendees FROM bcp_sms3_booking WHERE date_booked LIKE :currentMonth";
    $stmtMonth = $conn->prepare($sqlMonth);
    $stmtMonth->execute(['currentMonth' => "$currentMonth%"]);
    $monthData = $stmtMonth->fetch(PDO::FETCH_ASSOC);

    // Fetch yearly data
    $sqlYear = "SELECT COUNT(*) AS event_count, SUM(attendees) AS total_attendees FROM bcp_sms3_booking WHERE date_booked LIKE :currentYear";
    $stmtYear = $conn->prepare($sqlYear);
    $stmtYear->execute(['currentYear' => "$currentYear%"]);
    $yearData = $stmtYear->fetch(PDO::FETCH_ASSOC);

    // Prepare response
    $response = [
        'todayEvent' => $todayEvent ?: ['event_title' => 'No events today', 'attendees' => 0],
        'monthData' => $monthData ?: ['event_count' => 0, 'total_attendees' => 0],
        'yearData' => $yearData ?: ['event_count' => 0, 'total_attendees' => 0],
    ];

    header('Content-Type: application/json');
    echo json_encode($response);

} catch (PDOException $e) {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
?>
