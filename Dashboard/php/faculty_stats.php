<?php
include 'db_connect.php'; 

header('Content-Type: application/json'); // Ensure correct JSON headers

try {
    $currentYear = date("Y");   // Get the current year
    $currentMonth = date("m");  // Get the current month (numeric)

    // Query to get total faculty count
    $query_total = "SELECT COUNT(*) as total_count FROM faculty";
    $result_total = $conn->query($query_total);
    $total_faculty = $result_total->fetch_assoc()['total_count'] ?? 0;

    // Query to get active faculty count
    $query_active = "SELECT COUNT(*) as active_count FROM faculty WHERE status = 'Active'";
    $result_active = $conn->query($query_active);
    $active_faculty = $result_active->fetch_assoc()['active_count'] ?? 0;

    // Query to get attendance data for the current month
    $query_attendance = "SELECT 
                                COUNT(*) as total_attendance, 
                                SUM(CASE WHEN status = 'Present' THEN 1 ELSE 0 END) as present_count,
                                SUM(CASE WHEN status = 'Absent' THEN 1 ELSE 0 END) as absent_count
                         FROM faculty_attendances 
                         WHERE MONTH(attendance_date) = '$currentMonth' 
                         AND YEAR(attendance_date) = '$currentYear'";

    $result_attendance = $conn->query($query_attendance);
    $attendance_data = $result_attendance->fetch_assoc();

    $total_attendance = $attendance_data['total_attendance'] ?? 0;
    $present_count = $attendance_data['present_count'] ?? 0;
    $absent_count = $attendance_data['absent_count'] ?? 0;

    // Avoid division by zero
    $active_percentage = $total_faculty > 0 ? ($active_faculty / $total_faculty) * 100 : 0;
    $present_percentage = $total_attendance > 0 ? ($present_count / $total_attendance) * 100 : 0;
    $absenteeism_rate = $total_attendance > 0 ? ($absent_count / $total_attendance) * 100 : 0;

    // Prepare data to send as JSON
    $data = [
        'total_faculty' => $total_faculty,
        'active_percentage' => round($active_percentage, 2),
        'present_percentage' => round($present_percentage, 2),
        'absenteeism_rate' => round($absenteeism_rate, 2)
    ];

    echo json_encode($data);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
