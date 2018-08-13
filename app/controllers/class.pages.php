<?php
class Pages extends Controller{
    public function __construct(){
        
    }

    public function index(){
        $this->view('pages/index');
    }

    public function about(){
        $this->view('pages/about');
    }

    public function contact(){
        $this->view('pages/contact');
    }

    public function register(){
        $this->view('pages/register');
    }

    public function edit_user(){
        $this->view('pages/edit_user');
    }

    public function wind_farm_dashboard(){
        $this->view('pages/wind_farm_dashboard');
    }

    public function ornothologist_dashboard(){
        $this->view('pages/ornothologist_dashboard');
    }

    public function forgot_password(){
        $this->view('pages/forgot_password');
    }

    public function reset_password(){
        $this->view('pages/reset_password');
    }

    public function email_verified(){
        $this->view('pages/email_verified');
    }

    public function registered(){
        $this->view('pages/registered');
    }

    public function admin(){
        $this->view('pages/admin/');
    }
}
?>