<?php
include '../db_connect.php';

// Get the exam data from the AJAX request
$data = json_decode(file_get_contents("php://input"));

// Check if data is received properly
if (!$data) {
    echo json_encode(['status' => 'error', 'message' => 'No data received.']);
    exit();
}

$all_success = true;
$errors = [];

foreach ($data as $exam) {
    $examName = $exam->examName;
    $examDate = $exam->examDate;  // Exam start date
    $examTime = $exam->examTime;  // Exam start time
    $duration = $exam->duration;  // Duration in minutes
    $location = $exam->location;  // Room number as location
    $departmentName = $exam->department_name;  // Department name
    $semester = $exam->semester;  // Semester
    $subjectName = $exam->subject_name;  // Subject name

    // SQL query to insert exam data into exam_routine
    $sql = "INSERT INTO exam_routine (course_name, exam_date, exam_time, duration, location, department_name, semester, subject_name) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssssss", $examName, $examDate, $examTime, $duration, $location, $departmentName, $semester, $subjectName);
        if (!$stmt->execute()) {
            $all_success = false;
            $errors[] = "Failed to insert exam routine for $subjectName.";
        }
        $stmt->close();
    } else {
        $all_success = false;
        $errors[] = "Failed to prepare SQL query for $subjectName.";
    }
}

$conn->close();

if ($all_success) {
    echo json_encode(['status' => 'success', 'message' => 'Exam routine saved successfully.']);
} else {
    echo json_encode(['status' => 'error', 'message' => implode(' ', $errors)]);
}
?>
