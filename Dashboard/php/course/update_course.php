<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);  

include('../db_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $course_code = $_POST['course_code'];
    $course_name = $_POST['course_name'];
    $department_name = mysqli_real_escape_string($conn, $_POST['department']);
    $credits = $_POST['credits'];
    $course_type=$_POST['course_type'];
    $status = $_POST['course_status'];
    $course_fee=$_POST['course_fee'];

    $response = array();

   
    $query = "SELECT id FROM department WHERE name = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $department_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && mysqli_num_rows($result) > 0) {
        $row = $result->fetch_assoc();
        $department_id = $row['id'];
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Department not found.';
        echo json_encode($response);  
        exit;
    }

    $update_query = "UPDATE courses SET course_code = ?, course_name = ?, department_id = ?, department_name = ?, credits = ?,  status = ?,course_type=?,course_fee=? WHERE course_code = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("ssisissis", $course_code, $course_name, $department_id, $department_name, $credits,  $status,$course_type,$course_fee, $course_code);
    
    
    if ($update_stmt->execute()) {
        $response['status'] = 'success';
        $response['message'] = 'Course updated successfully!';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error updating course: ' . $conn->error;
    }
    $update_stmt->close();
    $conn->close();
    header('Content-Type: application/json');
    echo json_encode($response); 
}

