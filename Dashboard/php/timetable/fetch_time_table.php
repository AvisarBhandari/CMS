<?php
// Include your database connection file
include '../db_connect.php';

// Check if required POST variables are set
if (isset($_POST['course'], $_POST['semester'], $_POST['day'])) {
    $course = $_POST['course'];
    $semester = $_POST['semester'];
    $day = $_POST['day'];


    $query = "
        SELECT 
            t.subject_id, s.subject_name, t.start_time, t.end_time, f.faculty_name
        FROM 
            timetable t
        JOIN 
            subjects s ON t.subject_id = s.subject_id
        JOIN 
            faculty f ON t.faculty_id = f.faculty_id
        WHERE 
            t.course_code = ? AND t.semester = ? AND t.day = ?
        ORDER BY 
            t.start_time
    ";

    // Prepare the query
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param('sis', $course, $semester, $day);
        $stmt->execute();
        $result = $stmt->get_result();

        // Fetch all results into an array
        $timetable = [];
        while ($row = $result->fetch_assoc()) {
            $timetable[] = $row;
        }

        // Check if the timetable array is empty
        if (empty($timetable)) {
            // Return no data found message
            echo json_encode(['message' => 'No data found']);
        } else {
            // Return the data as JSON
            echo json_encode($timetable);
        }

        $stmt->close();
    } else {
        echo json_encode(['error' => 'Failed to prepare query.']);
    }
} else {
    echo json_encode(['error' => 'Invalid parameters.']);
}

$conn->close();

