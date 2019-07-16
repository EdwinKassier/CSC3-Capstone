<?php
    //App core class. Creates URL & loads core controller
    
    class Core{
        protected $current_controller = 'users';
        protected $current_method = 'index';
        protected $params = [];

        public function __construct(){
            $url = $this->get_url();

            //Look in controllers for first value
            if(file_exists('../private/controllers/class.' . $url[0] . '.php')){
                $this->current_controller = $url[0];
                unset($url[0]);
            }

            //Require the controller
            require_once '../private/controllers/class.' . $this->current_controller . '.php';

            //Instantiate controller class
            $this->current_controller = new $this->current_controller;

            //Check second part of URL
            if(isset($url[1])){
                if(method_exists($this->current_controller, $url[1])){
                    $this->current_method = $url[1];
                    unset($url[1]);
                }
            }

            //Get params
            $this->params = $url ? array_values($url) : [];

            //Call a callback if array of params
            call_user_func_array([$this->current_controller, $this->current_method], $this->params);
        }

        //Gets the URL, sanitizes it and breaks it into parts
        public function get_url(){
            if(isset($_GET['url'])){
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);
                return $url;
            }
        }
    }
?>