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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
	<script type="text/javascript"></script>
	<link rel="stylesheet" href="styles.css">
	<script type="text/javascript">
		function valid(){
			var user=document.registration.username.value;
			var flag=1;
			if(user.length==0){
				document.getElementById('msg1').style.color = 'red';
				document.getElementById('msg1').innerHTML = 'Empty Email Not Allowed';
				if(flag) document.registration.username.focus();
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
	<div style="width: 100%;font-family: 'Robosto'">
		<div class="row">
			<div><img style="margin-left: 15%; margin-top: 10%;" src="images/forgot.svg" width="60%"></div>
			<div style="padding-top: 13%; height: 70%; ">
				<!-- <center> -->
					<form method="POST" name="registration" onsubmit="return valid();">
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

		// echo "nljn";
		$email=$_POST['username'];
		// echo $email;

		$sql1= "SELECT * FROM login WHERE email='".$email."'";

		$result = $conn->query($sql1);
		if ($result->num_rows > 0) {
			// echo "lnholn";
			$_SESSION['email']=$email;

			$otp=rand(1000,9999);
			$_SESSION['otp']=$otp;

			echo '<script type="text/javascript"> window.location = "getotp.php" </script>';
		
			send_otp($otp);
		}
		else{
			echo "<script>document.getElementById('msg1').style.color = 'red';
			document.getElementById('msg1').innerHTML = 'Invalid Email ID';</script>";
		}

		// if($_SESSION['otp']==$otp){
		// 	include("include/config.php");

		// 	$sql = "UPDATE login SET password='".$pass."' WHERE email='".$email."'";

		// 	if (mysqli_query($conn, $sql)) {
		// 	  echo '<script type="text/javascript"> window.location = "login.php" </script>';
		// 	} 
		// 	// else {
		// 	//   echo "Error updating record: " . mysqli_error($conn);
		// 	// }
		// }
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
		$mail->Username='noreply.stocktrainer@gmail.com';
		$mail->Password='alpqpsj34hdf7343n';
		$mail->SetFrom('no-reply@gmail.com');
		$mail->Subject='OTP verification';
		$mail->Body='OTP for your Password RESET Request is <h1>'.$otp.'</h1>';
		$mail->AddAddress($_POST['username']);
		
		$mail->Send();
		
		

	}

	

?>