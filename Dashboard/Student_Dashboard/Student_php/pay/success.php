<?php
include 'number_Format.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount = $_POST['amount'];
    $transaction_code = $_POST['transaction_code'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html,
    body {
        height: 100%;
    }

    body {
        font-family: Arial, sans-serif;
        background: #ffffff;
        color: #333;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .wrapper {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .container {
        text-align: center;
        padding: 40px;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        background-color: #fff;
    }

    .success-icon {
        font-size: 48px;
        color: #28a745;
        margin-bottom: 20px;
    }

    h1 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .details {
        text-align: left;
        margin-bottom: 30px;
    }

    .details p {
        margin: 8px 0;
    }

    .details strong {
        width: 150px;
        display: inline-block;
    }

    .btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        font-weight: bold;
        transition: background 0.3s;
    }

    .btn:hover {
        background-color: #0056b3;
    }

    footer {
        text-align: center;
        padding: 20px 0;
        font-size: 14px;
        color: #888;
    }
</style>

<body>
    <div class="wrapper">
        <div class="container">
            <div class="success-icon">✔</div>
            <br>
            <h1>Payment Successful</h1>
            <br>
            <div class="details">
                <p><strong>Amount Paid:</strong> <span>₹<?php echo htmlspecialchars(format_NP_Number($amount)); ?></span></p>
                <p><strong>Date & Time:</strong> <span><?php echo date("F j, Y, g:i A"); ?></span></p>
                <p><strong>Transaction Code:</strong> <span><?php echo htmlspecialchars($transaction_code); ?></span></p>

                <p><strong>Payment Method:</strong> <span>Esewa</span></p>
            </div>
            <br>
            <a href="../../" class="btn">Return to Homepage</a>
        </div>
    </div>

    <footer>&copy; Copyright © Academy Keeper 2025</footer>
</body>

</html>