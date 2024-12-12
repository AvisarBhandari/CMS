<?php
// Assuming you have a database connection setup
include '../db_connect.php';

$query = "SELECT course_code, course_name FROM courses";
$result = mysqli_query($conn, $query);

$courses = [];
while ($row = mysqli_fetch_assoc($result)) {
    $courses[] = $row;
}

echo json_encode($courses);
?>
