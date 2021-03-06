<!--This is the admin index page, it redirects admins when they arrive on the main admin dashboard-->
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include(TEMPLATE_ADMIN . DS . "header.php") ?>
</head>
<body>

<!--Check if admin is logged in already-->
<?php
if (!is_admin_logged_in()) {
    redirect('');
}
?>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

        <?php include(TEMPLATE_ADMIN . DS . "top_nav.php") ?>
        <?php include(TEMPLATE_ADMIN . DS . "side_nav.php") ?>

    </nav>
    <div class="alert-success text-center"><?php display_message(); ?></div>
    <div id="page-wrapper">
        <div class="container-fluid">
            <?php
            if ($data['view'] == null) {
                include(TEMPLATE_ADMIN . DS . "dashboard_content.php");
            } else if ($data['view'] == 'map') {
                include(TEMPLATE_ADMIN . DS . "map_content.php");
            } else if ($data['view'] == 'alerts') {
                include(TEMPLATE_ADMIN . DS . "alerts_content.php");
            } else if ($data['view'] == 'users') {
                include(TEMPLATE_ADMIN . DS . "pending_users_content.php");
            } else if ($data['view'] == 'users_content') {
                include(TEMPLATE_ADMIN . DS . "users_content.php");
            } else if ($data['view'] == 'admin') {
                include(TEMPLATE_ADMIN . DS . "admin_content.php");
            } else if ($data['view'] == 'add_admin') {
                include(TEMPLATE_ADMIN . DS . "add_admin.php");
            } else if ($data['view'] == 'edit_admin') {
                include(TEMPLATE_ADMIN . DS . "edit_admin.php");
            }
            ?>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
</body>

</html>
