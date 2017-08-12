<?php
/*
 * author : meshu
 * page name: gallery.php
 */
/*
 *
 * description: necessary block 
 *
 */
require_once __DIR__ . '/controllar/db_connect.php';

$db = new DB_CONNECT();

/* * ** End of Block  necessary block*** */


if (isset($_GET['user_id']))
    $userid = base64_decode($_GET['user_id']);

else {
    $userid = 0;
}

/*
 *
 * description: sending product id to the cart table
 *
 */
if (isset($_GET['id']) && $_GET['cart_ok'] = 1 && $userid != 0) {
    $product_id = base64_decode($_GET['id']);


    $cart_update_time = new DateTime('now');
    $cart_update_time = $cart_update_time->format('Y-m-d H:i:s');

    $search = "insert into cart (product_id,user_id,time) values ('$product_id','$userid','$cart_update_time')";
    $search2 = "select count(*) from cart where product_id = '$product_id'";
    $result = mysqli_query($db->connect(), $search2);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $count = $row['count(*)'];
        }
    }
    if ($count < 1 && $userid != 0) {
        $result = mysqli_query($db->connect(), $search);
    }
}
if (isset($_GET['like']) && $_GET['like'] == 1 && $userid != 0) {
    $like_product_id = base64_decode($_GET['id']);

    $query = "update product_info set liking = liking + 1 where product_id='$like_product_id'";
    mysqli_query($db->connect(), $query);
    $query = "select count(*) from liking_table where product_id = '$like_product_id'";
    $result = mysqli_query($db->connect(), $query);
    $update = "insert into liking_table (product_id,user_id) values ('$like_product_id','$userid')";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $count = $row['count(*)'];
        }
    }
    if ($count < 1) {
        $result = mysqli_query($db->connect(), $update);
    }



    mysqli_query($db->connect(), $query);
}

/*
 * * 
 * **
 *  End of Block 
 * **
 * * 
 */

if (isset($_GET['category_name'])) {
    $category_name = base64_decode($_GET['category_name']);
}
?>

<?php include 'header.php'; ?>

<!--
    Author Name : Mehbuba Tabannur
    Email : borsha.uiu@gmail.com
    Date : 22-Apr-2016
    Time : 08:24pm
    
