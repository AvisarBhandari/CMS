<?php
session_start();
include 'db_connect.php';
header('Content-Type: application/json');


if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'Faculty not logged in']);
    exit();
}

$faculty_id = $_SESSION['id'];
$course_code = isset($_POST['course_code']) ? $_POST['course_code'] : null;
$semester = isset($_POST['semester']) ? $_POST['semester'] : null;

if (!$course_code || !$semester) {
    echo json_encode(['success' => false, 'message' => 'Course or semester not selected']);
    exit();
}

try {
    // Fetch course name based on course code
    $stmt = $conn->prepare("SELECT course_name FROM courses WHERE course_code = ?");
    $stmt->bind_param("s", $course_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'Course not found']);
        exit();
    }

    $row = $result->fetch_assoc();
    $course_name = $row['course_name'];

    // Fetch the exam routine for the selected course and semester
    $stmt = $conn->prepare("
    SELECT exam_name, exam_date, exam_time, subject_name, duration, location 
    FROM exam_routine 
    WHERE course_name = ? AND semester = ? 
    ORDER BY exam_date ASC
    ");
    $stmt->bind_param("ss", $course_name, $semester);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'No exam routine found for this course and semester']);
        exit();
    }

    $routine = [];
    while ($row = $result->fetch_assoc()) {
        $routine[] = $row;
    }

    echo json_encode(['success' => true, 'data' => $routine, 'course_name' => $course_name]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error fetching exam routine: ' . $e->getMessage()]);
}
