<?php

include 'db_connect.php'; 


$query = "SELECT status, COUNT(*) as count FROM faculty GROUP BY status";
$result = $conn->query($query);


$data = [
    'active' => 0,
    'on_leave' => 0
];


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      
        $status = strtolower($row['status']);
        
        if ($status == 'active') {
            $data['active'] = $row['count']; 
        } elseif ($status == 'inactive') {
            $data['on_leave'] = $row['count']; 
        }
    }
}


echo json_encode($data);

