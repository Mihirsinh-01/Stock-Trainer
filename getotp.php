<?php
	session_start();
?>


<!DOCTYPE html>
<html>
<head>
	<title>Enter OTP</title>
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
			var pass=document.otp.password.value;
			var confpass=document.otp.confirmpassword.value;
			var user=document.otp.username.value;
			var flag=1;
			if(user.length==0){
				document.getElementById('msg1').style.color = 'red';
				document.getElementById('msg1').innerHTML = 'Enter Proper OTP';
				if(flag) document.otp.username.focus();
				flag=0;
			}
			else{
				document.getElementById('msg1').innerHTML = '';
			}
			if(pass.length==0){
				document.getElementById('msg3').style.color = 'red';
				document.getElementById('msg3').innerHTML = 'Empty Password Not Allowed';
				if(flag) document.otp.password.focus();
				flag=0;
			}
			else document.getElementById('msg3').innerHTML = '';
			if(confpass.length==0){
				document.getElementById('msg4').style.color = 'red';
				document.getElementById('msg4').innerHTML = 'Enter Confirmation Password';
				if(flag) document.otp.confirmpassword.focus();
				flag=0;
			}
			else document.getElementById('msg4').innerHTML = '';

			if(pass!=confpass){
				if(flag) document.otp.confirmpassword.focus();
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
			<div><img style="margin-left: 15%; margin-top: 10%;" src="images/otp.svg" width="70%"></div>
			<div style="width: 40%; padding-top: 5%; height: 70%; ">
				<!-- <center> -->
					<form method="post" name="otp" onSubmit="return valid();">
						<fieldset>
							<legend>
								<h1><font style="font-family: 'Robosto'">Reset Password</font></h1>
							</legend>
							<p>
								<br>
							</p>
							<div class="form-group" style="width: 500px;">
								<label>Enter One Time Password(OTP)</label>
								<input type="text" class="form-control" name="username">
								<i><span id="msg1" style="font-size: 12px;"></span></i>
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
								<button type="submit" name="submit" style="padding-top: 0px;">
									Reset
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

	if(isset($_POST['submit'])){

		$otp=$_POST['username'];
		$pass=$_POST['password'];

		if($_SESSION['otp']==$otp){
			include("include/config.php");

			

			$sql = "UPDATE login SET password='".$pass."' WHERE email='".$_SESSION['email']."'";

			if (mysqli_query($conn, $sql)) {
			  echo '<script type="text/javascript"> window.location = "login.php" </script>';
			} 
			// else {
			//   echo "Error updating record: " . mysqli_error($conn);
			// }
		}
		else{
			// echo "ljkj";
			echo "<script>document.getElementById('msg1').style.color = 'red';
			document.getElementById('msg1').innerHTML = 'Invalid OTP';</script>";
		}
	}

?>