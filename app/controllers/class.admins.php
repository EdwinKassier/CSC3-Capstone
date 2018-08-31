<?php
    class Admins extends Controller{
        public function __construct(){
            $this->admin_model = $this->model('admin');
        }

        public function index($view = null){
            if($view == 'map'){
                //Init data
                $data =[
                    'view' => $view,

                ];  
            }
            else if($view == 'users'){
                //Init data
                $data =[
                    'view' => $view,
                    'pending_users' => $this->admin_model->get_pending_users(),
                ];  
            }
            else if($view == 'users_content'){
                //Init data
                $data =[
                    'view' => $view,
                    'users' => $this->admin_model->get_all_users(),
                ];  
            }
            else if($view == 'admin'){
                //Init data
                $data =[
                    'view' => $view,
                    'admins' => $this->admin_model->get_all_admins(),
                ];  
            }
            else{
                //Init data
                $data =[
                    'view' => $view,
                    'amount_pending_users' => $this->admin_model->amount_pending_users(),
                    'amount_nests' => $this->admin_model->amount_nests(),
                    'amount_ornothologists' => $this->admin_model->amount_ornothologists(),
                    'amount_wind_farms' => $this->admin_model->amount_wind_farms(),
                    'amount_admins' => $this->admin_model->amount_admins(),
                ];  
            }
            
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

        //validates a user
        public function validate_user($user){
            $this->admin_model->validate_user($user);
            
            set_message('User approved succesfully.');
            redirect('/admins/users');
        }

        //rejects a user
        public function reject_user($user){
            $this->admin_model->reject_user($user);
            
            set_message('User rejected succesfully.');
            redirect('/admins/users');
        }

        //remove a user
        public function remove_user($user){
            $this->admin_model->remove_user($user);
            
            set_message('User removed succesfully.');
            redirect('/admins/users_content');
        }
    }
?>