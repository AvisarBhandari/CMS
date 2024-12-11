<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_POST['student_id'];
    $scholarship_id = $_POST['scholarship_id'];

    $sql = "SELECT discount_percentage FROM scholarships WHERE id = $scholarship_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $discount = $row['discount_percentage'];

    $sql = "SELECT amount FROM fees WHERE student_id = $student_id AND status = 'Pending' LIMIT 1";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $amount = $row['amount'];

    $final_amount = $amount - ($amount * $discount / 100);
    $payment_date = date('Y-m-d');

    $update_fee = "UPDATE fees SET status = 'Paid', scholarship = $discount, final_amount = $final_amount, payment_date = '$payment_date' WHERE student_id = $student_id AND status = 'Pending' LIMIT 1";
    $conn->query($update_fee);

    $insert_payment = "INSERT INTO payments (fee_id, paid_amount, discount, total_paid, payment_date) VALUES (LAST_INSERT_ID(), $amount, $discount, $final_amount, '$payment_date')";
    $conn->query($insert_payment);

    echo "Fee marked as paid.";
}
