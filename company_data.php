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
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
	<script type="text/javascript">
		
		function stock(){
			var x = document.getElementById("stock_no").value;
			var price='<?= $_SESSION["selected_stock_price"] ?>';
			var z=price*x;
			document.getElementById("span").innerHTML=z;
			// else document.getElementById("span").innerHTML=(typeof z);
		}
		function confirmation(x){
			return confirm(x);
		}
		function confir(){
			var share=document.getElementById('stock_no').value;
			var s="Sell "+share+" share ?";
			return confirm(s);
		}
	</script>
</head>
</html>


<?php

	function initial_main(){
		echo $_SESSION['company'];
		echo "<br>";
		echo "<script>document.getElementById('wait').style.visibility='visible';</script>";
		// echo "radhe<br>";
		// global $price;
		list($price,$ratio,$s)=company($_SESSION['company']);
		// echo "shyam";
		echo "<script>document.getElementById('wait').style.visibility='hidden';</script>";
		$price = str_replace(',', '', $price);
		$_SESSION['selected_stock_price']=strip_tags(trim($price));
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
		$sql1= "SELECT balance FROM login WHERE username='".$_SESSION['username']."'";

		$result = $conn->query($sql1);
		$balance=null;
		while($row = $result->fetch_assoc()) {
			$balance=$row["balance"];
		}

		$comp=$_SESSION['company'];
		$price=$_SESSION['selected_stock_price'];
		// echo "$comp<br>$price";
		// echo '<div ng-app="myApp" ng-controller="myctrl">';
		// $s="stock('".$price."')";
		// echo $s;
		echo '<form method="POST">
			<span>Available balance is '.$balance.'</span><br>
			<LABEL>Enter numbre of stocks </LABEL>
			<input type="number" id="stock_no" name="stock_no" onkeyup="stock()"/><br><br>
			<input type="submit" name="confirm_buy" value="Buy" onclick="return confirmation(\'Confirm share purchase !\')"><br>
			<span id="span"></span>
		</form>';
	}
	else if(isset($_POST['confirm_buy'])){
		echo "jk";
		$sql1= "SELECT balance FROM login WHERE username='".$_SESSION['username']."'";

		$result = $conn->query($sql1);
		$balance=null;
		while($row = $result->fetch_assoc()) {
			$balance=$row["balance"];
		}

		$price=$_SESSION['selected_stock_price'];
		$number=$_POST['stock_no'];
		$x=$price*$number;
		
		// echo "$x<br>$balance";
		if($x<=$balance){
			$ans=0;
			$buy=1;
			$balance-=$x;
			$sql = "UPDATE login SET balance='".$balance."' WHERE username='".$_SESSION['username']."'";

			if (mysqli_query($conn, $sql)) {
				$sql1 = "INSERT INTO transaction (username,s_sname,s_name,s_quantity,s_totalprice,buy) VALUES ('".$_SESSION['username']."','".$_SESSION['company']."','".$_SESSION['f_company']."',".$number.",".$x.",".$buy.")";
				if (mysqli_query($conn, $sql1)) {}
				

				$sql2= "SELECT * FROM portfolio WHERE username='".$_SESSION['username']."' and s_sname='".$_SESSION['company']."'";

				$result = $conn->query($sql2);
				if ($result->num_rows > 0) {
					$s_quantity=null;
					$s_totalprice=null;
					while($row = $result->fetch_assoc()) {
						$s_quantity=$row['s_quantity']+$number;
						$s_totalprice=$row['s_totalprice']+$x;
					}
					$sql3 = "UPDATE portfolio SET s_quantity=".$s_quantity.", s_totalprice=".$s_totalprice." WHERE username='".$_SESSION['username']."' and s_sname='".$_SESSION['company']."'";
					if(mysqli_query($conn,$sql3)){}

				}
				else{
					$sql4 = "INSERT INTO portfolio VALUES ('".$_SESSION['username']."','".$_SESSION['company']."','".$_SESSION['f_company']."',".$number.",".$x.")";
					if (mysqli_query($conn, $sql4)) {}
				}
			
			}
		}
		else{
			echo '<script>alert("Sorry! You don\'t have enough balance to buy");</script>';
			
			
		}
		initial_main();
	}
	else if(isset($_POST['sell'])){
		$sql1= "SELECT s_quantity FROM portfolio WHERE username='".$_SESSION['username']."' and s_sname='".$_SESSION['company']."'";

		$result = $conn->query($sql1);
		$s_quantity=null;
		while($row = $result->fetch_assoc()) {
			$s_quantity=$row["s_quantity"];
		}

		$comp=$_SESSION['company'];
		$price=$_SESSION['selected_stock_price'];

		echo '<form method="POST">
			<span>Available stocks '.$s_quantity.'</span><br>
			<LABEL>Enter numbre of stocks </LABEL>
			<input type="number" id="stock_no" name="stock_no"/><br><br>
			<input type="submit" name="confirm_sell" value="Sell" onclick="return confir()"><br>
			
		</form>';
	}
	else if(isset($_POST['confirm_sell'])){
		$sql1= "SELECT * FROM portfolio WHERE username='".$_SESSION['username']."' and s_sname='".$_SESSION['company']."'";

		$result = $conn->query($sql1);
		$s_quantity=null;
		while($row = $result->fetch_assoc()) {
			$s_quantity=$row["s_quantity"];
			$s_totalprice=$row["s_totalprice"];
		}

		$sql2= "SELECT balance FROM login WHERE username='".$_SESSION['username']."'";

		$result = $conn->query($sql2);
		$balance=null;
		while($row = $result->fetch_assoc()) {
			$balance=$row["balance"];
		}

		$price=$_SESSION['selected_stock_price'];
		$number=$_POST['stock_no'];
		$x=$price*$number;
		$balance+=$x;
		
		// echo "$x<br>$balance";
		if($number<=$s_quantity){
		
			$buy=0;
			$sql = "UPDATE login SET balance='".$balance."' WHERE username='".$_SESSION['username']."'";

			if (mysqli_query($conn, $sql)) {
				$sql1 = "INSERT INTO transaction (username,s_sname,s_name,s_quantity,s_totalprice,buy) VALUES ('".$_SESSION['username']."','".$_SESSION['company']."','".$_SESSION['f_company']."',".$number.",".$x.",".$buy.")";
				if (mysqli_query($conn, $sql1)) {}
				
				if($s_quantity-$number==0){
					$sql = "DELETE FROM portfolio WHERE username='".$_SESSION['username']."' and s_sname='".$_SESSION['company']."'";

					if (mysqli_query($conn, $sql)) {}
				}
				else{
					$s_totalprice=($s_quantity-$number)*$s_totalprice/$s_quantity;
					$sql3 = "UPDATE portfolio SET s_quantity=".($s_quantity-$number).", s_totalprice=".$s_totalprice." WHERE username='".$_SESSION['username']."' and s_sname='".$_SESSION['company']."'";
					if(mysqli_query($conn,$sql3)){}
				}
			
			}
		}
		else{
			echo '<script>alert("Sorry! You don\'t have enough stocks to sell");</script>';
			
		}
		initial_main();
	}
	else if(isset($_POST['watch'])){
		$sql1= "SELECT * FROM watchlist WHERE username='".$_SESSION['username']."' and s_sname='".$_SESSION['company']."'";

		$result = $conn->query($sql1);
		if ($result->num_rows == 0){
			$sql1 = "INSERT INTO watchlist VALUES ('".$_SESSION['username']."','".$_SESSION['company']."','".$_SESSION['f_company']."')";
				if (mysqli_query($conn, $sql1)) {}
		}
		initial_main();
	}
	else if(!isset($_POST['search'])){
		initial_main();
		
	}


	// echo $_SESSION['company'];
	// echo "<br>";
	// list($price,$ratio,$s)=company($_SESSION['company']);
	// echo "$price<br>";
	// echo "$ratio<br>";
	// list($col,$ans)=tab($s);
	// print_table($col,$ans);

?>