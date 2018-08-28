<h3>Pending users</h3>
<hr>
<table class="table table-striped" id="pendinguserTable">
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
                <button type="button" class="btn btn-danger" onclick="location.href='<?php echo URLROOT; ?>/admins/remove_admin/{$id}'">Delete</button>
                <button type="submit" class="btn btn-success" onclick="location.href='<?php echo URLROOT; ?>/admins/edit_admin/{$id}'">Validate</button>
            </div>
        </td>
    </tr>
    </tbody>
</table>