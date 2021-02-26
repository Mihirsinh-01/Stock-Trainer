<?php
session_start();
function check_login()
{
	echo $_SESSION['username'];
if(strlen($_SESSION['username'])==0)
	{	
		$host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra="./login.php";		
		header("Location: http://$host$uri/$extra");
	}
}
?>