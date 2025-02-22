<?php
include '../db_connect.php';

$department_name = $_POST['department_name'];
$department_description = $_POST['department_description'];

$sql = "INSERT INTO department(name, description) VALUES ('$department_name', '$department_description')";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo json_encode(["status" => "success", "message" => "Department added successfully."]);
} else {
    echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
}
?>
