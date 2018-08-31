<div class="row">
    <div class="col-md-6">
        <h1>Users</h1>
    </div>
    <div class="col-md-6">
        <br>
        <input type="text" id="myInput" onkeyup="users_filter()" placeholder="Search for names.." title="Type in a name">
    </div>

</div>
<hr>
<table class="table table-striped" id="user_Table">
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

<script>
    function users_filter() {
        var input, filter, table, tr, td, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("user_Table");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

</script>