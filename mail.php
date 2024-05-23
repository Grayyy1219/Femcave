<?php
include("connect.php");
include("query.php");


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'C:\xampp\htdocs\Femcave\PHPMailer\src\Exception.php';
require 'C:\xampp\htdocs\Femcave\PHPMailer\src\PHPMailer.php';
require 'C:\xampp\htdocs\Femcave\PHPMailer\src\SMTP.php';

$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'femininecave@gmail.com';
    $mail->Password   = 'bbga xvad ybck gyss';
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;

    // Recipients
    $mail->setFrom("$email", 'Femcave');
    $mail->addAddress("$email", '');

    // Generate a unique verification code 
    $verificationCode = rand(10000, 99999);
    $sql = "UPDATE users SET verification_code = '$verificationCode' WHERE email = '$email'";
    mysqli_query($con, $sql);
    // Include the verification code in the link
    $verificationLink = "http://localhost/Femcave/verify.php?code=$verificationCode";

    // Set the email content
    $mail->isHTML(true);
    $mail->Subject = 'Confirm Your Femcave Account - Dive into Shopping Bliss!';
    $mail->Body    = "Thank you for creating an account with Femcave!. To ensure the security of your account, please verify your email address by clicking on the following link: <br> <b><a href='$verificationLink'>Verification Link</a></b> <br><br> If you did not create an account with Femcave please ignore this email.<br><br>Thank you for choosing Femcave and happy shopping!";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    // Send the email
    $mail->send();

    // Store the verification code in the database
    // Add your database connection and update query here
    echo '<script>alert("Verification link sent to you email!");</script>';
    echo '<script>window.location.href = "logout.php";</script>';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
