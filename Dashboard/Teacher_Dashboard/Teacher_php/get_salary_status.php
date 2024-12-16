<?php
session_start();
include 'db_connect.php';
header('Content-Type: application/json');


if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit();
}

$faculty_id = $_SESSION['id'];


$current_month = date('m');
$current_year = date('Y');


$query = "SELECT salary_amount, status FROM salarytransactions WHERE faculty_id = ? AND MONTH(month_year) = ? AND YEAR(month_year) = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("sii", $faculty_id, $current_month, $current_year);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $salary = $row['salary_amount'];
    $payment_status = $row['status'];

    
    echo json_encode(['success' => true, 'salary' => $salary, 'payment_status' => $payment_status]);
} else {
    echo json_encode(['success' => false, 'message' => 'No data found for this month']);
}

