<html lang="en">


<head>
    <?php include(TEMPLATE_FRONT . DS . "header.php"); ?>
</head>
<style>
    * {box-sizing: border-box}
    body {font-family: "Lato", sans-serif;}

    .modal-container {
        max-width: 100%;
        position: relative;
        margin: auto;
        height:40vh;
    }

</style>
<body>
<div id="wrapper">

    <!-- Navbar -->
    <?php include(TEMPLATE_FRONT . DS . "navbar.php"); ?>

    <!-- Main Body -->
    <br>
    <main role="main" class="container" id="body">

        <div class="form-group">
            <input type="text" class="form-control" id="long" placeholder="Search" style="width:40%; float:left;">
        </div>

        <button type="button" class="btn btn-custom" data-toggle="modal" data-target="#Modal" style="width:20%; float:right;">Add <i class="fas fa-plus"></i></button>

        <div class="modal fade" id="Modal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="height:70vh;">

                    <div class="modal-header">
                        <h4 class="modal-title">Add sites</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <div class="row modal-container">
                            <div class="col-md-6">
                                <form action="/action_page.php">Select a CSV <input type="file" name="myFile">
                                    <br><br>
                                </form>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="lat" placeholder="Latitude eg:-33.958732" style="width:80%;">
                                </div>
                                </br>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="long" placeholder="Longitude eg:18.460068" style="width:80%;">
                                </div>

                            </div>

                        </div>
                    </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-custom" data-dismiss="modal">Clear</button>
                            <button type="button" class="btn btn-custom" data-dismiss="modal">Upload</button>
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

</script>
</body>
</html>