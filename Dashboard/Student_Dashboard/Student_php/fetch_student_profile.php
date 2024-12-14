<?php
session_start();
if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit();
}
include('db_connect.php');
$user_roll = $_SESSION['id'];  
$query = "SELECT 
            student_id, 
            student_roll, 
            student_name, 
            gender, 
            email, 
            department_name, 
            course_code, 
            phone_no, 
            dob, 
            admission_date, 
            parent_name, 
            address
          FROM students_info 
          WHERE student_roll = ?"; 
          
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $user_roll);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $profile = $result->fetch_assoc();
    echo json_encode(['success' => true, 'data' => $profile]);
} else {
    // If no profile found, return an error
    echo json_encode(['success' => false, 'message' => 'No profile found']);
}


$stmt->close();
$conn->close();

