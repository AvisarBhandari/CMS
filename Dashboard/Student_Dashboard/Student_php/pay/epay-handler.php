 <?php
header('Content-Type: application/json');

// Get raw POST data
$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['amount']) || !is_numeric($input['amount'])) {
    echo json_encode(['error' => 'Invalid or missing amount']);
    exit;
}

$amount = floatval($input['amount']);
$tax_amount = 10;
$total_amount = $amount + $tax_amount;

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}

$transaction_uuid = time() . generateRandomString(16);

$product_code = 'EPAYTEST';
$product_service_charge = 0;
$product_delivery_charge = 0;
$secretKey = '8gBm/:&EnhH.1/q';

$message = "total_amount={$total_amount},transaction_uuid={$transaction_uuid},product_code={$product_code}";
$signature = base64_encode(hash_hmac('sha256', $message, $secretKey, true));


$response = [
    'amount' => $amount,
    'tax_amount' => $tax_amount,
    'total_amount' => $total_amount,
    'transaction_uuid' => $transaction_uuid,
    'product_code' => $product_code,
    'product_service_charge' => $product_service_charge,
    'product_delivery_charge' => $product_delivery_charge,
    'signature' => $signature
];

echo json_encode($response); 
