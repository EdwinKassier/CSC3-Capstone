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
          <!-- Register -->
          <form class="" method="post">
                    <div class="container customContainer">
                        <h3>Sign Up</h3>
                        <?php //register_user(); ?>
                        <small class="text-muted">Please fill in this form to create an account.</small>
                        <hr>
                        <div class="form-group">
                            <label for="register_email"><b>Email:</b></label>
                            <input type="email" class="form-control" name="register_email" placeholder="Enter email" required>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-6 mb-3">
                            <label for="register_first_name"><b>First name</b></label>
                            <input type="text" class="form-control" name="register_first_name" placeholder="Enter first name" required>
                          </div>
                          <div class="form-group col-md-6 mb-3">
                            <label for="register_last_name"><b>Last name</b></label>
                            <input type="text" class="form-control" name="register_last_name" placeholder="Enter last name" required>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-6 mb-3">
                              <label for="register_password"><b>Password:</b></label>
                              <input type="password" class="form-control" name="register_password" placeholder="Enter password" required>
                          </div>
                          <div class="form-group col-md-6 mb-3">
                              <label for="cpassword"><b>Confirm password:</b></label>
                              <input type="password" class="form-control" name="cpassword" placeholder="Enter password"required>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-6 mb-3">
                              <label for="register_mobile_number"><b>Mobile number</b></label>
                              <input type="text" class="form-control" name="register_mobile_number" placeholder="012 345 6789" required>
                          </div>
                          <div class="form-group col-md-6 mb-3">
                              <label for="register_role"><b>Your role</b></label>
                              <select class="form-control" name="register_role" required>
                                <option selected>Choose...</option>
                                <option value='0'>Wind Farm</option>
                                <option value='1'>Ornithologist</option>
                              </select>
                          </div>
                        </div>  
                        <button type="submit" name="register" class="btn btn-custom">Sign up</button>
                        <button class="btn btn-custom" onclick="location.href='<?php echo URLROOT; ?>'" >Back</button>
                        <p class="text-muted">By creating an account you agree to our <a href="<?php echo URLROOT; ?>\resources\files\blackeagle_terms&conditions.pdf" target="_blank" style="color:dodgerblue">Terms & Conditions</a>.</p>
                    </div>
                </form>
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