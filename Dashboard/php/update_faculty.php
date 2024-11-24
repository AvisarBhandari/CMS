<?php
include('db_connect.php'); 


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['faculty_id'])) {
    // Check if edit mode is set to 'edit'
    if ($_POST['edit_mode'] === 'edit') {
       
        $faculty_id = mysqli_real_escape_string($conn, $_POST['faculty_id']);
        $faculty_name = isset($_POST['faculty_name']) ? mysqli_real_escape_string($conn, $_POST['faculty_name']) : '';
        $position = isset($_POST['position']) ? mysqli_real_escape_string($conn, $_POST['position']) : '';
        $address = isset($_POST['address']) ? mysqli_real_escape_string($conn, $_POST['address']) : '';
        $dob = isset($_POST['dob']) ? mysqli_real_escape_string($conn, $_POST['dob']) : '';
        $start_date = isset($_POST['start_date']) ? mysqli_real_escape_string($conn, $_POST['start_date']) : '';
        $salary = isset($_POST['salary']) ? mysqli_real_escape_string($conn, $_POST['salary']) : '';
        $phone_number = isset($_POST['phone_number']) ? mysqli_real_escape_string($conn, $_POST['phone_number']) : '';
        $department = isset($_POST['department']) ? mysqli_real_escape_string($conn, $_POST['department']) : ''; // Check if department exists
        $status = isset($_POST['status']) ? mysqli_real_escape_string($conn, $_POST['status']) : '';
      
        if (empty($faculty_id) || empty($faculty_name) || empty($position) || empty($address) || empty($dob) || empty($start_date) || empty($salary) || empty($phone_number) || empty($department) || empty($status)) {
            echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
            exit();
        }

        
        $stmt = $conn->prepare("UPDATE faculty 
                                SET faculty_name = ?, position = ?, address = ?, dob = ?, start_date = ?, salary = ?, phone_number = ?, department = ?, status = ?
                                WHERE faculty_id = ?");
        
        
        if ($stmt === false) {
           
            echo json_encode(['status' => 'error', 'message' => 'Failed to prepare statement']);
            exit();
        }

      
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
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid edit mode.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
}

// Close the database connection
mysqli_close($conn);

