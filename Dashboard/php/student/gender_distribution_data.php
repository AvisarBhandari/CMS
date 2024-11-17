<?php
include('../db_connect.php');
$query = "SELECT gender, COUNT(*) as count 
          FROM students_info 
          WHERE admission_date >= CURDATE() - INTERVAL 12 MONTH 
          GROUP BY gender";
$result = $conn->query($query);
$gender_data = ['male' => 0, 'female' => 0, 'other' => 0];
while ($row = $result->fetch_assoc()) {
    if (in_array(strtolower($row['gender']), ['male', 'female', 'other'])) {
        $gender_data[strtolower($row['gender'])] = $row['count'];
    }
}
echo json_encode($gender_data);

