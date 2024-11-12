<?php
include 'db_connect.php'; 


$query_total = "SELECT COUNT(*) as total_count FROM faculty";
$result_total = $conn->query($query_total);
$total_faculty = $result_total->fetch_assoc()['total_count'];

// Query to get active faculty count
$query_active = "SELECT COUNT(*) as active_count FROM faculty WHERE status = 'Active'";
$result_active = $conn->query($query_active);
$active_faculty = $result_active->fetch_assoc()['active_count'];

// Query to get total attendance records and present faculty count
$query_attendance = "SELECT COUNT(*) as total_attendance, 
                             SUM(CASE WHEN attendance_status = 'Present' THEN 1 ELSE 0 END) as present_count,
                             SUM(CASE WHEN attendance_status = 'Absent' THEN 1 ELSE 0 END) as absent_count
                      FROM faculty_attendance";
$result_attendance = $conn->query($query_attendance);
$attendance_data = $result_attendance->fetch_assoc();

$total_attendance = $attendance_data['total_attendance'];
$present_count = $attendance_data['present_count'];
$absent_count = $attendance_data['absent_count'];

// Calculate percentages
$active_percentage = ($active_faculty / $total_faculty) * 100;
$present_percentage = ($present_count / $total_attendance) * 100;
$absenteeism_rate = ($absent_count / $total_attendance) * 100;

// Prepare data to send as JSON
$data = [
    'total_faculty' => $total_faculty,
    'active_percentage' => round($active_percentage, 2),
    'present_percentage' => round($present_percentage, 2),
    'absenteeism_rate' => round($absenteeism_rate, 2)
];

// Return the data as JSON
echo json_encode($data);

