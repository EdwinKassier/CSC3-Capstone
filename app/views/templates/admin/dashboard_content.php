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

<h2>Update the model</h2>
<hr>
<ol class="breadcrumb">
    <li class="active">WARNING: Every time you upload a new model the previous one will be overwritten</li>
</ol>
<form action="">
    <input id="uploadFile" placeholder="Choose File..." disabled="disabled"/>
    <div class="fileUpload btn btn-primary">
        <span>Browse</span>
        <input id="uploadBtn" type="file" class="upload"/>
    </div>
    <br>
    <div>
        <button type="submit" class="btn btn-success" style="width:10%;">Upload</button>
    </div>
</form>


<script>
    document.getElementById("uploadBtn").onchange = function () {
        document.getElementById("uploadFile").value = this.value;
    };
</script>
