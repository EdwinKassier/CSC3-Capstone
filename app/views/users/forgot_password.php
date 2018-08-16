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
        <br>
        <div class="alert-danger text-center"><?php echo $data['error']; ?></div>
        <br>       
        <div class="row" >
            <div class="col-md-3"></div>
            <div class="col-md-6 col-md-offset-6 text-center">
                <?php if(!($data['email_check'])): ?>
                <h2 class="text-center">Forgot Password?</h2>
                <p>You can reset your password here.</p>
                <div class="panel-body">
                    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
                        <div class="form-group">
                            <div class="input-group">
                                <input id="forgot_email" value="<?php echo $data['email']; ?>" name="forgot_email" placeholder="Enter email" class="form-control"  type="email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <input name="recover_password" class="btn btn-lg btn-custom btn-block" value="Reset Password" type="submit">
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-lg btn-custom col-md-12 btn-block" onclick="location.href='<?php echo URLROOT; ?>'">Back</button>
                        </div>

                        <input type="hidden" class="hide" name="token" id="token" value="">
                    </form>
                </div>
                <?php else: ?>
                <h3>Please check your inbox and/or junkmail for our email.</h3>
                <button type="button" class="btn btn-lg btn-custom btn-block" onclick="location.href='<?php echo URLROOT; ?>'">Back</button>
                <?php endif; ?>
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