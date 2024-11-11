<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) { //check session
    if (isset($_GET["id"])) {
        $pid = $_GET["id"];
        $uemail = $_SESSION["u"]["email"];

        $cartProduct_rs = Database::search("SELECT * FROM `cart` WHERE `user_email` ='" . $uemail . "' AND `product_id`='" . $pid . "'"); // filder from cart table
        $cartProduct_num = $cartProduct_rs->num_rows;
        // echo $cartProduct_num;

        $product_qty_rs = Database::search("SELECT `qty` FROM `product` WHERE `id` = '" . $pid . "'"); //get qty

        $product_qty_data = $product_qty_rs->fetch_assoc();

        $product_qty = $product_qty_data["qty"];

        if ($cartProduct_num == 1) {
            $cartProduct_data = $cartProduct_rs->fetch_assoc();
            $currentQty = $cartProduct_data["qty"];
            $newQty = (int)$currentQty + 1;

            if ($product_qty >= $newQty) {
                Database::iud("UPDATE `cart` SET `qty`='" . $newQty . "' WHERE `user_email` = '" . $uemail . "' AND product_id = '" . $pid . "'"); //update qty

                echo "Product Quantity Updated";
            } else {
                echo "Invalid Product Quantity";
            }
        } else {
            Database::iud("INSERT INTO cart (cart.product_id,cart.user_email,cart.qty) VALUES ('" . $pid . "','" . $uemail . "','1')");

            echo "New Product added to the cart";
        }
    } else {
        echo "Sorry for the inconvenient";
    }
} else {
    echo "Please Log In or sign Up";
}
