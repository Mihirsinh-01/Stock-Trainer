<?php
	session_start();
	include('include/navigation.php');
	
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
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<body>
	<div id="piechart"></div>
</body>
</html>


<?php
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

	$string="";
	// $savTotal=$balance;
	for($i=0;$i<count($s_name);$i++){
		// $savTotal+=$s_totalprice[$i];
		$string.="['".$s_name[$i]."',".$s_totalprice[$i]."],";
	}
	$string.="['cash',".$balance."]";

	// echo $string;
	echo "
		<script>
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {
		  
		  var data = google.visualization.arrayToDataTable([
		  ['Task', 'Hours per Day'],".$string."]);
		  var options = {'title':'My Average Day', 'width':550, 'height':400};

		  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
		  
		  chart.draw(data, options);
		}
		</script>

	";

?>