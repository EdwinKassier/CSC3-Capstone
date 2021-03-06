<!--This is the navigation bar that sits beneath the header-->
<nav class="navbar navbar-expand-lg navbar-dark bg-custom fixed-top">
        <a href="<?php echo URLROOT; ?>" class="navbar-brand">
            <img src="<?php echo URLROOT; ?>/resources/images/logo.png" height="60" class="d-inline-block align-top" alt="Black Eagle logo">
        </a>
        <?php if(isset($_SESSION['user_id'])): ?>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto w-100 justify-content-end">
            <?php if($_SESSION['user_role'] == 1): ?>
                <li style="padding-top:10px; padding-left:10px;">
                    <button type="button" class="btn <?php if(strpos($_SERVER['REQUEST_URI'], 'ornithologist_dashboard')){echo 'btn-active';}else{echo 'btn-outline-custom';} ?>"  onclick="location.href='<?php echo URLROOT; ?>/users/ornithologist_dashboard'">My Nest Sites</button>
                </li>
            <?php endif; ?>
                <li style="padding-top:10px; padding-left:10px;">
                    <button type="button" class="btn <?php if(strpos($_SERVER['REQUEST_URI'], 'wind_farm_dashboard')){echo 'btn-active';}else{echo 'btn-outline-custom';} ?>"  onclick="location.href='<?php echo URLROOT; ?>/users/wind_farm_dashboard'">My Risk Reports</button>
                </li>
                <li style="padding-top:10px; padding-left:10px;">
                    <button type="button" class="btn <?php if(strpos($_SERVER['REQUEST_URI'], 'edit_user')){echo 'btn-active';}else{echo 'btn-outline-custom';} ?>" onclick="location.href='<?php echo URLROOT; ?>/users/edit_user'">Edit Account</button>
                </li>
                <li style="padding-top:10px; padding-left:10px;">
                    <button type="button" class="btn btn-outline-custom"  onclick="location.href='<?php echo URLROOT; ?>/users/logout'">Sign Out</button>
                </li>
            </ul>
        </div>
        <?php endif; ?>
</nav>