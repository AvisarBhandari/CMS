<?php
header('Content-Type: application/json');
include '../db_connect.php';

if (!$conn) {
    echo json_encode(["error" => "Database connection failed."]);
    exit;
}

if (isset($_GET['course_code'])) {
    $courseCode = $_GET['course_code'];

   
    $query = "SELECT semester FROM courses WHERE course_code = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $courseCode); 

   
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $semester = [];
        while ($row = $result->fetch_assoc()) {
            $semester[] = $row['semester'];
        }
        echo json_encode($semester);
    } else {
        echo json_encode(["error" => "Failed to fetch semester"]);
    }

    $stmt->close();
} else {
    echo json_encode(["error" => "Course code is required"]);
}

$conn->close();

