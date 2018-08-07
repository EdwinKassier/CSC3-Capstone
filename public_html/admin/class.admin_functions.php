<?php 
//     require_once("../../private/class.config.php");

//     require("../classes/class.config.php");

//     use PHPMailer\PHPMailer\PHPMailer;
//     use PHPMailer\PHPMailer\Exception;

//     require '../vendor/phpmailer/phpmailer/src/Exception.php';
//     require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
//     require '../vendor/phpmailer/phpmailer/src/SMTP.php';

//     if(isset($_GET['remove_admin'])){
//         $id = escape_string($_GET['remove_admin']);
//         $query = query("DELETE FROM admin WHERE admin_id = '{$id}' ");
//         confirm($query);

//         set_message("Admin removed successfully.");
//         redirect("index.php?admin");
//     }

//     function admin(){  
//         if(isset($_POST['edited_admin'])){
//             $id = escape_string($_GET['edit_admin']);
//             $email = escape_string($_POST['register_email']);
//             $flag1 = false;
//             $flag2 = false;
//             if(!empty($_POST['register_password'])){
//                 $password = escape_string($_POST['register_password']);
//                 $flag1 = true;
//             }
//             if(!empty($_POST['cpassword'])){
//                 $confirm_pass = escape_string($_POST['cpassword']);
//                 $flag2 = true;
//             }
//             $name = ucwords(escape_string($_POST['register_first_name']));
//             $surname = ucwords(escape_string($_POST['register_last_name']));
//             $mobile_number = str_replace(' ','', escape_string($_POST['register_mobile_number']));

//             if($password !== $confirm_pass){
//                 set_message("Passwords don't match.");
//                 redirect("index.php?admin");
//             }
//             else{
//                 $query = query("SELECT randSalt FROM admin");
//                 confirm($query);

//                 $row = fetch_array($query);
//                 $salt = $row['randSalt'];
//                 $password = crypt($password, $salt);


//                 $query = "UPDATE admin SET";
        
//                 $query .= " admin_email = '{$email}' ";
        	
//         	if($flag1 == true && $flag2 == true){$query .= ", admin_password = '{$password}' ";}
        
//                 $query .= ", admin_name = '{$name}' ";
        
//                 $query .= ", admin_surname = '{$surname}' ";
        
//                 $query .= ", admin_mobile_number = '{$mobile_number}' ";
        
//                 $query .= "WHERE admin_id = '{$id}' ";
//                 $query = query($query);
//                 confirm($query);
        
//                 set_message("Admin has been updated.");
//                 redirect("index.php?admin");
//             }
//         }
//         else if(isset($_POST['add_admin'])){
//             $email = escape_string($_POST['register_email']);
//             $password = escape_string($_POST['register_password']);
//             $confirm_pass = escape_string($_POST['cpassword']);
//             $name = ucwords(escape_string($_POST['register_first_name']));
//             $surname = ucwords(escape_string($_POST['register_last_name']));
//             $mobile_number = str_replace(' ','', escape_string($_POST['register_mobile_number']));

//             $email_check = query("SELECT admin_email FROM admin WHERE admin_email LIKE '{$email}' ");
//             confirm($email_check);
            
//             if(mysqli_num_rows($email_check) >= 1){
//                 set_message("Email address already registered.");
//                 redirect("index.php?admin");
//             }
//             else if(!in_array("admin@quaintrelledresses",explode(".", $email))){
//                 set_message("Email address must be 'name.admin@quaintrelledresses.co.za'.");
//                 redirect("index.php?admin");
//             }
//             else if(strcmp($password, $confirm_pass) !== 0){
//                 set_message("The passwords do not match.");
//                 redirect("index.php?admin");
//             }
//             else if(!ctype_digit($mobile_number) || strlen($mobile_number) !== 10){
//                 set_message("Mobile number must be an actual number.");
//                 redirect("index.php?admin");
//             }
//             else{
//                 $query = query("SELECT randSalt FROM admin");
//                 confirm($query);

