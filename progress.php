<!DOCTYPE html>
<html>
<head>
	<title>progress</title>
	<style type="text/css">
		#wait {
		   position:fixed;
		   top:50%;
		   left:50%;
		   background-color:#dbf4f7;
		   background-image:url('/images/wait.gif'); // path to your wait image
		   background-repeat:no-repeat;
		   z-index:100; // so this shows over the rest of your content

		   /* alpha settings for browsers */
		   opacity: 0.9;
		   filter: alpha(opacity=90);
		   -moz-opacity: 0.9;
		}
	</style>
</head>
<body>
	<div style="display:none;" id="wait"></div>

</body>
</html>