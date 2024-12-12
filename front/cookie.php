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
        $sql = "SELECT id FROM cookie WHERE c_name = ? AND c_value = ? LIMIT 1";
        
        // Prepare the statement
        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind the parameters to the statement
            mysqli_stmt_bind_param($stmt, "ss", $cookie_name, $cookie_value);

            // Execute the statement
            mysqli_stmt_execute($stmt);

            // Bind the result to a variable
            mysqli_stmt_bind_result($stmt, $id);

            // Check if a row was returned
            if (mysqli_stmt_fetch($stmt)) {
                // Store the ID in the session
                $_SESSION['id'] = $id;
                
                $role = substr($id, 0, 3);

// Check and echo based on the first 3 letters
switch($role) {
    case 'ADM':
        header('Location: ../Dashboard/Admin_Dashboard');
        break;
    case 'TEA':
        header('Location: ../Dashboard/Teacher_Dashboard');
        break;
    case 'STU':
        header('Location: ../Dashboard/Student_Dashboard');
        break;
    default:
        header('Location: Login.php');
}

            } else {
                header('Location: Login.php');
            }

            // Close the prepared statement
            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing the query: " . mysqli_error($conn);
        }
    } else {
        header('Location: Login.php');
    }
} else {
    header('Location: Login.php');
}

// Close the database connection
mysqli_close($conn);
?>
