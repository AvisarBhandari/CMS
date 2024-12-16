<?php
include('db_connect.php');

$course_code = isset($_GET['course_code']) ? $_GET['course_code'] : '';

if ($course_code) {
    $query = "SELECT COUNT(*) as total_students FROM students_info WHERE course_code = '$course_code'";
    $result = mysqli_query($conn, $query);

    $row = mysqli_fetch_assoc($result);

    if ($row) {
        echo json_encode(['success' => true, 'total_students' => $row['total_students']]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No students found for this course']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Course code not provided']);
}

