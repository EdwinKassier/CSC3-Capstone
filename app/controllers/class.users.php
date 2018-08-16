<?php
    require(APPROOT . "/phpmailer/class.mailconfig.php");

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require APPROOT . '/phpmailer/vendor/phpmailer/phpmailer/src/Exception.php';
    require APPROOT . '/phpmailer/vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require APPROOT . '/phpmailer/vendor/phpmailer/phpmailer/src/SMTP.php';

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

                        redirect('users/registered');
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
                    //Check and set logged in user
                    $logged_in_user = $this->user_model->login($data);

                    if($logged_in_user){
                        //Create session
                        $this->create_user_session($logged_in_user);
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

        public function create_user_session($user){
            $_SESSION['user_id'] = $user->user_id;
            $_SESSION['user_name'] = $user->user_name;
            $_SESSION['user_surname'] = $user->user_surname;
            $_SESSION['user_email'] = $user->user_email;
            $_SESSION['user_mobile_number'] = $user->user_mobile_number;
            $_SESSION['user_role'] = $user->user_role;
            if($user->user_role == 0){
                redirect('users/wind_farm_dashboard');
            }
            else if($user->user_role == 1){
                redirect('users/ornithologist_dashboard');
            }
        }

        public function logout(){
            unset($_SESSION['user_id']);
            unset($_SESSION['user_name']);
            unset($_SESSION['user_surname']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_mobile_number']);
            unset($_SESSION['user_role']);
            unset($_SESSION['code']);
            session_destroy();
            
            redirect(URLROOT);
        }

        public function wind_farm_dashboard(){
            $this->view('users/wind_farm_dashboard');
        }

        public function ornithologist_dashboard(){
            $this->view('users/ornithologist_dashboard');
        }

        public function forgot_password($code = null){
            if(isset($code) && $code == $_SESSION['code']){
                //Check for post
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    //Sanitize POST data
                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                    //Init data
                    $data =[
                        'email' => trim($_POST['forgot_email']),
                        'email_check' => false,
                        'error' => '',
                    ];
                    $email = $data['email'];

                    //check email does exist in db already
                    if(empty($data['error']) && !$this->user_model->find_user_by_email($email)){
                        $data['error'] = "The entered email does not exist.";
                    }

                    //Ensure error is empty
                    if(empty($data['error'])){                    
                        $len = 50;
                        $token = bin2hex(openssl_random_pseudo_bytes($len));

                        if($this->user_model->set_token($token, $email)){

                            /**
                             * 
                             * configure phpmailer
                             * 
                             */
                            $mail = new PHPMailer();

                            $mail->IsSMTP();
                            //$mail->SMTPDebug = 4;
                            $mail->Host = MailConfig::SMTP_HOST;
                            $mail->Username = MailConfig::SMTP_USER;             
                            $mail->Password = MailConfig::SMTP_PASSWORD;   
                            $mail->Port = MailConfig::SMTP_PORT;      
                            //$mail->SMTPAuth = false;
                            //$mail->SMTPSecure = false;  
                            $mail->isHTML(true);      
                            $mail->CharSet = 'UTF-8';    
                            $mail->SMTPOptions = array(
                                'ssl' => array(
                                    'verify_peer' => false,
                                    'verify_peer_name' => false,
                                    'allow_self_signed' => true
                                )
                            );

                            //might need to remove in upload
                            $mail->SMTPSecure = 'tls';
                            $mail->SMTPAuth = true;

                            $mail->SetFrom("no-reply@blackeagleproject.co.za", "BlackEagle Project");
                            $mail->AddAddress($email);

                            $mail->Subject = "Reset password";
                            $mail->Body ='<p>Please click on the link to reset your password.</p>
                            <a href="'.URLROOT.'/users/reset_password/' . $email . '/' . $token . '">RESET PASSWORD</a>
                            <p>If the password change was not made by you, this email can be ignored.</p>';

                            if($mail->send()){
                                $data['email_check'] = true;    
                                $this->view('users/forgot_password', $data);                        
                            }
                        }
                    }
                    else{
                        //Load view
                        $this->view('users/forgot_password', $data);
                    }
                }
                else{
                    //Init data
                    $data =[
                        'email' => '',
                        'email_check' => false,
                        'error' => '',
                    ];

                    //Load view
                    $this->view('users/forgot_password', $data);
                }
            }
            
            else{
                //Load view
                redirect('');  
            }
        }

        public function reset_password(){
            $this->view('users/reset_password');
        }

        public function email_verified(){
            $this->view('users/email_verified');
        }

        public function registered(){
            $this->view('users/registered');
        }

        public function map(){
            $this->view('users/map');
        }
    }
?>