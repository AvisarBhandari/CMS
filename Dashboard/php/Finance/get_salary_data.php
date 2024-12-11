<?php
include '../db_connect.php';
$currentMonth = date('Y-m');
$response = [];
$query = "
    SELECT 
        SUM(CASE WHEN status = 'paid' THEN salary_amount ELSE 0 END) AS paid,
        SUM(CASE WHEN status = 'unpaid' THEN salary_amount ELSE 0 END) AS unpaid
    FROM salarytransactions
    WHERE DATE_FORMAT(month_year, '%Y-%m') = ?
";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $currentMonth);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $row = $result->fetch_assoc()) {
    $response = [
        'paid' => $row['paid'] ?? 0,
        'unpaid' => $row['unpaid'] ?? 0
    ];
}
$stmt->close();
$conn->close();
echo json_encode($response);
