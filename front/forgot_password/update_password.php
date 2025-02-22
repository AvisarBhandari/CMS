<?php
// Start the session to access session data (student_name and email)
session_start();

// Check if necessary session data and POST password are set
if (isset($_POST['password']) && isset($_SESSION['id']) && isset($_SESSION['email'])) {
    
    // Get the new password from the POST data
    $newPassword = $_POST['password'];

    // Validate password strength (optional but recommended)

    // Sanitize the password (although password_hash will handle most security)
    $newPassword = trim($newPassword);  // Remove any leading/trailing spaces
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);  // Hash the password for security

    // Include your database connection script
    include 'db_connect.php';

    $id = $_SESSION['id'];  
    $email = $_SESSION['email'];  
    $role = $_SESSION['role'];  
            // Prepare the SQL query to update the password in the 'login' table
            $updateQuery = "UPDATE login SET password = ? WHERE id = ? AND role = ?";
            $updateStmt = $conn->prepare($updateQuery);

            // Check if the query preparation failed
            if (!$updateStmt) {
                echo "Error preparing the update query: " . $conn->error;
            } else {
                // Bind the parameters and execute the update query
                $updateStmt->bind_param('sss', $hashedPassword, $id,$role);
                $updateStmt->execute();

                // Check if the password was updated successfully
                if ($updateStmt->affected_rows > 0) {
                    echo 'success'; 
                } else {
                    echo 'Error updating password or no rows affected'; // No rows affected, something went wrong
                }

                $updateStmt->close();
    } 

} else {
    // If the required POST data or session data is missing
    if (!isset($_POST['password'])) {
        echo 'Missing password in POST data';
    }

    if (!isset($_SESSION['id']) || !isset($_SESSION['email'])) {
        echo 'Missing session data (id or email)';
    }
}
?>
