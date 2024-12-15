<?php
session_start();
include 'db_connect.php';
header('Content-Type: application/json');

if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit();
}

$session_id = $_SESSION['id'];

$query = "SELECT student_id FROM students_info WHERE student_roll= ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $session_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if student_id is found
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $student_id = $row['student_id'];
} else {
    echo json_encode(['success' => false, 'message' => 'Student not found']);
    exit();
}


$query = "
    SELECT 
        COUNT(*) AS total_attendance, 
        SUM(CASE WHEN status = 'Present' THEN 1 ELSE 0 END) AS present_count,
        SUM(CASE WHEN status = 'Absent' THEN 1 ELSE 0 END) AS absent_count
    FROM student_attendance 
    WHERE student_id = ?
";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    echo json_encode([
        'success' => true,
        'total_attendance' => $data['total_attendance'],
        'present_count' => $data['present_count'],
        'absent_count' => $data['absent_count']
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'No attendance data found']);
}

$stmt->close();
$conn->close();

