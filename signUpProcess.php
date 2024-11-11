<?php

require "connection.php";

$f = $_POST["f"];
$l = $_POST["l"];
$e = $_POST["e"];
$p = $_POST["p"];
$rep = $_POST["rep"];
$g = $_POST["g"];
$a = $_POST["a"];

if (empty($f)) {
    echo "Please Enter Your First Name!";
} else if (strlen($f) > 50) {
    echo "First Name Must Be Less Than 50 Characters!";
} else if (empty($l)) {
    echo "Please Enter Your Last Name!";
} else if (strlen($l) > 50) {
    echo "Last Name Must Be Less Than 50 Characters!";
} else if (empty($e)) {
    echo "Please Enter Your Email Address!";
} else if (strlen($e) >= 100) {
    echo "Email Must Be Less Than 100 Characters!";
} else if (!filter_var($e, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid Email Address!";
} else if (empty($p)) {
    echo "Please Enter Your Password!";
} else if (strlen($p) < 5 || strlen($p) > 20) {
    echo "Password Length Should Be Between 05 and 20";
} else if ($p != $rep) {
    echo "Password Does Not Match.";
} else if ($a == "false") {
    echo "Please Read And Agree to Agreement";
} else {

    $r = Database::search("SELECT * FROM `users` WHERE `email` = '" . $e . "'");
    $n = $r->num_rows;

    if ($n > 0) {
        echo "User With The same Email Address Already Exists";
    } else {

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        Database::iud("INSERT INTO `users` (`fname`,`lname`,`email`,`password`,`mobile`,`joined_date`,`status`,
         `gender_id`) VALUES ('" . $f . "','" . $l . "','" . $e . "','" . $p . "','0','" . $date . "',
         '1','" . $g . "')");

        $img = "resources\profile images\user.svg";
        $file_name = "resources//profile images//" . uniqid() . "svg";

        move_uploaded_file($img, $file_name);

        Database::iud("INSERT INTO `profile_image` (`path`,`users_email`) VALUES ('" . $file_name . "','" . $e . "')");

        Database::iud("INSERT INTO `user_has_address` (`line1`,`line2`,`users_email`,`city_id`,`postal_code`) 
        VALUES ('','','" . $e . "','1','')");

        echo "Success!";
    }
}
