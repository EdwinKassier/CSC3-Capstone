<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <li <?php if($_SERVER['REQUEST_URI'] == "/public_html/admin/" || $_SERVER['REQUEST_URI'] == "/public_html/admin/index"){echo 'class="active"';} ?>>
            <a href="index"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
        </li> 
        <li <?php if(isset($_GET['map'])){echo 'class="active"';} ?>>
            <a href="index.php?map"><i class="fa fa-fw fa-table"></i> Map</a>
        </li>            
        <li <?php if(isset($_GET['alerts'])){echo 'class="active"';} ?>>
            <a href="index.php?alerts"><i class="fa fa-fw fa-desktop"></i> Alerts</a>
        </li>
        <li <?php if(isset($_GET['users'])){echo 'class="active"';} ?>>
            <a href="index.php?users"><i class="fa fa-fw fa-users"></i> Pending Users</a>
        </li>
        <li <?php if(isset($_GET['admin']) || isset($_GET['add_admin']) || isset($_GET['edit_admin'])){echo 'class="active"';} ?>>
            <a href="index.php?admin"><i class="fa fa-fw fa-wrench"></i> Admins</a>
        </li>
    </ul>
</div>