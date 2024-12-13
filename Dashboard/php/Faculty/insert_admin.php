<?php
// Assuming you have already connected to your database
include('../db_connect.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $admin_id = $_POST['admin_id'];
    $admin_name = $_POST['admin_name'];
    $status = ($_POST['status'] == 'Active') ? 1 : 0; // Convert Active/Inactive to 1/0
    $address = $_POST['address'];
    $dob = $_POST['dob'];
    $start_date = $_POST['start_date'];
    $salary = $_POST['salary'];
    $phone_number = $_POST['phone_number'];

    // Validate input (simple checks)
    if (empty($admin_id) || empty($admin_name) || empty($dob) || empty($start_date) || empty($salary) || empty($phone_number)) {
        $_SESSION['status'] = "error";
        $_SESSION['massage'] = "Please fill all required fields.";
                        header('Location: /Academy Keeper/Dashboard/Admin_Dashboard/faculty.php');



        exit;
    }

    // Sanitize phone number to avoid invalid characters
    if (!preg_match("/^[0-9]{10,15}$/", $phone_number)) {
        $_SESSION['status'] = "error";
        $_SESSION['massage'] = "Invalid phone number format.";
                        header('Location: /Academy Keeper/Dashboard/Admin_Dashboard/faculty.php');



        exit;
    }

    // Validate salary as a number
    if (!is_numeric($salary)) {
        $_SESSION['status'] = "error";
        $_SESSION['massage'] = "Salary must be a valid number.";
                        header('Location: /Academy Keeper/Dashboard/Admin_Dashboard/faculty.php');



        exit;
    }

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO admin (id, name, address, dob, start_date, salary, phone_number, status) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    // Check if the statement was prepared correctly
    if ($stmt === false) {
        $_SERVER['status'] = "error";
        $_SERVER['massage'] = "Error preparing the SQL statement.";
                        header('Location: /Academy Keeper/Dashboard/Admin_Dashboard/faculty.php');



        exit;
    }

    // Bind parameters to the prepared statement
    $stmt->bind_param("sssssssi", $admin_id, $admin_name, $address, $dob, $start_date, $salary, $phone_number, $status);

    // Execute the statement
    if ($stmt->execute()) {
        $_SESSION['status'] = "success";
        $_SESSION['massage'] = "New record created successfully.";
            header('Location: /Academy Keeper/Dashboard/Admin_Dashboard/faculty.php');


    } else {
        $_SESSION['status'] = "error";
        $_SESSION['massage'] = "Error creating record: " . $stmt->error;
        header('Location: /Academy Keeper/Dashboard/Admin_Dashboard/faculty.php');

    }

    // Close the statement and the connection
    $stmt->close();
    $conn->close();
}
?>
