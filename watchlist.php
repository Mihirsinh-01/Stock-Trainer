<?php
	include('include/checklogin.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/link.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" href="css/dropdown.css">
</head>
<style type="text/css">
	::-webkit-scrollbar {
		    width: 0px;  /* Remove scrollbar space */
		    background: transparent;  /* Optional: just make scrollbar invisible */
		}

		#table-wrapper {
		  position:relative;
		}
		#table-scroll {
		  height:700px;
		  overflow:auto;  
		  /*margin-top:20px;*/
		}
		#table-wrapper table {
			/*width: 100px;*/

		}
		#table-wrapper table * {
		  /*background:green;*/
		  color:black;
		}
		#table-wrapper table thead th .text {
		  position:relative;   
		  top:-20px;
		  z-index:2;
		  height:20px;
		  width:100px;
		  border:0px solid red;
		}
		td{
			height: 50px;
		}
</style>
<body>

</body>
</html>


<?php
	include('include/navigation.php');
	include('include/sidebar.php');
	include("include/config.php");

	echo '<span id="watch" style="margin:250px;"><img style="margin-top:100px;" src="images/watchlist.svg"></span>';

	function fetch_data($company){
		$str=strrchr($company,"(");
		$short_company=substr($str,1,strlen($str)-2);

		$f_company=substr($company,0,strlen($company)-strlen($short_company)-3);
		$_SESSION["f_company"]=$f_company;
		$_SESSION['company']=$short_company;
			
	}
	function delete($short_company){
		global $conn;
		$sql = "DELETE FROM watchlist WHERE username='".$_SESSION['username']."' and s_sname='".$short_company."'";
		if (mysqli_query($conn, $sql)) {}
	}
	if (isset($_GET['company'])){
       echo '<script type="text/javascript"> window.location = "company_table.php" </script>';
       // fetch_data($_GET['company']);
    }
    if (isset($_GET['delete'])){
       delete($_GET['delete']);
    }

	$sql1= "SELECT * FROM watchlist WHERE username='".$_SESSION['username']."'";

	$result = $conn->query($sql1);
	$table="";
	$main_table=array();
	if ($result->num_rows >0){
		echo '<script>document.getElementById("watch").style.display="none"</script>';
		// echo '<script>document.getElementById("tb").style.display="inline"</script>';
		$table='<div id="table-wrapper" style="margin-left: 440px;margin-top:50px;">';
		$table.='<div id="table-scroll">';
		$table.='<table id="tb" class="table table-hover" style="width:94%;">';
		$table.='<thead><tr><th>#</th><th>Company Name</th><th>Remove</th></tr></thead>';
		$table.='<tbody>';

		while($row = $result->fetch_assoc()) {
			$insider=array();
			array_push($insider, $row["s_name"]);
			array_push($insider, $row["s_sname"]);
			array_push($main_table, $insider);
		}
	}

	// $table='<table class="scrolldown">';
	$cnt=1;
	foreach($main_table as $row){
		// echo '<script>document.getElementById("tb").style.display="inline"</script>';
		
		$short_company=$row[1];
		$f_company=$row[0];
		$_SESSION["f_company"]=$f_company;
		$_SESSION['company']=$short_company;
		
		$table.='<tr>';
		$table.='<td>'.$cnt.'</td>';
		$table.='<td>';
		$table.='<a href="?company='.$short_company.'">';
		$table.=$f_company." (".$short_company.")";
		$table.='</a></td>';
		$table.='<td style="padding-left:30px;"><a href="?delete='.$short_company.'"><i class="fa fa-trash" style="color: #8080ff;"></i></td>';
		$table.='</tr>';
		$cnt++;
	}
	$table.='</tbody></table>';
	$table.="</div></div>";
	echo $table;


?>