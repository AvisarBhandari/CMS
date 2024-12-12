<?php
// Include database connection
include('../db_connect.php');

// Get today's date
$today = date('Y-m-d');

// Get the total number of students
$query_students = "SELECT COUNT(*) AS total_students FROM students_info";
$result_students = mysqli_query($conn, $query_students);
$row_students = mysqli_fetch_assoc($result_students);
$total_students = $row_students['total_students'];

// Get today's attendance
$query_attendance = "SELECT COUNT(*) AS total_attendance FROM student_attendance WHERE attendance_date = '$today' AND status = 'present'";
$result_attendance = mysqli_query($conn, $query_attendance);
$row_attendance = mysqli_fetch_assoc($result_attendance);
$totalAttendance = $row_attendance['total_attendance'];

// Get today's absentees
$query_absent = "SELECT COUNT(*) AS total_absent FROM student_attendance WHERE attendance_date = '$today' AND status = 'absent'";
$result_absent = mysqli_query($conn, $query_absent);
$row_absent = mysqli_fetch_assoc($result_absent);
$absentStudent = $row_absent['total_absent'];

// Get this month's enrollments
$current_month = date('Y-m');
$query_enrollments = "SELECT COUNT(*) AS total_enrollments FROM students_info WHERE DATE_FORMAT(admission_date, '%Y-%m') = '$current_month'";
$result_enrollments = mysqli_query($conn, $query_enrollments);
$row_enrollments = mysqli_fetch_assoc($result_enrollments);
$totalEnrollments = $row_enrollments['total_enrollments'];

// Return data as JSON
$data = [
    'total_students' => $total_students,
    'total_attendance' => $totalAttendance,
    'absent_students' => $absentStudent,
    'total_enrollments' => $totalEnrollments
];

echo json_encode($data);
?>
