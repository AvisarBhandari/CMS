<?php

include '../db_connect.php';
// SQL query to get all departments
$sql = "SELECT name FROM department";

// Execute query and check for errors
$result = $conn->query($sql);

if ($result === false) {
    // If the query failed, output the error
    die("Error executing query: " . $conn->error);
}

// Fetch departments into an array
$departments = array();
while ($row = $result->fetch_assoc()) {
    $departments[] = $row;
}

// Return the departments as JSON
echo json_encode($departments);

// Close connection
$conn->close();
?>
