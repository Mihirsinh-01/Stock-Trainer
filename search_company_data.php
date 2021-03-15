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
		  height:200px;
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

		.noob{
			float: left;
			/*background-color: pink;*/
		}
		table{
			border-collapse: collapse;
		}
		.title{
		    border-bottom: 1px solid;
		}
		.second_column{
			padding-left: 30px;
		}

		#wait {
		   position:fixed;
		   top:50%;
		   left:50%;
		   background-color:#dbf4f7;
		   background-image:url('C:/xampp/htdocs/Stock-Trainer/images/forgot.svg'); /*path to your wait image*/
		   background-repeat:no-repeat;
		   z-index:100; /*so this shows over the rest of your content*/

		   /* alpha settings for browsers */
		   opacity: 0.9;
		   filter: alpha(opacity=90);
		   -moz-opacity: 0.9;
		}
		
    </style>


</html>


<?php
	include('include/navigation.php');
	include('include/sidebar.php');
	include('fetch.php');
	include('company_data.php');
	
// 	function company($y){
// 		$url="https://in.finance.yahoo.com/quote/$y.ns/";
// 		$html=file_get_contents($url);
// 		$dom=new DOMDocument();
// 		@$dom->loadHTML($html);
// 		$xpath=new DOMXPath($dom);

// 		$javab=$xpath->query('//*[@id="quote-header-info"]/div[3]/div[1]/div/span[1]');
// 		$dddd=new DOMDocument();
// 		foreach($javab as $n) $dddd->appendChild($dddd->importNode($n,true));
// 		$price=$dddd->saveHTML();

// 		$javab=$xpath->query('//*[@id="quote-header-info"]/div[3]/div[1]/div/span[2]');
// 		$dddd=new DOMDocument();
// 		foreach($javab as $n) $dddd->appendChild($dddd->importNode($n,true));
// 		$ratio=$dddd->saveHTML();

// 		$javab=$xpath->query('//*[@id="quote-summary"]');
// 		$dddd=new DOMDocument();
// 		foreach($javab as $n) $dddd->appendChild($dddd->importNode($n,true));
// 		$data=$dddd->saveHTML();
// 		$table=strip_tags($data);
// 		// echo "$s<br>";
// 		return array($price,$ratio,$table);

		
// 	}
// 	function print_table($col,$ans){
// 		$table="<div>";

// 			$table.='<div class="noob">';
// 				$table.='<table >';
// 				for($i=0;$i<7;$i++){
// 					if($i==6)$table.="<tr>";
// 					else $table.='<tr class="title">';
// 					$table.="<td>".$col[$i]."</td>";
// 					$table.="<td class='second_column'>".$ans[$i]."</td>";
// 					$table.="</tr>";
// 				}
// 				$table.="</table>";
// 			$table.="</div>";

// 			$table.='<div class="noob" style="margin-left:30px;">';
// 				$table.='<table >';
// 				for($i=7;$i<14;$i++){
// 					if($i==13)$table.="<tr>";
// 					else $table.='<tr class="title">';
// 					$table.="<td>".$col[$i]."</td>";
// 					$table.="<td class='second_column'>".$ans[$i]."</td>";
// 					$table.="</tr>";
// 				}
// 				$table.="</table>";
// 			$table.='</div>';

// 		$table.='</div>';
// 		echo $table;
// 	}

// 	function tab($s){
// 		// echo "<br>$s<br>";

// 		$cols=array("Previous close","Open","Bid","Ask","Day's range","52-week range","Volume","Avg. volume","Market cap","Beta (5Y monthly)","PE ratio (TTM)","EPS (TTM)","Earnings date","Forward dividend & yield","Ex-dividend date","1y target est");

// 		$ans=array();
// 		for($i=1;$i<16;$i++){
// 			$x=strpos($s, $cols[$i-1]);
// 			$y=strpos($s, $cols[$i]);
// 			$str=substr($s,$x+strlen($cols[$i-1]),$y-$x-strlen($cols[$i-1]));
// 			if($i!=14 && $i!=13) array_push($ans,$str);
// 			if($i==15){
// 				$st=substr($s,$y+strlen($cols[$i]),strlen($s)-$y-strlen($cols[$i]));
// 				array_push($ans,$st);
// 			}
// 		}
// 		// print_r($ans);
// 		array_splice($cols, 12,2);
// 		return array($cols,$ans);
// 		// print_table($col,$ans);
// 	}

// if(!isset($_POST['search'])){

// 	echo $_SESSION['company'];
// 	echo "<br>";
// 	echo "<script>document.getElementById('wait').style.visibility='visible';</script>";
// 	// echo "radhe<br>";
// 	list($price,$ratio,$s)=company($_SESSION['company']);
// 	// echo "shyam";
// 	echo "<script>document.getElementById('wait').style.visibility='hidden';</script>";
// 	echo "$price<br>";
// 	echo "$ratio<br>";
// 	list($col,$ans)=tab($s);
// 	print_table($col,$ans);

// 	echo "<br><form method=\"POST\">
// 		<input type=\"submit\" name=\"buy\" value=\"Buy\"/>
// 		<input type=\"submit\" name=\"sell\" value=\"Sell\"/>
// 		<input type=\"submit\" name=\"watch\" value=\"Watch\"/>
// 	</form>";
// }

?>