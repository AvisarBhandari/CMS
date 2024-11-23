<?php
include '../db_connect.php'; 

// Fetch current year
$current_year = date("Y");

// Fetch records for the current year and order by month
$query = "SELECT * FROM monthlyfinance WHERE year = ? ORDER BY FIELD(month, 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December')";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $current_year);
$stmt->execute();
$result = $stmt->get_result();

$finance_data = [];
while ($row = $result->fetch_assoc()) {
    $finance_data[] = $row;
}

if (count($finance_data) > 0) {
    echo json_encode(["status" => "success", "data" => $finance_data]);
} else {
    echo json_encode(["status" => "error", "message" => "No finance records found for the current year."]);
}

$stmt->close();
$conn->close();

