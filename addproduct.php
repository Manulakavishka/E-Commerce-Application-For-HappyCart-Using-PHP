<!DOCTYPE html>
<html>

<head>
    <title>Happy Cart | Add Product</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="resources/img/logo.svg" />
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
            <!-- GET THE HEADER  -->

            <?php

            if (isset($_SESSION["u"])) {
                //IF USER SESSION EXIST
            ?>

                <div class=" col-12">
                    <div class=" row">

                        <div class=" col-12 text-center">
                            <h2 class=" h2 text-success fw-bold">Add New Product</h2>
                        </div>

                        <div class=" col-lg-12">
                            <div class="row">

                                <div class="col-12 col-lg-4">
                                    <div class="row">
                                        <div class=" col-12">
                                            <label class=" form-label fw-bold lbl1">Select Product Category</label>
                                        </div>
                                        <div class=" col-12 mb-3">
                                            <select class=" form-select" id="category">
                                                <option value="0">Select Category</option>

                                                <?php

                                                //LOAD CATEGORIES
                                                $category_rs = Database::search("SELECT * FROM category");
                                                $category_num = $category_rs->num_rows;

                                                for ($x = 0; $x < $category_num; $x++) {
                                                    $category_data = $category_rs->fetch_assoc();

                                                ?>

                                                    <option value="<?php echo $category_data["id"]; ?>"><?php echo $category_data["name"]; ?></option>

                                                <?php

                                                }

                                                ?>


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
                                            <select class=" form-select" id="brand">
                                                <option value="0">Select Brand</option>

                                                <?php
                                                //LOAD BRANDS
                                                $brand_rs = Database::search("SELECT * FROM brand");
                                                $brand_num = $brand_rs->num_rows;



                                                for ($y = 0; $y < $brand_num; $y++) {
                                                    $brand_data = $brand_rs->fetch_assoc();

                                                ?>

                                                    <option value="<?php echo $brand_data["id"]; ?>"><?php echo $brand_data["name"]; ?></option>

                                                <?php

                                                }

                                                ?>

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
                                            <select class=" form-select" id="model">
                                                <option value="0">Select Model</option>

                                                <?php
                                                //LOAD MODALS
                                                $model_rs = Database::search("SELECT * FROM model");
                                                $model_num = $model_rs->num_rows;

                                                for ($z = 0; $z < $model_num; $z++) {
                                                    $model_data = $model_rs->fetch_assoc();

                                                ?>

                                                    <option value="<?php echo $model_data["id"]; ?>"><?php echo $model_data["name"]; ?></option>

                                                <?php

                                                }

                                                ?>
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
                                            <input type="text" class=" form-control" id="title">
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

                                                <div class=" offset-1 col-11 col-lg-3 ms-5 form-check">
                                                    <input class="form-check-input" type="radio" name="condition" id="bn" checked>
                                                    <label class="form-check-label" for="bn">
                                                        Brand new
                                                    </label>
                                                </div>
                                                <div class=" offset-1 col-11 col-lg-3 ms-5 form-check">
                                                    <input class="form-check-input" type="radio" name="condition" id="us" />
                                                    <label class="form-check-label" for="us">
                                                        Used
                                                    </label>
                                                </div>

                                            </div>
                                        </div>

                                        <div class=" col-12 col-lg-4">
                                            <div class="row">

                                                <div class=" col-12">
                                                    <label class=" form-label lbl1 fw-bold">Select Product Colour</label>
                                                </div>
                                                <div class=" col-12">
                                                    <div class="row">

                                                        <div class=" form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                            <input class=" form-check-input" type="radio" name="clrradio" id="clr1" checked>
                                                            <label class=" form-check-label" for="clr1">
                                                                Gold
                                                            </label>
                                                        </div>
                                                        <div class=" form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                            <input class=" form-check-input" type="radio" name="clrradio" id="clr2">
                                                            <label class=" form-check-label" for="clr2">
                                                                Silver
                                                            </label>
                                                        </div>
                                                        <div class=" form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                            <input class=" form-check-input" type="radio" name="clrradio" id="clr3">
                                                            <label class=" form-check-label" for="clr3">
                                                                Graphite
                                                            </label>
                                                        </div>
                                                        <div class=" form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                            <input class=" form-check-input" type="radio" name="clrradio" id="clr4">
                                                            <label class=" form-check-label" for="clr4">
                                                                Pacific Blue
                                                            </label>
                                                        </div>
                                                        <div class=" form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                            <input class=" form-check-input" type="radio" name="clrradio" id="clr5">
                                                            <label class=" form-check-label" for="clr5">
                                                                Jet Black
                                                            </label>
                                                        </div>
                                                        <div class=" form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                            <input class=" form-check-input" type="radio" name="clrradio" id="clr6">
                                                            <label class=" form-check-label" for="clr6">
                                                                Rose Gold
                                                            </label>
                                                        </div>


                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class=" col-12 col-lg-4">
                                            <div class=" row">
                                                <label class=" form-label fw-bold lbl1">Add Product Quantity</label>
                                                <input type="number" class=" form-control" value="0" min="0" id="qty" />
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
                                                <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="cost">
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
                                                    <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="dwc">
                                                    <span class="input-group-text">.00</span>
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
                                                    <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="doc">
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
                                            <textarea class=" form-control" cols="30" rows="25" id="description"></textarea>
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
                                            <div class=" col-4 border border-primary rounded">
                                                <img class=" img-fluid" src="resources/addproductimg.svg" id="preview0" style="width: 250px; background-position: center;">
                                            </div>
                                            <div class=" col-4 border border-primary rounded">
                                                <img class=" img-fluid" src="resources/addproductimg.svg" id="preview1" style="width: 250px; background-position: center;">
                                            </div>
                                            <div class=" col-4 border border-primary rounded">
                                                <img class=" img-fluid" src="resources/addproductimg.svg" id="preview2" style="width: 250px; background-position: center;">
                                            </div>
                                        </div>
                                    </div>

                                    <div class=" col-12 offset-lg-3 col-lg-6 d-grid mt-3">

                                        <input type="file" accept="img/*" class=" d-none" id="imageuploader" multiple />
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
                                <button class="btn btn-success fw-bold " onclick="addproduct();">Add Product</button>
                            </div>



                        </div>

                    </div>
                </div>

                <?php require "footer.php" ?>
                <!-- GET FOOTER  -->

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
            } else {
                //   IF NOT SESSION EXITS 
                header("Location:index.php");
            }

?>