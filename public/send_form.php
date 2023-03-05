<?php
use Unconv\PhpCaptcha\Gmail;

$email = ""; // put your email here

require_once( __DIR__ . "/../vendor/autoload.php" );

$message = "Name: "    . $_POST['name']    . "\n".
           "Email: "   . $_POST['email']   . "\n".
           "Message: " . $_POST['message'];

$sent_code = $_POST['check'];
$sent_id = preg_replace( '/[^A-Za-z0-9]/', '', $_POST['id'] );

$captcha_file = __DIR__ . "/../captchas/captcha_" . $sent_id;
$correct_answer = file_get_contents( $captcha_file );

if( (string)$sent_code !== (string)$correct_answer ) {
    echo "You are a bot!";
    exit;
}

Gmail::send(
    to: $email,
    subject: "Contact from Website",
    message: $message
);

header( "Location: /thankyou.php" );
