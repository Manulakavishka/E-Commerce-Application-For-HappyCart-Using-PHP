<?php

session_start(); //start session

require "connection.php"; // get connection

if (isset($_SESSION["u"])) { //check is there a user

    $seller_email = $_SESSION["u"]["email"];

    $category = $_POST["category"];
    $brand = $_POST["brand"];
    $model = $_POST["model"];
    $title = $_POST["title"];
    $qty = $_POST["qty"];
    $price = $_POST["cost"];
    $dwc = $_POST["dwc"];
    $doc = $_POST["doc"];
    $description = $_POST["description"];

    $color = $_POST["col"];
    $condition = $_POST["co"];

    //get post method data

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");
    //create datetime and set zone and format
    $status = 1;

    //check conditions
    if ($category == "0") {
        echo "Please select the Category";
    } else if ($brand == "0") {
        echo "Please select the Brand";
    } else if ($model == "0") {
        echo "Please select the Model";
    } else if (empty($title)) {
        echo "Please enter the Title of your product";
    } else if (strlen($title) > 100) {
        echo "Your Title should be 100 or less character length.";
    } else if (empty($qty)) {
        echo "Please add a Quantity";
    } else if ($qty == "0" | $qty == "e" | $qty < 0) {
        echo "Please enter a valid Quantity";
    } else if (empty($price)) {
        echo "Please enter the unit price of your product";
    } else if (!is_numeric($price)) {
        echo "Please enter a valid price";
    } else if (empty($dwc)) {
        echo "Please enter the delivery price in Colombo";
    } else if (!is_numeric($dwc)) {
        echo "Please enter a valid price";
    } else if (empty($doc)) {
        echo "Please enter the delivery price out of Colombo";
    } else if (!is_numeric($doc)) {
        echo "Please enter a valid price";
    } else if (empty($description)) {
        echo "Please enter a Description";
    } else {
        //if alright
        $mhb_rs = Database::search("SELECT * FROM model_has_brand 
        WHERE model_id = '" . $model . "' AND brand_id = '" . $brand . "'");

        $model_has_brand_id;

        if ($mhb_rs->num_rows == 1) { //already has

            $mhb_data = $mhb_rs->fetch_assoc();
            $model_has_brand_id = $mhb_data["id"];
        } else { // if not insert
            Database::iud("INSERT INTO model_has_brand (model_id, brand_id) 
            VALUES('" . $model . "','" . $brand . "')");
            $model_has_brand_id = Database::$connection->insert_id;
        }
        // add product
        Database::iud("INSERT INTO `product` (`price`,`qty`,`description`,`title`,
        `datetime_added`,`delivery_fee_colombo`,`delivery_fee_other`,`category_id`,
        `model_has_brand_id`,`color_id`,`status_id`,`condition_id`,`users_email`) 
        VALUES ('" . $price . "','" . $qty . "','" . $description . "','" . $title . "',
        '" . $date . "','" . $dwc . "','" . $doc . "','" . $category . "',
        '" . $model_has_brand_id . "','" . $color . "','" . $status . "','" . $condition . "','" . $seller_email . "')");

        echo "Product added successfully";

        $product_id = Database::$connection->insert_id;

        $allowed_image_extentions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml"); //filtering images


        if (isset($_FILES["imageuploader"])) { // check not empty

            $imagefile = $_FILES["imageuploader"];

            $file_extention = $imagefile["type"];


            if (in_array($file_extention, $allowed_image_extentions)) {

                $new_image_extention;

                if ($file_extention == "image/jpg") {
                    $new_image_extention = ".jpg";
                } else if ($file_extention == "image/jpeg") {
                    $new_image_extention = ".jpeg";
                } else if ($file_extention == "image/png") {
                    $new_image_extention = ".png";
                } else if ($file_extention == "image/svg+xml") {
                    $new_image_extention = ".svg";
                }

                $file_name = "resources//product_img//" . uniqid() . $new_image_extention;
                move_uploaded_file($imagefile["tmp_name"], $file_name); // move image to server

                Database::iud("INSERT INTO `images` (`code`,`product_id`) 
                VALUES ('" . $file_name . "','" . $product_id . "')");
                //insert location

                echo "Product image saved successfully";
            } else {
                echo "Invalid image type";
            }
        } else {
            echo "Please Add an image.";
        }
    }

    // echo "Success";
} else {
    echo "Please Log In to your account first.";
}
