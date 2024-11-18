<?php
header('Content-Type: application/json'); 


include "../db_connect.php"; 


if (isset($_POST['roll_no'])) {
    $roll_no = $_POST['roll_no'];

    try {
      
        $query = "SELECT student_roll, student_name, gender, email, department_name, course_code, phone_no, dob, admission_date, parent_name, address, student_id
                  FROM students_info
                  WHERE student_roll = ?"; 

        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $roll_no); 
        $stmt->execute();

        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $student = $result->fetch_assoc();
            echo json_encode(['status' => 'success', 'data' => $student]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Student not found.']);
        }
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    } finally {
        $conn->close();
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Roll number is required.']);
}

