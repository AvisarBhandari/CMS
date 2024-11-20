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
    $current_month = date('Y-m');
    $attendance_month = date('Y-m', strtotime($attendance_date));

    // Check if the attendance date is within the current month
    if ($attendance_month !== $current_month) {
        throw new Exception("Attendance can only be updated for the current month.");
    }

    if (empty($attendance_data)) {
        throw new Exception("No attendance data provided");
    }

    // Check if the date is a holiday or a Sunday
    $holiday_check = $conn->prepare("SELECT * FROM holidays WHERE holiday_date = ?");
    $holiday_check->bind_param("s", $attendance_date);
    $holiday_check->execute();
    $holiday_result = $holiday_check->get_result();
    $holiday_check->close();

    if ($holiday_result->num_rows > 0 || date('N', strtotime($attendance_date)) == 6) {
        throw new Exception("Attendance cannot be updated on holidays or Sundays.");
    }

    // Check if attendance for the given date already exists
    $existing_attendance_check = $conn->prepare("SELECT COUNT(*) FROM faculty_attendances WHERE attendance_date = ?");
    $existing_attendance_check->bind_param("s", $attendance_date);
    $existing_attendance_check->execute();
    $existing_attendance_check->bind_result($attendance_count);
    $existing_attendance_check->fetch();
    $existing_attendance_check->close();

    if ($attendance_count > 0) {
        $stmt = $conn->prepare("UPDATE faculty_attendances SET status = ? WHERE faculty_id = ? AND attendance_date = ?");
        if (!$stmt) {
            throw new Exception("Failed to prepare the SQL statement.");
        }

        // Update attendance status for each faculty
        foreach ($attendance_data as $faculty_id => $status) {
            // Check faculty status
            $faculty_check = $conn->prepare("SELECT status FROM faculty WHERE faculty_id = ?");
            $faculty_check->bind_param("s", $faculty_id);
            $faculty_check->execute();
            $faculty_check->bind_result($faculty_status);
            $faculty_check->fetch();
            $faculty_check->close();

            // If faculty is inactive and marked as present, throw an error
            if ($faculty_status === 'Inactive' && $status === 'Present') {
                throw new Exception("Cannot mark inactive faculty as present. Faculty ID: $faculty_id");
            }

            // If faculty is inactive, automatically mark as absent
            if ($faculty_status === 'Inactive') {
                $status = 'Absent';
            }

            // Update the attendance status for the faculty
            $stmt->bind_param("sss", $status, $faculty_id, $attendance_date);
            if (!$stmt->execute()) {
                throw new Exception("Failed to update attendance for faculty ID: $faculty_id");
            }
        }

        $stmt->close();
        $response["message"] = "Attendance successfully updated!";
        $response["data"] = $attendance_data;
    } else {
        throw new Exception("Attendance for the specified date does not exist. Cannot update.");
    }

} catch (Exception $e) {
    $response["status"] = "error";
    $response["message"] = $e->getMessage();
}

// Output the JSON response
echo json_encode($response);

