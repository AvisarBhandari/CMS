
<?php
include '../db_connect.php';

$course = $_POST['course'];
$semester = $_POST['semester'];

$query = "SELECT subject_id, subject_name FROM subjects WHERE course_code = '$course' AND semester = $semester";
$result = $conn->query($query);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}
echo json_encode($data);
?>
