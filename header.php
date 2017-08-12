<?php
/*
 * author : meshu
 */
require_once __DIR__ . '/controllar/db_connect.php';

$db = new DB_CONNECT();

if (isset($_GET['user_id']))
    $userid = base64_decode($_GET['user_id']);

else {
    $userid = 0;
}

$search = "select count(*) from cart where user_id = '$userid'";

$result = mysqli_query($db->connect(), $search);


if ($result->num_rows > 0) {
    $order = 0;
    while ($row = $result->fetch_assoc()) {
        $order = $row['count(*)'];
    }
} else {
    
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=0">

        <title>DBMS PROJECT (Infinity)</title>

        <link rel="shortcut icon" href="images/logo.png">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700,900,400italic,700italic,900italic,300italic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css">
        <link href='https://fonts.googleapis.com/css?family=Archivo+Narrow:400,400italic,700,700italic' rel='stylesheet' type='text/css'>

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
                                <li><a href="#">register</a></li> 
                                <li class="slash">|</li> 
                                <li><a href="#">help</a></li> 

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
                        <a href="index.php?user_id=<?php echo base64_encode($userid); ?>"><img src="images/logotm.jpg" alt="logo" class="img-responsive"/></a>
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
