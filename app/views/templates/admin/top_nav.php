<!-- Brand and toggle get grouped for better mobile display -->
<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Toggle navigation</span>
    </button>
    <a href="<?php echo URLROOT . '/admins'; ?>" class="navbar-brand">BlackEagle Project Admin</a>
</div>

<!-- Top Menu Items -->
<ul class="nav navbar-right top-nav">
    <li>
        <a><i class="fas fa-user"></i><?php echo " " . $_SESSION['admin_name'] . " " . $_SESSION['admin_surname'] . " "; ?></a>
    </li>
    <li>
        <a href="<?php echo URLROOT; ?>/admins/logout"><i class="fas fa-power-off"></i> Log Out</a>
    </li>
</ul>