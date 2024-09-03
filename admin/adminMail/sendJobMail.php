<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$mailSent = false;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["send"])) {
    $jobSeekerEmail = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

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
        $mail->addAddress($jobSeekerEmail); // Sending to the job seeker's email
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = nl2br($message);

        $mail->send();
        $mailSent = true;
    } catch (Exception $e) {
        $mailSent = false;
    }

    // Redirect with status
    $status = $mailSent ? 'success' : 'error';
    header("Location: ../accept_mail.php?status=$status");
    exit();
} else {
    echo "No email specified.";
}
?>
