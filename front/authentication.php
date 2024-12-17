<!-- Authentication -->
<?php
include('db_connect.php');


// Start session to manage login state
session_start();

// Retrieve form data
$id = $_SESSION['id']; // User id (or username)
$role = $_SESSION['role']; // User role
if(isset( $_SESSION['remember_me'])){
    
    $remember_me = 'true';
}else{
    $remember_me = 'false';
} 


// Check if user exists and password is correct

$query = "SELECT * FROM login WHERE id = ? AND role = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $id, $role);  // Note we don't bind the password here anymore
$stmt->execute();
$result = $stmt->get_result();
    echo $id;

if ($result->num_rows > 0) {
    // User credentials are valid
    $user = $result->fetch_assoc();

    // Now verify the password using password_verify
    
    if (password_verify($_SESSION['password'], $user['password'])) {
        // Password is correct
        
        $_SESSION['id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['name']=$user['name'];
        $name=$user['name'];

        // Optionally, set a 'remember me' feature if applicable
        if ($remember_me=='true') {
            // Generate a random value for the cookie
            $cookie_value = bin2hex(random_bytes(16)); // Generate a random 32 character string
            $cookie_name = 'login';
            
            // Check if a cookie already exists for the user
            $cookie_check_query = "SELECT * FROM cookie WHERE c_name = 'login' AND id = ?";
            $cookie_check_stmt = $conn->prepare($cookie_check_query);
            $cookie_check_stmt->bind_param("s", $id);
            $cookie_check_stmt->execute();
            $cookie_check_result = $cookie_check_stmt->get_result();
            
            if ($cookie_check_result->num_rows > 0) {
                // Delete the old cookie if it exists
                $delete_cookie_query = "DELETE FROM cookie WHERE c_name = 'login' AND id = ?";
                $delete_cookie_stmt = $conn->prepare($delete_cookie_query);
                $delete_cookie_stmt->bind_param("s", $id);
                $delete_cookie_stmt->execute();
            }
            
            // Insert new cookie record into cookie table
            $insert_cookie_query = "INSERT INTO cookie (id, c_name, c_value, name) VALUES (?, ?, ?,?)";
            $insert_cookie_stmt = $conn->prepare($insert_cookie_query);
            $insert_cookie_stmt->bind_param("ssss", $id, $cookie_name, $cookie_value, $name);
            $insert_cookie_stmt->execute();
            
            // Set the cookie in the user's browser for 30 days
            setcookie("login", $cookie_value, time() + (30 * 24 * 60 * 60), "/"); // Expires in 30 days
        }

        // Redirect or continue the session
        if ($role == 'admin') {
    header('Location: ../Dashboard/Admin_Dashboard');
    }

    if ($role == 'faculty') {
        header('Location: ../Dashboard/Teacher_Dashboard');
    }

    if ($role == 'student') {
        header('Location: ../Dashboard/Student_Dashboard');
    } // Example: redirect to the user dashboard
        exit();
    } else {
        $_SESSION['status'] = "error";
        $_SESSION['message'] = "Invalid password!";
        header('Location: Login.php');
    }
} else {
    $_SESSION['status'] = "error";
    $_SESSION['message'] = "No such user found!";
    header('Location: Login.php');

}

$stmt->close();
$conn->close();
?>


