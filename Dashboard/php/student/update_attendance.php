<?php
include '../db_connect.php';

$course_id = $_POST['course_id'];
$attendance_date = $_POST['attendance_date'];
$students = $_POST['students']; 

// Define allowed dates
$current_date = date('Y-m-d');
$previous_date = date('Y-m-d', strtotime('-1 day'));
$day_before_previous = date('Y-m-d', strtotime('-2 days'));
$third_previous = date('Y-m-d', strtotime('-3 days'));

// Check if the attendance date is within the allowed range
if (!in_array($attendance_date, [$current_date, $previous_date, $day_before_previous, $third_previous])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'You can only update attendance for today and the previous 3 days.'
    ]);
    exit; 
}

foreach ($students as $student) {
    $student_roll = $student['student_roll'];
    $status = $student['status'];
    
    // Check if student exists
    $query = "SELECT student_id FROM students_info WHERE student_roll = '$student_roll' AND course_code = '$course_id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $student_data = mysqli_fetch_assoc($result);
        $student_id = $student_data['student_id'];

        // Check if attendance for this student and date already exists
        $check_query = "SELECT * FROM student_attendance 
                        WHERE course_code = '$course_id' 
                        AND student_roll = '$student_roll' 
                        AND attendance_date = '$attendance_date'";

        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            // Attendance record exists, update it
            $update_query = "UPDATE student_attendance 
                             SET status = '$status' 
                             WHERE course_code = '$course_id' 
                             AND student_roll = '$student_roll' 
                             AND attendance_date = '$attendance_date'";

            if (mysqli_query($conn, $update_query)) {
                $response = [
                    'status' => 'success',
                    'message' => "Attendance updated successfully for student $student_roll."
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'message' => "Error updating attendance for student $student_roll: " . mysqli_error($conn)
                ];
            }
        } else {
            $response = [
                'status' => 'error',
                'message' => "No attendance record found for student $student_roll on $attendance_date."
            ];
        }
    } else {
        $response = [
            'status' => 'error',
            'message' => "No student found with roll number $student_roll for course $course_id."
        ];
    }

    // Output the response and exit
    echo json_encode($response);
    exit; // If you want to stop execution after the first response
}

echo json_encode([
    'status' => 'success',
    'message' => 'Attendance updated successfully!'
]);

?>
