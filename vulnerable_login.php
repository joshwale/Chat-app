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
				<input type="text" name="username" id="username" class="form-control input-lg" placeholder="Username" > <br />
			</div>
			<div class="form-group">				
				<label>Password</label>
				<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" /><br />
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
		$conn= mysql_connect('localhost','root','') or die("Couldn't connect to server");
		$db=mysql_select_db('vuln');
		$username=$_POST['username'];
		$password=$_POST['password'];
		
		$query="SELECT username FROM users WHERE username='".$username."' AND password='".$password."'";
		$result=mysql_query($query);
		
		if($row=mysql_fetch_object($result)){
			session_start();
			$_SESSION['username']=$username;
			header("Location:socks.php");
		}else{
			echo "<p id='login_response' style='text-align:center;
					color:#FF0000;
					font-size:1.2em;'>
					Incorrect username or password</p>";
		}
	}
}
?>