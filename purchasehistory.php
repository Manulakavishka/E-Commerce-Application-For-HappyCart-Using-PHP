<!DOCTYPE html>
<html>

<head>
    <title>Happy Cart | Transaction History</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />

    <link rel="icon" href="resources/img/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>

    <div class=" container-fluid">
        <div class=" row">
            <?php require "header.php" ?>

            <?php
            if ($_SESSION["u"] != null) {

                $email = $_SESSION["u"]["email"];

            ?>

                <div class=" col-12 text-center mb-3">
                    <span class=" fs-1 fw-bold text-primary">Transaction History</span>
                </div>

                <div class=" col-12">
                    <div class=" row">

                        <div class=" col-12 d-none d-lg-block">
                            <div class=" row">
                                <div class=" col-1 bg-light">
                                    <label class=" form-label fw-bold">Order id</label>
                                </div>
                                <div class=" col-3 bg-light">
                                    <label class=" form-label fw-bold">Product Details</label>
                                </div>
                                <div class=" col-1 bg-light text-end">
                                    <label class=" form-label fw-bold">Quantity</label>
                                </div>
                                <div class=" col-2 bg-light text-end">
                                    <label class=" form-label fw-bold">Cost</label>
                                </div>
                                <div class=" col-2 bg-light text-end">
                                    <label class=" form-label fw-bold">Date & Time</label>
                                </div>

                                <div class=" col-3 bg-light"></div>
                                <div class=" col-12">
                                    <hr>
                                </div>

                            </div>
                        </div>

                        <?php

                        $view_result_rs = Database::search("SELECT * FROM `invoice` WHERE users_email = '" . $email . "' AND `status` != '5'");

                        $view_result_num = $view_result_rs->num_rows;

                        ?>

                        <?php

                        while ($user_data = $view_result_rs->fetch_assoc()) {

                        ?>

                            <div class=" col-12">
                                <div class=" row">

                                    <div class=" col-12 col-lg-1 bg-info text-center text-lg-start">
                                        <label class=" form-label text-white fs-6 py-5"><?php echo $user_data["order_id"] ?></label>
                                    </div>

                                    <div class=" col-12 col-lg-3">
                                        <div class=" row g-2">

                                            <div class="card mx-0 my-0" style="width: 500px;">
                                                <div class=" row g-0">
                                                    <div class=" col-md-4 ">

                                                        <?php
                                                        $img_rs = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $user_data["product_id"] . "'");
                                                        $img_data = $img_rs->fetch_assoc();
                                                        ?>

                                                        <img src="<?php echo $img_data["code"] ?>" class="img-fluid rounded-start">
                                                    </div>
                                                    <div class=" col-md-8">

                                                        <?php
                                                        $product_rs = Database::search("SELECT * FROM `product` where id = '" . $user_data["product_id"] . "'");
                                                        $product_data = $product_rs->fetch_assoc();
                                                        ?>

                                                        <div class="card-body">
                                                            <h5 class=" card-title"><?php echo $product_data["title"] ?></h5>
                                                            <?php
                                                            $seller_rs = Database::search("SELECT * FROM users WHERE email = '" . $product_data["users_email"] . "'");
                                                            $seller_data = $seller_rs->fetch_assoc();

                                                            ?>
                                                            <p class=" card-text"><b>Seller : </b><?php echo $seller_data["fname"] . " " . $seller_data["lname"] ?></p>
                                                            <p class=" card-text"><b>Price : </b>Rs. <?php echo $product_data["price"] ?> .00</p>
                                                        </div>
                                                    </div>
                                                </div>




                                            </div>

                                        </div>
                                    </div>

                                    <div class=" col-12 col-lg-1 text-center text-lg-end bg-light">
                                        <label class=" form-label fs-4 pt-5"><?php echo $user_data["qty"]; ?></label>
                                    </div>

                                    <div class=" col-12 col-lg-2 text-center text-lg-end bg-info">
                                        <label class=" form-label fs-5 py-5 text-white fw-bold">Rs.
                                            <?php
                                            $addressColomboRs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `city` ON `user_has_address`.`city_id` = `city`.`id` INNER JOIN district ON `district`.`id`=`city`.`district_id` WHERE `users_email` = '" . $_SESSION["u"]["email"] . "' AND `district`.`name`='Colombo'");
                                            $addressColomboNum = $addressColomboRs->num_rows;

                                            $cost = 0;

                                            if ($addressColomboNum == 1) {
                                                $cost = $product_data["delivery_fee_colombo"];
                                                echo $cost;
                                            } else {
                                                $cost = $product_data["delivery_fee_other"];
                                                echo $cost;
                                            }
                                            ?>
                                            .00</label>
                                    </div>

                                    <div class=" col-12 col-lg-2 text-center text-lg-end bg-light">
                                        <label class=" form-label fs-5 px-3 py-5 fw-bold">
                                            <?php
                                            echo $user_data["date"];
                                            ?>
                                        </label>
                                    </div>

                                    <div class=" col-12 col-lg-3 ">
                                        <div class=" row">

                                            <div class=" col-6 d-grid">
                                                <button class=" btn btn-secondary rounded border border-1 border-primary mt-5 fs-5" onclick="addFeedback('<?php echo $user_data['id']; ?>');">
                                                    <i class=" bi bi-info-circle-fill"></i>Feedback
                                                </button>
                                            </div>

                                            <div class=" col-6 d-grid">
                                                <button class=" btn btn-danger rounded mt-5 fs-5" onclick="toDelete('<?php echo $user_data['id'] ?>');">
                                                    <i class=" bi bi-trash-fill"></i> Delete
                                                </button>
                                            </div>

                                            <div class=" col-6 d-grid">
                                                <button class=" btn btn-info rounded border border-1 border-primary mt-5 fs-5" onclick="toInvoice('<?php echo $user_data['order_id'] ?>');">
                                                    <i class="bi bi-receipt"></i></i> invoice
                                                </button>
                                            </div>

                                            <div class=" col-6 d-grid">
                                                <button class=" btn btn-dark rounded border border-1 border-primary mt-5 fs-5" onclick="destination('<?php echo $user_data['id'] ?>');">
                                                    <i class="bi bi-geo-alt-fill"></i> Destination
                                                </button>
                                            </div>


                                        </div>
                                    </div>

                                </div>

                                <div class=" col-12">
                                    <hr>
                                </div>
                            </div>

                            <div class="modal fade" id="exampleModal<?php echo $user_data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"><?php echo $product_data["title"] ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="hidethis();">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Message:</label>
                                                    <textarea class="form-control" id="messagetext<?php echo $user_data['id']; ?>" cols="10" rows="10"></textarea>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="hidethis();">Close</button>
                                            <button type="button" class="btn btn-primary" onclick="SendFeedback('<?php echo $product_data['id']; ?>','<?php echo $user_data['id']; ?>');">Add Feedback</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="exampleModal2<?php echo $user_data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel2"><?php echo $product_data["title"] ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="hidethis2();">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Status:</label>

                                                    <div class=" col-12 bg-white d-grid">
                                                        <?php

                                                        $x = $user_data["status"];

                                                        if ($x == 0) {

                                                        ?>
                                                            <button class="btn btn-success mb-2 mt-2 fw-bold" disabled> Conform Order</button>
                                                        <?php

                                                        } else if ($x == 1) {

                                                        ?>
                                                            <button class="btn btn-warning mb-2 mt-2 fw-bold" disabled>Packing</button>
                                                        <?php

                                                        } else if ($x == 2) {

                                                        ?>
                                                            <button class="btn btn-info mb-2 mt-2 fw-bold" disabled>Dispatch</button>
                                                        <?php

                                                        } else if ($x == 3) {

                                                        ?>
                                                            <button class="btn btn-danger mb-2 mt-2 fw-bold" disabled>Delivered</button>
                                                        <?php

                                                        }

                                                        ?>

                                                        <!-- <button class=" btn btn-success mb-2 mt-2 fw-bold">Confirm Order</button> -->
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="hidethis2();">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        <?php

                        }

                        ?>


                    </div>
                </div>



                <div class=" col-12">
                    <hr>
                </div>

                <div class=" col-12 mb-3">
                    <div class=" row">
                        <div class=" col-0 col-lg-10 d-none d-lg-block"></div>
                        <div class=" col-12 col-lg-2 d-grid">
                            <button class=" btn btn-danger rounded fs-6">
                                <i class=" bi bi-trash-fill"></i> Clear All Record
                            </button>
                        </div>
                    </div>
                </div>



            <?php

            } else {
            ?>
                <h1>Please Log In to account</h1>
            <?php
            }
            ?>




            <?php require "footer.php" ?>
        </div>
    </div>


    <script src="bootstrap.bundle.js"></script>
    <script src="bootstrap.js"></script>
    <script src=" script.js"></script>
</body>

</html>