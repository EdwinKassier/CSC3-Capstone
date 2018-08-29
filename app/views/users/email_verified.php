<?php
require_once("../resources/config.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    
    <?php include(TEMPLATE_FRONT . DS . "header.php"); ?>

    <style>

    </style>
  </head>
  <body>
      <div id="wrapper">

      <!-- Navbar -->
      <?php include(TEMPLATE_FRONT . DS . "navbar.php"); ?>

      <!-- Main Body -->
      <div class="container" id="body">
        <br>        
        <div class="alert-danger text-center"><?php display_message(); ?></div>
        <br>     

            <?php
                if(!isset($_GET['email']) && !isset($_GET['token'])){
                    redirect("login_register");
                }
    
                $token = $_GET['token'];
                $email = $_GET['email'];
                
                if($stmt = mysqli_prepare($connection, 'SELECT user_id, email, token FROM users WHERE token=? AND email=?')){
                    mysqli_stmt_bind_param($stmt, "ss", $token, $email);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $user_id, $email, $token);
                    mysqli_stmt_fetch($stmt);
                    mysqli_stmt_close($stmt);
    
                    if($_GET['token'] !== $token && $_GET['email'] !== $email){
                        redirect("login_register");
                    }
    
                    $query = query("UPDATE users SET verified = '1' WHERE user_id = '{$user_id}' ");
                    confirm($query);
                }
            ?>

        <div class="row" >
            <div class="col-md-3"></div>
            <div class="col-md-6 col-md-offset-6 text-center">
                <h3>Email has been verified</h3>
                <button type="button" class="btn btn-lg btn-custom btn-block" onclick="location.href='login_register.php'">Login</button>
            </div>
        </div>
      </div>
      <br>
      
      <!-- Footer -->
      <?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>
      
    </div>

    <!-- Javascript -->
    <script>
    </script>
  </body>
</html>