-->
<div class="container-fluid gallery main_container">
    <div class="container">
        <div class="row">
            <div class="col-sm-3 left_side_container">
                <div class="filter_form">
                    <div class="title">
                        <h3 class="text-warning">Price Filter</h3>
                    </div>

                    <form class="form-validate form-horizontal" id="feedback_form" action="" method="POST">
                        <div class="form-group ">
                            <label for="from" class="control-label col-lg-2">From</label>
                            <div class="col-lg-10">
                                <input class="form-control"  name="from"  type="number" />
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="to" class="control-label col-lg-2">To</label>
                            <div class="col-lg-10">
                                <input class="form-control" type="number" name="to" />
                            </div>
                        </div>

                        <input type="hidden" name="user_id" value="<?php echo $userid; ?>">
                        <input type="hidden" name="category_name" value="<?php echo $category_name; ?>">

                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button class="btn btn-primary" type="submit" name="filter">Filter</button>

                            </div>
                        </div>
                    </form>

                </div> 



                <div class="hot_sales">
                    <div class="title">
                        <h2>hot sales!<span>hot</span></h2>
                    </div>



                    <?php
                    $sql = "select * from product_info where unitSold > 0 order by unitSold Desc limit 3";


                    $result = mysqli_query($db->connect(), $sql);

                    if ($result) {
                        if ($result->num_rows > 0) {
                            // output data of each row

                            while ($row = $result->fetch_assoc()) {
                                ?>



                                <div class="hot_sales_item">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <img src="images/<?php echo $row['image']; ?>" alt="" class="img-responsive"/>
                                        </div>
                                        <div class="col-sm-6">
                                            <p><?php echo $row['product_name']; ?></p>
                                            <div class="hot_sales_stars">
                                                <?php
                                                if ($row['rating_no'] > 0) {
                                                    $n = (int) $row['rating'] / $row['rating_no'];
                                                } else {
                                                    $n = 1;
                                                }
                                                for ($i = 0; $i < 5; $i++) {
                                                    if ($i <= $n) {
                                                        ?>
                                                        <i class = "fa fa-star"></i>
                                                    <?php } else { ?>
                                                        <i class = "fa fa-star-o"></i>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </div> 
                                            <br>
                                            <h4><i class="fa fa-thumbs-o-up"></i>&nbsp;<?php echo $row['liking'] ?></h4>
                                            <h3>$<?php
                                                $main_price = $row['unitPrice'];
                                                $discount = $row['discount'];
                                                $main_price -= $discount;
                                                echo $main_price;
                                                ?></h3>
                                            <?php if ($row['discount'] > 0) { ?>
                                                <del>sale:$<?php echo $row['unitPrice']; ?></del>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>



                                <?php
                            }
                        }
                    }
                    ?>

                </div>



            </div>   


            <!--main container element right side-->
            <div class="col-sm-9">
                <div class="row">

                    <!--main gallery area-->
                    <div class="col-sm-12 single_our_product">

                        <?php
                        if (isset($_REQUEST['filter'])) {
                            if (isset($_REQUEST['from']) && isset($_REQUEST['to'])) {

                                $from = $_REQUEST['from'];
                                $to = $_REQUEST['to'];
                                $userid = $_REQUEST['user_id'];
                                $category_name = $_REQUEST['category_name'];

                                $sql = "SELECT * from product_info where unitPrice >= '$from' and unitPrice <= '$to' and category_name='$category_name'";
                            }
                        } else if (isset($category_name)) {

                            $sql = "SELECT * from product_info where category_name='$category_name'";
                        }
                        $result = mysqli_query($db->connect(), $sql);

                        if ($result) {
                            if ($result->num_rows > 0) {
                                // output data of each row

                                while ($row = $result->fetch_assoc()) {
                                    ?>

                                    <div class="item thumbnail new_product">
                                        <img src="images/<?php echo $row['image']; ?>" alt="" class="img-responsive"/>
                                        <p><?php echo $row['product_name']; ?></p>
                                        <div class="stars">
                                            <?php
                                            $n = $row['rating'];
                                            for ($i = 0; $i < 5; $i++) {
                                                if ($i <= $n) {
                                                    ?>
                                                    <i class = "fa fa-star"></i>
                                                <?php } else { ?>
                                                    <i class = "fa fa-star-o"></i>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div> 
                                        <h4><i class="fa fa-thumbs-up"></i>&nbsp;<?php echo $row['liking'] ?></h4>
                                        <h3>$<?php echo $row['unitPrice']; ?></h3>
                                        <div class="linktofancy">
                                            <a  href="gallery.php?id=<?php echo base64_encode($row['product_id']); ?>&&user_id=<?php echo base64_encode($userid); ?>&&category_name=<?php echo base64_encode($category_name); ?>&&cart_ok=1" class="cart_hover"><span>ADD TO CART</span></a>                                                      
                                            <br><a  href="gallery.php?id=<?php echo base64_encode($row['product_id']); ?>&&user_id=<?php echo base64_encode($userid); ?>&&category_name=<?php echo base64_encode($category_name); ?>&&like=1" class="like_hover"><i class="fa fa-thumbs-up"></i>Like</a>                            
                                        </div>
                                    </div>


                                    <?php
                                }
                            } else {
                                echo "<br><span class='col-sm-offset-3 text-danger error'>Sorry this type of product is now unavailable.Go <a href='./index.php?user_id=" . base64_encode($userid) . "'>Home</a></span>";
                            }
                        } else {
                            echo "<br><span class='col-sm-offset-3 text-danger error'>Sorry this type of product is now unavailable.Go <a href='./index.php?user_id=" . base64_encode($userid) . "'>Home</a></span>";
                        }
                        ?>

                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
<br>
<?php include 'footer.php' ?>