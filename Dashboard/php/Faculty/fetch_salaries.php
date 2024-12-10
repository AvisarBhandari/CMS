<?php
include '../db_connect.php';

$currentMonth = date('Y-m-01');

$query = "SELECT ST.id, F.faculty_id, F.faculty_name,F.department, ST.salary_amount, ST.status
          FROM SalaryTransactions ST
          JOIN Faculty F ON ST.faculty_id = F.faculty_id
          WHERE ST.month_year = '$currentMonth'";

$result = $conn->query($query);

$salaries = [];
while ($row = $result->fetch_assoc()) {
    $salaries[] = $row;
}

echo json_encode($salaries); 
$conn->close();

