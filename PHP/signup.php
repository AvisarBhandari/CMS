<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Start output buffering
    ob_start();
    echo '<!DOCTYPE html>';
    echo '<html lang="en">';
    echo '<head>';
    echo '<meta charset="UTF-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<title>User Information</title>';
    echo '<style>';
    echo 'body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px; }';
    echo '.container { max-width: 600px; margin: 0 auto; background: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }';
    echo 'h2 { color: #333; }';
    echo 'p { margin: 5px 0; }';
    echo '.error { color: red; font-weight: bold; }';
    echo '.success { color: green; font-weight: bold; }';
    echo '</style>';
    echo '</head>';
    echo '<body>';
    echo '<div class="container">';
    echo '<h2>User Information</h2>';

    // Display user input
    echo '<p><strong>First Name:</strong> ' . htmlspecialchars($_POST['first_name']) . '</p>';
    echo '<p><strong>Last Name:</strong> ' . htmlspecialchars($_POST['last_name']) . '</p>';
    echo '<p><strong>ID:</strong> ' . htmlspecialchars($_POST['id']) . '</p>';
    echo '<p><strong>Phone:</strong> ' . htmlspecialchars($_POST['phone']) . '</p>';
    echo '<p><strong>College:</strong> ' . htmlspecialchars($_POST['college']) . '</p>';
    echo '<p><strong>Password:</strong> ' . htmlspecialchars($_POST['password']) . '</p>';
    echo '</div>';
    echo '</body>';
    echo '</html>';
    ob_flush();
}

$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$id = $_POST['id'];
$phone = $_POST['phone'];
$college = $_POST['college'];
$password = $_POST['password'];

// Sanitize inputs to prevent SQL injection
$college = strtolower($conn->real_escape_string($college)); 

// Check if the college database exists
$db_check_query = "SHOW DATABASES LIKE '$college'";
$result = $conn->query($db_check_query);

if ($result->num_rows == 0) {
    // Database doesn't exist, create it using the sanitized user input for college
    $create_db_query = "CREATE DATABASE `$college`"; // Use dynamic database name
    if ($conn->query($create_db_query) === TRUE) {
        echo '<div class="container"><p class="success">Database created successfully for ' . htmlspecialchars($college) . '.</p></div>';
        $conn->select_db($college);
    } else {
        die('<div class="container"><p class="error">Error creating database: ' . $conn->error . '</p></div>');
    }
} else {
    // Select the existing database
    $conn->select_db($college);
}

// Determine the table name based on user ID prefix (TEA for Teacher, STU for Student, ADM for Admin)
$table_name = '';
if (strpos($id, 'TEA') === 0) {
    $table_name = 'teachers';
} elseif (strpos($id, 'STU') === 0) {
    $table_name = 'students';
} elseif (strpos($id, 'ADM') === 0) {
    $table_name = 'admins';
} else {
    die('<div class="container"><p class="error">Invalid ID format.</p></div>');
}

// Check if the relevant table exists
$table_check_query = "SHOW TABLES LIKE '$table_name'";
$table_result = $conn->query($table_check_query);

if ($table_result->num_rows == 0) {
    // Create the same table structure for all roles
    $create_table_query = "CREATE TABLE $table_name (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        first_name VARCHAR(30) NOT NULL,
        last_name VARCHAR(30) NOT NULL,
        user_id VARCHAR(50) NOT NULL UNIQUE,
        phone VARCHAR(15) NOT NULL,
        password VARCHAR(255) NOT NULL
    )";
    
    // Execute table creation query
    if ($conn->query($create_table_query) !== TRUE) {
        die('<div class="container"><p class="error">Error creating table: ' . $conn->error . '</p></div>');
    }
    echo '<div class="container"><p class="success">Table \'' . htmlspecialchars($table_name) . '\' created successfully.</p></div>';
} else {
    echo '<div class="container"><p class="success">Table \'' . htmlspecialchars($table_name) . '\' already exists.</p></div>';
}

// Hash the password before storing it
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare an insert query using a prepared statement to avoid SQL injection
$insert_query = "INSERT INTO $table_name (first_name, last_name, user_id, phone, password) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($insert_query);
$stmt->bind_param("sssss", $first_name, $last_name, $id, $phone, $hashed_password);

// Execute the query
if ($stmt->execute()) {
    echo '<div class="container"><p class="success">New record created successfully in ' . htmlspecialchars($table_name) . '.</p></div>';
} else {
    echo '<div class="container"><p class="error">Error: ' . $stmt->error . '</p></div>';
}

// Close the statement and connection
$stmt->close();
$conn->close();


