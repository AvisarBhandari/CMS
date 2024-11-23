<?php
include '../db_connect.php'; 

// Get the record ID from the request
$record_id = $_POST['id'];

// Prepare and execute the SQL query to delete the record
$query = "DELETE FROM monthlyfinance WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $record_id);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Finance record deleted successfully."]);
} else {
    echo json_encode(["status" => "error", "message" => "Failed to delete finance record."]);
}

$stmt->close();
$conn->close();
?>
