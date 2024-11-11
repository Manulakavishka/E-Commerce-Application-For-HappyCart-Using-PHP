<?php

session_start();

require "connection.php";

if (isset($_SESSION["p"])) {
    $product_id = $_SESSION["p"]["id"];


    $title = $_POST["t"];
    $qty = $_POST["q"];
    $dwc = $_POST["dwc"];
    $doc = $_POST["doc"];
    $description = $_POST["d"];


    Database::iud("UPDATE `product` SET `title` = '" . $title . "',`qty`='" . $qty . "',`delivery_fee_colombo`='" . $dwc . "',
    `delivery_fee_other`='" . $doc . "',`description`='" . $description . "' WHERE `id` = '" . $product_id . "'");

    echo "Product updated successfully";

    $allowed_img_extentions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");

    if (isset($_FILES["i"])) {
        $image = $_FILES["i"];

        $file_extention = $image["type"];
        if (!in_array($file_extention, $allowed_img_extentions)) {
            echo "Invalid Image Type";
        } else {

            $new_extentions;

            if ($file_extention == "image/jpg") {
                $new_extentions = ".jpg";
            } else if ($file_extention == "image/png") {
                $new_extentions = ".png";
            } else if ($file_extention == "image/jpeg") {
                $new_extentions = ".jpeg";
            } else if ($file_extention == "image/svg+xml") {
                $new_extentions = ".svg";
            }

            $file_name = "resources//product_img//" . uniqid() . $new_extentions;

            move_uploaded_file($image["tmp_name"], $file_name);

            Database::iud("UPDATE `images` SET `code`='" . $file_name . "' WHERE `product_id` = '" . $product_id . "'");
            echo "Product Image Updated Successfully";
        }
    }
}
