<?php
include '../db_connect.php';

$subject_id = $_POST['subject_id'];
$query = "DELETE FROM subjects WHERE subject_id = '$subject_id'";

$response = ['status' => 'error', 'message' => 'Failed to delete subject.'];
if (mysqli_query($conn, $query)) {
    $response['status'] = 'success';
    $response['message'] = 'Subject deleted successfully.';
}

echo json_encode($response);
