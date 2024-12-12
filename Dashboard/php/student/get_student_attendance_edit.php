<?php
include '../db_connect.php';

$course_id = $_GET['course_id'];
$attendance_date = $_GET['attendance_date'];


$query = "
    SELECT si.student_id, si.student_roll, si.student_name, sa.status
    FROM students_info si
     JOIN student_attendance sa ON si.student_roll = sa.student_roll 
        AND sa.course_code = '$course_id' AND sa.attendance_date = '$attendance_date'
    WHERE si.course_code = '$course_id'
";


$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $status = isset($row['status']) ? $row['status'] : 'Present';
        echo "<tr>
                <td class='student_roll'>{$row['student_roll']}</td>
                <td>{$row['student_name']}</td>
                <td>
                    <select class='status' name='status[]'>
                        <option value='Present' " . ($status === 'Present' ? 'selected' : '') . ">Present</option>
                        <option value='Absent' " . ($status === 'Absent' ? 'selected' : '') . ">Absent</option>
                    </select>
                </td>
              </tr>";
    }
} else {
    
    echo "<tr><td colspan='3' class='text-center'>No data found for this date</td></tr>";
}

