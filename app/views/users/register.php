<html lang="en">
  <head>
    <?php include(TEMPLATE_FRONT . DS . "header.php"); ?>
  </head>

  <body>

    <?php
        if(is_logged_in()){
        redirect('');
        }
    ?>

    <div id="wrapper">

      <!-- Navbar -->
      <?php include(TEMPLATE_FRONT . DS . "navbar.php"); ?>

      <!-- Main Body -->
      <br>
      <main role="main" class="container" id="body">
          <!-- Register -->
          <form action="<?php echo URLROOT; ?>/users/register" method="post">
            <div class="container customContainer">
              <div class="alert-danger text-center"><?php echo $data['error']; ?></div>
              <br>
              <h3>Sign Up</h3>
              <small class="text-muted">Please fill in this form to create an account.</small>
              <hr>
              <div class="form-group">
                <label for="register_email"><b>Email:</b></label>
                <input type="email" class="form-control" name="register_email" value="<?php echo $data['email']; ?>" placeholder="Enter email" required>
              </div>
              <div class="row">
                <div class="form-group col-md-6 mb-3">
                  <label for="register_name"><b>First name</b></label>
                  <input type="text" class="form-control" name="register_name" value="<?php echo $data['name']; ?>" placeholder="Enter first name" required>
                </div>
                <div class="form-group col-md-6 mb-3">
                  <label for="register_surname"><b>Last name</b></label>
                  <input type="text" class="form-control" name="register_surname" value="<?php echo $data['surname']; ?>" placeholder="Enter last name" required>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6 mb-3">
                  <label for="register_password"><b>Password:</b></label>
                  <input type="password" class="form-control" name="register_password" value="<?php echo $data['password']; ?>" placeholder="Enter password" required>
                </div>
                <div class="form-group col-md-6 mb-3">
                  <label for="register_confirm_password"><b>Confirm password:</b></label>
                  <input type="password" class="form-control" name="register_confirm_password" value="<?php echo $data['confirm_password']; ?>" placeholder="Enter password"required>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6 mb-3">
                  <label for="register_mobile_number"><b>Mobile number</b></label>
                  <input type="text" class="form-control" name="register_mobile_number" value="<?php echo $data['mobile_number']; ?>" placeholder="012 345 6789" required>
                </div>
                <div class="form-group col-md-6 mb-3">
                  <label for="register_role"><b>Your role</b></label>
                  <select class="form-control" name="register_role" required>
                    <option value='' <?php if(empty($data['role'])){echo 'selected';} ?>>Choose...</option>
                    <option value='0' <?php if($data['role'] == '0'){echo 'selected';} ?>>Wind Farm</option>
                    <option value='1' <?php if($data['role'] == '1'){echo 'selected';} ?>>Ornithologist</option>
                  </select>
                </div>
              </div> 
              <div class="row">
                <div class="form-group col-md-6 mb-3">
                  <label for="register_organization_name"><b>Company or organization name:</b></label>
                  <input type="text" class="form-control" name="register_orginization_name" value="<?php echo $data['organization_name']; ?>" placeholder="Enter company/organization name" required>
                </div>
                <div class="form-group col-md-6 mb-3">
                  <label for="register_organization_number"><b>Your company or organization number:</b></label>
                  <input type="text" class="form-control" name="register_orginization_number" value="<?php echo $data['organization_number']; ?>" placeholder="Enter company/organization number"required>
                </div>
              </div> 
              <div style="float:right">
                <button type="submit" name="register" class="btn btn-custom">Sign up</button>
                <button type="reset" class="btn btn-custom" onclick="location.href='<?php echo URLROOT; ?>/'" >Back</button>
              </div>
              <br><br>
              <p style="float:right" class="text-muted">By creating an account you agree to our <a href="<?php echo URLROOT; ?>\resources\files\blackeagle_terms&conditions.pdf" target="_blank" style="color:dodgerblue">Terms & Conditions</a>.</p>
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