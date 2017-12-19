<?php 
require_once("includes\connector.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Register</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

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
			<div class="container" style="width: 920px;
background-color: #F5F5F5;
border: 2px solid black;
background-color:#F5F5F5">

<div class="row">
<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">

	<form role="form" class="register-form" action="<?php echo $_SERVER['SCRIPT_NAME']?>" method="POST" id="register_form">
		<h2>SIGN UP</h2>

		<div class="form-group">
		<label>First Name</label>
		<input type="text" name="firstname" id="firstname" class="form-control input-lg" placeholder="First name" maxlength="25" required /> <br />
		</div>

		<div class="form-group">
		<label>Last Name</label>
		<input type="text" name="lastname" id="lastname" class="form-control input-lg" placeholder="Last name" maxlength="25" required /> <br />
		</div>

		<div class="form-group">
		<label>Username</label>
		<input type="text" name="username" id="username" class="form-control input-lg"placeholder="Username" maxlength="25" required /> <br />
		</div>

		<div class="form-group">
		<label>Email</label>
		<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email" maxlength="60" required /> <br />
		</div>
		
		<div class="form-group">
		<label>Password</label>
		<input type="password" name="password" id="password" class="form-control input-lg"placeholder="Password" required /> <br />
		</div>
		
		<div class="form-group">
		<label> Confirm Password</label>
		<input type="password" name="password2" id="password2" class="form-control input-lg" placeholder="Re-enter password" required /> <br /> 
		</div>
			
			<div class="row">
				<div class="col-xs-12 col-md-6">
				<input type="submit" value="REGISTER" id="register" name="register" class="btn btn-primary btn-block btn-lg" tabindex="7">
				</div>
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
if(isset($_POST['register'])){
	if(!empty($_POST['firstname'])&& !empty($_POST['lastname'])&& !empty($_POST['username'])&& !empty($_POST['email'])&& !empty($_POST['password'])&& 	     !empty($_POST['password2']) ){
		if(strlen($_POST['firstname']>25 || $_POST['lastname']>25) || $_POST['username']>25){
			 echo "<p id='register_response'>Please,keep values within range</p>";
		}
		else{
			//Checking if passwords enterred are the same
			if($_POST['password']!=$_POST['password2']){
				echo "<p id='register_response'>Passwords don't match</p>";
			}else{	
			
				$uppercase=preg_match('@[A-Z]@',$_POST['password']);
				$lowercase=preg_match('@[a-z]@',$_POST['password']);
				$number=preg_match('@[0-9]@',$_POST['password']);
				
				if(!$uppercase || !$lowercase || !$number || strlen($_POST['password'])<8){
					echo "<p id='register_response'>Password should contain a number,uppercase and lowercase letter</p>";
				}
				else{
			
				$firstname=htmlentities($_POST['firstname']);
				$lastname=htmlentities($_POST['lastname']);
				$username=htmlentities($_POST['username']);
				$email=htmlentities($_POST['email']);
				$password=htmlentities($_POST['password']);
				
				
				$user_query="SELECT username FROM users WHERE username=? LIMIT 1";
				$user_stmt=$conn->prepare($user_query);
				$user_stmt->bind_param("s",$username);
				$user_stmt->execute();
				
				if($row=$user_stmt->fetch()){
					echo "<p id='register_response'>Username already exists</p>";
				}
				else{
					$password=password_hash($password,PASSWORD_DEFAULT);
					$date=date("Y-m-d H:i:s",time());
					
					$query="INSERT INTO users(firstname,lastname,username,email,password,date_joined) VALUES (?,?,?,?,?,?)";
					$stmt=$conn->prepare($query);
					$stmt->bind_param("ssssss",$firstname,$lastname,$username,$email,$password,$date);
					$res=$stmt->execute();
					
					if($res){
						session_start();
						$_SESSION['username']=$username;
						header("Location:chat.php");
					}else{
						echo "<p id='register_response'>Couldn't create account</p>".$stmt->error;
					}
				}
				
			}
		}
	
	}
	}else{
		echo "<p id='register_response'>Please,fill in all fields</p>";
	}
}

?>
