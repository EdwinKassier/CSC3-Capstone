<html lang="en">
    <head>
        <?php include(TEMPLATE_FRONT . DS . "header.php"); ?>
    </head>

    <style>
        body{
            overflow-x: hidden;
            overflow-y: scroll;
        }
        .list-group{
            max-height: 300px;
            margin-bottom: 10px;
            overflow:scroll;
            overflow-x: hidden;
            -webkit-overflow-scrolling: touch;
        }

        #myInput {
            width: 100%;
            font-size: 16px;
            padding: 12px 20px 12px 40px;
            border: 1px solid #ddd;
            margin-bottom: 12px;
            border-radius: 20px;
        }

        #myInput:focus{
            outline:0;
            border:1px solid deepskyblue;
        }

        tbody {
            display:block;
            height:200px;
            overflow:auto;
        }
        thead, tbody tr {
            display:table;
            width:100%;
            table-layout:fixed;
        }
        thead {
            width: calc( 100% - 1em )
        }

        .button-table {
            background-color: transparent; /* Green */
            border: none;
            color: black;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
        }
        .button-table:hover{
            color:deepskyblue;
        }

        .button-table:focus {
            outline:0;
            color:deepskyblue;
        }

    </style>

    <body>

    <?php
        if(!is_logged_in()){
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
                    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
                    <table class="table table-striped" id="siteTable">
                        <thead>
                        <tr class = "header">
                            <td>Site name</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><button class="button-table">Site #1</button></td>
                        </tr>
                        <tr>
                            <td><button class="button-table">Site #2</button></td>
                        </tr>
                        <tr>
                            <td><button class="button-table">Site #3</button></td>
                        </tr>
                        <tr>
                            <td><button class="button-table">Site #4</button></td>
                        </tr>
                        <tr>
                            <td><button class="button-table">Site #5</button></td>
                        </tr>
                        <tr>
                            <td><button class="button-table">Site #6</button></td>
                        </tr>
                        <tr>
                            <td><button class="button-table">Site #7</button></td>
                        </tr>
                        <tr>
                            <td><button class="button-table">Site #8</button></td>
                        </tr>
                        </tbody>
                    </table>
                <hr>
                <h3>Add sites</h3>
                <hr>
                <button type="button" style="margin-bottom:10px;" class="col-md-12 btn btn-custom" data-toggle="modal" data-target="#ScoutModal">Add scouting site  <i class="fas fa-flag" style="color:red;"></i></button>
                <button type="button" style="margin-bottom:10px;" class="col-md-12 btn btn-custom" data-toggle="modal" data-target="#NestModal">Add nest site  <i class="fa fa-map-pin" style="color:red;"></i></button>
            </div>
            <div class="col-md-9"  style="padding-right:30px;">
                <div id="googleMap" class="z-depth-1" style="height:90%;"></div>
            </div>

            <div class="modal fade" id="NestModal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content" style="height:70vh;">

                        <div class="modal-header" style="height: 100%;">
                            <h4 class="modal-title">Add nest site</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                            <div class="row modal-container">
                                <div class="col-md-6">
                                    <h5>Many</h5>
                                    <div class="custom-file" style="padding: 30px;">
                                        <input id="nests" type="file" accept=".xls,.xlsx,.csv" class="custom-file-input">
                                        <label for="nests" class="custom-file-label text-truncate">Choose file...(.xls,.xslx,.csv)</label>
                                    </div>
                                    <br><br>
                                    </form>
                                </div>

                                <div class="col-md-6">
                                    <h5>One</h5>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="lat" placeholder="Latitude"
                                               style="width:100%;">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="lat" placeholder="Longitude"
                                               style="width:100%;">
                                    </div>

                                </div>

                            </div>
                        </div>

                        <div class="modal-footer" style="height: 100%;">
                            <i class="fas fa-info-circle" data-toggle="tooltip" title="Need some help? You can find it in the FAQ section!" id='example' style=" position: absolute; left: 30;"></i>
                            <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-custom" data-dismiss="modal">Upload</button>
                        </div>

                    </div>
                </div>
            </div>

            <div class="modal fade" id="ScoutModal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content" style="height:70vh;">

                        <div class="modal-header" style="height: 100%;">
                            <h4 class="modal-title">Add scouting site</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                            <div class="row modal-container">
                                <div class="col-md-6">
                                    <h5>Many</h5>
                                    <div class="custom-file" style="padding: 30px;">
                                        <input id="scoutings" type="file" accept=".xls,.xlsx,.csv" class="custom-file-input">
                                        <label for="scoutings" class="custom-file-label text-truncate">Choose file...(.xls,.xslx,.csv)</label>
                                    </div>
                                    <br><br>
                                    </form>
                                </div>

                                <div class="col-md-6">
                                    <h5>One</h5>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="lat" placeholder="Latitude"
                                               style="width:100%;">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="lat" placeholder="Longitude"
                                               style="width:100%;">
                                    </div>

                                </div>

                            </div>
                        </div>

                        <div class="modal-footer" style="height: 100%;">
                            <i class="fas fa-info-circle" data-toggle="tooltip" title="Need some help? You can find it in the FAQ section!" id='example' style=" position: absolute; left: 30;"></i>
                            <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-custom" data-dismiss="modal">Upload</button>
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

        function myMap() {
            var var_location = new google.maps.LatLng(-33.958732, 18.460068);

            var var_mapoptions = {
                center: var_location,
                zoom: 8,
                mapTypeId: 'satellite'
            };

            var map = new google.maps.Map(document.getElementById("googleMap"),var_mapoptions);

            <?php
            $nest_site_array = array("51.3000,-0.120850", "52.3000,-0.120850","53.3000,-0.120850","54.3000,-0.120850");
            if(sizeof($nest_site_array)!=0) {
                for ($x = 0; $x <= sizeof($nest_site_array) - 1; $x++) {
                    echo 'new google.maps.Marker({position:new google.maps.LatLng(' . $nest_site_array[$x][0] . ',' . $nest_site_array[$x][1] . ' )}).setMap(map);';
                }
            }
            ?>


        }

        function myFunction() {
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

        //Code for dynamically adding nest site markers



        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });

    </script>
    </body>
</html>