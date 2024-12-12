<?php
include '../db_connect.php';

$response = [];

$fees_query = "
    SELECT 
        CASE 
            WHEN payment_date IS NOT NULL THEN 'Paid'
            WHEN payment_date IS NULL THEN 'Pending' 
        END AS status,
        SUM(CASE 
                WHEN payment_date IS NOT NULL THEN paid_amount 
                ELSE amount 
            END) AS total_amount
    FROM student_fees
    WHERE due_date BETWEEN CURDATE() AND CURDATE() + INTERVAL 6 MONTH
    GROUP BY status
";

$fees_result = $conn->query($fees_query);

$response['fees'] = ['Paid' => 0, 'Pending' => 0];

if ($fees_result->num_rows > 0) {
    while ($row = $fees_result->fetch_assoc()) {
        $response['fees'][$row['status']] = $row['total_amount'];
    }
}


echo json_encode($response);

$conn->close();
?>