//                 $row = fetch_array($query);
//                 $salt = $row['randSalt'];
//                 $password = crypt($password, $salt);

//                 $query = "INSERT INTO admin (admin_name, admin_surname, admin_password, admin_email, admin_mobile_number) ";
//                 $query .= "VALUES('{$name}','{$surname}','{$password}','{$email}','{$mobile_number}')";
//                 $query = query($query);
//                 confirm($query);

//                 set_message("{$name} {$surname}, was added successfull.");
//                 redirect("index.php?admin");
//             }
//         }
//     }

//     if(isset($_GET['approve_order'])){
//         $id = $_GET['approve_order'];

//         $query = query("SELECT * FROM orders WHERE order_id = '{$id}'");
//         confirm($query);

//         while($row = fetch_array($query)){
//             $order_id = $row['order_id'];
//             $renter_id = $row['renter_id'];
//             $lessor_ids = $row['lessor_id'];
//             $dress_ids = $row['dress_id'];
//         }
//         $lessor_ids = explode(", ", $lessor_ids);
//         $dress_ids = explode(", ", $dress_ids);

//         $query = query("SELECT user_name, email FROM users WHERE user_id = '{$renter_id}'");
//         confirm($query);

//         while($row = fetch_array($query)){
//             $name = $row['user_name'];
//             $email = $row['email'];
//         }

//         $query = query("UPDATE orders SET pending = '0' AND payed = '1' WHERE order_id = '{$id}'");
//         confirm($query);

//         /**
//          * 
//          * configure phpmailer
//          * 
//          */

//         $mail = new PHPMailer();

        
//         $mail->IsSMTP();
//         $mail->Host = config::SMTP_HOST;
//         $mail->Username = config::SMTP_USER;             
//         $mail->Password = config::SMTP_PASSWORD;   
//         $mail->Port = config::SMTP_PORT;      
//         $mail->SMTPAuth = false;
//         $mail->SMTPSecure = false;  
//         $mail->isHTML(true);      
//         $mail->CharSet = 'UTF-8';    
//         $mail->SMTPOptions = array(
// 	    'ssl' => array(
// 	        'verify_peer' => false,
// 	        'verify_peer_name' => false,
// 	        'allow_self_signed' => true
// 	    )
// 	);

//     	$mail->SetFrom("no-reply@quaintrelledresses.co.za", "Quaintrelle Dresses");
//     	$mail->AddAddress($email);

//         $mail->Subject = "Payment recieved";
//         $mail->Body = '<p>Hi '.$name.'!</p><p></p>
//         <p>The payment for order '.$order_id.' has been received!</p>
//         <hr>';
//         foreach($dress_ids as $dress_id){
//             if($dress_id != ""){
                    
//                     $query = query("SELECT * FROM dresses WHERE dress_id = " . $dress_id . " ");
//                     confirm($query);

//                     while($row = fetch_array($query)){
//                         $dress_name = $row['dress_name'];
//                         $dress_price = $row['dress_price'];
//                         $user_id = $row['user_id'];
//                         $province = $row['dress_province'];
//                         $area = $row['dress_area'];

//                         $query2 = query("SELECT * FROM users WHERE user_id = " . $user_id . " ");
//                         confirm($query2);

//                         while($row = fetch_array($query2)){
//                             $user_name = $row['user_name'];
//                             $user_surname = $row['user_surname'];
//                             $user_email = $row['email'];
//                             $mobile_number = $row['mobile_number'];
//                         }
//                     }   
           
