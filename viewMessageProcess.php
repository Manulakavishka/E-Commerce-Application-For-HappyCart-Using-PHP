<?php
session_start();
require "connection.php";

$recieveres_email = $_SESSION["u"]["email"];
$senders_email = $_GET["email"];

// echo ($senders_email);

$message_rs = Database::search("SELECT * FROM `message` WHERE `from` = '" . $senders_email . "' OR `to` = '" . $senders_email . "'");

$message_num = $message_rs->num_rows;

for ($x = 0; $x < $message_num; $x++) {
    $message_data = $message_rs->fetch_assoc();

    if ($message_data["from"] == $senders_email & $message_data["to"] == $recieveres_email) {
?>
        <!-- reciver' s message -->

        <div class="mb-3 w-50 col-6">

            <?php

            $user_rs = Database::search("SELECT * FROM `users` INNER JOIN profile_image ON profile_image.users_email=users.email WHERE `email`='" . $senders_email . "'");
            $user_num = $user_rs->num_rows;
            $user_data = $user_rs->fetch_assoc();

            if ($user_num == 0) {
            ?>
                <img src="resources/profile images/user.svg" style="width:50px;" class="rounded-circle mb-1" />

            <?php
            } else {
            ?>
                <img src="<?php echo $user_data["path"] ?>" style="width:50px;" class="rounded-circle mb-1" />

            <?php
            }
            ?>


            <div>
                <div class="bg-light rounded py-2 px-3 mb-2">
                    <p class="mb-0 text-dark"><?php echo $message_data["content"] ?></p>
                </div>
                <p class="small text-black-50 text-end"><?php echo $message_data["date_time"] ?></p>
                <p class=" invisible" id="rmail"><?php echo $message_data["from"] ?></p>
            </div>

        </div>
        <div class=" col-6 offset-6"></div>

        <!-- reciver's message -->
    <?php
    } else if ($message_data["from"] == $recieveres_email & $message_data["to"] == $senders_email) {
    ?>
        <!-- sender's message -->

        <div class="mb-3 w-50 offset-6">
            <div>
                <div class="bg-primary rounded py-2 px-3 mb-2">
                    <p class="mb-0 text-white"><?php echo $message_data["content"] ?></p>
                </div>
                <p class="small text-black-50 text-end"><?php echo $message_data["date_time"] ?></p>
            </div>
        </div>

        <!-- sender's message -->
<?php
    }

    if ($message_data["status"] == 0) {

        Database::iud("UPDATE `message` SET `status` = '1' WHERE `from`='" . $senders_email . "' AND `to` ='" . $recieveres_email . "'");
    }
}
