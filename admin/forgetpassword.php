<?php 
include ("../lib/Session.php");
Session::checkSessionTrue();
?>
<?php
include ("../config/config.php");
include ("../lib/Database.php");
include ("../helpers/Format.php");
?>
<?php 
$db = new Database();
$fm = new Format();
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<?php 
		if($_SERVER['REQUEST_METHOD']=="POST"){
			$email = $fm->valid($_POST['email']);

			$email = mysqli_real_escape_string($db->link,$email);
			if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
				echo "Invalid Email Address";
			}else{
				$sql = "SELECT * FROM tbl_user WHERE email ='$email' LIMIT 1";
				$result = $db->select($sql);
				if($result){
					$data = $result->fetch_assoc();
					$userId = $data['id'];
					$username = $data['username'];

					$text = substr($email, 0,3);
					$rand = rand(1000,9999);
					$newPass = "$text$rand";
					$password = md5($newPass);

					$updateSql = "UPDATE tbl_user SET password='$password' WHERE id='$userId'";
                    $forgetPassUpdate = $db->update($updateSql);
                    if ($forgetPassUpdate ) {
                    	$to = $email;
                    	$from = "ismail@gmail.com";
                    	$headers = "From: ".$from."\n";
                    	$headers .= "MIME-Version: 1.0 \r\n";
    					$headers .= "Content-Transfer-Encoding: 8bit \r\n";
    					$subject = "Your Password";
    					$message = "Your username is ".$username." and your new password ".$newPass."Please visit for login";
                    	$mail = mail($to, $subject, $message,$headers);
                    	if ($mail) {
                    		echo "<p style='color:green'>Check your email</p>";
                    	}else{
                    		echo "<p style='color:red'>Email not send</p>";
                    	}
                    }

				}else{
					echo "<p style='color:red'>Your email is wrong</p>";
				}
			}
		}
		?>
		<form action="" method="POST">
			<h1>Password Recovery</h1>
			<div>
				<input type="text" name="email" placeholder="Enter Valid Email"/>
			</div>
			<div>
				<input type="submit" name="login" value="Send Mail" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="login.php">Login</a>
		</div><!-- button -->
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>