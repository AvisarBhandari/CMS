<?php
include '../db_connect.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    error_log("Received POST request for updating student information.");
    $student_id = mysqli_real_escape_string($conn, $_POST['student_id_hidden']); // Hidden ID for edit
    $student_roll = mysqli_real_escape_string($conn, $_POST['student_roll']);
    $student_name = mysqli_real_escape_string($conn, $_POST['student_name']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $phone_no = mysqli_real_escape_string($conn, $_POST['phone_no']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $admission_date = mysqli_real_escape_string($conn, $_POST['admission_date']);
    $parent_name = mysqli_real_escape_string($conn, $_POST['parent_name']);
    $address = isset($_POST['address']) ? mysqli_real_escape_string($conn, $_POST['address']) : null;
    $errors = [];

    if (!preg_match('/^STU-\d{4}-\d{4}$/', $student_roll)) {
        $errors[] = "Invalid Roll Number format. Use STU-YYYY-XXXX.";
    }

    if (!preg_match('/^[A-Za-z]{3,25}\s[A-Za-z]{3,25}$/', $student_name)) {
        $errors[] = "Invalid Student Name. Provide both first and last names (3-25 characters each).";
    }

    if (!in_array(strtolower($gender), ['male', 'female', 'other'])) {
        $errors[] = "Invalid Gender. Choose Male, Female, or Other.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid Email format.";
    }

    if (!preg_match('/^(98|97)\d{8}$/', $phone_no)) {
        $errors[] = "Invalid Phone Number. Must start with 98 or 97 and be 10 digits long.";
    }

    $dob_date = DateTime::createFromFormat('Y-m-d', $dob);
    if (!$dob_date || $dob_date->diff(new DateTime())->y < 16) {
        $errors[] = "Invalid Date of Birth. Age must be at least 16 years.";
    }

    $admission_date_obj = DateTime::createFromFormat('Y-m-d', $admission_date);
    if (!$admission_date_obj || $admission_date_obj > new DateTime()) {
        $errors[] = "Invalid Admission Date. Cannot be in the future.";
    }

    if (!preg_match('/^[A-Za-z ]{2,50}$/', $parent_name)) {
        $errors[] = "Invalid Parent Name. Must be 2-50 alphabets only.";
    }

    if ($address !== null && strlen($address) > 255) {
        $errors[] = "Address too long. Maximum 255 characters allowed.";
    }

    if (!empty($errors)) {
        echo json_encode(['status' => 'error', 'message' => $errors]);
        exit;
    }

    $stmt = $conn->prepare("UPDATE students_info 
                            SET student_roll = ?, student_name = ?, gender = ?, email = ?, department_name = ?, course_code = ?, phone_no = ?, dob = ?, admission_date = ?, parent_name = ?, address = ?
                            WHERE student_id = ?");

    if ($stmt === false) {
        error_log("Error preparing SQL statement: " . $conn->error);
        echo json_encode(['status' => 'error', 'message' => $conn->error]);
        exit;
    }
    
    $stmt->bind_param('sssssssssssi', $student_roll, $student_name, $gender, $email, $department, $course, $phone_no, $dob, $admission_date, $parent_name, $address, $student_id);

    if ($stmt->execute()) {
        error_log("Student data updated successfully.");
        echo json_encode(['status' => 'success', 'message' => 'Student updated successfully']);
    } else {
        error_log("Error executing query: " . $stmt->error);
        echo json_encode(['status' => 'error', 'message' => $stmt->error]);
    }
    
    $stmt->close();
    $conn->close();
}
