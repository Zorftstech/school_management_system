<?php

require_once __DIR__ . '/../bootstrap.php';
require_once __DIR__ . "/../phpmailer/PHPMailer.php";
require_once __DIR__ . "/../phpmailer/SMTP.php";
require_once __DIR__ . "/../phpmailer/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendEmail($email, $subject, $body)
{
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->SMTPDebug = 0; // Set to 3 for debugging
        $mail->Debugoutput = 'html';

        $mail->Host = $_ENV['SMTP_HOST'];
        $mail->SMTPAuth = true;

        $mail->Username = $_ENV['SMTP_USERNAME'];
        $mail->Password = $_ENV['SMTP_PASSWORD'];

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = $_ENV['SMTP_PORT'];

        $mail->setFrom($_ENV['SMTP_FROM_EMAIL'], 'ACADEX');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        // Remove this after fixing your CA certificate issue
        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ],
        ];

        $mail->send();

        return true;
    } catch (Exception $e) {
        return $mail->ErrorInfo;
    }
}