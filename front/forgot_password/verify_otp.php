<?php
session_start();

if (isset($_POST['otp'])) {
    // OTP matched

if ($_POST['otp'] == $_SESSION['otp']) {
    echo 'success';
}else {
    
    echo $_POST['otp'];
    echo $_SESSION['otp'];
    // OTP did not match
    echo 'error';
}
}
?>
