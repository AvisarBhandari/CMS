<?php
include('../db_connect.php');

$response = [];
$query = "SELECT holiday_id, holiday_date, reason FROM holidays ORDER BY holiday_date ASC";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $response[] = $row;
    }
}
echo json_encode($response);

