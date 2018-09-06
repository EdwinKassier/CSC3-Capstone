<!--This is the email verified page, it will output a message when a user has been successfully validated by the site admins-->
<!DOCTYPE html>
<html lang="en">
<head>

    <?php include(TEMPLATE_FRONT . DS . "header.php"); ?>

</head>
<body>
<div id="wrapper">

    <!-- Navbar -->
    <?php include(TEMPLATE_FRONT . DS . "navbar.php"); ?>

    <!-- Main Body -->
    <div class="container" id="body">
        <br>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 col-md-offset-6 text-center">
                <h3>Your email has been verified.</h3>
                <button type="button" class="btn btn-lg btn-custom btn-block"
                        onclick="location.href='<?php echo URLROOT; ?>'">Login
                </button>
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