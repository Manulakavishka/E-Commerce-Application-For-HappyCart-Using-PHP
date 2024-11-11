<?php
require "connection.php";

$search_txt = $_POST["t"];
$search_select = $_POST["s"];

$query = "SELECT * FROM `product`";

if (!empty($search_txt) && $search_select == 0) {
    $query .= " WHERE `title` LIKE '%" . $search_txt . "%'";
} else if (empty($search_txt) && $search_select != 0) {
    $query .= " WHERE `category_id` = '" . $search_select . "'";
} else if (!empty($search_txt) && $search_select != 0) {
    $query .= " WHERE `title` LIKE '%" . $search_txt . "%' AND `category_id` = '" . $search_select . "'";
}

?>

<div class=" row">

    <div class=" offset-lg-1 col-12 col-lg-10  text-center">
        <div class=" row">

            <?php

            if ($_POST["page"] != 0) {
                $pageno = $_POST["page"];
            } else {
                $pageno = 1;
            }

            $product_rs = Database::search($query);
            $product_num = $product_rs->num_rows;

            $results_per_page = 6;
            $number_of_pages = ceil($product_num / $results_per_page);

            $view_results = ((int)$pageno - 1) * $results_per_page;
            $query .= " LIMIT " . $results_per_page . " OFFSET " . $view_results;
            $results_rs = Database::search($query);
            $result_num = $results_rs->num_rows;

            while ($product_data = $results_rs->fetch_assoc()) {

            ?>





                <div class="card mb-3 mt-3 col-12 col-lg-6">
                    <div class="row">
                        <div class="col-md-4 mt-4">

                            <?php

                            $product_img_rs = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $product_data["id"] . "'");
                            $product_img_data = $product_img_rs->fetch_assoc();

                            ?>

                            <img src="<?php echo $product_img_data["code"] ?>" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">

                                <h5 class="card-title fw-bold"><?php echo $product_data["title"]; ?></h5>
                                <span class="card-text text-primary fw-bold">Rs.<?php echo $product_data["price"]; ?>.00</span>
                                <br />

                                <?php

                                if ($product_data["qty"] != 0) {
                                ?><span class="card-text text-success fw-bold fs"><?php echo $product_data["qty"]; ?> Items Left</span>

                                    <div class="row">
                                        <div class="col-12">

                                            <div class="row g-1">
                                                <div class="col-12 col-lg-6 d-grid">
                                                    <a href="#" class="btn btn-success fs">Buy Now</a>
                                                </div>
                                                <div class="col-12 col-lg-6 d-grid">
                                                    <a href="#" class="btn btn-danger fs">Add Cart</a>
                                                </div>
                                            </div>

                                        </div>
                                    </div><?php

                                        } else {
                                            ?><span class="card-text text-success fw-bold fs">00 Items Left</span>

                                    <div class="row">
                                        <div class="col-12">

                                            <div class="row g-1">
                                                <div class="col-12 col-lg-6 d-grid">
                                                    <a href="#" class="btn btn-success fs disabled">Buy Now</a>
                                                </div>
                                                <div class="col-12 col-lg-6 d-grid">
                                                    <a href="#" class="btn btn-danger fs">Add Cart</a>
                                                </div>
                                            </div>

                                        </div>
                                    </div><?php
                                        }

                                            ?>



                            </div>
                        </div>
                    </div>
                </div>

            <?php
            }

            ?>

        </div>
    </div>

    <div class="offset-lg-4 col-12 col-lg-4 mb-3 text-center">
        <div class=" row">

            <div class="pagination">
                <a <?php
                    if ($pageno <= 1) {

                        echo "href=#";
                    } else {
                    ?> onclick="basicSearch('<?php echo ($pageno - 1); ?>');" <?php
                                                                            }
                                                                                ?>>&laquo;</a>

                <?php

                for ($page = 1; $page <= $number_of_pages; $page++) {
                    if ($page == $pageno) {

                ?>

                        <a onclick="basicSearch('<?php echo ($page); ?>');" class="active"><?php echo $page; ?></a>

                    <?php

                    } else {

                    ?>
                        <a onclick="basicSearch('<?php echo ($page); ?>');"><?php echo $page; ?></a>
                <?php

                    }
                }

                ?>



                <a <?php
                    if ($pageno >= $number_of_pages) {

                        echo "href=#";
                    } else {
                    ?> onclick="basicSearch('<?php echo ($pageno + 1); ?>');" <?php
                                                                            }
                                                                                ?>>&raquo;</a>
            </div>

        </div>
    </div>




</div>