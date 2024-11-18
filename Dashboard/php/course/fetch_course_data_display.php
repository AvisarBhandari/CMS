<?php
include '../db_connect.php'; 
$query = "SELECT * FROM courses";
$stmt = $conn->prepare($query);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    $courses = [];
    while ($row = $result->fetch_assoc()) {
        $courses[] = $row;
    }

    echo json_encode(["status" => "success", "data" => $courses]);
} else {
    echo json_encode(["status" => "error", "message" => "Error fetching data"]);
}

$stmt->close();
$conn->close();

