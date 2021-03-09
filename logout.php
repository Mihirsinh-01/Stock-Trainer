<?php
   session_start();
   unset($_SESSION["username"]);
   unset($_SESSION["otp"]);
   unset($_SESSION["email"]);
   unset($_SESSION["selected_stock_price"]);
   unset($_SESSION["company"]);
   unset($_SESSION["f_company"]);
			

	echo '<script type="text/javascript"> window.location = "login.php" </script>';
?>