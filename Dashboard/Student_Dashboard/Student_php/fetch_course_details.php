<?php
session_start();
include 'db_connect.php';
header('Content-Type: application/json');

// Check if the user is logged in and their session is set
if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit();
}

$student_id = $_SESSION['id'];

// Fetch the course_code for the logged-in student from student_info (or similar table)
$query_course_code = "SELECT course_code FROM students_info WHERE student_roll = ?";
$stmt = $conn->prepare($query_course_code);
$stmt->bind_param("s", $student_id);
$stmt->execute();
$result_course_code = $stmt->get_result();

if ($result_course_code->num_rows > 0) {
    // Assuming one course_code per student
    $course_code = $result_course_code->fetch_assoc()['course_code'];
    
    // Fetch course details for the course_code
    $query_course_details = "SELECT course_code, course_name, credits, course_type, course_fee ,department_name
                             FROM courses 
                             WHERE course_code = ?";
    $stmt_details = $conn->prepare($query_course_details);
    $stmt_details->bind_param("s", $course_code);
    $stmt_details->execute();
    $result_course_details = $stmt_details->get_result();
    
    $course_details = [];
    if ($result_course_details->num_rows > 0) {
        $course_details = $result_course_details->fetch_assoc();
    }

    // Fetch subjects for the course excluding syllabus_status
    $query_subjects = "SELECT subject_code, subject_name, credits, semester 
                       FROM subjects 
                       WHERE course_code = ? 
                       ORDER BY semester ASC";
    $stmt_subjects = $conn->prepare($query_subjects);
    $stmt_subjects->bind_param("s", $course_code);
    $stmt_subjects->execute();
    $result_subjects = $stmt_subjects->get_result();

    $subjects = [];
    while ($row = $result_subjects->fetch_assoc()) {
        $subjects[] = $row;
    }

    // Return course details and subjects as JSON
    echo json_encode([
        'success' => true,
        'course_details' => $course_details,
        'subjects' => $subjects
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'No courses found for this student.']);
}

$stmt->close();
$conn->close();
?>
