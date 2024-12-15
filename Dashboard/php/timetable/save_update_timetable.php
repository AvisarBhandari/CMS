<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);

include '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    error_log("Received POST data: " . json_encode($_POST));
    $timetableData = isset($_POST['timetable']) ? $_POST['timetable'] : [];
    if (!empty($timetableData)) {
        $conn->begin_transaction();
        try {
            foreach ($timetableData as $entry) {
                $action = isset($entry['action']) ? trim($entry['action']) : 'insert'; // Default action: insert
                $course_code = trim($entry['course_code']);
                $semester = (int)$entry['semester'];
                $day = trim($entry['day']);
                $subject_id = (int)$entry['subject_id'];
                $start_time = trim($entry['start_time']);
                $end_time = trim($entry['end_time']);
                $faculty_id = trim($entry['faculty_id']);
                error_log("Processing: action=$action, course_code=$course_code, semester=$semester, day=$day, subject_id=$subject_id, start_time=$start_time, end_time=$end_time, faculty_id=$faculty_id");

               
                $start = new DateTime($start_time);
                $end = new DateTime($end_time);
                $interval = $start->diff($end);
                $totalMinutes = ($interval->h * 60) + $interval->i;

                if ($totalMinutes < 25 || $totalMinutes > 120) {
                    throw new Exception("Time period for subject $subject_id on $day is invalid (min 25 minutes, max 2 hours).");
                }
                $query = "SELECT id FROM timetable 
                          WHERE faculty_id = ? AND day = ? 
                          AND (
                              (start_time < ? AND end_time > ?) OR 
                              (start_time < ? AND end_time > ?) OR 
                              (start_time >= ? AND end_time <= ?)
                          )";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ssssssss", $faculty_id, $day, $end_time, $start_time, $end_time, $start_time, $start_time, $end_time);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    throw new Exception("Faculty $faculty_id is already assigned to another subject during the requested time.");
                }

                if ($action === 'update') {
                    $query = "SELECT id FROM timetable WHERE subject_id = ? AND day = ? AND course_code = ? AND semester = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("isss", $subject_id, $day, $course_code, $semester);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $query = "UPDATE timetable 
                                  SET start_time = ?, end_time = ?, faculty_id = ? 
                                  WHERE subject_id = ? AND day = ? AND course_code = ? AND semester = ?";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("sssisss", $start_time, $end_time, $faculty_id, $subject_id, $day, $course_code, $semester);

                        if (!$stmt->execute()) {
                            error_log("Update failed: " . $stmt->error);
                            throw new Exception("Failed to update timetable record.");
                        }
                    } else {
                        throw new Exception("No existing record found to update for subject $subject_id on $day.");
                    }
                } elseif ($action === 'insert') {
                    $query = "SELECT id FROM timetable WHERE subject_id = ? AND day = ? AND course_code = ? AND semester = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("isss", $subject_id, $day, $course_code, $semester);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        throw new Exception("Record already exists for subject $subject_id on $day. Use the edit option to modify.");
                    }
                    $query = "INSERT INTO timetable (course_code, semester, day, subject_id, start_time, end_time, faculty_id) 
                              VALUES (?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("sisisss", $course_code, $semester, $day, $subject_id, $start_time, $end_time, $faculty_id);

                    if (!$stmt->execute()) {
                        error_log("Insert failed: " . $stmt->error);
                        throw new Exception("Failed to insert timetable record.");
                    }
                } else {
                    throw new Exception("Invalid action specified. Allowed values are 'insert' or 'update'.");
                }
            }
            $conn->commit();
            $response = array('success' => true, 'message' => 'Timetable saved/updated successfully.');
        } catch (Exception $e) {
            // Rollback in case of error
            $conn->rollback();
            error_log("Error: " . $e->getMessage());
            $response = array('success' => false, 'message' => 'Error saving timetable: ' . $e->getMessage());
        }
    } else {
        $response = array('success' => false, 'message' => 'No timetable data provided.');
    }
    echo json_encode($response);
}

