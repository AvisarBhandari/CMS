<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../db_connect.php';
$response = [];
if (isset($_POST['course']) && !empty($_POST['course'])) {
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $sql = "
        SELECT f.faculty_id, f.faculty_name
        FROM faculty f
        JOIN department d ON f.department = d.name
        JOIN courses c ON d.name = c.department_name
        WHERE c.course_code = '$course'
    ";

    if ($result = $conn->query($sql)) {
        if ($result->num_rows > 0) {
            $faculty = [];
            while ($row = $result->fetch_assoc()) {
                $faculty[] = $row;
            }
            $response['status'] = 'success';
            $response['data'] = $faculty;
        } else {
            $response['status'] = 'error';
            $response['message'] = 'No faculty found for the provided course code.';
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Failed to execute query: ' . $conn->error;
    }
} else {
 
    $response['status'] = 'error';
    $response['message'] = 'Course code not provided.';
}


$conn->close();


header('Content-Type: application/json');
echo json_encode($response);

