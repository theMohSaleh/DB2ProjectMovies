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
        <title><?php echo $lang['LOGIN']; ?></title>
    </head>
    <body>
        
        <?php
        if (empty($_SESSION["userID"])){
         echo '<div><form action="" method="post">
           <p><h1>'.$lang['LOGINF'].' </h1> 
        <p>
           <p>'.$lang['USERNAME'].'  <input type="text" name="Username" /></p>
           <p>'.$lang['PASSWORD'].'    <input type="password" name="Password" /></p>
        </p>
        <p><input type="submit" name="submit" value="'.$lang['LOGIN'].'" /></p>
        
         <input type ="hidden" name="submitted" value="TRUE">
         </form></div>';   
        }
        ?>
    </body>
</html>