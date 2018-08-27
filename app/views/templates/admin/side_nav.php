<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <li <?php if($data['view'] == null){echo 'class="active"';} ?>>
            <a href="<?php echo URLROOT; ?>/admins/"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
        </li> 
        <li <?php if($data['view'] == 'map'){echo 'class="active"';} ?>>
            <a href="<?php echo URLROOT; ?>/admins/map"><i class="fa fa-fw fa-table"></i> Map</a>
        </li>            
        <li <?php if($data['view'] == 'alerts'){echo 'class="active"';} ?>>
            <a href="<?php echo URLROOT; ?>/admins/alerts"><i class="fa fa-fw fa-desktop"></i> Alerts</a>
        </li>
        <li <?php if($data['view'] == 'users'){echo 'class="active"';} ?>>
            <a href="<?php echo URLROOT; ?>/admins/users"><i class="fa fa-fw fa-users"></i> Pending Users</a>
        </li>
        <li <?php if($data['view'] == 'admin' || $data['view'] == 'add_admin' || $data['view'] == 'edit_admin'){echo 'class="active"';} ?>>
            <a href="<?php echo URLROOT; ?>/admins/admin"><i class="fa fa-fw fa-wrench"></i> Admins</a>
        </li>
    </ul>
</div>