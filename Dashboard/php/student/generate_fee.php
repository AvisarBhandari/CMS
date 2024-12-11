<?php
include '../db_connect.php';

// Generate fee payment list for all students
$sql = "SELECT s.student_id, c.course_fee, s.admission_date 
        FROM students_info s 
        JOIN courses c ON s.course_code = c.course_code";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $student_id = $row['student_id'];
        $course_fee = $row['course_fee'];
        $admission_date = $row['admission_date']; // Get the student's admission date
        $installment_amount = $course_fee / 8;

        // Calculate the first installment's due date (6 months after the admission date)
        $first_due_date = date('Y-m-d', strtotime("+6 months", strtotime($admission_date))); 

        // Create 8 installments (1 for every 6 months)
        for ($i = 1; $i <= 8; $i++) {
            // For the first installment, use the first_due_date
            if ($i == 1) {
                $due_date = $first_due_date;
            } else {
                // For subsequent installments, add 6 months for each installment
                $due_date = date('Y-m-d', strtotime("+".(($i-1) * 6)." months", strtotime($first_due_date)));
            }

            $check_sql = "SELECT * FROM student_fees WHERE student_id = $student_id AND installment_no = $i";
            $check_result = $conn->query($check_sql);

            if ($check_result->num_rows == 0) {
                $insert_sql = "INSERT INTO student_fees (student_id, due_date, installment_no, amount) 
                               VALUES ($student_id, '$due_date', $i, $installment_amount)";
                $conn->query($insert_sql);
            }
        }
    }
}

echo "Fee records generated successfully."; // This can be an optional message or left empty
?>
