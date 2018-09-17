<!--This is the wind farm dashboard, this screen will be the first screen displayed when a wind farm user logs in-->
<html lang="en">
<head>
    <?php include(TEMPLATE_FRONT . DS . "header.php"); ?>
</head>
<style>
    table {
        display: block;
        height: 70%;
        overflow: auto;
    }
</style>
<!--This will open a message modal if there is some error on the page-->
<body style="overflow-y:hidden"
onload="<?php if (isset($_SESSION['message_modal']) && $_SESSION['message_modal'] === true) {
    echo "openAlert()";
    unset($_SESSION['message_modal']);
} ?>">

<!--This checks if the user is logged in-->
<?php 
if (!is_user_logged_in()) {
    redirect('');
}
?>

<div id="wrapper">

    <!-- Navbar -->
    <?php include(TEMPLATE_FRONT . DS . "navbar.php"); ?>

    <!-- Main Body -->
    <br>
    <main role="main" class="container" id="body">

        <div class="row">
            <div class="col-md-8">
                <input type="text" id="myInput" onkeyup="tableFilter()" placeholder="Search for names.."
                       title="Type in a name">
            </div>
            <div class="col-md-4">
                <button type="button" class="col-md-4 btn btn-custom" data-toggle="modal" data-target="#Modal"
                        style="float:right;">Add <i class="fas fa-plus"></i></button>
            </div>
        </div>
        <br>
        <br>
        <div class="container">
            <table class="table table-striped" id="siteTable">
                <thead>
                <tr class="header">
                    <td><h4>Site name</h4></td>
                    <td></td>
                </tr>
                </thead>
                <tbody>
                <!--This checks if there are any reports in the database to be downloaded-->
                <?php
                if (!empty($data['reports'])):
                    foreach ($data['reports'] as $row):
                        ?>
                        <tr>
                            <td><?php echo $row->report_name; ?></td>
                            <td>
                                <button onclick="location.href='<?php echo URLROOT; ?>/users/download_report/<?php echo $row->report_id; ?>'"
                                        type="button" class="btn btn-custom" style="float:right;">Generate report
                                </button>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                endif;
                ?>
                </tbody>
            </table>
            <hr>
        </div>

        <div class="modal fade" id="Modal">
            <div class="modal-dialog modal-lg">
                <form action="<?php echo URLROOT; ?>/users/wind_farm_dashboard" method="post"
                      enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="modal-container">
                                <div class="modal-header">
                                    <h4 class="modal-title">Add site</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="name" placeholder="Site name"
                                                   style="width:100%;" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="custom-file" style="padding: 30px;">
                                            <input id="shp" name="shp" type="file" accept=".shp"
                                                   class="custom-file-input" required>
                                            <label for="shp" class="custom-file-label text-truncate">Choose
                                                file...(.shp) *Required</label>
                                        </div>
                                        <div class="custom-file" style="padding: 30px;">
                                            <input id="shx" name="shx" type="file" accept=".shx"
                                                   class="custom-file-input" required>
                                            <label for="shx" class="custom-file-label text-truncate">Choose
                                                file...(.shx) *Required</label>
                                        </div>
                                        <div class="custom-file" style="padding: 30px;">
                                            <input id="dbf" name="dbf" type="file" accept=".dbf"
                                                   class="custom-file-input" required>
                                            <label for="dbf" class="custom-file-label text-truncate">Choose
                                                file...(.dbf) *Required</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="custom-file" style="padding: 30px;">
                                            <input id="sbn" name="sbn" type="file" accept=".sbn"
                                                   class="custom-file-input">
                                            <label for="sbn" class="custom-file-label text-truncate">Choose
                                                file...(.sbn) *Optional</label>
                                        </div>
                                        <div class="custom-file" style="padding: 30px;">
                                            <input id="sbx" name="sbx" type="file" accept=".sbx"
                                                   class="custom-file-input">
                                            <label for="sbx" class="custom-file-label text-truncate">Choose
                                                file...(.sbx) *Optional</label>
                                        </div>
                                        <div class="custom-file" style="padding: 30px;">
                                            <input id="prj" name="prj" type="file" accept=".prj"
                                                   class="custom-file-input">
                                            <label for="prj" class="custom-file-label text-truncate">Choose
                                                file...(.prj) *Optional</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div>
                                <i class="fas fa-info-circle" data-toggle="tooltip"
                                   title="Need some help? You can find it in the FAQ section!" id='example'
                                   style=" position: absolute; left: 30;"></i>
                                <div style="float: right;">
                                    <button type="reset" class="btn btn-custom" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-custom">Upload</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade" id="alertModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">Message</h2>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p><?php display_message(); ?></p>
                        <hr>
                        <button style="float:right;" type="reset" class="btn btn-custom" data-dismiss="modal">Close
                        </button>
                    </div>
                </div>
            </div>
        </div>

</div>
</main>
<br>

<!-- Footer -->
<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>

</div>
<!-- Javascript -->
<script>
    //Set the text in the file input box to the uploaded files name
    $('.custom-file-input').on('change', function () {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    //Table filter function used by the search bar to filter the table on screen
    function tableFilter() {
        var input, filter, table, tr, td, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("siteTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    //Initialisng the tool tip to open on hover
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    var map;

    //Initialising the google maps
    function myMap() {
        var var_location = new google.maps.LatLng(-33.958732, 18.460068);

        var var_mapoptions = {
            center: var_location,
            zoom: 8,
            mapTypeId: 'satellite'
        };

        map = new google.maps.Map(document.getElementById("googleMap"), var_mapoptions);
    }

    //Open the alert modal showing people a message
    function openAlert() {
        $('#alertModal').modal('show');
    }
</script>
</body>
</html>