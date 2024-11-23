<?php
include '../db_connect.php'; // Ensure this is your database connection file

// Get the record ID from the request
$id = $_GET['id'];  // Get record ID from URL parameter

// Query to fetch the finance record data
$query = "SELECT * FROM monthlyfinance WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);  // Bind the id parameter

if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $record = $result->fetch_assoc();
        echo json_encode([
            'status' => 'success',
            'data' => $record
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Record not found.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error fetching record.']);
}

$stmt->close();
$conn->close();
?>
