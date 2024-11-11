<?php
require "connection.php";
?>

<!DOCTYPE html>
<html>

<head>
    <title>Happy Cart | Admin | Manage Product</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="resources/img/logo.svg">

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

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>

<body style="background-color: #00FF00; background-image: linear-gradient(90deg,#00FF00 0%, #32CD32 100%); min-height: 100vh;">

    <div class=" container-fluid">
        <div class=" row">

            <div class=" col-12 bg-light text-center ">
                <h2 class=" text-primary fw-bold">Manage All Products</h2>
            </div>

            <div class=" col-12 mt-3">
                <div class=" row">
                    <div class=" offset-0 offset-lg-3 col-12 col-lg-6 mb-3">
                        <div class=" row ">
                            <div class=" col-9">
                                <input class=" form-control" type="text">
                            </div>
                            <div class=" col-3 d-grid">
                                <button class=" btn btn-warning">Search Product</button>
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
                        <span class=" fs-4 fw-bold ">Product Image</span>
                    </div>

                    <div class=" col-4 col-lg-2 bg-primary py-2 ">
                        <span class=" fs-4 fw-bold text-white">Title</span>
                    </div>

                    <div class=" col-4 col-lg-2 bg-light py-2 d-lg-block">
                        <span class=" fs-4 fw-bold ">Price</span>
                    </div>

                    <div class=" col-2 bg-primary py-2 d-none d-lg-block">
                        <span class=" fs-4 fw-bold text-white">Quantity</span>
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

            $product_rs = Database::search("SELECT * FROM `product`");
            $product_num = $product_rs->num_rows;
            $result_per_page = 10;
            $number_of_page = ceil($product_num / $result_per_page);
            $page_first_result = ((int)$page_no - 1) * $result_per_page;

            $view_result_rs = Database::search("SELECT * FROM `product` LIMIT " . $result_per_page . " OFFSET " . $page_first_result . "");

            $view_result_num = $view_result_rs->num_rows;

            $c = 0;

            ?>

            <?php

            while ($product_data = $view_result_rs->fetch_assoc()) {
                $c += 1;

            ?>
                <div class=" col-12 mb-3">
                    <div class=" row">

                        <div class=" col-2 col-lg-1 bg-primary py-2 text-end">
                            <span class=" fs-4 fw-bold text-white"><?php echo $product_data["id"]; ?></span>
                        </div>
                        <?php
                        $img_rs = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $product_data["id"] . "'");
                        $img_data = $img_rs->fetch_assoc();
                        ?>
                        <div class=" col-2 bg-light py-2 d-none d-lg-block " onclick="viewProductModal(<?php echo $product_data['id']; ?>);">
                            <img src="<?php echo $img_data["code"]; ?>" style="height: 40px; margin-left: 80px;">
                        </div>

                        <div class=" col-4 col-lg-2 bg-primary py-2 ">
                            <span class=" fs-4 fw-bold text-white"><?php echo $product_data["title"]; ?></span>
                        </div>

                        <div class=" col-4 col-lg-2 bg-light py-2 d-lg-block">
                            <span class=" fs-4 fw-bold ">Rs . <?php echo $product_data["price"]; ?> .00</span>
                        </div>

                        <div class=" col-2 bg-primary py-2 d-none d-lg-block">
                            <span class=" fs-4 fw-bold text-white"><?php echo $product_data["qty"]; ?></span>
                        </div>

                        <div class=" col-2 bg-light py-2 d-none d-lg-block">
                            <span class=" fs-4 fw-bold"><?php

                                                        $row = $product_data["datetime_added"];
                                                        $splited = explode(" ", $row);
                                                        echo $splited[0];

                                                        ?></span>
                        </div>

                        <div class=" col-2 col-lg-1 bg-white py-2 d-grid">

                            <?php
                            $s = $product_data["status_id"];
                            if ($s == "1") {
                            ?>
                                <button class=" btn btn-danger" onclick="productBlock(<?php echo $product_data['id']; ?>);">Block</button>
                            <?php
                            } else {
                            ?>
                                <button class=" btn btn-success" onclick="productBlock(<?php echo $product_data['id']; ?>);">Unblock</button>
                            <?php
                            }
                            ?>



                        </div>

                    </div>
                </div>




                <!-- model -->
                <div class=" modal" tabindex="-1" id="viewproductmodal<?php echo $product_data["id"]; ?>">
                    <div class=" modal-dialog">
                        <div class=" modal-content">

                            <div class=" modal-header">
                                <h5 class=" modal-title"><?php echo $product_data["title"]; ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class=" modal-body">
                                <div class=" offset-lg-4 col-4">
                                    <img src="<?php echo $img_data["code"]; ?>" style="height: 150px;" class="img-fluid">
                                </div>
                                <div class=" col-12">
                                    <span class=" fs-5 fw-bold">Price</span>&nbsp;
                                    <span class=" fs-5">Rs. <?php echo $product_data["price"]; ?> .00</span><br>
                                    <span class=" fs-5 fw-bold">Quantity</span>&nbsp;
                                    <span class=" fs-5"> <?php echo $product_data["qty"]; ?> Product left</span><br>
                                    <span class=" fs-5 fw-bold">Seller :</span>&nbsp;

                                    <?php
                                    $seller_rs = Database::search("SELECT * FROM users WHERE email = '" . $product_data["users_email"] . "'");
                                    $seller_data = $seller_rs->fetch_assoc();

                                    ?>
                                    <span class=" fs-5"> <?php echo $seller_data["fname"] . " " . $seller_data["lname"] ?> </span><br>
                                    <span class=" fs-5 fw-bold">Description :</span>&nbsp;
                                    <span class=" fs-5"> <?php echo $product_data["description"]; ?> </span><br>


                                </div>


                            </div>

                            <div class=" modal-footer">


                                <button type="button" class=" btn btn-secondary" data-bs-dismiss="modal">Close</button>

                            </div>

                        </div>
                    </div>
                </div>
                <!-- model -->

            <?php
            }

            ?>

            <!-- pagination -->




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
            <!-- pagination -->

            <hr>

            <div class=" col-12 text-center">
                <h3>Manage Category</h3>
            </div>

            <div class=" col-12 mb-3">
                <div class=" row g-2">
                    <?php
                    $category_rs = Database::search("SELECT * FROM category");
                    $category_num = $category_rs->num_rows;
                    for ($i = 0; $i < $category_num; $i++) {
                        $category_data = $category_rs->fetch_assoc();
                    ?>
                        <div class="col-12 col-lg-3 border border-danger" style="height: 50px;">
                            <div class=" row">

                                <div class=" col-8 mt-2">
                                    <label"><?php echo $category_data["name"] ?></label>
                                </div>

                                <div class=" col-4 border-start border-secondary text-center mt-2">
                                    <label class=" form-label fs-4"><i class=" bi bi-trash"></i></label>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                    <div class="col-12 col-lg-3 border border-danger bg-success" style="height: 50px;">
                        <div class=" row">

                            <div class=" col-8 mt-2">
                                <label class=" form-label fw-bold fs-5">Add New Category</label>
                            </div>
                            <div class=" col-4 border-start border-secondary text-center mt-2" onclick="addNewCategory();">
                                <label class=" form-label fs-4"><i class=" bi bi-shield-fill-plus"></i></label>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <!-- model2 -->

            <div class=" modal" tabindex="-1" id="addCategoryModel">
                <div class=" modal-dialog">
                    <div class=" modal-content">
                        <div class=" modal-header">
                            <h5 class=" modal-title">Add new Category</h5>
                            <button type="button" class=" btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class=" modal-body">
                            <div class=" col-12">
                                <label>New Category Name :</label>
                                <input type="text" class=" form-control" id="n">
                            </div>
                            <div class=" col-12">
                                <label>Your Email Address :</label>
                                <input type="email" class=" form-control" id="e">
                            </div>

                        </div>
                        <div class=" modal-footer">
                            <button class=" btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class=" btn btn-primary" onclick="categoryVerifyModel();">Add Category</button>

                        </div>

                    </div>
                </div>
            </div>

            <!-- model2 -->

            <!-- model3 -->
            <div class=" modal" tabindex="-1" id="addCategoryModelVerification">
                <div class=" modal-dialog">
                    <div class=" modal-content">
                        <div class=" modal-header">
                            <h5 class=" modal-title">Verification</h5>
                            <button type="button" class=" btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class=" modal-body">
                            <div class=" col-12">
                                <label>Verification code :</label>
                                <input type="text" class=" form-control" id="vtxt">
                            </div>

                        </div>
                        <div class=" modal-footer">
                            <button class=" btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class=" btn btn-primary" onclick="saveCategory();">Verify & Save</button>

                        </div>

                    </div>
                </div>
            </div>
            <!-- model3 -->



        </div>
    </div>

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

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>