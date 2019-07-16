<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <li <?php if($data['view'] == null){echo 'class="active"';} ?>>
            <a href="<?php echo URLROOT; ?>/admins/"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        </li> 
        <li <?php if($data['view'] == 'map'){echo 'class="active"';} ?>>
            <a href="<?php echo URLROOT; ?>/admins/map"><i class="fas fa-table"></i> Map</a>
        </li>            
        <li <?php if($data['view'] == 'users'){echo 'class="active"';} ?>>
            <a href="<?php echo URLROOT; ?>/admins/users"><i class="fas fa-users"></i> Pending Users</a>
        </li>
        <li <?php if($data['view'] == 'users_content'){echo 'class="active"';} ?>>
            <a href="<?php echo URLROOT; ?>/admins/users_content"><i class="fas fa-database"></i> Users</a>
        </li>
        <li <?php if($data['view'] == 'admin' || $data['view'] == 'add_admin' || $data['view'] == 'edit_admin'){echo 'class="active"';} ?>>
            <a href="<?php echo URLROOT; ?>/admins/admin"><i class="fas fa-wrench"></i> Admins</a>
        </li>
    </ul>
</div>