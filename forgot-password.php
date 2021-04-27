<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Forgot Passsword</title>
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
			<div><img style="margin-left: 15%; margin-top: 10%;" src="images/forgot.svg" width="60%"></div>
			<div style="padding-top: 13%; height: 70%; ">
				<!-- <center> -->
					<form method="POST" name="registration">
						<fieldset>
							<legend>
								<h1><font style="font-size: 50px;">Reset Password</font></h1>
							</legend>
							<p>
								<br>
							</p>
							<div class="form-group">
								<label style="font-size: 30px;">Enter Email Id</label><br>
								<input type="text" class="form-control" name="username" id="username"/>
								<i><span id="msg1" style="font-size: 20px;"></span></i>
							</div>
							<br>
							<div class="form-actions">
								<button type="submit" name="submit" style="padding-top: 0px; width: 50%">
									Send OTP
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

	include("include/config.php");

	if(isset($_POST['submit'])){

		$email=$_POST['username'];
		echo "<script>document.getElementById('email').value='".$email."';</script>";
		if(empty($email)){
			echo "<script>document.getElementById('msg1').innerHTML='Empty Email Not Allowed';</script>";
			$submit=true;
		}
		else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
			echo "<script>document.getElementById('msg1').innerHTML = 'Enter the valid email address';</script>";
			$submit=true;
		}

		$sql1= "SELECT * FROM login WHERE email='".$email."'";

		$result = $conn->query($sql1);
		if ($result->num_rows > 0) {
			$_SESSION['email']=$email;

			$otp=rand(1000,9999);
			$_SESSION['otp']=$otp;

			echo '<script type="text/javascript"> window.location = "getotp.php" </script>';
		
			send_otp($otp);
		}
		else{
			echo "<script>document.getElementById('msg1').style.color = 'red';
			document.getElementById('msg1').innerHTML = 'Invalid Email ID';</script>";
			echo "<script>document.getElementById('username').value='".$email."';</script>";
		}
	}
	function send_otp($otp){


		require_once('Mail/PHPMailer/PHPMailerAutoload.php');
		$mail=new PHPMailer();
		$mail->isSMTP();
		$mail->SMTPAuth=true;
		$mail->SMTPSecure='ssl';
		$mail->Host='smtp.gmail.com';
		$mail->Port='465';
		$mail->isHTML();
		$mail->Username='Your Email';
		$mail->Password='Your Email Password';
		$mail->SetFrom('no-reply@gmail.com');
		$mail->Subject='OTP verification';
		$mail->Body='OTP for your Password RESET Request is <h1>'.$otp.'</h1>';
		$mail->AddAddress($_POST['username']);
		
		$mail->Send();
		
		

	}

	

?>