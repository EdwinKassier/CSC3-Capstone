<?php
    //Load Config
    require_once 'config/config.php';

    //Autoload Libraries
    spl_autoload_register(function($class_name){
        require_once 'libraries/class.' . $class_name . '.php';
    });
?>