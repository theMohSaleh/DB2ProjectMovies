<?php
include_once 'header.php';

session_start();

$lgnObject = new Login();
$lgnObject->logout();

header('Location: index.php');
?>
