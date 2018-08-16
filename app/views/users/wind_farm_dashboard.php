<html lang="en">
    <head>
        <?php include(TEMPLATE_FRONT . DS . "header.php"); ?>
    </head>
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
    <main role="main" class="container" id="body">
        <div class="form-group">
            <input type="text" class="col-md-4 form-control" id="search" name="search" placeholder="Search site name">
            <button type="button" class="col-md-1 btn btn-custom" data-toggle="modal" data-target="#Modal" style="float:right;">Add <i class="fas fa-plus"></i></button>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Site name</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Site #1</td>
                <td>
                    <button type="button" class="btn btn-custom" style="float:right;">Generate report</button>
                </td>
            </tr>
            <tr>
                <td>Site #2</td>
                <td>
                    <button type="button" class="btn btn-custom" style="float:right;">Generate report</button>
                </td>
            </tr>
            <tr>
                <td>Site #3</td>
                <td>
                    <button type="button" class="btn btn-custom" style="float:right;">Generate report</button>
                </td>
            </tr>
            <tr>
                <td>Site #4</td>
                <td>
                    <button type="button" class="btn btn-custom" style="float:right;">Generate report</button>
                </td>
            </tr>
            <tr>
                <td>Site #5</td>
                <td>
                    <button type="button" class="btn btn-custom" style="float:right;">Generate report</button>
                </td>
            </tr>
            <tr>
                <td>Site #6</td>
                <td>
                    <button type="button" class="btn btn-custom" style="float:right;">Generate report</button>
                </td>
            </tr>
            </tbody>
        </table>


        <div class="modal fade" id="Modal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="height:70vh;">
                    <div class="modal-header">
                        <h4 class="modal-title">Add site</h4>
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
                                    <input type="text" class="form-control" id="lat" placeholder="Site name"
                                           style="width:80%;">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-custom" data-dismiss="modal">Close</button>
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

    </script>
    </body>
</html>