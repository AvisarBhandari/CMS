<?php
include '../db_connect.php';


if (isset($_POST['date'])) {
    $date = $_POST['date'];

   
    $isHoliday = $conn->query("SELECT * FROM holidays WHERE holiday_date = '$date'");


    if ($isHoliday->num_rows > 0 || date('N', strtotime($date)) == 6) {
       
        echo json_encode([
            'success' => false,
            'message' => 'Attendance cannot be marked on holidays or Saturdays.'
        ]);
        exit;
    }

   
    $result = $conn->query("SELECT faculty_id, faculty_name, status FROM faculty");

    $facultyData = [];
    while ($row = $result->fetch_assoc()) {
     
        $status = ($row['status'] == 'Active') ? 'Present' : 'Absent';

    
        $facultyData[] = [
            'faculty_id' => $row['faculty_id'],
            'faculty_name' => $row['faculty_name'],
            'status' => $status
        ];
    }

   
    echo json_encode([
        'success' => true,
        'facultyData' => $facultyData
    ]);
} else {
    
    echo json_encode([
        'success' => false,
        'message' => 'No date provided for attendance marking.'
    ]);
}

