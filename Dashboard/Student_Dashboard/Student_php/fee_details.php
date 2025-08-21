<?php 
session_start();
include 'db_connect.php';
header('Content-Type: application/json');


if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit();
}


$session_id = $_SESSION['id'];


$query = "SELECT student_id FROM students_info WHERE student_roll = ?";
$stmt = $conn->prepare($query);
if ($stmt === false) {
    echo json_encode(['success' => false, 'message' => 'Failed to prepare query']);
    exit();
}
$stmt->bind_param("s", $session_id);
$stmt->execute();


$stmt->bind_result($student_id);
$stmt->fetch();
$stmt->close();

if (!$student_id) {
    echo json_encode(['success' => false, 'message' => 'Student not found']);
    exit();
}


$query = "
    SELECT due_date, status, amount, discount, paid_amount, payment_date
    FROM student_fees
    WHERE student_id = ?
    ORDER BY due_date
";

$stmt = $conn->prepare($query);
if ($stmt === false) {
    echo json_encode(['success' => false, 'message' => 'Failed to prepare query']);
    exit();
}

$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();


$installments = [];
while ($row = $result->fetch_assoc()) {
    $installments[] = $row;
}

if (!empty($installments)) {
    echo json_encode(['success' => true, 'installments' => $installments]);
} else {
    echo json_encode(['success' => false, 'message' => 'No installment data found']);
}

$stmt->close();
$conn->close();
