<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $phone_no = $_POST['phone_no'];
    $address = $_POST['address'];

    // Process the data, e.g., save to the database
    echo $address;
    echo $phone_no;
    echo $username;
}
?>
