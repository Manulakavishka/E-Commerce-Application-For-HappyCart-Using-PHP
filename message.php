<?php

?>

<!DOCTYPE html>

<html>

<head>

    <title>Happy Cart | Messages</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="resources/img/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />

</head>

<body onload="viewRecent();" style="background-color: #00FF00; background-image: linear-gradient(90deg,#00FF00 0%,#32CD32 100% );">

    <div class="container-fluid">
        <div class="row">

            <?php
            require "header.php";
            $e = $_SESSION["u"]["email"];
            $toe;
            if (isset($_GET["to"]))
                $toe = $_GET["to"];
            // echo $e;
            ?>

            <div class="col-12">
                <hr>
            </div>

            <div class="col-12 py-5 px-4">
                <div class="row rounded shadow overflow-hidden">
                    <div class="col-12 col-lg-5 px-0">
                        <div class="bg-white">
                            <div class="bg-light px-4 py-2">
                                <h5 class="mb-0 py-1">Recent</h5>
                            </div>

                            <div class="col-12">

                                <?php

                                $fromMail_rs = Database::search("SELECT DISTINCT `from` FROM `message` WHERE `to`= '" . $e . "'");
                                $fromMail_num = $fromMail_rs->num_rows;
                                $messaage_rs = Database::search("SELECT DISTINCT `from`, `content`, `date_time`, `status` FROM `message` WHERE `to`='" . $e . "' ORDER BY `date_time` DESC");
                                $messaage_num = $messaage_rs->num_rows;

                                ?>

                                <!--  -->
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">


                                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true" name="Inbox" id="Inbox" onclick="IndexValue1()">
                                            Inbox
                                        </button>
                                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false" name="Sentbox" id="Sentbox" onclick="IndexValue2()">
                                            Sentbox
                                        </button>
                                    </div>
                                </nav>


                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <!-- /// -->

                                        <div class="message_box" id="message_box">

                                            <?php
                                            for ($x = 0; $x < $fromMail_num; $x++) {
                                                $messaage_data = $messaage_rs->fetch_assoc();
                                                if ($messaage_data["status"] == "0") {
                                            ?>
                                                    <div class="list-group rounded-0" onclick="viewMessages('<?php echo $messaage_data['from']; ?>');">
                                                        <a href="#" class="list-group-item list-group-item-action text-white rounded-0 bg-warning">

                                                            <?php

                                                            $user_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $messaage_data["from"] . "'");
                                                            $user_data = $user_rs->fetch_assoc();
                                                            $propicrs = Database::search("SELECT * FROM `profile_image` WHERE `users_email`='" . $user_data["email"] . "'");
                                                            $propicnum = $propicrs->num_rows;
                                                            $propicdata = $propicrs->fetch_assoc();

                                                            ?>

                                                            <div>
                                                                <?php
                                                                if ($propicnum == 0) {
                                                                ?>
                                                                    <img src="resources/profile images/user.svg" width="50px" class="rounded-circle" />
                                                                <?php
                                                                } else {

                                                                ?>
                                                                    <img src="<?php echo $propicdata["path"]; ?>" width="50px" class="rounded-circle" />
                                                                <?php
                                                                }
                                                                ?>
                                                                <div class="me-4">
                                                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                                                        <h6 class="mb-0"><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></h6>
                                                                        <small class="small fw-bold"><?php echo $messaage_data["date_time"]; ?></small>
                                                                    </div>
                                                                    <p class="mb-0"><?php echo $messaage_data["content"]; ?></p>
                                                                </div>
                                                            </div>

                                                        </a>
                                                    </div>
                                                <?php
                                                } else {
                                                ?>
                                                    <div class="list-group rounded-0" onclick="viewMessages('<?php echo $messaage_data['from']; ?>');">
                                                        <a href="#" class="list-group-item list-group-item-action text-white rounded-0 bg-primary">

                                                            <?php

                                                            $user_rs2 = Database::search("SELECT * FROM `users` WHERE `email`='" . $messaage_data["from"] . "'");
                                                            $user_data2 = $user_rs2->fetch_assoc();
                                                            $propicrs2 = Database::search("SELECT * FROM `profile_image` WHERE `users_email`='" . $user_data2["email"] . "'");
                                                            $propicnum2 = $propicrs2->num_rows;
                                                            $propicdata2 = $propicrs2->fetch_assoc();

                                                            ?>

                                                            <div>
                                                                <?php
                                                                if ($propicnum2 == 0) {
                                                                ?>
                                                                    <img src="resources/profile images/user.svg" width="50px" class="rounded-circle" />
                                                                <?php
                                                                } else {

                                                                ?>
                                                                    <img src="<?php echo $propicdata2["path"]; ?>" width="50px" class="rounded-circle" />
                                                                <?php
                                                                }
                                                                ?>
                                                                <div class="me-4">
                                                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                                                        <h6 class="mb-0"><?php echo $user_data2["fname"] . " " . $user_data2["lname"]; ?></h6>
                                                                        <small class="small fw-bold"><?php echo $messaage_data["date_time"]; ?></small>
                                                                    </div>
                                                                    <p class="mb-0"><?php echo $messaage_data["content"]; ?></p>
                                                                </div>
                                                            </div>

                                                        </a>
                                                    </div>
                                            <?php
                                                }
                                            }

                                            ?>


                                        </div>

                                        <!-- /// -->
                                    </div>

                                    <?php
                                    $fromMail1_rs = Database::search("SELECT DISTINCT `from` FROM `message` WHERE `to`= '" . $e . "'");
                                    $fromMail1_num = $fromMail1_rs->num_rows;
                                    $messaage1_rs = Database::search("SELECT DISTINCT `from`,`to`,`content`,`date_time`,`status` FROM `message` WHERE `from` IN (SELECT `from` FROM `message` WHERE `to` = '" . $e . "' ) ORDER BY `date_time` DESC");
                                    $messaage1_num = $messaage1_rs->num_rows;

                                    ?>

                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                        <!-- /// -->

                                        <div class="message_box" id="message_box">


                                            <?php

                                            for ($x = 0; $x < $fromMail1_num; $x++) {
                                                $messaage1_data = $messaage1_rs->fetch_assoc();
                                            ?>

                                                <div class="list-group rounded-0" onclick="viewSendMessages('<?php echo $messaage1_data['from']; ?>');">
                                                    <a href="#" class="list-group-item list-group-item-action text-black rounded-0 bg-body">

                                                        <?php

                                                        $user1_rs = Database::search("SELECT * FROM `users` INNER JOIN profile_image ON profile_image.users_email=users.email WHERE `email`='" . $messaage1_data["from"] . "'");
                                                        $user1_data = $user1_rs->fetch_assoc();


                                                        ?>

                                                        <div>
                                                            <img src="<?php echo $user1_data["path"]; ?>" width="50px" class="rounded-circle" />
                                                            <div class="me-4">
                                                                <div class="d-flex align-items-center justify-content-between mb-1">
                                                                    <h6 class="mb-0"><?php echo $user1_data["fname"] . " " . $user1_data["lname"]; ?></h6>
                                                                    <small class="small fw-bold"><?php echo $messaage1_data["date_time"]; ?></small>
                                                                </div>
                                                                <p class="mb-0"><?php echo $messaage1_data["content"]; ?></p>
                                                            </div>
                                                        </div>

                                                    </a>
                                                </div>

                                            <?php
                                            }

                                            ?>

                                        </div>

                                        <!-- /// -->
                                    </div>
                                </div>

                                <!--  -->

                            </div>

                        </div>
                    </div>

                    <div class="col-12 col-lg-7 px-0">
                        <div class="row px-4 py-5 text-white chat_box">

                            <div class="col-12" style="height: 470px;">
                                <div class="row px-4 py-5 text-white " id="chat_box">
                                    <!-- msg view area -->

                                </div>
                            </div>




                        </div>

                        <!-- text -->

                        <div class="col-12">
                            <div class="row">
                                <div class="input-group">
                                    <input type="text" placeholder="Type your message..." aria-describedby="sendbtn" class="form-control rounded-0 border-0 py-3 bg-light" id="msgTxt" />
                                    <button id="sendbtn" class="btn btn-link fs-2 bg-dark" onclick="call();">
                                        <i class="bi bi-send-fill"></i>
                                    </button>
                                    <script>

                                    </script>
                                </div>
                            </div>
                        </div>

                        <!-- text -->
                    </div>


                </div>
            </div>

            <?php require "footer.php"; ?>

        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>

</body>

</html>