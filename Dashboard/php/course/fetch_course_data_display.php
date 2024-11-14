<?php
include '../db_connect.php'; // Include the database connection

// Query to fetch all courses
$query = "SELECT * FROM courses";
$stmt = $conn->prepare($query);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    $courses = [];
    while ($row = $result->fetch_assoc()) {
        $courses[] = $row;
    }

    // Return the courses data as JSON
    echo json_encode(["status" => "success", "data" => $courses]);
} else {
    // Return error if the query fails
    echo json_encode(["status" => "error", "message" => "Error fetching data"]);
}

$stmt->close();
$conn->close();
?>
