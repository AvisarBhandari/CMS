<?php
session_start();
include 'db_connect.php';
header('Content-Type: application/json');

// Check if the user is logged in and their session is set
if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit();
}

$session_id = $_SESSION['id']; // Session ID of the logged-in user

// Query to get the student_id from students_info table based on session_id
$query = "
    SELECT student_id
    FROM students_info
    WHERE student_roll = ?
";

$stmt = $conn->prepare($query);
$stmt->bind_param("s", $session_id); // Bind the session ID to the query
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $student_id = $row['student_id']; // Fetch the student_id

    // Query to fetch fee data for the retrieved student_id from student_fees table
    $query_fees = "
        SELECT amount, paid_amount, discount, status
        FROM student_fees
        WHERE student_id = ?
    ";

    $stmt_fees = $conn->prepare($query_fees);
    $stmt_fees->bind_param("i", $student_id); // Bind student_id to the query
    $stmt_fees->execute();
    $result_fees = $stmt_fees->get_result();

    $paidAmount = 0;
    $discountAmount = 0;
    $remainingAmount = 0;

    // Process the fee records
    while ($row_fees = $result_fees->fetch_assoc()) {
        if ($row_fees['status'] === 'Paid') {
            $paidAmount += $row_fees['paid_amount'];
            $discountAmount += $row_fees['discount'];
        } elseif ($row_fees['status'] === 'Pending') {
            $remainingAmount += $row_fees['amount'];
        }
    }

    // Return the calculated amounts
    echo json_encode([
        'success' => true,
        'paid_amount' => $paidAmount,
        'discount_amount' => $discountAmount,
        'remaining_amount' => $remainingAmount
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Student not found']);
}

$stmt->close();
$stmt_fees->close();
$conn->close();
?>
