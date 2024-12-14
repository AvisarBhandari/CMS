<?php
include '../db_connect.php';
$query = "SELECT course_code, course_name FROM courses";
$result = mysqli_query($conn, $query);
if ($result) {
    $courses = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $courses[] = $row;
    }
    echo json_encode(['status' => 'success', 'data' => $courses]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to fetch courses.']);
}
mysqli_close($conn);

