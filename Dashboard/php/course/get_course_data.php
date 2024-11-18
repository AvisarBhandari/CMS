<?php
include '../db_connect.php';
header('Content-Type: application/json');

if (isset($_GET['course_code']) && !empty($_GET['course_code'])) {
    $course_code = mysqli_real_escape_string($conn, $_GET['course_code']); 
    
    $query = "SELECT * FROM courses WHERE course_code = '$course_code'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $course = mysqli_fetch_assoc($result);
        
        echo json_encode(["status" => "success", "data" => $course]);
    } else {
        echo json_encode(["status" => "error", "message" => "Course not found"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}

mysqli_close($conn);

