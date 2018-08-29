<?php
    require(APPROOT . "/phpmailer/class.mailconfig.php");

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require APPROOT . '/phpmailer/vendor/phpmailer/phpmailer/src/Exception.php';
    require APPROOT . '/phpmailer/vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require APPROOT . '/phpmailer/vendor/phpmailer/phpmailer/src/SMTP.php';
    
    // configure phpmailer
    function mail_config(){
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
        
        return $mail;
    }            
?>