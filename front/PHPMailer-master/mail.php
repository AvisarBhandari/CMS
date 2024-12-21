<?php
require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $senderEmail = $_POST['senderEmail']; // Get sender email from form
    $senderName = $_POST['senderName']; // Get sender name from form
    $subject = $_POST['subject'];    // Get email subject
    $message = $_POST['message'];    // Get email message

    // Handle file upload
    $attachment = $_FILES['attachment'];

    $mail = new PHPMailer(true);

    try {
        // SMTP Server Configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'mahabirrathod30@gmail.com'; // Your Gmail address
        $mail->Password = 'lowf vlur qylz xesi';        // Gmail app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Sender (Static) and Fixed Recipient (mahabirrathod30@gmail.com)
        $mail->setFrom('mahabirrathod30@gmail.com', 'Mahabir Rathod'); // Fixed sender email (this can be your email)
        $mail->addAddress('mahabirrathod30@gmail.com'); // Fixed recipient email (Mahabir's email)
        
        // Set the Reply-To header dynamically
        $mail->addReplyTo($senderEmail, $senderName); // Dynamic reply-to based on form input

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = $subject; // Dynamic subject from form
        $mail->Body = nl2br(htmlspecialchars($message)); // Dynamic message from form
        $mail->AltBody = strip_tags($message); // Plain text alternative

        // Add attachment if present
        if (isset($attachment) && $attachment['error'] == UPLOAD_ERR_OK) {
            $mail->addAttachment($attachment['tmp_name'], $attachment['name']);
        }

        // Send the email
        $mail->send();
        echo 'Message has been sent successfully';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo 'Invalid request method.';
}
?>
