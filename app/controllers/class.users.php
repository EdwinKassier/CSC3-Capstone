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
                    'organization_name' => trim($_POST['register_organization_name']),
                    'organization_number' => trim($_POST['register_organization_number']),
                    'error' => '',
                ];

                //check email doesn't exist in db already
                if($this->user_model->find_user_by_email($data['email'])){
                   $data['error'] = "The entered email already exists.";
                }
                //check mobile number is the correct length
                else if(strlen($data['mobile_number']) != 10){
                    $data['error'] = 'Your mobile number is not the correct amount of numbers.';
                }
                //check passwords match or if too short
                else if(strlen($data['password']) < 6){
                    $data['error'] = "Your password is too short. Passwords must at least be 6 characters long.";
                }
                else if($data['password'] != $data['confirm_password']){
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
                        if($data['role'] == '0'){
                            $row = $this->user_model->get_next_id();
                            $id = $row->Auto_increment - 1;

                            $upload_directory = UPLOAD_DIRECTORY . DS . $id . DS;

                            if(!is_dir($upload_directory)){
                                mkdir($upload_directory);
                            }  
                        }

                        $len = 50;
                        $email = $data['email'];
                        $token = bin2hex(openssl_random_pseudo_bytes($len));

                        if($this->user_model->set_token($token, $email)){
                            $mail = mail_config();
                            $mail->AddAddress($email);

                            $mail->Subject = "Verify email";
                            $mail->Body ='<p>Welcome to the BlackEagle community.</p>
                            <p>Please click on the link to verify your email.</p>
                            <a href="'.URLROOT.'/users/email_verified/' . $email . '/' . $token . '">VERIFY EMAIL</a>';

                            if($mail->send()){
                                $_SESSION['registered'] = true;
                                redirect('users/registered');                      
                            }
                        }
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
                    'organization_name' => '',
                    'organization_number' => '',
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

                //check if admin
                if(strpos($data['email'], '@blackeagleadmin.co.za') !== false){
                    $_SESSION['data'] = $data;
                    //Load view
                    redirect('admins/login');
                }

                //check email does exist in db already
                if(!$this->user_model->find_user_by_email($data['email'])){
                    $data['error'] = "The entered email does not exist.";
                }
                //check email verified
                else if(!$this->user_model->check_verified($data['email'])){
                    $data['error'] = "The entered email has not been verified yet. Please check your inbox and verify your email.";
                }
                //check user approved
                else if(!$this->user_model->check_approved($data['email'])){
                    $data['error'] = "Your account has not been approved by an admin yet. We will email you when your account has been approved/rejected.";
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

        //Edits user details
        public function edit_user(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                //Init data
                $data =[
                    'name' => ucwords(trim($_POST['update_first_name'])),
                    'surname' => ucwords(trim($_POST['update_last_name'])),
                    'email' => trim($_POST['update_email']),
                    'mobile_number' => trim(str_replace(' ','',$_POST['update_mobile_number'])),
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
    
                if(strlen($mobile_number) != 10){
                    $data['error'] = "Mobile number must be an actual number.";
                    $this->view('users/edit_user', $data);
                }
                if($password !== $confirm_password){
                    $data['error'] = "The entered passwords do not match.";
                    $this->view('users/edit_user', $data);
                    if(strlen($password) < 6){
                        $data['error'] = "Your password is too short. Passwords must at least be 6 characters long.";
                        $this->view('users/edit_user', $data);
                    }
                }

                $row = $this->user_model->check_new_email_vs_old_email($email);
                if($row != 'true' && $this->user_model->find_user_by_email($email)){
                    $data['error'] = "Your new email address is already registered.";
                    $this->view('users/edit_user', $data);
                }
                
                if(empty($data['error'])){
                    if($row != 'true' && !$this->user_model->find_user_by_email($email)){
                        $len = 50;
                        $token = bin2hex(openssl_random_pseudo_bytes($len));

                        $this->user_model->set_token($token, $row);
                        $mail = mail_config();
                        $mail->AddAddress($email);

                        $mail->Subject = "Verify email";
                        $mail->Body ='<p>Welcome to the BlackEagle community.</p>
                        <p>Please click on the link to verify your email.</p>
                        <a href="'.URLROOT.'/users/email_verified/' . $email . '/' . $token . '">VERIFY EMAIL</a>';

                        $mail->send();
                        $this->user_model->email_unverified($row);
                    }

                    if($this->user_model->edit_user($data)){
                        if(!empty($password) && !empty($confirm_password)){
                            //Hash password
                            $row = $this->user_model->get_randSalt();
                            $salt = $row->randSalt;
                            $password = crypt($password, $salt);

                            $this->user_model->update_password($password, $email);
                        }
                        set_message("Your details have been updated. If you changed your email, an email has been sent to you to verify your new email.");
                        $data['password'] = '';
                        $data['confirm_password'] = '';
                        $this->view('users/edit_user', $data);
                    }
                    else{
                        die('Something went wrong.');
                    }
                }
            }
            else{
                $row = $this->user_model->get_user_data();
                if($row){
                    //Init data
                    $data =[
                        'name' => $row->user_name,
                        'surname' => $row->user_surname,
                        'email' => $row->user_email,
                        'mobile_number' => $row->user_mobile_number,
                        'password' => '',
                        'confirm_password' => '',
                        'error' => '',
                    ];
                }
                
                $this->view('users/edit_user', $data);
            }
        }

        public function create_user_session($user){
            $_SESSION['user_id'] = $user->user_id;
            $_SESSION['user_role'] = $user->user_role;
            if($user->user_role == 0){
                redirect('users/wind_farm_dashboard');
            }
            else if($user->user_role == 1){
                redirect('users/ornithologist_dashboard');
            }
        }

        //Logs user out
        public function logout(){
            unset($_SESSION['user_id']);
            unset($_SESSION['user_role']);
            unset($_SESSION['code']);
            session_destroy();
            
            redirect('');
        }
      
        public function ornithologist_dashboard($role = null){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                $data =[
                    'nests' => $this->user_model->get_pins('0'),
                    'sites' => $this->user_model->get_pins('1'),
                ];
                $_SESSION['message_modal'] = true;

                //Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $file = 'pins';
                $latitude = trim($_POST['latitude']);
                $longitude = trim($_POST['longitude']);
                if(isset($_POST['name'])){
                    $name = trim(ucwords($_POST['name']));
                }
                else{
                    $name = null;
                }
                
                if($_FILES[$file]['size'] == 0 && empty($latitude) && empty($longitude)){
                    set_message('Please enter either a csv or the latitude and longitude.');
                    redirect('users/ornithologist_dashboard');
                }
                else{
                    if($_FILES[$file]['size'] == 0 && !empty($latitude) && empty($longitude) || empty($file) && empty($latitude) && !empty($longitude)){
                        set_message('Please full in both latitude and longitude.');
                        redirect('users/ornithologist_dashboard');
                    }
                    else if($_FILES[$file]['size'] == 0 && !empty($latitude) && !empty($longitude)){
                        $this->user_model->add_pin($role, $latitude, $longitude, $name);

                        set_message("Your pin was successfully uploaded.");
                        redirect('users/ornithologist_dashboard');
                    }
                    else if($_FILES[$file]['size'] !== 0 && $_FILES[$file]['error'] === 0 && empty($latitude) && empty($longitude)){
                        $tmp_name = $_FILES[$file]['tmp_name'];
                        $csv_array = array_map('str_getcsv', file($tmp_name));

                        $file_extensions = ['csv'];
                        $file_extension = strtolower(end(explode('.', $file_name)));
    
                        if($_FILES[$file]['error'] === 1 || $_FILES[$file]['error'] === 2 ){
                            set_message("The chosen file is larger than 2MB. Please upload a file smaller than 2MB.");
                        }
                        else if(!in_array($file_extension, $file_extensions)) {
                            set_message("The file has an extension which is not allowed. Please upload an csv file.");
                        }

                        foreach($csv_array as $row) {
                            $row = explode(';', $row[0]);
                            if(strtolower($row[0]) != 'latitude' && strtolower($row[1]) != 'longitude'){
                                $this->user_model->add_pin($role, $row[0], $row[1], $name);
                            }
                        }

                        set_message("Your pins were successfully uploaded.");
                        redirect('users/ornithologist_dashboard');
                    }  
                    else{
                        set_message('Please input only a csv or latitude and longitude, not all at once.');
                        redirect('users/ornithologist_dashboard');
                    }
                }
            }
            else{
                $data =[
                    'nests' => $this->user_model->get_pins('0'),
                    'sites' => $this->user_model->get_pins('1'),
                ];
                $this->view('users/ornithologist_dashboard', $data);
            } 
        }

        public function wind_farm_dashboard(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                $data =[
                    'reports' => $this->user_model->get_reports(),
                ];
                $_SESSION['message_modal'] = true;

                //Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $shp = 'shp';
                $shx = 'shx';
                $dbf = 'dbf';
                $sbn = 'sbn';
                $sbx = 'sbx';
                $prj = 'prj';
                $name = trim(ucwords($_POST['name']));
                
                if($_FILES[$shp]['size'] == 0 && $_FILES[$shp]['error'] == 0 && $_FILES[$shx]['size'] == 0 && $_FILES[$shx]['error'] == 0 && $_FILES[$dbf]['size'] == 0 && $_FILES[$dbf]['error'] == 0){
                    set_message('Please upload all the required files. (.shp, .shx, .dbf)');
                    redirect('users/wind_farm_dashboard');
                }
                else{
                    $file_extensions = ['shp, shx, dbf, sbn, sbx, prj, no_extension_here'];

                    $shp_name = $_FILES[$shp]['tmp_name'];
                    $shp_extension = strtolower(end(explode('.', $shp_name)));

                    $shx_name = $_FILES[$shx]['tmp_name'];
                    $shx_extension = strtolower(end(explode('.', $shx_name)));

                    $dbf_name = $_FILES[$dbf]['tmp_name'];
                    $dbf_extension = strtolower(end(explode('.', $dbf_name)));

                    $sbn_extension = 'no_extension_here';
                    $sbx_extension = 'no_extension_here';
                    $prj_extension = 'no_extension_here';
                    if($_FILES[$sbn]['size'] !== 0){
                        $sbn_name = $_FILES[$sbn]['tmp_name'];
                        $sbn_extension = strtolower(end(explode('.', $sbn_name)));
                    }
                    if($_FILES[$sbx]['size'] !== 0){
                        $sbx_name = $_FILES[$sbx]['tmp_name'];
                        $sbx_extension = strtolower(end(explode('.', $sbx_name)));
                    }
                    if($_FILES[$prj]['size'] !== 0){
                        $prj_name = $_FILES[$prj]['tmp_name'];
                        $prj_extension = strtolower(end(explode('.', $prj_name)));
                    }
                
                    if(($_FILES[$shp]['error'] === 1 || $_FILES[$shp]['error'] === 2) || ($_FILES[$shx]['error'] === 1 || $_FILES[$shx]['error'] === 2) || ($_FILES[$dbf]['error'] === 1 || $_FILES[$dbf]['error'] === 2) || ($_FILES[$sbn]['error'] === 1 || $_FILES[$sbn]['error'] === 2) || ($_FILES[$sbx]['error'] === 1 || $_FILES[$sbx]['error'] === 2) || ($_FILES[$prj]['error'] === 1 || $_FILES[$prj]['error'] === 2)){
                        set_message("One/muiltiple of the files are larger than 2MB. Please upload files smaller than 2MB.");
                        redirect('users/wind_farm_dashboard');
                    }
                    else if((!in_array($shp_extension, $file_extensions)) || (!in_array($shx_extension, $file_extensions)) || (!in_array($dbf_extension, $file_extensions)) || (!in_array($sbn_extension, $file_extensions)) || (!in_array($sbx_extension, $file_extensions)) || (!in_array($prj_extension, $file_extensions))) {
                        set_message("One/muiltiple of the files have an extension which is not allowed. Please only upload .shp, .shx, .dbf, .sbn, .sbx or .prj files.");
                        redirect('users/wind_farm_dashboard');
                    }
                    else{
                        

                        set_message("Your site is being added. This process will take some time, please come back in 10-15 minutes and your site will have been added.");
                        redirect('users/wind_farm_dashboard');
                    }
                }
            }
            else{
                $data =[
                    'reports' => $this->user_model->get_reports(),
                ];
                $this->view('users/wind_farm_dashboard');
            }
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
                    if(!$this->user_model->find_user_by_email($email)){
                        $data['error'] = "The entered email does not exist.";
                    }

                    //Ensure error is empty
                    if(empty($data['error'])){                    
                        $len = 50;
                        $token = bin2hex(openssl_random_pseudo_bytes($len));

                        if($this->user_model->set_token($token, $email)){
                            $mail = mail_config();
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

        //This class will check that the correct params are recieved. If yes then the password can be updated. Also updates password.
        public function reset_password($email = null, $token = null){
            if(isset($email) && isset($token) && $this->user_model->check_token($token, $email)){

                //Check for post
                if($_SERVER['REQUEST_METHOD'] == 'POST'){

                    //Sanitize POST data
                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                    //Init data
                    $data =[
                        'password_check' => false,
                        'error' => '',
                    ];
                    $password = $_POST['password'];
                    $confirm_password = $_POST['confirm_password'];

                    //check passwords match or if too short
                    if(strlen($password) < 6){
                        $data['error'] = "Your password is too short. Passwords must at least be 6 characters long.";
                        $this->view('users/reset_password', $data);
                    }
                    else if($password !== $confirm_password){
                        $data['error'] ="The passwords do not match.";
                        $this->view('users/reset_password', $data);
                    }

                    //Ensure error is empty
                    if(empty($data['error'])){   
                        //Hash password
                        $row = $this->user_model->get_randSalt();
                        $salt = $row->randSalt;
                        $password = crypt($password, $salt);

                        if($this->user_model->update_password($password, $email)){
                            $data['password_check'] = true;    
                            $this->user_model->remove_token($email);
                            $this->view('users/reset_password', $data);  
                        }
                        else{
                            die('Something went wrong');
                        }
                    }
                }   
                else{
                    //Init data
                    $data =[
                        'password_check' => false,
                        'error' => '',
                    ];

                    //Load view
                    $this->view('users/reset_password', $data);
                }
            }
            else{
                //Load view
                redirect('');
            }
        }

        public function email_verified($email = null, $token = null){
            if(isset($email) && isset($token) && $this->user_model->check_token($token, $email)){
                if($this->user_model->email_verified($email)){
                    $this->user_model->remove_token($email);
                    $this->view('users/email_verified');  
                }
                else{
                    die('Something went wrong');
                }
            }
            else{
                //Load view
                redirect('');
            }
        }

        public function registered(){
            $this->view('users/registered');
        }
    }
?>