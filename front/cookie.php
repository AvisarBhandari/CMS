<?php
// Start the session to store the ID
session_start();

// Include the database connection
include('db_connect.php');

// Check if the cookie exists
if (isset($_COOKIE['login'])) {
    // Retrieve the cookie name and value
    $cookie_name = 'login';  // Replace with your actual cookie name
    $cookie_value = $_COOKIE[$cookie_name];

    // Check if the database connection was successful
    if ($conn) {
        // Prepare the SQL query to match the cookie value
        // Updated SQL query to select both id and name
        $sql = "SELECT id, name FROM cookie WHERE c_name = ? AND c_value = ? LIMIT 1";

        // Prepare the statement
        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind the parameters to the statement
            mysqli_stmt_bind_param($stmt, "ss", $cookie_name, $cookie_value);

            // Execute the statement
            mysqli_stmt_execute($stmt);

            // Bind the result to variables for both id and name
            mysqli_stmt_bind_result($stmt, $id, $name);

            // Check if a row was returned
            if (mysqli_stmt_fetch($stmt)) {
                // Store both id and name in the session
                $_SESSION['id'] = $id;
                $_SESSION['name'] = $name;

                // Assuming the first 3 characters of id represent the role
                $role = substr($id, 0, 3);

                // Check and echo based on the first 3 letters
                switch ($role) {
                    case 'ADM':
                        $_SESSION['role'] = 'admin';

                        header('Location: ../Dashboard/Admin_Dashboard'); // Uncomment to redirect after echo
                        break;
                    case 'TEA':
                        $_SESSION['role'] = 'faculty';
                        header('Location: ../Dashboard/Teacher_Dashboard');
                        exit;
                    case 'STU':
                        $_SESSION['role'] = 'student';
                        header('Location: ../Dashboard/Student_Dashboard');
                        exit;
                    default:
                        header('Location: Login.php');
                        exit;
                }
            } else {
                // If no row found, redirect to login
                header('Location: Login.php');
                exit;
            }

            // Close the prepared statement
            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing the query: " . mysqli_error($conn);
        }
    } else {
        // If the connection fails, redirect to login
        header('Location: Login.php');
        exit;
    }
} else {
    // If the cookie doesn't exist, redirect to login
    header('Location: Login.php');
    exit;
}

// Close the database connection
mysqli_close($conn);
?>
