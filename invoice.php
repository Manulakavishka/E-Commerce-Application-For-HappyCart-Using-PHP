<!DOCTYPE html>
<html>

<?php
// session_start();
// require "connection.php";
$order_id = $_GET["order_id"];
?>

<head>
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

    <title>Happy Cart | Invoice</title>
</head>

<body class="mt-2" style="background-color: #f7f7ff;">

    <div class=" container-fluid">
        <div class=" row">
            <?php require "header.php" ?>

            <div class=" col-12">
                <hr class=" hr-break-1">
            </div>

            <div class=" col-12 btn-toolbar justify-content-end">
                <button class="btn btn-dark me-2" onclick="printInvoice();"><i class="bi bi-printer-fill"></i> Print</button>
                <button class=" btn btn-danger me-2"><i class="bi bi-file-pdf-fill"></i> Export as PDF</button>
            </div>

            <div class=" col-12">
                <hr class=" hr-break-1">
            </div>

            <div class=" col-12" id="page">
                <div class=" row">

                    <div class=" col-6">
                        <div class=" ms-5 invoiceHeaderImg"></div>
                    </div>

                    <div class=" col-6">
                        <div class=" row">

                            <div class=" col-12 text-primary text-decoration-underline text-end">
                                <h2>Happy Cart</h2>
                            </div>

                            <div class=" col-12 fw-bold text-end">
                                <span>Amar Street,Colombo 10,Sri Lanka.</span><br>
                                <span>+94 112 787654</span><br>
                                <span>HappyCart@gmail.com</span>

                            </div>

                        </div>
                    </div>

                    <div class=" col-12">
                        <hr class=" border border-1 border-primary hr-break-1">
                    </div>

                    <div class=" col-12 mb-4">
                        <div class=" row">
                            <div class=" col-6">
                                <h5>INVOICE TO : 00<?php echo $order_id; ?> </h5>
                                <h2><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]; ?></h2>

                                <?php
                                $address_rs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `city` ON `user_has_address`.`city_id` = `city`.`id` WHERE `users_email` = '" . $_SESSION["u"]["email"] . "'");
                                $address_data = $address_rs->fetch_assoc();
                                ?>

                                <span><?php echo $address_data["line1"] . ", " . $address_data["line2"] . ", " . $address_data["name"] . "."; ?></span><br>
                                <span><?php echo $_SESSION["u"]["email"]; ?></span>
                            </div>

                            <?php
                            $order_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id` ='" . $order_id . "'");
                            $order_data = $order_rs->fetch_assoc();
                            ?>

                            <div class=" col-6 text-end mt-4">
                                <h1 class=" text-primary">INVOICE : <?php echo $order_data["id"]; ?></h1>
                                <span class=" fw-bold ">Date & Time of Invoice : </span>&nbsp;


                                <span class=" fw-bold"><?php echo $order_data["date"]; ?></span>
                            </div>

                        </div>
                    </div>

                    <div class=" col-12">
                        <table class=" table">
                            <thead>

                                <tr class=" border border-1 border-white">
                                    <th>#</th>
                                    <th>Order ID & Product</th>
                                    <th class=" text-end">Unit Price</th>
                                    <th class=" text-end">Quantity</th>
                                    <th class=" text-end">Total</th>

                                </tr>
                            </thead>

                            <tbody>
                                <tr style="height: 72px;">
                                    <td class=" bg-primary text-white fs-3"><?php echo $order_data["id"]; ?></td>
                                    <td>
                                        <span class=" fw-bold text-primary text-decoration-underline p-2"><?php echo $order_data["order_id"]; ?></span>
                                        <br>

                                        <?php
                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `id` ='" . $order_data["product_id"] . "'");
                                        $product_data = $product_rs->fetch_assoc();
                                        ?>
                                        <span class=" fw-bold fs-3 text-primary p-2"><?php echo $product_data["title"]; ?></span>
                                    </td>
                                    <td class=" fw-bold fs-6 text-end pt-3 bg-secondary text-white">Rs. <?php echo $product_data["price"]; ?> .00</td>
                                    <td class=" fw-bold fs-6 text-end pt-3"><?php echo $order_data["qty"]; ?></td>
                                    <td class=" fw-bold fs-6 text-end bg-primary text-white">Rs. <?php echo $order_data["total"]; ?> .00</td>
                                </tr>
                            </tbody>

                            <tfoot>

                                <tr>
                                    <td colspan="3" class=" border-0"></td>
                                    <td class=" fs-5 text-end">SUBTOTAL</td>
                                    <td class=" text-end">Rs. <?php echo $order_data["total"]; ?> .00</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class=" border-0"></td>
                                    <td class=" fs-5 text-end border-primary">DISCOUNT</td>
                                    <td class=" text-end border-primary">Rs.
                                        <?php
                                        $discount = 0;
                                        if ($order_data["total"] > "25000") {
                                            // $discount = ($order_data["total"] / 100) * 1;
                                            echo $discount;
                                        } else  if ($order_data["total"] > "50000") {
                                            // $discount = ($order_data["total"] / 100) * 2;
                                            echo $discount;
                                        } else  if ($order_data["total"] > "100000") {
                                            // $discount = ($order_data["total"] / 100) * 5;
                                            echo $discount;
                                        }
                                        ?>
                                        .00</td>
                                </tr>

                                <tr>
                                    <td colspan="3" class=" border-0"></td>
                                    <td class=" fs-5 text-end border-primary">Delivery Fee</td>
                                    <td class=" text-end border-primary">Rs.
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

                                        .00</td>
                                </tr>

                                <tr>
                                    <td colspan="3" class=" border-0"></td>
                                    <td class=" fs-5 text-end border-primary text-primary fw-bold">GRAND TOTAL</td>
                                    <td class=" fs-5 text-end border-primary text-primary fw-bold">Rs. <?php echo $order_data["total"] - $discount + $cost ?> .00</td>
                                </tr>

                            </tfoot>

                        </table>
                    </div>

                    <div class=" col-4 text-center" style="margin-top: -100px;">
                        <span class=" fs-1 fw-bold text-success">Thank You!</span>
                    </div>

                    <div class=" col-12 mt-3 mb-3 border-0 border-start border-5 border-primary rounded" style="background-color: #e7f2ff;">
                        <div class=" row">
                            <div class=" col-12 mt-3 mb-3">
                                <label class=" form-label fw-bold fs-5 ">NOTICE :</label>
                                <label class=" form-label fs-6">Purchased items can return befor 7 days of Delivery.</label>
                            </div>
                        </div>
                    </div>

                    <div class=" col-12">
                        <hr class=" border border-1 border-primary">
                    </div>

                    <div class=" col-12 text-center mb-3">
                        <label class=" form-label fs-5 text-black-50 fw-bold">
                            Invoice was created on a computer and is valid without the Signature and Seal.
                        </label>
                    </div>

                </div>
            </div>

            <?php require "footer.php" ?>

        </div>
    </div>


    <script src=" script.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>