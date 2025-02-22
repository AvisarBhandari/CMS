<?php
session_start();
include('../db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $admin_id = $_POST['admin_id'];
    $admin_name = $_POST['admin_name'];
    $status = ($_POST['status'] == 'Active') ? 1 : 0;
    $address = $_POST['address'];
    $dob = $_POST['dob'];
    $start_date = $_POST['start_date'];
    $salary = $_POST['salary'];
    $phone_number = $_POST['phone_number'];

    // Validate input
    if (empty($admin_id) || empty($admin_name) || empty($dob) || empty($start_date) || empty($salary) || empty($phone_number)) {
        echo 'Please fill all required fields.';
        exit;
    }

    if (!preg_match("/^[0-9]{10}$/", $phone_number)) {
        echo 'Invalid phone number format.';
        exit;
    }

    if (!is_numeric($salary)) {
        echo 'Salary must be a valid number.';
        exit;
    }

    // Prepare and execute SQL statement
    $stmt = $conn->prepare("INSERT INTO admin (id, name, address, dob, start_date, salary, phone_number, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssi", $admin_id, $admin_name, $address, $dob, $start_date, $salary, $phone_number, $status);

    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'Error creating record: ' . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
