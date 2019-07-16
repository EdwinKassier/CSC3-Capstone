<?php
    //Simple page redirtect
    function redirect($page){
        header('location: ' . URLROOT . '/' . $page);
    }
?>