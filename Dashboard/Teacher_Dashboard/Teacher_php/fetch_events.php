<?php
include 'db_connect.php';
$sql = "SELECT event_date, event_name, event_time FROM events WHERE event_date >= CURDATE() ORDER BY event_date ASC LIMIT 5";
$result = $conn->query($sql);
$events = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
}
$conn->close();
echo json_encode($events);

