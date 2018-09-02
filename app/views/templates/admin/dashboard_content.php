<style>
    .fileUpload {
        position: relative;
        overflow: hidden;
        margin: 10px;
    }

    .fileUpload input.upload {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        padding: 0;
        font-size: 20px;
        cursor: pointer;
        background-color: transparent;
    }

    input {
        color: black;
        border-radius: 5px;
        background-color: white;


    }

</style>
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>
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
        <h4><strong>Registered wind farms: <?php echo $data['amount_wind_farms']; ?></strong></h4>
        <h4><strong>Registered ornothologists: <?php echo $data['amount_ornothologists']; ?></strong></h4>
    </div>
</div>
<div class="row">
    <hr>
    <h2>Update the model</h2>
    <hr>
    <h4 class="alert-danger" style="text-align:center;">WARNING: Every time you upload a new model the previous one will be overwritten</h4>
    <form action="<?php echo URLROOT; ?>/admins/dashboard_content" method="post" enctype="multipart/form-data">
        <input id="model" name="model" placeholder="Choosen File..." disabled="disabled"/>
        <div class="fileUpload btn btn-primary">
            <span>Browse</span>
            <input id="model" name="model" accept=".rds" type="file" class="upload"/>
        </div>
        <br>
        <div>
            <button type="submit" class="btn btn-success" style="width:10%;">Upload</button>
        </div>
    </form>
</div>


<script>
    document.getElementById("model").onchange = function () {
        document.getElementById("model").value = this.value;
    };
</script>
