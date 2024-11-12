<?php
header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Invalid request method']);
    exit;
}


include 'db_connect.php';

try {
   
    $faculty_id = $_POST['faculty_id'];
    $attendance_date = $_POST['attendance_date'];
    $attendance_status = $_POST['attendance_status'];

    
    $stmt = $conn->prepare("SELECT * FROM faculty WHERE faculty_id = ?");
    $stmt->bind_param("s", $faculty_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo json_encode(['error' => 'Faculty not found']);
        exit;
    }

    
    $stmt = $conn->prepare("SELECT * FROM faculty_attendance WHERE faculty_id = ? AND attendance_date = ?");
    $stmt->bind_param("ss", $faculty_id, $attendance_date);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(['error' => 'Attendance already marked for this date']);
        exit;
    }

  
    $stmt = $conn->prepare("INSERT INTO faculty_attendance (faculty_id, attendance_date, attendance_status) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $faculty_id, $attendance_date, $attendance_status);

    if ($stmt->execute()) {
        echo json_encode(['success' => 'Attendance marked successfully']);
    } else {
        echo json_encode(['error' => 'Failed to mark attendance']);
    }

} catch (Exception $e) {
    echo json_encode(['error' => 'Server error: ' . $e->getMessage()]);
}

