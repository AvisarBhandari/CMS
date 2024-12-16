<?php
include('db_connect.php');

$department = $_GET['department'];

$query = "SELECT course_code, course_name FROM courses WHERE department_name = '$department'";
$result = mysqli_query($conn, $query);

$courses = [];
while ($row = mysqli_fetch_assoc($result)) {
    $courses[] = $row;
}

if ($courses) {
    echo json_encode(['success' => true, 'courses' => $courses]);
} else {
    echo json_encode(['success' => false, 'message' => 'No courses found for this department']);
}

