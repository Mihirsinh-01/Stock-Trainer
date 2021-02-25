<?php

	session_start();
	error_reporting(0);
	include("include/config.php");

	if(isset($_POST['submit'])){
		$user=$_POST['username'];
		$pass=$_POST['password'];

		$sql1= "SELECT password FROM login WHERE username='".$user."'";

		$result = $conn->query($sql1);
		if ($result->num_rows > 0) {
			$ans=null;
			while($row = $result->fetch_assoc()) {
				$ans=$row["password"];
			}
			if($pass==$ans){
				$_SESSION['username']=$username;
				echo '<script type="text/javascript"> window.location = "registration.php" </script>';
			}
			else{
				echo "<script>document.getElementById('msg2').style.color = 'red';
				document.getElementById('msg2').innerHTML = 'Wrong password';</script>";
			}
		}
		else{
			echo "<script>document.getElementById('msg1').style.color = 'red';
			document.getElementById('msg1').innerHTML = 'Invalid username';</script>";
		}
	}

	
?>


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
	<script type="text/javascript"></script>

	<link rel="stylesheet" href="styles.css">
	<script type="text/javascript">
		function valid(){
			var pass=document.login.password.value;
			var user=document.login.username.value;
			var flag=1;
			if(user.length==0){
				document.getElementById('msg1').style.color = 'red';
				document.getElementById('msg1').innerHTML = 'Empty Username Not Allowed';
				if(flag) document.login.username.focus();
				flag=0;
			}
			if(pass.length==0){
				document.getElementById('msg2').style.color = 'red';
				document.getElementById('msg2').innerHTML = 'Empty Password Not Allowed';
				if(flag) document.login.password.focus();
				flag=0;
			}
			if(flag==0) return false;
			return true;
		}
	</script>
	<style type="text/css">
		input:hover{
			border-color: #00ccff;
		}
	</style>
</head>
<body>
	
	<nav class="navbar navbar-light bg-dark navbar-expand">
	  <div class="container-fluid" style=" margin-left: 10%;">
	    <a class="navbar-brand" href="#">
	      <font color="white" style="font-size: 30px; font-family: 'Robosto'">Stock Trainer</font>
	    </a>
	  </div>
	</nav>
	<div style="width: 100%">
		<div class="row">
			<div><img style="margin-left: 8%; margin-top: 20%;" src="images/login.svg" width="85%"></div>
			<div style="width: 50%; padding-top: 10%; padding-left: 10%;">
					<form method="post"  name="login" onsubmit="return valid();">
						<fieldset>
							<legend>
								<h1><font style="font-family: 'Robosto'">Sign in to your account</font></h1>
							</legend>
							<p>
								<br>
							</p><div style="height: 20%">
							<div class="form-group" style="width: 500px;">
								<label>Enter Username</label>
								<input type="text" class="form-control" name="username">
								<i><span id="msg1" style="font-size: 12px;"></span></i>
							</div>
							<div class="form-group" style="width: 500px;">
								<label>Enter Password</label>
								<input type="password" class="form-control" name="password">
								<i><span id="msg2" style="font-size: 12px;"></span></i><br>
								<a href="forgot-password.php" style="font-size: 15px;">
									Forgot Password ?
								</a>
							</div><br></div>
							<div class="form-actions">
								<button type="submit" name="submit" style="padding-top: 0px;">
									Login
								</button>
							</div><br><br>
							<div>
								Don't have an account yet?
								<a href="register.php">
									Create an account
								</a>
							</div>
						</fieldset>
					</form>
				<!-- </center> -->
			</div>
		</div>
	</div>
</body>
</html>


