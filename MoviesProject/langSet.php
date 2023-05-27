<?php

$currLang = "en";

if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = $currLang;
    
} else {
    $currLang = $_SESSION['lang'];

    if(isset($_GET['lang']))
        $currLang =  $_GET['lang']; 
}

$_SESSION['lang'] = $currLang;

switch ($currLang) {
    case "en":
        define("CHARSET", "ISO-8859-1");
        define("LANGCODE", "en");
        $langFile = $currLang.'.php';
        break;
    case "ar":
        define("CHARSET", "UTF-8");
        define("LANGCODE", "ar");
        $langFile = $currLang.'.php';
        break;
    case "fr":
        define("CHARSET", "UTF-8");
        define("LANGCODE", "fr");
        $langFile = $currLang.'.php';
        break;
    default:
        define("CHARSET", "ISO-8859-1");
        define("LANGCODE", "en");
        $langFile = $currLang.'.php';
        break;
}

header("Content-Type: text/html;charset=" . CHARSET);
header("Content-Language: " . LANGCODE);
include ('langs/'.$langFile);

?>

