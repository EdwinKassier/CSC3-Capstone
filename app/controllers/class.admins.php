<?php
    class Admins extends Controller{
        public function __construct(){
            $this->admin_model = $this->model('admin');
        }

        public function index($view = null, $admin_id = null){
            if($view == 'map'){
                //Init data
                $data =[
                    'view' => $view,
                    'nests' => $this->admin_model->get_nests(),
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
            else if($view == 'add_admin'){
                //Check for post
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    //Sanitize POST data
                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                    //Init data
                    $data =[
                        'view' => $view,
                        'name' => ucwords(trim($_POST['register_name'])),
                        'surname' => ucwords(trim($_POST['register_surname'])),
                        'email' => trim($_POST['register_email']),
                        'mobile_number' => trim(str_replace(' ','',$_POST['register_mobile_number'])),
                        'password' => trim($_POST['register_password']),
                        'confirm_password' => trim($_POST['register_confirm_password']),
                        'username' => strtolower(trim($_POST['register_name'])).strtolower(trim($_POST['register_surname'])).'@blackeagleadmin.co.za',
                        'error' => '',
                    ];

                    //check username doesn't exist in db already
                    if($this->admin_model->find_admin_by_username($data['username'])){
                        $data['error'] = "The entered username already exists.";
                    }
                    //check mobile number is the correct length
                    else if(strlen($data['mobile_number']) != 10){
                        $data['error'] = 'The mobile number is not the correct amount of numbers.';
                    }
                    //check passwords match or if too short
                    else if(strlen($data['password']) < 6){
                        $data['error'] = "The password is too short. Passwords must at least be 6 characters long.";
                    }
                    else if($data['password'] != $data['confirm_password']){
                        $data['error'] = 'The passwords do not match.';
                    }

                    //Ensure error is empty
                    if(empty($data['error'])){                    
                        //Hash password
                        $row = $this->admin_model->get_randSalt();
                        $salt = $row->randSalt;
                        $data['password'] = crypt($data['password'], $salt);

                        //Register admin
                        if($this->admin_model->register($data)){
                           set_message('Admin added succesfully.');
                           redirect('admins/admin');
                        }
                        else{
                            die('Something went wrong');
                        }
                    }
                }
                else{
                    //Init data
                    $data =[
                        'view' => $view,
                        'name' => '',
                        'surname' => '',
                        'email' => '',
                        'mobile_number' => '',
                        'password' => '',
                        'confirm_password' => '',
                        'username' => '',
                        'error' => '',
                    ];
                }
            }
            else if($view == 'edit_admin'){
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    //Sanitize POST data
                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
                    //Init data
                    $data =[
                        'view' => $view,
                        'id' => $admin_id,
                        'name' => ucwords(trim($_POST['update_name'])),
                        'surname' => ucwords(trim($_POST['update_surname'])),
                        'email' => trim($_POST['update_email']),
                        'mobile_number' => trim(str_replace(' ','',$_POST['update_mobile_number'])),
                        'username' => strtolower(trim($_POST['update_name'])).strtolower(trim($_POST['update_surname'])).'@blackeagleadmin.co.za',
                        'password' => trim($_POST['update_password']),
                        'confirm_password' => trim($_POST['update_confirm_password']),
                        'error' => '',
                    ];
                
                    $name = ucwords($data['name']);
                    $surname = ucwords($data['surname']);
                    $mobile_number = $data['mobile_number'];
                    $email = $data['email'];
                    $password = $data['password'];
                    $confirm_password = $data['confirm_password'];
                    $username = $data['username'];
        
                    if(strlen($mobile_number) != 10){
                        $data['error'] = "Mobile number must be an actual number.";
                    }
                    else if($password !== $confirm_password){
                        $data['error'] = "The entered passwords do not match.";
                        if(strlen($password) < 6){
                            $data['error'] = "Your password is too short. Passwords must at least be 6 characters long.";
                        }
                    }
    
                    $row = $this->admin_model->check_new_username_vs_old_username($username, $data['id']);
                    if($row != 'true' && $this->admin_model->find_admin_by_username($username)){
                        $data['error'] = "Your new username address is already registered.";
                    }
                    
                    if(empty($data['error'])){   
                        if($this->admin_model->edit_admin($data)){
                            if(!empty($password) && !empty($confirm_password)){
                                //Hash password
                                $row = $this->admin_model->get_randSalt();
                                $salt = $row->randSalt;
                                $password = crypt($password, $salt);
    
                                $this->admin_model->update_password($password, $username);
                            }
                            set_message("Admin details have been updated.");
                            $data['password'] = '';
                            $data['confirm_password'] = '';
                            redirect('admins/admin');
                        }
                        else{
                            die('Something went wrong.');
                        }
                    }
                }
                else{
                    $row = $this->admin_model->get_admin_data($admin_id);
                    if($row){
                        //Init data
                        $data =[
                            'id' => $admin_id,
                            'name' => $row->admin_name,
                            'surname' => $row->admin_surname,
                            'email' => $row->admin_email,
                            'mobile_number' => $row->admin_mobile_number,
                            'username' => $row->admin_username,
                            'password' => '',
                            'confirm_password' => '',
                            'error' => '',
                        ];
                    }
                    $data['view'] = $view;
                }
            }
            else{
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    //Sanitize POST data
                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                    $file = 'model';
    
                    //Init data
                    $data =[
                        'view' => $view,
                        'amount_pending_users' => $this->admin_model->amount_pending_users(),
                        'amount_nests' => $this->admin_model->amount_nests(),
                        'amount_ornothologists' => $this->admin_model->amount_ornothologists(),
                        'amount_wind_farms' => $this->admin_model->amount_wind_farms(),
                        'amount_admins' => $this->admin_model->amount_admins(),
                    ];

                    $file_extensions = ['rdt'];

                    if($_FILES[$file]['size'] !== 0 && $_FILES[$file]['error'] === 0){
                        $file_extension = strtolower(end(explode('.', $file_name)));
                    }

                    if($_FILES[$file]['size'] == 0){
                        $data['error'] = "Please choose a file.";
                    }
                    else if($_FILES[$file]['error'] === 1 || $_FILES[$file]['error'] === 2 ){
                        $data['error'] = "The chosen file is larger than 2MB. Please upload a file smaller than 2MB.";
                    }
                    else if(!in_array($file_extension, $file_extensions)) {
                        $data['error'] = "The file has an extension which is not allowed. Please upload an rdt file.";
                    }
                    
                    if(empty($data['error'])){   
                        $file_name = $_FILES['model']["name"];
                        $file_tmp_name = $_FILES['model']["tmp_name"];
                        $upload = URLROOT . DS . "resources/user_files/model/riskmod." . $file_extension;

                        if(file_exists($upload)){
                            unlink($upload);
                        }
                        move_uploaded_file($file_tmp_name, $upload);

                        set_message("The model has been changed succesfully.");
                        redirect('admins/admin');
                    }
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
            }
            
            $this->view('admins/index', $data);
        }

        public function login(){
            $data = $_SESSION['data'];
            unset($_SESSION['data']);
            //check email does exist in db already
            if(!$this->admin_model->find_admin_by_username($data['email'])){
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

        //remove a user
        public function remove_admin($admin){
            $this->admin_model->remove_admin($admin);
            
            set_message('Admin removed succesfully.');
            redirect('/admins/admin');
        }

        //Changes the saved model
        public function change_model(){
            
            set_message('Model changed succesfully.');
            redirect('/admins');
        }
    }
?>