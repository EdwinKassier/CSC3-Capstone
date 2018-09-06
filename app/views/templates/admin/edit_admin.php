<!--This is the edit admin page, it allows admins to edit other admins, or their own, details -->
<form action="<?php echo URLROOT; ?>/admins/edit_admin/<?php echo $data['id']; ?>" method="post">
    <div class="alert-danger text-center"><?php echo $data['error']; ?></div>
    <br>
    <h1>Edit Admin</h1>
    <hr>
    <div class="row">
        <div class="col-md-6 form-group">
            <label for="update_name"><b>First name</b></label>
            <input type="text" class="form-control" name="update_name" value="<?php echo $data['name']; ?>"
                   placeholder="Enter first name" required>
        </div>
        <div class="col-md-6 form-group">
            <label for="update_surname"><b>Last name</b></label>
            <input type="text" class="form-control" name="update_surname" value="<?php echo $data['surname']; ?>"
                   placeholder="Enter last name" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 form-group">
            <label for="update_password"><b>Password:</b></label>
            <input type="password" class="form-control" name="update_password" value="<?php echo $data['password']; ?>"
                   placeholder="Enter password to change">
        </div>
        <div class="col-md-6 form-group">
            <label for="update_confirm_password"><b>Confirm Password:</b></label>
            <input type="password" class="form-control" name="update_confirm_password"
                   value="<?php echo $data['confirm_password']; ?>" placeholder="Enter password to change">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 form-group">
            <label for="update_email"><b>Email:</b></label>
            <input type="email" class="form-control" name="update_email" value="<?php echo $data['email']; ?>"
                   placeholder="Enter email" required>
        </div>
        <div class="col-md-6 form-group">
            <label for="update_mobile_number"><b>Mobile number</b></label>
            <input type="text" class="form-control" name="update_mobile_number"
                   value="<?php echo substr_replace(substr_replace($data['mobile_number'], ' ', 6, 0), ' ', 3, 0); ?>"
                   placeholder="012 345 6789" required>
        </div>
    </div>
    <div class="row" style="float:right;">
        <button type="submit" name="edited_admin" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-danger" onclick="location.href='<?php echo URLROOT; ?>/admins/admin'">
            Back
        </button>
    </div>
</form>