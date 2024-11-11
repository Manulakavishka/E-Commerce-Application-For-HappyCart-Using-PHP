<?php

require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST["em"])) {

    if (empty($_POST["em"])) {
        echo "Please  Enter your  Email Address.";
    } else {
        $email = $_POST["em"];

        $admin_rs = Database::search("SELECT * FROM `admin` WHERE `email` ='" . $email . "'");
        $admin_num = $admin_rs->num_rows;

        if ($admin_num == 1) {
            $code = uniqid();

            Database::search("UPDATE `admin` SET `code` = '" . $code . "' WHERE `email` = '" . $email . "'");

            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'manulakavishka7@gmail.com';
            $mail->Password = 'lkevwpldyomhuvel';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('manulakavishka7@gmail.com', 'Happy Cart');
            $mail->addReplyTo('manulakavishka7@gmail.com', 'Happy Cart');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Admin Varification Code.';
            $bodyContent = '<h1 style="Color:green;">Your Varification Code Is : ' . $code . '</h1>';
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo "Decline email sending failed";
            } else {
                echo "success";
            }
        } else {
            echo "You are not a valid user.";
        }
    }
} else {
    echo "eer";
}
