<?php
require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Import configuration
$config = require 'config.php';

$mail = new PHPMailer(true);

try {
    // Retrieve POST data from the AJAX request
    $email = $_POST['email'];  // Capture email from the POST data
    $name = $_POST['name'];    // Capture name from the POST data
    $subject = $_POST['subject'];  // Capture subject from the POST data
    $message = $_POST['body'];    // Capture body content

    // SMTP Configuration
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = $config['email']; 
    $mail->Password = $config['password'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Email Setup
    $mail->setFrom($config['email'], 'Academy Keeper'); // Sender
    $mail->addAddress($email); // Recipient (email from POST)
    $mail->addReplyTo($email, $name);  // Set reply-to with email and name from POST

    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = nl2br(htmlspecialchars($message));
    $mail->AltBody = strip_tags($message);

    // Send email
    $mail->IsHTML(true);
    $mail->send();
    echo 'success';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
