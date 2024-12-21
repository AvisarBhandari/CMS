<?php
    session_start();
    include '../db_connect.php';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['exam_code'])) {
            $exam_code = $_POST['exam_code'];
            $exam_code = substr($exam_code, 1);
            
            $stmt = $conn->prepare("DELETE FROM exam_routine WHERE exam_code = ?");
            $stmt->bind_param("s", $exam_code);  
            
            if ($stmt->execute()) {
                $_SESSION['status'] = "success";
                $_SESSION['message'] = "Record deleted successfully";
                header("location: ../../Admin_Dashboard/exam.php");
                exit();
            } else {
                $_SESSION['status'] = "error";
                $_SESSION['message'] = "Something went wrong". $stmt->error;
                header("location: ../../Admin_Dashboard/exam.php");}
            
            $stmt->close();
        }
    }

    $conn->close();
?>
