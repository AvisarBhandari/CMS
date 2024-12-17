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

$attendance_exists = false;
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
            // If attendance already exists, set the flag to true and break the loop
            $json_encode = [
                    'status' => 'error',
                    'message' => "Attendance already marked for student(s) on $attendance_date."
                ];
            $attendance_exists = true;
            break;
        } else {
            // If attendance does not exist, insert it
            $insert_query = "INSERT INTO student_attendance (course_code, student_roll, student_id, attendance_date, status) 
                             VALUES ('$course_id', '$student_roll', '$student_id', '$attendance_date', '$status')";

            if (!mysqli_query($conn, $insert_query)) {
                echo json_encode([
                    'status' => 'error',
                    'message' => "Error inserting attendance for student $student_roll: " . mysqli_error($conn)
                ]);
                exit;
            }
        }
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => "No student found with roll number $student_roll for course $course_id."
        ]);
        exit;
    }
}

// If attendance already exists for any student, return an error
if ($attendance_exists) {
    echo json_encode([
        'status' => 'error',
        'message' => "Attendance already marked for student(s) on $attendance_date."
    ]);
    exit;
}

// If attendance inserted successfully for all students
echo json_encode([
    'status' => 'success',
    'message' => 'Attendance added successfully!'
]);

?>
