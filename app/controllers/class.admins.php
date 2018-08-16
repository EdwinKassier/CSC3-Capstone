<?php
    class Admins extends Controller{
        public function __construct(){
            
        }

        public function admin(){
            $this->view('admin/');
        }
    }
?>