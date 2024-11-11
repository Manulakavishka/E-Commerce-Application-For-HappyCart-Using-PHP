<?php
session_start();
require "connection.php";

if (isset($_SESSION["a"])) {

?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Happy Cart | Admin Panel</title>

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

                <div class=" col-12 col-lg-2">
                    <div class=" row">

                        <div class=" align-items-start bg-dark col-12">
                            <div class=" row g-1 text-center">

                                <div class=" col-12 mt-5">
                                    <h4 class=" text-white"><?php echo "Manula Kavishka" ?></h4>
                                    <hr class=" border border-1 border-white">
                                </div>

                                <div class=" nav flex-column nav-pills me-3 mt-3">
                                    <nav class=" nav flex-column">
                                        <a class=" nav-link fs-5 active" href="">Dashboard</a>
                                        <a class=" nav-link fs-5" href="manageusers.php">Manage Users</a>
                                        <a class=" nav-link fs-5" href="manageProduct.php">Manage Product</a>
                                    </nav>
                                </div>

                                <div class=" col-12 mt-3 ">
                                    <hr class=" border border-1 border-white" />
                                    <h4 class=" text-white">Selling History</h4>
                                    <hr class=" border border-1 border-white" />

                                </div>

                                <div class=" col-12 mt-3 d-grid">
                                    <h5 class=" text-white fw-bold">From Date</h5>
                                    <input type="date" class=" form-control">
                                    <h5 class=" text-white fw-bold">To Date</h5>
                                    <input type="date" class=" form-control">
                                    <a class=" btn btn-primary fw-bold mt-2" href="#">View Sellings</a>
                                    <hr class=" border border-1 border-white" />
                                    <hr class=" border border-1 border-white" />

                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <div class=" col-12 col-lg-10">
                    <div class=" row">

                        <div class=" col-12 text-white fw-bold mb-3 mt-2">
                            <h2 class=" fw-bold">Dashboard</h2>
                        </div>
                        <div class=" col-12">
                            <hr>
                        </div>

                        <div class=" col-12">
                            <div class=" row g-1">

                                <div class=" col-6 col-lg-4 px-1">
                                    <div class=" row">

                                        <div class=" col-12 bg-primary text-white text-center rounded" style=" height: 100px;">
                                            <br>
                                            <span class="fs-4 fw-bold">Daily Ernings</span>
                                            <br>

                                            <?php

                                            $today = date("Y-m-d");
                                            $this_month = date("m");
                                            $this_year = date("Y");

                                            $a = "0";
                                            $b = "0";
                                            $c = "0";
                                            $d = "0";
                                            $e = "0";

                                            $invoice_rs = Database::search("SELECT * FROM `invoice`");
                                            $invoice_num = $invoice_rs->num_rows;

                                            for ($x = 0; $x < $invoice_num; $x++) {
                                                $invoice_data = $invoice_rs->fetch_assoc();

                                                $e = $e + $invoice_data["qty"];
                                                $f = $invoice_data["date"];
                                                $split_date = explode(" ", $f);
                                                $pdate = $split_date[0];

                                                if ($pdate == $today) {
                                                    $a = $a + $invoice_data["total"];
                                                    $c = $c + $invoice_data["qty"];
                                                }

                                                $split_result = explode("-", $pdate);
                                                $pyear = $split_result["0"];
                                                $pmonth = $split_result["1"];

                                                if ($pyear == $this_year) {
                                                    if ($pmonth == $this_month) {
                                                        $b = $b + $invoice_data["total"];
                                                        $d = $d + $invoice_data["qty"];
                                                    }
                                                }
                                            }

                                            ?>

                                            <span class="fs-5">Rs. <?php echo $a ?>.00</span>
                                        </div>

                                    </div>
                                </div>

                                <div class=" col-6 col-lg-4 px-1">
                                    <div class=" row g-1">
                                        <div class=" col-12 bg-white text-dark text-center rounded" style=" height: 100px;">
                                            <br>
                                            <span class="fs-4 fw-bold">Monthly Ernings</span>
                                            <br>
                                            <span class="fs-5">Rs. <?php echo $b ?>.00</span>
                                        </div>
                                    </div>
                                </div>

                                <div class=" col-6 col-lg-4 px-1">
                                    <div class=" row g-1">
                                        <div class=" col-12 bg-dark text-white text-center rounded" style=" height: 100px;">
                                            <br>
                                            <span class="fs-4 fw-bold">Today Sellings</span>
                                            <br>
                                            <span class="fs-5"> <?php echo $c ?> Item</span>
                                        </div>
                                    </div>
                                </div>

                                <div class=" col-6 col-lg-4 px-1">
                                    <div class=" row g-1">
                                        <div class=" col-12 bg-secondary text-white text-center rounded" style=" height: 100px;">
                                            <br>
                                            <span class="fs-4 fw-bold">Monthly Sellings</span>
                                            <br>
                                            <span class="fs-5"> <?php echo $d ?> Item</span>
                                        </div>
                                    </div>
                                </div>

                                <div class=" col-6 col-lg-4 px-1">
                                    <div class=" row g-1">
                                        <div class=" col-12 bg-success text-white text-center rounded" style=" height: 100px;">
                                            <br>
                                            <span class="fs-4 fw-bold">Total Sellings</span>
                                            <br>
                                            <span class="fs-5"> <?php echo $e ?> Item</span>
                                        </div>
                                    </div>
                                </div>

                                <div class=" col-6 col-lg-4 px-1">
                                    <div class=" row g-1">
                                        <div class=" col-12 bg-danger text-white text-center rounded" style=" height: 100px;">
                                            <br>
                                            <span class="fs-4 fw-bold">Total Engagement</span>
                                            <br>
                                            <?php
                                            $user_rs = Database::search("SELECT * FROM `users`");
                                            $user_num = $user_rs->num_rows;
                                            ?>
                                            <span class="fs-5"> <?php echo $user_num ?> Members</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class=" col-12">
                            <hr>
                        </div>

                        <div class=" col-12 bg-dark">
                            <div class=" row">

                                <div class=" col-12 col-lg-2 text-center mt-3 mb-3">
                                    <label class=" form-label fs-4 fw-bold text-white">Total Active Time</label>
                                </div>

                                <?php

                                $start_date = new DateTime("2022-07-14 00:00:00");

                                $tdate = new DateTime();
                                $tz = new DateTimeZone("Asia/Colombo");
                                $tdate->setTimezone($tz);

                                $end_date = new DateTime($tdate->format("Y-m-d H:i:s"));

                                $difference = $end_date->diff($start_date);

                                ?>

                                <div class=" col-12 col-lg-10 text-end mt-3 mb-3">
                                    <label class=" form-label fs-4 fw-bold text-white">
                                        <?php
                                        echo $difference->format('%Y') . " Years " .  $difference->format('%m') . " Months " .
                                            $difference->format('%d') . " Days " . $difference->format('%H') . " Hours " .
                                            $difference->format('%i') . " Minutes " . $difference->format('%s') . " Seconds ";
                                        ?>
                                    </label>
                                </div>

                            </div>
                        </div>

                        <div class=" offset-1 col-10 col-lg-4 mt-3 mb-3 rounded bg-light">
                            <div class=" row g-1">
                                <div class=" col-12 text-center">
                                    <label class=" form-label fs-4 fw-bold">Mostly Sold Item</label>
                                </div>

                                <?php

                                $today = date("Y-m-d");
                                $freq_rs = Database::search("SELECT `product_id`, COUNT(`product_id`) AS `value_occurrence` 
                                    FROM `invoice` WHERE `date` LIKE '%" . $today . "%' GROUP BY `product_id` 
                                    ORDER BY `value_occurrence` DESC LIMIT 1");

                                $freq_num = $freq_rs->num_rows;
                                $pdeatails = null;
                                if ($freq_num > 0) {
                                    $freq_data = $freq_rs->fetch_assoc();

                                    $proimg = Database::search("SELECT * FROM `images` WHERE `product_id`= '" . $freq_data["product_id"] . "'");
                                    $code = $proimg->fetch_assoc();

                                    $prductDeatails = Database::search("SELECT * FROM `product` WHERE id = '" . $freq_data["product_id"] . "'");
                                    $pdeatails = $prductDeatails->fetch_assoc();

                                    $qtyrs = Database::search("SELECT SUM(`qty`) AS total FROM invoice WHERE product_id = '" . $freq_data["product_id"] . "' AND `date` LIKE '%" . $today . "%'");
                                    $qtytotal = $qtyrs->fetch_assoc();

                                ?>

                                    <div class=" col-12 text-center ">
                                        <img src="<?php echo $code["code"]; ?>" class=" img-fluid rounded-top" style=" height: 250px;">
                                        <hr>
                                    </div>

                                    <div class=" col-12 text-center">
                                        <span class=" fs-6"><?php echo $pdeatails["title"] ?></span>
                                        <br>
                                        <span class=" fs-6"><?php echo $qtytotal["total"] ?> Items</span>
                                        <br>
                                        <span class=" fs-6">Rs. <?php echo $pdeatails["price"] ?>.00</span>
                                        <br>
                                    </div>



                                    <div class=" col-12 mb-2">
                                        <div class="fist_place"></div>
                                    </div>

                            </div>
                        </div>

                        <div class=" offset-1 col-10 col-lg-4 mt-3 mb-3 rounded bg-light">
                            <div class=" row g-1">

                                <div class=" col-12 text-center">
                                    <label class=" form-label fs-4 fw-bold">Most Famouse Seller</label>
                                </div>

                                <?php

                                    $profileimg = Database::search("SELECT * FROM profile_image WHERE users_email = '" . $pdeatails["users_email"] . "'");
                                    $pcode = $profileimg->fetch_assoc();

                                    $userDeatails = Database::search("SELECT * FROM users WHERE email = '" . $pdeatails["users_email"] . "'");
                                    $udeatails = $userDeatails->fetch_assoc();

                                ?>

                                <div class=" col-12 text-center">
                                    <span class=" fs-5 fw-bold">
                                        <?php echo $udeatails["fname"] . " " . $udeatails["lname"] ?>
                                    </span>
                                    <br>
                                    <span class=" fs-6"><?php echo $pdeatails["users_email"] ?></span>
                                    <br>
                                    <span class=" fs-6"><?php echo $udeatails["mobile"] ?></span>
                                    <br>
                                </div>

                                <div class=" col-12 mb-2">
                                    <div class="fist_place"></div>
                                </div>

                            </div>
                        </div>
                    <?php

                                }

                    ?>


                    </div>
                </div>

            </div>
        </div>

        <script src="script.js"></script>
        <script src="bootstrap.js"></script>
    </body>

    </html>
<?php

} else {

?>


    <script>
        alert("Please Sign First");
        window.location = "adminlogin.php";
    </script>
<?php
}
?>