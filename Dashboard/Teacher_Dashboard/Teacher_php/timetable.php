<?php
session_start();
include 'db_connect.php';
header('Content-Type: application/json');
if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit();
}
$faculty_id = $_SESSION['id']; 
$selected_day = isset($_GET['day']) ? $_GET['day'] : '';


$sql = "SELECT ts.subject_id, s.subject_name, ts.start_time, ts.end_time, 
               sub.semester, c.course_name
        FROM timetable ts
        JOIN subjects s ON ts.subject_id = s.subject_id
        JOIN courses c ON ts.course_code = c.course_code
        JOIN subjects sub ON ts.subject_id = sub.subject_id
        WHERE ts.faculty_id = ? AND ts.day = ?
        ORDER BY ts.start_time ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $faculty_id, $selected_day); 
$stmt->execute();
$result = $stmt->get_result();

$timetable = [];
while ($row = $result->fetch_assoc()) {
    $timetable[] = $row;
}
echo json_encode($timetable); 
$stmt->close();
$conn->close();

