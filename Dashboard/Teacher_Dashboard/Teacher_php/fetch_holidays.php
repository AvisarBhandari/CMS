<?php
include 'db_connect.php';
$sql = "SELECT holiday_date, reason FROM holidays ORDER BY holiday_date ASC";
$result = $conn->query($sql);
$holidays = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $holidays[] = [
            'holiday_date' => $row['holiday_date'],
            'reason' => $row['reason']
        ];
    }
}
$conn->close();
echo json_encode($holidays);

