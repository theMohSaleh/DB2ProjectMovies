<?php include 'header.php'?>

<?php

if (isset($_POST['submitted'])) {
    $user = new Users();
    $user->setUsername($_POST['Username']);
    $user->setPassword($_POST['Password']);
    $user->setFirstName($_POST['FirstName']);
    $user->setLastName($_POST['LastName']);
    $date=date('Y-m-d',strtotime($_POST['DOB']));
    $user->setDOB($date);
    $user->setRegDate(date('Y-m-d'));
    $user->setRoleID(2);
    
    if ($user->initWithUsername()) {

        if ($user->registerUser()){
        echo "<script>alert('Register Success!');</script>";
        }
        else {   
        echo "<script>alert('Invalid Details');</script>";
        }
        
    }else {
        echo "<script>alert('Username already exists!);</script>";
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
    <title>News Portal | Register </title>

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
    <link href="bootstrap/css/bootstrap-5.1.3.min.css" rel="stylesheet">
    <link href="bootstrap/css/font-awesome-4.7.0.min.css" rel="stylesheet" type="text/css">

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
                                        <span><p class="login-title">News Portal Register</p></span>
                                </h2>
                            </div>
                            <div class="account-content">
                                <form action="register.php" class="form-horizontal" method="post">

                                    <div class="form-group ">
                                        <div class="col-xs-12">
                                            <label> Username: </label>
                                            <input class="form-control" type="text" required="" name="Username">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <label> Password: </label>
                                            <input class="form-control" type="password" name="Password" required="">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <label> First Name: </label>
                                            <input class="form-control" type="text" name="FirstName" required="">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <label> Last Name: </label>
                                            <input class="form-control" type="text" name="LastName" required="">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <label> Date of birth: </label>
                                            <input class="form-control" type="date" name="DOB" >
                                        </div>
                                    </div>
                                    <div class="form-group account-btn text-center m-t-10">
                                        <div class="col-xs-12">
                                            <button class="btn w-md btn-bordered btn-danger waves-effect waves-light"
                                                type="submit" name="submitted"> Register </button>
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
<!--    <h1>User Registration</h1>
        <div id="stylized" class="myform"> 
            <form action="register.php" method="post">
                <fieldset>
                <label><b>Enter Username</b></label>
                <input type="text" name="userName" size="20" value="" />
                <label><b>Enter Password</b></label>
                <input type="password" name="password" size="10" value="" />
                <label><b>Enter First Name</b></label>
                <input type="text" name="firstName" size="10" value="" />
                <label><b>Enter Last Name</b></label>
                <input type="text" name="lastName" size="10" value="" />
                <label><b>Enter Date of birth</b></label>
                <input type="date" name="DOB" size="10" value="" />
                <div align="center">
                <input type ="submit" value ="Register" />
            </div>  
            <input type="hidden" name="submitted" value="1" />
        </fieldset>
    </form>    
    <div class="spacer"></div>;    
</div>   -->
</body>
<!-- Footer -->
      <?php include 'footer.html';?>
</html>
