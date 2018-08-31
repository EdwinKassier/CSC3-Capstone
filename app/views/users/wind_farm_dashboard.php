<html lang="en">
<head>
    <?php include(TEMPLATE_FRONT . DS . "header.php"); ?>
</head>
<style>
    tbody {
        display:block;
        height:300px;
        overflow:auto;
    }
</style>
<body>

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
    <main role="main" class="container" id="body">
        
        <div class="row">
            <div class="col-md-8">
                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
            </div>
            <div class="col-md-4">
                <button type="button" class="col-md-4 btn btn-custom" data-toggle="modal" data-target="#Modal" style="float:right;">Add <i class="fas fa-plus"></i></button>
            </div>
        </div>
        <br>
        <br>
        <div class="container">
            <table class="table table-striped" id="siteTable">
                <thead>
                <tr class = "header">
                    <td>Site name</td>
                    <td></td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Site #1</td>
                    <td>
                        <button type="button" class="btn btn-custom" data-toggle="modal" data-target="#alertModal" style="float:right;">Generate report</button>
                    </td>
                </tr>
                <tr>
                    <td>Site #2</td>
                    <td>
                        <button type="button" class="btn btn-custom" data-toggle="modal" data-target="#alertModal" style="float:right;">Generate report</button>
                    </td>
                </tr>
                <tr>
                    <td>Site #3</td>
                    <td>
                        <button type="button" class="btn btn-custom" data-toggle="modal" data-target="#alertModal" style="float:right;">Generate report</button>
                    </td>
                </tr>
                <tr>
                    <td>Site #4</td>
                    <td>
                        <button type="button" class="btn btn-custom" data-toggle="modal" data-target="#alertModal" style="float:right;">Generate report</button>
                    </td>
                </tr>
                <tr>
                    <td>Site #5</td>
                    <td>
                        <button type="button" class="btn btn-custom" data-toggle="modal" data-target="#alertModal" style="float:right;">Generate report</button>
                    </td>
                </tr>
                <tr>
                    <td>Site #6</td>
                    <td>
                        <button type="button" class="btn btn-custom" data-toggle="modal" data-target="#alertModal" style="float:right;">Generate report</button>
                    </td>
                </tr>
                <tr>
                    <td>Site #7</td>
                    <td>
                        <button type="button" class="btn btn-custom" data-toggle="modal" data-target="#alertModal" style="float:right;">Generate report</button>
                    </td>
                </tr>
                <tr>
                    <td>Site #8</td>
                    <td>
                        <button type="button" class="btn btn-custom" data-toggle="modal" data-target="#alertModal" style="float:right;">Generate report</button>
                    </td>
                </tr>
                </tbody>
            </table>
            <hr>
        </div>


        <div class="modal fade" id="Modal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="height:70vh;">

                    <div class="modal-header" style="height: 100%;">
                        <h4 class="modal-title">Add site</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <div class="row modal-container">
                            <div class="col-md-6">
                                <div class="custom-file" style="padding: 30px;">
                                    <input id="file1" type="file" class="custom-file-input">
                                    <label for="file1" class="custom-file-label text-truncate">Choose file...(.shp,.shx,.sbn)</label>
                                </div>

                                <div class="custom-file" style="padding: 30px;">
                                    <input id="file2" type="file" class="custom-file-input">
                                    <label for="file2" class="custom-file-label text-truncate">Choose file...(.shp,.shx,.sbn)</label>
                                </div>

                                <div class="custom-file" style="padding: 30px;">
                                    <input id="file3" type="file" class="custom-file-input">
                                    <label for="file3" class="custom-file-label text-truncate">Choose file...(.shp,.shx,.sbn)</label>
                                </div>

                                <div class="custom-file" style="padding: 30px;">
                                    <input id="file4" type="file" class="custom-file-input">
                                    <label for="file4" class="custom-file-label text-truncate">Choose file...(.shp,.shx,.sbn)</label>
                                </div>

                                <div class="custom-file" style="padding: 30px;">
                                    <input id="file5" type="file" class="custom-file-input">
                                    <label for="file5" class="custom-file-label text-truncate">Choose file...(.shp,.shx,.sbn)</label>
                                </div>
                                <br><br>
                                </form>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="lat" placeholder="Site name"
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


        <div class="modal fade" id="alertModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="height:70vh;">

                    <div class="modal-header">
                        <h2 class="modal-title">Black Eagle Project</h2>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <div class="row modal-container">
                            <p>Your risk report is currently being processed, it could take awhile(up to five minutes) to finish, so please be patient.The download  will automatically commence when it has finished.</p>
                            <p>If you would like to learn more about the model used to generate the report you can see that <a href="http://blackeagleproject.blogspot.com/" target="_blank">here.</a></p>
                        </div>
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
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

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

    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
</body>
</html>