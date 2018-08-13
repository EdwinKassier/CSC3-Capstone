<?php
    require_once("../../private/class.config.php");
    require_once("class.admin_functions.php");
?>	

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include(TEMPLATE_BACK . DS ."header.php") ?>
</head>
<body>

    <?php
        // if(!isset($_SESSION['admin_id'])){
        //     redirect("../");
        // }
    ?>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

        <?php include(TEMPLATE_BACK . DS ."top_nav.php") ?>
        <?php include(TEMPLATE_BACK . DS ."side_nav.php") ?>

        </nav>
        <div id="inMessage" class="bg-success text-center"><?php display_message(); ?></div>
        <div id="page-wrapper">
            <div class="container-fluid">
                <?php
                if($_SERVER['REQUEST_URI'] == "/public_html/admin/" || $_SERVER['REQUEST_URI'] == "/public_html/admin/index"){
                    include(TEMPLATE_BACK . DS ."dashboard_content.php");
                }
                else if(isset($_GET['map'])){
                    include(TEMPLATE_BACK . DS ."map_content.php");
                }
                else if(isset($_GET['alerts'])){
                    include(TEMPLATE_BACK . DS ."alerts_content.php");
                }
                else if(isset($_GET['users'])){
                    include(TEMPLATE_BACK . DS ."pending_users_content.php");
                }
                else if(isset($_GET['admin'])){
                    include(TEMPLATE_BACK . DS ."admin_content.php");
                }      
                else if(isset($_GET['add_admin']) || isset($_GET['edit_admin'])){
                    include(TEMPLATE_BACK . DS ."add_admin.php");
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
