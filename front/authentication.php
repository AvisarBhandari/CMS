<?php
include('db_connect.php');
// Start the session at the beginning of the script
session_start();

// Check if session variables are set
if (!isset($_SESSION['role']) || !isset($_SESSION['id']) || !isset($_SESSION['password'])) {
    header('Location: Login.php');
    exit();
}

// Retrieve data from session variables
$role = $_SESSION['role'];
$id = $_SESSION['id'];
$password = $_SESSION['password'];
$remember_me = $_SESSION['remember_me'];

// Initialize a variable to store user data
$userData = null;

// Based on the role, query the appropriate table
if ($role == 'admin') {
    // Admin authentication
    $sql = "SELECT * FROM admin WHERE id = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $id, $password); // "ss" means two strings
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // User found, fetch the data
        $userData = $result->fetch_assoc();
        if ($remember_me) {
            $random_name = 'login';

            // Generate a random cookie value
            $random_value = bin2hex(random_bytes(10));

            // Set the cookie with the generated name and value
            setcookie($random_name, $random_value, time() + 3600, "/"); // Cookie expires in 1 hour

            // Prepare the SQL query to insert data into the 'cookie' table
            $sql = "INSERT INTO cookie (id, c_name, c_value) VALUES (?, ?, ?)";

            // Prepare the statement
            $stmt = $conn->prepare($sql);

            if ($stmt === false) {
                die("Error preparing the SQL statement: " . $conn->error);
            }

            // Bind the parameters to the prepared statement
            $stmt->bind_param("sss", $id, $random_name, $random_value); // "sss" means 3 string parameters

            // Execute the query to insert the data
            if ($stmt->execute() == false) {
                echo "Error inserting data into database: " . $stmt->error;
            }
        }
        // Redirect to Admin Dashboard
        header('Location: ../Dashboard/Admin_Dashboard');
        exit();
    } else {
        header('Location: Login.php');
        exit();
    }
}
if ($role == 'faculty') {
    // Faculty authentication
    $sql = "SELECT * FROM faculty WHERE faculty_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id); // "s" means a single string parameter
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // User found, fetch the data
        $userData = $result->fetch_assoc();

        // Verify the provided password with the hashed password in the database
        if (password_verify($password, $userData['password'])) {
            if ($remember_me) {
                $random_name = 'login';
                // Generate a random cookie value
                $random_value = bin2hex(random_bytes(10));

                // Set the cookie with the generated name and value
                setcookie($random_name, $random_value, time() + 3600, "/"); // Cookie expires in 1 hour

                // Prepare the SQL query to insert data into the 'cookie' table
                $sql = "INSERT INTO cookie (id, c_name, c_value) VALUES (?, ?, ?)";

                // Prepare the statement
                $stmt = $conn->prepare($sql);

                if ($stmt === false) {
                    die("Error preparing the SQL statement: " . $conn->error);
                }

                // Bind the parameters to the prepared statement
                $stmt->bind_param("sss", $id, $random_name, $random_value); // "sss" means 3 string parameters

                // Execute the query to insert the data
                if ($stmt->execute() == false) {
                    echo "Error inserting data into database: " . $stmt->error;
                }
            }
            // Redirect to Faculty Dashboard
            header('Location: ../Dashboard/Teacher_Dashboard');
            exit();
        } else {
            // Password verification failed
            header('Location: Login.php');
            exit();
        }
    } else {
        // User not found
        header('Location: Login.php');
        exit();
    }
}



if ($role == 'student') {
    // Student authentication
    $sql = "SELECT * FROM students_info WHERE student_roll = ?"; // Search by student_roll instead of student_id
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id); // "s" means a string
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // User found, fetch the data
        $userData = $result->fetch_assoc();
        
        // Verify the password
        if (password_verify($password, $userData['password'])) {
            if ($remember_me) {
                $random_name = 'login';
                // Generate a random cookie value
                $random_value = bin2hex(random_bytes(10));

                // Set the cookie with the generated name and value
                setcookie($random_name, $random_value, time() + 3600, "/"); // Cookie expires in 1 hour

                // Prepare the SQL query to insert data into the 'cookie' table
                $sql = "INSERT INTO cookie (id, c_name, c_value) VALUES (?, ?, ?)";

                // Prepare the statement
                $stmt = $conn->prepare($sql);

                if ($stmt === false) {
                    die("Error preparing the SQL statement: " . $conn->error);
                }

                // Bind the parameters to the prepared statement
                $stmt->bind_param("sss", $userData['student_id'], $random_name, $random_value); // Use student_id for cookie insertion

                // Execute the query to insert the data
                if ($stmt->execute() == false) {
                    echo "Error inserting data into database: " . $stmt->error;
                }
            }
            // Redirect to Student Dashboard
            header('Location: ../Dashboard/Student_Dashboard');
            exit();
        } else {
            // Password doesn't match
            header('Location: Login.php?error=invalid_credentials');
            exit();
        }
    } else {
        // No user found
        header('Location: Login.php?error=user_not_found');
        exit();
    }
}

// If none of the roles matched, show an error
header('Location: Login.php');
exit();
?>
