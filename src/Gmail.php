<?php
namespace Unconv\PhpCaptcha;

use PHPMailer\PHPMailer\PHPMailer;

class Gmail
{
    public static function send(
        string $to,
        string $subject,
        string $message
    ) {
        $mail = new PHPMailer();

        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = ""; // put your email here
        $mail->Password = ""; // put your password here

        $mail->setFrom(
            "", // put your email here
            "" // put your name here
        );
        $mail->addAddress( $to );

        $mail->Subject = "Contact from website";
        $mail->Body = $message;

        $mail->send();
    }
}
