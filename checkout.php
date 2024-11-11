<?php

session_start();
require "connection.php";
if (isset($_GET)) {

    $pid = $_GET["pid"];
    $qty = $_GET["qty"];
    if (isset($_SESSION["u"])) {
        $email = $_SESSION["u"]["email"];

        $resultset = Database::search("SELECT CONCAT(`line1`,' ',`line2`, ' ', `city`.`name`,' ', `district`.`name`, ' ', `province`.`name`) AS `add` FROM `users` 
INNER JOIN `user_has_address` ON users.email = user_has_address.users_email 
INNER JOIN `city` ON user_has_address.city_id = city.id 
INNER JOIN `district` ON city.district_id = district.id 
INNER JOIN `province` ON district.province_id = province.id 
 WHERE users.email = '" . $email . "'");

        $n = $resultset->num_rows;


        $d = $resultset->fetch_assoc();
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Payment Integartion (Stripe)</title>
            <link rel="stylesheet" href="./css/_style.css" />
            <link rel="icon" href="resources/img/logo.svg" />

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        </head>

        <body style="background-color: #00FF00; background-image: linear-gradient(90deg,#00FF00 0%,#32CD32 100% );">
            <button type="button" onclick="goback()" class="back">Go Back</button>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-container">
                        <form autocomplete="off" action="checkout-charge.php" method="POST">
                            <div>
                                <input type="text" name="c_name" value="<?php echo $_SESSION["u"]["fname"]; ?> <?php echo $_SESSION["u"]["lname"]; ?> " disabled required />
                                <label>Customer Name</label>
                            </div>
                            <div>
                                <input type="text" name="address" value="<?php echo $d["add"]  ?>" disabled required />
                                <label>Address</label>
                            </div>
                            <div>
                                <input type="number" id="ph" name="phone" pattern="\d{10}" maxlength="10" value="<?php echo $_SESSION["u"]["mobile"] ?>" disabled required />
                                <label>Contact number</label>
                            </div>
                            <div>
                                <input type="text" name="product_name" value="<?php echo $_GET["item_name"] ?>" disabled required />
                                <label>Product name</label>
                            </div>
                            <div>
                                <input type="text" name="price" value="<?php echo $_GET["price"] ?>" disabled required />
                                <label>Price</label>
                            </div>

                            <input type="hidden" name="amount" value="<?php echo $_GET["price"] ?>">
                            <input type="hidden" name="product_name" value="<?php echo $_GET["item_name"] ?>">
                            <input type="hidden" name="pid" value="<?php echo $pid ?>">
                            <input type="hidden" name="qty" value="<?php echo $qty ?>">

                            <script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="pk_test_51L28vMG5BcKy7lb7pHwKLvot8ZbQakL48o1kOIa4uTkgyNQbRIPL1bUtF3BrIEl6UkuuYydinUiVnv2EHWyUduaR00pSoBknQ4" data-amount=<?php echo str_replace(",", "", $_GET["price"]) * 100 ?> data-name="<?php echo $_GET["item_name"] ?>" data-description="<?php echo $_GET["item_name"] ?>" data-image="<?php echo $_GET["image"] ?>" data-currency="lkr" data-locale="auto">
                            </script>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="checkout-container">
                        <h4>Product Name&nbsp;:&nbsp;<?php echo $_GET["item_name"] ?></h4>
                        <img src="<?php echo $_GET["image"] ?>" />
                        <span>Price &nbsp;:&nbsp;<?php echo $_GET["price"] ?></span>
                    </div>
                </div>
            </div>

    <?php
    }
}
    ?>
    <script>
        function goback() {
            window.history.go(-1);
        }

        $('#ph').on('keypress', function() {
            var text = $(this).val().length;
            if (text > 9) {
                return false;
            } else {
                $('#ph').text($(this).val());
            }

        });
    </script>
        </body>

        </html>