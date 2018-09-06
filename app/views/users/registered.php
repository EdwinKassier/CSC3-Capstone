<!--This class checks if a user has been registered and outputs a confirmation if the user has successfully completed the sign up process-->
<html lang="en">
<head>
    <?php include(TEMPLATE_FRONT . DS . "header.php"); ?>
</head>
<body>

<!--Checks if the user is already registered-->
<?php
if (!isset($_SESSION['registered']) || $_SESSION['registered'] != true) {
    redirect('');
}
?>

<br><br><br><br>
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 col-md-offset-6 text-center">
            <h3>You have been registered successfully and you're now pending approval from an admin. Please check your
                inbox and/or junkmail to verify your email.</h3>
        </div>
    </div>
</div>
</body>
</html>