
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
	<script type="text/javascript">
		function valid(){
			var pass=document.registration.password.value;
			var confpass=document.registration.confirmpassword.value;
			var user=document.registration.username.value;
			var email=document.registration.email.value
			var flag=1;
			if(user.length==0){
				document.getElementById('msg1').style.color = 'red';
				document.getElementById('msg1').innerHTML = 'Empty Username Not Allowed';
				if(flag) document.registration.username.focus();
				flag=0;
			}
			else{
				for (var i = 0; i<user.length; i++) {
					if(Number.isInteger(user.charAt(i)) || (/[a-zA-Z]/).test(user.charAt(i)) || user.charAt(i)=='_'){
						var x=0;
					}
					else{
						document.getElementById('msg1').style.color = 'red';
						document.getElementById('msg1').innerHTML = 'Only Alphabets, Digits and "_" are Allowed';
						if(flag) document.registration.username.focus();
						flag=0;
					}
				}
				if(flag) document.getElementById('msg1').innerHTML = '';
			}
			if(email.length==0){
				document.getElementById('msg2').style.color = 'red';
				document.getElementById('msg2').innerHTML = 'Empty Email Not Allowed';
				if(flag) document.registration.email.focus();
				flag=0;
			}
			else document.getElementById('msg2').innerHTML = '';
			if(pass.length==0){
				document.getElementById('msg3').style.color = 'red';
				document.getElementById('msg3').innerHTML = 'Empty Password Not Allowed';
				if(flag) document.registration.password.focus();
				flag=0;
			}
			else document.getElementById('msg3').innerHTML = '';
			if(confpass.length==0){
				document.getElementById('msg4').style.color = 'red';
				document.getElementById('msg4').innerHTML = 'Enter Confirmation Password';
				if(flag) document.registration.confirmpassword.focus();
				flag=0;
			}
			else document.getElementById('msg4').innerHTML = '';

			if(pass!=confpass){
				if(flag) document.registration.confirmpassword.focus();
				document.getElementById('msg4').style.color = 'red';
				document.getElementById('msg4').innerHTML = 'Confirm Password Not Matching';
				flag=0;
			}
			else document.getElementById('msg4').innerHTML = '';
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
					<form method="post" name="registration" onSubmit="return valid();">
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
								<input type="password" class="form-control" id="password" name="confirmpassword">
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
		$balance=500000.00;


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

	
?>
