<?php include 'header.php'?>

<?php

if (isset($_POST['submitted'])) {
    $user = new Users();
    $user->setUsername($_POST['userName']);
    $user->setPassword($_POST['password']);
    $user->setFirstName($_POST['firstName']);
    $user->setLastName($_POST['lastName']);
    $date=date('Y-m-d',strtotime($_POST['DOB']));
    $user->setDOB($date);
    $user->setRegDate(date('Y-m-d'));
    $user->setRoleID(2);
    
    if ($user->initWithUsername()) {

        if ($user->registerUser())
            echo 'Registered Successfully';
        else    
            echo '<p class="error"> Not Successfull </p>';
        
    }else {
        echo '<p class="error"> Username Already Exists </p>';
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

    <title>Register</title>

    <!-- Bootstrap core -->

    <!-- Custom styles for this template -->
    <link href="modern-business.css" rel="stylesheet">

  </head>

<body>
    <h1>User Registration</h1>
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
        <?php echo date('Y-m-d') ?>
    </form>    
    <div class="spacer"></div>;    
</div>   
</body>
</html>
<?php
include 'footer.html';
?>