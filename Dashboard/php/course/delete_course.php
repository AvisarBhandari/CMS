<?php
include '../db_connect.php'; // Include the database connection

// Set the correct content-type for JSON
header('Content-Type: application/json');

// Check if the request is a POST request and contains the necessary parameter
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['course_code'])) {
    $course_code = mysqli_real_escape_string($conn, $_POST['course_code']);
    
    // Query to delete the course using course_code
    $query = "DELETE FROM courses WHERE course_code = '$course_code'";

    if (mysqli_query($conn, $query)) {
        // Return success response
        echo json_encode(["status" => "success", "message" => "Course deleted successfully"]);
    } else {
        // Return error response with query error details
        echo json_encode(["status" => "error", "message" => "Error deleting course: " . mysqli_error($conn)]);
    }
} else {
    // Return error response for invalid request
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}

mysqli_close($conn);
?>
