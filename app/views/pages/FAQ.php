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
        <h3 class="card-title">How do i use the add scouting/nest site functionality?</h3>
        <div class="card card-body" style="text-align: justify;">
            <p>
                When you click the "Add scouting site" and "Add nest site" buttons you will be presented with the
                following popup.
            </p>
            <hr>
            <img src="<?php echo URLROOT; ?>/resources/images/modal_example.png" alt="Modal example">
            <hr>
            <p>
                You have two options: you can either add a site one at the time by inputting the sites latitude and
                longitude coordinates (up to six decimal points using a full stop(.) as your separator) on the right,
                under the "One" heading. Or you can input
                multiple sites by uploading a csv file into the file box on the left, the file needs to be in the format
                below for our our servers to process it correctly, again any of these values can be up to 6 decimal
                places and must have a full stop(.) as its separator. .
            </p>

            <img src="<?php echo URLROOT; ?>/resources/images/excel_example.png" alt="Modal example">

        </div>

        <h3 class="card-title">How do edit my user details?</h3>
        <div class="card card-body" style="text-align: justify;">
            <p>
                When you click the "Add scouting site" and "Add nest site" buttons you will be presented with the
                following popup.
            </p>
            <hr>
            <img src="<?php echo URLROOT; ?>/resources/images/modal_example.png" alt="Modal example">
            <hr>
            <p>
                You have two options: you can either add a site one at the time by inputting the sites latitude and
                longitude coordinates (up to six decimal points using a full stop(.) as your separator) on the right,
                under the "One" heading. Or you can input
                multiple sites by uploading a csv file into the file box on the left, the file needs to be in the format
                below for our our servers to process it correctly, again any of these values can be up to 6 decimal
                places and must have a full stop(.) as its separator. .
            </p>

            <img src="<?php echo URLROOT; ?>/resources/images/excel_example.png" alt="Modal example">

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