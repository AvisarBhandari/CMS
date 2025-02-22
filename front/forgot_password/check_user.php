<?php
// Database connection (using MySQLi)
session_start();
include 'db_connect.php'; // This file should contain the database connection logic

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['name'];
    $email = $_POST['email'];

    $_SESSION['id'] = $id;
    $role = substr($id, 0, 3);
     switch ($role) {
        case 'ADM':
            $role = 'admin';
            break;
        case 'TEA':
            $role = 'faculty';
            break;
        case 'STU':
            $role = 'student';
            break;
        default:
            $role = '';
    }
    $_SESSION['role'] = $role;
    // Prepare the SQL query to check if name and email exist
    $sql = "SELECT * FROM login WHERE id = ? AND email = ?";

    // Initialize MySQLi statement
    $stmt = $conn->prepare($sql); // Assuming $conn is the MySQLi connection from 'db_connect.php'

    if ($stmt === false) {
        // Handle error in case prepare fails
        echo 'Failed to prepare the query.';
        exit;
    }

    // Bind parameters
    $stmt->bind_param("ss", $id, $email); // 'ss' means two string parameters

    // Execute the statement
    $stmt->execute();

    // Store the result
    $stmt->store_result();

    // Check if any row was found
    if ($stmt->num_rows > 0) {
        // If a match is found, send 'match' response
        echo 'match';
    } else {
        // If no match found, send 'no match' response
        echo 'no match';
    }

    // Close the statement
    $stmt->close();
} else {
    echo 'Invalid request method.';
}
?>
