<!--This is the pages controller class, it inherits from the main controller class-->
<?php
    class Pages extends Controller{
        //Loads the about view
        public function about(){
            $this->view('pages/about');
        }

        //Loads the contact view, sends through any data it needs & executes all contact related processes
        public function contact(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                //Init data
                $data =[
                    'name' => ucwords(trim($_POST['name'])),
                    'surname' => ucwords(trim($_POST['surname'])),
                    'phone' => trim($_POST['phone']),
                    'message' => trim($_POST['message']),
                    'email' => trim($_POST['email']),
                ];

                // require ReCaptcha class
                require(APPROOT . 'recaptcha/src/autoload.php');

                // configure
                $from = 'contactform@blackeagle.co.za';
                $sendTo = 'support@blackeagle.co.za';
                $subject = 'Message from contact form';
                $fields = array($data['name'] => 'Name', $data['surname'] => 'Surname', $data['phone'] => 'Phone', $data['email'] => 'Email', $data['message'] => 'Message'); // array variable name => Text to appear in the email
                $okMessage = 'Contact form successfully submitted. Thank you, I will get back to you soon!';
                $errorMessage = 'There was an error while submitting the form. Please try again later';
                $recaptchaSecret = 'ENTER SECRET KEY HERE';

                //Checking if recaptcha is set
                try {
                    if (!isset($_POST['g-recaptcha-response'])) {
                        throw new \Exception('ReCaptcha is not set.');
                    }
                    
                    $recaptcha = new \ReCaptcha\ReCaptcha($recaptchaSecret, new \ReCaptcha\RequestMethod\CurlPost());
                                        
                    $response = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

                    if (!$response->isSuccess()) {
                        throw new \Exception('ReCaptcha was not validated.');
                    }
                                        
                    $emailText = "You have a new message from your contact form\n=============================\n";

                    foreach ($_POST as $key => $value) {
                        if (isset($fields[$key])) {
                            $emailText .= "$fields[$key]: $value\n";
                        }
                    }
                
                    // All the neccessary headers for the email.
                    $headers = array('Content-Type: text/plain; charset="UTF-8";',
                        'From: ' . $from,
                        'Reply-To: ' . $from,
                        'Return-Path: ' . $from,
                    );
                    
                    // Send email
                    mail($sendTo, $subject, $emailText, implode("\n", $headers));

                    $responseArray = array('type' => 'success', 'message' => $okMessage);
                } catch (\Exception $e) {
                    $responseArray = array('type' => 'danger', 'message' => $e->getMessage());
                }

                if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                    $encoded = json_encode($responseArray);

                    header('Content-Type: application/json');

                    echo $encoded;
                } else {
                    echo $responseArray['message'];
                }

                $this->view('pages/contact');
            }
            else{
                $this->view('pages/contact');
            }
        }

        //Loads the FAQ view
        public function FAQ(){
            $this->view('pages/FAQ');
        }
    }
?>