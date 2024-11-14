<?php
include '../db_connect.php'; // Include the database connection
header('Content-Type: application/json');

// Check if course_code is set and not empty
if (isset($_GET['course_code']) && !empty($_GET['course_code'])) {
    $course_code = mysqli_real_escape_string($conn, $_GET['course_code']); // Use course_code for fetching data
    
    // Query to fetch course data based on course_code
    $query = "SELECT * FROM courses WHERE course_code = '$course_code'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $course = mysqli_fetch_assoc($result);
        
        // Return the course data as JSON
        echo json_encode(["status" => "success", "data" => $course]);
    } else {
        // Return error if no data is found
        echo json_encode(["status" => "error", "message" => "Course not found"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}

mysqli_close($conn);
?>
