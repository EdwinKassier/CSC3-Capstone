<?php
    class Admins extends Controller{
        public function __construct(){
            
        }

        public function index($view = null){
            //Init data
            $data =[
                'view' => $view
            ];

            $this->view('admin/index', $data);
        }
    }
?>