<?php
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

ini_set('html_errors', false);

if (empty($_POST['to']) || empty($_POST['subject']) || empty($_POST['message']) || empty($_POST['additional_headers']) || empty($_POST['additional_parameters'])) {
    die(
        'Error: Missing parameters.<br>' .
        'Receiver (to): ' . htmlspecialchars($_POST['to']) . '<br>' .
        'Subject: ' . htmlspecialchars($_POST['subject']) . '<br>' .
        'Message: ' . htmlspecialchars($_POST['message']) . '<br>' .
        'Additional Headers: ' . htmlspecialchars($_POST['additional_headers']) . '<br>' .
        'Additional Parameters: ' . htmlspecialchars($_POST['additional_parameters']) . '<br>'
    );
}

$to = $_POST['to'];
$subject = utf8_encode($_POST['subject']);
$message = $_POST['message'];
$additional_headers = $_POST['additional_headers'];
$additional_parameters = $_POST['additional_parameters'];
$type = $_POST['type'];

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com'; // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true; // Enable SMTP authentication
    $mail->Username   = 'username@gmail.com'; // SMTP username
    $mail->Password   = 'your-app-password'; // SMTP password
    $mail->SMTPSecure = 'tls'; // Enable TLS encryption
    $mail->Port       = 587; // TCP port to connect to

    //Recipients
    $mail->setFrom($additional_parameters, $additional_headers);
    $mail->addAddress($to);

    // Content
    $mail->isHTML($type == 1);
    $mail->Subject = $subject;
    $mail->Body    = $message;

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>