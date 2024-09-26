<?php
include 'connection.php';
$pdo = new PDO('mysql:host=localhost;dbname=event_management', 'root', '');

$stmt = $pdo->prepare('SELECT id, title, start_date, end_date FROM events');
$stmt->execute();

$events = [];

while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $events[] = [
        'id' => $row['id'],
        'title' => $row['title'],
        'start' => $row['start_date'],
        'end' => $row['end_date']
    ];
}

header('Content-Type: application/json');
echo json_encode($events);
?>