//                     $mail->Body .= '<div class="row">
//                         <div class="col">
//                             <h5>Dress and owner details:</h5>';
//                             $mail->Body .= '<p>Dress name: '. $dress_name .'</p>';
//                             $mail->Body .= '<p>Dress price: R'. $dress_price .'</p>';
//                             $mail->Body .= '<p>Province: '. $province .'</p>';
//                             $mail->Body .= '<p>Area: '. $area .'</p>';
//                             $mail->Body .= "<p>Owner's name: ". $user_name ."</p>";
//                             $mail->Body .= "<p>Owner's surname: ". $user_surname ."</p>";
//                             $mail->Body .= "<p>Owner's email: ". $user_email ."</p>";
//                             $mail->Body .= "<p>Owner's mobile number: ". $mobile_number ."</p>
//                         </div>
//                     </div><hr>";            
//             }
//          }
//         $mail->Body .='<p></p><p>Please feel free to contact us with any queries you may have about this process.</p>
//         <p></p><p>- The Quaintrelle Dresses Team</p>';

//         $mail->send();

//         foreach($lessor_ids as $lessor_id){
//             if($lessor_id != ""){
//                 $query = query("SELECT user_name, email FROM users WHERE user_id = " . $lessor_id . " ");
//                 confirm($query);

//                 while($row = fetch_array($query)){
//                     $user_name = $row['user_name'];
//                     $email = $row['email'];
//                 }

//                 $mail = new PHPMailer();

                
// 	        $mail->IsSMTP();
// 	        $mail->Host = config::SMTP_HOST;
// 	        $mail->Username = config::SMTP_USER;             
// 	        $mail->Password = config::SMTP_PASSWORD;   
// 	        $mail->Port = config::SMTP_PORT;      
// 	        $mail->SMTPAuth = false;
// 	        $mail->SMTPSecure = false;  
// 	        $mail->isHTML(true);      
// 	        $mail->CharSet = 'UTF-8';    
// 	        $mail->SMTPOptions = array(
// 		    'ssl' => array(
// 		        'verify_peer' => false,
// 		        'verify_peer_name' => false,
// 		        'allow_self_signed' => true
// 		    )
// 		);
	
// 	   	$mail->SetFrom("no-reply@quaintrelledresses.co.za", "Quaintrelle Dresses");
// 	   	$mail->AddAddress($email);

//                 $mail->Subject = "Contact details purchased";
//                 $mail->Body = '<p>Hi '.$user_name.'!</p><p></p>
//                 <p>We’re just checking in to let you know that your contact details were recently purchased and that a lessee should be in contact with you soon!</p>
//                 <p>When leasing your dress, we would highly recommend that you:</p>
//                 <ul>
//                     <li>Take a deposit on your dress.</li>
//                     <li>Photograph your dress before it is used.</li>
//                     <li>Take a copy of the lessees ID.</li>
//                     <li>Confirm the date on which your dress will be returned.</li>
//                     <li>Clearly communicate the terms of your dress’s return (Should it be cleaned? Are alterations allowed?)</li>
//                     <li>Take the contact details of the lessee so that you can contact them with ease.</li>
//                 </ul>
//                 <p></p><p>- The Quaintrelle Dresses Team</p>';

//                 $mail->send();
//             }
//         }
        
//         set_message("Order has been approved.");
//         redirect("index.php?pending_orders");
//     }

//     if(isset($_GET['remove_order'])){
//         $id = $_GET['remove_order'];
//         $query = query("DELETE FROM orders WHERE order_id = '{$id}'");
//         confirm($query);

//         set_message("Order has been removed.");
//         redirect("index.php?pending_orders");
//     }

//     if(isset($_GET['approve_product'])){
//         $id = $_GET['approve_product'];

//         $query = query("UPDATE dresses SET available = '1' WHERE dress_id = '{$id}'");
//         confirm($query);

//         $query = query("SELECT user_id FROM dresses WHERE dress_id = " . $id . " ");
//         confirm($query);

//         while($row = fetch_array($query)){
//             $user_id = $row['user_id'];
//         }

//         $query = query("SELECT user_name, email FROM users WHERE user_id = " . $user_id . " ");
//         confirm($query);

//         while($row = fetch_array($query)){
//             $user_name = $row['user_name'];
//             $email = $row['email'];
//         }
        
//          $mail = new PHPMailer();

// 	    $mail->IsSMTP();

