<?php

require "connection.php";

$name = $_GET["n"];
$email = $_GET["e"];
$msg = $_GET["m"];
$subject = $_GET["s"];

if ($name == "" || $email == "" || $msg == "" || $subject == "") {

    echo "Please Fill All the Fields";
} else if (strlen($email) >= 100) {
    echo "Email Must Be Less Than 100 Characters!";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid Email Address!";
} else if (empty($subject) >= 100) {
    echo "Subject Must Be Less Than 100 Characters!";
} else if (empty($name) >= 100) {
    echo "Name Must Be Less Than 100 Characters!";
} else if (empty($msg) >= 500) {
    echo "Message Must Be Less Than 100 Characters!";
} else {

    Database::iud("INSERT INTO `contact_us` (`email`,`name`,`subject`,`msg`) VALUES ('" . $email . "','" . $name . "','" . $subject . "','" . $msg . "')");
    echo "Success";
}
