<?php

include 'db_connect.php'; 

// Query to get total number of students
$student_query = "SELECT COUNT(*) AS total_students FROM students_info";
$result_student = $conn->query($student_query);
if ($result_student) {
    $total_students = $result_student->fetch_assoc()['total_students'];
} else {
    $total_students = 0;
}

// Query to get total number of faculty members
$faculty_query = "SELECT COUNT(*) AS total_faculty FROM faculty";
$result_faculty = $conn->query($faculty_query);
if ($result_faculty) {
    $total_faculty = $result_faculty->fetch_assoc()['total_faculty'];
} else {
    $total_faculty = 0;
}

// Query to get the total attendance of students today
$sql = "SELECT COUNT(*) AS total_Student_Attendance FROM student_attendance WHERE Status = 'Present' AND attendance_date = CURDATE()";
$result = $conn->query($sql);

// Check if the query was successful
if ($result) {
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $total_Student_Attendance = $row['total_Student_Attendance'];
    } else {
        $total_Student_Attendance = 0;
    }
} else {
    $total_Student_Attendance = 0;
}

// Calculate attendance percentage
if ($total_students > 0) {
    $attendancePercentage = ($total_Student_Attendance / $total_students) * 100;
    $attendancePercentage = round($attendancePercentage, 2);  // Round to 2 decimal places
    
} else {
    $attendancePercentage = 0;  // Default to 0% if no students
}


$sql = "SELECT COUNT(*) AS cource FROM courses WHERE Status = 'Active'";
$result = $conn->query($sql);

// Check if the query was successful
if ($result) {
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $cource = $row['cource'];
    } else {
        $cource = 0;
    }
} else {
    $cource = 0;
}

// Prepare data to send as JSON response
$response = array(
    'total_students' => $total_students,
    'total_faculty' => $total_faculty,
    'total_student_attendance' => $total_Student_Attendance,
    'attendance_percentage' => $attendancePercentage,
    'cource' => $cource
);

// Return the response as JSON
echo json_encode($response);

?>
