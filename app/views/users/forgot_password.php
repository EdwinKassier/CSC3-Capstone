<?php include(TEMPLATE_FRONT . DS . "phpmailer.php"); ?>
<html lang="en">
    <head>
        <?php include(TEMPLATE_FRONT . DS . "header.php"); ?>
    </head>

    <body>
        <div id="wrapper">

        <!-- Navbar -->
        <?php include(TEMPLATE_FRONT . DS . "navbar.php"); ?>

        <!-- Main Body -->
        <br>
        <main role="main" class="container" id="body">
        <br>
        <div class="alert-danger text-center"><?php display_message(); ?></div>
        <br>

        <?php  
            
            if(!isset($_GET['forgot'])){
                redirect("../login_register");
            }

            $email_sent = false;

            if(if_it_is_method('post')){
                if(isset($_POST['email'])){
                    $email = $_POST['email'];
                    $len = 50;
                    $token = bin2hex(openssl_random_pseudo_bytes($len));

                    if(email_exists($email)){
                        if($stmt = mysqli_prepare($connection, "UPDATE users SET token='{$token}' WHERE email= ?" )){
                            mysqli_stmt_bind_param($stmt, "s", $email);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_close($stmt);

                            /**
                             * 
                             * configure phpmailer
                             * 
                             */

                            $mail = new PHPMailer();

                            $mail->IsSMTP();
                            //$mail->SMTPDebug = 4;
                            $mail->Host = config::SMTP_HOST;
                            $mail->Username = config::SMTP_USER;             
                            $mail->Password = config::SMTP_PASSWORD;   
                            $mail->Port = config::SMTP_PORT;      
                            $mail->SMTPAuth = false;
			                $mail->SMTPSecure = false;  
                            $mail->isHTML(true);      
                            $mail->CharSet = 'UTF-8';    
                            $mail->SMTPOptions = array(
                                'ssl' => array(
                                    'verify_peer' => false,
                                    'verify_peer_name' => false,
                                    'allow_self_signed' => true
                                )
                            );

                            $mail->SetFrom("no-reply@blackeagleproject.co.za", "BlackEagle Project");
                            $mail->AddAddress($email);

                            $mail->Subject = "Reset password";
                            $mail->Body ='<p>Please click on the link to reset your password.</p>
                            <a href="'.URLROOT.'/users/reset_password.php?email=' . $email . '&token=' . $token . '">RESET PASSWORD</a>
                            <p>If the password change was not made by you, this email can be ignored.</p>';

                            if($mail->send()){
                                $email_sent = true;                              
                            }
                        }
                    }
                    else{
                        set_message("This email doesn't exist.");
                        redirect($_SERVER['REQUEST_URI']);
                    }
                }
            }
        ?>

       
        <div class="row" >
            <div class="col-md-3"></div>
            <div class="col-md-6 col-md-offset-6 text-center">
                <?php if(!($email_sent)): ?>
                <h2 class="text-center">Forgot Password?</h2>
                <p>You can reset your password here.</p>
                <div class="panel-body">

                    <form id="register-form" class="" method="post">

                        <div class="form-group">
                            <div class="input-group">
                                <input id="email" name="email" placeholder="Enter email" class="form-control"  type="email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <input name="recover-submit" class="btn btn-lg btn-custom btn-block" value="Reset Password" type="submit">
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-lg btn-custom col-md-12 btn-block" onclick="location.href='../login_register'">Back</button>
                        </div>

                        <input type="hidden" class="hide" name="token" id="token" value="">
                    </form>
                </div>
                <?php else: ?>
                <h3>Please check your inbox and/or junkmail for our email.</h3>
                <button type="button" class="btn btn-lg btn-custom btn-block" onclick="location.href='../login_register'">Back</button>
                <?php endIf; ?>
            </div>









        </main>
        <br>

        <!-- Footer -->
        <?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>

        </div>
        <!-- Javascript -->
        <script>
        </script>
    </body>
</html>