<?php

include 'header.php';

if (isset($_POST['submitted'])) {

    $lgnObj = new Login();
    $username = $_POST['Username'];
    $password = $_POST['Password'];
    
    if ($lgnObj->login($username, $password)) {
        header('Location: index.php');
    } else {
        echo $error = 'Wrong Login Values';
    }  
}
include "header.html";
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
    </head>
    <body>
        
        <?php
        if (empty($_SESSION["userID"])){
         echo '<div><form action="" method="post">
           <p><h1>Login From</h1> 
        <p>
           <p>Username   <input type="text" name="Username" /></p>
           <p>Password    <input type="password" name="Password" /></p>
        </p>
        <p><input type="submit" name="submit" value="Login" /></p>
        
         <input type ="hidden" name="submitted" value="TRUE">
         </form></div>';   
        }
        ?>
    </body>
</html>