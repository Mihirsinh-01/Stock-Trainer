<?php
	require_once('PHPMailer/PHPMailerAutoload.php');
	$mail=new PHPMailer();
	$mail->isSMTP();
	$mail->SMTPAuth=true;
	$mail->SMTPSecure='ssl';
	$mail->Host='smtp.gmail.com';
	$mail->Port='465';
	$mail->isHTML();
	$mail->Username='vdhvanik@gmail.com';
	$mail->Password='qwertyudj';
	$mail->SetFrom('18bce258@nirmauni.ac.in');
	$mail->Subject='hello';
	$mail->Body='A test mail';
	$mail->AddAddress('vdhvanik@gmail.com');
	
	$mail->Send();
	echo "Mail is sent";

?>