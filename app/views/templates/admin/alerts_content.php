<div class="col">
    <div class="row">
        <div class="col-md-10">
            <h1 class="page-header">All Orders </h1>
        </div>
        <div class="col-md-2">
            <form class="" method="post"><input type="text" placeholder="Order ID..." name="search_order"><button type="submit"><i class="fa fa-search"></i></button></form>
            <p></p>
            <button type="button" class="btn btn-primary" onclick="location.href='index.php?pending_orders'"><span>View pending ordrs</span></button>
        </div>
    </div>

    <div class="row">
    <table class="table table-hover">
        <?php get_orders(); ?>
    </table>
</div>