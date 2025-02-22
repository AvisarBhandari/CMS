<?php
include '../db_connect.php';

$department_id = $_POST['department_id'];
$sql = "DELETE FROM department WHERE id='$department_id'";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo json_encode(["status" => "success", "message" => "Department deleted successfully."]);
} else {
    echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
}
?>
