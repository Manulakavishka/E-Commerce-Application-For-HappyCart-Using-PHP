<?php
include("./config.php");

$token = $_POST["stripeToken"];
$contact_name = $_POST["c_name"];
$token_card_type = $_POST["stripeTokenType"];
$phone           = $_POST["phone"];
$email           = $_POST["stripeEmail"];
$address         = $_POST["address"];
$amount          = $_POST["amount"];
$desc            = $_POST["product_name"];

// $advisorid = $_POST["advisor_id"];
// $studentemail = $_POST["stu_email"];
// $verification_code = $_POST["verify1"];

$charge = \Stripe\Charge::create([
  "amount" => str_replace(",", "", $amount) * 100,
  "currency" => 'lkr',
  "description" => $desc,
  "source" => $token,
]);


session_start();
require "connection.php";



// $d = new DateTime();
// $tz = new DateTimeZone("Asia/Colombo");
// $d->setTimezone($tz);
// $date = $d->format("Y-m-d H:i:s");

// require "connection.php";

// $verifyrs = Database::search("SELECT * FROM `requests` WHERE `student_email`='" . $studentemail . "'
//     AND `advisor_id`='" . $advisorid . "' AND `verify`='" . $verification_code . "'");
// $verifynum = $verifyrs->num_rows;

// if ($verifynum == 1) {

//   Database::iud("INSERT INTO `advisor_payment` (`student_email`,`advisor_id`,`pay_date`,`status`)
//       VALUES ('" . $studentemail . "','" . $advisorid . "','" . $date . "','1')");

if ($charge) {

  $pid = $_POST["pid"];
  $qty = $_POST["qty"];

  $uemail = $_SESSION["u"]["email"];

  $order_id = uniqid();

  $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "'");
  $product_data = $product_rs->fetch_assoc();

  $uprice = $product_data["price"];
  $total = $uprice * $qty;

  $d = new DateTime();
  $tz = new DateTimeZone("Asia/Colombo");
  $d->setTimezone($tz);
  $date = $d->format("Y-m-d H:i:s");

  Database::iud("INSERT INTO `invoice` (`order_id`,`product_id`,`users_email`,`date`,`total`,`qty`,`status`) VALUES ('" . $order_id . "','" . $pid . "','" . $uemail . "','" . $date . "','" . $total . "','" . $qty . "','0')");

  $QtyRS = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "'");
  $QtyData = $QtyRS->fetch_assoc();
  $oldtotal = $QtyData["qty"];
  $newtotal = $oldtotal - $qty;

  Database::iud("UPDATE `product` SET `qty`='" . $newtotal . "' WHERE `id`='" . $pid . "'");


  header("Location:success.php?amount=$amount");
} else {

  header("Location:cancel.php?amount=$amount");
}
