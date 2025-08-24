<?php
include 'number_Format.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount = $_POST['amount'];
    // echo "Amount: " . $amount . "<br>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Failed</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
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

        .card {
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 90%;
        }

        .icon-wrapper {
            background-color: #ff506f;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin: 0 auto;
            margin-top: -60px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .icon-wrapper img {
            width: 30px;
            height: 30px;
        }

        .amount {
            font-size: 28px;
            font-weight: bold;
            margin-top: 20px;
        }

        .message {
            margin-top: 15px;
            font-size: 16px;
        }

        .message b {
            display: block;
            margin-top: 10px;
        }

        .payment-id {
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }

        .btn {
            margin-top: 25px;
            background-color: #1aaa55;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #158e47;
        }
    </style>
</head>

<body>

    <div class="card">
        <div class="icon-wrapper">
            <img src="https://img.icons8.com/ios-filled/50/ffffff/cancel.png" alt="Error Icon">
        </div>
        <div class="amount">
            <?php
            echo "₹" . format_NP_Number($amount);
            ?></div>
        <div class="message">
            <b>Payment Failed!</b>
            Hey, seems like there was some trouble.<br>
            We are there with you. Just hold back.
        </div>
        <div class="payment-id">
            <?php
            echo date('d M,Y-h:i A');
            ?>
        </div>
        <form action="../../">

            <input type="submit" value="TRY AGAIN" class="btn">
        </form>
    </div>
    <footer>&copy; Copyright © Academy Keeper 2025</footer>

</body>

</html>