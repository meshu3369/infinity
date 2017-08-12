<?php
/*
 * author : meshu
 */
require_once __DIR__ . '../../../controllar/db_connect.php';

$db = new DB_CONNECT();
$product_name = $product_id = $description = $category_name = $image = '';
$quantity = $unitPrice = 0;

if (isset($_GET['id']))
    $id = $_GET['id'];
else
    $id = 0;

$qur = "select * from product_info where product_id='$id'";
$result_search = mysqli_query($db->connect(), $qur);

if (isset($_REQUEST['submit'])) {
    if (isset($_REQUEST['product_name']))
        $product_name = $_REQUEST['product_name'];
    if (isset($_REQUEST['product_id']))
        $product_id = $_REQUEST['product_id'];
    if (isset($_REQUEST['unitPrice']))
        $unitPrice = $_REQUEST['unitPrice'];
    if (isset($_REQUEST['quantity']))
        $quantity = $_REQUEST['quantity'];
    if (isset($_REQUEST['description']))
        $description = $_REQUEST['description'];
    if (isset($_REQUEST['category_name']))
        $category_name = $_REQUEST['category_name'];
    if (isset($_REQUEST['picture']))
        $file_name = $_REQUEST['picture'];


    if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {
        $errors = array();
        $file_name = $_FILES['image']['name'];

        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));

        $expensions = array("jpeg", "jpg", "png");

      
        if (in_array($file_ext, $expensions) === false) {
            $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
        }

        if ($file_size > 2097152) {
            $errors[] = 'File size must be excately 2 MB';
        }

        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "../../images/" . $file_name);
        } else {
            print_r($errors);
        }
    }

    $date = date('Y-m-d');

    $admin = 1;

    $query = "update product_info set product_name='$product_name', unitPrice = '$unitPrice', quantity = '$quantity',description='$description',image= '$file_name',category_name='$category_name',time='$date' where product_id = '$product_id'";

    //$query = "update product_info set product_name='fuck you' where product_id='45s'";

    $result = mysqli_query($db->connect(), $query);
    if ($result) {
        header("Location: ./update_product.php?flag=1");
    }
}
else if(isset($_POST['cancle'])){
    header("Location: ./update_product.php");
}
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

        <title>Infinity admin panel</title>

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
                <a href="index.html" class="logo">Infinity <span class="lite">Admin</span></a>
                <!--logo end-->

                <div class="nav search-row" id="top_menu">
                    <!--  search form start -->
                    <ul class="nav top-menu">                    
                        <li>
                            <form class="navbar-form">
                                <input class="form-control" placeholder="Search" type="text">
                            </form>
                        </li>                    
                    </ul>
                    <!--  search form end -->                
                </div>

                <div class="top-nav notification-row">                
                    <!-- notificatoin dropdown start-->
                    <ul class="nav pull-right top-menu">

                        <!-- task notificatoin start -->
                        <li id="task_notificatoin_bar" class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="icon-task-l"></i>
                                    <span class="badge bg-important">6</span>
                            </a>
                            <ul class="dropdown-menu extended tasks-bar">
                                <div class="notify-arrow notify-arrow-blue"></div>
                                <li>
                                    <p class="blue">You have 6 pending letter</p>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="task-info">
                                            <div class="desc">Design PSD </div>
                                            <div class="percent">90%</div>
                                        </div>
                                        <div class="progress progress-striped">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%">
                                                <span class="sr-only">90% Complete (success)</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="task-info">
                                            <div class="desc">
                                                Project 1
                                            </div>
                                            <div class="percent">30%</div>
                                        </div>
                                        <div class="progress progress-striped">
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%">
                                                <span class="sr-only">30% Complete (warning)</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="task-info">
                                            <div class="desc">Digital Marketing</div>
                                            <div class="percent">80%</div>
                                        </div>
                                        <div class="progress progress-striped">
                                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                                <span class="sr-only">80% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>

                                <li class="external">
                                    <a href="#">See All Tasks</a>
                                </li>
                            </ul>
                        </li>
                        <!-- task notificatoin end -->
                        <!-- inbox notificatoin start-->
                        <li id="mail_notificatoin_bar" class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <i class="icon-envelope-l"></i>
                                <span class="badge bg-important">5</span>
                            </a>
                            <ul class="dropdown-menu extended inbox">
                                <div class="notify-arrow notify-arrow-blue"></div>
                                <li>
                                    <p class="blue">You have 5 new messages</p>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="photo"><img alt="avatar" src="./img/avatar-mini.jpg"></span>
                                        <span class="subject">
                                            <span class="from">Greg  Martin</span>
                                            <span class="time">1 min</span>
                                        </span>
                                        <span class="message">
                                            I really like this admin panel.
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="photo"><img alt="avatar" src="./img/avatar-mini2.jpg"></span>
                                        <span class="subject">
                                            <span class="from">Bob   Mckenzie</span>
                                            <span class="time">5 mins</span>
                                        </span>
                                        <span class="message">
                                            Hi, What is next project plan?
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="photo"><img alt="avatar" src="./img/avatar-mini3.jpg"></span>
                                        <span class="subject">
                                            <span class="from">Phillip   Park</span>
                                            <span class="time">2 hrs</span>
                                        </span>
                                        <span class="message">
                                            I am like to buy this Admin Template.
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="photo"><img alt="avatar" src="./img/avatar-mini4.jpg"></span>
                                        <span class="subject">
                                            <span class="from">Ray   Munoz</span>
                                            <span class="time">1 day</span>
                                        </span>
                                        <span class="message">
                                            Icon fonts are great.
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">See all messages</a>
                                </li>
                            </ul>
                        </li>
                        <!-- inbox notificatoin end -->
                        <!-- alert notification start-->
                        <li id="alert_notificatoin_bar" class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                                <i class="icon-bell-l"></i>
                                <span class="badge bg-important">7</span>
                            </a>
                            <ul class="dropdown-menu extended notification">
                                <div class="notify-arrow notify-arrow-blue"></div>
                                <li>
                                    <p class="blue">You have 4 new notifications</p>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="label label-primary"><i class="icon_profile"></i></span> 
                                        Friend Request
                                        <span class="small italic pull-right">5 mins</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="label label-warning"><i class="icon_pin"></i></span>  
                                        John location.
                                        <span class="small italic pull-right">50 mins</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="label label-danger"><i class="icon_book_alt"></i></span> 
                                        Project 3 Completed.
                                        <span class="small italic pull-right">1 hr</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="label label-success"><i class="icon_like"></i></span> 
                                        Mick appreciated your work.
                                        <span class="small italic pull-right"> Today</span>
                                    </a>
                                </li>                            
                                <li>
                                    <a href="#">See all notifications</a>
                                </li>
                            </ul>
                        </li>
                        <!-- alert notification end-->
                        <!-- user login dropdown start-->
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="profile-ava">
                                    <img alt="" src="img/avatar1_small.jpg">
                                </span>
                                <span class="username">Jenifer Smith</span>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu extended logout">
                                <div class="log-arrow-up"></div>
                                <li class="eborder-top">
                                    <a href="#"><i class="icon_profile"></i> My Profile</a>
                                </li>
                                <li>
                                    <a href="#"><i class="icon_mail_alt"></i> My Inbox</a>
                                </li>
                                <li>
                                    <a href="#"><i class="icon_clock_alt"></i> Timeline</a>
                                </li>
                                <li>
                                    <a href="#"><i class="icon_chat_alt"></i> Chats</a>
                                </li>
                                <li>
                                    <a href="login.html"><i class="icon_key_alt"></i> Log Out</a>
                                </li>
                                <li>
                                    <a href="documentation.html"><i class="icon_key_alt"></i> Documentation</a>
                                </li>
                                <li>
                                    <a href="documentation.html"><i class="icon_key_alt"></i> Documentation</a>
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
                            <a class="" href="index.html">
                                <i class="icon_house_alt"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;" class="">
                                <i class="icon_document_alt"></i>
                                <span>Settings</span>
                                <span class="menu-arrow arrow_carrot-right"></span>
                            </a>
                            <ul class="sub">
                                <li><a class="" href="./insert_product.php">Insert New Product</a></li>                          
                                <li><a class="" href="./update_product.php">Update Product</a></li>
                                <li><a class="" href="./delete_product.php">Delete Product</a></li>
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
                                <li><i class="fa fa-home"></i><a href="admin.php">Home</a></li>
                                <li><i class="fa fa-laptop"></i>Add Product</li>						  	
                            </ol>
                        </div>
                    </div>




                    <!-- Form validations -->              
                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
                                    Add Product
                                </header>
                                <div class="panel-body">
                                    <?php
                                    if ($result_search->num_rows > 0) {
                                        while ($rows = $result_search->fetch_assoc()) {
                                            ?>    

                                            <div class="form" >
                                                <form class="form-validate form-horizontal" id="feedback_form" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                                    <div class="form-group ">
                                                        <label for="cname" class="control-label col-lg-2">Product Name<span class="required">*</span></label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control" id="cname" name="product_name" minlength="5" type="text" value="<?php echo $rows['product_name']; ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="cemail" class="control-label col-lg-2">Product id<span class="required">*</span></label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control " id="cemail" type="text" name="product_id" value="<?php echo $rows['product_id']; ?>"  readonly />
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="curl" class="control-label col-lg-2">Category Name</label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control " id="curl" type="text" name="category_name" value="<?php echo $rows['category_name']; ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="cname" class="control-label col-lg-2">Unit Price<span class="required">*</span></label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control" id="subject" name="unitPrice" minlength="5" type="number" value="<?php echo $rows['unitPrice']; ?>" />
                                                        </div>
                                                    </div>                                      
                                                    <div class="form-group ">
                                                        <label for="quantity" class="control-label col-lg-2">Quantity<span class="required">*</span></label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control" name="quantity" minlength="5" type="number" value="<?php echo $rows['quantity']; ?>" />
                                                        </div>
                                                    </div>                                      
                                                    <div class="form-group ">
                                                        <label for="ccomment" class="control-label col-lg-2">description</label>
                                                        <div class="col-lg-10">
                                                            <textarea class="form-control "  name="description" ><?php echo $rows['description']; ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="picture" class="control-label col-lg-2">picture</label>
                                                        <div class="col-lg-10">
                                                            <img class="col-sm-6" src="../../images/<?php echo $rows['image']; ?>" alt="form image"/>
                                                            <input  name="picture" value="<?php echo $rows['image']; ?>" type="hidden" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="image" class="control-label col-lg-2">Image<span class="required">*</span></label>
                                                        <div class="col-lg-10">
                                                            <input  name="image"  type="file" />
                                                        </div>
                                                    </div> 

                                                    <div class="form-group">
                                                        <div class="col-lg-offset-2 col-lg-10">
                                                            <button class="btn btn-primary" type="submit" name="submit">Save</button>
                                                            <button class="btn btn-default" type="submit" name="cancle" type="button">Cancel</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>

                                </div>
                            </section>
                        </div>
                    </div>

                </section>
            </section>
            <!--main content end-->
        </section>
        <!-- container section start -->

        <!-- javascripts -->
        <script src="js/jquery.js"></script>
        <script src="js/jquery-ui-1.10.4.min.js"></script>
        <script src="js/jquery-1.8.3.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.9.2.custom.min.js"></script>
        <!-- bootstrap -->
        <script src="js/bootstrap.min.js"></script>
        <!-- nice scroll -->
        <script src="js/jquery.scrollTo.min.js"></script>
        <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
        <!-- charts scripts -->
        <script src="assets/jquery-knob/js/jquery.knob.js"></script>
        <script src="js/jquery.sparkline.js" type="text/javascript"></script>
        <script src="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
        <script src="js/owl.carousel.js" ></script>
        <!-- jQuery full calendar -->
        <<script src="js/fullcalendar.min.js"></script> <!-- Full Google Calendar - Calendar -->
        <script src="assets/fullcalendar/fullcalendar/fullcalendar.js"></script>
        <!--script for this page only-->
        <script src="js/calendar-custom.js"></script>
        <script src="js/jquery.rateit.min.js"></script>
        <!-- custom select -->
        <script src="js/jquery.customSelect.min.js" ></script>
        <script src="assets/chart-master/Chart.js"></script>

        <!--custome script for all page-->
        <script src="js/scripts.js"></script>
        <!-- custom script for this page-->
        <script src="js/sparkline-chart.js"></script>
        <script src="js/easy-pie-chart.js"></script>
        <script src="js/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="js/jquery-jvectormap-world-mill-en.js"></script>
        <script src="js/xcharts.min.js"></script>
        <script src="js/jquery.autosize.min.js"></script>
        <script src="js/jquery.placeholder.min.js"></script>
        <script src="js/gdp-data.js"></script>	
        <script src="js/morris.min.js"></script>
        <script src="js/sparklines.js"></script>	
        <script src="js/charts.js"></script>
        <script src="js/jquery.slimscroll.min.js"></script>
        <script>

            //knob
            $(function () {
                $(".knob").knob({
                    'draw': function () {
                        $(this.i).val(this.cv + '%')
                    }
                })
            });

            //carousel
            $(document).ready(function () {
                $("#owl-slider").owlCarousel({
                    navigation: true,
                    slideSpeed: 300,
                    paginationSpeed: 400,
                    singleItem: true

                });
            });

            //custom select box

            $(function () {
                $('select.styled').customSelect();
            });

            /* ---------- Map ---------- */
            $(function () {
                $('#map').vectorMap({
                    map: 'world_mill_en',
                    series: {
                        regions: [{
                                values: gdpData,
                                scale: ['#000', '#000'],
                                normalizeFunction: 'polynomial'
                            }]
                    },
                    backgroundColor: '#eef3f7',
                    onLabelShow: function (e, el, code) {
                        el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
                    }
                });
            });



        </script>

    </body>
</html>
