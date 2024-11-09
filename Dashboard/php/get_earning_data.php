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

// SQL 
// CREATE TABLE finance (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     month VARCHAR(20) NOT NULL,
//     earnings DECIMAL(10, 2) NOT NULL,
//     expenditures DECIMAL(10, 2) NOT NULL
// );
// INSERT INTO finance (month, earnings, expenditures) VALUES
// ('Jan', 10000.00, 5000.00),
// ('Feb', 15000.00, 7000.00),
// ('Mar', 12000.00, 8000.00),
// ('Apr', 17000.00, 6000.00),
// ('May', 16000.00, 10000.00),
// ('Jun', 19000.00, 11000.00),
// ('Jul', 21000.00, 8000.00),
// ('Aug', 22000.00, 9500.00),
// ('Sep', 25000.00, 10500.00),
// ('Oct', 20000.00, 15000.00),
// ('Nov', 18000.00, 13000.00),
// ('Dec', 23000.00, 14000.00);

?>
