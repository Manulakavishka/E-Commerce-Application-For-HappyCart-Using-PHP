<?php
    require_once "stripe-php-master/init.php";

    $stripeDetails = array(
        "secretKey" => "enter your secretkey",
        "publishableKey" => "enter your publishableKey"
    );

    \Stripe\Stripe::setApiKey($stripeDetails["secretKey"]);
?>
