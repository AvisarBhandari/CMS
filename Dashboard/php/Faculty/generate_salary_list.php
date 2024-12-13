<?php
include '../db_connect.php';

$currentMonth = date('Y-m-01'); 

// Fetch all faculty members
$facultyQuery = "SELECT faculty_id, salary FROM Faculty";
$facultyResult = $conn->query($facultyQuery);

$generatedCount = 0;
while ($faculty = $facultyResult->fetch_assoc()) {
    $facultyId = $faculty['faculty_id'];
    $salaryAmount = $faculty['salary'];
    
    // Check if salary entry exists for this faculty member for the current month
    $checkFacultyQuery = "SELECT COUNT(*) AS count FROM SalaryTransactions 
                          WHERE faculty_id = '$facultyId' AND month_year = '$currentMonth'";
    $checkFacultyResult = $conn->query($checkFacultyQuery);
    $facultyRow = $checkFacultyResult->fetch_assoc();

    if ($facultyRow['count'] == 0) {
        // Insert salary transaction for this faculty member
        $insertQuery = "INSERT INTO SalaryTransactions (faculty_id, month_year, status, salary_amount)
                        VALUES ('$facultyId', '$currentMonth', 'unpaid', '$salaryAmount')";
        $conn->query($insertQuery);
        $generatedCount++;
    }
}

if ($generatedCount > 0) {
    echo "Salary list updated with $generatedCount new records for " . date('F Y');
} else {
    echo "No new salary records added. All faculty salaries for this month are already recorded.";
}

$conn->close();
