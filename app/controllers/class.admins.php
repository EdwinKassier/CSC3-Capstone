<?php
    class Admins extends Controller{
        public function __construct(){
            $this->admin_model = $this->model('admin');
        }

        public function index($view = null){
            //Init data
            $data =[
                'view' => $view
            ];

            $this->view('admins/index', $data);
        }

        public function login(){
            $data = $_SESSION['data'];
            unset($_SESSION['data']);
            //check email does exist in db already
            if(empty($data['error']) && !$this->admin_model->find_admin_by_email($data['email'])){
                $data['error'] = "The entered email does not exist.";
            }

            //Ensure error is empty
            if(empty($data['error'])){
                //Check and set logged in admin
                $logged_in_admin = $this->admin_model->login($data);

                if($logged_in_admin){
                    //Create session
                    $this->create_admin_session($logged_in_admin);
                }
                else{
                    $data['error'] = "Incorrect password";
                    //Load view
                    $this->view('users/index', $data);
                }
            }
            else{
                //Load view
                $this->view('users/index', $data);
            }
        }

        public function create_admin_session($admin){
            $_SESSION['admin_id'] = $admin->admin_id;
            $_SESSION['admin_name'] = $admin->admin_name;
            $_SESSION['admin_surname'] = $admin->admin_surname;
            redirect('admins');
        }

        //Logs admin out
        public function logout(){
            unset($_SESSION['admin_id']);
            unset($_SESSION['admin_name']);
            unset($_SESSION['admin_surname']);
            session_destroy();
            
            redirect('');
        }
    }
?>