// 	    $mail->Host = config::SMTP_HOST;
// 	    $mail->Username = config::SMTP_USER;             
// 	    $mail->Password = config::SMTP_PASSWORD;   
// 	    $mail->Port = config::SMTP_PORT;      
// 	    $mail->SMTPAuth = false;
// 	    $mail->SMTPSecure = false;  
// 	    $mail->isHTML(true);      
// 	    $mail->CharSet = 'UTF-8';    
// 	    $mail->SMTPOptions = array(
// 		    'ssl' => array(
// 		        'verify_peer' => false,
// 		        'verify_peer_name' => false,
// 		        'allow_self_signed' => true
// 		    )
// 		);
	
// 	    $mail->SetFrom("no-reply@quaintrelledresses.co.za", "Quaintrelle Dresses");
// 	    $mail->AddAddress($email);

//         $mail->Subject = "Dress approved";
//         $mail->Body = '<p>Hi '.$user_name.'!</p><p></p>
//         <p>We’re just checking in to let you know that your dress has been approved and will appear in your closet once you log into your account.</p>
//         <p>Thank you for your patience and please feel free to contact us with any queries you may have regarding this process.</p>
//         <p></p><p>- The Quaintrelle Dresses Team</p>';

//         $mail->send();

//         set_message("Dress has been approved.");
//         redirect("index.php?dresses");
//     }
    
//     if(isset($_GET['remove_product'])){
//         $id = $_GET['remove_product'];

//         $query = query("SELECT user_id FROM dresses WHERE dress_id = " . $id . " ");
//         confirm($query);

//         while($row = fetch_array($query)){
//             $user_id = $row['user_id'];
//         }

//         $query = query("SELECT user_name, email FROM users WHERE user_id = " . $user_id . " ");
//         confirm($query);

//         while($row = fetch_array($query)){
//             $user_name = $row['user_name'];
//             $email = $row['email'];
//         }
        
//         $mail = new PHPMailer();

        
//         $mail->IsSMTP();
//         $mail->Host = config::SMTP_HOST;
//         $mail->Username = config::SMTP_USER;             
//         $mail->Password = config::SMTP_PASSWORD;   
//         $mail->Port = config::SMTP_PORT;      
//         $mail->SMTPAuth = false;
//         $mail->SMTPSecure = false;  
//         $mail->isHTML(true);      
//         $mail->CharSet = 'UTF-8';    
//         $mail->SMTPOptions = array(
// 	    'ssl' => array(
// 	        'verify_peer' => false,
// 	        'verify_peer_name' => false,
// 	        'allow_self_signed' => true
// 	    )
// 	);

//     	$mail->SetFrom("no-reply@quaintrelledresses.co.za", "Quaintrelle Dresses");
//     	$mail->AddAddress($email);

//         $mail->Subject = "Dress not approved";
//         $mail->Body = '<p>Hi '.$user_name.'!</p><p></p>
//         <p>We’re just checking in to let you know that your dress has not been approved and will not appear in your closet once you log into your account.</p>
//         <p>Thank you for your patience and please feel free to contact us with any queries you may have regarding this process.</p>
//         <p></p><p>- The Quaintrelle Dresses Team</p>';

//         $mail->send();

//         $query = query("DELETE FROM dresses WHERE dress_id = '{$id}'");
//         confirm($query);

//         set_message("Dress has been removed.");
//         redirect("index.php?dresses");
//     }

//     function add_remove_category(){
//             if(isset($_POST['add_category']) && $_POST['select'] != ""){
//                 $pre_array = ucwords($_POST['add_remove']);
//                 $array = explode(", ",$pre_array);
//                 $cat = $_POST['select'];

//                 foreach($array as $row){
//                     if($cat == 1){
//                         $query = query("INSERT INTO dress_type_cat (type_name) VALUES ('{$row}')");
//                         confirm($query);
//                     }
//                     else if($cat == 2){
//                         $query = query("INSERT INTO dress_colour_cat (colour_name) VALUES ('{$row}')");
//                         confirm($query);
//                     }
//                 }
                
