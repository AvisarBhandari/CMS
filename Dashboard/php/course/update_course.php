<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);  // Display all errors

include('../db_connect.php');

// Ensure the request is a POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $course_code = $_POST['course_code'];
    $course_name = $_POST['course_name'];
    $department_name = mysqli_real_escape_string($conn, $_POST['department']);
    $credits = $_POST['credits'];
    $semester = $_POST['semester'];
    $status = $_POST['course_status'];

    $response = array();

    // Query to get department ID
    $query = "SELECT id FROM department WHERE name = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $department_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && mysqli_num_rows($result) > 0) {
        $row = $result->fetch_assoc();
        $department_id = $row['id'];
    } else {
        // Department not found
        $response['status'] = 'error';
        $response['message'] = 'Department not found.';
        echo json_encode($response);  // Ensure no HTML is sent before JSON
        exit;
    }

    // Update course query
    $update_query = "UPDATE courses SET course_code = ?, course_name = ?, department_id = ?, department_name = ?, credits = ?, semester = ?, status = ? WHERE course_code = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("ssisisss", $course_code, $course_name, $department_id, $department_name, $credits, $semester, $status, $course_code);
    
    
    if ($update_stmt->execute()) {
        $response['status'] = 'success';
        $response['message'] = 'Course updated successfully!';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error updating course: ' . $conn->error;
    }

    // Close prepared statement and connection
    $update_stmt->close();
    $conn->close();

    // Set content-type header and return the response in JSON format
    header('Content-Type: application/json');
    echo json_encode($response);  // Ensure the response is valid JSON
}
?>
