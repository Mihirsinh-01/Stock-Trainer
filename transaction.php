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



		::-webkit-scrollbar {
		    width: 0px;  /* Remove scrollbar space */
		    background: transparent;  /* Optional: just make scrollbar invisible */
		}
		table th {
		    position: -webkit-sticky; 
		    position: sticky;
		    top: 0;
		    z-index: 1;
		    background: #fff;
		}

		#table-wrapper {
		  position:relative;
		}
		#table-scroll {
		  height:800px;
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

    echo '<div><div id="table-scroll"><table class="table table-hover" style="width:1200px; margin-top:30px; margin-left:100px;">
    <thead>	
   		<tr>
   			<th class="center">#</th>
   			<th>Company Name</th>
   			<th>Price Per Share</th>
   			<th>Quantity</th>
   			<th>Transaction Total</th>
   			<th>Transaction Date</th>
   			<th>Bought/Sold</th>
   		</tr>
    </thead>
    <tbody>
    ';

	$result = $conn->query($sql1);
	$data=array();
	if ($result->num_rows > 0) {
		$cnt=1;
		while($row = $result->fetch_assoc()) {
			echo '<tr><td class="center">'.$cnt.'. </td>';
			$full=$row["s_name"]." (".$row["s_sname"].")";
			echo '<td>'.$full.'</td>';
			echo '<td>₹ '.($row["s_totalprice"]/$row["s_quantity"]).'</td>';
			echo '<td>'.$row["s_quantity"].'</td>';
			echo '<td>₹ '.$row["s_totalprice"].'</td>';
			echo '<td>'.$row["date"].'</td>';
			if($row["buy"]==0) echo '<td>Bought</td>';
			else echo '<td>Sold</td>';
			echo '</tr>';
			$cnt++;

		}
		echo '</tbody></table></div></div>';
	}

	


	function fetch_data($company){
		$str=strrchr($company,"(");
		$short_company=substr($str,1,strlen($str)-2);
		$_SESSION['company']=$short_company;
		$f_company=substr($company,0,strlen($company)-strlen($short_company)-3);
		$_SESSION["f_company"]=$f_company;
		echo '<script type="text/javascript"> window.location = "company_table.php" </script>';	
	}

?>