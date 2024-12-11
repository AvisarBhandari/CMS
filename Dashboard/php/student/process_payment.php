<?php
include('../db_connect.php');
$studentId = $_POST['student_id'];
$installmentNo = $_POST['installment_no'];
$status = $_POST['status'];
$amount = $_POST['amount'];
$discount = $_POST['discount'];
$paidAmount = $_POST['paid_amount'];
$paymentDate = $_POST['payment_date'];
error_log("Student ID: $studentId, Installment No: $installmentNo, Status: $status, Amount: $amount, Discount: $discount, Paid Amount: $paidAmount, Payment Date: $paymentDate");
$query = "UPDATE student_fees 
          SET 
              status = ?, 
              amount = ?, 
              discount = ?, 
              paid_amount = ?, 
              payment_date = ? 
          WHERE student_id = ? AND installment_no = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param('sdddsii', $status, $amount, $discount, $paidAmount, $paymentDate, $studentId, $installmentNo);

if ($stmt->execute()) {
    echo "Payment recorded successfully!";
} else {
    // Debugging: Check for errors
    error_log("Error updating record: " . $stmt->error);
    echo "Error: " . $stmt->error;
}
$stmt->close();
$conn->close();

