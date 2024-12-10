<?php
    include '../db_connect.php';


$currentMonth = date('Y-m-01'); 
$checkQuery = "SELECT COUNT(*) AS count FROM SalaryTransactions WHERE month_year = '$currentMonth'";
$checkResult = $conn->query($checkQuery);
$row = $checkResult->fetch_assoc();

if ($row['count'] == 0) {
    // Fetch all faculty
    $facultyQuery = "SELECT faculty_id, salary FROM Faculty";
    $facultyResult = $conn->query($facultyQuery);

    while ($faculty = $facultyResult->fetch_assoc()) {
        $facultyId = $faculty['faculty_id'];
        $salaryAmount = $faculty['salary'];
        $insertQuery = "INSERT INTO SalaryTransactions (faculty_id, month_year, status, salary_amount)
                        VALUES ('$facultyId', '$currentMonth', 'unpaid', '$salaryAmount')";
        $conn->query($insertQuery);
    }
    echo "Salary list generated for " . date('F Y');
} else {
    echo "Salary list for this month already exists.";
}
$conn->close();

