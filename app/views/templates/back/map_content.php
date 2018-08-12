<div class="col">
    <div class="row">
        <div class="col-md-10">
            <h1 class="page-header">Users</h1>
        </div>
        <div class="col-md-2">
                <form class="" method="post"><input type="text" placeholder="User ID..." name="search_user"><button type="submit"><i class="fa fa-search"></i></button></form>
        </div>
    </div>
    <p class="bg-success"><?php //echo $message; ?></p>

    <div class="col-md-12">
        <table class="table table-hover">
            <?php get_users(); ?>
        </table>
    </div>   
</div>