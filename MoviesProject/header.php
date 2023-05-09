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
