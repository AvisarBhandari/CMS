<?php
include '../db_connect.php'; 


$searchQuery = isset($_GET['searchQuery']) ? trim($_GET['searchQuery']) : "";


$query = "SELECT * FROM courses";

if (!empty($searchQuery)) {
    $query .= " WHERE course_code LIKE ? OR course_name LIKE ?";
}


$stmt = $conn->prepare($query);


if (!empty($searchQuery)) {
    $likeSearchQuery = '%' . $searchQuery . '%';
    $stmt->bind_param("ss", $likeSearchQuery, $likeSearchQuery);
}



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
