<?php
include '../db_connect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username_new = $_POST['username'];
    $phone_no = $_POST['phone_no'];
    $address = $_POST['address'];


    $_SESSION['username'] = $username;
    $_SESSION['id'] = $id;
    $_SESSION['role'] = $role;
    // Process the data, e.g., save to the database
    echo $id;
    echo $role;
    echo $username;
    echo $address;
    echo $phone_no;
    echo $username_new;
}
?>
