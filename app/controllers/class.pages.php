<?php
class Pages extends Controller{
    public function __construct(){
        
    }

    public function index(){
        $this->view('pages/index');
    }

    public function about_us(){
        //also test class XD
        $posts = 'welcome';
        $data = ['title' => $posts];
        $this->view('pages/about_us', $data);
    }
}
?>