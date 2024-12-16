<?php
session_start();
include 'db_connect.php';
header('Content-Type: application/json');

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit();
}

$faculty_id = $_SESSION['id'];


$sql_department = "SELECT department FROM faculty WHERE faculty_id = ?";
$stmt_department = $conn->prepare($sql_department);
$stmt_department->bind_param("s", $faculty_id);
$stmt_department->execute();
$result_department = $stmt_department->get_result();

if ($result_department->num_rows > 0) {
    $row = $result_department->fetch_assoc();
    $department_name = $row['department'];

    // Fetch courses in the department
    $sql_courses = "SELECT course_code, course_name FROM courses WHERE department_name = ?";
    $stmt_courses = $conn->prepare($sql_courses);
    $stmt_courses->bind_param("s", $department_name);
    $stmt_courses->execute();
    $result_courses = $stmt_courses->get_result();

    $courses = [];
    while ($course = $result_courses->fetch_assoc()) {
        $courses[] = $course;
    }

    echo json_encode(['success' => true, 'courses' => $courses]);
    $stmt_courses->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Department not found']);
}

$stmt_department->close();
$conn->close();

