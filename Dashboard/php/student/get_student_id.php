<?php
include('../db_connect.php');
$studentRoll = $_POST['student_roll'] ?? '';
if (!empty($studentRoll)) {
    $query = "SELECT student_id FROM students_info WHERE student_roll = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $studentRoll);
    $stmt->execute();
    $stmt->bind_result($studentId);

    if ($stmt->fetch()) {
        echo $studentId;
    } else {
        echo "Student not found.";
    }
    $stmt->close();
} else {
    echo "Student roll is missing.";
}

