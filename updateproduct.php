<!DOCTYPE html>
<html>

<head>
    <title>Happy Cart | Add Product</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">

</head>

<body>

    <div class=" container-fluid">
        <div class=" row gy-3">

            <?php require "header.php" ?>

            <div class=" col-12">
                <div class=" row">

                    <?php

                    $product = $_SESSION["p"];

                    if (isset($product)) {


                    ?>

                        <div class=" col-12 text-center">
                            <h2 class=" h2 text-primary fw-bold">Update Product</h2>
                        </div>

                        <div class=" col-lg-12">
                            <div class="row">

                                <div class="col-12 col-lg-4">
                                    <div class="row">
                                        <div class=" col-12">
                                            <label class=" form-label fw-bold lbl1">Select Product Category</label>
                                        </div>
                                        <div class=" col-12 mb-3">
                                            <select class=" form-select" disabled>

                                                <?php

                                                $category_rs = Database::search("SELECT * FROM category WHERE id = '" . $product["category_id"] . "'");

                                                $category_data = $category_rs->fetch_assoc();

                                                ?>

                                                <option><?php echo $category_data["name"]; ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-4">
                                    <div class="row">
                                        <div class=" col-12">
                                            <label class=" form-label fw-bold lbl1">Select Product Brand</label>
                                        </div>
                                        <div class=" col-12 mb-3">
                                            <select class=" form-select" disabled>
                                                <?php

                                                $brand_rs = Database::search("SELECT * FROM brand WHERE id IN 
                                                (SELECT brand_id FROM model_has_brand WHERE id = '" . $product["model_has_brand_id"] . "' )");

                                                $brand_data = $brand_rs->fetch_assoc();

                                                ?>

                                                <option><?php echo $brand_data["name"]; ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-4">
                                    <div class="row">
                                        <div class=" col-12">
                                            <label class=" form-label fw-bold lbl1">Select Product Model</label>
                                        </div>
                                        <div class=" col-12 mb-3">
                                            <select class=" form-select" disabled>
                                                <?php

                                                $model_rs = Database::search("SELECT * FROM model WHERE id IN 
                                                (SELECT model_id FROM model_has_brand WHERE id = '" . $product["model_has_brand_id"] . "' )");

                                                $model_data = $model_rs->fetch_assoc();

                                                ?>

                                                <option><?php echo $model_data["name"]; ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class=" col-12">
                                    <hr class=" hr-break-1" />
                                </div>

                                <div class="col-12 mb-3">
                                    <div class=" row">
                                        <div class=" col-12">
                                            <label class=" form-label fw-bold lbl1">
                                                Add a title to your Product
                                            </label>
                                        </div>
                                        <div class="offset-0 offset-lg-2 col-lg-8 col-12">
                                            <input type="text" class=" form-control" value="<?php echo $product["title"]; ?>" id="ti">
                                        </div>
                                    </div>
                                </div>

                                <div class=" col-12">
                                    <hr class=" hr-break-1" />
                                </div>

                                <div class=" col-12">
                                    <div class="row">

                                        <div class=" col-12 col-lg-4">
                                            <div class=" row">
                                                <div class=" col-12">
                                                    <label class=" form-label fw-bold lbl1">Select Product Condition</label>
                                                </div>

                                                <?php

                                                if ($product["condition_id"] == 1) {

                                                ?>



                                                    <div class=" offset-1 col-11 col-lg-3 ms-5 form-check">
                                                        <input class="form-check-input" type="radio" name="condition" id="bn" checked disabled>
                                                        <label class="form-check-label" for="bn">
                                                            Brand new
                                                        </label>
                                                    </div>
                                                    <div class=" offset-1 col-11 col-lg-3 ms-5 form-check">
                                                        <input class="form-check-input" type="radio" name="condition" id="us" disabled />
                                                        <label class="form-check-label" for="us">
                                                            Used
                                                        </label>
                                                    </div>

                                                <?php

                                                } else {

                                                ?>

                                                    <div class=" offset-1 col-11 col-lg-3 ms-5 form-check">
                                                        <input class="form-check-input" type="radio" name="condition" id="bn" disabled>
                                                        <label class="form-check-label" for="bn">
                                                            Brand new
                                                        </label>
                                                    </div>
                                                    <div class=" offset-1 col-11 col-lg-3 ms-5 form-check">
                                                        <input class="form-check-input" type="radio" name="condition" id="us" checked disabled />
                                                        <label class="form-check-label" for="us">
                                                            Used
                                                        </label>
                                                    </div>

                                                <?php


                                                }

                                                ?>

                                            </div>



                                        </div>

                                        <div class=" col-12 col-lg-4">
                                            <div class="row">



                                                <div class=" col-12">
                                                    <label class=" form-label lbl1 fw-bold">Select Product Colour</label>
                                                </div>
                                                <div class=" col-12">
                                                    <div class="row">

                                                        <?php

                                                        if ($product["color_id"] == 1) {
                                                        ?>
                                                            <div class=" form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                                <input class=" form-check-input" type="radio" name="clrradio" id="clr1" checked disabled>
                                                                <label class=" form-check-label" for="clr1">
                                                                    Gold
                                                                </label>
                                                            </div>
                                                        <?php
                                                        } else if ($product["color_id"] == 2) {
                                                        ?>
                                                            <div class=" form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                                <input class=" form-check-input" type="radio" name="clrradio" id="clr2" checked disabled>
                                                                <label class=" form-check-label" for="clr2">
                                                                    Silver
                                                                </label>
                                                            </div>
                                                        <?php
                                                        } else if ($product["color_id"] == 3) {
                                                        ?><div class=" form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                                <input class=" form-check-input" type="radio" name="clrradio" id="clr3" checked disabled>
                                                                <label class=" form-check-label" for="clr3">
                                                                    Graphite
                                                                </label>
                                                            </div>
                                                        <?php
                                                        } else if ($product["color_id"] == 4) {
                                                        ?><div class=" form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                                <input class=" form-check-input" type="radio" name="clrradio" id="clr4" checked disabled>
                                                                <label class=" form-check-label" for="clr4">
                                                                    Pacific Blue
                                                                </label>
                                                            </div><?php
                                                                } else if ($product["color_id"] == 5) {
                                                                    ?><div class=" form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                                <input class=" form-check-input" type="radio" name="clrradio" id="clr5" checked disabled>
                                                                <label class=" form-check-label" for="clr5">
                                                                    Jet Black
                                                                </label>
                                                            </div><?php
                                                                } else if ($product["color_id"] == 6) {
                                                                    ?><div class=" form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                                <input class=" form-check-input" type="radio" name="clrradio" id="clr6" checked disabled>
                                                                <label class=" form-check-label" for="clr6">
                                                                    Rose Gold
                                                                </label>
                                                            </div><?php
                                                                } else {
                                                                    ?>

                                                            <div class=" form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                                <input class=" form-check-input" type="radio" name="clrradio" id="clr1" disabled>
                                                                <label class=" form-check-label" for="clr1">
                                                                    Gold
                                                                </label>
                                                            </div>

                                                            <div class=" form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                                <input class=" form-check-input" type="radio" name="clrradio" id="clr2" disabled>
                                                                <label class=" form-check-label" for="clr2">
                                                                    Silver
                                                                </label>
                                                            </div>

                                                            <div class=" form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                                <input class=" form-check-input" type="radio" name="clrradio" id="clr3" disabled>
                                                                <label class=" form-check-label" for="clr3">
                                                                    Graphite
                                                                </label>
                                                            </div>
                                                            <div class=" form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                                <input class=" form-check-input" type="radio" name="clrradio" id="clr4" disabled>
                                                                <label class=" form-check-label" for="clr4">
                                                                    Pacific Blue
                                                                </label>
                                                            </div>
                                                            <div class=" form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                                <input class=" form-check-input" type="radio" name="clrradio" id="clr5" disabled>
                                                                <label class=" form-check-label" for="clr5">
                                                                    Jet Black
                                                                </label>
                                                            </div>
                                                            <div class=" form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                                <input class=" form-check-input" type="radio" name="clrradio" id="clr6" disabled>
                                                                <label class=" form-check-label" for="clr6">
                                                                    Rose Gold
                                                                </label>
                                                            </div>
                                                        <?php
                                                                }

                                                        ?>






                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class=" col-12 col-lg-4">
                                            <div class=" row">
                                                <label class=" form-label fw-bold lbl1">Add Product Quantity</label>
                                                <input type="number" class=" form-control" value="<?php echo $product["qty"]; ?>" min="0" id="qty" />
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <hr class=" hr-break-1" />

                            <div class=" col-12">
                                <div class="row">

                                    <div class=" col-12 col-lg-6">
                                        <div class="row">

                                            <div class=" col-12">
                                                <label class=" form-label fw-bold lbl1">Cost Per Item</label>
                                            </div>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">Rs.</span>
                                                <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" value="<?php echo $product["price"]; ?>" disabled>
                                                <span class="input-group-text">.00</span>
                                            </div>

                                        </div>
                                    </div>

                                    <div class=" col-12 col-lg-6">
                                        <div class="row">

                                            <div class=" col-12">
                                                <label class=" form-label fw-bold lbl1">Approved Payment Methods</label>
                                            </div>
                                            <div class=" col-12">
                                                <div class="row">
                                                    <div class=" offset-2 col-2 pm1"></div>
                                                    <div class=" col-2 pm2"></div>
                                                    <div class=" col-2 pm3"></div>
                                                    <div class=" col-2 pm4"></div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                </div>
                            </div>

                            <hr class=" hr-break-1" />

                            <div class=" col-12">
                                <div class="row">

                                    <div class=" col-12">
                                        <label class=" form-label fw-bold lbl1">Delivery Costs</label>
                                    </div>

                                    <div class=" col-12 col-lg-6">
                                        <div class="row">

                                            <div class=" col-12 offset-lg-1 col-lg-3 ">
                                                <label>Delivery Cost Within Colombo</label>
                                            </div>
                                            <div class=" col-12 col-lg-8 ">
                                                <div class=" input-group mb-3">
                                                    <span class="input-group-text">Rs.</span>
                                                    <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" value="<?php echo $product["delivery_fee_colombo"]; ?>" id="dwc">
                                                    <span class=" input-group-text">.00</span>
                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                    <div class=" col-12 col-lg-6">
                                        <div class="row">

                                            <div class=" col-12 offset-lg-1 col-lg-3 ">
                                                <label>Delivery Cost Out of Colombo</label>
                                            </div>
                                            <div class=" col-12 col-lg-8 ">
                                                <div class=" input-group mb-3">
                                                    <span class="input-group-text">Rs.</span>
                                                    <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" value="<?php echo $product["delivery_fee_other"]; ?>" id="doc">
                                                    <span class="input-group-text">.00</span>
                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                </div>
                            </div>


                            <hr class=" hr-break-1" />

                            <div class=" col-12">
                                <div class="row">

                                    <div class=" col-12">
                                        <label class=" form-label fw-bold lbl1">Product Description</label>
                                        <div class=" col-12">
                                            <textarea class=" form-control" cols="30" rows="25" id="desc"><?php echo $product["description"]; ?></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <hr class=" hr-break-1" />

                            <div class=" col-12">
                                <div class="row">

                                    <div class=" col-12">
                                        <label class=" form-label fw-bold lbl1">Add Product Images</label>
                                    </div>
                                    <div class=" col-12 offset-lg-3 col-lg-6">
                                        <div class=" row">

                                            <?php

                                            $img_rs = Database::search("SELECT * FROM images WHERE product_id = '" . $product["id"] . "'");

                                            $img_data = $img_rs->fetch_assoc();

                                            ?>


                                            <div class=" col-4 border border-primary rounded">
                                                <img src="<?php echo $img_data["code"]; ?>" style="width: 250px; background-position: center;" id="preview0">
                                            </div>
                                            <div class=" col-4 border border-primary rounded">
                                                <img src="resources/addproductimg.svg" id="preview1">
                                            </div>
                                            <div class=" col-4 border border-primary rounded">
                                                <img src="resources/addproductimg.svg" id="preview2">
                                            </div>
                                        </div>
                                    </div>

                                    <div class=" col-12 offset-lg-3 col-lg-6 d-grid mt-3">

                                        <input type="file" accept="img/*" class=" d-none" id="imageuploader" multiple>
                                        <label class=" col-12 btn btn-primary" for="imageuploader" onclick="changeProductImage();">Upload Image</label>

                                    </div>

                                </div>
                            </div>

                            <hr class=" hr-break-1" />

                            <div class=" col-12">
                                <label class=" form-label fw-bold lbl1">Notice...</label>
                                <br />
                                <label class=" form-label">We are taking 5% of the product price from every product as a service charge.</label>

                            </div>

                            <div class=" offset-lg-4 col-12 col-lg-4 d-grid mb-3 mt-2">
                                <button class="btn btn-success fw-bold " onclick="updateProduct();">Update Product</button>
                            </div>



                        </div>

                </div>
            </div>

            <?php require "footer.php" ?>

        </div>
    </div>

    <script src="script.js"></script>
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

<?php
                    }
?>