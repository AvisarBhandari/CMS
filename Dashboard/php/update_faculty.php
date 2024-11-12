<?php
include('db_connect.php'); // Include your database connection file

// Check if the request method is POST and if the faculty_id is set
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['faculty_id'])) {
    // Check if edit mode is set to 'edit'
    if ($_POST['edit_mode'] === 'edit') {
        // Sanitize input values using mysqli_real_escape_string
        $faculty_id = mysqli_real_escape_string($conn, $_POST['faculty_id']);
        $faculty_name = mysqli_real_escape_string($conn, $_POST['faculty_name']);
        $position = mysqli_real_escape_string($conn, $_POST['position']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $dob = mysqli_real_escape_string($conn, $_POST['dob']);
        $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
        $salary = mysqli_real_escape_string($conn, $_POST['salary']);
        $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
        $department = mysqli_real_escape_string($conn, $_POST['department']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);
        
        // Prepare the UPDATE statement with placeholders
        $stmt = $conn->prepare("UPDATE faculty 
                                SET faculty_name = ?, position = ?, address = ?, dob = ?, start_date = ?, salary = ?, phone_number = ?, department = ?, status = ?
                                WHERE faculty_id = ?");
        
        // Check if statement preparation failed
        if ($stmt === false) {
            // Handle error if statement preparation fails
            echo json_encode(['status' => 'error', 'message' => 'Failed to prepare statement']);
            exit();
        }

        // Bind the parameters to the statement
        $stmt->bind_param("sssssdssss", $faculty_name, $position, $address, $dob, $start_date, $salary, $phone_number, $department, $status, $faculty_id);

        // Execute the statement
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            // Return error message if execution fails
            echo json_encode(['status' => 'error', 'message' => $stmt->error]);
        }

        // Close the prepared statement
        $stmt->close();
    }
}

// Close the database connection
mysqli_close($conn);

