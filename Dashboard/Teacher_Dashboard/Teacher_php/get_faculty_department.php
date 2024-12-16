<?php
session_start();
include 'db_connect.php';
header('Content-Type: application/json');

if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit();
}

$faculty_id = $_SESSION['id'];

$query = "SELECT department FROM faculty WHERE faculty_id = '$faculty_id'";
$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    echo json_encode(['success' => true, 'department' => $row['department']]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error retrieving department']);
}
?>
