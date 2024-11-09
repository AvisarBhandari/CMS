<?php
// Include the database connection
include 'db_connect.php';

// Fetch earnings and expenditures data from the database
$query = "SELECT month, earnings, expenditures FROM finance";
$result = $conn->query($query);

// Initialize arrays to store data
$months = [];
$earnings = [];
$expenditures = [];

// Loop through the results and store data in arrays
while ($row = $result->fetch_assoc()) {
    $months[] = $row['month'];
    $earnings[] = $row['earnings'];
    $expenditures[] = $row['expenditures'];
}

// Return the data as a JSON object
echo json_encode([
    'months' => $months,
    'earnings' => $earnings,
    'expenditures' => $expenditures,
]);

$conn->close();
?>
