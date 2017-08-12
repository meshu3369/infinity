<?php

/*
 * author : meshu
 * hi this is from my desk buddy.. have fun now... :)
 */
require_once __DIR__ . '/controllar/db_connect.php';

$db = new DB_CONNECT();



if (isset($_GET['user_id']))
    $userid = base64_decode($_GET['user_id']);

else {
    $userid = 0;
}
/*
 *
 * description: checking the login session of user.
 *
 */
$last_time = new DateTime('now');
$last_time = $last_time->format('Y-m-d H:i:s');
$login_session = "update user_info set last_visit = '$last_time' where user_id = '$userid'";
mysqli_query($db->connect(), $login_session);

/* * ** End of Block login session** */

/*
 *
 * description: tracking page hits
 *
 */
$page_name = "index";
$query = "update tracker set hits = hits + 1 where page_name ='$page_name'";
mysqli_query($db->connect(), $query);

/*
 *
 * description: sending product id to the cart table
 *
 */
if (isset($_GET['id']) && $_GET['cart_ok'] = 1) {
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
        mysqli_query($db->connect(), $search);
    }
}
if (isset($_GET['like']) && $_GET['like'] == 1) {
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
/*
 *
 * description: how many order panding for a user .
 * 
 */
if ($userid != 0) {
    $search = "select count(*) from cart where user_id = '$userid'";
    $result = mysqli_query($db->connect(), $search);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $order = $row['count(*)'];
        }
    } else {
        $order = 0;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=0">

        <title>DBMS PROJECT (Infinity</title>

        <link rel="shortcut icon" href="images/logo.png">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700,900,400italic,700italic,900italic,300italic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css">

        <!--<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">-->


        <link href="css/flexslider.css" rel="stylesheet" type="text/css"/>
        <link href="css/owl.carousel.css" rel="stylesheet" type="text/css"/>
        <link href="css/jquery.fancybox.css" rel="stylesheet" type="text/css"/>

        <link rel="stylesheet" href="css/font-awesome.css">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>   
        <div class="container-fluid top_header">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 left-side-header"><!-- left side of header -->
                        <div class="row">
                            <div class="col-sm-5 left-header-currency">
                                <button class="btn btn-link dropdown" id="dropdown1">
                                    <i class="fa fa-cog"></i>
                                    Currency: USD
                                    <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="mydropdownMenu btn" >
                                    <li><a href="#">GRU</a></li>
                                    <li><a href="#">EUR</a></li>
                                    <li><a href="#">TAKA</a></li>                       
                                </ul>              
                            </div>
                            <div class="col-sm-6 left-header-language">   
                                <!--                                <div class="btn-group">
                                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        Action <span class="caret"></span>
                                                                    </button>
                                                                    <ul class="dropdown-menu">
                                                                        <li><a href="#">Action</a></li>
                                                                        <li><a href="#">Another action</a></li>
                                                                        <li><a href="#">Something else here</a></li>
                                                                        <li role="separator" class="divider"></li>
                                                                        <li><a href="#">Separated link</a></li>
                                                                    </ul>
                                                                </div>-->


                                <button class="btn btn-link dropdown" id="dropdown2">
                                    <i class="fa fa-globe"></i>
                                    Language: ENGLISH
                                    <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="mydropdownMenu btn" >
                                    <li><a href="#">Bangla</a></li>
                                    <li><a href="#">Russian</a></li>
                                    <li><a href="#">Hindi</a></li>

                                </ul>

                            </div>
                        </div>

                    </div><!-- end of left side header -->

                    <div class="col-sm-8"><!-- right side of header -->
                        <ul class="nav navbar-nav" id="top_menu">
                            <?php if (isset($_GET['user_id']) && $userid != 0) { ?>
                                <li><a href="./assets/admin/user_panel.php?user_id=<?php echo base64_encode($userid); ?>">My Account</a></li>    
                                <li class="slash">|</li>  


                                <li><a href="./cart_product.php?user_id=<?php echo base64_encode($userid); ?>">My Wishlist</a></li>  
                                <li class="slash">|</li>  
                                <li><a href="checkout.php?user_id=<?php echo base64_encode($userid); ?>">checkout</a></li>   
                            <?php } else { ?>

                                <li><a href="./assets/admin/login.php">login</a></li> 
                                <li class="slash">|</li>  
                                <li><a href="./assets/admin/register.php">register</a></li> 
                                <li class="slash">|</li> 
                                <li><a href="help.php?hellow=heybaby">help</a></li>

                            <?php } ?>
                        </ul>

                    </div><!-- end of right side of header  -->

                </div>
            </div>
        </div><!-- end of top header -->

        <!-- header -->

        <div class="container-fluid header"><!-- header part start -->
            <div class="container">
                <div class="row">
                    <div class="col-sm-3 logo"><!-- left part -->
                        <a href="index.php"><img src="images/logotm.jpg" alt="logo" class="img-responsive"/></a>
                    </div>

                    <div class="col-sm-7 middle"><!-- middle part of header -->

                        <div class="row">
                            <i class="fa fa-phone"></i>
                            <p>(+8800) 196 0490 830</p>
                            <p class="divider_h">|</p>
                            <i class="fa fa-envelope"></i> 
                            <p>admin.infinity@gmail.com</p>

                        </div>

                        <div class="row"><!-- advance search -->
                            <!-- select option -->
                            <div class="col-sm-12" id="advance_search">
                                <form class="form-inline" >   
                                    <div class="form-group select col-sm-2">
                                        <select id="category" class="category">
                                            <option value="initial">Category</option>
                                            <option value="cloth">Cloth</option>
                                            <option value="cloth">Cloth</option>
                                            <option value="cloth">Cloth</option>
                                        </select>
                                        <i class="fa fa-caret-down carion"></i>
                                    </div>
                                    <div class="form-group input_area col-sm-10">
                                        <input type="text"  id="advance_search_input" class="col-sm-9">   
                                        <button class="btn btn-link submit col-sm-3">Search</button>   
                                    </div>

                                </form>
                            </div>
                        </div>

                    </div> <!--end of middle-->

                    <div class="col-sm-2 shopping_cart">
                        <div class="shopping_cart_button">
                            <i class="fa fa-shopping-basket"></i>
                            <p>Shopping Cart:<?php if (isset($order)) echo $order; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!--navigaiton menu area-->

        <div class="container-fluid navigation">
            <div class="container">
                <div class="row ">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#" >home</a></li>
                        <li><a href="#">all stores</a></li>
                        <li><a href="#">new arrivals</a></li>
                        <li><a href="#">best offers</a></li>
                        <li><a href="#">hot sales</a></li>
                        <li><a href="#">fashion trend</a></li>
                        <li><a href="#">pages</a></li>
                        <li><a href="#">about us</a></li>
                        <li><a href="#">contact us</a></li>
                        <li><a href="#">clients</a></li>
                    </ul>
                </div>
            </div>
        </div>




        <div class="container-fluid slider_area">

            <div class="row">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="4000">

                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                    </ol>


                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <img src="images/slider1-bg.jpg" alt=""/>
                            <div class="carousel-caption">
                                <img src="images/slider1-for.png" alt="" class="col-sm-4 wow bounceInLeft" data-wow-duration="2s" data-wow-offset="10" data-wow-iteration="1" />
                                <div class="another_caption">
                                    <h2 class="first_cap wow bounceInDown" >Birthday Gift</h2>
                                    <h2 class="second_cap wow bounceInDown">save up to</h2>
                                    <h1 class="third_cap wow bounceInDown" >50% off</h1>
                                    <button class="btn btn-link btn-danger wow bounceInRight" >shop now</button>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <img src="images/slider2-bg.jpg" alt=""/>
                            <div class="carousel-caption">
                                <img src="images/slider2-for.png" alt="" class="col-sm-4 wow bounceInLeft" data-wow-duration="2s" data-wow-offset="10" data-wow-iteration="1" />
                                <div class="another_caption">
                                    <h2 class="first_cap wow bounceInDown" >Electronics</h2>
                                    <h2 class="second_cap wow bounceInDown">save up to</h2>
                                    <h1 class="third_cap wow bounceInDown" >30% off</h1>
                                    <button class="btn btn-link btn-danger wow bounceInRight" >shop now</button>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <img src="images/slider3-bg.jpg" alt=""/>
                            <div class="carousel-caption">
                                <img src="images/slider3-for.png" alt="" class="col-sm-4 wow bounceInLeft" data-wow-duration="2s" data-wow-offset="10" data-wow-iteration="1" />
                                <div class="another_caption">
                                    <h2 class="first_cap wow bounceInDown" >Spicy food</h2>
                                    <h2 class="second_cap wow bounceInDown">save up to</h2>
                                    <h1 class="third_cap wow bounceInDown" >50% off</h1>
                                    <button class="btn btn-link btn-danger wow bounceInRight" >Order now</button>
                                </div>
                            </div>
                        </div>




                    </div>


                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>



        <!-- Start Services -->

        <div class="container-fluid service_wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 service1 wow tada" data-wow-duration="2s" data-wow-delay="2s" data-wow-offset="10"  data-wow-iteration="1">
                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                            <i class="fa fa-truck fa-3x truck"></i>
                        </div>
                        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 shipping">
                            <h3>FREE SHIPPING</h3>
                            <p>We’re so sure you’ll love the money saving benefits, we’re giving you an extra $10 Cash Back on your first purchase using infinity.com </p>
                        </div>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 service2 wow tada" data-wow-duration="2s" data-wow-delay="2s" data-wow-offset="10"  data-wow-iteration="1">
                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                            <i class="fa fa-refresh fa-3x truck"></i>
                        </div>
                        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 collection">
                            <h3>30 DAYS MONEY BACK</h3>
                            <p> If you are not satisfied with an item that you have purchased, you may return the item within 30 days from the order date for a full refund of the purchase price.</p>
                        </div>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 service3 wow tada" data-wow-duration="2s" data-wow-delay="2s" data-wow-offset="10"  data-wow-iteration="1">
                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                            <i class="fa fa-money fa-3x truck"></i>
                        </div>
                        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 guarantee">
                            <h3>CASH ON DELIVERY</h3>
                            <p>You can pay through cash on delivery for all product. Currently Cash on Delivery is available only in certain locations in India.</p>
                        </div>
                    </div>   
                </div>  
            </div>
        </div>


        <!--main container-->

        <div class="container-fluid main_container">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3 left_side_container">
                        <div class="container_category_menu">
                            <ul class="nav navbar-collapse">
                                <li class="heading">Category</li>       
                                <li><a href="gallery.php?category_name=<?php echo base64_encode("acc"); ?>&&user_id=<?php echo base64_encode($userid); ?>"><i class="fa fa-home"></i>Equipments <i class="fa fa-chevron-right"></i></a></li>       
                                <li><a href="gallery.php?category_name=<?php echo base64_encode("acc"); ?>&&user_id=<?php echo base64_encode($userid); ?>"><i class="fa fa-delicious"></i>jwellary  <i class="fa fa-chevron-right"></i></a></li>       
                                <li><a href="gallery.php?category_name=<?php echo base64_encode("acc"); ?>&&user_id=<?php echo base64_encode($userid); ?>"><i class="fa fa-ruble"></i>watches  <i class="fa fa-chevron-right"></i></a></li>       
                                <li><a href="gallery.php?category_name=<?php echo base64_encode("mobile"); ?>&&user_id=<?php echo base64_encode($userid); ?>"><i class="fa fa-mobile"></i>mobiles  <i class="fa fa-chevron-right"></i></a></li>       
                                <li><a href="gallery.php?category_name=<?php echo base64_encode("laptop"); ?>&&user_id=<?php echo base64_encode($userid); ?>"><i class="fa fa-laptop"></i>laptops</a></li>       
                                <li><a href="gallery.php?category_name=<?php echo base64_encode("acc"); ?>&&user_id=<?php echo base64_encode($userid); ?>"><i class="fa fa-home"></i>books</a></li>       
                                <li><a href="gallery.php?category_name=<?php echo base64_encode("acc"); ?>&&user_id=<?php echo base64_encode($userid); ?>"><i class="fa fa-medkit"></i>medical</a></li>       
                            </ul>
                        </div>

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


                        <!--newsletter-->

                        <div class="newsletter">
                            <div class="title">
                                <h2>Newsletter</h2>
                            </div>

                            <br>

                            <p>sign up for our newsletter</p>
                            <form action="" method="post">
                                <input type="text" name="email" class="form-control">
                                <button type="submit">subscribe</button>
                            </form>
                            <div class="table">
                                <div class="rt"><a href="#"><i class="fa fa-facebook"></i></a></div>
                                <div class="rt"><a href="#"><i class="fa fa-twitter"></i></a></div>
                                <div class="rt"><a href="#"><i class="fa fa-instagram"></i></a></div>
                                <div class="rt"><a href="#"><i class="fa fa-whatsapp"></i></a></div>    
                                <div class="rt"><a href="#"><i class="fa fa-rss"></i></a></div>    
                            </div>

                        </div>

                    </div>   


                    <!--main container element right side-->
                    <div class="col-sm-9">
                        <div class="row">

                            <!--how to buy our product-->
                            <div class="col-sm-12 step_of_progress">
                                <h1 class="title">How to Buy our product</h1>

                                <div class="single_progress table-responsive">


                                    <div class="rtable">
                                        <h3>Step 1</h3>
                                        <img src="images/step1.png" alt=""/>
                                        <p>Select your item</p>
                                    </div>

                                    <div class="rtable">
                                        <h3>Step 2</h3>
                                        <img src="images/step2.png" alt=""/>
                                        <p>add to cart</p>
                                    </div>
                                    <div class="rtable">
                                        <h3>Step 3</h3>
                                        <img src="images/step3.png" alt=""/>
                                        <p>check out items</p>
                                    </div>
                                    <div class="rtable">
                                        <h3>Step 4</h3>
                                        <img src="images/step4.png" alt=""/>
                                        <p>get the ticket</p>
                                    </div>
                                    <div class="rtable">
                                        <h3>Step 5</h3>
                                        <img src="images/final_step.png" alt=""/>
                                        <p>receive your item</p>
                                    </div>


                                </div>
                            </div>

                            <!--end of how to buy-->


                            <div class="col-sm-12 our_product">
                                <h1 class="title">our product</h1>

                                <div id="productTab" class="tab">
                                    <ul class="nav navbar-nav">
                                        <li><a href="#product1"><i class="fa fa-align-justify"></i>bestseller</a></li>
                                        <li><a href="#product2"><i class="fa fa-download"></i>new arrivals</a></li>
                                        <li><a href="#product3"><i class="fa fa-star"></i>random products</a></li>

                                    </ul>
                                    <div id="product1" class="row">
                                        <div class="single_our_product col-sm-12"> 
                                            <div class="owl-carousel">

                                                <?php
                                                $sql = "SELECT * from product_info ORDER BY unitSold desc";

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
                                                                    <a  href="index.php?id=<?php echo base64_encode($row['product_id']); ?>&&user_id=<?php echo base64_encode($userid); ?>&&cart_ok=1" class="cart_hover"><span>ADD TO CART</span></a>                                                      
                                                                    <br><a  href="index.php?id=<?php echo base64_encode($row['product_id']); ?>&&user_id=<?php echo base64_encode($userid); ?>&&like=1" class="like_hover"><i class="fa fa-thumbs-up"></i>Like</a>                            
                                                                </div>
                                                            </div>

                                                            <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </div>

                                        </div>
                                    </div>

                                </div>


                                <div id="product2" class="row">
                                    <div class="single_our_product col-sm-12">
                                        <div class="owl-carousel">
                                            <?php
                                            $d = new DateTime('2016-04-12');
                                            $d->modify('-5 day');
                                            $r = $d->format('Y-m-d');
                                            $sql = "SELECT * from product_info where time > '$r'";

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
                                                            <h4><i class="fa fa-thumbs-up"></i>&nbsp;<?php echo $row['liking'] ?></h4>
                                                            <h3>$<?php echo $row['unitPrice']; ?></h3>
                                                            <div class="linktofancy">
                                                                <a  href="index.php?id=<?php echo base64_encode($row['product_id']); ?>&&user_id=<?php echo base64_encode($userid); ?>&&cart_ok=1" class="cart_hover"><span>ADD TO CART</span></a>                                                      
                                                                <br><a  href="index.php?id=<?php echo base64_encode($row['product_id']); ?>&&user_id=<?php echo base64_encode($userid); ?>&&like=1" class="like_hover"><i class="fa fa-thumbs-up"></i>Like</a>                        
                                                            </div>
                                                        </div>


                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>






                                        </div>
                                    </div>

                                </div>
                                <div id="product3" class="row">
                                    <div class="single_our_product col-sm-12">
                                        <div class="owl-carousel">


                                            <?php
                                            $sql = "SELECT * from product_info";

                                            $result = mysqli_query($db->connect(), $sql);

                                            if ($result) {
                                                if ($result->num_rows > 0) {
                                                    // output data of each row
                                                    while ($row = $result->fetch_assoc()) {
                                                        ?>
                                                        <div class="item thumbnail new_product">
                                                            <img src="images/<?php echo $row['image']; ?>"  alt="" class="img-responsive"/>
                                                            <p><?php echo $row['product_name']; ?></p>
                                                            <div class="stars">
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
                                                            <h4><i class="fa fa-thumbs-up"></i>&nbsp;<?php echo $row['liking'] ?></h4>
                                                            <h3>$<?php echo $row['unitPrice']; ?></h3>
                                                            <div class="linktofancy">
                                                                <a  href="index.php?id=<?php echo base64_encode($row['product_id']); ?>&&user_id=<?php echo base64_encode($userid); ?>&&cart_ok=1" class="cart_hover"><span>ADD TO CART</span></a>                                                      
                                                                <br><a  href="index.php?id=<?php echo base64_encode($row['product_id']); ?>&&user_id=<?php echo base64_encode($userid); ?>&&like=1" class="like_hover"><i class="fa fa-thumbs-up"></i>Like</a>                        
                                                            </div>
                                                        </div>


                                                        <?php
                                                    }
                                                } else {
                                                    echo "0 results";
                                                }
                                            }
                                            ?>





                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                        <!--banner area
                        *
                        *6.20pm
                        *
                        -->
                        <div class="col-sm-12 banner1">
                            <div class="col-sm-6">
                                <img src="images/banner-home-content1.png" alt="banner1" class="img-responsive">
                            </div>
                            <div class="col-sm-6">
                                <img src="images/banner-home-content2.png" alt="banner2" class="img-responsive">
                            </div>
                        </div>

                        <!--best offers section-->

                        <div class="col-sm-12 best_offer">
                            <h1 class="title">Best offers</h1>

                            <div id="offerTab" class="tab">
                                <ul class="nav navbar-nav">
                                    <li><a href="#offer1"><i class="fa fa-align-justify"></i>mobiles</a></li>
                                    <li><a href="#offer2"><i class="fa fa-download"></i>laptops</a></li>
                                    <li><a href="#offer3"><i class="fa fa-star"></i>Accessories </a></li>

                                </ul>
                                <div id="offer1" class="row">
                                    <div class="single_our_product col-sm-12">
                                        <div class="row">
                                            <?php
                                            $sql = "SELECT * from product_info where category_name= 'mobile' limit 8";

                                            $result = mysqli_query($db->connect(), $sql);

                                            if ($result) {
                                                if ($result->num_rows > 0) {
                                                    // output data of each row
                                               
                                                    while ($rows = $result->fetch_assoc()) {
                                                       
                                                        ?>


                                                        
                                                            <div class="item thumbnail new_product">
                                                                <img src="images/<?php echo $rows['image']; ?>" alt="" class="img-responsive"/>
                                                                <p><?php echo $rows['product_name']; ?></p>
                                                                <div class="stars">
                                                                    <?php
                                                                    if ($rows['rating_no'] > 0) {
                                                                        $n = (int) $rows['rating'] / $rows['rating_no'];
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
                                                                <h4><i class="fa fa-thumbs-up"></i>&nbsp;<?php echo $rows['liking'] ?></h4>
                                                                <h3>$<?php echo $rows['unitPrice']; ?></h3>
                                                                         
                                                                <div class="linktofancy">
                                                                    <a  href="index.php?id=<?php echo base64_encode($rows['product_id']); ?>&&user_id=<?php echo base64_encode($userid); ?>&&cart_ok=1" class="cart_hover"><span>ADD TO CART</span></a>                                                      
                                                                    <br><a  href="index.php?id=<?php echo base64_encode($rows['product_id']); ?>&&user_id=<?php echo base64_encode($userid); ?>&&like=1" class="like_hover"><i class="fa fa-thumbs-up"></i>Like</a>                        
                                                                </div>
                                                            </div>
                                                   
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>

                                </div>

                                <div id="offer2" class="row">

                                    <div class="single_our_product col-sm-12">
                                        <div class="row">
                                            <?php
                                            $sql = "SELECT * from product_info where category_name='laptop' limit 8";

                                            $result = mysqli_query($db->connect(), $sql);

                                            if ($result) {
                                                if ($result->num_rows > 0) {
                                                    // output data of each row
                                               
                                                    while ($rows = $result->fetch_assoc()) {
                                                    
                                                        ?>


                                                            <div class="item thumbnail new_product">
                                                                <img src="images/<?php echo $rows['image']; ?>"  alt="" class="img-responsive"/>
                                                                <p><?php echo $rows['product_name']; ?></p>
                                                                <div class="stars">
                                                                    <?php
                                                                    if ($rows['rating_no'] > 0) {
                                                                        $n = (int) $rows['rating'] / $rows['rating_no'];
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
                                                                <h4><i class="fa fa-thumbs-up"></i>&nbsp;<?php echo $row['liking'] ?></h4>
                                                                <h3>$<?php echo $rows['unitPrice']; ?></h3>
                                                                <div class="linktofancy">
                                                                    <a  href="index.php?id=<?php echo base64_encode($rows['product_id']);  ?>&&user_id=<?php echo base64_encode($userid); ?>&&cart_ok=1" class="cart_hover"><span>ADD TO CART</span></a>                                                      
                                                                    <br><a  href="index.php?id=<?php echo base64_encode($rows['product_id']); ?>&&user_id=<?php echo base64_encode($userid); ?>&&like=1" class="like_hover"><i class="fa fa-thumbs-up"></i>Like</a>                        
                                                                </div>    
                                                            </div>
                                                        
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div id="offer3" class="row">
                                    <div class="single_our_product col-sm-12">
                                        <div class="row">
                                            <?php
                                            $sql = "SELECT * from product_info where category_name= 'acc' limit 8";

                                            $result = mysqli_query($db->connect(), $sql);

                                            if ($result) {
                                                if ($result->num_rows > 0) {
                                                    // output data of each row
                                               
                                                    while ($rows = $result->fetch_assoc()) {
                                                     
                                                        ?>


                                                        <div class="col-sm-3">
                                                            <div class="item thumbnail new_product">
                                                                <img src="images/<?php echo $rows['image']; ?>" alt="" class="img-responsive"/>
                                                                <p><?php echo $rows['product_name']; ?></p>
                                                                <div class="stars">
                                                                    <?php
                                                                    if ($rows['rating_no'] > 0) {
                                                                        $n = (int) $rows['rating'] / $rows['rating_no'];
                                                                    } else {
                                                                        $n = 1;
                                                                    }
                                                                    for ($i = 1; $i <= 5; $i++) {
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
                                                                <h3>$<?php echo $rows['unitPrice']; ?></h3>
                                                                <div class="linktofancy">
                                                                    <a  href="index.php?id=<?php echo base64_encode($rows['product_id']); ?>&&user_id=<?php echo base64_encode($userid); ?>&&cart_ok=1" class="cart_hover"><span>ADD TO CART</span></a>                                                       
                                                                    <br><a  href="index.php?id=<?php echo base64_encode($rows['product_id']); ?>&&user_id=<?php echo base64_encode($userid); ?>&&like=1" class="like_hover"><i class="fa fa-thumbs-up"></i>Like</a>                        
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

                                </div>

                            </div>
                        </div>


                        <!--end of best offers section-->

                        <!--payment gateway-->
                        <div class="col-sm-12 brand">
                            <h1 class="title">Payment & gateway</h1>
                            <hr>
                            <div class="col-sm-3">
                                <img src="images/norton.png" alt="" class="img-responsive"/>
                            </div>
                            <div class="col-sm-3">
                                <img src="images/bkash.png" alt="" class="img-responsive"/>
                            </div>
                            <div class="col-sm-3">
                                <img src="images/dbbl.png" alt="" class="img-responsive"/>
                            </div>
                            <div class="col-sm-3">
                                <img src="images/master.png" alt="" class="img-responsive"/>
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>

        
        <!--footer area-->

        <div class="container-fluid footer">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3 col-lg-3 col-md-3">
                        <i class="fa fa-paper-plane"></i>
                        <blockquote>
                            <h5><b>infinity</b> is where the world goes to shop, sell, and give. Our mission is to be the world’s favorite destination for discovering great value and unique selection.</h5>
                        </blockquote>
                    </div>      

                    <div class="col-sm-3 col-lg-3 col-md-3">
                        <h3>Buy</h3>
                        <ul class="nav navbar-btn">
                            <li><a href="#">registration</a></li>
                            <li><a href="#">money back guarantee</a></li>
                            <li><a href="#">bidding & buying help</a></li>
                            <li><a href="#">stores</a></li>
                            <li><a href="#">infinity guides</a></li>
                        </ul>
                    </div>

                    <div class="col-sm-3 col-lg-3 col-md-3">
                        <h3>Get In Touch</h3>
                        <form class="form-horizontal">
                            <div class="form-group">
                                <input type="text" name="email" placeholder="Your Email" class="form-control">
                            </div>
                            <div class="form-group">
                                <textarea name="message" placeholder="Say something" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-block btn-danger" type="submit">Send</button>
                            </div>
                        </form>
                    </div>

                    <div class="col-sm-3 col-lg-3 col-md-3">
                        <h3>Help</h3>
                        <ul class="nav navbar-btn">
                            <li><a href="#">24/7 service</a></li>
                            <li><a href="#">Forum</a></li>
                            <li><a href="#">Api</a></li>
                            <li><a href="#">online Docs</a></li>         
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid bottom_footer">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-md-12 ">
                        <div class="navigation col-sm-offset-3">
                            <ul class="nav navbar-nav">
                                <li><a href="#">Homepage</a></li>
                                <li><a href="#">shop</a></li>
                                <li><a href="#">blog</a></li>
                                <li><a href="#">Photo album</a></li>
                                <li><a href="#">about us</a></li>
                                <li><a href="#">contact us</a></li>

                            </ul>               
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-md-12">
                        <p>&COPY; 2016 By <a href="#">Mehbuba & Meshu & Dip</a></p>
                    </div>
                </div>
            </div>
        </div>


        <!--modal for cart-->

        <div  class="modal fade cart" tabindex="-1" role="dialog" aria-labelledby="1">
            <div class="modal-dialog " role="document">
                <div class="modal-content">

                    <div class="modal-body images1">
                        <div class="cross_btn">

                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i></button>
                        </div>


                        <div class="row">
                            <div class="col-sm-4">
                                <i class="fa fa-shopping-cart"></i>

                                <h1>Buy Now</h1>
                            </div>
                            <div class="col-sm-6">
                                <h2 class="cart_title">Credit Card Details</h2>
                                <?php if ($userid != 0) { ?>
                                    <form class="form-horizontal" id="cart_form">

                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Name">
                                            <div class="input-group-addon "><i class="fa fa-user cart_label_person"></i></div>
                                        </div>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Phone">
                                            <div class="input-group-addon "><i class="fa fa-mobile-phone cart_label_person"></i></div>
                                        </div>
                                        <div class="input-group col-sm-12">
                                            <input type="text" class="form-control" placeholder="Card Number">
                                        </div>

                                        <button type="submit" class="btn btn-success btn-block button_one">pay with credit card</button>

                                        <h4>Or</h4>
                                        <button type="submit" class="btn btn-warning btn-block button_two" >proceed with Online payment</button>

                                    </form>
                                <?php } else { ?>
                                    <h3 class="text-center text-danger h3">Sorry You don't have permission to get access.</h3>
                                    <h3 class="text-center text-danger h3"><a href='./assets/admin/login.php'>Please login here</a></h3>
                                <?php }; ?>
                            </div>
                        </div>

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->



        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script src="js/myJs.js" type="text/javascript"></script>
        <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script src=" https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>

        <script src="js/jquery.flexslider-min.js" type="text/javascript"></script>
        <script src="js/owl.carousel.min.js" type="text/javascript"></script>
        <script src="js/loading.js" type="text/javascript"></script>
        <script src="js/jquery.fancybox.js" type="text/javascript"></script>
    </body>
</html>