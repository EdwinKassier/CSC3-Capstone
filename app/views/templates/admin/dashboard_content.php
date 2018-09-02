<style>
    .btn-file {
        position: relative;
        overflow: hidden;
    }

    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
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
    <h4 class="alert-danger" style="text-align:center;">WARNING: Every time you upload a new model the previous one will
        be overwritten</h4>
    <form action="<?php echo URLROOT; ?>/admins/dashboard_content" method="post" enctype="multipart/form-data">
        <div class="input-group">
            <label class="input-group-btn">
                    <span class="btn btn-primary">
                        Browse&hellip; <input type="file" style="display: none;" multiple>
                    </span>
            </label>
            <input type="text" id="model" class="form-control" readonly>
        </div>
        <br>
        <div>
            <button type="submit" class="btn btn-success" style="width:10%;">Upload</button>
        </div>
    </form>
</div>


<script>
    $(function () {

        // We can attach the `fileselect` event to all file inputs on the page
        $(document).on('change', ':file', function () {
            var input = $(this),
                numFiles = input.get(0).files ? input.get(0).files.length : 1,
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [numFiles, label]);
        });

        // We can watch for our custom `fileselect` event like this
        $(document).ready(function () {
            $(':file').on('fileselect', function (event, numFiles, label) {

                var input = $(this).parents('.input-group').find(':text'),
                    log = numFiles > 1 ? numFiles + ' files selected' : label;

                if (input.length) {
                    input.val(log);
                } else {
                    if (log) alert(log);
                }

            });
        });

    });
</script>
