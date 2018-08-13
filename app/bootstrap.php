<?php
    //Load Config
    require_once 'config/config.php';

    // require_once("class.site_functions.php");

    //Autoload Libraries
    spl_autoload_register(function($class_name){
        require_once 'libraries/class.' . $class_name . '.php';
    });
?>