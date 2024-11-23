<?php
include '../db_connect.php'; 

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "error", "message" => "Invalid request method."]);
    exit;
}

// Fetch current year
$current_year = date("Y");

// Sanitize input data using mysqli_real_escape_string to prevent SQL injection
$month = mysqli_real_escape_string($conn, $_POST['month']);
$earnings = mysqli_real_escape_string($conn, $_POST['earnings']);
$expenditures = mysqli_real_escape_string($conn, $_POST['expenditures']);
$record_id = mysqli_real_escape_string($conn, $_POST['record_id_hidden']);  // Fetch the record ID for the update

// Validate inputs
if (empty($month) || !is_numeric($earnings) || !is_numeric($expenditures)) {
    echo json_encode(["status" => "error", "message" => "Month, earnings, and expenditures are required and must be numbers."]);
    exit;
}

if ($earnings > 100000000 || $expenditures > 100000000) {
    echo json_encode(["status" => "error", "message" => "Earnings and Expenditures should not exceed 1 crore."]);
    exit;
}

// Check if the record exists for the provided ID
$query = "SELECT * FROM monthlyfinance WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $record_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo json_encode(["status" => "error", "message" => "Record not found."]);
    exit;
}

// Calculate net_balance
$net_balance = $earnings - $expenditures;

// Update the record in the database
$query = "UPDATE monthlyfinance SET month = ?, income = ?, expenditure = ?, net_balance = ? WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("sddsi", $month, $earnings, $expenditures, $net_balance, $record_id);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Record updated successfully."]);
} else {
    echo json_encode(["status" => "error", "message" => "Failed to update record."]);
}

$stmt->close();
$conn->close();

