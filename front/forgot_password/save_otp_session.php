<?php
session_start();

if (isset($_POST['email']) && isset($_POST['otp']) && isset($_POST['name'])) {
    // Store the OTP and associated email in the session
    $_SESSION['otp'] = $_POST['otp'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['name'] = $_POST['name'];

    echo 'success';
} else {
    echo 'error';
}
?>
