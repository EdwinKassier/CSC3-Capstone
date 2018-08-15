<?php
    class Users extends Controller{
        public function __construct(){
            $this->user_model = $this->model('user');
        }

        public function register(){
            //Check for post
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                //Init data
                $data =[
                    'name' => ucwords(trim($_POST['register_name'])),
                    'surname' => ucwords(trim($_POST['register_surname'])),
                    'email' => trim($_POST['register_email']),
                    'mobile_number' => trim(str_replace(' ','',$_POST['register_mobile_number'])),
                    'password' => trim($_POST['register_password']),
                    'confirm_password' => trim($_POST['register_confirm_password']),
                    'role' => $_POST['register_role'],
                    'error' => '',
                ];

                //check email doesn't exist in db already
                if(empty($data['error']) && $this->user_model->find_user_by_email($data['email'])){
                   $data['error'] = "The entered email already exists.";
                }

                //check mobile number is the correct length
                if(empty($data['error']) && strlen($data['mobile_number']) != 10){
                    $data['error'] = 'Your mobile number is not the correct amount of numbers.';
                }

                //check passwords match or if too short
                if(empty($data['error']) && strlen($data['password']) < 6){
                    $data['error'] = "Your password is too short.";
                }
                else if(empty($data['error']) && $data['password'] != $data['confirm_password']){
                    $data['error'] = 'Your passwords do not match.';
                }

                //Ensure error is empty
                if(empty($data['error'])){                    
                    //Hash password
                    $row = $this->user_model->get_randSalt();
                    $salt = $row->randSalt;
                    $data['password'] = crypt($data['password'], $salt);

                    //Register user
                    if($this->user_model->register($data)){
                        $row = $this->user_model->get_next_id();
                        $id = $row->Auto_increment - 1;

                        $upload_directory = UPLOAD_DIRECTORY . DS . $id . DS;

                        if(!is_dir($upload_directory)){
                            mkdir($upload_directory);
                        }  

                        redirect('pages/registered');
                    }
                    else{
                        die('Something went wrong');
                    }
                }
                else{
                    //Load view
                    $this->view('users/register', $data);
                }


            }
            else{
                //Init data
                $data =[
                    'name' => '',
                    'surname' => '',
                    'email' => '',
                    'mobile_number' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'role' => '',
                    'error' => '',
                ];

                //Load view
                $this->view('users/register', $data);
            }
        }

        public function index(){
            //Check for post
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                //Init data
                $data =[
                    'email' => trim($_POST['login_email']),
                    'password' => trim($_POST['login_password']),
                    'error' => '',
                ];

                //check email does exist in db already
                if(empty($data['error']) && !$this->user_model->find_user_by_email($data['email'])){
                    $data['error'] = "The entered email does not exist.";
                }

                //Ensure error is empty
                if(empty($data['error'])){
                    die('SUCCESS');
                }
                else{
                    //Load view
                    $this->view('users/index', $data);
                }
            }
            else{
                //Init data
                $data =[
                    'email' => '',
                    'password' => '',
                    'error' => '',
                ];

                //Load view
                $this->view('users/index', $data);
            }
        }
    }
?>