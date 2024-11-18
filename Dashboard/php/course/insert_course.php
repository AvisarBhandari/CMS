<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

include('../db_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    $response = array();

    // Collecting and sanitizing inputs
    $course_code = isset($_POST['course_code']) ? trim($_POST['course_code']) : '';
    $course_name = isset($_POST['course_name']) ? trim($_POST['course_name']) : '';
    $department_name = isset($_POST['department']) ? mysqli_real_escape_string($conn, trim($_POST['department'])) : '';
    $credits = isset($_POST['credits']) ? trim($_POST['credits']) : '';
    $status = isset($_POST['course_status']) ? trim($_POST['course_status']) : '';
    $course_type = isset($_POST['course_type']) ? trim($_POST['course_type']) : '';
    $course_fee = isset($_POST['course_fee']) ? trim($_POST['course_fee']) : '';

    // Input validations
    if (!preg_match('/^CO-\d{5}$/', $course_code)) {
        $response['status'] = 'error';
        $response['message'] = 'Invalid course code. The format should be CO-12345.';
        echo json_encode($response);
        exit;
    }

    if (!preg_match('/^[a-zA-Z\s]{2,50}$/', $course_name)) {
        $response['status'] = 'error';
        $response['message'] = 'Invalid course name. It should only contain alphabets and be 2 to 50 characters long.';
        echo json_encode($response);
        exit;
    }

    if (!is_numeric($credits) || $credits < 60 || $credits > 200) {
        $response['status'] = 'error';
        $response['message'] = 'Invalid credits. Must be between 60 and 200.';
        echo json_encode($response);
        exit;
    }

    if (!is_numeric($course_fee) || $course_fee < 100000 || $course_fee > 1500000) {
        $response['status'] = 'error';
        $response['message'] = 'Invalid fee. Must be between 1 to 15 lakhs.';
        echo json_encode($response);
        exit;
    }

    if (empty($status)) {
        $response['status'] = 'error';
        $response['message'] = 'Course status is required.';
        echo json_encode($response);
        exit;
    }

    if (empty($course_type)) {
        $response['status'] = 'error';
        $response['message'] = 'Course type is required.';
        echo json_encode($response);
        exit;
    }

    $query = "SELECT id FROM department WHERE name = ?";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        $response['status'] = 'error';
        $response['message'] = 'Database error: ' . $conn->error;
        echo json_encode($response);
        exit;
    }

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

    // Check if a course with the same name already exists
    $check_course_query = "SELECT course_code FROM courses WHERE LOWER(course_name) = LOWER(?)";
    $stmt_check = $conn->prepare($check_course_query);
    if (!$stmt_check) {
        $response['status'] = 'error';
        $response['message'] = 'Database error: ' . $conn->error;
        echo json_encode($response);
        exit;
    }

    $stmt_check->bind_param("s", $course_name);
    $stmt_check->execute();
    $check_result = $stmt_check->get_result();

    if ($check_result && mysqli_num_rows($check_result) > 0) {
        $row = $check_result->fetch_assoc();
        $response['status'] = 'error';
        $response['message'] = 'Course with this name already exists (Course Code: ' . $row['course_code'] . ').';
        echo json_encode($response);
        exit;
    }

    $sql = "INSERT INTO courses (course_code, course_name, department_id, department_name, credits, status, course_type, course_fee) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        $response['status'] = 'error';
        $response['message'] = 'Database error: ' . $conn->error;
        echo json_encode($response);
        exit;
    }

    $stmt->bind_param("ssisissi", $course_code, $course_name, $department_id, $department_name, $credits, $status, $course_type, $course_fee);

    if ($stmt->execute()) {
        $response['status'] = 'success';
        $response['message'] = 'Course added successfully!';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error adding course: ' . $stmt->error;
    }
    $stmt->close();
    $stmt_check->close();
    $conn->close();
    header('Content-Type: application/json');
    echo json_encode($response);
}
