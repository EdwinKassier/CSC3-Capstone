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
<body style="overflow-y:hidden">

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
                <?php
                if (!empty($data['reports'])):
                    foreach ($data['reports'] as $row):
                        ?>
                        <tr>
                            <td><?php echo $row->report_name; ?></td>
                            <td>
                                <button onclick="location.href='<?php echo URLROOT; ?>/users/download_report/<?php echo $row->report_id; ?>'"
                                        type="button" class="btn btn-custom" data-toggle="modal"
                                        data-target="#alertModal" style="float:right;">Generate report
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
                <div class="modal-content" style="height:80vh;">

                    <div class="modal-header" style="height: 100%;">
                        <h4 class="modal-title">Add site</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <div class="row modal-container">

                            <div class="row" style="width:100%;">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="site_name" placeholder="Site name"
                                           style="left:20;width:105%;">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="custom-file" style="padding: 30px;">
                                        <input id="file1" type="file" accept=".shp" class="custom-file-input">
                                        <label for="file1" class="custom-file-label text-truncate">Choose
                                            file...(.shp) *Required</label>
                                    </div>

                                    <div class="custom-file" style="padding: 30px;">
                                        <input id="file2" type="file" accept=".shx" class="custom-file-input">
                                        <label for="file2" class="custom-file-label text-truncate">Choose
                                            file...(.shx) *Required</label>
                                    </div>

                                    <div class="custom-file" style="padding: 30px;">
                                        <input id="file3" type="file" accept=".dbf" class="custom-file-input">
                                        <label for="file3" class="custom-file-label text-truncate">Choose
                                            file...(.dbf) *Required</label>
                                    </div>
                                    </form>
                                </div>

                                <div class="col-md-6">
                                    <div class="custom-file" style="padding: 30px;">
                                        <input id="file4" type="file" accept=".sbn" class="custom-file-input">
                                        <label for="file4" class="custom-file-label text-truncate">Choose
                                            file...(.sbn) *Optional</label>
                                    </div>

                                    <div class="custom-file" style="padding: 30px;">
                                        <input id="file5" type="file" accept=".sbx" class="custom-file-input">
                                        <label for="file5" class="custom-file-label text-truncate">Choose
                                            file...(.sbx) *Optional</label>
                                    </div>

                                    <div class="custom-file" style="padding: 30px;">
                                        <input id="file5" type="file" accept=".prj" class="custom-file-input">
                                        <label for="file5" class="custom-file-label text-truncate">Choose
                                            file...(.prj) *Optional</label>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer" style="height: 100%;">
                        <i class="fas fa-info-circle" data-toggle="tooltip"
                           title="Need some help? You can find it in the FAQ section!" id='example'
                           style=" position: absolute; left: 30;"></i>
                        <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-custom" data-dismiss="modal">Upload</button>
                    </div>

                </div>
            </div>
        </div>


        <div class="modal fade" id="alertModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="height:70vh;">

                    <div class="modal-header">
                        <h2 class="modal-title">Black Eagle Project Report</h2>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <div id="googleMap" style="width:100%;height:100%;"></div>
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
    $('.custom-file-input').on('change', function () {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

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

    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    var map;

    function myMap() {
        var var_location = new google.maps.LatLng(-33.958732, 18.460068);

        var var_mapoptions = {
            center: var_location,
            zoom: 8,
            mapTypeId: 'satellite'
        };

        map = new google.maps.Map(document.getElementById("googleMap"), var_mapoptions);
    }
</script>
</body>
</html>