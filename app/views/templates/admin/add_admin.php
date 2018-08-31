<form action="<?php echo URLROOT; ?>/admins/add_admin" method="post">
    <div class="alert-danger text-center"><?php echo $data['error']; ?></div>
    <br>
    <h1>Add Admin</h1>
    <hr>
    <div class="row">
        <div class="col-md-6 form-group">
            <label for="register_name"><b>First name</b></label>
            <input type="text" class="form-control" name="register_name" value="<?php echo $data['name']; ?>" placeholder="Enter first name" required>
        </div>
        <div class="col-md-6 form-group">
            <label for="register_surname"><b>Last name</b></label>
            <input type="text" class="form-control" name="register_surname" value="<?php echo $data['surname']; ?>" placeholder="Enter last name" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 form-group">
            <label for="register_password"><b>Password:</b></label>
            <input type="password" class="form-control" name="register_password" value="<?php echo $data['password']; ?>" placeholder="Enter password" required>
        </div>
        <div class="col-md-6 form-group">
            <label for="register_confirm_password"><b>Confirm Password:</b></label>
            <input type="password" class="form-control" name="register_confirm_password" value="<?php echo $data['confirm_password']; ?>" placeholder="Enter password"required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 form-group">
            <label for="register_email"><b>Email:</b></label>
            <input type="email" class="form-control" name="register_email" value="<?php echo $data['email']; ?>" placeholder="Enter email" required>
        </div>
        <div class="col-md-6 form-group">
            <label for="register_mobile_number"><b>Mobile number</b></label>
            <input type="text" class="form-control" name="register_mobile_number" value="<?php echo $data['mobile_number']; ?>" placeholder="012 345 6789" required>
        </div>
    </div>
    <div class="row" style="float:right;">
        <button type="submit" name="add_admin" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-danger" onclick="location.href='<?php echo URLROOT; ?>/admins/admin'">Back</button>
    </div>
</form>