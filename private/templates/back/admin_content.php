<div class="col">
    <div class="row">
        <div class="col-md-10">
            <h1 class="page-header">Admins</h1>
        </div>
        <div class="col-md-2">
            <form class="" method="post"><input type="text" placeholder="Admin ID..." name="search_admin"><button type="submit"><i class="fa fa-search"></i></button></form>
            <p></p>
            <button type="button" class="btn btn-primary" onclick="location.href='index.php?add_edit_admin'"><span>Add admin</span></button>
        </div>
    </div>
    <?php admin(); ?>

    <div class="col-md-12">
        <table class="table table-hover">
            <?php get_admin(); ?>
        </table>
    </div>   
</div>