//                 set_message("Category items added successfully.");
//                 redirect("index.php?categories");
//             }
//             else if(isset($_POST['remove_category']) && $_POST['select'] != ""){
//                 $pre_array = ucwords($_POST['add_remove']);
//                 $array = explode(", ",$pre_array);
//                 $cat = $_POST['select'];

//                 foreach($array as $row){
//                     if($cat == 1){
//                         $query = query("DELETE FROM dress_type_cat WHERE type_name = '{$row}'");
//                         confirm($query);
//                     }
//                     else if($cat == 2){
//                         $query = query("DELETE FROM dress_colour_cat WHERE colour_name = '{$row}'");
//                         confirm($query);
//                     }
//                 }

//                 set_message("Category items removed successfully.");
//                 redirect("index.php?categories");
//             }
//         }

//     if(isset($_GET['remove_user'])){
//         $id = escape_string($_GET['remove_user']);
//         $query = query("UPDATE users SET removed = '1' WHERE user_id = '{$id}' ");
//         confirm($query);

//         set_message("User removed successfully.");
//         redirect("index.php?users");
//     }

//     function get_admin(){
//         if(isset($_POST['search_admin']) && escape_string($_POST['search_admin']) != ""){
//             $id = escape_string($_POST['search_admin']);
//             $query = query("SELECT * FROM admin WHERE admin_id = '{$id}' ORDER BY `admin`.`admin_id` ASC");
//         }  
//         else{ 
//             $query = query("SELECT * FROM `admin` ORDER BY `admin`.`admin_id` ASC");
//         }
//         confirm($query);

//         while($row = fetch_array($query)){
//             $id = $row['admin_id'];
//             $firstname = $row['admin_name'];
//             $lastname = $row['admin_surname'];
//             $email = $row['admin_email'];
//             $mobile_number = $row['admin_mobile_number'];

//             $output1 = <<<DELIMETER
//             <thead style="background-color:lightgray">
//                 <tr>
//                     <th>ID</th>
//                     <th>Name</th>
//                     <th>Surname</th>
//                     <th>Email</th>
//                     <th>Mobile number</th>
//                     <th></th>
//                 </tr>
//             </thead>
//             <tbody>
//                 <tr>
//                     <td>{$id}</td>
//                     <td>{$firstname}</td>
//                     <td>{$lastname}</td>
//                     <td>{$email}</td>
//                     <td>{$mobile_number}</td>
//                     <td>
//                         <div class="col" style="float:right;padding-bottom:5px;">
//                             <button type="submit" class="btn btn-primary" onclick="location.href='index.php?edit_admin={$id}'">Edit</button>
// DELIMETER;
//                 $output2 = "";
//                 if($id != $_SESSION['admin_id']){
//                 $output2 = <<<DELIMETER
//                                             <button type="button" class="btn btn-danger" onclick="location.href='admin_function.php?remove_admin={$id}'">Delete</button>   
// DELIMETER;
//             }
//             $output3 = <<<DELIMETER
//                                     </div>
//                                 </td>
//                             </tr>
//                         </tbody>
// DELIMETER;

//             echo $output1.$output2.$output3;
//         }
//     }

//     function get_users(){
//         if(isset($_POST['search_user']) && escape_string($_POST['search_user']) != ""){
//             $id = escape_string($_POST['search_user']);
//             $query = query("SELECT * FROM `users` WHERE user_id = '{$id}' ORDER BY `users`.`user_id` ASC");
//         }  
//         else{ 
//             $query = query("SELECT * FROM `users` ORDER BY `users`.`user_id` ASC");
//         }
//         confirm($query);

//         while($row = fetch_array($query)){
//             $id = $row['user_id'];
//             $firstname = $row['user_name'];
//             $lastname = $row['user_surname'];
//             $email = $row['email'];
//             $mobile_number = $row['mobile_number'];

