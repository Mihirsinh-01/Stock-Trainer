<?php
   session_start();
   unset($_SESSION["username"]);
   unset($_SESSION["otp"]);
   unset($_SESSION["email"]);

	echo '<script type="text/javascript"> window.location = "login.php" </script>';
?>