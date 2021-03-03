<!DOCTYPE html>
<html>
<head>
	<title>Company Data</title>
	<style type="text/css">
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

	</style>
</head>
</html>


<?php

	function company($y){
		$url="https://in.finance.yahoo.com/quote/$y.ns/";
		$html=file_get_contents($url);
		$dom=new DOMDocument();
		@$dom->loadHTML($html);
		$xpath=new DOMXPath($dom);

		$javab=$xpath->query('//*[@id="quote-header-info"]/div[3]/div[1]/div/span[1]');
		$dddd=new DOMDocument();
		foreach($javab as $n) $dddd->appendChild($dddd->importNode($n,true));
		$price=$dddd->saveHTML();

		$javab=$xpath->query('//*[@id="quote-header-info"]/div[3]/div[1]/div/span[2]');
		$dddd=new DOMDocument();
		foreach($javab as $n) $dddd->appendChild($dddd->importNode($n,true));
		$ratio=$dddd->saveHTML();

		$javab=$xpath->query('//*[@id="quote-summary"]');
		$dddd=new DOMDocument();
		foreach($javab as $n) $dddd->appendChild($dddd->importNode($n,true));
		$data=$dddd->saveHTML();
		$table=strip_tags($data);
		// echo "$s<br>";
		return array($price,$ratio,$table);

		
	}
	function print_table($col,$ans){
		$table="<div>";

			$table.='<div class="noob">';
				$table.='<table >';
				for($i=0;$i<7;$i++){
					if($i==6)$table.="<tr>";
					else $table.='<tr class="title">';
					$table.="<td>".$col[$i]."</td>";
					$table.="<td class='second_column'>".$ans[$i]."</td>";
					$table.="</tr>";
				}
				$table.="</table>";
			$table.="</div>";

			$table.='<div class="noob" style="margin-left:30px;">';
				$table.='<table >';
				for($i=7;$i<14;$i++){
					if($i==13)$table.="<tr>";
					else $table.='<tr class="title">';
					$table.="<td>".$col[$i]."</td>";
					$table.="<td class='second_column'>".$ans[$i]."</td>";
					$table.="</tr>";
				}
				$table.="</table>";
			$table.='</div>';

		$table.='</div>';
		echo $table;
	}

	function tab($s){
		// echo "<br>$s<br>";

		$cols=array("Previous close","Open","Bid","Ask","Day's range","52-week range","Volume","Avg. volume","Market cap","Beta (5Y monthly)","PE ratio (TTM)","EPS (TTM)","Earnings date","Forward dividend & yield","Ex-dividend date","1y target est");

		$ans=array();
		for($i=1;$i<16;$i++){
			$x=strpos($s, $cols[$i-1]);
			$y=strpos($s, $cols[$i]);
			$str=substr($s,$x+strlen($cols[$i-1]),$y-$x-strlen($cols[$i-1]));
			if($i!=14 && $i!=13) array_push($ans,$str);
			if($i==15){
				$st=substr($s,$y+strlen($cols[$i]),strlen($s)-$y-strlen($cols[$i]));
				array_push($ans,$st);
			}
		}
		// print_r($ans);
		array_splice($cols, 12,2);
		return array($cols,$ans);
		// print_table($col,$ans);
	}
	include("include/config.php");

	if(isset($_POST['buy'])){
		$comp=$_SESSION['company'];
		$price=$_SESSION['selected_stock_price'];
		// echo "$comp<br>$price";

		echo '<form method="POST">
			<LABEL>Enter numbre of stocks </LABEL>
			<input type="number" name="stock_no"><br><br>
			<input type="submit" name="confirm_buy" value="Buy"/>
		</form>';
	}
	else if(isset($_POST['confirm_buy'])){
		// echo "jk";
		$sql1= "SELECT balance FROM login WHERE username='".$_SESSION['username']."'";

		$result = $conn->query($sql1);
		$ans=null;
		while($row = $result->fetch_assoc()) {
			$ans=$row["balance"];
		}

		$price=strip_tags(trim($_SESSION['selected_stock_price']));
		$number=$_POST['stock_no'];
		$x=$price*$number;
		// echo "$x<br>$ans";

		$sql = "UPDATE login SET password='".$pass."' WHERE email='".$_SESSION['email']."'";

		if (mysqli_query($conn, $sql)) {
		  echo '<script type="text/javascript"> window.location = "login.php" </script>';
		}
	}
	else if(!isset($_POST['search'])){

		echo $_SESSION['company'];
		echo "<br>";
		echo "<script>document.getElementById('wait').style.visibility='visible';</script>";
		// echo "radhe<br>";
		// global $price;
		list($price,$ratio,$s)=company($_SESSION['company']);
		// echo "shyam";
		echo "<script>document.getElementById('wait').style.visibility='hidden';</script>";
		$_SESSION['selected_stock_price']=$price;
		echo "$price<br>";
		echo "$ratio<br>";
		list($col,$ans)=tab($s);
		print_table($col,$ans);

		echo "<br><form method=\"POST\">
			<input type=\"submit\" name=\"buy\" value=\"Buy\"/>
			<input type=\"submit\" name=\"sell\" value=\"Sell\"/>
			<input type=\"submit\" name=\"watch\" value=\"Watch\"/>
		</form>";
	}


	// echo $_SESSION['company'];
	// echo "<br>";
	// list($price,$ratio,$s)=company($_SESSION['company']);
	// echo "$price<br>";
	// echo "$ratio<br>";
	// list($col,$ans)=tab($s);
	// print_table($col,$ans);

?>