//             $output = <<<DELIMETER
//             <thead style="background-color:lightgray">
//                 <tr>
//                     <th>ID</th>
//                     <th>First Name</th>
//                     <th>Last Name</th>
//                     <th>Email</th>
//                     <th>Mobile number</th>
//                     <th></th>
//                 </tr>
//             </thead>
//             <tbody>
//                 <tr>
//                     <td>{$id}</td>
//                     <td>{$firstname}</td>
//                     <td>{$lastname}</td>
//                     <td>{$email}</td>
//                     <td>{$mobile_number}</td>
//                     <td>
//                         <div class="col" style="float:right;padding-bottom:5px;">
//                             <button type="button" class="btn btn-danger" onclick="location.href='admin_function.php?remove_user={$id}'">Delete</button>   
//                         </div>
//                     </td>
//                 </tr>
//             </tbody>
// DELIMETER;

//             echo $output;
//         }
//     }

//     function get_pending_dresses(){
//         $query = query("SELECT * FROM dresses WHERE available = 0 ORDER BY `dresses`.`dress_id` ASC");
//         confirm($query);

//         while($row = fetch_array($query)){
//             $id = $row['dress_id'];
//             $name = $row['dress_name'];
//             $description = $row['dress_description'];
//             $price = $row['dress_price'];
//             $colour = $row['dress_colour'];
//             $type = $row['dress_type'];
//             $province = $row['dress_province'];
//             $area = $row['dress_area'];
//             $size = $row['dress_size'];
//             $bust = $row['bust'];
//             $waist = $row['waist'];
//             $hips = $row['hip'];
//             $height = $row['height'];
//             $img1 = "../../resources/uploads/" . $row['dress_image1'];
//             $img2 = "../../resources/uploads/" . $row['dress_image2'];
//             $img3 = "../../resources/uploads/" . $row['dress_image3'];

//             $output = <<<DELIMETER
//             <thead style="background-color:lightgray">
//                 <tr>
//                     <th>ID</th>
//                     <th>Name</th>
//                     <th>Price</th>
//                     <th>Colour</th>
//                     <th>Type</th>
//                     <th>Province</th>
//                     <th>Area</th>
//                     <th>Size</th>
//                     <th>Bust</th>
//                     <th>Waist</th>
//                     <th>Hips</th>
//                     <th>Height</th>
//                 </tr>
//             </thead>
//             <tbody>
//                 <tr>
//                     <td>{$id}</td>
//                     <td>{$name}</td>
//                     <td>R{$price}</td>
//                     <td>{$colour}</td>
//                     <td>{$type}</td>
//                     <td>{$province}</td>
//                     <td>{$area}</td>
//                     <td>UK {$size}</td>
//                     <td>{$bust} cm</td>
//                     <td>{$waist} cm</td>
//                     <td>{$hips} cm</td>
//                     <td>{$height} cm</td>
//                 </tr>
//             </tbody>
//             <tbody>
//                 <tr>
//                     <td></td>
//                     <td style="text-align:justify;"><strong>Description</strong><p>{$description}</p></td>
//                     <td></td>
//                     <td></td>
//                     <td><strong>Image 1</strong><img class="img-responsive img-fluid" src="{$img1}" alt="{$name} image 1"></td>
//                     <td><strong>Image 2</strong><img class="img-responsive img-fluid" src="{$img2}" alt="{$name} image 2"></td>
//                     <td><strong>Image 3</strong><img class="img-responsive img-fluid" src="{$img3}" alt="{$name} image 3"></td>
//                     <td></td>
//                     <td></td>
//                     <td></td>
//                     <td><button type="submit" class="btn btn-primary" onclick="location.href='admin_function.php?approve_product={$id}'">Approve</button></td>
//                     <td><button type="button" class="btn btn-danger" onclick="location.href='admin_function.php?remove_product={$id}'">Remove</button></td>
//                 </tr>
//             </tbody>
// DELIMETER;

//             echo $output;
//         }
//     }

