<?php require "connection.php";
session_start();
?>


<!DOCTYPE html>
<html>

<head>
    <title>Happy Cart | Selling History</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="resources/img/logo.svg">

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>

<body style="background-color: #00FF00; background-image: linear-gradient(90deg,#00FF00 0%, #32CD32 100%); min-height: 100vh;">

    <div class=" container-fluid">
        <div class=" row">

            <div class=" col-12 bg-light text-center mb-3">
                <label class=" form-label fs-1 fw-bold text-success">Selling History</label>
            </div>

            <div class=" col-12 bg-white mt-3 mb-3">
                <div class=" row">

                    <div class=" col-12 col-lg-3 mt-3 mb-3">
                        <label class=" form-label fs-5">Search by Invoice ID : </label>
                        <input type="text" class=" form-control fs-5" placeholder=" Invoice ID...">
                    </div>
                    <div class=" col-12 col-lg-2 mt-3 mb-3"></div>
                    <div class=" col-12 col-lg-3 mt-3 mb-3">
                        <label class=" form-label fs-5">From Date : </label>
                        <input type="date" class=" form-control fs-5">
                    </div>
                    <div class=" col-12 col-lg-3 mt-3 mb-3">
                        <label class=" form-label fs-5">To Date : </label>
                        <input type="date" class=" form-control fs-5">
                    </div>
                    <div class=" col-12 col-lg-1 mt-3 mb-3 d-grid">
                        <button class=" btn btn-success fw-bold fs-5">Find</button>
                    </div>

                </div>
            </div>

            <div class=" col-12 ">
                <div class=" row">

                    <div class=" col-1 bg-secondary text-end">
                        <label class=" form-label fs-5 fw-bold text-white">Invoice ID</label>
                    </div>
                    <div class=" col-3 bg-body text-end">
                        <label class=" form-label fs-5 fw-bold text-black">Product</label>
                    </div>
                    <div class=" col-3 bg-secondary text-end">
                        <label class=" form-label fs-5 fw-bold text-white">Buyer</label>
                    </div>
                    <div class=" col-2 bg-body text-end">
                        <label class=" form-label fs-5 fw-bold text-black">Amount</label>
                    </div>
                    <div class=" col-1 bg-secondary text-end">
                        <label class=" form-label fs-5 fw-bold text-white">Quantity</label>
                    </div>
                    <div class=" col-2 bg-white">
                        <label class=" form-label fs-5 fw-bold text-black">Delivery State</label>
                    </div>

                </div>
            </div>

            <?php

            $pageno;

            if (isset($_GET["page"])) {
                $pageno = $_GET["page"];
            } else {
                $pageno = 1;
            }

            $invoice_is = Database::search("SELECT * FROM `invoice`");
            $invoice_num = $invoice_is->num_rows;
            $result_per_page = 10;
            $number_of_pages = ceil($invoice_num / $result_per_page);
            $page_first_result = ((int)$pageno - 1) * $result_per_page;

            $result_rs = Database::search("SELECT * FROM invoice WHERE `users_email`='" . $_SESSION["u"]["email"] . "' LIMIT " . $result_per_page . " OFFSET " . $page_first_result . "");
            $result_num = $result_rs->num_rows;

            while ($result_data = $result_rs->fetch_assoc()) {
            ?>

                <div class=" col-12 mt-1">
                    <div class=" row">
                        <div class=" col-12" id=" loadResults">
                            <div class=" row" id="box">

                                <div class=" col-1 bg-secondary text-end">
                                    <label class=" form-label fs-5 fw-bold text-white"><?php echo $result_data["id"]; ?></label>
                                </div>

                                <?php
                                $product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $result_data['product_id'] . "'");
                                $product_num = $product_rs->num_rows;
                                $product_data = $product_rs->fetch_assoc();
                                ?>

                                <div class=" col-3 bg-body text-end">
                                    <label class=" form-label fs-5 fw-bold text-black"><?php echo $product_data["title"] ?></label>
                                </div>

                                <?php
                                $seller_rs = Database::search("SELECT * FROM users WHERE email = '" . $result_data["users_email"] . "'");
                                $seller_data = $seller_rs->fetch_assoc();

                                ?>

                                <div class=" col-3 bg-secondary text-end">
                                    <label class=" form-label fs-5 fw-bold text-white"><?php echo $seller_data["fname"] . " " . $seller_data["lname"] ?></label>
                                </div>
                                <div class=" col-2 bg-body text-end">
                                    <label class=" form-label fs-5 fw-bold text-black">Rs. <?php echo $product_data["price"] ?> .00</label>
                                </div>
                                <div class=" col-1 bg-secondary text-end">
                                    <label class=" form-label fs-5 fw-bold text-white"><?php echo $result_data["qty"] ?></label>
                                </div>
                                <div class=" col-2 bg-white d-grid">
                                    <?php

                                    $x = $result_data["status"];

                                    if ($x == 0) {

                                    ?>
                                        <button class="btn btn-success mb-2 mt-2 fw-bold" onclick="changeInvoiceId(<?php echo $result_data['id']; ?>);" id="btn<?php echo $result_data['id']; ?>"> Conform Order</button>
                                    <?php

                                    } else if ($x == 1) {

                                    ?>
                                        <button class="btn btn-warning mb-2 mt-2 fw-bold" onclick="changeInvoiceId(<?php echo $result_data['id']; ?>);" id="btn<?php echo $result_data['id']; ?>">Packing</button>
                                    <?php

                                    } else if ($x == 2) {

                                    ?>
                                        <button class="btn btn-info mb-2 mt-2 fw-bold" onclick="changeInvoiceId(<?php echo $result_data['id']; ?>);" id="btn<?php echo $result_data['id']; ?>">Dispatch</button>
                                    <?php

                                    } else if ($x == 3) {

                                    ?>
                                        <button class="btn btn-danger mb-2 mt-2 fw-bold" onclick="changeInvoiceId(<?php echo $result_data['id']; ?>);" id="btn<?php echo $result_data['id']; ?>" disabled>Delivered</button>
                                    <?php

                                    }

                                    ?>

                                    <!-- <button class=" btn btn-success mb-2 mt-2 fw-bold">Confirm Order</button> -->
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            <?php
            }
            ?>



            <div class=" offset-lg-4 col-12 col-lg-4 text-center mt-3 mb-3 d-flex justify-content-center">
                <div class=" row">
                    <div class="pagination">
                        <a href="<?php if ($pageno <= 1) {
                                        echo "#";
                                    } else {
                                        echo "?page=" . ($pageno - 1);
                                    } ?>">&laquo;</a>

                        <?php
                        for ($page = 1; $page <= $number_of_pages; $page++) {
                            if ($page == $pageno) {
                        ?>
                                <a href="<?php echo "?page=" . ($page); ?>" class="active"><?php echo $page; ?></a>
                            <?php
                            } else {
                            ?>
                                <a href="<?php echo "?page=" . ($page); ?>"><?php echo $page; ?></a>

                        <?php
                            }
                        }
                        ?>

                        <a href="<?php if ($pageno >= $number_of_pages) {
                                        echo "#";
                                    } else {
                                        echo "?page=" . ($pageno + 1);
                                    } ?>">&raquo;</a>
                    </div>
                </div>

            </div>
        </div>

        <script src="script.js"></script>
        <script src="bootstrap.js"></script>
</body>

</html>