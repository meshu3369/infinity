<?php
/*
 * author : meshu
 */
session_start();
if (isset($_GET['notify'])) {
    $_SESSION['notify'] = true;
}
require_once __DIR__ . '../../../controllar/db_connect.php';

$db = new DB_CONNECT();

if (isset($_GET['user_id']))
    $userid = base64_decode ($_GET['user_id']);
else
    header("Location: ./login.php");

/*
 *
 * description: collecting the user name and last session login..
 *
 */

$user_name_query = "select * from user_info where user_id = '$userid'";
$res = mysqli_query($db->connect(), $user_name_query);

if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        $userName = $row['userName'];
        $lastLogin = $row['last_visit'];
    }
}


/*
 *
 * description: notification checking and handling 
 *
 */

$query = "select count(*) from product_info where time > '$lastLogin'";

$result = mysqli_query($db->connect(), $query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $count = $row['count(*)'];
    }
} else {
    $count = 0;
}

/* * ** End of Block.. notification handling*** */

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
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="infinity Admin Template">
        <meta name="author" content="GeeksLabs">
        <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
        <link rel="shortcut icon" href="img/favicon.png">

        <title>Infinity User panel</title>

        <!-- Bootstrap CSS -->    
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- bootstrap theme -->
        <link href="css/bootstrap-theme.css" rel="stylesheet">
        <!--external css-->
        <!-- font icon -->
        <link href="css/elegant-icons-style.css" rel="stylesheet" />
        <link href="css/font-awesome.min.css" rel="stylesheet" />    
        <!-- full calendar css-->
        <link href="assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
        <link href="assets/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" />
        <!-- easy pie chart-->
        <link href="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
        <!-- owl carousel -->
        <link rel="stylesheet" href="css/owl.carousel.css" type="text/css">
        <link href="css/jquery-jvectormap-1.2.2.css" rel="stylesheet">
        <!-- Custom styles -->
        <link rel="stylesheet" href="css/fullcalendar.css">
        <link href="css/widgets.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/style-responsive.css" rel="stylesheet" />
        <link href="css/xcharts.min.css" rel=" stylesheet">	
        <link href="css/jquery-ui-1.10.4.min.css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
          <script src="js/lte-ie7.js"></script>
        <![endif]-->
    </head>

    <body>
        <!-- container section start -->
        <section id="container" class="">


            <header class="header dark-bg">
                <div class="toggle-nav">
                    <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
                </div>

                <!--logo start-->
                <a href="../../../index.php" class="logo">Infinity <span class="lite">User</span></a>
                <!--logo end-->



                <div class="top-nav notification-row">                
                    <!-- notificatoin dropdown start-->
                    <ul class="nav pull-right top-menu">



                        <!-- alert notification start-->
                        <li id="alert_notificatoin_bar" class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                                <i class="icon-bell-l"></i>
                                <?php if (isset($_SESSION['notify'])) { ?>

                                <?php } else  ?>
                                <span class="badge bg-important"><?php echo $count; ?></span>
                            </a>
                            <ul class="dropdown-menu extended notification">
                                <div class="notify-arrow notify-arrow-blue"></div>
                                <li>
                                    <p class="blue">You have <?php echo $count; ?> new notifications</p>
                                </li>
                                <?php
                                $query = "select * from product_info where time > '$lastLogin'";
                                $result = mysqli_query($db->connect(), $query);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>

                                        <li>
                                            <a href="#">
                                                <span class="label label-primary"><i class="icon_profile"></i></span> 
                                                <?php echo $row['product_name']; ?>
                                            </a>
                                        </li>

                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </li>
                        <!-- alert notification end-->
                        <!-- user login dropdown start-->
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="profile-ava">
                                    <img alt="" src="img/avatar-mini2.jpg">
                                </span>
                                <span class="username"><?php echo $userName; ?></span>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu extended logout">
                                <div class="log-arrow-up"></div>


                                <li>
                                    <a href="./login.php"><i class="icon_key_alt"></i> Log Out</a>
                                </li>

                            </ul>
                        </li>
                        <!-- user login dropdown end -->
                    </ul>
                    <!-- notificatoin dropdown end-->
                </div>
            </header>      
            <!--header end-->

            <!--sidebar start-->
            <aside>
                <div id="sidebar"  class="nav-collapse ">
                    <!-- sidebar menu start-->
                    <ul class="sidebar-menu">                
                        <li class="active">
                            <a class="" href="../../index.php?user_id=<?php echo base64_encode($userid); ?>">
                                <i class="icon_house_alt"></i>
                                <span>Home Page</span>
                            </a>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;" class="">
                                <i class="icon_document_alt"></i>
                                <span>My Account</span>
                                <span class="menu-arrow arrow_carrot-right"></span>
                            </a>
                            <ul class="sub">
                                <li><a class="" href="../../cart_product.php?user_id=<?php echo base64_encode($userid);?>">check Cart</a></li>                          

                            </ul>
                        </li>       


                    </ul>
                    <!-- sidebar menu end-->
                </div>
            </aside>
            <!--sidebar end-->

            <!--main content start-->
            <section id="main-content">
                <section class="wrapper">            
                    <!--overview start-->
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="page-header"><i class="fa fa-laptop"></i> Dashboard</h3>
                            <ol class="breadcrumb">
                                <li><i class="fa fa-home"></i><a href="../../index.php?user_id=<?php echo base64_encode($userid); ?>">Home</a></li>
                                <li><i class="fa fa-laptop"></i>Dashboard</li>						  	
                            </ol>
                        </div>
                    </div>




                    <!-- project team & activity start -->
                    <div class="row">


                        <div class="col-lg-12">
                            <!--Project Activity start-->
                            <section class="panel">
                                <div class="panel-body progress-panel">
                                    <div class="row">
                                        <div class="col-lg-8 task-progress pull-left">
                                            <h1>Activity Log</h1>                                  
                                        </div>
                                        <div class="col-lg-4">
                                            <span class="profile-ava pull-right">
                                                <i class="fa fa-user"></i>&nbsp;&nbsp;
                                                <?php echo $userName; ?>
                                            </span>                                
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-hover personal-task">
                                    <tbody>
                                        <?php
                                        /*
                                         *
                                         * description: checking the login session of user.
                                         *
                                         */

                                        $query = "select * from order_details where user_id = '$userid'";
                                        $result = mysqli_query($db->connect(), $query);


                                        if ($result->num_rows > 0) {

                                            while ($row = $result->fetch_assoc()) {
                                                ?>


                                                <tr>
                                                    <td><?php echo $row['order_time'];?></td>
                                                    <td>
                                                       Total Due: <?php echo $row['totalDue'];?> Tk
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-important">shipment</span>
                                                    </td>

                                                </tr>

                                                <?php
                                            }
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </section>
                            <!--Project Activity end-->
                        </div>
                    </div><br><br>


                    <!-- project team & activity end -->

                </section>
            </section>
            <!--main content end-->
        </section>
        <!-- container section start -->
        <?php include 'footer.php'; ?>