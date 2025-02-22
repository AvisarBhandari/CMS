<?php
include '../db_connect.php';

$department_id = $_POST['department_id_hidden'];
$department_name = $_POST['department_name'];
$department_description = $_POST['department_description'];

$sql = "UPDATE department SET name='$department_name', description='$department_description' WHERE id='$department_id'";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo json_encode(["status" => "success", "message" => "Department updated successfully."]);
} else {
    echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
}
?>
