<html lang="en">
<head>
    <?php include(TEMPLATE_FRONT . DS . "header.php"); ?>
</head>

<body>
<div id="wrapper">

    <!-- Navbar -->
    <?php include(TEMPLATE_FRONT . DS . "navbar.php"); ?>

    <!-- Main Body -->
    <br>
    <main role="main" id="body">
  <div class = "row">
        <div class="col-md-3" style="padding-left:50px;">
            <h3>My scouting locations</h3>
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action">Scouting location 1 - (lat,long)</a>
                <a href="#" class="list-group-item list-group-item-action">Scouting location 2 - (lat,long) </a>
                <a href="#" class="list-group-item list-group-item-action">Scouting location 3 - (lat,long)</a>
                <a href="#" class="list-group-item list-group-item-action">Scouting location 4 - (lat,long)</a>
            </div>
            <hr>
            <h3>Add sites</h3>
            <br>
            <button type="button" class="btn btn-custom" style="width:100%;">Add scouting site  <i class="fas fa-flag" style="color:red;"></i></i></button>
            <br>
            <br>
            <button type="button" class="btn btn-custom" style="width:100%;">Add nest site  <i class="fas fa-map-pin" style="color:red;"></i></i></i></button>
        </div>

        <div class="col-md-9">
            <div id="googleMap" class="z-depth-1" style="height:100%;"></div>
        </div>
  </div>


    </main>
    <br>

    <!-- Footer -->
    <?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>

</div>
<!-- Javascript -->
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
</body>
</html>