<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>
        <ol class="breadcrumb">
            <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
        </ol>
    </div>
</div>

<!-- FIRST ROW WITH PANELS -->
<div class="row">
    <div class="col-md-4">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fas fa-users fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $data['amount_pending_users']; ?></div>
                        <div>Pending Users</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo URLROOT . '/admins/users'; ?>">
                <div class="panel-footer">
                    <span class="pull-left">View</span>
                    <span class="pull-right"><i class="fas fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fas fa-map-pin fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $data['amount_nests']; ?></div>
                        <div>Nests</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo URLROOT . '/admins/map'; ?>">
                <div class="panel-footer">
                    <span class="pull-left">View</span>
                    <span class="pull-right"><i class="fas fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-md-4">
        <h4><strong>Registered admins: <?php echo $data['amount_admins']; ?></strong></h4>
        <h4><strong>Registered wind farms: <?php echo  $data['amount_wind_farms']; ?></strong></h4>
        <h4><strong>Registered ornothologists: <?php echo $data['amount_ornothologists']; ?></strong></h4>
    </div>
</div>