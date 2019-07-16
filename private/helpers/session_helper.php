<?php
    ob_start();

    session_start();    
    // session_destroy();

    //Flash message helper
    //EXAMPLE - flash('register_error', 'You are not registered', 'alert alert-success'); 
    //DISPLAY IN VIEW <?php echo flash('register_error');
    // function flash($name = '', $message = '', $class = 'alert alert-success'){
    //     if(!empty($name)){
    //         if(!empty($message) && empty($_SESSION[$name])){
    //             if(!empty($_SESSION[$name])){
    //                 unset($_SESSION[$name]);
    //             }
    //             if(!empty($_SESSION[$name . '_class'])){
    //                 unset($_SESSION[$name . '_class']);
    //             }
                
    //             $_SESSION[$name] = $message;
    //             $_SESSION[$name . '_class'] = $class;
    //         }
    //         else if(empty($message) && !empty($_SESSION[$name])){
    //             $class = !empty($_SESSION[$name . '_class']) ?  $_SESSION[$name . '_class']: '';
    //             echo '<div class="'. $class .'">'. $_SESSION[$name] .'</div>';
    //             unset($_SESSION[$name]);
    //             unset($_SESSION[$name . '_class']);
    //         }
    //     }
    // }

    function is_user_logged_in(){
        if(isset($_SESSION['user_id'])){
            return true;
        }
        else{
            return false;
        }
    }

    function is_admin_logged_in(){
        if(isset($_SESSION['admin_id'])){
            return true;
        }
        else{
            return false;
        }
    }
?>