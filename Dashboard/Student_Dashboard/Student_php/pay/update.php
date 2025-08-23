<?php
// verification.php
include '../db_connect.php';
session_start();





if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['jsVar']) && isset($_POST['hasIndexes'])) {
    echo $_POST['jsVar'];
    echo  $_POST['hasIndexes'];

    exit;
}




if (isset($_COOKIE['studentid'])) {
    echo "Value C is: " . $_COOKIE['studentid'];
    $studentID = $_COOKIE['studentid'];
}
if (isset($_SESSION['studentid'])) {
    echo "Value S is: " . $_SESSION['studentid'];
    $studentID = $_SESSION['studentid'];
}


if ($_SERVER['REQUEST_METHOD']) {
    echo "Session: " . $studentID;

    $index = $_SESSION['selected'];
    $hasIndexes = $_SESSION['hasIndexes'];
}
// echo $hasIndexes;


// Decode Base64 data
$decodedData = base64_decode($_GET['data']);
if ($decodedData === false) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid base64 data']);
    exit;
}

// Decode JSON
$jsonData = json_decode($decodedData, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid JSON']);
    exit;
}

$requiredFields = [
    'transaction_code',
    'status',
    'total_amount',
    'transaction_uuid',
    'product_code',
    'signed_field_names',
    'signature'
];

// Check that all required fields are present
foreach ($requiredFields as $field) {
    if (!isset($jsonData[$field])) {
        http_response_code(400);
        echo json_encode(['error' => "Missing field: $field"]);
        exit;
    }
}


// Store each value in a variable
$transaction_code = $jsonData['transaction_code'];
$status = $jsonData['status'];
$total_amount = $jsonData['total_amount'];
$transaction_uuid = $jsonData['transaction_uuid'];
$product_code = $jsonData['product_code'];
$signed_field_names = $jsonData['signed_field_names'];
$signature = $jsonData['signature'];
$amount = (int)$total_amount - 10;




echo "Amount: " . $amount;
$sendAmount = $amount;


// $amount = 200;

// if ($hasIndexes != 'null'){
//     echo $hasIndexes;
//     echo "not null";

// }else{

//     echo $hasIndexes;
// }


if ($status === 'COMPLETE') {

    // Prepare and execute query once
    $sql = "SELECT id, amount, paid_amount, status 
            FROM student_fees 
            WHERE student_id = ? 
            ORDER BY due_date ASC";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("i", $studentID);

    if (!$stmt->execute()) {
        die("Execute failed: " . $stmt->error);
    }

    $result = $stmt->get_result();

    // Fetch all rows into array
    $allRows = [];
    while ($row = $result->fetch_assoc()) {
        $allRows[] = $row;
    }

    $stmt->close();

    // Check if $hasIndexes is not the string 'null'
    if ($hasIndexes != 1) {
        # code...
        foreach ($allRows as $row) {
            if ($row['status'] == 'Pending') {
                $feeId = $row['id'];
                $totalAmount = $row['amount'];
                $alreadyPaid = $row['paid_amount'];
                $remaining = $totalAmount - $alreadyPaid;

                echo "<br><b>Processing Fee ID $feeId</b><br>";
                echo "Amount: $totalAmount, Paid: $alreadyPaid, Remaining: $remaining";

                if ($amount <= 0 || $remaining <= 0) {
                    echo "<br>⚠️ Skipped: No payment needed or already paid.";
                    continue;
                }

                if ($amount >= $remaining) {
                    $newPaid = $totalAmount;
                    $newStatus = 'Paid';
                    $paymentUsed = $remaining;
                } else {
                    $newPaid = $alreadyPaid + $amount;
                    $newStatus = 'Pending';
                    $paymentUsed = $amount;
                }

                $updateSql = "UPDATE student_fees 
                  SET paid_amount = ?, status = ?, payment_date = ? 
                  WHERE id = ?";
                $updateStmt = $conn->prepare($updateSql);
                if (!$updateStmt) {
                    die("Update prepare failed: " . $conn->error);
                }

                $updateStmt->bind_param("issi", $newPaid, $newStatus, $currentDate, $feeId);
                if (!$updateStmt->execute()) {
                    die("Update execute failed: " . $updateStmt->error);
                }
                $updateStmt->close();

                echo "<br>✅ Payment of $paymentUsed applied to Fee ID: $feeId as '$newStatus'<br>";

                $amount -= $paymentUsed;

                if ($amount <= 0) {
?>
                    <form id="sendForm" method="post" action="success.php">
                        <input type="hidden" name="amount" value="<?php echo htmlspecialchars($sendAmount); ?>">
                    </form>

                    <script>
                        document.getElementById('sendForm').submit();
                    </script>

                <?php
                    $paymentStatus = 'Completed';
                    echo "<br>💰 All payment used up.<br>";
                    break;
                }
            }
        }
    } else {
        // No specific indexes, process all fees in order
        echo "hello<br>";
        echo "Total rows fetched: " . count($allRows) . "<br>";
        echo "student" . $studentID . "<br>";
        foreach ($allRows as $row) {
            $feeId = $row['id'];
            $totalAmount = $row['amount'];
            $alreadyPaid = $row['paid_amount'];
            $remaining = $totalAmount - $alreadyPaid;

            echo "paying Fee ID $feeId: Amount $totalAmount, Paid $alreadyPaid, Remaining $remaining<br>";

            if ($amount <= 0 || $remaining <= 0) {
                echo "⚠️ Skipped Fee ID $feeId: No payment needed or already paid.<br>";
                continue;
            }

            if ($amount >= $remaining) {
                // Fully pay this fee
                $newPaid = $totalAmount;
                $newStatus = 'Paid';
                $paymentUsed = $remaining;
                echo "paid full amount<br>";
            } else {
                // Partial payment
                $newPaid = $alreadyPaid + $amount;
                $newStatus = 'Pending';
                $paymentUsed = $amount;
                echo "partial payment<br>";
            }

            $updateSql = "UPDATE student_fees 
                          SET paid_amount = ?, status = ?, payment_date = ? 
                          WHERE id = ?";
            $updateStmt = $conn->prepare($updateSql);
            if (!$updateStmt) {
                die("Update prepare failed: " . $conn->error);
            }
            $updateStmt->bind_param("issi", $newPaid, $newStatus, $currentDate, $feeId);

            if (!$updateStmt->execute()) {
                die("Update execute failed: " . $updateStmt->error);
            }
            $updateStmt->close();

            $amount -= $paymentUsed;

            if ($amount <= 0) {
                ?>
                <form id="sendForm" method="post" action="success.php">
                    <input type="hidden" name="amount" value="<?php echo htmlspecialchars($sendAmount); ?>">
                </form>

                <script>
                    document.getElementById('sendForm').submit();
                </script>

    <?php
                $paymentStatus = 'Completed';
                echo "Payment amount exhausted.<br>";
                break;
            }
        }
    }
} else {
    ?>
    <form id="sendForm" method="post" action="fail.php">
        <input type="hidden" name="amount" value="<?php echo htmlspecialchars($sendAmount); ?>">
    </form>

    <script>
        document.getElementById('sendForm').submit();
    </script>

<?php
    $paymentStatus = 'Pending';
}



?>