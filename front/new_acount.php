<?php
session_start(); // Start the session at the top.

include('db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['name'])) {
        $name = $_POST['name'];  
    }

    if (isset($_POST['id'])) {
        $id = $_POST['id'];  
    }

    if (isset($_POST['phone'])) {
        $phone = $_POST['phone'];  
    }

    if (isset($_POST['address'])) {
        $email = $_POST['address'];  
    }

    if (isset($_POST['password'])) {
        $password = $_POST['password'];  
    }
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $role = substr($id, 0, 3);
    
    switch ($role) {
        case 'ADM':
            $role = 'admin';
            $sql = "SELECT * FROM admin WHERE name = '$name' AND id = '$id' AND phone_number = '$phone' ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Insert into the login table
                $insert_sql = "INSERT INTO login (id, role, name, password) VALUES ('$id', '$role', '$name', '$hashed_password')";
                if ($conn->query($insert_sql)) {
                    $_SESSION['status'] = "success";
                    $_SESSION['massage'] = "Account created successfully.";
                    header('Location: signup.php');
                    exit();
                } else {
                    $_SESSION['status'] = "error";
                    $_SESSION['error']= $conn->error;
                    $_SESSION['massage'] = "Error inserting data into login table.";
                    header('Location: signup.php');
                    exit();
                }
            }
                break;
        case 'TEA':
            $role = 'faculty';
            $sql = "SELECT * FROM faculty WHERE faculty_name = '$name' AND faculty_id = '$id' AND phone_number = '$phone'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Insert into the login table
                $insert_sql = "INSERT INTO login (id, role, name, password) VALUES ('$id', '$role', '$name', '$hashed_password')";
                if ($conn->query($insert_sql)) {
                    $_SESSION['status'] = "success";
                    $_SESSION['massage'] = "Account created successfully.";
                    header('Location: signup.php');
                    exit();
                } else {
                    $_SESSION['status'] = "error";
                    $_SESSION['massage'] = "Error inserting data into login table.";
                    $_SESSION['error']= $conn->error;
                    header('Location: signup.php');
                    exit();
                }
            } else {
                $_SESSION['status'] = "error";
                $_SESSION['massage'] = "Invalid faculty details.";
                $_SESSION['error']= $conn->error;
                header('Location: signup.php');
                exit();
            }

                            break;

        case $role= 'STU':
            $role = 'student';
            $sql = "SELECT * FROM students_info WHERE student_name = '$name' AND student_roll = '$id' AND phone_no = '$phone'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Insert into the login table
                $insert_sql = "INSERT INTO login (id, role, name, password) VALUES ('$id', '$role', '$name', '$hashed_password')";
                if ($conn->query($insert_sql) === TRUE) {
                    $_SESSION['status'] = "success";
                    $_SESSION['massage'] = "Account created successfully.";
                    header('Location: signup.php');
                    exit();
                } else {
                    $_SESSION['status'] = "error";
                    $_SESSION['massage'] = "Error inserting data into login table.";
                    $_SESSION['error']= $conn->error;
                    header('Location: signup.php');
                    exit();
                }
            } else {
                $_SESSION['status'] = "error";
                $_SESSION['massage'] = "Invalid student details.";
                $_SESSION['error']= $conn->error;
                header('Location: signup.php');
                exit();
            }
                break;

        default:
            $_SESSION['status'] = "error";
            $_SESSION['massage'] = "Please fill all the fields.";
            $_SESSION['error']= $conn->error;
            header('Location: signup.php');
            exit();
                            break;

    }
    
}
?>
