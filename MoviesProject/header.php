<?php


ini_set('show_errors', 'On');
ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

session_start();

/*
 * function __autoload($className){
 *
 *   include_once  $className.'.php';
 * }
 */


spl_autoload_register(
        
        function ($class_name) { 
            include $class_name . '.php';             
        }
);

?>
<html>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php"><img src="images/logo.PNG" height="50"></a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>                    
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Contact us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Post(Author Only?)</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="loginPage.php">Login</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
</html>
