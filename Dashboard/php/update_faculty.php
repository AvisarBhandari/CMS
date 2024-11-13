<?php
include('db_connect.php'); // Include your database connection file

// Check if the request method is POST and if the faculty_id is set
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['faculty_id'])) {
    // Check if edit mode is set to 'edit'
    if ($_POST['edit_mode'] === 'edit') {
        // Sanitize input values using mysqli_real_escape_string
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
        
        // Ensure that all required fields are provided
        if (empty($faculty_id) || empty($faculty_name) || empty($position) || empty($address) || empty($dob) || empty($start_date) || empty($salary) || empty($phone_number) || empty($department) || empty($status)) {
            echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
            exit();
        }

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
        // Use 's' for string, 'd' for double (used for salary), 'i' for integer (if any field is an integer)
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
?>
