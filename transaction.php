<?php
	session_start();
	
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
	<style type="text/css">


		/* Scroll bar chu karva mate... */
		::-webkit-scrollbar {
		    width: 0px;  /* Remove scrollbar space */
		    background: transparent;  /* Optional: just make scrollbar invisible */
		}

		#table-wrapper {
		  position:relative;
		}
		#table-scroll {
		  height:200px;
		  overflow:auto;  
		  /*margin-top:20px;*/
		}
		/*#table-wrapper table {*/
			/*width: 100px;*/

		/*}*/
		/*#table-wrapper table * {*/
		  /*background:green;*/
		  /*color:black;*/
		/*}*/
		#table-wrapper table thead th .text {
		  position:relative;   
		  top:-20px;
		  z-index:2;
		  height:20px;
		  width:100px;
		  border:0px solid red;
		}

		#tb1{
			/*height: 10px;*/
			/*width: 500px;*/
			background-color: yellow;
			font-size: 30px;
			border-collapse: collapse;
			color: black;
		}
		#tb1:hover{
			background-color: red;
			/*border: 0px solid #1E88E5;*/
			color: white;
		}

		#even_row_col{
			width:500px;
		}
	</style>
</head>
<body>

</body>
</html>

<?php

	// include('sidebar_html.html');
	
	include('include/navigation.php');
	include("include/sidebar.php");
	include("include/config.php");

		
	// include('sidebar.php');
	// echo '<div style="background-color:green;">dfsfsdf</div>';
	
	if (isset($_GET['company'])){
       fetch_data($_GET['company']);
    }

	// $data=array(array("Tata Steel Limited (TATASTEEL)","r2","r3","r4","r5"),array("r6","r7","r8","r9","r10"),array(1,1,1,1,1),array(1,1,1,1,1),array(1,1,1,1,1),array(1,1,1,1,1),array(1,1,1,1,1),array(1,1,1,1,1));

    $sql1= "SELECT * FROM transaction WHERE username='".$_SESSION['username']."'";

	$result = $conn->query($sql1);
	$data=array();
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$data1=array();
			$full=$row["s_name"];
			$short=$row["s_sname"];
			array_push($data1, $full." (".$short.")");
			array_push($data1, $row["buy"]);
			array_push($data1, "Transaction Date");
			array_push($data1, $row["date"]);
			array_push($data1, "Price Per Share ₹");
			array_push($data1, ($row["s_totalprice"]/$row["s_quantity"]));
			array_push($data1, "Quantity");
			array_push($data1, $row["s_quantity"]);
			array_push($data1, "Transaction Total");
			array_push($data1, $row["s_totalprice"]);
			array_push($data, $data1);
		}
	}

	// $table='<div class="container">';
	// echo '<div style="background-color:green;">';
	$table='<div id="table-wrapper" style="margin-left: 400px;">';
	$table.='<div id="table-scroll">';
	$table.='<table id="tb" border="1" class="scrolldown">';
	// print_r($data);
  	foreach($data as $row){
		$table.="<tr>";
		$table.='<td>';

		$table.='<a href="?company='.$row[0].'">';
		$table.='<table id="tb1" border="1" cellspacing="15">';

		$table.="<tr>";
		$table.='<td colspan="3">';
		$table.=$row[0];
		$table.="</td>";
		$table.='<td style="text-align: right;">';
		if($row[1]==0)$table.="Sell";
		else $table.="Buy";
		$table.="</td>";
		$table.="</tr>";

		for($i=2;$i<count($row);$i++){
			if(($i-2)%4==0)$table.="<tr>";
			if($i%2!=0)$table.="<td id='even_row_col' style='text-align: right;'>";
			else $table.="<td id='even_row_col'>";
			if(($i-1)%4==0)$table.="₹";
			$table.=$row[$i];
			$table.="</td>";
			if(($i-1)%4==0)$table.="</tr>";
		}
		// $i=0;
		// foreach($row as $value){
		// 	if($i%2==0){
		// 		$table.="<tr>";
		// 		$table.='<td>';
		// 		$table.="$value";
		// 		$table.="</td>";

		// 		// $table.="<td class=\"other_column\">$value</td>";
		// 	}else{
		// 		// $table.='<a href="?company='.$value.'">'.$value.'</a>';
		// 		if($i==1){
		// 			$table.='<td style="text-align: right;">';
		// 			if($value==0)$table.="Sell";
		// 			else $table.="Buy";
		// 		}
		// 		else{
		// 			$table.='<td id="even_row_col">';
		// 			$table.="$value";
		// 		}
		// 		$table.="</td>";
		// 		$table.="</tr>";

		// 		// $table.="<td class=\"first_column\">$value</td>";
		// 	}
		// 	$i++;
		// }
		$table.="</table>";
		$table.="</a>";
		$table.="</td>";
		$table.="</tr>";
		// $table.='<tr><td><a href="?price='.$x.'">'.$x.'</a></td></tr>';
	}
	$table.='</table>';
	$table.='</div></div>';
	echo "$table";


	function fetch_data($company){
		$str=strrchr($company,"(");
		$short_company=substr($str,1,strlen($str)-2);
		$_SESSION['company']=$short_company;
		$f_company=substr($company,0,strlen($company)-strlen($short_company)-3);
		$_SESSION["f_company"]=$f_company;
		echo '<script type="text/javascript"> window.location = "company_table.php" </script>';	
	}

?>