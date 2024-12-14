<?php
session_start();
include 'db_connect.php';
header('Content-Type: application/json');

$response = ['success' => false, 'error' => ''];

// Retrieve and sanitize inputs
$role = $_POST['role'] ?? '';
$id = $_POST['id'] ?? '';
$password = $_POST['password'] ?? '';
$remember_me = isset($_POST['remember-me']);

// Validate input
$allowed_roles = ['admin', 'faculty', 'student'];
if (!in_array($role, $allowed_roles)) {
    $response['error'] = 'Invalid role selected.';
    echo json_encode($response);
    exit();
}

if (empty($id) || empty($password)) {
    $response['error'] = 'Please enter both ID and password.';
    echo json_encode($response);
    exit();
}

// Prepare and execute query
$query = "SELECT * FROM login WHERE id = ? AND role = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $id, $role);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Verify password
    if (password_verify($password, $user['password'])) {
        // Successful login
        $_SESSION['id'] = $user['id'];
        $_SESSION['role'] = $user['role'];

        // Regenerate session ID for security
        session_regenerate_id(true);

        // Handle "Remember Me" functionality
        if ($remember_me) {
            $cookie_name = 'login';
            $cookie_value = bin2hex(random_bytes(16)); // Generate a secure random value

            // Delete old cookie if exists
            $delete_cookie_query = "DELETE FROM cookie WHERE c_name = ? AND id = ?";
            $delete_cookie_stmt = $conn->prepare($delete_cookie_query);
            $delete_cookie_stmt->bind_param("ss", $cookie_name, $id);
            $delete_cookie_stmt->execute();

            // Insert new cookie
            $insert_cookie_query = "INSERT INTO cookie (id, c_name, c_value) VALUES (?, ?, ?)";
            $insert_cookie_stmt = $conn->prepare($insert_cookie_query);
            $insert_cookie_stmt->bind_param("sss", $id, $cookie_name, $cookie_value);
            $insert_cookie_stmt->execute();

            // Set the cookie with security flags
            setcookie($cookie_name, $cookie_value, [
                'expires' => time() + (30 * 24 * 60 * 60), // 30 days
                'path' => '/',
                'secure' => true, // Use HTTPS
                'httponly' => true, // Prevent JavaScript access
                'samesite' => 'Strict' // Mitigate CSRF
            ]);
        }

        // Redirect based on role
        $redirect_url = '';
        switch ($role) {
            case 'admin':
                $redirect_url = '../Dashboard/Admin_Dashboard';
                break;
            case 'faculty':
                $redirect_url = '../Dashboard/Teacher_Dashboard';
                break;
            case 'student':
                $redirect_url = '../Dashboard/Student_Dashboard';
                break;
        }

        $response['success'] = true;
        $response['redirect'] = $redirect_url;
    } else {
        $response['error'] = 'Invalid login credentials.';
    }
} else {
    $response['error'] = 'Invalid login credentials.';
}

$stmt->close();
$conn->close();

echo json_encode($response);
?>
