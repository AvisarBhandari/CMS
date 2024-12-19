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

// Function to generate a random string of alphanumeric characters (6 length)
function generateRandomString($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    
    return $randomString;
}

// Generate the random exam ID (you can make this fixed length, like 6)
$id = 'EX-' . generateRandomString(6);

foreach ($data as $exam) {
    $examName = $exam->examName;
    $courseName = $exam->courseName; // Corrected variable name
    $examDate = $exam->examDate;  // Exam start date
    $examTime = $exam->examTime;  // Exam start time
    $duration = $exam->duration;  // Duration in minutes
    $location = $exam->location;  // Room number as location
    $departmentName = $exam->department_name;  // Department name
    $semester = $exam->semester;  // Semester
    $subjectName = $exam->subject_name;  // Subject name

    // SQL query to insert exam data into exam_routine
    $sql = "INSERT INTO exam_routine (exam_code, exam_name, course_name, exam_date, exam_time, duration, location, department_name, semester, subject_name) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare and execute the query
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssssssss", $id, $examName, $courseName, $examDate, $examTime, $duration, $location, $departmentName, $semester, $subjectName);
        
        if (!$stmt->execute()) {
            $all_success = false;
            $errors[] = "Failed to insert exam routine for $subjectName. MySQL Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $all_success = false;
        $errors[] = "Failed to prepare SQL query for $subjectName. MySQL Error: " . $conn->error;
    }
}

// Close the database connection
$conn->close();

// Return the response in JSON format
if ($all_success) {
    echo json_encode(['status' => 'success', 'message' => 'Exam routine saved successfully.']);
} else {
    echo json_encode(['status' => 'error', 'message' => implode(' ', $errors)]);
}
?>
