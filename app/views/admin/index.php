<!DOCTYPE html> 
<html lang="en">
<head>
    <?php include(TEMPLATE_ADMIN . DS ."header.php") ?>
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

        <?php include(TEMPLATE_ADMIN . DS ."top_nav.php") ?>
        <?php include(TEMPLATE_ADMIN . DS ."side_nav.php") ?>

        </nav>
        <div id="inMessage" class="bg-success text-center"><?php display_message(); ?></div>
        <div id="page-wrapper">
            <div class="container-fluid">
                <?php
                if($data['view'] == null){
                    include(TEMPLATE_ADMIN . DS ."dashboard_content.php");
                }
                else if($data['view'] == 'map'){
                    include(TEMPLATE_ADMIN . DS ."map_content.php");
                }
                else if($data['view'] == 'alerts'){
                    include(TEMPLATE_ADMIN . DS ."alerts_content.php");
                }
                else if($data['view'] == 'users'){
                    include(TEMPLATE_ADMIN . DS ."pending_users_content.php");
                }
                else if($data['view'] == 'userDB'){
                    include(TEMPLATE_ADMIN . DS ."userDB.php");
                }
                else if($data['view'] == 'admin'){
                    include(TEMPLATE_ADMIN . DS ."admin_content.php");
                }      
                else if($data['view'] == 'add_admin' || $data['view'] == 'edit_admin'){
                    include(TEMPLATE_ADMIN . DS ."add_admin.php");
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
