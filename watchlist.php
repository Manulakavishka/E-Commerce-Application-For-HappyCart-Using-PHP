<!DOCTYPE html>
<html>

<head>
    <title>Happy Cart | Watchlist</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="icon" href="resources/img/logo.svg" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="bootstrap.css" />

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
</head>

<body>

    <div class=" container-fluid">
        <div class=" row">

            <?php require "header.php";

            if (isset($_SESSION["u"])) {
                $u = $_SESSION["u"]["email"];

            ?>



                <div class=" col-12">
                    <div class=" row">
                        <div class=" col-12 border-1 border-secondary rounded">
                            <div class=" row">

                                <div class=" col-12">
                                    <label class=" form-label fs-1 fw-bolder">Watchlist &hearts;</label>
                                </div>
                                <div class=" col-12 col-lg-6 ">
                                    <hr class=" hr-break-1">
                                </div>
                                <div class=" col-12">
                                    <div class=" row">
                                        <div class=" offset-lg-2 col-12 col-lg-6 mb-3">
                                            <input type="text" class=" form-control" placeholder=" Search in Watchlist...">
                                        </div>
                                        <div class=" col-12 col-lg-2 mb-3 d-grid">
                                            <button class=" btn btn-outline-success">Search</button>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-12">
                                    <hr class=" hr-break-1">
                                </div>

                                <div class=" col-11 col-lg-2 border-0 border-end border-1 border-primary">

                                    <nav aria-label="breadcrumb">
                                        <ol class=" breadcrumb">
                                            <li class=" breadcrumb-item"><a href="home.php">Home</a></li>
                                            <li class=" breadcrumb-item active" aria-current="page">Watchlist</li>
                                        </ol>
                                    </nav>

                                    <nav class=" nav nav-pills flex-column">
                                        <a href="#" class=" nav-link active" aria-current="page">My Watchlist</a>
                                        <a href="cart.php" class=" nav-link">My Cart</a>
                                        <a href="#" class=" nav-link">Recent</a>
                                    </nav>

                                </div>

                                <?php

                                $watchlist_rs = Database::search("SELECT * FROM watchlist WHERE users_email = '" . $u . "'");
                                $watchlist_num = $watchlist_rs->num_rows;

                                if ($watchlist_num == 0) {

                                ?>
                                    <!-- no items -->

                                    <div class=" col-12 col-lg-9">
                                        <div class=" row">
                                            <div class=" col-12 emptyView"></div>
                                            <div class=" col-12 text-center">
                                                <label class=" form-label fs-1 fw-bold">
                                                    You have no items in your Watchlist yet.
                                                </label>
                                            </div>
                                            <div class=" offset-lg-4 col-12 col-lg-4 d-grid mb-3 ">
                                                <a href="index.php" class=" btn btn-warning fs-3 fw-bold">Start Shopping</a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- no items -->

                                <?php

                                } else {

                                ?>
                                    <!-- have products -->
                                    <div class=" col-12 col-lg-9">
                                        <div class=" row g-2">
                                            <?php

                                            for ($x = 0; $x < $watchlist_num; $x++) {
                                                $watchlist_data = $watchlist_rs->fetch_assoc();
                                                $product_id = $watchlist_data["product_id"];

                                                $product_rs = Database::search("SELECT * FROM product WHERE id = '" . $product_id . "'");
                                                $product_data = $product_rs->fetch_assoc();

                                            ?><?php

                                                $img_rs = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $product_data["id"] . "'");
                                                $img_data = $img_rs->fetch_assoc();


                                                ?>


                                            <div class=" card mb-3 mx-0 mx-lg-2 col-12">

                                                <div class="row g-0">
                                                    <div class=" col-md-4 ">
                                                        <img src="<?php echo $img_data["code"]; ?>" class=" img-fluid rounded-start">
                                                    </div>
                                                    <div class=" col-md-5">
                                                        <div class=" card-body">
                                                            <h5 class=" card-title fw-bold fs-2"><?php echo $product_data["title"]; ?></h5>

                                                            <?php
                                                            $color_rs = Database::search("SELECT * FROM `color` WHERE `id` = '" . $product_data["color_id"] . "'");
                                                            $color_data = $color_rs->fetch_assoc();

                                                            $condition_rs = Database::search("SELECT * FROM `condition` WHERE `id` = '" . $product_data["condition_id"] . "'");
                                                            $condition_data = $condition_rs->fetch_assoc();
                                                            ?>

                                                            <span class=" fs-5 fw-bold text-black-50 ">Color : <?php echo $color_data["name"]; ?></span>
                                                            &nbsp;&nbsp;| &nbsp;&nbsp;
                                                            <span class=" fs-5 fw-bold text-black-50 ">Condition : <?php echo $condition_data["name"]; ?></span>
                                                            <br>

                                                            <span class=" fs-5 fw-bold text-black-50 ">Price :</span>&nbsp;&nbsp;
                                                            <span class=" fs-5 fw-bold text-black ">Rs. <?php echo $product_data["price"]; ?> .00</span>

                                                            <br>
                                                            <span class=" fs-5 fw-bold text-black-50 ">Quantity :</span>&nbsp;&nbsp;
                                                            <span class=" fs-5 fw-bold text-black "><?php echo $product_data["qty"] ?> Items available</span>

                                                            <br>
                                                            <span class=" fs-5 fw-bold text-black-50 ">Seller :</span>
                                                            <br>

                                                            <?php
                                                            $sellerName_rs = Database::search("SELECT * FROM users WHERE email IN ( SELECT users_email FROM product WHERE id='" . $watchlist_data['product_id'] . "')");
                                                            $sellerName_data = $sellerName_rs->fetch_assoc();
                                                            ?>

                                                            <span class=" fs-5 fw-bold text-black "><?php echo $sellerName_data["fname"] . " " . $sellerName_data["lname"] ?></span>
                                                        </div>
                                                    </div>
                                                    <div class=" col-md-3 mt-5">
                                                        <div class=" card-body d-lg-grid">
                                                            <a href='<?php echo "singleProductView.php?id=" . ($product_id); ?>' class=" btn btn-outline-success mb-2">Buy Now</a>
                                                            <a onclick="addToCart(<?php echo $product_id ?>)" class=" btn btn-outline-secondary mb-2">Add to Cart</a>
                                                            <a href="#" class=" btn btn-outline-danger" onclick="removeFromWatchlist(<?php echo $watchlist_data['id']; ?>);">Remove</a>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>



                                        <?php

                                            }

                                        ?>
                                        </div>
                                    </div>

                                    <!-- have products -->

                                <?php
                                }

                                ?>





                            </div>
                        </div>
                    </div>
                </div>

            <?php

            } else {
                echo "Please Sign In or Register.";
            }

            ?>

            <?php require "footer.php"; ?>

        </div>
    </div>

    <script src=" script.js"></script>
    <script src="bootstrap.bundle.js"></script>
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