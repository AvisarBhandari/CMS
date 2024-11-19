<?php
include_once "../db_connect.php";

if (isset($_POST['holiday_id'])) {
    $holiday_id = $_POST['holiday_id'];

    $query = "DELETE FROM holidays WHERE holiday_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $holiday_id);

    if ($stmt->execute()) {
        $response = array(
            "status" => "success",
            "message" => "Holiday deleted successfully."
        );
    } else {
        $response = array(
            "status" => "error",
            "message" => "Failed to delete holiday."
        );
    }

    $stmt->close();
} else {
    $response = array(
        "status" => "error",
        "message" => "Holiday ID not provided."
    );
}

echo json_encode($response);

$conn->close();

