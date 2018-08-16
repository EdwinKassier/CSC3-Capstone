<?php
    /**
     * 
     * configure phpmailer
     * 
     */
    $mail = new PHPMailer();

    $mail->IsSMTP();
    $mail->SMTPDebug = 4;
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
?>