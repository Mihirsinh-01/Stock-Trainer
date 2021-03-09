<?php
	session_start();
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Project</title>
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
	<style> 
        /* Scroll bar chu karva mate... */
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
</head>

</html>


<?php
	include('include/navigation.php');
	include("include/sidebar.php");
	echo '<div><center><form method="POST" style="padding-top: 50px;">
			<input type="text" name="substring" placeholder="Enter Name to be Searched" size="100">
			<input type="submit" name="search"/>
		</form></center></div>';

	
	require 'excel.php';
	function dynamic_searching($data){
		print_r($data);
		global $company_data;
		global $display;
		$arr=array();
		for($i=1;$i<count($company_data);$i++){
			if(strstr(strtolower($company_data[$i][2]),strtolower($data))!=null){
				// print_r($arr);
				array_push($arr, $display[$company_data[$i][1]]);
			}
		}
		return $arr;
	}

	function fetch_data($company){
		$_SESSION['company']=$company;
		echo '<script type="text/javascript"> window.location = "search_company_data.php" </script>';	
	}

	if (isset($_GET['company'])){
       fetch_data($_GET['company']);
    }

	if(!empty($_POST['substring'])){
		$str=$_POST['substring'];

		


		if ( $xlsx = SimpleXLSX::parse('MCAP31122020.xlsx') ) {
		    $company_data=$xlsx->rows();
		    $search=array();
		    $display=array();
		    for($i=1;$i<count($company_data);$i++){
		    	$search[strtolower($company_data[$i][2])]=$company_data[$i][1];
		    	$display[$company_data[$i][1]]=$company_data[$i][2]." (".$company_data[$i][1].")";
		    }
		} else {
		    echo SimpleXLSX::parseError();
		}
		$ar=dynamic_searching($str);
		$table='<div id="table-wrapper" style="margin-left: 640px;">';
		$table.='<div id="table-scroll">';
		$table.='<table id="tb" class="table" style="width:750px;">';
		// $table='<table class="scrolldown">';
		foreach($ar as $x){
			$str=strrchr($x,"(");
			$short_company=substr($str,1,strlen($str)-2);
			
			$f_company=substr($x,0,strlen($x)-strlen($short_company)-3);
			$_SESSION["f_company"]=$f_company;
			
			$table.='<tr>';
			$table.='<td>';
			$table.='<a href="?company='.$short_company.'">';
			$table.=$x;
			$table.='</a></td></tr>';
		}
		$table.='</table>';
		$table.="</div></div>";
		echo $table;
	}
	
?>