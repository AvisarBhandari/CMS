<?php

include 'db_connect.php';


header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    if (!$conn) {
        echo json_encode(['status' => 'error', 'message' => 'Database connection failed']);
        exit;
    }

    // Sanitize and validate the POST data
    $faculty_id = mysqli_real_escape_string($conn, $_POST['faculty_id']);
    $faculty_name = mysqli_real_escape_string($conn, $_POST['faculty_name']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $dob = $_POST['dob'];
    $start_date = $_POST['start_date'];
    $salary = mysqli_real_escape_string($conn, $_POST['salary']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

   
    if (empty($dob) || !strtotime($dob) || empty($start_date) || !strtotime($start_date)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid Date(s) provided']);
        exit;
    }

   
    $dob = date('Y-m-d', strtotime($dob));
    $start_date = date('Y-m-d', strtotime($start_date));

   
    $sql = "INSERT INTO faculty (department, faculty_id, faculty_name, position, address, dob, start_date, salary, phone_number, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

  
    $stmt = mysqli_prepare($conn, $sql);

  
    if ($stmt === false) {
        echo json_encode(['status' => 'error', 'message' => 'Failed to prepare statement: ' . mysqli_error($conn)]);
        exit;
    }

   
    mysqli_stmt_bind_param(
        $stmt,
        'sssssdssss', 
        $department,
        $faculty_id,
        $faculty_name,
        $position,
        $address,
        $dob,
        $start_date,
        $salary,
        $phone_number,
        $status
    );

   
    if (mysqli_stmt_execute($stmt)) {
      
        echo json_encode(['status' => 'success', 'message' => 'Faculty added successfully!']);
    } else {
      
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . mysqli_stmt_error($stmt)]);
    }

   
    mysqli_stmt_close($stmt);
}


mysqli_close($conn);


// sql 
// CREATE TABLE facultys (
//     department VARCHAR(255) NOT NULL,                
//     faculty_id VARCHAR(20) NOT NULL UNIQUE,           
//     faculty_name VARCHAR(255) NOT NULL,               
//     position VARCHAR(255) NOT NULL,                   
//     address TEXT NOT NULL,                            
//     dob DATE NOT NULL,                                
//     start_date DATE NOT NULL,                         
//     salary DECIMAL(10, 2) NOT NULL,                   
//     phone_number VARCHAR(15) NOT NULL,               
//     status ENUM('Active', 'Inactive') NOT NULL,       
//     PRIMARY KEY (faculty_id)                         
// );
