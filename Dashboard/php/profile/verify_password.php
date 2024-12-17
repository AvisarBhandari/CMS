<?php
// Start the session
session_start();

// Include your database connection
include '../db_connect.php';

// Enable MySQLi error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Ensure the POST method is used
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if password is provided
    if (empty($_POST['password'])) {
        echo "error-1"; // Password is required
        exit();
    }
    
    $password = $_POST['password'];
    $username = isset($_SESSION['name']) ? $_SESSION['name'] : ''; // Ensure session variable is set
    $role = isset($_SESSION['role']) ? $_SESSION['role'] : '';
    $id = isset($_SESSION['id']) ? $_SESSION['id'] : '';
    
    // Check if session variables are set
    if (empty($username) || empty($role) || empty($id)) {
        echo "error-2"; // Session variables are not set or invalid
        exit();
    }

    // Use your actual database connection here
    // Check if the user exists and get the stored password
    $sql = "SELECT password FROM login WHERE name = ? AND role = ? AND id = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die('MySQL prepare error: ' . $conn->error); // More specific error for query preparation
    }

    // Bind parameters
    $stmt->bind_param("sss", $username, $role, $id);
    
    // Execute the query
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        // Bind the result to a variable
        $stmt->bind_result($stored_password);
        $stmt->fetch();
        
        // Verify the password
        if (password_verify($password, $stored_password)) {
            echo "success"; // Password is correct
        } else {
            echo "error-4"; // Password is incorrect
        }
    } else {
        echo "error-5"; // User not found in the database
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
}
?>
