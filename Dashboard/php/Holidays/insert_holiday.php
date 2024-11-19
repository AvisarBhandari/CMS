<?php
include ('../db_connect.php'); 

$response = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $holiday_date = $_POST['holiday_date'];
    $reason = trim($_POST['reason']);
    $today = new DateTime();
    $holidayDate = DateTime::createFromFormat('Y-m-d', $holiday_date);

    if (!$holidayDate) {
        $response['status'] = 'error';
        $response['message'] = 'Invalid date format.';
        echo json_encode($response);
        exit;
    }

    $interval = $today->diff($holidayDate);
    if ($interval->days > 31 || $interval->invert) {
        $response['status'] = 'error';
        $response['message'] = 'Holiday date must be within one month from today.';
        echo json_encode($response);
        exit;
    }

 
    if (empty($reason)) {
        $response['status'] = 'error';
        $response['message'] = 'Reason is required.';
        echo json_encode($response);
        exit;
    }

    if (strlen($reason) > 100) {
        $response['status'] = 'error';
        $response['message'] = 'Reason cannot exceed 100 characters.';
        echo json_encode($response);
        exit;
    }

    if (!preg_match("/^[a-zA-Z\s]+$/", $reason)) {
        $response['status'] = 'error';
        $response['message'] = 'Reason can only contain alphabets and spaces.';
        echo json_encode($response);
        exit;
    }

    $query = "INSERT INTO holidays (holiday_date, reason) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $holiday_date, $reason);

    if ($stmt->execute()) {
        $response['status'] = 'success';
        $response['message'] = 'Holiday added successfully.';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error adding holiday: ' . $stmt->error;
    }
    echo json_encode($response);
}

