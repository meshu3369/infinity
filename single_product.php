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

if (isset($_GET['product_id'])) {
    $product_id = base64_decode($_GET['product_id']);
}

/*
 *
 * description:  code for comment submit
 *
 */
if (isset($_POST['comment_submit'])) {
    $username = $_POST['username'];

    $comment = $_POST['comment'];
    $userid = $_POST['user_id'];
    $product_id = $_POST['product_id'];
    $rating = $_POST['rating'];

    $query = "insert into comment_table (product_id,username,comment) values ('$product_id','$username','$comment')";
    mysqli_query($db->connect(), $query);
    $query = "update product_info set rating = rating + '$rating',rating_no = rating_no + 1 where product_id = '$product_id'";
    mysqli_query($db->connect(), $query);
}
?>

<?php include 'header.php'; ?>

<!--
    Author Name : Mehbuba Tabannur
    Email : borsha.uiu@gmail.com
    Date : 22-Apr-2016
    Time : 08:24pm
    
-->
<div class="container-fluid single_product_page main_container">
    <div class="container">
        <div class="row">
            <div class="col-sm-3 left_side_container">


                <div class="hot_sales">
                    <div class="title">
                        <h2>hot sales!<span>hot</span></h2>
                    </div>



                    <?php
                    $sql = "select * from product_info where unitSold > 0 order by unitSold Desc limit 4";

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

                    <div class="col-sm-12 single_product_item">


                        <div class="row first_row">

                            <?php
                            $sql = "SELECT * from product_info where product_id = '$product_id' ";

                            $result = mysqli_query($db->connect(), $sql);

                            if ($result->num_rows > 0) {


                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <div class="col-sm-4 thumbnail flower_image">
                                        <img src="./images/<?php echo $row['image']; ?>" alt="flower1" class="img-responsive">
                                    </div>

                                    <div class="col-sm-8">

                                        <h3 class="accident text-capitalize"><span style="color:grey">Name: </span><?php echo $row['product_name']; ?></h3>

                                        <div class="rattings">
                                            <p>Likes:<?php echo $row['liking']; ?> | Rating:<?php
                                                $n = (int) $row['rating'] / $row['rating_no'];
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
                                            </p>
                                        </div>

                                        <div class="rattings">
                                            <p><b>Description:</b>&nbsp;&nbsp;&nbsp;<?php echo $row['description']; ?></p>
                                        </div>

                                        <div class="price col-sm-12">
                                            <h3>Price: $<?php echo $row['unitPrice']; ?></h3>
                                            <p class="availability">Availability: <span><?php echo $row['quantity']; ?></span></p>
                                        </div>

                                        <?php
                                    }
                                }
                                ?>

                                <div class="wishlist row col-sm-12">
                                    <div class="col-sm-6 heart">
                                        <i class="fa fa-shopping-basket" aria-hidden="true"></i> 
                                        <a href="checkout.php?user_id=<?php echo base64_encode($userid);?>">Check out now</a>
                                    </div>
                                  
                                </div>


                            </div>
                        </div>

                        <div class="col-sm-12 our_product">


                            <div id="productTab" class="tab">
                                <ul class="nav navbar-nav">
                                    <li><a href="#product1"><i class="fa fa-align-justify"></i>Product Description</a></li>
                                    <li><a href="#product2"><i class="fa fa-download"></i>Add your review</a></li>
                                    <li><a href="#product3"><i class="fa fa-star"></i>virtual box</a></li>

                                </ul>





                                <div id="product1" class="row">
                                    <div class="product col-sm-12"> 
                                        <?php
                                        $sql = "SELECT * from comment_table where product_id = '$product_id' ";
                                        $result = mysqli_query($db->connect(), $sql);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                ?>
                                                <div class="single_comment">
                                                    <blockquote class="blockquote"><h4 class="text-capitalize text-warning"><?php echo $row['username']; ?></h4><p><?php echo $row['comment']; ?></p></blockquote>

                                                </div>
                                                <?php
                                            }
                                        } else {
                                            echo "<br><span class='text-danger error'>No comment</span>";
                                        }
                                        ?>

                                    </div>
                                </div>
                                <div id="product2" class="row">
                                    <div class="product col-sm-12"> 
                                     
                                        <form action="" method="post" class="form-validate form-horizontal">
                                            <div class="thumbnail comment_area col-sm-10">
                                                <h3>Write a comment for this product ! </h3>

                                                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                                <input type="hidden" name="user_id" value="<?php echo $userid; ?>">


                                                <div class="form-group">
                                                    <label for="username" class="control-label col-sm-2">Name</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" type="text" name="username" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="comment" class="control-label col-sm-offset-1">Write Your Comment</label>
                                                    <div class="row">
                                                        <div class="col-sm-offset-1 col-sm-10">
                                                            <textarea class="form-control" name="comment" style="width: 100%"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="comment" class="control-label col-sm-offset-1">Rating:</label>
                                                    <div class="row">
                                                        <div class="col-sm-offset-1 col-sm-6">
                                                            <select name="rating" class="form-control">
                                                                <option value="0">rate (1-5)</option>
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="form-group">
                                                    <div class="col-sm-offset-2 col-sm-10">
                                                        <button class="submit" type="submit" name="comment_submit">Post</button>

                                                    </div>
                                                </div>


                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div id="product3" class="row">
                                    <div class="product col-sm-12"> 

                                        <p>Coming soon...</p>
                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>    



                    <!--end of gallery area-->
                    <!--tab area-->



                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'footer.php' ?>