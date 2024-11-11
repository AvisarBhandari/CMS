<?php
// Include your database connection file
include('db_connect.php');

if (isset($_GET['faculty_id'])) {
    $faculty_id = $_GET['faculty_id'];

    // Prepare and execute the query to fetch data by faculty_id
    $query = "SELECT * FROM faculty WHERE faculty_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $faculty_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $faculty_data = $result->fetch_assoc();

        // Send the data as a JSON response
        echo json_encode([
            'status' => 'success',
            'data' => $faculty_data
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Faculty not found'
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Faculty ID is required'
    ]);
}

$stmt->close();
$conn->close();

