<?php
include '../db_connect.php';

// Fetch records for the next 6 months starting from the current date
$current_date = date('Y-m-d');
$start_date = $current_date; // Start from today
$end_date = date('Y-m-d', strtotime("+6 months", strtotime($current_date))); // End 6 months from today

// Fetch fee records
$fee_records_sql = "SELECT s.student_roll, s.student_name, f.installment_no, f.due_date, f.amount, f.status, f.student_id 
                    FROM student_fees f 
                    JOIN students_info s ON f.student_id = s.student_id 
                    WHERE f.due_date BETWEEN '$start_date' AND '$end_date'";

$fee_result = $conn->query($fee_records_sql);

if ($fee_result->num_rows > 0) {
    while ($row = $fee_result->fetch_assoc()) {
        
        if ($row['status'] === 'Paid') {
            
            echo "<tr>
                    <td>{$row['student_roll']}</td>
                    <td>{$row['student_name']}</td>
                    <td>{$row['installment_no']}</td>
                    <td>{$row['due_date']}</td>
                    <td>{$row['amount']}</td>
                    <td>{$row['status']}</td>
                    <td><button class='btn btn-danger unmark-as-pay' 
                                data-student_id='{$row['student_id']}' 
                                data-installment_no='{$row['installment_no']}' 
                                data-amount='{$row['amount']}'
                                data-student_roll='{$row['student_roll']}' 
                                data-student_name='{$row['student_name']}'>Unmark Pay</button>
                    </td>
                  </tr>";
        } else {
            
            echo "<tr>
                    <td>{$row['student_roll']}</td>
                    <td>{$row['student_name']}</td>
                    <td>{$row['installment_no']}</td>
                    <td>{$row['due_date']}</td>
                    <td>{$row['amount']}</td>
                    <td>{$row['status']}</td>
                    <td><button class='btn btn-primary mark-as-pay' 
                                data-student_id='{$row['student_id']}' 
                                data-installment_no='{$row['installment_no']}' 
                                data-amount='{$row['amount']}'
                                data-student_roll='{$row['student_roll']}' 
                                data-student_name='{$row['student_name']}'>Mark as Pay</button>
                    </td>
                  </tr>";
        }
    }
} else {
    echo "<tr><td colspan='7'>No fee records found for the current period.</td></tr>";
}

