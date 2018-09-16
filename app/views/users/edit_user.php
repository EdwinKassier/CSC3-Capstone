<!--This is the edit user page and is used by the users to edit their personal details-->
<html lang="en">
<head>
    <?php include(TEMPLATE_FRONT . DS . "header.php"); ?>
</head>
<style>
</style>
<body>

<!--Check if the user has been logged in-->
<?php
if (!is_user_logged_in()) {
    redirect('');
}
?>

<div id="wrapper">

    <!-- Navbar -->
    <?php include(TEMPLATE_FRONT . DS . "navbar.php"); ?>

    <!-- Main Body -->
    <br>
    <main role="main" class="container" id="body">
        <br>
        <div class="alert-success text-center"><?php display_message(); ?></div>
        <div class="alert-danger text-center"><?php echo $data['error']; ?></div>
        <br>
        <form action="<?php echo URLROOT; ?>/users/edit_user" method="post">
            <h3>Edit account</h3>
            <hr>
            <div class="row">
                <div class="form-group col-md-6 mb-3">
                    <label for="update_first_name"><b>First name</b></label>
                    <input type="text" class="form-control" name="update_first_name"
                           value="<?php echo $data['name']; ?>" placeholder="Enter first name" required>
                </div>
                <div class="form-group col-md-6 mb-3">
                    <label for="update_last_name"><b>Last name</b></label>
                    <input type="text" class="form-control" name="update_last_name"
                           value="<?php echo $data['surname']; ?>" placeholder="Enter last name" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 mb-3">
                    <label for="update_password"><b>Password:</b></label>
                    <input type="password" class="form-control" name="update_password"
                           value="<?php echo $data['password']; ?>" placeholder="Enter new password (minimum 6 characters)">
                </div>
                <div class="form-group col-md-6 mb-3">
                    <label for="update_confirm_password"><b>Confirm password:</b></label>
                    <input type="password" class="form-control" name="update_confirm_password"
                           value="<?php echo $data['confirm_password']; ?>" placeholder="Re-enter new password (minimum 6 characters)">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 mb-3">
                    <label for="update_mobile_number"><b>Mobile number</b></label>
                    <input type="text" class="form-control" name="update_mobile_number"
                           value="<?php echo substr_replace(substr_replace($data['mobile_number'], ' ', 6, 0), ' ', 3, 0); ?>"
                           placeholder="012 345 6789 (10 digit number required)" required>
                </div>
                <div class="form-group col-md-6 mb-3">
                    <label for="update_email"><b>Email:</b></label>
                    <input type="email" class="form-control" name="update_email" value="<?php echo $data['email']; ?>"
                           placeholder="Enter email (must contain an '@' and a '.' )" required>
                </div>
            </div>
            <div style="float:right;">
                <button type="submit" name="update" class="btn btn-custom">Update</button>
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