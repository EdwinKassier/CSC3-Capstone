<div class="col">
    <div class="row">
        <div class="col-md-10">
            <h1 class="page-header">Admins</h1>
        </div>
        <div class="col-md-2">
            <form class="" method="post"><input type="text" placeholder="Admin ID..." name="search_admin"><button type="submit"><i class="fa fa-search"></i></button></form>
            <p></p>
            <button type="button" class="btn btn-primary" onclick="location.href='<?php echo URLROOT; ?>/admins/add_admin'"><span>Add admin</span></button>
        </div>
    </div>

    <div class="col-md-12">
        <table class="table table-hover">
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
                            <button type="submit" class="btn btn-primary" onclick="location.href='<?php echo URLROOT; ?>/admins/edit_admin/{$id}'">Edit</button>
                            <button type="button" class="btn btn-danger" onclick="location.href='<?php echo URLROOT; ?>/admins/remove_admin/{$id}'">Delete</button>   
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>   
</div>