<?php
include '../db_connect.php';

$response = array('status' => '', 'message' => '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_name = trim($_POST['event_name']);
    $event_date = trim($_POST['event_date']);
    $event_time = trim($_POST['event_time']);


    if (empty($event_name) || empty($event_date) || empty($event_time)) {
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

        $stmt = $conn->prepare("INSERT INTO events (event_name, event_date, event_time) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $event_name, $event_date, $event_time);

        if ($stmt->execute()) {
            $response['status'] = 'success';
            $response['message'] = 'Event added successfully.';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Failed to add the event. Please try again.';
        }

        $stmt->close();
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method.';
}

echo json_encode($response);
$conn->close();
