<?php
session_start();
include 'db_connect.php'; 
header('Content-Type: application/json');


if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit();
}


$semester = isset($_POST['semester']) ? $_POST['semester'] : null;

if (!$semester) {
    echo json_encode(['success' => false, 'message' => 'Semester not selected']);
    exit();
}

$user_id = $_SESSION['id'];

try {
   
    $stmt = $conn->prepare("SELECT course_code FROM students_info WHERE student_roll= ?");
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'No courses found for this user']);
        exit();
    }

    $row = $result->fetch_assoc();
    $course_code = $row['course_code'];

   
    $stmt = $conn->prepare("SELECT course_name FROM courses WHERE course_code = ?");
    $stmt->bind_param("s", $course_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'No course name found for this course code']);
        exit();
    }

    $row = $result->fetch_assoc();
    $course_name = $row['course_name'];

 
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
        echo json_encode(['success' => false, 'message' => 'No exam routine found for this semester']);
        exit();
    }

  
    $routine = [];
    while ($row = $result->fetch_assoc()) {
        $routine[] = $row;
    }

   
    echo json_encode([
        'success' => true,
        'course_name' => $course_name, 
        'data' => $routine
    ]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error fetching routine: ' . $e->getMessage()]);
}

