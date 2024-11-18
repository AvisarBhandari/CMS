<?php
header('Content-Type: application/json');
include '../db_connect.php';

if (!$conn) {
    echo json_encode(["error" => "Database connection failed."]);
    exit;
}

if (isset($_GET['department_name'])) {
    $departmentName = $_GET['department_name'];

    
    $query = "SELECT course_code, course_name, course_type FROM courses WHERE department_name = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $departmentName);

   
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $courses = [];
        while ($row = $result->fetch_assoc()) {
            $courses[] = $row;
        }
        echo json_encode($courses);
    } else {
        echo json_encode(["error" => "Failed to fetch courses"]);
    }

    $stmt->close();
} else {
    echo json_encode(["error" => "Department name is required"]);
}

$conn->close();

