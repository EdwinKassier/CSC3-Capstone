<?php
    class Pages extends Controller{
        public function __construct(){
            
        }

        public function about(){
            $this->view('pages/about');
        }

        public function contact(){
            $this->view('pages/contact');
        }
    }
?>