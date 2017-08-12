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