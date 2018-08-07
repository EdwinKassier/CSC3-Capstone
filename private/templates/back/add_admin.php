<form class="" method="post">
    <div class="container customContainer">
        <?php
        admin();
        
        if(isset($_GET['edit_admin'])){
            $id = escape_string($_GET['edit_admin']);
            $query = query("SELECT * FROM admin WHERE admin_id = '{$id}' ");
            confirm($query);

            while($row = fetch_array($query)):
        
        ?>
        <h3>Edit Admin</h3>
        <hr>
        <div class="form-group">
            <label for="register_email"><b>Email:</b></label>
            <input type="email" class="form-control" name="register_email" value="<?php echo $row['admin_email'];?>" placeholder="Enter email" required>
        </div>
        <div class="form-group">
            <label for="register_password"><b>Password:</b></label>
            <input type="password" class="form-control" name="register_password" placeholder="Enter password to change">
        </div>
        <div class="form-group">
            <label for="cpassword"><b>Confirm Password:</b></label>
            <input type="password" class="form-control" name="cpassword" placeholder="Enter password to change">
        </div>
        <div class="form-group">
            <label for="register_first_name"><b>First name</b></label>
            <input type="text" class="form-control" name="register_first_name" value="<?php echo $row['admin_name'];?>" placeholder="Enter first name" required>
        </div>
        <div class="form-group">
            <label for="register_last_name"><b>Last name</b></label>
            <input type="text" class="form-control" name="register_last_name" value="<?php echo $row['admin_surname'];?>" placeholder="Enter last name" required>
        </div>
        <div class="form-group">
            <label for="register_mobile_number"><b>Mobile number</b></label>
            <input type="text" class="form-control" name="register_mobile_number" value="<?php echo $row['admin_mobile_number'];?>" placeholder="012 345 6789" required>
        </div>
        <button type="submit" name="edited_admin" class="btn btn-primary">Submit</button>
        <?php endwhile;}else{?>
        <h3>Add admin</h3>
        <hr>
        <div class="form-group">
            <label for="register_email"><b>Email:</b></label>
            <input type="email" class="form-control" name="register_email" placeholder="Enter email" required>
        </div>
        <div class="form-group">
            <label for="register_password"><b>Password:</b></label>
            <input type="password" class="form-control" name="register_password" placeholder="Enter password" required>
        </div>
        <div class="form-group">
            <label for="cpassword"><b>Confirm Password:</b></label>
            <input type="password" class="form-control" name="cpassword" placeholder="Enter password"required>
        </div>
        <div class="form-group">
            <label for="register_first_name"><b>First name</b></label>
            <input type="text" class="form-control" name="register_first_name" placeholder="Enter first name" required>
        </div>
        <div class="form-group">
            <label for="register_last_name"><b>Last name</b></label>
            <input type="text" class="form-control" name="register_last_name" placeholder="Enter last name" required>
        </div>
        <div class="form-group">
            <label for="register_mobile_number"><b>Mobile number</b></label>
            <input type="text" class="form-control" name="register_mobile_number" placeholder="012 345 6789" required>
        </div>
        <button type="submit" name="add_admin" class="btn btn-primary">Submit</button>
        <?php }?>        
        <button type="button" class="btn btn-danger" onclick="location.href='index.php?admin'">Back</button>
    </div>
</form>