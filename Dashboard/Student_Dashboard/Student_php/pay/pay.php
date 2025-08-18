<?php
session_start();
include '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studentId = $_POST['student_id'] ?? null;
    $amount = $_POST['amount'] ?? null;

    if ($studentId && $amount) {
        echo "Processing payment of ₹{$amount} for student ID: {$studentId}";
    } else {
        echo "Invalid payment request.";
    }
} else {
    echo "Invalid access.";
}
?>



<?php


// Fetch all fee rows for the student
$query = "SELECT amount, paid_amount, discount, status FROM student_fees WHERE student_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $studentId);
$stmt->execute();
$result = $stmt->get_result();

$dues = [];
$totalDue = 0;

while ($row = $result->fetch_assoc()) {
    if (strtolower($row['status']) === 'pending') {
        $dues[] = $row;
        $totalDue += $row['amount'];
    }
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pay Fees</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .list-group-item {
            cursor: pointer;
        }
        .list-group-item.active {
            background-color: #0d6efd;
            color: white;
            border-color: #0d6efd;
        }
    </style>
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="row">

        <!-- Sidebar: Due Installments -->
        <div class="col-md-4">
            <h4 class="mb-3">Pending Installments</h4>
            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="paymentType" id="useInstallments" checked>
                <label class="form-check-label" for="useInstallments">Select from Installments</label>
            </div>

            <ul class="list-group" id="installmentList">
                <?php if (count($dues) > 0): ?>
                    <?php foreach ($dues as $index => $due): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center"
                            data-amount="<?= $due['amount'] ?>">
                            Amount: ₹<?= number_format($due['amount'], 2) ?>
                            <span class="badge bg-warning text-dark"><?= $due['status'] ?></span>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li class="list-group-item text-muted">No pending dues</li>
                <?php endif; ?>
            </ul>
        </div>

        <!-- Main Section -->
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5>Payment Summary</h5>
                </div>
                <div class="card-body">
                    <form method="get" id="paymentForm">
                        <input type="hidden" name="student_id" value="<?= htmlspecialchars($studentId) ?>">

                        <div class="form-check mb-3 mt-3">
                            <input class="form-check-input" type="radio" name="paymentType" id="useCustom">
                            <label class="form-check-label" for="useCustom">Enter Custom Amount</label>
                        </div>

                        <div class="mb-3">
                            <input type="number" step="0.01" class="form-control" name="custom_amount" id="customAmount" placeholder="Enter custom amount" disabled>
                        </div>

                        <div class="alert alert-info" id="amountPreview">
                            You're about to pay: ₹<span id="displayAmount"><?= number_format($amount ?? 0, 2) ?></span>
                        </div>

                        <input type="hidden" name="final_amount" id="finalAmount" value="0">
                        <input type="submit" class="btn btn-success" value="Proceed to Pay">
                    </form>
                </div>
            </div>



        </div>
    </div>
</div>

<!-- JS logic -->
<script>
    const installmentItems = document.querySelectorAll('#installmentList .list-group-item');
    const useInstallmentsRadio = document.getElementById('useInstallments');
    const useCustomRadio = document.getElementById('useCustom');
    const customAmountInput = document.getElementById('customAmount');
    const displayAmount = document.getElementById('displayAmount');
    const finalAmountInput = document.getElementById('finalAmount');

    let selectedInstallmentAmounts = [];

    // Toggle input behavior
    useInstallmentsRadio.addEventListener('change', () => {
        customAmountInput.disabled = true;
        customAmountInput.value = '';
        updateInstallmentTotal();
    });

    useCustomRadio.addEventListener('change', () => {
        customAmountInput.disabled = false;
        clearInstallmentSelection();
        updateAmountDisplay(0);
    });

    // Handle click on installments
    installmentItems.forEach(item => {
        item.addEventListener('click', () => {
            if (!useInstallmentsRadio.checked) {
                useInstallmentsRadio.checked = true;
                useCustomRadio.checked = false;
                customAmountInput.disabled = true;
                customAmountInput.value = '';
            }

            item.classList.toggle('active');
            updateInstallmentTotal();
        });
    });

    // Handle custom input
    customAmountInput.addEventListener('input', () => {
        if (!useCustomRadio.checked) {
            useCustomRadio.checked = true;
            useInstallmentsRadio.checked = false;
            clearInstallmentSelection();
        }
        const value = parseFloat(customAmountInput.value) || 0;
        updateAmountDisplay(value);
    });

    function updateInstallmentTotal() {
        let total = 0;
        installmentItems.forEach(item => {
            if (item.classList.contains('active')) {
                total += parseFloat(item.dataset.amount);
            }
        });
        updateAmountDisplay(total);
    }

    function updateAmountDisplay(value) {
        displayAmount.textContent = value.toFixed(2);
        finalAmountInput.value = value.toFixed(2);
    }

    function clearInstallmentSelection() {
        installmentItems.forEach(item => item.classList.remove('active'));
    }
</script>
</body>
</html>
