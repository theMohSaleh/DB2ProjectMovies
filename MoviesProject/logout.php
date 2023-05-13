<?php
include_once 'header.php';


$lgnObject = new Login();
$lgnObject->logout();

header('Location: index.php');
?>
