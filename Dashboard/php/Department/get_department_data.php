<?php
include '../db_connect.php';

$department_id = $_GET['department_id'];
$sql = "SELECT * FROM department WHERE id = '$department_id'";
$result = mysqli_query($conn, $sql);

if ($row = mysqli_fetch_assoc($result)) {
    echo json_encode(["status" => "success", "data" => $row]);
} else {
    echo json_encode(["status" => "error", "message" => "Department not found."]);
}
?>
