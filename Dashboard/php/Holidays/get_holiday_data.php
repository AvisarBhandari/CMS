<?php
include_once "../db_connect.php";

if (isset($_GET['holiday_id'])) {
    $holiday_id = $_GET['holiday_id'];

    $query = "SELECT * FROM holidays WHERE holiday_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $holiday_id);
    $stmt->execute();
    
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $holiday = $result->fetch_assoc();

        $response = array(
            "status" => "success",
            "data" => array(
                "holiday_id" => $holiday['holiday_id'],
                "holiday_date" => $holiday['holiday_date'],
                "reason" => $holiday['reason'] 
            )
        );
    } else {
        $response = array(
            "status" => "error",
            "message" => "Holiday not found"
        );
    }

    echo json_encode($response);
} else {
    echo json_encode(array(
        "status" => "error",
        "message" => "Holiday ID not provided"
    ));
}

$conn->close();
?>
