<?php
    //App core class. Creates URL & loads core controller
    
    class Core{
        protected $current_controller = 'Pages';
        protected $current_method = 'index';
        protected $params = [];

        public function __construct(){
            $this->get_url();
        }

        public function get_url(){
            echo $_GET['url'];
        }
    }
?>