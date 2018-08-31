<h3>User Database</h3>
<hr>
<table class="table table-striped" id="pendinguserTable">
    <thead style="background-color:lightgray">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Surname</th>
        <th>Email</th>
        <th>Mobile number</th>
        <th>Company/organization name</th>
        <th>Company/organization number</th>
        <th></th>
    </tr>
    </thead> 
    <tbody>
    <?php 
    if(!empty($data['users'])):
        foreach ($data['users'] as $row):
    ?>
    <tr>
        <td><?php echo $row->user_id; ?></td>
        <td><?php echo $row->user_name; ?></td>
        <td><?php echo $row->user_surname; ?></td>
        <td><?php echo $row->user_email; ?></td>
        <td><?php echo $row->user_mobile_number; ?></td>
        <td><?php echo $row->user_organization_name; ?></td>
        <td><?php echo $row->user_organization_number; ?></td>
        <td>
            <div class="col" style="float:right;padding-bottom:5px;">
                <button type="button" class="btn btn-danger" onclick="location.href='<?php echo URLROOT; ?>/admins/remove_user/<?php echo $row->user_id; ?>'">Remove</button>
            </div>
        </td>
    </tr>
    <?php
        endforeach;
    endif;
    ?>
    </tbody>
</table>