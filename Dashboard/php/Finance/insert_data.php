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

// Validate inputs
if (empty($month) || !is_numeric($earnings) || !is_numeric($expenditures)) {
    echo json_encode(["status" => "error", "message" => "Month, earnings, and expenditures are required and must be numbers."]);
    exit;
}

if ($earnings > 100000000 || $expenditures > 100000000) {
    echo json_encode(["status" => "error", "message" => "Earnings and Expenditures should not exceed 1 crore."]);
    exit;
}

// Check if a record for the same month already exists for the current year
$query = "SELECT * FROM monthlyfinance WHERE year = ? AND month = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("is", $current_year, $month);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode(["status" => "error", "message" => "Record for this month already exists."]);
    exit;
}

// Calculate net_balance
$net_balance = $earnings - $expenditures;

// Insert the record into the database
$query = "INSERT INTO monthlyfinance (year, month, income, expenditure, net_balance) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("isdds", $current_year, $month, $earnings, $expenditures, $net_balance);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Record added successfully."]);
} else {
    echo json_encode(["status" => "error", "message" => "Failed to add record."]);
}

$stmt->close();
$conn->close();
?>
