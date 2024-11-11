<?php

// echo "success";

require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_GET["e"])) {

    $email = $_GET["e"];

    $resultset = Database::search("SELECT * FROM `users` WHERE `email` = '" . $email . "'");

    $n = $resultset->num_rows;

    if ($n == 1) {

        $code = uniqid();
        // echo $code;

        Database::iud("UPDATE `users` SET `varification_code` = '" . $code . "' WHERE `email` = '" . $email . "'");

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'manulaka@gmail.com';
        $mail->Password = 'lkevwpldy';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('manulaka@gmail.com', 'Happy Cart');
        $mail->addReplyTo('manula@gmail.com', 'Happy Cart');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Happy Cart Forget Password Varification Code.';
        $bodyContent = '<h1 style="Color:green;">Your Varification Code Is : ' . $code . '</h1>';
        $mail->Body    = $bodyContent;

        if (!$mail->send()) {
            echo 'Verification code sending failed';
        } else {
            echo 'Success';
        }
    } else {
        echo "Email address not found";
    }
} else {

    echo "Please Enter your Email Address.";
}
