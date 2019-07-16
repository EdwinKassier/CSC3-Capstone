<?php
    //Base controller. This loads the models and views
    class Controller{
        //Load model
        public function model($model){
            require_once '../private/models/class.' . $model . '.php';
            return new $model();
        }

        //Load view
        public function view($view, $data = []){
            if(file_exists('../private/views/' . $view . '.php')){
                require_once '../private/views/' . $view . '.php';
            }
            else{
                die("View doesn't exist");
            }
        }
    }
?>