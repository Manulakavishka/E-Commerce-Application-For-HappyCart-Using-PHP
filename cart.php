<!DOCTYPE html>
<html>

<head>

    <title>Happy Cart | Cart</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="resources/img/logo.svg" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
</head>

<body>

    <div class=" container-fluid">
        <div class=" row">

            <?php

            require "header.php";

            if (isset($_SESSION["u"])) {
                $uemail = $_SESSION["u"]["email"];
                // echo $uemail;

                $total = 0;

                $subTotal = 0;
                $shipping = 0;

            ?>

                <div class=" col-12 pt-2 " style="background-color: #E3E5E4;">

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item" aria-current="page">Home</li>
                            <li class="breadcrumb-item active" aria-current="page">Cart</li>
                        </ol>
                    </nav>
                </div>

                <div class=" col-12 border border-0 border-secondary rounded mb-3">
                    <div class=" row">

                        <div class=" col-12">
                            <label class=" form-label fs-1 fw-bold">Basket <i class=" b1 bi-cart3 fs-2"></i></label>
                        </div>

                        <div class=" col-12 col-lg-6">
                            <hr class=" hr-break-1" />
                        </div>

                        <div class=" col-12">
                            <div class=" row">
                                <div class=" col-8 col-lg-6 offset-0 offset-lg-2 mb-3">
                                    <input type="text" class=" form-control" placeholder="Search in Busket" />
                                </div>
                                <div class=" col-4 col-lg-4 offset-0  mb-3">
                                    <button class=" btn btn-success">Search</button>
                                </div>
                            </div>
                        </div>

                        <div class=" col-12">
                            <hr class=" hr-break-1">
                        </div>

                        <?php

                        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email` = '" . $uemail . "'");
                        $cart_num = $cart_rs->num_rows;

                        if ($cart_num == 0) {

                        ?>
                            <div class=" col-12 ">
                                <div class=" row">
                                    <div class=" col-12 emtycart"></div>

                                    <div class=" col-12 text-center mb-2">
                                        <label class=" form-label fs-1"> You have no item in your backet.</label>
                                    </div>

                                    <div class=" col-12 col-lg-4 offset-0 offset-lg-4 d-grid mb-4">
                                        <a href="#" class=" btn btn-success fs-5">Start Shopping</a>
                                    </div>

                                </div>
                            </div>
                            <?php
                        } else {

                            for ($x = 0; $x < $cart_num; $x++) {
                                $cart_data = $cart_rs->fetch_assoc();

                                $product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $cart_data["product_id"] . "'");
                                $product_data = $product_rs->fetch_assoc();

                                $total = $total + ($product_data["price"] * $cart_data["qty"]);

                                $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `users_email` = '" . $uemail . "'");
                                $address_data = $address_rs->fetch_assoc();
                                $city_id = $address_data["city_id"];

                                $district_rs = Database::search("SELECT * FROM `city` WHERE `id` = '" . $city_id . "'");
                                $district_data = $district_rs->fetch_assoc();

                                $district_id = $district_data["district_id"];


                                $ship = 0;

                                if ($district_id == 4) {
                                    $ship = $product_data["delivery_fee_colombo"];
                                    $shipping = $shipping + $product_data["delivery_fee_colombo"];
                                } else {
                                    $ship = $product_data["delivery_fee_other"];
                                    $shipping = $shipping + $product_data["delivery_fee_other"];
                                }

                                $user_rs = Database::search("SELECT * FROM `users` WHERE `email`= '" . $product_data["users_email"] . "'");
                                $user_data = $user_rs->fetch_assoc();


                            ?>
                                <div class=" col-12 col-lg-9 ">
                                    <div class=" row">

                                        <div class=" card mb-3 mx-0 col-12 ">
                                            <div class=" row g-0">


                                                <div class=" col-md-12 mt-3 mb-3">
                                                    <div class=" row ">
                                                        <div class=" col-12 ">

                                                            <span class=" fw-bold text-black-50 fs-5">Seller :</span>&nbsp;
                                                            <span class=" fw-bold text-black fs-5"><?php echo $user_data["fname"] . " " . $user_data["lname"] ?></span>&nbsp;

                                                        </div>
                                                    </div>
                                                </div>

                                                <hr>

                                                <div class=" col-md-4">

                                                    <?php

                                                    $img_rs = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $product_data["id"] . "'");
                                                    $img_data = $img_rs->fetch_assoc();


                                                    ?>

                                                    <span class=" d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="<?php echo $product_data["description"]; ?>" title="Product Description">
                                                        <img src="<?php echo $img_data["code"]; ?>" class=" img-fluid rounded-start" style=" max-width: 200px;">
                                                    </span>
                                                </div>

                                                <div class=" col-md-5">
                                                    <div class=" card-body">
                                                        <h3 class=" card-title"><?php echo $product_data["title"]; ?></h3>

                                                        <?php
                                                        $color_rs = Database::search("SELECT * FROM `color` WHERE `id` = '" . $product_data["color_id"] . "'");
                                                        $color_data = $color_rs->fetch_assoc();

                                                        $condition_rs = Database::search("SELECT * FROM `condition` WHERE `id` = '" . $product_data["condition_id"] . "'");
                                                        $condition_data = $condition_rs->fetch_assoc();
                                                        ?>

                                                        <span class=" fw-bold text-black-50">Colour : <?php echo $color_data["name"]; ?></span> &nbsp;|
                                                        &nbsp;<span class=" fw-bold text-black-50">Condition : <?php echo $condition_data["name"]; ?></span>

                                                        <br />

                                                        <span class=" fw-bold text-black-50 fs-5">Price </span>
                                                        <span class=" fw-bold text-black-50 fs-5">Rs. <?php echo $product_data["price"]; ?>.00</span>

                                                        <br>

                                                        <span class=" fw-bold text-black-50 fs-5">Quantity</span>&nbsp;|
                                                        <input type="number" class=" mt-3 border border-2 border-secondary fs-4 fw-bold px-3 cardqtytext" value="<?php echo $cart_data["qty"]; ?>">

                                                        <br><br>

                                                        <span class=" fw-bold text-black-50 fs-5">Delivery Fee :</span>&nbsp;|
                                                        <span class=" fw-bold text-black0 fs-5">Rs. <?php echo $ship; ?>.00</span>&nbsp;|

                                                    </div>
                                                </div>

                                                <div class=" col-md-3">
                                                    <div class=" card-body d-grid">
                                                        <a href='<?php echo "singleProductView.php?id=" . ($cart_data["product_id"]); ?>' class="btn btn-outline-success mb-3">Buy Now</a>
                                                        <a href="#" class="btn btn-outline-danger" onclick="deleteFromCart(<?php echo $cart_data['id']; ?>)">Remove</a>
                                                    </div>
                                                </div>

                                                <hr>

                                                <div class=" col-md-12 mt-3 mb-3">
                                                    <div class=" row">
                                                        <div class=" col-6 col-md-6">
                                                            <span class=" fw-bold fs-5 text-black-50 ">Requested Total <i class=" bi bi-info-circle"></i></span>
                                                        </div>
                                                        <div class=" col-6 col-md-6 text-end">
                                                            <span class=" fw-bold fs-5 text-black-50">Rs.<?php echo ($product_data["price"] * $cart_data["qty"]) + $ship; ?>.00</span>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>


                                    </div>
                                </div>


                        <?php
                            }
                        }
                        ?>


                        <div class="col-12 col-lg-3 ">
                            <div class="row">

                                <div class="col-12">
                                    <label class="form-label fs-3 fw-bold">Summary</label>
                                </div>

                                <div class="col-12">
                                    <hr />
                                </div>

                                <div class="col-6 mb-3">
                                    <span class="fs-6 fw-bold">items (<?php echo $cart_num; ?>)</span>
                                </div>

                                <div class="col-6 text-end mb-3">
                                    <span class="fs-6 fw-bold">Rs. <?php echo $total; ?> .00</span>
                                </div>

                                <div class="col-6">
                                    <span class="fs-6 fw-bold">Shipping</span>
                                </div>

                                <div class="col-6 text-end">
                                    <span class="fs-6 fw-bold">Rs. <?php echo $shipping; ?> .00</span>
                                </div>

                                <div class="col-12 mt-3">
                                    <hr />
                                </div>

                                <div class="col-6 mt-2">
                                    <span class="fs-4 fw-bold">Total</span>
                                </div>

                                <div class="col-6 mt-2 text-end">
                                    <span class="fs-4 fw-bold">Rs. <?php echo $total + $shipping; ?> .00</span>
                                </div>

                                <div class="col-12 mt-3 mb-3 d-grid">
                                    <button class="btn btn-success fs-5 fw-bold">CHECKOUT</button>
                                </div>

                            </div>
                        </div>



                    </div>
                </div>

            <?php

            } else {
                echo "Please sign in first";
            }

            ?>


            <?php require "footer.php"; ?>

        </div>
    </div>

    <script src="script.js"></script>



    <script src="bootstrap.bundle.js"></script>
    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
    </script>
    <script src="bootstrap.js"></script>

    <!-- SweetAlert2 -->
    <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="plugins/toastr/toastr.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- Page specific script -->
</body>

</html>