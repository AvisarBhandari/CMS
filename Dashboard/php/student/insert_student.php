<?php
include '../db_connect.php';

function generatePassword($length = 8) {
    try {
        return bin2hex(random_bytes($length / 2));
    } catch (Exception $e) {
        error_log("Error generating password: " . $e->getMessage());
        return false;
    }
}

if ($conn->connect_error) {
    error_log("Database connection failed: " . $conn->connect_error);
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed']);
    exit;
}

header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    error_log("Received POST request for student registration.");

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
        error_log("Validation errors: " . implode(", ", $errors));
        echo json_encode(['status' => 'error', 'message' => $errors]);
        exit;
    }

    $password = generatePassword();
    if (!$password) {
        echo json_encode(['status' => 'error', 'message' => 'Failed to generate password']);
        exit;
    }

    if (!isset($_POST['dob']) || empty($_POST['dob'])) {
        error_log("DOB field is empty or not set.");
    }

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Modified the insert query to remove the semester field
    $stmt = $conn->prepare("INSERT INTO students_info (student_roll, student_name, gender, email, password, department_name, course_code, phone_no, dob, admission_date, parent_name, address) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if ($stmt === false) {
        error_log("Error preparing SQL statement: " . $conn->error);
        echo json_encode(['status' => 'error', 'message' => $conn->error]);
        exit;
    }

    // Removed the semester variable from the bind_param
    $stmt->bind_param('sssssssissss', $student_roll, $student_name, $gender, $email, $hashed_password, $department, $course, $phone_no, $dob, $admission_date, $parent_name, $address);

    if ($stmt->execute()) {
        error_log("Student data inserted successfully.");

        // Append password to the file after successful insertion
        $file = fopen("student_passwords.txt", "a");
        if ($file) {
            $entry = "Student Roll: $student_roll, Name: $student_name, Password: $password\n";
            fwrite($file, $entry);
            fclose($file);
        } else {
            error_log("Failed to open file for appending password.");
        }

        echo json_encode(['status' => 'success', 'message' => 'Student registered successfully', 'student_roll' => $student_roll, 'password' => $password]);
    } else {
        error_log("Error executing query: " . $stmt->error);
        echo json_encode(['status' => 'error', 'message' => $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
