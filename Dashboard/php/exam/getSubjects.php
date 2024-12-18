<?php
// Include database connection
include '../db_connect.php';

// Get the parameters from the GET request
$course_code = $_GET['course_code'];
$semester = $_GET['semester'];  // Ensure semester is treated as a number (1, 2, etc.)
$semester = (int)substr($semester, -1);// SQL query to fetch subjects based on course_code and semester
$sql = "
    SELECT subject_code, subject_name, credits, semester, syllabus_status
    FROM subjects
    WHERE course_code = ? AND semester = ?
";

// Prepare the statement
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $course_code, $semester); // Bind the semester as an integer
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Initialize an array to store subjects
$subjects = array();

// Fetch subjects from the result
while ($row = $result->fetch_assoc()) {
    $subjects[] = $row;
}

// Return subjects as a JSON response
echo json_encode($subjects);

// Close the connection
$stmt->close();
$conn->close();
?>
