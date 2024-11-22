<?php
header('Content-Type: application/json'); // Ensure JSON response

include "db_connect.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    $searchQuery = isset($_GET['searchQuery']) ? trim($_GET['searchQuery']) : '';

    $query = "SELECT  faculty_id, faculty_name, position, address, dob, start_date, salary, phone_number, department,status FROM faculty";
    if (!empty($searchQuery)) {
        $query .= " WHERE faculty_id LIKE ? OR faculty_name LIKE ?";
    }

    $stmt = $conn->prepare($query);
    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => 'Query preparation failed: ' . $conn->error]);
        exit;
    }

    if (!empty($searchQuery)) {
        $likeQuery = '%' . $searchQuery . '%';
        $stmt->bind_param("ss", $likeQuery, $likeQuery);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $faculty = [];
        while ($row = $result->fetch_assoc()) {
            $faculty[] = $row;
        }
        echo json_encode(['status' => 'success', 'data' => $faculty]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No faculty found matching the search criteria.']);
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
} finally {
    $conn->close();
}
