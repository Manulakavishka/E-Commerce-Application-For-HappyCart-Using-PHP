<!DOCTYPE html>



<html>

<head>
    <title>HappyCart | Profile</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="resources/img/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body class="bg-primary">

    <div class="container-fluid">
        <div class="row ">

            <?php require "header.php" ?>

            <?php


            if (isset($_SESSION["u"])) {
                $email = $_SESSION["u"]["email"];

                $resultset = Database::search("SELECT * FROM `users` 
INNER JOIN `user_has_address` ON users.email = user_has_address.users_email 
INNER JOIN `city` ON user_has_address.city_id = city.id 
INNER JOIN `district` ON city.district_id = district.id 
INNER JOIN `province` ON district.province_id = province.id 
INNER JOIN `gender` ON users.gender_id = gender.id WHERE users.email = '" . $email . "'");

                $n = $resultset->num_rows;


                $d = $resultset->fetch_assoc();



            ?>

                <div class="col-12 bg-body rounded mt-4 mb-4">
                    <div class="row g-2">

                        <div class="col-md-3 border-end">
                            <div class=" d-flex flex-column align-items-center text-center p-3 py-5">

                                <?php
                                // echo error_log(print_r($d["path"], TRUE));

                                $pic = "";

                                $userpicrs = Database::search("SELECT * FROM `profile_image` WHERE `users_email`='" . $email . "'");
                                $userpicdata = $userpicrs->fetch_assoc();

                                isset($userpicdata["path"]) ? $pic = $userpicdata["path"] : $pic = "0";

                                if ($pic == "0") {

                                ?>
                                    <img id="viewimg" src="resources/profile images/user.svg" class=" rounded mt-5 " style="width: 150px;">
                                <?php

                                } else {
                                ?>

                                    <img id="viewimg" src="<?php echo $pic; ?>" class=" rounded mt-5 " style="width: 150px;">

                                <?php
                                }

                                ?>



                                <span class=" fw-bold"><?php echo $d["fname"]; ?> <?php echo $d["lname"]; ?> </span>
                                <span class=" text-black-50"><?php echo $d["email"]; ?></span>

                                <input type="file" accept="img/*" id="profileimg" class=" d-none" />
                                <label class="btn btn-primary mt-5 " for="profileimg" onclick="changeImage();">Update Profile Image</label>

                            </div>
                        </div>

                        <div class=" col-md-4 border-end">
                            <div class=" p-3 py-5">

                                <div class=" d-flex justify-content-between align-items-center mb-3">
                                    <h4 class=" fw-bold">Profile Settings</h4>
                                </div>

                                <div class=" row mt-3">

                                    <div class=" col-md-6">
                                        <label" class=" form-label">First Name</label>
                                            <input type="text" id="fn" class=" form-control" value="<?php echo $d["fname"]; ?>" placeholder="First Name">
                                    </div>

                                    <div class=" col-md-6">
                                        <label class=" form-label">Last Name</label>
                                        <input type="text" id="ln" class=" form-control" value="<?php echo $d["lname"]; ?>" placeholder="Last Name">
                                    </div>

                                    <div class=" col-md-12">
                                        <label class=" form-label">Mobile</label>
                                        <input type="text" id="mo" class=" form-control" value="<?php echo $d["mobile"]; ?>" placeholder="Mobile">
                                    </div>

                                    <div class=" col-md-12">
                                        <label class=" form-label">Password</label>
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control" aria-describedby="viewpassword" id="pwtxt" value="<?php echo $d["password"]; ?>" disabled>
                                            <button class="btn btn-outline-primary" type="button" id="viewpassword" onclick="viewpw();"><i class="bi bi-eye-fill"></i></button>
                                        </div>
                                    </div>

                                    <div class=" col-md-12">
                                        <label class=" form-label">Email</label>
                                        <input type="email" class=" form-control" value="<?php echo $d["email"]; ?>" readonly>
                                    </div>

                                    <div class=" col-md-12 mt-1">
                                        <label class=" form-label">Registered Date</label>
                                        <input type="text" class=" form-control" value="<?php echo $d["joined_date"]; ?>" readonly>
                                    </div>

                                    <?php

                                    if (!empty($d["line1"])) {
                                    ?>

                                        <div class=" col-md-12 mt-1">
                                            <label class=" form-label">Address Line 01</label>
                                            <input type="text" id="l1" class=" form-control" value="<?php echo $d["line1"]; ?>">
                                        </div>

                                    <?php
                                    } else {
                                    ?>

                                        <div class=" col-md-12 mt-1">
                                            <label class=" form-label">Address Line 01</label>
                                            <input type="text" id="l1" class=" form-control" placeholder="Address Line 1" />
                                        </div>

                                    <?php
                                    }


                                    if (!empty($d["line2"])) {
                                    ?>

                                        <div class=" col-md-12 mt-1">
                                            <label class=" form-label">Address Line 02</label>
                                            <input type="text" id="l2" class=" form-control" value="<?php echo $d["line2"]; ?>">
                                        </div>

                                    <?php
                                    } else {
                                    ?>

                                        <div class=" col-md-12 mt-1">
                                            <label class=" form-label">Address Line 02</label>
                                            <input type="text" id="l2" class=" form-control" placeholder="Address Line 2" />
                                        </div>

                                    <?php
                                    }


                                    $provincers = Database::search("SELECT * FROM `province`");
                                    $districtrs = Database::search("SELECT * FROM `district`");
                                    $cityrs = Database::search("SELECT * FROM `city`");
                                    ?>


                                    <div class=" col-md-6 mt-1">
                                        <label class=" form-label">Province</label>
                                        <select class=" form-select" id="pr">



                                            <option value="0">Select Province</option>

                                            <?php


                                            $pn = $provincers->num_rows;

                                            for ($x = 0; $x < $pn; $x++) {
                                                $pd = $provincers->fetch_assoc();

                                            ?>
                                                <option value="<?php echo $pd["id"]; ?>" <?php

                                                                                            if ($pd["id"] == $d["province_id"]) {
                                                                                            ?> selected <?php

                                                                                                    }

                                                                                                        ?>><?php echo $pd["name"]; ?></option>



                                            <?php
                                            }

                                            ?>

                                        </select>
                                    </div>

                                    <div class=" col-md-6 mt-1">
                                        <label class=" form-label">District</label>
                                        <select class=" form-select" id="dr">
                                            <option value="0">Select District</option>

                                            <?php

                                            $dn = $districtrs->num_rows;

                                            for ($x1 = 0; $x1 < $dn; $x1++) {
                                                $dd = $districtrs->fetch_assoc();

                                            ?>
                                                <option value="<?php echo $dd["id"]; ?>" <?php

                                                                                            if ($dd["id"] == $d["district_id"]) {
                                                                                            ?> selected <?php

                                                                                                    }

                                                                                                        ?>><?php echo $dd["name"]; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class=" col-md-6 mt-1">
                                        <label class=" form-label">City</label>
                                        <select class=" form-select" id="ci">
                                            <option value="0">Select City</option>

                                            <?php

                                            $cn = $cityrs->num_rows;

                                            for ($x2 = 0; $x2 < $cn; $x2++) {
                                                $cd = $cityrs->fetch_assoc();

                                            ?>
                                                <option value="<?php echo $cd["id"]; ?>" <?php

                                                                                            if ($cd["id"] == $d["city_id"]) {
                                                                                            ?> selected <?php

                                                                                                    }

                                                                                                        ?>><?php echo $cd["name"]; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class=" col-md-6 mt-1">
                                        <label class=" form-label">Postal Code</label>

                                        <?php

                                        if (!empty($d["postal_code"])) {
                                        ?>
                                            <input type="text" id="pc" class=" form-control" value="<?php echo $d["postal_code"]; ?>">
                                        <?php
                                        } else {
                                        ?>
                                            <input type="text" id="pc" class=" form-control" placeholder="Postal Code">
                                        <?php
                                        }

                                        ?>


                                    </div>



                                    <div class=" col-md-12 mt-1">
                                        <label class=" form-label">Gender</label>
                                        <input type="text" class=" form-control" value="<?php echo $d["gender_name"]; ?>" readonly />
                                    </div>




                                    <div class=" col-md-12 d-grid my-3">
                                        <button class="btn btn-primary" onclick="update_profile();">Update My Profile</button>
                                    </div>

                                </div>

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
</body>

</html>


<?php


            } else {
?>

    <script>
        window.location = "index.php";
    </script>

<?php
            }
?>