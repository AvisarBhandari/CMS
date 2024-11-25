<?php
include '../db_connect.php';

header('Content-Type: application/json');

$response = ["status" => "success", "message" => "", "data" => []];

try {
   
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Invalid request method");
    }

    
    if (!isset($_POST['attendance_date']) || !isset($_POST['attendance'])) {
        throw new Exception("Invalid input data");
    }

    $attendance_date = $_POST['attendance_date'];
    $attendance_data = json_decode($_POST['attendance'], true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception("Invalid JSON format: " . json_last_error_msg());
    }

   
    $current_date = date('Y-m-d');
    if ($attendance_date !== $current_date) {
        throw new Exception("Attendance can only be marked for today's date.");
    }

  
    if (empty($attendance_data)) {
        throw new Exception("No attendance data provided");
    }

    $holiday_check = $conn->prepare("SELECT * FROM holidays WHERE holiday_date = ?");
    $holiday_check->bind_param("s", $attendance_date);
    $holiday_check->execute();
    $holiday_result = $holiday_check->get_result();
    $holiday_check->close();

    if ($holiday_result->num_rows > 0 || date('N', strtotime($attendance_date)) == 6) {
        throw new Exception("Attendance cannot be marked on holidays or Saturdays.");
    }

    $existing_attendance_check = $conn->prepare("SELECT COUNT(*) FROM faculty_attendances WHERE attendance_date = ?");
    $existing_attendance_check->bind_param("s", $attendance_date);
    $existing_attendance_check->execute();
    $existing_attendance_check->bind_result($attendance_count);
    $existing_attendance_check->fetch();
    $existing_attendance_check->close();

    if ($attendance_count > 0) {
        throw new Exception("Attendance for today has already been marked.");
    }

    
    $errors = [];
    $valid_attendance_data = [];

    foreach ($attendance_data as $faculty_id => $status) {
      
        $result = $conn->query("SELECT status FROM faculty WHERE faculty_id = '$faculty_id'");
        if ($result->num_rows === 0) {
            $errors[] = "Faculty ID: $faculty_id not found.";
            continue;
        }
        $faculty_status = $result->fetch_assoc()['status'];

        if ($faculty_status === 'Inactive' && $status === 'Present') {
            $errors[] = "Cannot mark inactive faculty as present. Faculty ID: $faculty_id";
            continue;
        }

        
        if ($faculty_status === 'Inactive') {
            $status = 'Absent';
        }

      
        $valid_attendance_data[] = [
            'faculty_id' => $faculty_id,
            'status' => $status
        ];
    }

    
    if (!empty($errors)) {
        throw new Exception(implode(" ", $errors));
    }

    
    $stmt = $conn->prepare("INSERT INTO faculty_attendances (faculty_id, attendance_date, status) 
                            VALUES (?, ?, ?)
                            ON DUPLICATE KEY UPDATE status = ?");

    if (!$stmt) {
        throw new Exception("Failed to prepare the SQL statement.");
    }

 
    foreach ($valid_attendance_data as $data) {
        $stmt->bind_param("ssss", $data['faculty_id'], $attendance_date, $data['status'], $data['status']);
        if (!$stmt->execute()) {
            throw new Exception("Failed to insert attendance for faculty ID: " . $data['faculty_id']);
        }
    }

   
    $stmt->close();

    $response["message"] = "Attendance successfully recorded!";
    $response["data"] = $attendance_data;
} catch (Exception $e) {
    
    $response["status"] = "error";
    $response["message"] = $e->getMessage();
}


echo json_encode($response);

