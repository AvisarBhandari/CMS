<?php
include '../db_connect.php';
if (!isset($_POST['student_id']) || !isset($_POST['installment_no']) || !isset($_POST['status']) || !isset($_POST['amount'])) {
    die('Missing POST data.');
}

$studentId = $_POST['student_id'];
$installmentNo = $_POST['installment_no'];
$status = $_POST['status'];  
$amount = $_POST['amount'];  


echo "Student ID: $studentId, Installment No: $installmentNo, Status: $status, Amount: $amount";


$query = "UPDATE student_fees 
          SET status = ?, paid_amount = NULL, discount = 0, payment_date = NULL 
          WHERE student_id = ? AND installment_no = ?";
$stmt = $conn->prepare($query);


if ($stmt === false) {
    die('Error preparing statement: ' . $conn->error);
}

$stmt->bind_param('sii', $status, $studentId, $installmentNo);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "Payment unmarked successfully!";
} else {
    echo "Failed to unmark payment or no changes made.";
}

$stmt->close();
?>
