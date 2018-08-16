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
    <main role="main" class="container" id="body">

        <div class="row" style="max-width:100%; overflow-x: hidden;overflow-y: hidden;">

            <div class="col-md-2">
                <h3>All map functions go here</h3>
            </div>

            <div class="col-md-10">
                <div id="googleMap" style="width:100%;height:100vh;"></div>
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
        var mapProp= {
            center:new google.maps.LatLng(-33.958732, 18.460068),
            zoom:6,
            mapTypeId: google.maps.MapTypeId.HYBRID
        };
        var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
    }
</script>
</body>
</html>