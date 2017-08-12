<?php
/*
 * author : meshu
 */
require_once __DIR__ . '../../../controllar/db_connect.php';

$db = new DB_CONNECT();

$userName = $password = "";
if (isset($_POST['login'])) {
    if (isset($_POST['username'])) {
        $userName = $_POST['username'];
    }
    if (isset($_POST['password'])) {
        $password = $_POST['password'];
    }

//    if (isset($_POST['fop'])) {
//
//        //Email information
//        $admin_email = "meshu.uiu@gmail.com";
//        $email = "meshu.uiu2@gmail.com";
//        $subject = "Infinity Online shopping";
//        $comment = "hi this your new password.";
//
//        //send email
//        mail($admin_email, "$subject", $comment);
//
//        //Email response
//        echo "A Email has been send on your mailing address.";
//    }

    $query = "select * from user_info where userName = '$userName' and upassword = '$password' ";
    $result = mysqli_query($db->connect(), $query);
    if ($result) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $userid = $row['user_id'];
                header("Location: ../../index.php?user_id=".base64_encode($userid));
            }
        }
    } else {
        echo "<script>alert('wrong password or user name.Please try again')</script>";
    }
} if (isset($_POST['signup'])) {
    header("Location: ./register.php");
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

        <title>Login</title>

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
    </head>

    <body class="login-img3-body logon">

        <div class="container">


            <form class="login-form" action="" method="POST">        
                <div class="login-wrap">
                    <p class="login-img"><i class="icon_lock_alt"></i></p>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon_profile"></i></span>
                        <input type="text" class="form-control" name='username' placeholder="Username" autofocus>

                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                        <input type="password" name='password' class="form-control" placeholder="Password">

                    </div>
                    <label class="checkbox">
                        <input type="checkbox" name="fop" value="remember-me"> Remember me
                        <span class="pull-right"> <a href="#" > Forgot Password?</a></span>
                    </label>
                    <button class="btn btn-primary btn-lg btn-block" type="submit" name='login'>Login</button>
                    <button class="btn btn-info btn-lg btn-block" type="submit" name='signup'>Signup</button>
                </div>
            </form>

        </div>



    </body>
</html>
