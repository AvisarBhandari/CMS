<?php
include '../db_connect.php';

$sql = "SELECT id, name, discount_percentage FROM scholarships"; 
$result = $conn->query($sql);
$scholarships = [];
while ($row = $result->fetch_assoc()) {
    $scholarships[] = $row;
}

// Return the JSON response
echo json_encode($scholarships);

