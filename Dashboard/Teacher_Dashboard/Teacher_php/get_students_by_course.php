<?php
include 'db_connect.php';

// Validate input
$course_code = isset($_GET['course_code']) ? trim($_GET['course_code']) : '';

if (empty($course_code)) {
    echo "<tr><td colspan='11'>Invalid or missing course code</td></tr>";
    exit;
}

try {
    // Query to fetch students
    $query = "SELECT student_id, student_roll, student_name, gender, email, department_name, 
                     phone_no, dob, admission_date, parent_name, address
              FROM students_info 
              WHERE course_code = ?";
    
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        throw new Exception("Database prepare error: " . $conn->error);
    }

    $stmt->bind_param("s", $course_code);
    $stmt->execute();

    $result = $stmt->get_result();
    if (!$result) {
        throw new Exception("Database query error: " . $stmt->error);
    }

    // Check if students are found
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['student_roll']}</td>
                    <td>{$row['student_name']}</td>
                    <td>{$row['gender']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['department_name']}</td>
                    <td>{$row['phone_no']}</td>
                    <td>{$row['dob']}&nbsp;</td>
                    <td>{$row['admission_date']}</td>
                    <td>{$row['parent_name']}</td>
                    <td>" . ($row['address'] ?: 'N/A') . "</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='10'>No students found</td></tr>";
    }

} catch (Exception $e) {
    echo "<tr><td colspan='10'>Error: " . $e->getMessage() . "</td></tr>";
}
?>
