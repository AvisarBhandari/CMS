<?php
include '../db_connect.php';
if (isset($_POST['event_id'])) {
    $event_id = $_POST['event_id'];
    $query = "DELETE FROM events WHERE event_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $event_id); 
    if ($stmt->execute()) {
        $response = [
            'status' => 'success',
            'message' => 'Event deleted successfully.'
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Failed to delete the event.'
        ];
    }
    $stmt->close();
    $conn->close();
} else {
    $response = [
        'status' => 'error',
        'message' => 'Event ID not provided.'
    ];
}
header('Content-Type: application/json');
echo json_encode($response);

