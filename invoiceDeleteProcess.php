<?php
require "connection.php";
$id = $_POST["id"];

Database::iud("UPDATE `invoice` SET `status`='4' WHERE `id`='" . $id . "'");

echo "success";
