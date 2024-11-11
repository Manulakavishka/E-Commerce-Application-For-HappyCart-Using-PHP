<?php
    require_once "stripe-php-master/init.php";

    $stripeDetails = array(
        "secretKey" => "sk_test_51L28vMG5BcKy7lb7zvu3iYO56IngMpEGQ8sfr1wD07rHL1hzJHT55dGKzLWF9JyFMI4Bxw7SlmGiSH3NvTxxaPMB00eYLOOGsJ",
        "publishableKey" => "pk_test_51L28vMG5BcKy7lb7pHwKLvot8ZbQakL48o1kOIa4uTkgyNQbRIPL1bUtF3BrIEl6UkuuYydinUiVnv2EHWyUduaR00pSoBknQ4"
    );

    \Stripe\Stripe::setApiKey($stripeDetails["secretKey"]);
?>