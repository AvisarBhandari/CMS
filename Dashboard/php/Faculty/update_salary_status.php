<?php
include '../db_connect.php';

$id = $_POST['id'];
$newStatus = $_POST['status']; // 'paid' or 'unpaid'

$query = "UPDATE SalaryTransactions SET status = '$newStatus' WHERE id = '$id'";
if ($conn->query($query)) {
    echo "Status updated successfully.";
} else {
    echo "Error: " . $conn->error;
}
$conn->close();

