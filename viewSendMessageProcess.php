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

    if ($message_data["from"] == $recieveres_email & $message_data["to"] == $senders_email) {
?>
        <!-- sender's message -->

        <div class="mb-3 w-50 offset-6">
            <div>
                <div class="bg-primary rounded py-2 px-3 mb-2">
                    <p class="mb-0 text-white"><?php echo $message_data["content"] ?></p>
                </div>
                <p class="small text-black-50 text-end"><?php echo $message_data["date_time"] ?></p>
                <p class=" invisible" id="rmail2"><?php echo $message_data["to"] ?></p>
            </div>
        </div>

        <!-- sender's message -->
<?php
    }
}
?>