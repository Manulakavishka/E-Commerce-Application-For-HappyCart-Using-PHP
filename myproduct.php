<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {

    $pageno;
    $email = $_SESSION["u"]["email"];

?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Happy Cart | My Products</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="icon" href="resources/img/logo.svg" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="style.css" />
    </head>

    <body style="background-color: #E9EBEE">

        <div class=" container-fluid">
            <div class="row">
                <!-- header -->

                <div class=" col-12 bg-success">
                    <div class=" row">
                        <div class=" col-4">
                            <div class=" row">

                                <div class=" col-12 col-lg-4 mt-1 mb-1 text-center">

                                    <?php

                                    $profile_img_rs = Database::search("SELECT * FROM `profile_image` 
                                    where `users_email` = '" . $email . "'");

                                    $profile_img_num = $profile_img_rs->num_rows;
                                    if ($profile_img_num == 1) {

                                        $profile_img_data = $profile_img_rs->fetch_assoc();

                                    ?>
                                        <img src="<?php echo $profile_img_data["path"]; ?>" class=" rounded-circle" width="90px" height="90px">
                                    <?php
                                    } else {

                                    ?>
                                        <img src="resources/profile images/user_icon.svg" class=" rounded-circle" width="90px" height="90px">
                                    <?php

                                    }


                                    ?>


                                </div>
                                <div class=" col-12 col-lg-8">
                                    <div class="row">
                                        <div class=" col-12 mt-0 mt-lg-3">
                                            <span class=" fw-bold"><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]; ?></span>
                                        </div>
                                        <div class=" col-12">
                                            <span class=" text-white"><?php echo $email; ?></span>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class=" col-8">
                            <div class=" row">
                                <div class=" col-12 mt-5 my-lg-3">
                                    <h1 class=" offset-6 offset-lg-3 fs-1 text-white fw-bold">My Products</h1>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- header -->
                <!-- body -->
                <div class=" col-12">
                    <div class="row">
                        <!-- sort -->

                        <div class=" col-11 col-lg-2 mx-3 my-3 border border-primary rounded">
                            <div class="row">

                                <div class=" col-12 mt-3 fs-5">
                                    <div class="row">

                                        <div class=" col-12 ">
                                            <label class=" form-label fw-bold fs-3">Sort Product</label>
                                        </div>

                                        <div class=" col-11">
                                            <div class="row">

                                                <div class=" col-10">
                                                    <input type="text" class=" form-control" placeholder="Search..." id="s" />
                                                </div>
                                                <div class=" col-1 p-1">
                                                    <label class=" form-label fs-3 bi bi-search"></label>
                                                </div>

                                            </div>
                                        </div>

                                        <div class=" col-12">
                                            <label class=" form-label fw-bold">Active Time</label>
                                        </div>

                                        <div class=" col-12">
                                            <hr width="80%">
                                        </div>

                                        <div class=" col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="n">
                                                <label class="form-check-label" for="n">
                                                    Newest to Oldest
                                                </label>
                                            </div>
                                        </div>
                                        <div class=" col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="o">
                                                <label class="form-check-label" for="o">
                                                    Oldest to Newest
                                                </label>
                                            </div>
                                        </div>
                                        <div class=" col-12 mt-3">
                                            <label class=" form-label fw-bold">By Quantity</label>
                                        </div>

                                        <div class=" col-12">
                                            <hr width="80%">
                                        </div>

                                        <div class=" col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault1" id="l">
                                                <label class="form-check-label" for="l">
                                                    High to Low
                                                </label>
                                            </div>
                                        </div>
                                        <div class=" col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault1" id="h">
                                                <label class="form-check-label" for="h">
                                                    Low to High
                                                </label>
                                            </div>
                                        </div>

                                        <div class=" col-12 mt-3">
                                            <label class=" form-label fw-bold">By Condition</label>
                                        </div>

                                        <div class=" col-12">
                                            <hr width="80%">
                                        </div>

                                        <div class=" col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault2" id="b">
                                                <label class="form-check-label" for="b">
                                                    Brandnew
                                                </label>
                                            </div>
                                        </div>
                                        <div class=" col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault2" id="u">
                                                <label class="form-check-label" for="u">
                                                    Used
                                                </label>
                                            </div>
                                        </div>

                                        <div class=" col-12 text-center mt-3 mb-3">
                                            <div class=" row g-2">
                                                <div class=" col-12 col-lg-6 d-grid">
                                                    <button class=" btn btn-success fw-bold" onclick="sortFunction();">Sort</button>
                                                </div>
                                                <div class=" col-12 col-lg-6 d-grid">
                                                    <button class=" btn btn-primary fw-bold" onclick="clearSort();">Clear</button>
                                                </div>
                                            </div>

                                        </div>


                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- sort -->

                        <!-- product -->

                        <div class=" col-12 col-lg-9 mt-3 mb-3 bg-white">
                            <div class=" row">

                                <div class=" col-10 offset-1 text-center " id="sort">
                                    <div class="row justify-content-center">

                                        <?php

                                        if (isset($_GET["page"])) {
                                            $pageno = $_GET["page"];
                                        } else {
                                            $pageno = 1;
                                        }

                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `users_email` = '" . $email . "'");
                                        $product_num = $product_rs->num_rows;
                                        $product_data = $product_rs->fetch_assoc();

                                        $results_per_page = 6;
                                        $number_of_pages = ceil($product_num / $results_per_page);

                                        $page_results = ($pageno - 1) * $results_per_page;
                                        $selected_rs = Database::search("SELECT * FROM `product` 
                                        WHERE `users_email` = '" . $email . "' LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                                        $selected_num = $selected_rs->num_rows;

                                        for ($x = 0; $x < $selected_num; $x++) {
                                            $selected_data = $selected_rs->fetch_assoc();
                                        ?>

                                            <!-- card -->
                                            <div class="card mb-3 mt-3 col-12 col-lg-6">
                                                <div class="row">
                                                    <div class="col-md-4 mt-4">

                                                        <?php

                                                        $product_img_rs = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $selected_data["id"] . "'");
                                                        $product_img_date = $product_img_rs->fetch_assoc();

                                                        ?>

                                                        <img src="<?php echo $product_img_date["code"]; ?>" class="img-fluid rounded-start" />
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body">
                                                            <h5 class="card-title fw-bold"><?php echo $selected_data["title"]; ?></h5>
                                                            <span class=" card-text fw-bold text-primary">RS. <?php echo $selected_data["price"]; ?> .00</span>
                                                            <br />
                                                            <span class=" card-text fw-bold text-success"><?php echo $selected_data["qty"]; ?> Items left</span>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault<?php echo $selected_data["id"] ?>" <?php if ($selected_data["status_id"] == 2) {
                                                                                                                                                                                                echo "checked";
                                                                                                                                                                                            } ?> onclick="changeStatus(<?php echo $selected_data['id'] ?>);">
                                                                <label class="form-check-label text-info fw-bold" for="flexSwitchCheckDefault<?php echo $selected_data["id"] ?>" id="switchlbl<?php echo $selected_data["id"] ?>">

                                                                    <?php

                                                                    if ($selected_data["status_id"] == 2) {
                                                                        echo "Make Your Product Active";
                                                                    } else {
                                                                        echo "Make Your Product Deactive";
                                                                    }

                                                                    ?>
                                                                </label>
                                                            </div>

                                                            <div class=" row">
                                                                <div class=" col-12">
                                                                    <div class=" row g-1">

                                                                        <div class=" col-12 col-lg-6 d-grid">
                                                                            <button class=" btn btn-success fw-bold" onclick="sendId(<?php echo $selected_data['id']; ?>);">Update</button>
                                                                        </div>
                                                                        <div class=" col-12 col-lg-6 d-grid">
                                                                            <button class=" btn btn-danger fw-bold">Delete</button>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- card -->

                                        <?php

                                        }

                                        ?>




                                    </div>
                                </div>

                                <!-- pagination -->

                                <div class=" offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">

                                    <div class="pagination">
                                        <a href="
                                        <?php

                                        if ($pageno <= 1) {
                                            echo "#";
                                        } else {
                                            echo "?page=" . ($pageno - 1);
                                        }

                                        ?>
                                        ">&laquo;</a>

                                        <?php

                                        for ($page = 1; $page <= $number_of_pages; $page++) {
                                            if ($page == $pageno) {
                                        ?>
                                                <a href="<?php echo "?page=" . ($page) ?>" class="active"><?php echo $page; ?></a>
                                            <?php
                                            } else {
                                            ?>
                                                <a href="<?php echo "?page=" . ($page) ?>"><?php echo $page; ?></a>
                                        <?php
                                            }
                                        }

                                        ?>

                                        <a href="
                                        <?php

                                        if ($pageno >= $number_of_pages) {
                                            echo "#";
                                        } else {
                                            echo "?page=" . ($pageno + 1);
                                        }

                                        ?>
                                        ">&raquo;</a>
                                    </div>


                                </div>

                                <!-- pagination -->


                            </div>
                        </div>

                        <!-- product -->


                    </div>
                </div>
                <!-- body -->
            </div>
        </div>


        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
        <script src="bootstrap.js"></script>
    </body>

    </html>

<?php

} else {
?>
    <script>
        alert("Please Sign In First.");
        window.location = "index.php";
    </script>

<?php
}

?>