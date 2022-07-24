<?php
include "inc/header.php";
?>
<?php
	if ($_SERVER['REQUEST_METHOD']=="POST"){
	    $fname = $fm->valid($_POST['firstname']);
	    $lname = $fm->valid($_POST['lastname']);
	    $email = $fm->valid($_POST['email']);
	    $body = $fm->valid($_POST['body']);
	    $fname = mysqli_real_escape_string($db->link,$fname);
	    $lname = mysqli_real_escape_string($db->link,$lname);
	    $email = mysqli_real_escape_string($db->link,$email);
	    $body = mysqli_real_escape_string($db->link,$body);

	    $error ="";
	    if (empty($fname)) {
	    	$error = "Filed must not be empty";
	    }elseif(empty($lname)){
	    	$error = "Filed must not be empty";
	    }elseif(empty($email)){
	    	$error = "Filed must not be empty";
	    }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
	    	$error = "Enter Valid Email";
	    }elseif(empty($body)){
	    	$error = "Filed must not be empty";
	    }else{
	    	$msgSql = "INSERT INTO tbl_contact(fname,lname,email,body)VALUES('$fname','$lname','$email','$body')";
                        $msgRes = $db->insert($msgSql);
                        if($msgRes){
                           $msg = "Message send successfully";
                        }else{
                        	$msg = "Message not send";
                        }
	    }
	}
?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2>Contact us</h2>
				<?php 
				if (isset($error)){
					echo "<span style='color:red;font-size:22px;'>{$error}</span>";
				}
				if (isset($msg)) {
					echo "<span style='color:green;font-size:22px;'>{$msg}</span>";
				}
				?>
			<form action="" method="post">
				<table>
				<tr>
					<td>Your First Name:</td>
					<td>
					<input type="text" name="firstname" placeholder="Enter first name"/>
					</td>
				</tr>
				<tr>
					<td>Your Last Name:</td>
					<td>
					<input type="text" name="lastname" placeholder="Enter Last name"/>
					</td>
				</tr>
				
				<tr>
					<td>Your Email Address:</td>
					<td>
					<input type="text" name="email" placeholder="Enter Email Address"/>
					</td>
				</tr>
				<tr>
					<td>Your Message:</td>
					<td>
					<textarea name="body"></textarea>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
					<input type="submit" name="submit" value="Submit"/>
					</td>
				</tr>
		</table>
	<form>				
 </div>

</div>
<?php
include "inc/sidebar.php";
include "inc/footer.php";
?>