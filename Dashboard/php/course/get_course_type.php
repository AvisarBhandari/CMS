<?php
header('Content-Type: application/json');
include '../db_connect.php';

if (!$conn) {
    echo json_encode(["error" => "Database connection failed."]);
    exit;
}

if (isset($_GET['course_code'])) {
    $courseCode = $_GET['course_code'];

    // Query to fetch course_type based on course_code
    $query = "SELECT course_type FROM courses WHERE course_code = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $courseCode); 

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $courseTypes = [];  // Array to store course types

        while ($row = $result->fetch_assoc()) {
            $courseTypes[] = $row['course_type'];  // Push course_type to array
        }

        // Return course types as a JSON response
        echo json_encode($courseTypes);
    } else {
        echo json_encode(["error" => "Failed to fetch course types"]);
    }

    $stmt->close();
} else {
    echo json_encode(["error" => "Course code is required"]);
}

$conn->close();
