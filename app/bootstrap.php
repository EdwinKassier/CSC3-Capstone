<?php
    //Load Config
    require_once 'config/config.php';

    //Load helpers
    require_once 'helpers/url_helper.php';
    require_once 'helpers/session_helper.php';
    require_once 'helpers/dynamic_html_helper.php';

    //Autoload Libraries
    spl_autoload_register(function($class_name){
        require_once 'libraries/class.' . $class_name . '.php';
    });
?>