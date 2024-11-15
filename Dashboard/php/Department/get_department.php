<?php
header('Content-Type: application/json');
include '../db_connect.php'; 

if (!$conn) {
    echo json_encode(["error" => "Database connection failed."]);
    exit;
}

$query = "SELECT id, name FROM department"; 
$result = mysqli_query($conn, $query);

if (!$result) {
    echo json_encode(["error" => "Query failed: " . mysqli_error($conn)]);
    exit;
}

$departments = [];
while ($row = mysqli_fetch_assoc($result)) {
    $departments[] = $row;
}

echo json_encode($departments); // Output the departments array as JSON

mysqli_close($conn);

