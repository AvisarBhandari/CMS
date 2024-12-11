<?php
include '../db_connect.php';


$response = [];

// Query to fetch fee status and count for Paid and Pending statuses in the next six months
$fees_query = "
    SELECT 
        CASE 
            WHEN payment_date IS NOT NULL THEN 'Paid'
            WHEN payment_date IS NULL THEN 'Pending' 
        END AS status,
        COUNT(*) AS count
    FROM student_fees
    WHERE due_date BETWEEN CURDATE() AND CURDATE() + INTERVAL 6 MONTH
    GROUP BY status
";

$fees_result = $conn->query($fees_query);

// Initialize default counts for Paid and Pending fees
$response['fees'] = ['Paid' => 0, 'Pending' => 0];

if ($fees_result->num_rows > 0) {
    while ($row = $fees_result->fetch_assoc()) {
        $response['fees'][$row['status']] = $row['count'];
    }
}

// Fetch salary counts for Paid and Unpaid statuses for the current month
$salaries_query = "
    SELECT status, COUNT(*) AS count 
    FROM salarytransactions
    WHERE MONTH(month_year) = MONTH(CURDATE()) AND YEAR(month_year) = YEAR(CURDATE())
    GROUP BY status
";

$salaries_result = $conn->query($salaries_query);

// Initialize default counts for Paid and Unpaid salaries
$response['salaries'] = ['paid' => 0, 'unpaid' => 0];

if ($salaries_result->num_rows > 0) {
    while ($row = $salaries_result->fetch_assoc()) {
        $response['salaries'][$row['status']] = $row['count'];
    }
}

// Return the response as JSON
echo json_encode($response);

// Close the database connection
$conn->close();

