<?php
    function navbar_check(){
        if(isset($_SESSION['user_id'])){
            $nav1 = <<<DELIMETER
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav navbar-nav ml-auto w-100 justify-content-end">
DELIMETER;
        
            if($_SESSION['user_role'] == 0){
                $nav2 = <<<DELIMETER
                        <li style="padding-top:10px; padding-left:10px;">
                            <button type="button" class="btn btn-outline-custom"  onclick="location.href='<?php echo APPROOT; ?>/users/wind_farm_dashboard'">My Turbine Sites</button>
                        </li>
                        <li style="padding-top:10px; padding-left:10px;">
                            <button type="button" class="btn btn-outline-custom" onclick="location.href='<?php echo APPROOT; ?>/users/edit_user'">Edit Account</button>
                        </li>
                        <li style="padding-top:10px; padding-left:10px;">
                            <button type="button" class="btn btn-outline-custom"  onclick="location.href='<?php echo APPROOT; ?>/users/map'">Map</button>
                        </li>
                        <li style="padding-top:10px; padding-left:10px;">
                            <button type="button" class="btn btn-outline-custom"  onclick="location.href='<?php echo APPROOT; ?>/pages/logout'">Sign Out</button>
                        </li>
                    </ul>
                </div>
DELIMETER;
            }
            else if($_SESSION['user_role'] == 1){
                $nav2 = <<<DELIMETER
                        <li style="padding-top:10px; padding-left:10px;">
                            <button type="button" class="btn btn-outline-custom"  onclick="location.href='<?php echo APPROOT; ?>/users/ornithologist_dashboard'">My Nest Sites</button>
                        </li>
                        <li style="padding-top:10px; padding-left:10px;">
                            <button type="button" class="btn btn-outline-custom" onclick="location.href='<?php echo APPROOT; ?>/users/edit_user'">Edit Account</button>
                        </li>
                        <li style="padding-top:10px; padding-left:10px;">
                            <button type="button" class="btn btn-outline-custom"  onclick="location.href='<?php echo APPROOT; ?>/users/map'">Map</button>
                        </li>
                        <li style="padding-top:10px; padding-left:10px;">
                            <button type="button" class="btn btn-outline-custom"  onclick="location.href='<?php echo APPROOT; ?>/pages/logout'">Sign Out</button>
                        </li>
                    </ul>
                </div>
DELIMETER;
            }
                
            echo $nav1 . $nav2;
        }
    } 
?>