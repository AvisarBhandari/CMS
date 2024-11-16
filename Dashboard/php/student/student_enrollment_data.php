<?php
header('Content-Type: application/json');
include "../db_connect.php";

try {
    // Query to fetch student enrollments grouped by month for the past 12 months
    $query = "
        SELECT 
            DATE_FORMAT(admission_date, '%b') AS month, 
            COUNT(*) AS enrollment_count
        FROM 
            students_info
        WHERE 
            admission_date >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH)
        GROUP BY 
            DATE_FORMAT(admission_date, '%Y-%m')
        ORDER BY 
            DATE_FORMAT(admission_date, '%Y-%m') ASC
    ";

    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    $enrollmentData = [];
    while ($row = $result->fetch_assoc()) {
        $enrollmentData[$row['month']] = (int)$row['enrollment_count'];
    }

    // Generate an array of months for the past 12 months
    $months = [];
    for ($i = 11; $i >= 0; $i--) {
        $months[] = date("M", strtotime("-$i month"));
    }

    // Prepare the data for the chart
    $chartData = [
        'labels' => $months,
        'data' => array_map(function ($month) use ($enrollmentData) {
            return $enrollmentData[$month] ?? 0;
        }, $months)
    ];

    echo json_encode(['status' => 'success', 'chartData' => $chartData]);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
} finally {
    $conn->close();
}
