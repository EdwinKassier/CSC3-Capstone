<!DOCTYPE html>
<html>
    <body>

    <div style="padding-right:30px;" >
        <div id="googleMap" style="height:500px;"></div>
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


        }
        // Initialize maps
        google.maps.event.addDomListener(window, 'load', myMap);

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC4O-eDAp4dKR7U4E3hnxCO2psx7xnnzUU&callback=myMap"></script>
    </body>
</html>