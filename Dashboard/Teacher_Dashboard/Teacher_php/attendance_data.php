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


$query = "SELECT 
            SUM(CASE WHEN status = 'Present' THEN 1 ELSE 0 END) AS present_count,
            SUM(CASE WHEN status = 'Absent' THEN 1 ELSE 0 END) AS absent_count
          FROM faculty_attendances
          WHERE faculty_id = ? AND YEAR(attendance_date) = ? AND MONTH(attendance_date) = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param('sss', $faculty_id, $current_year, $current_month);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    echo json_encode([
        'success' => true,
        'present_count' => $data['present_count'],
        'absent_count' => $data['absent_count']
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'No attendance data found']);
}

