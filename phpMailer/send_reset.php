<?php

use PHPMailer\PHPMailer\PHPMailer;

require 'vendor/autoload.php';
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $token = bin2hex(random_bytes(32));
    $expire = date("Y-m-d H:i:s", strtotime("+15 minutes"));

    $query = "UPDATE users SET reset_token=$1, token_expire=$2 WHERE email=$3";
    pg_query_params($conn, $query, [$token, $expire, $email]);

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'myathinzarkyaw28@gmail.com';
        $mail->Password = 'zpdukdiiwwytulww';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $link = "http://localhost:8080/Tutorials/phpMailer/reset_password.php?token=$token";
        $mail->setFrom('admin@website.com', 'Admin');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Password Reset';
        $mail->Body = "Click this link to reset your password: <a href='$link'>$link</a>";

        $mail->send();
        echo "Reset link has been sent to your email.";
    } catch (Exception $e) {
        echo "Error: {$mail->ErrorInfo}";
    }
}
