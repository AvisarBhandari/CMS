<?php
// Include your database connection file
include('db_connect.php');

// Define the query to get fee data
$query = "
    SELECT 
        SUM(CASE WHEN status = 'Paid' THEN paid ELSE 0 END) AS total_paid,
        SUM(CASE WHEN status = 'Pending' THEN amount ELSE 0 END) AS total_due,
        SUM(CASE WHEN status = 'Partially Paid' THEN paid ELSE 0 END) AS total_partially_paid
    FROM fees
";

// Execute the query and check for errors
$result = mysqli_query($conn, $query);

if (!$result) {
    // Handle any errors in executing the query
    echo json_encode(['error' => 'Failed to fetch data from database']);
    exit;
}

// Fetch the result
$data = mysqli_fetch_assoc($result);

// Prepare the data for the chart
$chart_data = [
    "labels" => ["Total Paid", "Total Due", "Total Partially Paid"],
    "datasets" => [
        [
            "label" => "Fees Breakdown",
            "backgroundColor" => [
                "rgba(30, 122, 109, 0.85)",  
                "rgba(229, 5, 58, 0.85)",    
                "rgba(249, 232, 20, 0.85)"   
            ],
            "borderColor" => [
                "rgba(30, 122, 109, 0.90)",    
                "rgba(229, 5, 58, 0.90)",      
                "rgba(249, 232, 20, 0.90)"     
            ],
            "borderWidth" => 3,  
            "hoverBackgroundColor" => [
                "rgba(30, 122, 109, 1)",   
                "rgba(229, 5, 58, 1)",     
                "rgba(249, 232, 20, 1)"    
            ],
            "hoverBorderColor" => [
                "rgba(0, 0, 0, 0.2)",      
                "rgba(0, 0, 0, 0.2)",
                "rgba(0, 0, 0, 0.2)"
            ],
            "data" => [
                $data['total_paid'] ?? 0, 
                $data['total_due'] ?? 0, 
                $data['total_partially_paid'] ?? 0
            ]
        ]
    ]
];

// Return the chart data as a JSON response
header('Content-Type: application/json');
echo json_encode($chart_data);

//sql
// CREATE TABLE fees (
//     fee_id INT AUTO_INCREMENT PRIMARY KEY,
//     student_id INT NOT NULL,
//     amount DECIMAL(10, 2) NOT NULL,
//     paid DECIMAL(10, 2) DEFAULT 0.00,
//     due_amount DECIMAL(10, 2) DEFAULT 0.00,
//     status ENUM('Paid', 'Pending', 'Partially Paid') NOT NULL,
//     due_date DATE NOT NULL,
//     paid_date DATE,
//     FOREIGN KEY (student_id) REFERENCES students(id)
// );
