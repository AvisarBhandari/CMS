<?php
// Start the session
session_start();

// Include database connection
include 'db_connect.php';

// Query to get total number of students
$student_query = "SELECT COUNT(*) AS total_students FROM student";
$result_student = $conn->query($student_query);
$total_students = $result_student->num_rows > 0 ? $result_student->fetch_assoc()['total_students'] : 0;

// Query to get total number of faculty members
$faculty_query = "SELECT COUNT(*) AS total_faculty FROM faculty";
$result_faculty = $conn->query($faculty_query);
$total_faculty = $result_faculty->num_rows > 0 ? $result_faculty->fetch_assoc()['total_faculty'] : 0;

// Store data in session variables
$_SESSION['total_students'] = $total_students;
$_SESSION['total_faculty'] = $total_faculty;

// Optionally, you can redirect or display something
// For example, redirect to the dashboard page
// header('Location: dashboard.php'); 
// exit(); 

// Or just display the data (for testing or debugging)
echo "Total students: " . $total_students . "<br>";
echo "Total faculty members: " . $total_faculty . "<br>";


$sql = "SELECT COUNT(*) AS TotalAttendance FROM attendance";

// Execute the query
$result = $conn->query($sql);

// Check if the query was successful and retrieve the result
if ($result->num_rows > 0) {
    // Fetch the result as an associative array
    $row = $result->fetch_assoc();
    
    // Store the total attendance count in the variable
    $totalAttendance = $row['TotalAttendance'];

    // Output the total attendance records
    echo "Total Attendance Records: " . $totalAttendance . "<br>";
} else {
    echo "No attendance records found.<br>";
    $totalAttendance = 0; // Assign a default value in case there are no records
}

// If we have total students and total attendance, calculate attendance percentage
if ($total_students > 0) {
    // Calculate attendance percentage
    $attendancePercentage = ($totalAttendance / $total_students) * 100;
    $_SESSION['attendancePercentage'] = round($attendancePercentage, 2);  // Round to 2 decimal places

    // Output attendance percentage
    echo "Attendance Percentage: " . $_SESSION['attendancePercentage'] . "%<br>";
} else {
    $_SESSION['attendancePercentage'] = 0;  // Default to 0% if no students
    echo "Attendance Percentage: 0%<br>";
}

// Now calculate the total present students based on the attendance percentage
if ($total_students > 0 && isset($_SESSION['attendancePercentage'])) {
    // Calculate the total present students
    $totalPresent = ($totalAttendance / 100) * $total_students;  // This formula works as you're calculating presence from the attendance records
    $_SESSION['totalPresent'] = round($totalPresent);  // Round to the nearest integer

    // Output total present students
    echo "Total Present Students: " . $_SESSION['totalPresent'] . "<br>";
} else {
    $_SESSION['totalPresent'] = 0;  // Default to 0 if there are no students or percentage
    echo "Total Present Students: 0<br>";
}



$sql = "SELECT COUNT(*) AS departmentCount FROM department";

// Execute the query
$result = $conn->query($sql);

// Check if the query was successful and retrieve the result
if ($result->num_rows > 0) {
    // Fetch the result as an associative array
    $row = $result->fetch_assoc();
    
    // Store the number of departments in the session variable "totalCourse"
    $_SESSION['totalCourse'] = $row['departmentCount'];
    
    // Optionally, you can output the value
    echo "Total number of departments: " . $_SESSION['totalCourse'] . "<br>";
} else {
    // If no departments are found, handle the error
    echo "No departments found in the database.<br>";
}

?>
