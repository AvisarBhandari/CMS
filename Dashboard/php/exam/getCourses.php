<?php
// Database connection
include '../db_connect.php';

// Get the department name from the GET request
$department = $_GET['department'];

// Prepare the SQL query to get courses based on the department
$sql = "
    SELECT c.course_code, c.course_name,c.course_type
    FROM courses c
    JOIN department d ON c.department_id = d.id
    WHERE d.name = ?
";

// Prepare the statement
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    // Output the error message if prepare failed
    die('Error preparing the statement: ' . $conn->error);
}

$stmt->bind_param("s", $department);
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Fetch courses into an array
$courses = array();
while ($row = $result->fetch_assoc()) {
    $courses[] = $row;
}

// Return the courses as JSON
echo json_encode($courses);

// Close connection
$stmt->close();
$conn->close();
?>
