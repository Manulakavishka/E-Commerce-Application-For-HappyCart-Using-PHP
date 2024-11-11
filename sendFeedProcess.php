<?php

session_start();
require "connection.php";

$email = $_SESSION["u"]["email"];
$pid = $_POST["pid"];
$msg = $_POST["text"];

// echo $x;

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");

$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

Database::iud("INSERT INTO `feedback` (`feed`,`users_email`,`product_id`,`date`) VALUES ('" . $msg . "','" . $email . "','" . $pid . "','" . $date . "')");

echo "success";
