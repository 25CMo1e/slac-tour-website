<?php
require_once __DIR__ . '/../php/auth/db.php';
header('Content-Type: application/json');

$room_id = (int)$_GET['room_id'];
$start = isset($_GET['start']) ? $conn->real_escape_string($_GET['start']) : date('Y-m-01');
$end = isset($_GET['end']) ? $conn->real_escape_string($_GET['end']) : date('Y-m-t');

$result = $conn->query("SELECT 
    id, 
    title, 
    start_time as start, 
    end_time as end,
    '#3a87ad' as color
FROM reservations
WHERE room_id = $room_id
AND status = 'active'
AND start_time >= '$start'
AND end_time <= '$end'");

$events = [];
while ($row = $result->fetch_assoc()) {
    $events[] = $row;
}

echo json_encode($events);
?>
