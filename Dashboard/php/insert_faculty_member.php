<?php
// Include the database connection file
include 'db_connect.php';

// Set header for JSON response
header('Content-Type: application/json');

// Enable error reporting (optional, for debugging)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize form input data
    $faculty_id = mysqli_real_escape_string($conn, $_POST['faculty_id']);
    $faculty_name = mysqli_real_escape_string($conn, $_POST['faculty_name']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
    $salary = mysqli_real_escape_string($conn, $_POST['salary']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);

    // Prepare the SQL statement with placeholders for binding
    $sql = "INSERT INTO faculty (faculty_id, faculty_name, position, address, dob, start_date, salary, phone_number) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Initialize the prepared statement
    $stmt = mysqli_prepare($conn, $sql);

    // Check if the prepared statement was successfully created
    if ($stmt === false) {
        echo json_encode(['status' => 'error', 'message' => 'Failed to prepare statement']);
        exit;
    }

    // Bind the parameters to the prepared statement
    mysqli_stmt_bind_param(
        $stmt,
        'ssssssds', // Bind parameters (s for strings, d for decimal)
        $faculty_id,
        $faculty_name,
        $position,
        $address,
        $dob,
        $start_date,
        $salary,
        $phone_number
    );

    // Execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        // Return success message
        echo json_encode(['status' => 'success', 'message' => 'Faculty added successfully!']);
    } else {
        // Return error message with details
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . mysqli_stmt_error($stmt)]);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

// Close the database connection
mysqli_close($conn);



// SQl
// CREATE TABLE faculty (
//     faculty_id VARCHAR(13) PRIMARY KEY,
//     faculty_name VARCHAR(50) NOT NULL,
//     position VARCHAR(50) NOT NULL,
//     address VARCHAR(255) NOT NULL,
//     dob DATE NOT NULL,
//     start_date DATE NOT NULL,
//     salary DECIMAL(10,2) NOT NULL,
//     phone_number VARCHAR(10) NOT NULL,
//     created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
// );

