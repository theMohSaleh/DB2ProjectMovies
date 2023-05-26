<?php
include_once 'header.php';

if (empty($_SESSION['userID'])) {
    header('Location: index.php');
    die();
}


include 'header.html';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>

    </body>
</html>
