<!DOCTYPE html>
<html>
    <body>

    <div class ="row" style="width:100%;height:100%;">
        <div id="googleMap" style="width:103%;height:88vh;"></div>
    </div>

    <script>
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
        // Initialize maps
        google.maps.event.addDomListener(window, 'load', myMap);

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC4O-eDAp4dKR7U4E3hnxCO2psx7xnnzUU&callback=myMap"></script>
    </body>
</html>