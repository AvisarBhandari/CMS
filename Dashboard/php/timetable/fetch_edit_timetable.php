<?php 
include '../db_connect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['subject_id']) && isset($_POST['day'])) {
    $subject_id = $_POST['subject_id'];
    $day = $_POST['day']; 
    $query = "SELECT start_time, end_time, faculty_id FROM timetable WHERE subject_id = ? AND day = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("is", $subject_id, $day); // "i" for integer (subject_id), "s" for string (day)
        $stmt->execute();


        $stmt->bind_result($start_time, $end_time, $faculty_id);

       
        if ($stmt->fetch()) {
           
            echo json_encode([
                'start_time' => $start_time,
                'end_time' => $end_time,
                'faculty_id' => $faculty_id
            ]);
        } else {
        
            echo json_encode([]);
        }

        $stmt->close();
    } else {
      
        echo json_encode(['error' => 'Failed to prepare query.']);
    }
} else {
    // If subject_id or day is missing, return an error
    echo json_encode(['error' => 'Subject ID or Day is missing.']);
}
