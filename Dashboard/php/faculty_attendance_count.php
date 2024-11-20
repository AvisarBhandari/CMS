<?php
header('Content-Type: application/json');


include 'db_connect.php';

try {
   
    $query = "
        SELECT MONTH(attendance_date) AS month, COUNT(*) AS absent_count
        FROM faculty_attendances
        WHERE status = 'Absent'
        GROUP BY MONTH(attendance_date)
        ORDER BY MONTH(attendance_date)
    ";

 
    $result = $conn->query($query);

    
    $absenceData = array_fill(0, 12, 0); // Default to 0 for each month

    
    while ($row = $result->fetch_assoc()) {
        $month = $row['month'] - 1; // Months in the result are 1-12, but arrays are 0-11
        $absenceData[$month] = (int) $row['absent_count'];
    }

   
    echo json_encode(['success' => true, 'data' => $absenceData]);

} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => 'Server error: ' . $e->getMessage()]);
}


