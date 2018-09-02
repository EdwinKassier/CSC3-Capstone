<style>
    .table td {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;

    }

    .table th {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;

    }
</style>

<div class="row">
    <div class="col-md-6">
        <h1>Pending Users</h1>
    </div>
    <div class="col-md-6">
        <br>
        <input type="text" id="myInput" onkeyup="pending_filter()" placeholder="Search for names.." title="Type in a name">
    </div>

</div>
<hr>
<table class="table table-striped" id="pending_Table">
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
    if(!empty($data['pending_users'])):
        foreach ($data['pending_users'] as $row):
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
                <button type="submit" class="btn btn-primary" onclick="location.href='<?php echo URLROOT; ?>/admins/validate_user/<?php echo $row->user_id; ?>'">Validate</button>
                <button type="button" class="btn btn-danger" onclick="location.href='<?php echo URLROOT; ?>/admins/reject_user/<?php echo $row->user_id; ?>'">Remove</button>
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
    function pending_filter() {
        var input, filter, table, tr, td, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("pending_Table");
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