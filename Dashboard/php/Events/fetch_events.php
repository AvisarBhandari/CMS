<?php
include '../db_connect.php'; 

$query = "SELECT * FROM events ORDER BY event_date, event_time";
$result = $conn->query($query);

$events = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $row['event_time'] = date("g:i A", strtotime($row['event_time']));
        $events[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($events);

$conn->close();
