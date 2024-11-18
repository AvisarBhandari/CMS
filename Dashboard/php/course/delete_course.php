<?php
include '../db_connect.php';
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['course_code'])) {
    $course_code = mysqli_real_escape_string($conn, $_POST['course_code']);
    
    $query = "DELETE FROM courses WHERE course_code = '$course_code'";

    if (mysqli_query($conn, $query)) {
        echo json_encode(["status" => "success", "message" => "Course deleted successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error deleting course: " . mysqli_error($conn)]);
    }
} else {
  
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}

mysqli_close($conn);

