<?php
include '../db_connect.php';

$response = array('status' => '', 'message' => '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_id = intval($_POST['event_id']);
    $event_name = trim($_POST['event_name']);
    $event_date = trim($_POST['event_date']);
    $event_time = trim($_POST['event_time']);

    // Backend Validation
    if (empty($event_id) || empty($event_name) || empty($event_date) || empty($event_time)) {
        $response['status'] = 'error';
        $response['message'] = 'All fields are required.';
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $event_name)) {
        $response['status'] = 'error';
        $response['message'] = 'Event name must contain only alphabets and spaces.';
    } elseif (strlen($event_name) > 100) {
        $response['status'] = 'error';
        $response['message'] = 'Event name cannot exceed 100 characters.';
    } elseif (strtotime($event_date) < strtotime(date('Y-m-d'))) {
        $response['status'] = 'error';
        $response['message'] = 'Event date cannot be in the past.';
    } else {
        // Update the database
        $stmt = $conn->prepare("UPDATE events SET event_name = ?, event_date = ?, event_time = ? WHERE event_id = ?");
        $stmt->bind_param("sssi", $event_name, $event_date, $event_time, $event_id);

        if ($stmt->execute()) {
            $response['status'] = 'success';
            $response['message'] = 'Event updated successfully.';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Failed to update the event. Please try again.';
        }

        $stmt->close();
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method.';
}

echo json_encode($response);
$conn->close();

