<?php 
/*
 * author : meshu
 */
require_once __DIR__ . '../../../controllar/db_connect.php';

$db = new DB_CONNECT();

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

                
            </header>      
            <!--header end-->

            <!--sidebar start-->
            <aside>
                <div id="sidebar"  class="nav-collapse ">
                    <!-- sidebar menu start-->
                    <ul class="sidebar-menu">                
                        <li class="active">
                            <a class="" href="admin.php">
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
                                <li><a class="" href="insert_product.php">Insert New Product</a></li>                          
                                <li><a class="" href="update_product.php">Update Product</a></li>
                                <li><a class="" href="offer_product.php">Add Offer</a></li>
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
                                <li><i class="fa fa-laptop"></i>Dashboard</li>						  	
                            </ol>
                        </div>
                    </div>




                    <!-- Today status end -->


                    <?php
                    $search2 = "select * from tracker where 1";
                    $result = mysqli_query($db->connect(), $search2);
                    $totalHits = 0;
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $totalHits = $row['hits'];
                        }
                    }
                    $search2 = "select * from order_details where 1";
                    $result = mysqli_query($db->connect(), $search2);
                    $totaldue = 0;
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $totaldue += $row['totalDue'];
                        }
                    }
                    $search2 = "select liking,quantity from product_info where 1";
                    $result = mysqli_query($db->connect(), $search2);
                    $totalLike = 0;
                    $totalStock = 0;
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $totalLike += $row['liking'];
                            $totalStock += $row['quantity'];
                        }
                    }
                    
                    
                   
                    ?>




                    <!-- statics end -->
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="info-box blue-bg">
                                <i class="fa fa-cloud-download"></i>
                                <div class="count"><?php echo $totalHits;?></div>
                                <div class="title">Total Views</div>						
                            </div><!--/.info-box-->			
                        </div><!--/.col-->

                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="info-box brown-bg">
                                <i class="fa fa-shopping-cart"></i>
                                <div class="count"><?php echo $totaldue;?></div>
                                <div class="title">Purchased (tk)</div>						
                            </div><!--/.info-box-->			
                        </div><!--/.col-->	

                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="info-box dark-bg">
                                <i class="fa fa-thumbs-o-up"></i>
                                <div class="count"><?php echo $totalLike;?></div>
                                <div class="title">Total Like</div>						
                            </div><!--/.info-box-->			
                        </div><!--/.col-->

                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="info-box green-bg">
                                <i class="fa fa-cubes"></i>
                                <div class="count"><?php echo $totalStock;?></div>
                                <div class="title">Stock</div>						
                            </div><!--/.info-box-->			
                        </div><!--/.col-->

                    </div><!--/.row-->



                    <!-- project team & activity start -->
                    <br><br>


                    <!-- project team & activity end -->

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
