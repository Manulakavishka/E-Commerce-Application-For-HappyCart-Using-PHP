<!DOCTYPE html>
<html>

<head>
    <title>HappyCart | Single Product View</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="resources/img/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />


    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">

</head>

<body>

    <div class=" container-fluid">
        <div class=" row">
            <?php require "header.php" ?>

            <?php

            if (isset($_GET["id"])) {

                $pid = $_GET["id"];

                $product_rs = Database::search("SELECT product.id,product.category_id,product.model_has_brand_id,product.title,
    product.price,product.qty,product.description,product.condition_id,product.status_id,product.users_email,
    model.name AS mname, brand.name AS bname FROM product 
    INNER JOIN model_has_brand ON product.model_has_brand_id = model_has_brand.id 
    INNER JOIN brand ON brand.id = model_has_brand.brand_id 
    INNER JOIN model ON model.id = model_has_brand.model_id 
    WHERE product.id= '" . $pid . "'");

                $product_num = $product_rs->num_rows;
                // echo $product_num;
                if ($product_num == 1) {
                    $product_data = $product_rs->fetch_assoc();

            ?>

                    <div class=" col-12 mt-0 bg-white singleproduct">
                        <div class="row">

                            <div class=" col-12 " style="padding: 11px;">
                                <div class=" row">

                                    <?php
                                    // echo $_GET["id"];
                                    ?>

                                    <div class=" col-12 col-lg-2 order-2 order-lg-1">
                                        <ul>

                                            <?php

                                            $product_img_rs = Database::search("SELECT * FROM images WHERE product_id = '" . $pid . "'");

                                            $product_img_num = $product_img_rs->num_rows;
                                            $img = array();

                                            if ($product_img_num != 0) {
                                                for ($x = 0; $x < $product_img_num; $x++) {
                                                    $product_img_data = $product_img_rs->fetch_assoc();
                                                    $img[$x] = $product_img_data["code"];
                                                    // echo $img[$x];

                                            ?>

                                                    <li class=" d-flex flex-column justify-content-center align-items-center border border-1 border-secondary mb-1">
                                                        <img src="<?php echo $img[$x]; ?>" class=" img-thumbnail mt-1 mb-1" style="height:200px;" id="productImg<?php echo $x; ?>" onclick="loadMainImg(<?php echo $x; ?>);" />
                                                    </li>

                                                <?php

                                                }
                                            } else {
                                                ?>
                                                <li class=" d-flex flex-column justify-content-center align-items-center border border-1 border-secondary mb-1">
                                                    <img src="resources/empty.svg" class=" img-thumbnail mt-1 mb-1" id="productImg0">
                                                </li>
                                                <li class=" d-flex flex-column justify-content-center align-items-center border border-1 border-secondary mb-1">
                                                    <img src="resources/empty.svg" class=" img-thumbnail mt-1 mb-1">
                                                </li>
                                                <li class=" d-flex flex-column justify-content-center align-items-center border border-1 border-secondary mb-1">
                                                    <img src="resources/empty.svg" class=" img-thumbnail mt-1 mb-1">
                                                </li>

                                            <?php
                                            }

                                            ?>


                                        </ul>
                                    </div>

                                    <div class=" col-lg-4 order-2 order-lg-1 d-none d-lg-block">
                                        <div class=" row">

                                            <div class=" col-12 align-items-center border border-1 border-secondary ">
                                                <div class=" mainImg" id="mainImg"></div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class=" col-12 col-lg-6 order-3">
                                        <div class=" row">
                                            <div class=" col-12">

                                                <div class=" row border-bottom border-dark">

                                                    <nav aria-label=" breadcrumb">
                                                        <ol class=" breadcrumb">
                                                            <li class=" breadcrumb-item"><a href="home.php"></a>Home</li>
                                                            <li class=" breadcrumb-item active" aria-current="page">Single Product View</li>
                                                        </ol>
                                                    </nav>


                                                </div>

                                                <div class=" row border-bottom border-dark">
                                                    <div class=" col-12 my-3">
                                                        <span class=" fs-4 fw-bold text-success" id="ptitle"><?php echo $product_data["title"]; ?></span>
                                                    </div>
                                                </div>

                                                <div class="row border-bottom border-dark">
                                                    <div class="col-12">
                                                        <span class="badge">
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-half text-warning fs-5"></i>


                                                            &nbsp;&nbsp;&nbsp;

                                                            <label class=" fs-5 text-dark fw-bold">4.5 Stars | 35 Ratings And Reviews</label>


                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="row border-bottom border-dark">

                                                    <div class="col-12 my-2">

                                                        <?php

                                                        $price = $product_data["price"];
                                                        $addingPrice = ($price / 100) * 5;
                                                        $newPrice = $price + $addingPrice;
                                                        $difference = $newPrice - $price;
                                                        $percemtage = ($difference / $price) * 100;

                                                        ?>

                                                        <span class="fs-4 fw-bold text-black" id="unitPrice">Rs. <?php echo $product_data["price"]; ?>.00</span>
                                                        &nbsp;&nbsp; | &nbsp;&nbsp;
                                                        <span class="fs-4 fw-bold text-danger"><del>Rs. <?php echo $newPrice; ?>.00</del></span>
                                                        &nbsp;&nbsp; | &nbsp;&nbsp;
                                                        <span class="fs-4 fw-bold text-black-50">Save RS.<?php echo $difference; ?>.00 (<?php echo $percemtage; ?>%)</span>
                                                    </div>

                                                </div>

                                                <div class="row border-bottom border-dark">
                                                    <div class="col-12 my-2">
                                                        <span class=" fs-5 text-primary"><b>Warrenty : </b>6 Months warrenty</span>
                                                        <br>
                                                        <span class=" fs-5 text-primary"><b>Return Policy : </b>1 Months return policy</span>
                                                        <br>
                                                        <span class=" fs-5 text-primary"><b>In-stock : </b><?php echo $product_data['qty'] ?> Items Available</span>
                                                    </div>
                                                </div>

                                                <div class=" row border-bottom border-dark">
                                                    <div class=" col-12 my-2">
                                                        <div class=" row g-2">
                                                            <div class=" col-12 col-lg-6 border border-1 border-dark text-center">

                                                                <?php

                                                                $seller_rs = Database::search("SELECT CONCAT(fname,' ',lname) AS fullname FROM users WHERE users.email = '" . $product_data['users_email'] . "'");
                                                                $seller_data = $seller_rs->fetch_assoc();

                                                                ?>

                                                                <span class=" fs-4 text-info"><b>Seller : </b><?php echo $seller_data["fullname"]; ?></span>
                                                            </div>
                                                            <div class=" col-12 col-lg-6 border border-1 border-dark text-center">
                                                                <span class=" fs-4 text-success"><b>Sold : </b>10 Items</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class=" row">
                                                    <div class="col-12 ">
                                                        <div class=" row">
                                                            <div class=" my-2 offset-lg-2 col-12 col-lg-8 border border-1 border-danger rounded">
                                                                <div class=" row">
                                                                    <div class=" col-3 col-lg-2 border-end border-1 border-danger">
                                                                        <img src="resources/pricetag.png">
                                                                    </div>
                                                                    <div class=" col-9 col-lg-10">
                                                                        <span class=" fs-5 fw-bold text-warning">
                                                                            Stand a chance to get 5% discount by using VISA or MATER
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class=" row">
                                                    <div class="col-12">
                                                        <div class=" row">
                                                            <div class=" col-12 my-3">
                                                                <div class="row g-2">

                                                                    <div class=" col-12 border border-1 border-secondary rounded overflow-hidden float-start mt-1 position-relative product_qty">
                                                                        <div class=" col-12">
                                                                            <span>Quntity : </span>
                                                                            <input type="text" class=" border-0 fs-5 fw-bold text-start" style=" outline: none;" pattern="[0-9]" value="1" onkeyup="check_value(<?php echo $product_data['qty'] ?>);" id="qty_input">

                                                                            <div class=" position-absolute qty_buttons">
                                                                                <div class=" justify-content-center d-flex flex-column align-items-center border border-1 border-secondary qty_inc">
                                                                                    <i class=" bi bi-caret-up text-info fs-5" onclick="qty_inc(<?php echo $product_data['qty'] ?>);"></i>
                                                                                </div>
                                                                                <div class=" justify-content-center d-flex flex-column align-items-center border border-1 border-secondary qty_dec">
                                                                                    <i class=" bi bi-caret-down text-info fs-5" onclick="qty_dec();"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="row">
                                                    <div class="col-12 mt-5">
                                                        <div class=" row">
                                                            <div class=" col-4 d-grid ">
                                                                <!-- <button class=" btn btn-success" onclick="buyNow( <?php
                                                                                                                        // echo $pid;
                                                                                                                        ?>);">Buy Now</button> -->
                                                                <button class=" btn btn-success" onclick="paynowproduct(<?php echo $product_data['price']; ?>,<?php echo $pid ?>  );">Buy Now</button>
                                                            </div>
                                                            <div class=" col-4 d-grid ">
                                                                <button class=" btn btn-primary">Add to Card</button>
                                                            </div>
                                                            <div class=" col-4 d-grid ">
                                                                <button class=" btn btn-outline-secondary">
                                                                    <i class="bi bi-heart-fill fs-4 text-danger"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>






                                </div>
                            </div>

                            <div class=" col-12 bg-white">
                                <div class=" row d-block me-0 mt-4 mb-3 border-bottom border-1 border-dark">
                                    <div class=" col-12">
                                        <span class=" fs-3 fw-bold ">Related Items</span>
                                    </div>
                                </div>
                            </div>

                            <div class=" col-12 bg-white">
                                <div class=" row g-2">



                                    <?php

                                    $related_rs = Database::search("SELECT * FROM product WHERE model_has_brand_id= '" . $product_data["model_has_brand_id"] . "' LIMIT 6");

                                    $related_num = $related_rs->num_rows;

                                    // echo $related_num;

                                    for ($y = 0; $y < $related_num; $y++) {
                                        $related_data = $related_rs->fetch_assoc();

                                        $img_rs = Database::search("SELECT * FROM images WHERE product_id = '" . $related_data["id"] . "'");

                                        $img = $img_rs->fetch_assoc();
                                    ?>
                                        <div class=" offset-1 offset-lg-0 col-4 col-lg-2">
                                            <div class="card" style="width: 18rem;">
                                                <img src="<?php echo $img["code"]; ?>" class="card-img-top">
                                                <div class="card-body">
                                                    <h4 class="card-title"><?php echo $related_data["title"]; ?></h4>
                                                    <span class=" fs-5 fw-bold ">Rs. <?php echo $related_data["price"]; ?>.00</span>
                                                    <div class=" col-12 ">
                                                        <div class=" row g-1">
                                                            <div class=" col-12 d-grid">
                                                                <button class=" btn btn-success">Buy Now</button>
                                                            </div>
                                                            <div class=" col-12 d-grid">
                                                                <button class=" btn btn-primary">Add to Card</button>
                                                            </div>
                                                            <div class=" col-12 d-grid ">
                                                                <button class=" btn btn-warning">
                                                                    <i class="bi bi-heart-fill fs-4 text-danger"></i>
                                                                </button>
                                                            </div>
                                                        </div>
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
                                <div class=" row d-block me-0 mt-4 mb-3 border-bottom border-1 border-dark">
                                    <div class=" col-12 ">
                                        <span class=" fs-4 fw-bold">Product Details</span>
                                    </div>
                                </div>
                            </div>

                            <div class=" col-12 bg-white">
                                <div class=" row">

                                    <div class=" col-6">

                                        <div class=" row">
                                            <div class=" col-3">
                                                <label class="form-label fs-4 fw-bold">Brand :</label>
                                            </div>
                                            <div class=" col-9">
                                                <label class="form-label fs-4"><?php echo $product_data["bname"] ?></label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class=" col-6">

                                        <div class=" row">
                                            <div class=" col-3">
                                                <label class="form-label fs-4 fw-bold">Model :</label>
                                            </div>
                                            <div class=" col-9">
                                                <label class="form-label fs-4"><?php echo $product_data["mname"] ?></label>
                                            </div>
                                        </div>

                                    </div>

                                    <div class=" col-12">

                                        <div class=" row">
                                            <div class=" col-12">
                                                <label class="form-label fs-4 fw-bold">Description :</label>
                                            </div>
                                            <div class=" col-12">
                                                <textarea class=" form-control " cols="60" rows="10" disabled><?php echo $product_data["description"] ?></textarea>
                                            </div>
                                        </div>

                                    </div>

                                </div>


                            </div>

                            <div class=" col-12">
                                <div class=" row d-block me-0 mt-4 mb-3 border-bottom border-1 border-dark">
                                    <div class=" col-12 ">
                                        <span class=" fs-4 fw-bold">Feedbacks</span>
                                    </div>
                                </div>
                            </div>

                            <div class=" col-12 bg-white">
                                <div class=" row">

                                    <div class=" col-12">

                                        <?php

                                        $invoice_rs = Database::search("SELECT * FROM `feedback` WHERE `product_id` = '" . $pid . "'");
                                        $invoice_num = $invoice_rs->num_rows;

                                        if ($invoice_num == 0) {
                                        ?>

                                            <div class=" row">
                                                <div class=" col-12">
                                                    <label class="form-label fs-4 fw-normal">There are no feedbacks to view.</label>
                                                </div>
                                            </div>

                                            <?php
                                        } else {

                                            while ($in_data = $invoice_rs->fetch_assoc()) {
                                            ?>
                                                <div class="col-12 border border-danger" style="height: 65px;">
                                                    <div class=" row">

                                                        <div class=" col-8 mt-2">
                                                            <label style="font-size: 20px;"><?php echo $in_data["feed"] ?></label>
                                                        </div>

                                                        <div class=" col-4 border-start border-secondary text-center mt-2">
                                                            <label class=" form-label fs-4"><?php echo $in_data['date'] ?></label>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                        }

                                        ?>


                                    </div>



                                </div>


                            </div>



                        </div>
                    </div>

                    <?php require "footer.php" ?>
        </div>
    </div>



    <script src="bootstrap.bundle.js"></script>
    <script src="bootstrap.js"></script>
    <script src="script.js"></script>

    <!-- SweetAlert2 -->
    <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="plugins/toastr/toastr.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- Page specific script -->
</body>

</html>

<?php

                } else {
                    echo "Sorry for the inconvenient";
                }
            } else {
                echo "Something went wrong";
            }

?>