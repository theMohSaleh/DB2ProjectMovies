<?php
ini_set('show_errors', 'On');
ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

session_start();

spl_autoload_register(
        function ($class_name) {
    include $class_name . '.php';
}
);
include 'langSet.php';
?>

<html>
    <head>
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="modern-business.css" rel="stylesheet">
        <script src="bootstrap/jquery/jquery.min.js"></script>
        <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    </head>

    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php"><img src="images/logo.PNG" height="50"></a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php"><?php echo $lang['MAIN_PAGE'] . ' ' . $_SESSION['userName']; ?></a>
                    </li>                    
                    <li class="nav-item">
                        <a class="nav-link" href="index.php"><?php echo $lang['News'] . ' ' . $_SESSION['userName']; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php"><?php echo $lang['ContactUs'] . ' ' . $_SESSION['userName']; ?></a>
                    </li>
                    <li class="nav-item">
                        <?php
// check if logged in user is an admin
                        if (isset($_SESSION['roleID']) && $_SESSION['roleID'] == '0') {
                            echo '<a class="nav-link" href="view_users.php"></a>';
                            echo '</li><li class="nav-item"><a class="nav-link" href="view_articles.php">(' . $lang['ManageAricles'] . ' ' . $_SESSION['userName'] . ')</a>';
                            echo '</li><li class="nav-item"><a class="nav-link" href="add_article.php">(' . $lang['Post'] . ' ' . $_SESSION['userName'] . ')</a>';
                        }
// check if logged in user is an author
                        if (isset($_SESSION['roleID']) && $_SESSION['roleID'] == '1') {
                            echo '<a class="nav-link" href="add_article.php">(' . $lang['Post'] . ' ' . $_SESSION['userName'] . ')</a>';
                        }
                        ?>
                    </li>
                    <li class="nav-item">
                        <?php
                        // check if user is not logged in using session variable
                        if ($_SESSION['userName'] == "") {
                            echo '<a class="nav-link" href="loginPage.php">(' . $lang['Login'] . ' ' . $_SESSION['userName'] . ')</a>';
                        } else {
                            echo '<a class="nav-link" href="logout.php">(' . $_SESSION['userName'] . ') Logout</a>';
                        }
                        ?>
                    </li>
                    <li class="nav-item">
                        <?php
                        if ($_SESSION['userName'] == "") {
                            echo '<a class="nav-link" href="register.php">(' . $lang['Register'] . ' ' . $_SESSION['userName'] . ')</a>';
                        }
                        ?>
                    </li>
                    <li class="nav-item">
                        <a href='<?php $_SERVER['PHP_SELF'] ?>?lang=ar'>AR</a>        
                        <a href='<?php $_SERVER['PHP_SELF'] ?>?lang=en'>EN</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</html>
