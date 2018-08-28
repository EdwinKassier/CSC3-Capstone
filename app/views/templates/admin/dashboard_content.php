<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Black Eagle Project admin Dashboard</h1>
        <ol class="breadcrumb">
            <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
        </ol>
    </div>
</div>

<?php
    // $query = query("SELECT * FROM users");
    // confirm($query);
    // $users = mysqli_num_rows($query);
    // $query = query("SELECT * FROM dresses  WHERE available != 3");
    // confirm($query);
    // $r_dresses = mysqli_num_rows($query);
    // $query = query("SELECT * FROM dresses WHERE available = 1 AND available != 3");
    // confirm($query);
    // $a_dresses = mysqli_num_rows($query);
    // $query = query("SELECT * FROM orders WHERE payed = '1'");
    // confirm($query);
    // $orders = mysqli_num_rows($query);
    // $query = query("SELECT * FROM dresses WHERE available = 0");
    // confirm($query);
    // $p_dresses = mysqli_num_rows($query);
    // $query = query("SELECT * FROM orders WHERE pending = 1");
    // confirm($query);
    // $p_orders = mysqli_num_rows($query);
?>

<!-- FIRST ROW WITH PANELS -->
<div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-fw fa-users fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php //echo $p_orders; ?></div>
                        <div>Pending Users</div>
                    </div>
                </div>
            </div>
            <a href="index.php?users">
                <div class="panel-footer">
                    <span class="pull-left">View</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <!-- Put some project relevent metrics here. Like amount users of each type, amount nest, etc. -->
        <h4><strong>Registered ornothologists: <?php //echo $users; ?></strong></h4>
        <h4><strong>Registered wind farms: <?php //echo $r_dresses; ?></strong></h4>
        <h4><strong>Registered admin: <?php //echo $a_dresses; ?></strong></h4>
    </div>
</div>