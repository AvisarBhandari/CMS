<?php
header('Content-Type: application/json');
include 'db_connect.php'; 

if (!$conn) {
    echo json_encode(["error" => "Database connection failed."]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    file_put_contents('php://stderr', print_r($_POST, true));  // Logs POST data

    // Sanitize and retrieve POST data
    $faculty_id = mysqli_real_escape_string($conn, $_POST['faculty_id']);
    $faculty_name = mysqli_real_escape_string($conn, $_POST['faculty_name']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $dob = $_POST['dob'];
    $start_date = $_POST['start_date'];
    $salary = mysqli_real_escape_string($conn, $_POST['salary']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $department = mysqli_real_escape_string($conn, $_POST['department']); 
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    if (empty($dob) || !strtotime($dob) || empty($start_date) || !strtotime($start_date)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid Date(s) provided']);
        exit;
    }

    $dob = date('Y-m-d', strtotime($dob));
    $start_date = date('Y-m-d', strtotime($start_date));

    // Generate a random password
    $random_password = bin2hex(random_bytes(8));

    // Hash the password
    $hashed_password = password_hash($random_password, PASSWORD_DEFAULT);

    // Prepare the SQL statement for insertion
    $sql = "INSERT INTO faculty (department, faculty_id, faculty_name, position, address, dob, start_date, salary, phone_number, status, password) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        echo json_encode(['status' => 'error', 'message' => 'Failed to prepare statement: ' . mysqli_error($conn)]);
        exit;
    }

    mysqli_stmt_bind_param(
        $stmt,
        'sssssdsssss',
        $department,
        $faculty_id,
        $faculty_name,
        $position,
        $address,
        $dob,
        $start_date,
        $salary,
        $phone_number,
        $status,
        $hashed_password
    );

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        // Append the generated password to the file
        $file = fopen("faculty_passwords.txt", "a"); 
        $file_entry = "Faculty ID: $faculty_id, Name: $faculty_name,  Password: $random_password\n";
        fwrite($file, $file_entry); 
        fclose($file);  // Close the file

        echo json_encode([
            'status' => 'success', 
            'message' => 'Faculty added successfully!',
            'password' => $random_password 
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . mysqli_stmt_error($stmt)]);
    }

    mysqli_stmt_close($stmt);
} else {
    echo json_encode(["error" => "Invalid request method"]);
}

mysqli_close($conn);

