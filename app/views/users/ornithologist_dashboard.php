<html lang="en">
    <head>
        <?php include(TEMPLATE_FRONT . DS . "header.php"); ?>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC4O-eDAp4dKR7U4E3hnxCO2psx7xnnzUU&callback=myMap"></script>
    </head>
    <style>
    table {
        display:block;
        height:55%;
        overflow:auto;
    }
    .divider{
        width:2px;
        height:auto;
        display:inline-block;
    }
    </style>
    <body style="overflow-x:hidden" onload="<?php if(isset($_SESSION['message_modal']) && $_SESSION['message_modal'] === true){echo "openAlert()"; unset($_SESSION['message_modal']);} ?>">

    <?php
        if(!is_user_logged_in()){
            redirect('');
        }
    ?>

    <div id="wrapper">

        <!-- Navbar -->
        <?php include(TEMPLATE_FRONT . DS . "navbar.php"); ?>

        <!-- Main Body -->
        <br>
        <main role="main" class="row" id="body">
            <div class="col-md-3" style="padding-left:50px;">
                <h3>Add sites</h3>
                <hr>
                <button type="button" style="margin-bottom:10px;" class="col-md-12 btn btn-custom" data-toggle="modal" data-target="#ScoutModal">Add scouting site <i class="fas fa-flag" style="color:red;"></i></button>
                <button type="button" style="margin-bottom:10px;" class="col-md-12 btn btn-custom" data-toggle="modal" data-target="#NestModal">Add nest site <i class="fa fa-map-pin" style="color:red;"></i></button>
                <hr>
                    <input type="text" id="myInput" onkeyup="tableFilter()" placeholder="Search for names.." title="Type in a name">
                    <table class="table table-striped" id="siteTable">
                        <thead>
                            <tr class = "header">
                                <td><h4>Site name</h4></td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        if(!empty($data['sites'])):
                            foreach ($data['sites'] as $row):
                        ?>
                            <tr>
                                <td><button class="button-table" onclick="setLocation(<?php echo $row->latitude; ?>, <?php echo $row->longitude; ?>)"><?php echo $row->name; ?></button></td>
                            </tr>
                        <?php 
                            endforeach;
                        endif;    
                        ?>
                        </tbody>
                    </table>
                <hr>
            </div>
            <div class="col-md-9" style="padding-right:30px;">
                <div id="googleMap" style="height:90%;"></div>
            </div>

            <div class="modal fade" id="NestModal">
                <div class="modal-dialog modal-lg">
                    <form action="<?php echo URLROOT; ?>/users/ornithologist_dashboard/0" method="post" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="modal-container">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add nest site</h4>
                                        <button type="reset" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5>Many</h5>
                                            <div class="custom-file" style="padding: 30px;">
                                                <input name="pins" id="pins" type="file" accept=".csv" class="custom-file-input">
                                                <label for="pins" class="custom-file-label text-truncate">Choose file...(.csv)</label>
                                            </div>
                                            <br><br>
                                        </div>
                                        <div class="col-md-6">
                                            <h5>One</h5>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="latitude" placeholder="Latitude" style="width:100%;">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="longitude" placeholder="Longitude" style="width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <i class="fas fa-info-circle" data-toggle="tooltip" title="Need some help? You can find it in the FAQ section!" id='example' style=" position: absolute; left: 30;"></i>
                                <div style="float: right;">
                                    <button type="reset" class="btn btn-custom" data-dismiss="modal" >Close</button>
                                    <button type="submit" class="btn btn-custom" >Upload</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form> 
            </div>
            

            <div class="modal fade" id="ScoutModal">
                <div class="modal-dialog modal-lg">
                    <form action="<?php echo URLROOT; ?>/users/ornithologist_dashboard/1" method="post" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="modal-container">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add scouting site</h4>
                                        <button type="reset" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <br><br>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="name" placeholder="Site name" style="width:100%;" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <br><br>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="latitude" placeholder="Latitude" style="width:100%;">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="longitude" placeholder="Longitude" style="width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div >
                                    <i class="fas fa-info-circle" data-toggle="tooltip" title="Need some help? You can find it in the FAQ section!" id='example' style=" position: absolute; left: 30;"></i>
                                    <div style="float: right;">
                                    <button type="reset" class="btn btn-custom" data-dismiss="modal" >Close</button>
                                    <button type="submit" class="btn btn-custom" >Upload</button>
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
                            <button style="float:right;" type="reset" class="btn btn-custom" data-dismiss="modal">Close</button>
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
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });

        var map;

        function myMap() {
            var var_location = new google.maps.LatLng(-33.958732, 18.460068);

            var var_mapoptions = {
                center: var_location,
                zoom: 8,
                mapTypeId: 'satellite'
            };

            map = new google.maps.Map(document.getElementById("googleMap"),var_mapoptions);

            <?php
            if(!empty($data['nests'])) {
                foreach ($data['nests'] as $row) {
                    echo 'new google.maps.Marker({position:new google.maps.LatLng(' . $row->latitude . ',' . $row->longitude . ' )}).setMap(map);';
                }
            }
            ?>
        }

        function setLocation(newLat, newLng) {
            map.setCenter({lat: newLat, lng: newLng});
        }

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

        // Initialize maps
        google.maps.event.addDomListener(window, 'load', myMap);

        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });

        function openAlert(){
                $('#alertModal').modal('show');
        }


    </script>
    </body>
</html>