<?php 
require_once("includes\connector.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login</title>

	<!-- css -->
	<link href="css/bootstrap.min.css" rel="stylesheet" />
	<link href="css/style.css" rel="stylesheet" />

</head>



		
<body>
<!-- start header -->
<header>
	<div class="top" style = "background-color: #000000;">
		<div class="container">
			
						<h1 style ="color:#FFFFFF"><strong>ADVANCED PROGRAMMING CHAT PLATFORM</strong></h1>
					
				</div>
		
	</div>

</header>
		<!-- end header -->
	<section id="content">
		<div class="container" style="width: 520px;
background-color: #F5F5F5;
border: 2px solid black;
background-color:#F5F5F5">

	<div class="row">
		<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			<form role="form" class="login-form" action="<?php echo $_SERVER['SCRIPT_NAME'] ?>" method="post" id="login_form">
				<h2>LOGIN</h2>						

				<div class="form-group">					
					<label>Username</label>
					<input type="text" name="username" id="username" class="form-control input-lg" placeholder="Username" maxlength="25" required tabindex="4"/> <br />
				</div>
				<div class="form-group">					
					<label>Password</label>
					<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" required /> <br />
				</div>


				
				<div class="row">
					<div class="col-xs-12 col-md-6">
						<input type="submit" value="Login" id="login" name="login" class="btn btn-primary btn-block btn-lg" tabindex="7">
					</div>
					<div class="col-xs-12 col-md-6">Don't have an account? <a href="register.php">Register</a></div>
				</div>
			</form>
		</div>
	</div>

</div>
</section>


	</div>
	

</body>

</html>
<?php 
if(isset($_POST['login'])){
	if(!empty($_POST['username']) && !empty($_POST['password'])){
		$username=htmlentities($_POST['username']);
		$password=$_POST['password'];
		
		$query="SELECT username,password FROM users WHERE username=? LIMIT 1";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("s",$username);
		$stmt->execute();
		$stmt->bind_result($user_name,$hash);
		
		if($row=$stmt->fetch()){
			if(password_verify($password,$hash)){
				session_start();
				$_SESSION['username']=$user_name;
				header("Location:chat.php");
				
			
			}
			else{
				echo "<p id='login_response'>Incorrect username or password</p>";
			}
			
		}
		else{
			echo "<p id='login_response'>Incorrect username or password</p>";
		}
			
	}
	else {
		echo "<p id='login_response'>Please fill in all fields</p>";
	}
}

?>
