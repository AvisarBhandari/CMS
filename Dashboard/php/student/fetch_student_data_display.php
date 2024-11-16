<?php
header('Content-Type: application/json'); 


include "../db_connect.php";

try {
   
    $query = "SELECT student_roll, student_name, gender, email, department_name, course_code, phone_no, semester, dob, admission_date, parent_name, address FROM students_info";
    $result = $conn->query($query);

    if (!$result) {
        throw new Exception("Database Query Error: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        $students = [];
        while ($row = $result->fetch_assoc()) {
            $students[] = $row;
        }
        echo json_encode(['status' => 'success', 'data' => $students]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No students found.']);
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
} finally {
    $conn->close();
}

