<?php
include '../db_connect.php';

header('Content-Type: application/json');

$response = ["status" => "success", "message" => "", "data" => []];

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Invalid request method.");
    }

    if (empty($_POST['attendance_date'])) {
        throw new Exception("Attendance date is required.");
    }

    $attendance_date = $_POST['attendance_date'];

   
    $checkStmt = $conn->prepare("SELECT COUNT(*) as count 
                                FROM faculty_attendances 
                                WHERE attendance_date = ?");
    $checkStmt->bind_param("s", $attendance_date);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    $row = $checkResult->fetch_assoc();

    if ($row['count'] == 0) {
        throw new Exception("No attendance records available for the selected date.");
    }

    $stmt = $conn->prepare("SELECT faculty.faculty_id, faculty.faculty_name, 
                            faculty_attendances.status
                            FROM faculty_attendances
                            JOIN faculty ON faculty.faculty_id = faculty_attendances.faculty_id
                            WHERE faculty_attendances.attendance_date = ?");
    $stmt->bind_param("s", $attendance_date);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $response['data'][] = $row;
    }

    $stmt->close();
    $checkStmt->close();
} catch (Exception $e) {
    $response["status"] = "error";
    $response["message"] = $e->getMessage();
}

echo json_encode($response);

