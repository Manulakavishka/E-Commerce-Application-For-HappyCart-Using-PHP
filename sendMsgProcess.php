<?php

session_start();
require "connection.php";
$type = $_POST["u"];
$sender = $_SESSION[$type]["email"];
$receiver = $_POST["rm"];
$msg = $_POST["mt"];

// echo $x;

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");

$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

Database::iud("INSERT INTO `message` (`from`,`to`,`content`,`date_time`,`status`) VALUES ('" . $sender . "','" . $receiver . "','" . $msg . "','" . $date . "','0')");

echo "success";
