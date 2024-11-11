<?php require "connection.php";
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Happy Cart | Admin | Manage Users</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="resources/img/logo.svg">

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
</head>

<body style="background-color: #00FF00; background-image: linear-gradient(90deg,#00FF00 0%, #32CD32 100%); min-height: 100vh;">

    <div class=" container-fluid">
        <div class=" row">

            <div class=" col-12 bg-light text-center">
                <h2 class=" text-primary  fw-bold">Manage All Users</h2>
            </div>

            <div class=" col-12 mt-3">
                <div class=" row">
                    <div class=" offset-0 offset-lg-3 col-12 col-lg-6 mb-3">
                        <div class=" row ">
                            <div class=" col-9">
                                <input class=" form-control" type="text">
                            </div>
                            <div class=" col-3 d-grid">
                                <button class=" btn btn-warning">Search User</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class=" col-12 mt-3 mb-3">
                <div class=" row">

                    <div class=" col-2 col-lg-1 bg-primary py-2 text-end">
                        <span class=" fs-4 fw-bold text-white">#</span>
                    </div>

                    <div class=" col-2 bg-light py-2 d-none d-lg-block ">
                        <span class=" fs-4 fw-bold ">Profile Image</span>
                    </div>

                    <div class=" col-4 col-lg-2 bg-primary py-2 ">
                        <span class=" fs-4 fw-bold text-white">User Name</span>
                    </div>

                    <div class=" col-4 col-lg-2 bg-light py-2 d-lg-block">
                        <span class=" fs-4 fw-bold ">Email</span>
                    </div>

                    <div class=" col-2 bg-primary py-2 d-none d-lg-block">
                        <span class=" fs-4 fw-bold text-white">Mobile</span>
                    </div>

                    <div class=" col-2 bg-light py-2 d-none d-lg-block">
                        <span class=" fs-4 fw-bold">Registered Date</span>
                    </div>

                    <div class=" col-2 col-lg-1 bg-white"></div>

                </div>
            </div>

            <?php

            $page_no;

            if (isset($_GET["page"])) {
                $page_no = $_GET["page"];
            } else {
                $page_no = 1;
            }

            $user_rs = Database::search("SELECT * FROM `users`");
            $user_num = $user_rs->num_rows;
            $result_per_page = 10;
            $number_of_page = ceil($user_num / $result_per_page);
            $page_first_result = ((int)$page_no - 1) * $result_per_page;

            $view_result_rs = Database::search("SELECT * FROM `users` LIMIT " . $result_per_page . " OFFSET " . $page_first_result . "");

            $view_result_num = $view_result_rs->num_rows;

            $c = 0;

            ?>

            <?php

            while ($user_data = $view_result_rs->fetch_assoc()) {
                $c += 1;

            ?>

                <div class=" col-12 mb-3">
                    <div class=" row">

                        <div class=" col-2 col-lg-1 bg-primary py-2 text-end">
                            <span class=" fs-4 fw-bold text-white"><?php echo $c ?></span>
                        </div>

                        <?php
                        $img_rs = Database::search("SELECT * FROM `profile_image` WHERE `users_email` = '" . $user_data["email"] . "'");
                        $img_data = $img_rs->fetch_assoc();
                        ?>

                        <div class=" col-2 bg-light py-2 d-none d-lg-block " onclick="viewMsgModal('<?php echo $user_data['email']; ?>');">
                            <img src="<?php echo $img_data["path"]; ?>" style="height: 40px; margin-left: 80px;">
                        </div>

                        <div class=" col-4 col-lg-2 bg-primary py-2 ">
                            <span class=" fs-4 fw-bold text-white"><?php echo $user_data["fname"] . " " . $user_data["lname"] ?></span>
                        </div>

                        <div class=" col-4 col-lg-2 bg-light py-2 d-lg-block">
                            <span class=" fs-4 fw-bold "><?php echo $user_data["email"] ?></span>
                        </div>

                        <div class=" col-2 bg-primary py-2 d-none d-lg-block">
                            <span class=" fs-4 fw-bold text-white"><?php echo $user_data["mobile"] ?></span>
                        </div>

                        <div class=" col-2 bg-light py-2 d-none d-lg-block">
                            <span class=" fs-4 fw-bold"><?php
                                                        $row = $user_data["joined_date"];
                                                        $splited = explode(" ", $row);
                                                        echo $splited[0]; ?></span>
                        </div>

                        <div class=" col-2 col-lg-1 bg-white py-2 d-grid">
                            <?php
                            $s = $user_data["status"];
                            $mail = $user_data["email"];
                            if ($s == "1") {

                            ?>
                                <button class=" btn btn-danger" onclick="userBlock('<?php echo $user_data['email'] ?>');">Block</button>
                            <?php
                            } else {
                            ?>
                                <button class=" btn btn-success" onclick="userBlock('<?php echo $user_data['email'] ?>');">Unblock</button>
                            <?php
                            }
                            ?>
                        </div>

                    </div>
                </div>



                <!-- model -->
                <div class=" modal" tabindex="-1" id="viewmsgmodal<?php echo $mail ?>">
                    <div class=" modal-dialog">
                        <div class=" modal-content">

                            <div class=" modal-header">
                                <h5 class=" modal-title">My Messages</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class=" modal-body">

                                <?php


                                $recieveres_email = $_SESSION["a"]["email"];

                                $message_rs = Database::search("SELECT * FROM `message` WHERE `from` = '" . $mail . "' OR `to` = '" . $mail . "'");

                                $message_num = $message_rs->num_rows;

                                for ($x = 0; $x < $message_num; $x++) {
                                    $message_data = $message_rs->fetch_assoc();

                                    if ($message_data["from"] == $mail & $message_data["to"] == $recieveres_email) {
                                ?>

                                        <!-- receved -->
                                        <div class=" col-12 mt-2">
                                            <div class=" row">
                                                <div class=" col-8 bg-info rounded">
                                                    <div class="row">
                                                        <div class=" col-12 pt-2">
                                                            <span class="text-white fs-4"><?php echo $message_data["content"] ?></span>
                                                        </div>
                                                        <div class=" col-12 text-end pb-2 ">
                                                            <span class=" text-white fs-6"><?php echo $message_data["date_time"] ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- receved -->

                                    <?php
                                    } else if ($message_data["from"] == $recieveres_email & $message_data["to"] == $mail) {
                                    ?>

                                        <!-- send -->

                                        <div class=" col-12 mt-2">
                                            <div class=" row">
                                                <div class=" offset-4 col-8 bg-success rounded">
                                                    <div class="row">
                                                        <div class=" col-12 pt-2">
                                                            <span class="text-white fs-4"><?php echo $message_data["content"] ?></span>
                                                        </div>
                                                        <div class=" col-12 text-end pb-2 ">
                                                            <span class=" text-white fs-6"><?php echo $message_data["date_time"] ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- send -->

                                <?php
                                    }

                                    if ($message_data["status"] == 0) {

                                        Database::iud("UPDATE `message` SET `status` = '1' WHERE `from`='" . $mail . "' AND `to` ='" . $recieveres_email . "'");
                                    }
                                }

                                ?>


                            </div>

                            <div class=" modal-footer">

                                <div class=" col-12">
                                    <div class=" row">

                                        <div class=" col-8">
                                            <input type="text" class=" form-control" id="msgTxt<?php echo $mail; ?>">
                                        </div>

                                        <div class=" col-4 d-grid">
                                            <button class=" btn btn-primary" onclick="sendMsg2('<?php echo $mail; ?>');">Send</button>
                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <!-- model -->

            <?php
            }

            ?>

            <div class=" col-12 text-center">
                <div class=" pagination">
                    <a href="<?php
                                if ($page_no <= 1) {
                                    echo "#";
                                } else {
                                    echo "?page=" . ($page_no - 1);
                                }
                                ?>">

                        &laquo;;</a>

                    <?php

                    for ($page = 1; $page <= $number_of_page; $page++) {
                        if ($page == $page_no) {
                    ?>
                            <a href="<?php echo "?page" . ($page); ?>" class=" active"><?php echo $page ?></a>
                        <?php
                        } else {
                        ?>
                            <a href="<?php echo "?page" . ($page); ?>"><?php echo $page ?></a>

                    <?php

                        }
                    }

                    ?>

                    <a href="<?php
                                if ($page_no >= $number_of_page) {
                                    echo "#";
                                } else {
                                    echo "?page=" . ($page_no + 1);
                                }
                                ?>">

                        &raquo;</a>
                </div>
            </div>

        </div>
    </div>



    <script src="script.js"></script>

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="plugins/toastr/toastr.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- Page specific script -->


    <script src="bootstrap.js"></script>
</body>

</html>