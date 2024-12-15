<?php
session_start();
include 'db_connect.php';
header('Content-Type: application/json');
if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit();
}
$student_id = $_SESSION['id']; 
error_log("Fetching timetable for student ID: {$student_id}");
$input = json_decode(file_get_contents('php://input'), true);
$selected_day = isset($input['day']) ? trim($input['day']) : null;
$selected_semester = isset($input['semester']) ? (int)$input['semester'] : null;
error_log("Selected Day: {$selected_day}, Selected Semester: {$selected_semester}");
if (!$selected_day || !$selected_semester) {
    echo json_encode(['success' => false, 'message' => 'Invalid parameters']);
    exit();
}

$query = "SELECT course_code FROM students_info WHERE student_roll = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $student_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'Student not found']);
    exit();
}

$row = $result->fetch_assoc();
$course_code = $row['course_code'];


error_log("Course Code for student {$student_id}: {$course_code}");

$query = "SELECT t.subject_id, t.start_time, t.end_time, t.faculty_id, 
                 s.subject_name, f.faculty_name
          FROM timetable t
          JOIN subjects s ON t.subject_id = s.subject_id
          JOIN faculty f ON t.faculty_id = f.faculty_id
          WHERE t.course_code = ? AND t.semester = ? AND t.day = ?
          ORDER BY t.start_time";

$stmt = $conn->prepare($query);
$stmt->bind_param("sis", $course_code, $selected_semester, $selected_day);
$stmt->execute();
$result = $stmt->get_result();

$timetable = [];
while ($row = $result->fetch_assoc()) {
    $timetable[] = [
        'subject_name' => $row['subject_name'],
        'start_time' => $row['start_time'],
        'end_time' => $row['end_time'],
        'faculty_name' => $row['faculty_name']
    ];
}

if (empty($timetable)) {
    echo json_encode(['success' => false, 'message' => 'No timetable available for the selected day and semester.']);
} else {
    echo json_encode(['success' => true, 'timetable' => $timetable]);
}

$stmt->close();
$conn->close();

