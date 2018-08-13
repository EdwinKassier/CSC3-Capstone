<!DOCTYPE html>
<html lang="en">
  <head>
      
    <?php include(TEMPLATE_FRONT . DS . "header.php"); ?>

    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script src="<?php echo URLROOT; ?>/resources/recaptcha/validator.js"></script>
    <script src="<?php echo URLROOT; ?>/resources/recaptcha/contact.js"></script>
    
    <style>

    </style>
  </head>
  <body>
    <div id="wrapper">

      <!-- Navbar -->
      <?php include(TEMPLATE_FRONT . DS . "navbar.php"); ?>

      <!-- Main Body -->
      <div class="container" id="body" >
      <br>
        <div >
            <form id="contact-form" method="post" action="<?php echo URLROOT; ?>/resources/recaptcha/contact.php" role="form" novalidate="true">
                <div class="container customContainer">
                    <h4>Contact Us</h4>
                    <hr>
                    <div class="messages"></div>
  
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="form_name">First name</label>
                                <input id="form_name" type="text" name="name" class="form-control" placeholder="Please enter your first name *" data-error="Firstname is required." required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="form_lastname">Last name</label>
                                <input id="form_lastname" type="text" name="surname" class="form-control" placeholder="Please enter your last name *" data-error="Lastname is required." required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="form_email">Email</label>
                                <input id="form_email" type="email" name="email" class="form-control" placeholder="Please enter your email *" data-error="Valid email is required." required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="form_phone">Mobile number</label>
                                <input id="form_phone" type="tel" name="phone" class="form-control" placeholder="Please enter your phone number" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="messagecol">
                            <div class="form-group">
                                <label for="form_message">Message</label>
                                <textarea id="form_message" name="message" class="form-control" placeholder="" rows="4" data-error="Please leave us a message." required></textarea>
                            </div>
                        </div>
  
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="g-recaptcha" data-sitekey="" data-callback="verifyRecaptchaCallback" data-expired-callback="expiredRecaptchaCallback"></div>
                                <input class="form-control d-none" data-recaptcha="true">
                            </div>
                        </div>
                    
                        <div class="col-md-12">
                            <div class="clearfix" style="float:right">
                                <button type="submit"  class="btn btn-custom"  id="contactsubmit" >Send message</button>
                                <button class="btn btn-custom" onclick="location.href='<?php echo URLROOT; ?>'" >Back</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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