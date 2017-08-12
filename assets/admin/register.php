<?php
/*
 * author : meshu
 */
require_once __DIR__ . '../../../controllar/db_connect.php';

$db = new DB_CONNECT();

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$name = $email = $gender = $comment = $website = "";

if (isset($_POST['signup'])) {

    if (isset($_POST['username'])) {
        $userName = test_input($_POST["username"]);
//        if (!preg_match("/^[a-zA-Z ]*$/", $userName)) {
//            $erruser = "Only letters and white space allowed";
//            
//        }
    } else {
        $erruser = 'Please enter a username.';
    }
    if (isset($_POST['email'])) {
        $email = test_input($_POST["email"]);
//        if (!filter_var($email, FILTER_VALIDATE_EMAIL) === true) {
//           $emailErr = "Invalid Email Address";
//        
//        }
    } else {
        $emailErr = 'Please enter an email';
    }
    if (isset($_POST['password'])) {
        $password = test_input($_POST["password"]);
//        if (strlen($password) <= 8) {
//            $errpassword = "At Least 8 Characters!";
//        } else if (!preg_match("#[0-9]+#", $password)) {
//            $errpassword = "At Least 1 Number!";
//        }
    } else {
        $errpassword = 'Please enter a password';
    }
    if (isset($_POST['phone'])) {
        $phone = test_input($_POST["phone"]);
    } else {
        $errphone = 'Please enter a mobile no';
    }

//if (!isset($errpassword) && !isset($emailErr) && !isset($erruser) && !isset($errphone) ) {
  
    $date = new DateTime('now');
    $date = $date->format('Y-m-d H:i:s');

    $query = "select * from user_info where userName = '$userName'";
    $result = mysqli_query($db->connect(), $query);


    if ($result->num_rows > 0) {
        echo "<script>alert('Username Already in the database.Please try another name.')</script>";
    } else {
        $query = "insert into user_info (userName,email,upassword,phone,entrydate) values('$userName','$email','$password','$phone','$date')";
        $result = mysqli_query($db->connect(), $query);
        if ($result) {
            echo "<script>alert('You have successfully registered. Login now');location.replace('./login.php');</script>";
        } else {
            echo "<script>alert('sorry there is some problem..try later.');</script>";
        }
    }
}
if (isset($_POST['login'])) {
    header("Location: ./login.php");
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="login panel of infinity">
        <meta name="author" content="infinity">
        <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
        <link rel="shortcut icon" href="img/favicon.png">

        <title>Registration</title>

        <!-- Bootstrap CSS -->    
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- bootstrap theme -->
        <link href="css/bootstrap-theme.css" rel="stylesheet">
        <!--external css-->
        <!-- font icon -->
        <link href="css/elegant-icons-style.css" rel="stylesheet" />
        <link href="css/font-awesome.css" rel="stylesheet" />
        <!-- Custom styles -->
        <link href="css/style.css" rel="stylesheet">
        <link href="css/style-responsive.css" rel="stylesheet" />

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->

        <style>
            .msg{
                color: #000;
                font-weight: bold;
                margin-top: -15px;
                font-size: 16px;
                padding: 11px;

            }
        </style>
    </head>

    <body class="login-img3-body logon">

        <div class="container">


            <form class="login-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">        
                <div class="login-wrap">
                    <p class="login-img"><i class="icon_lock_alt"></i></p>


                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon_profile"></i></span>
                        <input type="text" class="form-control" id="username" name='username' placeholder="Username" autofocus>

                    </div>
                    <div class="msg"><?php if (isset($erruser)) echo $erruser; ?></div>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon_profile"></i></span>
                        <input type="text" class="form-control" id="email" name='email' placeholder="Email" autofocus>

                    </div>
                    <div class="msg"><?php if (isset($emailErr)) echo $emailErr; ?></div>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                        <input type="password" name='password' id="password" class="form-control" placeholder="Password">

                    </div>
                    <div class="msg"><?php if (isset($errpassword)) echo $errpassword; ?></div>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                        <input type="text" name='phone' id="phone" class="form-control" placeholder="Phone">

                    </div>
                    <div class="msg"><?php if (isset($errphone)) echo $errphone; ?></div>



                    <button class="btn btn-primary btn-lg btn-block" type="submit" name='signup'>Signup</button>
                    <button class="btn btn-info btn-lg btn-block" type="submit" name='login'>Login</button>
                </div>
            </form>

            <br><br><br><br>

        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.min.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {

//                $(".msg1").hide();
//                $(".msg2").hide();
//                $(".msg3").hide();
//                $(".msg4").hide();
//
//                function error(msg, bg, number) {
//
//                    $(".msg" + number).show();
//                    $(".msg" + number).text(msg);
//                    $(".msg" + number).css("background", bg);
//                }
//
//                $('#email').keypress(function () {
//                    var sEmail = $('#email').val();
//
//                    if ($.trim(sEmail).length == 0) {
//                        error("Enter an email", "#fa853f", 2);
//                        e.preventDefault();
//                    } else {
//                        if (validateEmail(sEmail)) {
//                            error('available', "#1bce30", 2);
//                        } else {
//                            error("Invalid Email", "#fa853f", 2);
//                            e.preventDefault();
//                        }
//                    }
//                });
//                $('#username').keyup(function () {
//                    var username = $('#username').val();
//
//                    if (username == "") {
//
//                        e.preventDefault();
//                    } else {
//
//                    }
//
//                });
//                $('#password').keypress(function () {
//                    $(".msg2").hide();
//                });
//                $('#password').keyup(function () {
//
//                    var password = $('#password').val();
//                    var pl = password.length;
//
//                    if (password == "") {
//                        error("Enter a password", "#fa853f", '3');
//                        e.preventDefault();
//                    } else if (pl <= 6) {
//                        error("must be 6 characters", "#fa853f", 3);
//                        e.preventDefault();
//                    } else if (pl > 6) {
//                        $(".msg3").hide();
//                    }
//
//                });
//                $('#phone').keyup(function () {
//
//                    var phone = $('#phone').val();
//                    if (phone == "") {
//                        error("Enter a phone no", "#fa853f", '4');
//                        e.preventDefault();
//                    } else {
//                        $(".msg4").hide();
//                    }
//
//                });

            });




            function validateEmail(sEmail) {
                var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
                if (filter.test(sEmail)) {
                    return true;
                } else {
                    return false;
                }
            }
        </script>
    </body>
</html>
