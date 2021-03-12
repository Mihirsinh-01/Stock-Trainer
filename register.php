
<!DOCTYPE html>
<html>
<head>
	<title>Register Account</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
	<link rel="stylesheet" href="css/styles.css">
	<style type="text/css">
		input:hover{
			border-color: #00ccff;
		}
		span{
			color: red;
		}
	</style>
</head>
<body style="font-family: 'Robosto'">
	<nav class="navbar navbar-light bg-dark navbar-expand">
	  <div class="container-fluid" style=" margin-left: 10%;">
	    <a class="navbar-brand" href="#">
	      <font color="white" style="font-size: 30px;">Stock Trainer</font>
	    </a>
	  </div>
	</nav>
	<div style="width: 100%;">
		<div class="row">
			<div><img style="margin-left: 15%; margin-top: 10%;" src="images/register.svg" width="85%"></div>
			<div style="width: 50%; padding-top: 5%; padding-left: 10%; height: 70%; ">
				<!-- <center> -->
					<form method="post" name="registration">
						<fieldset>
							<legend>
								<h1><font>Create New Account</font></h1>
							</legend>
							<p>
								<br>
							</p>
							<div class="form-group" style="width: 500px;">
								<label>Enter Username</label>
								<input type="text" class="form-control" id="username" name="username">
								<i><span id="msg1" style="font-size: 12px;"></span></i>
							</div>
							<div class="form-group" style="width: 500px;">
								<label>Enter Email id</label>
								<input type="text" class="form-control" id="email" name="email">
								<i><span id="msg2" style="font-size: 12px;"></span></i>
							</div>
							<div class="form-group" style="width: 500px;">
								<label>Enter Password</label>
								<input type="password" class="form-control" id="password" name="password">
								<i><span id="msg3" style="font-size: 12px;"></span></i>
							</div>
							<div class="form-group" style="width: 500px;">
								<label>Confirm Password</label>
								<input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
								<i><span id="msg4" style="font-size: 12px;"></span></i>
							</div><br>
							<div class="form-actions">
								<button type="submit" name="submit" style="padding-top: 0px;">
									Signup
								</button>
							</div><br><br>
						</fieldset>
					</form>
				<!-- </center> -->
			</div>
		</div>
	</div>
</body>
</html>


<?php

	error_reporting(0);
	include("include/config.php");

	if(isset($_POST['submit'])){
		$user=$_POST['username'];
		$email=$_POST['email'];
		$pass=$_POST['password'];
		$confirmPassword=$_POST['confirmPassword'];
		$balance=500000.00;
		$submit=false;

		echo "
			<script>document.getElementById('username').value='".$user."';
					document.getElementById('email').value='".$email."';
					document.getElementById('password').value='".$pass."';
			</script>
		";
		// echo "hoh";

		if(empty($user)){
			echo "<script>document.getElementById('msg1').innerHTML='Empty Username Not Allowed';</script>";
			$submit=true;
		}
		else{
			$flag=false;
			for($i=0;$i<strlen($user);$i++){
				$pattern = "/[a-z0-9_]/i";
				if(preg_match($pattern, $user[$i])==0){
					$flag=true;
					echo "jnoj";
					break;
				}
			}
			if(!$flag){
				echo "<script>document.getElementById('msg1').value='';</script>";
			}
			else{
				echo "<script>document.getElementById('msg1').innerHTML='Only Alphabets, Digits and \'_\' are Allowed';</script>";
				$submit=true;
			}
		}
		
		if(empty($email)){
			echo "<script>document.getElementById('msg2').innerHTML='Empty Email Not Allowed';</script>";
			$submit=true;
		}
		else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
			echo "<script>document.getElementById('msg2').innerHTML = 'Enter the valid email address';</script>";
			$submit=true;
		}
		else{
			echo "<script>document.getElementById('msg2').innerHTML = '';</script>";
		}

		if(empty($pass)){
			echo "<script>document.getElementById('msg3').innerHTML='Empty Password Not Allowed';</script>";	
			$submit=true;
		}
		else if(strlen($pass)<8){
			echo "<script>document.getElementById('msg3').innerHTML='Password length should at least 8';</script>";
			$submit=true;
		}
		else{
			echo "<script>document.getElementById('msg3').innerHTML='';</script>";	
		}

		if(strcmp($confirmPassword,$pass)!=0){

			echo "<script>document.getElementById('msg4').innerHTML='Confirm password is not matching';</script>";
			$submit=true;
		}
		else{
			echo "<script>document.getElementById('msg4').innerHTML='';</script>";
		}

		if(!$submit){

			$pass=password_hash($pass,  PASSWORD_BCRYPT);
			
			$sql1= "SELECT * FROM login WHERE username='".$user."'";
			$result = $conn->query($sql1);
			if ($result->num_rows > 0) {
				echo "<script>document.getElementById('msg1').style.color = 'red';
				document.getElementById('msg1').innerHTML = 'Username is already taken';</script>";
				echo "<script>document.getElementById('username').value='".$user."';</script>";
				echo "<script>document.getElementById('email').value='".$email."';</script>";
			}
			else{
				$sql2= "SELECT * FROM login WHERE email='".$email."'";
				$result = $conn->query($sql2);
				if ($result->num_rows > 0) {
					echo "<script>document.getElementById('msg2').style.color = 'red';
					document.getElementById('msg2').innerHTML = 'Email ID is already taken';</script>";
					echo "<script>document.getElementById('username').value='".$user."';</script>";
					echo "<script>document.getElementById('email').value='".$email."';</script>";
				}
				else{

					$sql = "INSERT INTO login VALUES ('".$user."','".$email."','".$pass."',".$balance.")";
					if ($conn->query($sql) === TRUE) {
						echo '<script type="text/javascript"> window.location = "login.php" </script>';
					}
				}
			}
		}
	}

?>


 