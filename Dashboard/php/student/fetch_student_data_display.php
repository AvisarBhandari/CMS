<?php
header('Content-Type: application/json'); 

include "../db_connect.php";

try {
  
    $searchQuery = isset($_GET['searchQuery']) ? trim($_GET['searchQuery']) : '';

    
    $query = "SELECT student_roll, student_name, gender, email, department_name, course_code, phone_no, semester, dob, admission_date, parent_name, address FROM students_info";

   
    if (!empty($searchQuery)) {
        $query .= " WHERE student_roll LIKE ? OR student_name LIKE ?";
    }

  
    $stmt = $conn->prepare($query);

    if (!empty($searchQuery)) {
        $likeQuery = '%' . $searchQuery . '%';
        $stmt->bind_param("ss", $likeQuery, $likeQuery);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $students = [];
        while ($row = $result->fetch_assoc()) {
            $students[] = $row;
        }
        echo json_encode(['status' => 'success', 'data' => $students]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No students found matching the search criteria.']);
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
} finally {
    $conn->close();
}
