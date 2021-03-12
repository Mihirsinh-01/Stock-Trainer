<!DOCTYPE html>
<html>
<head>
	<title>Company Data</title>
	<style type="text/css">
		.noob{
			float: left;
			font-size: 25px;
		}
		.noob1{
			position: absolute;
			left: 650px;
			top: 750px;
			width: 700px;
		}
		.noob2{
			font-size: 30px;
			font-weight: bold;
			width: 850px;
			height: 100px;
			margin-left: 600px;
		}
		.buy1{
			/*background-color: red;*/
			margin-left: 500px;
			margin-top:80px;
			font-size: 30px;
		}
		table{
			border-collapse: collapse;
		}
		.title{
		    border-bottom: 1px solid;
		    height: 60px;
		}
		.second_column{
			padding-left: 30px;
		}

		.bt{
			padding-top: 1%;
			padding-bottom: 1%;
			margin-right: 3%;
			font-size: 24px;
			text-align: center;
			cursor: pointer;
			outline: none;
			color: #fff;
			background-color: #6666ff;
			border: none;
			border-radius: 15px;
			box-shadow: 0 9px #999;
			width: 200px;
		}
		.bt:hover {
			background-color: #8080ff;
			outline: none;
		}

		.bt:active {
		  background-color: #6600ff;
		  box-shadow: 0 5px #666;
		  transform: translateY(4px);
		  outline: none;
		}


	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<script type="text/javascript">
		function check(y){
			var x = document.getElementById("stock_no").value;
			// document.writeln(typeof(y));
			if(x>y)	{
				alert("Not Enough Stocks !!!!!!");
				return false;
			}
			else{
				return confir();
			}
		}
		
		function stock(){
			var x = document.getElementById("stock_no").value;
			var price='<?= $_SESSION["selected_stock_price"] ?>';
			var z=price*x;
			document.getElementById("span").innerHTML=z;
			// else document.getElementById("span").innerHTML=(typeof z);
		}
		function confirmation(x){
			if(document.getElementById("stock_no").value==0){
				alert("Stocks can not be 0");
				return false;
			}
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
		echo "<br>";
		list($price,$ratio,$s)=company($_SESSION['company']);
		$price = str_replace(',', '', $price);
		$_SESSION['selected_stock_price']=strip_tags(trim($price));
		echo "<div class='noob2'><marquee style='font-size:40px;'>";
		echo $_SESSION['f_company']." (".$_SESSION['company'].")";
		echo "</marquee>";
		if($ratio[0]=='-'){
			echo "<div style='color:red'>$price &nbsp&nbsp&nbsp";
			echo "$ratio</div></div><br><br>";
		}
		else{
			echo "<div style='color:green'>$price&nbsp&nbsp&nbsp";
			echo "$ratio</div></div><br><br>";
		}
		list($col,$ans)=tab($s);
		print_table($col,$ans);

		echo "<br><div class=\"noob1\"><form method=\"POST\">
			<input type=\"submit\" name=\"buy\" value=\"Buy\" class=\"bt\"/>
			<input type=\"submit\" name=\"sell\" value=\"Sell\" class=\"bt\"/>
			<input type=\"submit\" name=\"watch\" value=\"Watch\" class=\"bt\"/>
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
			$table.='<div class="noob" style="margin-left:250px;">';
				$table.='<table>';
				for($i=0;$i<7;$i++){
					$table.='<tr class="title">';
					$table.="<td>".$col[$i]."</td>";
					$table.="<td class='second_column'>".$ans[$i]."</td>";
					$table.="</tr>";
				}
				$table.="</table>";
			$table.="</div>";

			$table.='<div class="noob" style="margin-left:30px;">';
				$table.='<table>';
				for($i=7;$i<14;$i++){
					$table.='<tr class="title">';
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
		echo '<div class="buy1">
				<table style="width:1200px;"><tr>
				<th><span>Available balance is '.$balance.'</span></th>
				<th><span>Price Per Share is '.$price.'</span></th></tr>
				<tr><td colspan="2" style="padding-left:150px;">
				<br><br>
				<form method="POST"><LABEL>Enter number of stocks: </LABEL>
				<input type="number" id="stock_no" name="stock_no" onkeyup="stock()" min="1" step="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57"/><br><br>
				<div style="margin-left:210px;">Price: &nbsp<span id="span">0.00</span></div><br><br>
				<input type="submit" style="margin-left:280px;" name="confirm_buy" class="bt" value="Buy" onclick="return confirmation(\'Confirm share purchase !\')">
				</form></td></tr></table>

			</div>';
		// echo '<div class="buy1"><form method="POST">
		// 	<span>Available balance is '.$balance.'</span><br>
		// 	<span>Price Per Share is '.$price.'</span><br>
		// 	<LABEL>Enter number of stocks </LABEL>
		// 	<input type="number" id="stock_no" name="stock_no" onkeyup="stock()"/><br><br>
		// 	<input type="submit" name="confirm_buy" value="Buy" onclick="return confirmation(\'Confirm share purchase !\')"><br>
		// 	Price <span id="span"></span>
		// </form></div>';
	}
	else if(isset($_POST['confirm_buy'])){

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

		// echo '<form method="POST">
		// 	<span>Available stocks '.$s_quantity.'</span><br>
		// 	<LABEL>Enter numbre of stocks </LABEL>
		// 	<input type="number" id="stock_no" name="stock_no"/><br><br>
		// 	<input type="submit" name="confirm_sell" value="Sell" onclick="return confir()"><br>
			
		// </form>';

		echo '
				<div class="buy1">
				<table style="width:1200px;"><tr>
				<th><span>Available Shares '.$s_quantity.'</span></th>
				<th><span>Price Per Share is '.$price.'</span></th></tr>
				<tr><td colspan="2" style="padding-left:150px;">
				<br><br>
				<form method="POST" onsubmit="return check('.$s_quantity.');"><LABEL>Enter number of stocks: </LABEL>
				<input type="number" id="stock_no" name="stock_no" onkeyup="stock()" min="1" step="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57"/><br><br>
				<div style="margin-left:210px;">Price: &nbsp<span id="span">0.00</span></div><br><br>
				<input type="submit" style="margin-left:280px;" name="confirm_sell" class="bt" value="Sell" >
				</form></td></tr></table>

			</div>';
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
		initial_main();
	}
	else if(isset($_POST['watch'])){
		$sql1= "SELECT * FROM watchlist WHERE username='".$_SESSION['username']."' and s_sname='".$_SESSION['company']."'";

		$result = $conn->query($sql1);
		if ($result->num_rows == 0){
			$sql1 = "INSERT INTO watchlist VALUES ('".$_SESSION['username']."','".$_SESSION['company']."','".$_SESSION['f_company']."')";
				if (mysqli_query($conn, $sql1)) {
					echo "<script>alert('Added to Watchlist :-) ')</script>";
				}
		}
		else{
			echo "already";
			echo "<script>alert('Already added to Watchlist :-( ')</script>";
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