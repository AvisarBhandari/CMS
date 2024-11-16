<?php
header('Content-Type: application/json');
include "../db_connect.php"; // Ensure the correct DB connection file is included.

try {
    // Fetch department names and corresponding enrollment counts
    $query = "
        SELECT 
            d.name AS department_name, 
            COALESCE(COUNT(s.student_id), 0) AS enrollment_count
        FROM 
            department d
        LEFT JOIN 
            students_info s 
        ON 
            d.name = s.department_name
        AND 
            s.admission_date >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH)
        GROUP BY 
            d.name
        ORDER BY 
            d.name ASC
    ";

    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    $chartData = [
        'labels' => [],
        'data' => []
    ];

    while ($row = $result->fetch_assoc()) {
        $chartData['labels'][] = $row['department_name'];
        $chartData['data'][] = (int)$row['enrollment_count'];
    }

    echo json_encode(['status' => 'success', 'chartData' => $chartData]);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
} finally {
    $conn->close();
}
