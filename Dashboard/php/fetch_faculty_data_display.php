<?php

include 'db_connect.php'; 

$query = "SELECT * FROM faculty";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data); 
} else {
    echo json_encode([]); 
}

