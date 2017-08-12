<?php
/*
 * author : meshu
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
 * description:  deleting a cart item 
 *
 */
if (isset($_GET['cart_id'])) {
    $cart_id = mysqli_real_escape_string($db->connect(), base64_decode($_GET['cart_id']));

    $query = "delete from cart where cart_id = '$cart_id'";
    mysqli_query($db->connect(), $query);
}

/* * ** End of Block *** */
/*
 *
 * description: loading cart table
 *
 */
$search1 = "select * from product_info,cart where cart.user_id='$userid' and cart.product_id = product_info.product_id";
$result = mysqli_query($db->connect(), $search1);

$totalPrice = 0;
$totalDiscount = 0;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $totalPrice += $row['unitPrice'];
        $totalDiscount += $row['discount'];
    }
}
$totalsum = $totalPrice - $totalDiscount;
/* * ** End of Block *** */


?>

<?php include 'header.php'; ?>

<!--
    Author Name : Mehbuba Tabannur
    Email : borsha.uiu@gmail.com
    Date : 22-Apr-2016
    Time : 08:24pm
    
-->

<div class="container-fluid cart_container">
    <div class="container">
        <div class="row first_row_portion">

            <div class="col-sm-4">

                <div class="col-sm-12 left_portion1">
                    <p class="left_portion_p">Continue to basket</p>
                    <h5>Price Details</h5>
                    <div class="upper_portion">
                        <span>Total</span>
                        <span class="total1"><?php echo $totalPrice; ?> Tk</span><br>
                        <span>Discount</span>
                        <span class="total2"><?php
                            if ($totalDiscount == 0)
                                echo "---";
                            else
                                echo $totalDiscount . " Tk";
                            ?></span><br>
                        <span>Delivery Charges</span>
                        <span class="total3">30.00 Tk</span>
                    </div>
                    <div class="clearfix"></div>  
                    <div class="border"></div>
                    <h4 class="total_price">TOTAL</h4></li>  
                    <h6 class="last_price"><?php echo $totalsum; ?> Tk</h6>
                </div>   

                <div class="col-sm-12 left_portion2">
                    <p class="left_portion_p"><a href="checkout.php?user_id=<?php echo base64_encode($userid); ?>">Place Order</a></p>
                    <h5>Options</h5>
                    <span>COUPONS :</span>
                    <span class="apply">Apply Coupons</span><br>

                </div>
            </div>


            <div class="col-sm-8 right_portion">

                <h2 class="text-center">My Shopping Bag</h2>
                <!-- 1st row -->
                <?php
                $search = "select * from product_info,cart where cart.user_id='$userid' and cart.product_id = product_info.product_id";
                $result = mysqli_query($db->connect(), $search);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="col-sm-12 cart_item">
                            <div class="row">
                                <div class="col-sm-3 image_portion1">
                                    <img src="images/<?php echo $row['image']; ?>" class="img-responsive">
                                </div>

                                <div class="col-sm-4 text_portion">
                                    <h4><?php echo $row['product_name'] ?></h4>
                                    <p>Model no: <?php echo $row['product_id'] ?></p>
                                    <span class="size">discount:<?php echo $row['discount'] ?></span><span class="quantity">Qty:<?php echo $row['quantity'] ?></span>
                                    <h5>Price: Tk. <?php echo $row['unitPrice'] ?></h5>
                                </div>

                                <div class="col-sm-4 cross_portion">
                                    <a class="close" href="cart_product.php?user_id=<?php echo base64_encode($userid); ?>&&cart_id=<?php echo base64_encode($row['cart_id']); ?>"><i class="fa fa-times fa-2x" aria-hidden="true" ></i></a>

                                </div>
                                <a class="view_product" href="single_product.php?user_id=<?php echo base64_encode($userid); ?>&&product_id=<?php echo base64_encode($row['product_id']); ?>">view product</a> 
                            </div>
                        </div> 


                        <?php
                    }
                } else {
                    echo "<br><span class='col-sm-offset-3 text-danger error'>You have no product selected.Go <a href='./index.php?user_id=" . base64_encode($userid) . "'>Home</a></span>";
                }
                ?>


            </div>
        </div>
    </div>
</div>

<br>
<br>
<br>
<?php include 'footer.php' ?>