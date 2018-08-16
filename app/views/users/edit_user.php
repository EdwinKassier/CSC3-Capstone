<html lang="en">
    <head>
        <?php include(TEMPLATE_FRONT . DS . "header.php"); ?>
    </head>
    <style>
    </style>
    <body>

    <?php
        if(!is_logged_in()){
        redirect('');
        }
    ?>

    <div id="wrapper">

        <!-- Navbar -->
        <?php include(TEMPLATE_FRONT . DS . "navbar.php"); ?>

        <!-- Main Body -->
        <br>
        <main role="main"  class="container" id="body">
            <form action="<?php echo URLROOT; ?>/users/edit_user" method="post">
                <h3>Edit account</h3>
                <hr>
                <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="update_first_name"><b>First name</b></label>
                        <input type="text" class="form-control" name="update_first_name" placeholder="Enter first name" required>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="update_last_name"><b>Last name</b></label>
                        <input type="text" class="form-control" name="update_last_name" placeholder="Enter last name" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="update_password"><b>Password:</b></label>
                        <input type="password" class="form-control" name="update_password" placeholder="Enter password" required>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="update_confirm_password"><b>Confirm password:</b></label>
                        <input type="password" class="form-control" name="update_confirm_password" placeholder="Re-enter password" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="update_mobile_number"><b>Mobile number</b></label>
                        <input type="text" class="form-control" name="update_mobile_number" placeholder="012 345 6789" required>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="update_email"><b>Email:</b></label>
                        <input type="email" class="form-control" name="update_email" placeholder="Enter email" required>
                    </div>
                </div>
                <div style="float:right;">
                    <button type="submit" name="update" class="btn btn-custom">Update</button>
                    <button class="btn btn-custom" onclick="location.href='<?php if($_SESSION['user_role'] == 0){ echo URLROOT . '/users/wind_farm_dashboard'; }else if($_SESSION['user_role'] == 1){echo URLROOT . '/users/ornithologist_dashboard';} ?>'" >Back</button>
                </div>
            </form>
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