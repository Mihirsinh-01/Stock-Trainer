<?php
session_start();
function check_login()
{
	// echo $_SESSION['username'];
	if(strlen($_SESSION['username'])==0)
		{	
			// $host = $_SERVER['HTTP_HOST'];
			// $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			// $extra="./login.php";		
			// header("Location: http://$host$uri/$extra");
			echo "<script>window.location='login.php';</script>";
		} 
	}
	if(time()-$_SESSION['lastActiveTime']>=30){
		
		echo "<script>window.location='logout.php';</script>";
	}
	else{
		$_SESSION['lastActiveTime']=time();
	}
?>