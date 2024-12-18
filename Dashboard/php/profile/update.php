<?php
include '../db_connect.php';
session_start();

// Check database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get input data from AJAX request
    if (!isset($_POST['username'], $_POST['phone_no'], $_POST['address'])) {
        echo "Missing data!";
        exit;
    }

    $username_new = $_POST['username'];
    $phone_no = $_POST['phone_no'];
    $address = $_POST['address'];

    $old_name = $_SESSION['name'];
    $id = $_SESSION['id'];
    $role = $_SESSION['role'];

    // Debugging: Print role and session values
    echo "Role: " . $role;  // Debugging role

    // Prepare response array
    $response = [];

    // Prepare query and bind parameters based on role
    if ($role == "admin") {
    echo "Processing admin update...";

    $query = "UPDATE admin SET name = ?, address = ?, phone_number = ? WHERE id = ?";
    $query2 = "UPDATE login SET name = ? WHERE id = ? AND role = ?";  // Updated column name
    
    if ($stmt = $conn->prepare($query)) {
        echo "Preparing query for admin...";

        $stmt->bind_param("ssss", $username_new, $address, $phone_no, $id);
        if ($stmt->execute()) {
            echo "Admin update executed successfully";

            // Second query to update login table
            if ($stmt2 = $conn->prepare($query2)) {
                $stmt2->bind_param("sss", $username_new, $id, $role);
                if ($stmt2->execute()) {
                    echo "Login update executed successfully";
                    $_SESSION['name'] = $username_new;
                    $response['status'] = "success";
                } else {
                    $response['status'] = "error";
                }
                $stmt2->close();
            } else {
                echo "Error preparing second query for login: " . $conn->error;
            }
        } else {
            $response['status'] = "error";
        }
        $stmt->close();
    } else {
        echo "Error preparing first query for admin: " . $conn->error;
    }
}

    elseif ($role == "student") {
        // Repeat similar debugging steps for student role
    } elseif ($role == "faculty") {
        // Repeat similar debugging steps for faculty role
    }

    // Return the response as JSON
    echo json_encode($response);
}
