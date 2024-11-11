<?php
include('db_connect.php'); // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST'&& isset($_POST['faculty_id']))
if ($_POST['edit_mode'] === 'edit'){ {
    // Sanitize input values using mysqli_real_escape_string
    $faculty_id = mysqli_real_escape_string($conn, $_POST['faculty_id']);
    $faculty_name = mysqli_real_escape_string($conn, $_POST['faculty_name']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
    $salary = mysqli_real_escape_string($conn, $_POST['salary']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    
    // Prepare the UPDATE statement with placeholders
    $stmt = $conn->prepare("UPDATE faculty 
                            SET faculty_name = ?, position = ?, address = ?, dob = ?, start_date = ?, salary = ?, phone_number = ?
                            WHERE faculty_id = ?");
    
    if ($stmt === false) {
        // Handle error if statement preparation fails
        echo json_encode(['status' => 'error', 'message' => 'Failed to prepare statement']);
        exit();
    }

   
    $stmt->bind_param("ssssssds", $faculty_name, $position, $address, $dob, $start_date, $salary, $phone_number, $faculty_id);
    
  
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        
        echo json_encode(['status' => 'error', 'message' => $stmt->error]);
    }
    error_reporting(E_ALL); ini_set('display_errors', 1);

   
    $stmt->close();
}}

