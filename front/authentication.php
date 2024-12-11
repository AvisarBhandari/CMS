<?php
include ('db_connect.php');
// Start the session at the beginning of the script
session_start();

// Check if session variables are set
if (!isset($_SESSION['role']) || !isset($_SESSION['id']) || !isset($_SESSION['password'])) {
    echo "No data received.";
    exit();
}

// Retrieve data from session variables
$role = $_SESSION['role'];
$id = $_SESSION['id'];
$password = $_SESSION['password'];

// Initialize a variable to store user data
$userData = null;

// Based on the role, query the appropriate table
if ($role == 'admin') {
    // Admin authentication
    $sql = "SELECT * FROM admin WHERE id = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $id, $password); // "ss" means two strings
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // User found, fetch the data
        $userData = $result->fetch_assoc();
        // Redirect to Admin Dashboard
        header('Location: Admin_Dashboard.php');
        exit();
    } else {
        echo "Invalid credentials for admin.";
        exit();
    }
}

if ($role == 'faculty') {
    // Faculty authentication
    $sql = "SELECT * FROM faculty WHERE faculty_id = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $id, $password); // "ss" means two strings
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // User found, fetch the data
        $userData = $result->fetch_assoc();
        // Redirect to Faculty Dashboard
        header('Location: Teacher_Dashboard.php');
        exit();
    } else {
        echo "Invalid credentials for faculty.";
        exit();
    }
}

if ($role == 'student') {
    // Student authentication
    $sql = "SELECT * FROM students_info WHERE student_id = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $id, $password); // "ss" means two strings
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // User found, fetch the data
        $userData = $result->fetch_assoc();
        // Redirect to Student Dashboard
        header('Location: Student_Dashboard.php');
        exit();
    } else {
        echo "Invalid credentials for student.";
        exit();
    }
}

// If none of the roles matched, show an error
echo "Invalid role or credentials.";
exit();
?>
