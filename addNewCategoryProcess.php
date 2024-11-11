<?php
require "connection.php";

require "Exception.php";
require "PHPMailer.php";
require "SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;

$new_category = $_POST["n"];
$user_email = $_POST["e"];
//GET FROM THE POST METHOD'S DATA

$CATEGORY_RS =  Database::search("SELECT * FROM category WHERE `name` LIKE '%.$new_category.%'");
$CATEGORY_num = $CATEGORY_RS->num_rows;
//FILDER IS THERE ALREADY EXITS.

if ($CATEGORY_num == 0) {
    //IF THERE IS NOT ANY SIMILER DATA, DO THIS
    $code = uniqid();
    //CREATE A UMIQUE ID
    Database::iud("UPDATE `admin` SET `code`='" . $code . "' WHERE `email`='" . $user_email . "'");
    //SET THE CODE

    $mail = new PHPMailer;
    $mail->IsSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'manulakavishka7@gmail.com';
    $mail->Password = 'lkevwpldyomhuvel';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('manulakavishka7@gmail.com', 'Happy Card');
    $mail->addReplyTo('manulakavishka7@gmail.com', 'Happy Cart');
    $mail->addAddress($user_email);
    $mail->isHTML(true);
    $mail->Subject = 'Admin Varification Code.';
    $bodyContent = '<h1 style="Color:green;">Your Varification Code Is : ' . $code . '</h1>';
    $mail->Body    = $bodyContent;
    // SEND THE MAIL TO OUR CLIENT. THE CODE

    if (!$mail->send()) {
        //IF SENDING FAILED
        echo "Decline email sending failed";
    } else {
        // IF NOT
        echo "success";
    }
} else {
    //IF CATEGORY ALREADY IN THE DB
    echo "This Category exists";
}
