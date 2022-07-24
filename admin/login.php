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
			$username = $fm->valid($_POST['username']);
			$password = $fm->valid(md5($_POST['password']));

			$username = mysqli_real_escape_string($db->link,$username);
			$password = mysqli_real_escape_string($db->link,$password);
			$sql = "SELECT * FROM tbl_user WHERE username ='$username' AND password = '$password'";
			$result = $db->select($sql);
			if($result){
				$data = $result->fetch_assoc();
				Session::set("login",true);
				Session::set("userId",$data['id']);
				Session::set("username",$data['username']);
				Session::set("userRole",$data['role']);
				header("Location:index.php");
			}else{
				echo "<p style='color:red'>Your username or password wrong</p>";
			}
		}
		?>
		<form action="login.php" method="POST">
			<h1>Admin Login</h1>
			<div>
				<input type="text" name="username" placeholder="Username" required=""/>
			</div>
			<div>
				<input type="password" name="password" placeholder="Password" required=""/>
			</div>
			<div>
				<input type="submit" name="login" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="forgetpassword.php">Forgot Password</a>
		</div><!-- button -->
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>