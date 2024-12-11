<?php
include ('db_connect.php');
// Start the session at the beginning of the script
session_start();

// Check if session variables are set
if (!isset($_SESSION['role']) || !isset($_SESSION['id']) || !isset($_SESSION['password'])) {
    echo "No data received.";
    exit();
}

// Retrieve data from session variables
$role = $_SESSION['role'];
$id = $_SESSION['id'];
$password = $_SESSION['password'];
$remember_me= $_SESSION['remember_me'];
// Initialize a variable to store user data
echo $role;
echo $id;
echo $password;
echo $remember_me;

if($remember_me){
    echo "Remember me is checked";
}
?>