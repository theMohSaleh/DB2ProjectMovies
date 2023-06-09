<?php

include 'header.php';

//Reset View/Like/Dislike first time values
unset($_SESSION['first_run']);
unset($_SESSION['first_likeDislike']);
   
session_start();

if (isset($_POST['submitted'])) {

    $lgnObj = new Login();
    $username = $_POST['Username'];
    $password = $_POST['Password'];
    
    if ($lgnObj->login($username, $password)) {
        header('Location: index.php');
    } else {
        echo $error = "<br><br><br><div class = 'container' ><span style='text-align: center'><h1 style = 'color:red'>Wrong Login Values</h1></div></span>";
    }  
}
?>


<!DOCTYPE html>
<html lang="en">

<head>    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <!-- App title -->
    <title>News Portal | Admin Panel</title>

    <!-- App css -->
    <link href="style.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="modern-business.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="bootstrap/css/core.css" rel="stylesheet" type="text/css" />
    <link href="bootstrap/css/components.css" rel="stylesheet" type="text/css" />
    <link href="bootstrap/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="bootstrap/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="bootstrap/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="bootstrap/css/responsive.css" rel="stylesheet" type="text/css" />

    <script src="bootstrap/js/modernizr.min.js"></script>

</head>


<body class="bg-transparent">
    
    
    

    <!-- HOME -->
    <section>
        <div class="container-alt">
            <div class="row">
                <div class="col-sm-12">

                    <div class="wrapper-page">

                        <div class="m-t-40 account-pages">
                            <div class="text-center account-logo-box">
                                <h2 class="text-uppercase">
                                        <span><p class="login-title"><?php echo $lang['LOGINP']; ?></p></span>
                                </h2>
                            </div>
                            <div class="account-content">
                                <form class="form-horizontal" method="post">

                                    <div class="form-group ">
                                        <div class="col-xs-12">
                                            <input class="form-control" type="text" required="" name="Username"
                                                placeholder="<?php echo $lang['USERNAME']; ?>">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <input class="form-control" type="password" name="Password" required=""
                                                placeholder="<?php echo $lang['PASSWORD']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group account-btn text-center m-t-10">
                                        <div class="col-xs-12">
                                            <button class="btn w-md btn-bordered btn-danger waves-effect waves-light"
                                                type="submit" name="submitted"><?php echo $lang['LOGIN']; ?></button>
                                        </div>
                                    </div>

                                </form>

                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <!-- end card-box-->
                    </div>
                    <!-- end wrapper -->
                </div>
            </div>
        </div>
    </section>
    <!-- END HOME -->

    <script>
        var resizefunc = [];
    </script>

    <!-- jQuery  -->
    <script src="bootstrap/js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/detect.js"></script>
    <script src="bootstrap/js/fastclick.js"></script>
    <script src="bootstrap/js/jquery.blockUI.js"></script>
    <script src="bootstrap/js/waves.js"></script>
    <script src="bootstrap/js/jquery.slimscroll.js"></script>
    <script src="bootstrap/js/jquery.scrollTo.min.js"></script>

    <!-- App js -->
    <script src="bootstrap/js/jquery.core.js"></script>
    <script src="bootstrap/js/jquery.app.js"></script>

</body>

</html>