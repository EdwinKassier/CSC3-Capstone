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

        public function edit_user(){
            $this->view('pages/edit_user');
        }

        public function admin(){
            $this->view('admin/');
        }
    }
?>