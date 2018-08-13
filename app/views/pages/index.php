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
        background-image: url('public/resources/images/homepage.png');        
    }
    </style>
  </head>

  <body>
    <div id="wrapper">

      <!-- Navbar -->
      <?php include(TEMPLATE_FRONT . DS . "navbar.php"); ?>

      <!-- Main Body -->
      <br>
      <main class="row" id="body">
        <div class="col-md-7" ></div>
        <div class="col-md-3" style="margin: auto; padding: 120px 0;">
          <div class="text-block" id="rcorners"> 
            <!-- Login -->
            <form class=""  method="post">
              <div class="container">
                  <h3>Login</h3>
                  <?php //login_user(); ?>
                  <hr style="background-color:white;">
                  <div class="form-group">
                    <label for="login_email"><b>Email:</b></label>
                    <input type="email" class="form-control" name="login_email" placeholder="Enter email" required>
                  </div>
                  <div class="form-group">
                    <label style="float: left" for="login_password"><b>Password:</b></label>
                    <label style="float: right"><a class="text-white" href="<?php echo URLROOT; ?>/pages/forgot_password/<?php //echo uniqid(true); ?>">Forgot password?</a></label>
                    <input type="password" class="form-control" name="login_password" placeholder="Enter password" required>
                  </div>
                  <!-- <div class="form-check">
                    <label class="form-check-label" style="padding-bottom:10px">
                        <input class="form-check-input" type="checkbox" value="1" name="remember"> Remember me
                    </label>
                  </div> -->
                  <div style="text-align: center;">
                    <button type="submit" name="login" class="col-md-6 btn btn-custom" >Login</button>
                  </div>
                  <hr style="background-color:white;margin-bottom:0">
                  <div style="text-align: center;">
                    <p style="margin:0">New?</p>
                  </div>
                  <hr style="background-color:white;margin-top:0">
                  <div style="text-align: center;">
                    <button class="col-md-6 btn btn-custom" style="align: center;" onclick="location.href='<?php echo URLROOT; ?>/pages/register'">Sign up</button>
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





    

      
        
      
      
      
      
    

    