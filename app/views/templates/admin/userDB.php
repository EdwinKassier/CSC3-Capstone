<div class="row">
    <div class="col-md-6">
        <h1>Users</h1>
    </div>
    <div class="col-md-6">
        <br>
        <input type="text" id="myInput" onkeyup="user_filter()" placeholder="Search for names.." title="Type in a name">
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
        <th></th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>{$id}</td>
        <td>{$firstname}</td>
        <td>{$lastname}</td>
        <td>{$email}</td>
        <td>{$mobile_number}</td>
        <td>
            <div class="col" style="float:right;padding-bottom:5px;">
                <button type="button" class="btn btn-danger"
                        onclick="location.href='<?php echo URLROOT; ?>/admins/remove_admin/{$id}'">Delete
                </button>
            </div>
        </td>
    </tr>
    </tbody>
</table>

<script>
    function user_filter() {
        var input, filter, table, tr, td, i;
        input = document.getElementById("userInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("user_Table");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
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