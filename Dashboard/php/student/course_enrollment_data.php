<?php
include '../db_connect.php'; 

$response = [];

try {
    $query = "
        SELECT 
            c.course_name,
            COUNT(s.course_code) AS enrollment_count
        FROM 
            courses c
        LEFT JOIN 
            students_info s
        ON 
            c.course_code = s.course_code
        AND 
            s.admission_date >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH)
        GROUP BY 
            c.course_name;
    ";

    $result = $conn->query($query);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $response[] = [
                'course_name' => $row['course_name'],
                'enrollment_count' => (int)$row['enrollment_count']
            ];
        }
    }

    echo json_encode($response);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}

