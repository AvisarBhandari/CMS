<?php
session_start();
include '../db_connect.php';
include 'number_Format.php';
// include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $studentId = $_POST['student_id'];
  if ($studentId) {
    setcookie("studentid", $studentId, time() + 3600, "/");
    // echo "Cookie set for student ID: $studentId";
  } else {
    // echo "Student ID missing.";
  }


  $amount = format_NP_Number(number: $_POST['amount']) ?? null;
  $_SESSION['studentid'] = $studentId;
  //     if ($studentId && $amount) {
  // echo "Processing payment of ₹{$amount} for student ID: {$_SESSION['studentid']}";
  //     } else {
  //         echo "Invalid payment request.";
  //     }
  // } else {
  //     echo "Invalid access.";
}
?>
<?php


// Fetch all fee rows for the student
$query = "SELECT amount, paid_amount, discount, status, due_date 
          FROM student_fees 
          WHERE student_id = ? 
          ORDER BY due_date ASC";
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
$totalDue = format_NP_Number($totalDue);
// echo " Total Due: {$totalDue}";
$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Payment | Academy Keeper</title>

  <style>
    html,
    body {
      height: 100%;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: Arial, sans-serif;
      background: #fff;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    .wrapper {
      flex: 1;
      display: flex;
      flex-direction: column;
    }


    .container {
      display: flex;
      justify-content: space-between;
      padding: 40px;
    }

    .left {
      width: 24%;
    }

    .right {
      width: 55%;
    }

    img.logo {
      width: 156px;
      margin-bottom: 81px;
      margin-top: -54px;
    }

    h2 {
      font-size: 22px;
    }

    .fee-list {
      margin: 20px 0;
    }

    .fee-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 10px;
      border-bottom: 1px solid #ddd;
      cursor: pointer;
    }

    .fee-item:hover {
      background: #f9f9f9;
    }

    .fee-item.selected {
      background: #e0f7fa;
    }

    .fee-item span.status {
      background: yellow;
      padding: 2px 6px;
      border-radius: 4px;
      font-size: 12px;
    }

    .summary {
      margin-top: 70px;
      margin-left: 116px;
    }

    .leftcontainer {
      margin-left: 142px;
    }

    .form-control {
      padding: 10px;
      width: 200px;
    }

    .pay-btn {
      margin-top: 20px;
      background: black;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }

    .wrapper {
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    footer {
      position: fixed;
      bottom: 0;
      left: 0;
      width: 100%;
      background-color: #fff;
      /* Match page background */
      border-top: 1px solid #ddd;
      text-align: center;
      padding: 10px 0;
      font-size: 14px;
      color: #888;
      z-index: 999;
    }


    .fee-checkbox {
      margin-right: 10px;
    }

    .fee-left {
      display: flex;
      align-items: center;
    }
  </style>
</head>



<body>

  <div class="container">
    <!-- Left -->
    <div class="left">

      <img src="../../assets/img/logo.png" alt="Academy Keeper" class="logo">

      <h2>Your Fee, Just a Click Away</h2>
      <p style="color:gray;">Secure & hassle-free payment</p>
    </div>

    <div class="left leftcontainer">
      <h2>Payment</h2>
      <p><strong>Pending Installments</strong></p>

      <?php
      $get_index = null; // initialize before loop

      foreach ($dues as $index => $due):
        $isMatch = (format_NP_Number($due['amount']) == $amount);
        if ($isMatch) {
          $get_index = $index;
        }
      ?>
        <div class="fee-item "
          data-amount="<?= $due['amount'] ?>"
          data-index="<?= $index ?>">

          <div class="fee-left">
            <input type="checkbox"
              class="fee-checkbox"
              id="feeCheckbox<?= $index ?>"
              style="display:none;">

            <span>Amount: ₹<?= format_NP_Number($due['amount']) ?></span>
          </div>

          <span class="status">pending</span>
        </div>
      <?php endforeach; ?>

      <script>
        // console.log('Match found:', <?= json_encode($get_index !== null) ?>);
        // console.log('Matching index:', <?= json_encode($get_index) ?>);
      </script>





    </div>

    <!-- Right -->
    <div class="right">
      <div class="summary">
        <h3>Payment Summary</h3>
        <form method="POST" action="">
          <input type="hidden" name="student_id" value="<?= $studentId ?>">

          <label>
            <input type="checkbox" id="useCustomAmount">
            Use Custom Amount
          </label>
          <br><br>

          <input type="number" name="amount" class="form-control" id="customAmount" value="<?= $amount ?>" disabled />

          <p>Total: ₹<span id="totalFee"><?= $totalDue ?></span></p>
          <p>You are About to pay: ₹<span id="total"></span></p>
          <p>Your Remaining Fee: ₹<span id="remainingFee"></span></p>


          <button type="submit" class="pay-btn" id="payBtn">Proceed To Pay</button>
        </form>

      </div>
    </div>
  </div>
  </div>

  <footer>&copy; Copyright © Academy Keeper 2025</footer>
  <script>
    var amount_Send = 0;

    let amount_selected = <?= json_encode($_POST['amount']) ?>;
    amount_selected = parseInt(amount_selected);

    // console.log(amount_selected);

    document.addEventListener('DOMContentLoaded', function() {
      fetchFeeDetails();
    });

    let pending_Amount = 0;
    let remaining_amount = 0;
    let selectedAmounts = {};
    var selectedIndexes = []; // <-- store selected indexes

    const feeItems = document.querySelectorAll('.fee-item');
    const totalDisplay = document.getElementById("total");
    const customAmount = document.getElementById("customAmount");
    const useCustomAmount = document.getElementById("useCustomAmount");

    totalDisplay.innerText = <?= format_NP_Number($amount) ?>;

    function fetchFeeDetails() {
      fetch('../fee_data.php')
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            pending_Amount = data.remaining_amount;
            remaining_amount = data.remaining_amount;

            document.querySelector('#totalFee').textContent = pending_Amount.toLocaleString('en-IN');
            document.getElementById("remainingFee").innerText = remaining_amount.toLocaleString('en-IN');

            // console.log('Pending Amount:', pending_Amount);
            // console.log('Remaining Amount:', remaining_amount);

            //  Call toggleSelection after remaining_amount is set
            const matchedIndex = <?= json_encode($get_index) ?>;
            const matchedAmount = amount_selected;
            const matchedItem = feeItems[matchedIndex];

            if (matchedItem) {
              const matchedCheckbox = matchedItem.querySelector('.fee-checkbox');
              matchedCheckbox.checked = true;
              toggleSelection(matchedIndex, matchedAmount, matchedItem, true);
            }
          }
        })
        .catch(error => {
          console.error('Error fetching fee details:', error);
        });
    }

    feeItems.forEach((item, idx) => {
      const checkbox = item.querySelector('.fee-checkbox');
      const amount = parseFloat(item.dataset.amount);

      item.addEventListener('click', (e) => {
        if (useCustomAmount.checked) {
          useCustomAmount.checked = false;
          customAmount.disabled = true;
          customAmount.value = 0;
        }

        checkbox.click(); // triggers the `change` event
      });

      checkbox.addEventListener('change', () => {
        toggleSelection(idx, amount, item, checkbox.checked);
      });
    });

    function toggleSelection(index, amount, element, isSelected) {
      if (isSelected) {
        selectedAmounts[index] = amount;
        // Add index if not already present
        if (!selectedIndexes.includes(index)) {
          selectedIndexes.push(index);
        }
        remaining_amount = Math.max(0, remaining_amount - amount);
        element.classList.add('selected');
      } else {
        delete selectedAmounts[index];
        // Remove index if present
        const i = selectedIndexes.indexOf(index);
        if (i > -1) {
          selectedIndexes.splice(i, 1);
        }
        remaining_amount += amount;
        element.classList.remove('selected');
      }

      document.getElementById("remainingFee").innerText = remaining_amount.toLocaleString('en-IN');
      updateTotal();

      // console.log('Selected indexes:', selectedIndexes);
    }

    function updateTotal() {
      const total = Object.values(selectedAmounts).reduce((sum, val) => sum + val, 0);
      totalDisplay.innerText = total.toLocaleString('en-IN');

      // console.log('Total selected amount:', total);
      amount_Send = total;

      if (!useCustomAmount.checked) {
        customAmount.value = total;
        amount_Send = total;

      }
    }

    let bulkUpdating = false;







    useCustomAmount.addEventListener('change', () => {
      if (useCustomAmount.checked) {
        customAmount.disabled = false;
        remaining_amount = pending_Amount;



        document.getElementById('customAmount').addEventListener('input', function(e) {
          let rawValue = e.target.value;

          let parsedAmount = parseInt(rawValue);

          if (isNaN(parsedAmount)) {
            parsedAmount = 0;
          }

          let formattedAmount = parsedAmount.toLocaleString('en-IN');

          var total = formattedAmount;

          // console.log("Current amount:", total);
          totalDisplay.innerText = total;
          amount_Send = total;
          remaining_amount_custom = Math.max(0, remaining_amount - parsedAmount);

          document.getElementById("remainingFee").innerText = remaining_amount_custom.toLocaleString('en-IN');



        });



        bulkUpdating = true; // Start bulk update

        // Unselect all pending fees
        feeItems.forEach((item, idx) => {
          const checkbox = item.querySelector('.fee-checkbox');
          checkbox.checked = false;
          toggleSelection(idx, parseFloat(item.dataset.amount), item, false);
        });

        bulkUpdating = false; // End bulk update

        customAmount.value = 0;
        totalDisplay.innerText = 0;
        selectedIndexes = [];

        // Update remaining fee display after reset
        document.getElementById("remainingFee").innerText = remaining_amount.toLocaleString('en-IN');
      } else {
        customAmount.disabled = true;
        updateTotal();
      }
    });

    function toggleSelection(index, amount, element, isSelected) {
      if (isSelected) {
        selectedAmounts[index] = amount;
        if (!selectedIndexes.includes(index)) selectedIndexes.push(index);

        if (!bulkUpdating) {
          remaining_amount = Math.max(0, remaining_amount - amount);
        }

        element.classList.add('selected');
      } else {
        delete selectedAmounts[index];
        const i = selectedIndexes.indexOf(index);
        if (i > -1) selectedIndexes.splice(i, 1);

        if (!bulkUpdating) {
          remaining_amount += amount;
        }

        element.classList.remove('selected');
      }

      if (!bulkUpdating) {
        document.getElementById("remainingFee").innerText = remaining_amount.toLocaleString('en-IN');
        updateTotal();
      }

      console.log('Selected indexes:', selectedIndexes);
    }


    function completePayment() {

      <?php


      if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['jsVar']) && isset($_POST['hasIndexes'])) {
        $_SESSION['selected'] = $_POST['jsVar'];
        $_SESSION['hasIndexes'] = $_POST['hasIndexes'];


        exit;
      }
      ?>


      let jsValue = numericIndexes = selectedIndexes.map(Number);
      let hasIndexes = selectedIndexes.length > 0 ? 1 : null;
      console.log(jsValue);
      console.log(hasIndexes);

      fetch("", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded"
          },
          body: "jsVar=" + encodeURIComponent(jsValue) + "&hasIndexes=" + encodeURIComponent(hasIndexes)
        })
        .then(response => response.text())
        .then(data => {
          document.getElementById("response").innerText = data;
        });
    }



    document.getElementById('payBtn').addEventListener('click', completePayment);



    var signature;
    var tax_amount;
    var total_amount;
    var transaction_uuid;
    var product_code;
    var product_service_charge;
    var product_delivery_charge;



    document.getElementById('payBtn').addEventListener('click', function(event) {
      event.preventDefault();

      fetch('epay-handler.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            amount: amount_Send
          })
        })
        .then(response => {
          if (!response.ok) throw new Error('Network response was not ok ' + response.status);
          return response.json();
        })
        .then(data => {
          // console.log('Server response:', data);
          signature = data.signature;
          tax_amount = data.tax_amount;
          total_amount = data.total_amount;
          transaction_uuid = data.transaction_uuid;
          product_code = data.product_code;
          product_service_charge = data.product_service_charge;
          product_delivery_charge = data.product_delivery_charge;
          // console.log("amount",amount_Send);
          // console.log("tax amount",tax_amount);
          // console.log("total amount",total_amount);
          // console.log("product code",product_code);
          // console.log("product service charge",product_service_charge);
          // console.log("product delivery charge",product_delivery_charge);
          // console.log("transaction uuid",transaction_uuid);
          // console.log("signature",signature);

          document.getElementById("amount_send").value = amount_Send;
          document.getElementById("tax_amount").value = tax_amount;
          document.getElementById("total_amount").value = total_amount;
          document.getElementById("transaction_uuid").value = transaction_uuid;
          document.getElementById("product_code").value = product_code;
          document.getElementById("product_service_charge").value = product_service_charge;
          document.getElementById("product_delivery_charge").value = product_delivery_charge;
          document.getElementById("signature").value = signature;
          document.getElementById('mySubmit').click();




        })
        .catch(error => console.error('Fetch error:', error));



    });
  </script>
  <div style="display: none;">

    <form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST">

      <input type="text" id="amount_send" name="amount" required>

      <input type="text" id="tax_amount" name="tax_amount" required>

      <input type="text" id="total_amount" name="total_amount" required>

      <input type="text" id="transaction_uuid" name="transaction_uuid" required>

      <input type="text" id="product_code" name="product_code" required>

      <input type="text" id="product_service_charge" name="product_service_charge" required>

      <input type="text" id="product_delivery_charge" name="product_delivery_charge" required>

      <input type="text" id="success_url" name="success_url" value="http://localhost/CMS/Dashboard/Student_Dashboard/Student_php/pay/update.php" required>
      <input type="text" id="failure_url" name="failure_url" value="http://localhost/CMS/Dashboard/Student_Dashboard/Student_php/pay/update.php" required>
      <input type="text" id="signed_field_names" name="signed_field_names" value="total_amount,transaction_uuid,product_code" required>
      <input type="text" id="signature" name="signature" required>
      <input value="Submit" type="submit" id="mySubmit">
    </form>
  </div>
</body>

</html>