<?php
/******************************* HELPER FUNCTIONS *******************************/

function set_message($msg){
    if(!empty($msg)){
        $_SESSION['message'] = $msg;
    }
    else{
        $msg = "";
    }
}

function display_message(){
    if(isset($_SESSION['message'])){
       
        echo $_SESSION['message'];
        unset($_SESSION['message']);

    }
}

function redirect($location){
    header("Location: $location ");
    exit();
}

function if_it_is_method($method=null){
    if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){
        return true;
    }
    return false;
}

function is_logged_in(){
    if(isset($_SERVER['user_id'])){
        return true;
    }
    return false;
}

function check_if_user_is_logged_in_and_redirect($redirect_location=null){
    if(is_logged_in()){
        redirect($redirect_location);
    }
}

function query($sql){
    global $connection;

    return mysqli_query($connection, $sql);
}

function confirm($result){
    global $connection;

    if(!$result){
        die("QUERY FAILED" . mysqli_error($connection));
    }
}

function email_exists($email){
    $query = query("SELECT email FROM users WHERE email = '$email'");
    confirm($query);

    if(mysqli_num_rows($query) > 0) {
        return true;
    } else {
        return false;
    }
}

function escape_string($string){
    global $connection;

    return mysqli_real_escape_string($connection, $string);
}

function fetch_array($result){
    return mysqli_fetch_array($result);
}

function checked($query){
    $pos = strpos($query, "SET") + 3;
    $len = strlen($query);

    $str1 = substr($query,0,$pos);
    $str2 = substr($query,$pos+1,$len);

    return $str1.$str2;
}

/******************************* FRONT END *******************************/

/******************************* BACK END *******************************/