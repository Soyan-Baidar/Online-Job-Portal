<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$mailSent = false;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["send"])) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'jobbloominfo@gmail.com';
        $mail->Password = 'xcmf vlyh clgj mooe';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('jobbloominfo@gmail.com', 'Job Bloom');
        $mail->addAddress('jobbloominfo@gmail.com'); // Sending to your email
        $mail->isHTML(true);
        $mail->Subject = $_POST["subject"];
        $mail->Body = "Name: " . $_POST["name"] . "<br>Email: " . $_POST["email"] . "<br>Message: " . nl2br($_POST["message"]);

        $mail->send();
        $mailSent = true;
    } catch (Exception $e) {
        $mailSent = false;
    }

    // Redirect with status
    $status = $mailSent ? 'success' : 'error';
    header("Location: ../contact.php?status=$status");
    exit();
}
?>
