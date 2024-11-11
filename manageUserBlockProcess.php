<?php

require "connection.php";

$email = $_GET["mail"];

$user_rs = Database::search("SELECT * FROM `users` WHERE `email` = '" . $email . "'");
$user_num = $user_rs->num_rows;

if ($user_num == 1) {
    $user_data = $user_rs->fetch_assoc();
    $status_id = $user_data["status"];


    if ($status_id == 1) {
        Database::iud("UPDATE `users` SET `status` = '2' WHERE `email` = '" . $email . "'");
        echo "Blocked";
    } else if ($status_id == 2) {
        Database::iud("UPDATE `users` SET `status` = '1' WHERE `email` = '" . $email . "'");
        echo "Unblocked";
    }
} else {
    echo "Something Went Wrong. Please try again later";
}
