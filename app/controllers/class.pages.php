<?php
class Pages extends Controller{
    public function __construct(){
        
    }

    public function index(){
        $this->view('pages/index');
    }

    public function about_us(){
        //also test class XD
        $data = ['title' => 'About us'];
        $this->view('pages/about_us', $data);

        
    }
}
?>