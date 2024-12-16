<?php
session_start();
include 'db_connect.php';
header('Content-Type: application/json');


if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit();
}

$faculty_id = $_SESSION['id'];


$sql = "SELECT faculty_id, faculty_name, position, address, dob, start_date, salary, phone_number, department FROM faculty WHERE faculty_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $faculty_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $faculty_data = $result->fetch_assoc();
    echo json_encode(['success' => true, 'faculty_data' => $faculty_data]);
} else {
    echo json_encode(['success' => false, 'message' => 'Faculty not found']);
}

$stmt->close();
$conn->close();

