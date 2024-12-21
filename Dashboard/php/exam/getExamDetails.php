<?php
include '../db_connect.php';
$sql = "SELECT * FROM exam_routine WHERE exam_code = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $exam_code);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $exam = $result->fetch_assoc();
    echo json_encode($exam);
} else {
    echo json_encode([]);
}

$stmt->close();
$conn->close();
?>