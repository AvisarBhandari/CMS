<?php
session_start();
include '../db_connect.php';  // Include your database connection

// Check if session variables are set
if (!isset($_SESSION['role']) || !isset($_SESSION['id'])) {
    echo json_encode(['error' => 'Session data missing']);
    exit();
}

$role = $_SESSION['role'];
$id = $_SESSION['id'];

$data = array(); // To store the fetched data

// Fetch data based on user role
try {
    if ($role == "admin") {
        $query = "SELECT * FROM admin WHERE id = ? ";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $id);  // Bind user ID
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $data = array(
                'name' => $row['name'],
                'role' => 'ADMIN',
                'phone_number' => $row['phone_number'],
                'dob' => $row['dob'],
                'address' => $row['address'],
                'gender' => isset($row['gender']) ? $row['gender'] : null  // Check if gender is set
            );
        } else {
            $data = ['error' => 'Admin not found'];
        }
    } elseif ($role == "student") {
        $query = "SELECT * FROM students_info WHERE student_roll = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $id);  // Bind student roll (or student id)
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $data = array(
                'name' => $row['student_name'],
                'role' => 'STUDENT',
                'phone_number' => $row['phone_no'],
                'dob' => $row['dob'],
                'address' => $row['address'],
                'gender' => isset($row['gender']) ? $row['gender'] : 'Unknown' // Check if gender is set
            );
        } else {
            $data = ['error' => 'Student not found'];
        }
    } elseif ($role == "faculty") {
        $query = "SELECT * FROM faculty WHERE faculty_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $id);  // Bind faculty id
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $data = array(
                'name' => $row['faculty_name'],
                'role' => 'FACULTY',
                'phone_number' => $row['phone_number'],
                'dob' => $row['dob'],
                'address' => $row['address'],
                'gender' => isset($row['gender']) ? $row['gender'] : 'Unknown'  // Check if gender is set
            );
        } else {
            $data = ['error' => 'Faculty not found'];
        }
    } else {
        $data = ['error' => 'Unknown role'];
    }
} catch (Exception $e) {
    $data = ['error' => 'Database error: ' . $e->getMessage()];
}

// Set the content type header to JSON
header('Content-Type: application/json');

// Return the JSON data
echo json_encode($data);
exit();  // Ensure no additional output
?>
