<?php
include '../db_connect.php'; 
if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
    $query = "SELECT * FROM events WHERE event_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $event_id); 
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $event = $result->fetch_assoc();
            $response = [
                'status' => 'success',
                'data' => [
                    'event_id' => $event['event_id'],
                    'event_name' => $event['event_name'],
                    'event_date' => $event['event_date'],
                    'event_time' => $event['event_time']
                ]
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Event not found.'
            ];
        }
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Failed to execute query.'
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

