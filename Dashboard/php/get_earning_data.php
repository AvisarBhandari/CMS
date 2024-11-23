<?php
include 'db_connect.php';
$monthsList = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

$months = [];
$earnings = [];
$expenditures = [];
foreach ($monthsList as $month) {
    $query = "SELECT month, income, expenditure FROM monthlyfinance WHERE month = '$month'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $months[] = $row['month'];
            $earnings[] = $row['income'];
            $expenditures[] = $row['expenditure'];
        }
    }
}

if (empty($months)) {
    echo json_encode(['error' => 'No data found for any month.']);
} else {
    // Return the data as a JSON object
    echo json_encode([
        'months' => $months,
        'earnings' => $earnings,
        'expenditures' => $expenditures,
    ]);
}
$conn->close();

