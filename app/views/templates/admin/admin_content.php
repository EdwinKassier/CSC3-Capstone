
    <div class="row">
        <div class="col-md-6">
            <h1>Admins</h1>
        </div>
        <div class="col-md-4">
            <br>
            <input type="text" id="myInput" onkeyup="admin_filter()" placeholder="Search for names.." title="Type in a name">
        </div>
        <div class="col-md-2">
            <br>
            <p></p>
            <button type="button" class="btn btn-primary" style="float: right;" onclick="location.href='<?php echo URLROOT; ?>/admins/add_admin'"><span>Add admin</span></button>
        </div>
    </div>

    <hr>
        <table class="table table-striped" id="adminTable">
            <thead style="background-color:lightgray">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Mobile number</th>
                        <th></th>
                    </tr>
            </thead>
            <tbody>
            <?php 
            if(!empty($data['admins'])):
                foreach ($data['admins'] as $row):
            ?>
                <tr>
                    <td><?php echo $row->admin_id; ?></td>
                    <td><?php echo $row->admin_name; ?></td>
                    <td><?php echo $row->admin_surname; ?></td>
                    <td><?php echo $row->admin_username; ?></td>
                    <td><?php echo $row->admin_email; ?></td>
                    <td><?php echo $row->admin_mobile_number; ?></td>
                    <td>
                        <div class="col" style="float:right;padding-bottom:5px;">
                            <button type="submit" class="btn btn-primary" onclick="location.href='<?php echo URLROOT; ?>/admins/edit_admin/<?php echo $row->admin_id; ?>'">Edit</button>
                            <button type="button" class="btn btn-danger" onclick="location.href='<?php echo URLROOT; ?>/admins/remove_admin/<?php echo $row->admin_id; ?>'" <?php if($row->admin_id == $_SESSION['admin_id']){echo 'style="display: none;"';} ?>>Delete</button>
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
        function admin_filter() {
            var input, filter, table, tr, td, i;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("adminTable");
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