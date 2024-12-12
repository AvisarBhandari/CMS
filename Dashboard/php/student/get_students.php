<?php
include '../db_connect.php';

$course_id = $_GET['course_id'];


$query = "SELECT student_id, student_roll, student_name FROM students_info WHERE course_code = '$course_id'";

// Execute the query
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td class='student_roll'>{$row['student_roll']}</td>
                <td>{$row['student_name']}</td>
                <td>
                    <select class='status' name='status[]'>
                        <option value='Present'>Present</option>
                        <option value='Absent'>Absent</option>
                    </select>
                </td>
              </tr>";
    }
} else {
    echo 'no_data';
}

