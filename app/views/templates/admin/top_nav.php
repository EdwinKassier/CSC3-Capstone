<!-- Brand and toggle get grouped for better mobile display -->
<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand">BlackEagle Project Admin</a>
</div>

<?php
    // $query = query("SELECT * FROM admin WHERE admin_id =" . $_SESSION['admin_id'] . " ");
    // confirm($query);

    // while($row = fetch_array($query)):
?>

<!-- Top Menu Items -->
<ul class="nav navbar-right top-nav">
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><?php //echo " " . $row['admin_name'] . " " . $row['admin_surname'] . " "; ?><b class="caret"></b></a>
        <ul class="dropdown-menu">
            
            <li class="divider"></li>
            <li>
                <a href="../logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
            </li>
        </ul>
    </li>
</ul>
<?php //endwhile;?>