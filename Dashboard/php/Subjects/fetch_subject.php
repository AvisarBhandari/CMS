<?php
include '../db_connect.php';

$course_code = $_GET['course_code'];
$query = "SELECT * FROM subjects WHERE course_code = '$course_code'";
$result = mysqli_query($conn, $query);

$response = ['status' => 'error', 'data' => []];
if ($result) {
    $subjects = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $subjects[] = $row;
    }
    $response['status'] = 'success';
    $response['data'] = $subjects;
}

echo json_encode($response);
