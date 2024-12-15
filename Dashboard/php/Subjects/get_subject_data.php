<?php
include '../db_connect.php';

$subject_id = $_GET['subject_id'];
$query = "SELECT * FROM subjects WHERE subject_id = '$subject_id'";
$result = mysqli_query($conn, $query);

$response = ['status' => 'error', 'data' => []];
if ($result && mysqli_num_rows($result) > 0) {
    $response['status'] = 'success';
    $response['data'] = mysqli_fetch_assoc($result);
}

echo json_encode($response);
