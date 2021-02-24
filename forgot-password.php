<!DOCTYPE html>
<html>
<head>
	<title>Forgot Passsword</title>
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
			if(email.length==0){
				document.getElementById('msg2').style.color = 'red';
				document.getElementById('msg2').innerHTML = 'Empty Email Not Allowed';
				if(flag) document.registration.email.focus();
				flag=0;
			}
			if(pass.length==0){
				document.getElementById('msg3').style.color = 'red';
				document.getElementById('msg3').innerHTML = 'Empty Password Not Allowed';
				if(flag) document.registration.password.focus();
				flag=0;
			}
			if(confpass.length==0){
				document.getElementById('msg4').style.color = 'red';
				document.getElementById('msg4').innerHTML = 'Enter Confirmation Password';
				if(flag) document.registration.confirmpassword.focus();
				flag=0;
			}
			if(pass!=confpass){
				if(flag) document.registration.confirmpassword.focus();
				document.getElementById('msg4').style.color = 'red';
				document.getElementById('msg4').innerHTML = 'Confirm Password Not Matching';
				flag=0;
			}
			if(flag==0) return false;
			return false;
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
	<div style="width: 100%;">
		<div class="row">
			<div><img style="margin-left: 15%; margin-top: 10%;" src="images/forgot.svg" width="60%"></div>
			<div style="padding-top: 5%; height: 70%; ">
				<!-- <center> -->
					<form method="get" name="registration" onSubmit="return valid();">
						<fieldset>
							<legend>
								<h1><font style="font-family: 'Robosto'">Reset Password</font></h1>
							</legend>
							<p>
								<br>
							</p>
							<div class="form-group col-xs-3">
								<label>Enter Email Id</label><br>
								<input type="text" class="form-control" name="username">
								<a href="?function=false">Send OTP</a><br>
								<i><span id="msg1" style="font-size: 12px;"></span></i>
								<?php
								if(isset($_GET['function'])){
									echo "YESSS<br>";
								}
								?>

							</div>
							<div class="form-group" style="width: 500px;">
								<label>Enter OTP</label>
								<input type="text" class="form-control" name="email">
								<i><span id="msg2" style="font-size: 12px;"></span></i>
							</div>
							<div class="form-group" style="width: 500px;">
								<label>Enter New Password</label>
								<input type="password" class="form-control" name="password">
								<i><span id="msg3" style="font-size: 12px;"></span></i>
							</div>
							<div class="form-group" style="width: 500px;">
								<label>Confirm Password</label>
								<input type="password" class="form-control" name="confirmpassword">
								<i><span id="msg4" style="font-size: 12px;"></span></i>
							</div><br>
							<div class="form-actions">
								<button type="submit" name="submit" style="padding-top: 0px; width: 50%">
									Reset Password
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