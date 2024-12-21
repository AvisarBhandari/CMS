<?php
// Start the session to access session data (student_name and email)
session_start();

// Check if necessary session data and POST password are set
if (isset($_POST['password']) && isset($_SESSION['name']) && isset($_SESSION['email'])) {
    
    // Get the new password from the POST data
    $newPassword = $_POST['password'];

    // Validate password strength (optional but recommended)
    if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*?&]{8,}$/", $newPassword)) {
        echo "Password must be at least 8 characters long and include both letters and numbers.";
        exit;
    }

    // Sanitize the password (although password_hash will handle most security)
    $newPassword = trim($newPassword);  // Remove any leading/trailing spaces
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);  // Hash the password for security

    // Include your database connection script
    include 'db_connect.php';

    // Get student_name and email from session
    $studentName = $_SESSION['name'];  // Corrected to $_SESSION['name']
    $email = $_SESSION['email'];  // Get email from session
    
    // Prepare the SQL query to retrieve student_roll from students_info table
    $query = "SELECT student_roll FROM students_info WHERE student_name = ? AND email = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        // Bind parameters and execute the query
        $stmt->bind_param('ss', $studentName, $email);
        $stmt->execute();
        $stmt->store_result(); // This is important to clear the result set
        $stmt->bind_result($studentRoll);
        $stmt->fetch();  // Fetch the result
        
        // Check if we got a student_roll
        if ($studentRoll) {
            // Store student_roll in the session (optional but useful if you need it later)
            $_SESSION['student_roll'] = $studentRoll;
            
            // Prepare the SQL query to update the password in the 'login' table
            $updateQuery = "UPDATE login SET password = ? WHERE id = ? AND role = 'student'";
            $updateStmt = $conn->prepare($updateQuery);

            // Check if the query preparation failed
            if (!$updateStmt) {
                echo "Error preparing the update query: " . $conn->error;
            } else {
                // Bind the parameters and execute the update query
                $updateStmt->bind_param('ss', $hashedPassword, $studentRoll);
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
            echo 'Student not found'; // No student found with the given name and email
        }

        $stmt->close();
    } else {
        echo 'Error preparing the select query: ' . $conn->error; // Detailed error message for debugging
    }

    $conn->close(); // Close the database connection
} else {
    // If the required POST data or session data is missing
    if (!isset($_POST['password'])) {
        echo 'Missing password in POST data';
    }

    if (!isset($_SESSION['name']) || !isset($_SESSION['email'])) {
        echo 'Missing session data (student_name or email)';
    }
}
?>
