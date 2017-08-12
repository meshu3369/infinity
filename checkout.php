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
$totalsum = 0;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $totalPrice += $row['unitPrice'];
        $totalDiscount += $row['discount'];
    }
}
$totalsum = $totalPrice - $totalDiscount + 30;
/* * ** End of Block *** */


/*
 *
 * description: order form submmition
 *
 */
if (isset($_POST['order']) && $totalsum != 0) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $userid = $_POST['user_id'];
    $paddress = $_POST['paddress'];
    $peraddress = $_POST['peraddress'];
    $phone = $_POST['phone'];
    $totaldue = $_POST['totalPrice'];

    $date = new DateTime('now');
    $date = $date->format('Y-m-d H:i:s');

    $query = "insert into order_details (user_id,fname,lname,paddress,peraddress,phone,totalDue,order_time) values ('$userid','$fname','$lname','$paddress','$peraddress','$phone','$totaldue','$date') ";

    $rr = mysqli_query($db->connect(), $query);
    if ($rr) {
        $successMsg = "Your Shipment will arrive soon. Thank you for trading with us";
    }
}

?>

<?php include 'header.php'; ?>

<!--
    Author Name : Mehbuba Tabannur
    Email : borsha.uiu@gmail.com
    Date : 22-Apr-2016
    Time : 08:24pm
    
-->
<hr>
<div class="container-fluid cart_container">
    <div class="container">
        <div class="row first_row_portion">

            <div class="col-sm-4">

                <div class="col-sm-12 left_portion1">
                    <p class="left_portion_p"><a href="cart_product.php?user_id=<?php echo base64_encode($userid); ?>">Continue to basket</a></p>
                    <h5>Price Details</h5>
                    <div class="upper_portion">
                        <span>Total</span>
                        <span class="total1">$<?php echo $totalPrice; ?></span><br>
                        <span>Discount</span>
                        <span class="total2"><?php
                            if ($totalDiscount == 0)
                                echo "---";
                            else
                                echo "$".$totalDiscount;
                            ?></span><br>
                        <span>Delivery Charges</span>
                        <span class="total3">$30.00</span>
                    </div>
                    <div class="clearfix"></div>  
                    <div class="border"></div>
                    <h4 class="total_price">TOTAL</h4></li>  
                    <h6 class="last_price">$<?php echo $totalsum; ?></h6>
                </div>   


            </div>


            <div class="col-sm-8 right_portion">
                <?php if (isset($successMsg)) { ?>
                    <div class = "col-sm-offset-3 col-sm-9 errors">
                        <?php
                        echo $successMsg;
                        ?>
                    </div>
                <?php }
                ?>

                <div class="col-sm-12 order_form">
                    <div class="row">
                        <div class="form" >
                            <form class="form-validate form-horizontal" id="feedback_form" action="" method="POST" enctype="multipart/form-data">
                                <div class="form-group ">
                                    <label for="fname" class="control-label col-sm-offset-1 col-sm-2">First Name<span class="required">*</span></label>
                                    <div class="col-sm-4">
                                        <input class="form-control" name="fname" minlength="5" type="text" required />
                                    </div>
                                    <label for="lname" class="control-label col-sm-2">Last Name<span class="required">*</span></label>
                                    <div class="col-sm-3">
                                        <input class="form-control" name="lname" minlength="5" type="text" required />
                                    </div>
                                </div>
                                <div class="form-group ">

                                </div>
                                <?php if (isset($userid)) { ?>
                                    <input name="user_id" type="hidden" value="<?php echo $userid; ?>">
                                <?php } ?>
                                <div class="form-group ">
                                    <label for="lname" class="control-label col-sm-3">shipping address<span class="required">*</span></label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="paddress" minlength="5" type="text" required />
                                    </div>

                                </div>
                                <div class="form-group ">
                                    <label for="lname" class="control-label col-sm-3">Present address<span class="required">*</span></label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="peraddress" minlength="5" type="text" required />
                                    </div>

                                </div>
                                <div class="form-group ">
                                    <label for="lname" class="control-label col-sm-3">Phone No<span class="required">*</span></label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="phone" minlength="5" type="text" required />
                                    </div>

                                </div>
                                <div class="form-group ">
                                    <label for="lname" class="control-label col-sm-3">Total Due (Tk)</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="totalPrice" value="<?php echo $totalsum; ?>" minlength="5" type="text" readonly />
                                    </div>

                                </div>
                                <div class="form-group ">

                                    <div class="col-sm-offset-3 col-sm-6 cash_on_delivery">

                                        <p class="form-control"><input name="checkbox" minlength="5" type="checkbox" /> Cash on delivery</p>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-10">
                                        <button class="btn btn-primary" type="submit" name="order">order</button>
                                        <button class="btn btn-default" type="button">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>



                <br>


                <h2 class="text-center">Final Review</h2>
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
                                    <h5>Price: $<?php echo $row['unitPrice'] ?></h5>
                                </div>

                                <div class="col-sm-4 cross_portion">
                                    <a class="close" href="checkout.php?user_id=<?php echo base64_encode($userid); ?>&&cart_id=<?php echo base64_encode($row['cart_id']); ?>"><i class="fa fa-times fa-2x" aria-hidden="true" ></i></a>

                                </div>
                                <a class="view_product" href="checkout.php?user_id=<?php base64_encode($userid); ?>&&product_id=<?php echo base64_encode($row['cart_id']); ?>">view product</a> 
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

<?php include 'footer.php' ?>