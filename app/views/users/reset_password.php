<!--This is the reset password page, this is where users will be redirected after having pressed the forget password button-->
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
        <div class="alert-danger text-center"><?php echo $data['error']; ?></div>
        <br>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 col-md-offset-6 text-center">
                <?php if (!($data['password_check'])): ?>
                    <h2 class="text-center">Reset Password</h2>
                    <p>You can reset your password here.</p>
                    <div class="panel-body">

                        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">

                            <div class="form-group">
                                <div class="input-group">
                                    <input id="password" name="password" placeholder="Enter new password"
                                           class="form-control" type="password" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input id="confirm_password" name="confirm_password" placeholder="Confirm password"
                                           class="form-control" type="password" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <input name="recover-submit" class="btn btn-lg btn-custom btn-block"
                                       value="Reset Password" type="submit">
                            </div>

                            <input type="hidden" class="hide" name="token" id="token" value="">
                        </form>
                    </div>
                <?php else: ?>
                    <h3>Your password has been reset.</h3>
                    <button type="button" class="btn btn-lg btn-custom btn-block"
                            onclick="location.href='<?php echo URLROOT; ?>'">Login
                    </button>
                <?php endIf; ?>
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