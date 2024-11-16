<?php
include '../db_connect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $studentRoll = $_POST['student_roll'];
    if (empty($studentRoll)) {
        echo json_encode(['status' => 'error', 'message' => 'Student roll number is required.']);
        exit;
    }
    $sql = "DELETE FROM students_info WHERE student_roll = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $studentRoll);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Student deleted successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete student.']);
        }
        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Database error occurred.']);
    }
    $conn->close();
}

