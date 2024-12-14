<?php
include '../db_connect.php';

header('Content-Type: application/json');

// Get POST data
$subject_id = $_POST['subject_id'];
$subject_code = $_POST['subject_code'];
$subject_name = $_POST['subject_name'];
$credits = $_POST['credits'];
$semester = $_POST['semester'];
$syllabus_status = $_POST['syllabus_status'];
$course_code = $_POST['course_code'];

// Sanitize input to prevent SQL injection
$subject_code = mysqli_real_escape_string($conn, $subject_code);
$subject_name = mysqli_real_escape_string($conn, $subject_name);
$credits = mysqli_real_escape_string($conn, $credits);
$semester = mysqli_real_escape_string($conn, $semester);
$syllabus_status = mysqli_real_escape_string($conn, $syllabus_status);
$course_code = mysqli_real_escape_string($conn, $course_code);

// Validation
if (empty($subject_id) || empty($subject_code) || empty($subject_name) || empty($credits) || empty($semester) || empty($syllabus_status) || empty($course_code)) {
    echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
    exit;
}

if (!preg_match("/^[a-zA-Z ]*$/", $subject_name)) {
    echo json_encode(['status' => 'error', 'message' => 'Subject name must contain only alphabets.']);
    exit;
}

if (!is_numeric($credits) || $credits <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'Credits must be a positive number.']);
    exit;
}

if (!is_numeric($semester) || $semester < 1 || $semester > 8) {
    echo json_encode(['status' => 'error', 'message' => 'Semester must be between 1 and 8.']);
    exit;
}

// Validate subject_code format (must be SUB-####)
if (!preg_match("/^SUB-\d{4}$/", $subject_code)) {
    echo json_encode(['status' => 'error', 'message' => 'Subject code must follow the format SUB-#### (four digits).']);
    exit;
}

// Validate syllabus_status (must be 'Completed' or 'Not Completed')
if (!in_array($syllabus_status, ['Completed', 'Not Completed'])) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid syllabus status. It must be either "Completed" or "Not Completed".']);
    exit;
}

// Prepare SQL query using prepared statements for update
$query = "UPDATE subjects SET subject_code = ?, subject_name = ?, credits = ?, semester = ?, syllabus_status = ?, course_code = ? 
          WHERE subject_id = ?";

$stmt = mysqli_prepare($conn, $query);
if ($stmt) {
    // Bind parameters to the prepared statement
    mysqli_stmt_bind_param($stmt, "ssiisss", $subject_code, $subject_name, $credits, $semester, $syllabus_status, $course_code, $subject_id);
    
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['status' => 'success', 'message' => 'Subject updated successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update subject.']);
    }

    mysqli_stmt_close($stmt);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to prepare statement.']);
}

mysqli_close($conn);
?>