//     function get_orders(){
//         if(isset($_POST['search_order']) && escape_string($_POST['search_order']) != ""){
//             $id = escape_string($_POST['search_order']);
//             $query = query("SELECT * FROM `orders` WHERE order_id = '{$id}' AND payed = 1 ORDER BY `orders`.`order_id` ASC");
//         }
//         else{ 
//             $query = query("SELECT * FROM `orders` WHERE payed = 1 ORDER BY `orders`.`order_id` ASC");
//         }
//         confirm($query);

//         while($row = fetch_array($query)){
//             $order_id = $row['order_id'];
//             $renter_id = $row['renter_id'];
//             $dresses = $row['amount_dresses'];
//             $price = $row['price'];
//             $date = $row['date'];

//             $output = <<<DELIMETER
//             <thead style="background-color:lightgray">
//                 <tr>
//                     <th>Order ID</th>
//                     <th>Renter ID</th>
//                     <th>Amount of dresses</th>
//                     <th>Amount payable</th>
//                     <th>Order date</th>
//                 </tr>
//             </thead>
//             <tbody>
//                 <tr>
//                     <td>{$order_id}</td>
//                     <td>{$renter_id}</td>
//                     <td>{$dresses}</td>
//                     <td>R{$price}</td>
//                     <td>{$date}</td>
//                 </tr>
//             </tbody>
// DELIMETER;

//             echo $output;
//         }
//     }

//     function get_pending_orders(){
//         if(isset($_POST['search_order']) && escape_string($_POST['search_order']) != ""){
//             $id = escape_string($_POST['search_order']);
//             $query = query("SELECT * FROM `orders` WHERE order_id = '{$id}' AND pending = 1 ORDER BY `orders`.`order_id` ASC");
//         }  
//         else{ 
//             $query = query("SELECT * FROM `orders` WHERE pending = 1 ORDER BY `orders`.`order_id` ASC");
//         }
//         confirm($query);

//         while($row = fetch_array($query)){
//             $order_id = $row['order_id'];
//             $renter_id = $row['renter_id'];
//             $dresses = $row['amount_dresses'];
//             $price = $row['price'];
//             $date = $row['date'];

//             $output = <<<DELIMETER
//             <thead style="background-color:lightgray">
//                 <tr>
//                     <th>Order ID</th>
//                     <th>Renter ID</th>
//                     <th>Amount of dresses</th>
//                     <th>Amount payable</th>
//                     <th>Order date</th>
//                     <th></th>
//                 </tr>
//             </thead>
//             <tbody>
//                 <tr>
//                     <td>{$order_id}</td>
//                     <td>{$renter_id}</td>
//                     <td>{$dresses}</td>
//                     <td>R{$price}</td>
//                     <td>{$date}</td>
//                     <td>
//                     <div class="row" style="float:right;">
//                         <div class="col" style="padding-bottom:5px;">
//                             <button type="submit" class="btn btn-primary" onclick="location.href='index.php?approve_order={$order_id}'">Approve</button>
//                         </div>
//                         <div class="col">
//                             <button type="button" class="btn btn-danger" onclick="location.href='index.php?remove_order={$order_id}'">Remove</button>   
//                         </div>
//                     </div>
//                 </td>
//                 </tr>
//             </tbody>
// DELIMETER;

//             echo $output;
//         }
//     }

//     function get_recent_orders(){
//         $query = query("SELECT * FROM `orders` WHERE payed = 1 ORDER BY `orders`.`order_id` DESC LIMIT 50");
//         confirm($query);

//         while($row = fetch_array($query)){
//             $order_id = $row['order_id'];
//             $renter_id = $row['renter_id'];
//             $dresses = $row['amount_dresses'];
//             $price = $row['price'];
//             $date = $row['date'];

//             $output = <<<DELIMETER
//                 <tr>
//                     <td>{$order_id}</td>
//                     <td>{$renter_id}</td>
//                     <td>{$dresses}</td>
//                     <td>R{$price}</td>
//                     <td>{$date}</td>
//                 </tr>
// DELIMETER;

//             echo $output;
//         }
//     }
?>