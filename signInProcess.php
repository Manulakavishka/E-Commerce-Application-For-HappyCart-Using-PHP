<?php

session_start();

require "connection.php";

$email = $_POST["e"];
$password = $_POST["p"];
$rememberMe = $_POST["rm"]; //true or false

// echo $email;
// echo $password;
// echo $rememberMe;

if (empty($email)) {

    echo "Please enter your Email Address.";
} else if (strlen($email) > 100) {
    echo "Email Address should contain less than 100 characters.";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid Email Address.";
} else if (empty($password)) {
    echo "Please enter your Password";
} else if (strlen($password) < 5 || strlen($password) > 20) {
    echo "Invalid Password";
} else {

    $resultset =  Database::search("SELECT * FROM `users` WHERE `email` = '" . $email . "' AND `password` = '" . $password . "'");

    $n = $resultset->num_rows;

    if ($n == 1) {

        echo "success";
        $d = $resultset->fetch_assoc();
        $_SESSION["u"] = $d;

        if ($rememberMe == "true") {
            setcookie("email", $_SESSION["u"]["email"], time() + (60 * 60 * 24 * 365));
            setcookie("password", $_SESSION["u"]["password"], time() + (60 * 60 * 24 * 365));

            // echo time();
        } else {
            setcookie("email", "", -1);
            setcookie("password", "", -1);
        }

        // echo $_SESSION["u"]["fname"];
    } else {
        echo "Invalid Email Or Password";
    }
}
