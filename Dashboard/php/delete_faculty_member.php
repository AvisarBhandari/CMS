<?php
include('db_connect.php'); // Include database connection

if (isset($_POST['faculty_id'])) {
    $facultyId = $_POST['faculty_id'];

    // Delete query (use string binding if faculty_id is a string)
    $query = "DELETE FROM faculty WHERE faculty_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $facultyId); // Use "s" for string binding

    if ($stmt->execute()) {
        // Return success JSON response
        echo json_encode(["status" => "success", "message" => "Faculty deleted successfully!"]);
    } else {
        // Return error JSON response
        echo json_encode(["status" => "error", "message" => "Error deleting faculty: " . $stmt->error]);
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();

