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
		.grph{
			position: absolute;
			left: 500px;
			top: 200px;
			background-color: green;
		}
		.tbl{
			width:400px;
			font-weight: bold;
			font-size:20px;
			margin-left: 400px;
			margin-top:30px;

		}
	</style>
</head>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<body>
	
</body>
</html>


<?php
	
	include('include/navigation.php');
	include('include/sidebar.php');
	include("include/config.php");
	
	$sql1= "SELECT balance FROM login WHERE username='".$_SESSION['username']."'";

	$result = $conn->query($sql1);
	$balance=null;
	while($row = $result->fetch_assoc()) {
		$balance=$row["balance"];
	}

	$sql1= "SELECT * FROM portfolio WHERE username='".$_SESSION['username']."'";
	$result = $conn->query($sql1);
	$s_name=array();
	$s_totalprice=array();
	while($row = $result->fetch_assoc()) {
		
		array_push($s_name, $row["s_name"]);
		array_push($s_totalprice, $row["s_totalprice"]);
	}

	// print_r($s_name);
	// print_r($s_totalprice);
	// print_r($balance);
	$Initial=500000;
	$total=array_sum($s_totalprice);
	$total+=$balance;

	$growth=($total-$Initial)/$Initial*100;
	$string="";
	// $savTotal=$balance;
	for($i=0;$i<count($s_name);$i++){
		// $savTotal+=$s_totalprice[$i];
		$string.="['".$s_name[$i]."',".$s_totalprice[$i]."],";
	}
	$string.="['Cash',".$balance."]";

	$table="<div><table class='tbl'>";
	$table.="<tr>";
	$table.="<td>Initial Position</td>";
	$table.="<td>₹ $Initial</td>";
	$table.="</tr>";

	$table.="<tr>";
	$table.="<td>Current Position</td>";
	$table.="<td>₹ $total</td>";
	$table.="</tr>";

	$table.="<tr>";
	$table.="<td>Growth Rate</td>";
	$table.="<td>$growth%</td>";
	$table.="</tr>";

	// $table.="<tr>";
	// $table.="<td>Groth Rate</td>";
	// $table.="<td>$growth</td>";
	// $table.="</tr>";

	$table.="</table></div>";

	echo '<div id="piechart" class="grph"></div>';

	echo $table."<br>";
	echo "<div>
		<script>
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {
		  
		  var data = google.visualization.arrayToDataTable([
		  ['Company', 'Share Price'],".$string."]);
		  var options = {'width':1000, 'height':600};

		  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
		  
		  chart.draw(data, options);
		}
		</script></div>
	";
?>