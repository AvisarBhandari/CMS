<?php
include 'db_connect.php';
header('Content-Type: application/json');

$course_code = isset($_GET['course_code']) ? $_GET['course_code'] : '';
$semester = isset($_GET['semester']) ? intval($_GET['semester']) : 0;

if (!$course_code || !$semester) {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
    exit();
}


$sql_subjects = "SELECT subject_code, subject_name, credits, syllabus_status 
                 FROM subjects 
                 WHERE course_code = ? AND semester = ?";
$stmt_subjects = $conn->prepare($sql_subjects);
$stmt_subjects->bind_param("si", $course_code, $semester);
$stmt_subjects->execute();
$result_subjects = $stmt_subjects->get_result();

$subjects = [];
while ($subject = $result_subjects->fetch_assoc()) {
    $subjects[] = $subject;
}

if (!empty($subjects)) {
    echo json_encode(['success' => true, 'subjects' => $subjects]);
} else {
    echo json_encode(['success' => false, 'message' => 'No subjects found']);
}

$stmt_subjects->close();
$conn->close();

