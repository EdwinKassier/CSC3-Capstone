<html lang="en">
  <head>
    <?php include(TEMPLATE_FRONT . DS . "header.php"); ?>
    <style>

    .text-block {
        color: white;
        background-color: rgba(0,0,0,0.7);
        padding: 20px;
    }

    body {
        background-image: url('<?php echo URLROOT; ?>/public/resources/images/homepage.png');        
    }
    </style>
  </head>

  <body>
    <?php
      if(is_logged_in()){
        if($_SESSION['user_role'] == 0){
          redirect('users/wind_farm_dashboard');
        }
        else if($_SESSION['user_role'] == 1){
          redirect('users/ornithologist_dashboard');
        }
      }
    ?>
    <div id="wrapper">

      <!-- Navbar -->
      <?php include(TEMPLATE_FRONT . DS . "navbar.php"); ?>

      <!-- Main Body -->
      <br>
      <main class="row" id="body">
        <div class="col-md-7" ></div>
        <div class="col-md-4" style="margin: auto; padding: 0;">
          <div class="text-block" id="rcorners"> 
            <!-- Login -->
            <form action="<?php echo URLROOT; ?>/users/index"  method="post">
              <div class="container">
                <div class="alert-danger text-center"><?php echo $data['error']; ?></div>
                <br>
                <h3>Login</h3>
                <hr style="background-color:white;">
                <div class="form-group">
                  <label for="login_email"><b>Email:</b></label>
                  <input type="email" class="form-control" name="login_email" value="<?php echo $data['email']; ?>" placeholder="Enter email" required>
                </div>
                <div class="form-group">
                  <label style="float: left" for="login_password"><b>Password:</b></label>
                  <label style="float: right"><a class="text-white" href="<?php echo URLROOT; ?>/users/forgot_password/<?php echo uniqid(true); ?>">Forgot password?</a></label>
                  <input type="password" class="form-control" name="login_password" value="<?php echo $data['password']; ?>"  placeholder="Enter password" required>
                </div>
                <!-- <div class="form-check">
                  <label class="form-check-label" style="padding-bottom:10px">
                      <input class="form-check-input" type="checkbox" value="1" name="remember"> Remember me
                  </label>
                </div> -->
                <div style="text-align: center;">
                  <button type="submit" name="login" class="col-md-5 btn btn-custom" >Login</button>
                </div>
                <hr style="background-color:white;margin-bottom:0">
                <div style="text-align: center;">
                  <p style="margin:0">New?</p>
                </div>
                <hr style="background-color:white;margin-top:0">
                <div style="text-align: center;">
                  <button type="reset" class="col-md-5 btn btn-custom" style="align: center;" onclick="location.href='<?php echo URLROOT; ?>/users/register'">Sign up</button>
                </div>
              </div>
            </form>
          </div>
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





    

      
        
      
      
      
      
    

    