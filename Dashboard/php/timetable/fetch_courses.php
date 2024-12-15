
<?php
include '../db_connect.php';

$query = "SELECT course_code, course_name FROM courses";
$result = $conn->query($query);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}
echo json_encode($data);
?>
