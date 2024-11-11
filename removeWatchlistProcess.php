<?php

require "connection.php";

if (isset($_GET["id"])) {

    $pid = $_GET["id"];
    // echo $pid;
    $watch_rs = Database::search("SELECT * FROM watchlist WHERE id ='" . $pid . "'");
    $watch_num = $watch_rs->num_rows;
    if ($watch_num == 0) {
        echo "Something went wrong. Please try again later.";
    } else {
        Database::search("DELETE FROM `watchlist` WHERE id = '" . $pid . "'");
        echo "Success";
    }
} else {
    echo "Please select a product";
}
