<html lang="en">
<head>
    <?php include(TEMPLATE_FRONT . DS . "header.php"); ?>
</head>
<style>
    * {box-sizing: border-box}
    body {font-family: "Lato", sans-serif;}

</style>
<body>
<div id="wrapper">

    <!-- Navbar -->
    <?php include(TEMPLATE_FRONT . DS . "navbar.php"); ?>

    <!-- Main Body -->
    <br>
    <main role="main" id="body">

        <div id="Account settings">

            <form class="" method="post">
                <div class="container customContainer">
                    <?php //register_user(); ?>
                    <h3>Edit details</h3>
                    <hr>
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
                            <input type="password" class="form-control" name="cpassword" placeholder="Re-Enter password"required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 mb-3">
                            <label for="register_mobile_number"><b>Mobile number</b></label>
                            <input type="text" class="form-control" name="register_mobile_number" placeholder="012 345 6789" required>
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label for="register_email"><b>Email:</b></label>
                            <input type="email" class="form-control" name="register_email" placeholder="Enter email" required>
                        </div>
                    </div>
                    <div style="float:right;">
                        <button type="submit" name="register" class="btn btn-custom">Clear</button>
                    <button type="submit" name="register" class="btn btn-custom">Update</button>
                    </div>
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