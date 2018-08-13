<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Dashboard <small>Statistics Overview</small></h1>
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
                        <i class="fa fa-shopping-cart fa-5x"></i>
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
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php //echo $p_dresses; ?></div>
                        <div>Alerts</div>
                    </div>
                </div>
            </div>
            <a href="index.php?alerts">
                <div class="panel-footer">
                    <span class="pull-left">View</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <h4><strong>Registered users: <?php //echo $users; ?></strong></h4>
        <h4><strong>Registered dresses: <?php //echo $r_dresses; ?></strong></h4>
        <h4><strong>Active dresses: <?php //echo $a_dresses; ?></strong></h4>
        <h4><strong>Amount of orders: <?php //echo $orders; ?></strong></h4>
    </div>
</div>

<!-- SECOND ROW WITH TABLES-->
<div class="row">
    <div class="col">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> 50 Most Recent Orders</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead  style="background-color:lightgray">
                            <tr>
                            <th>Order ID</th>
                            <th>Renter ID</th>
                            <th>Amount of dresses</th>
                            <th>Amount (ZAR)</th>
                            <th>Order date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php //get_recent_orders(); ?>
                        </tbody>
                    </table>
                </div>
                    <a href="index.php?orders">
                        <div class="panel-footer text-right">
                            <span>View  All Orders <i class="fa fa-arrow-circle-right"></i></span>
                        </div>
                    </a>
            </div>
        </div>
    </div>    
</div>