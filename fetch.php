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
	  height:520px;
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
		height: 60px;
	}
	tr:hover{
		background-color: #f0f0f5;
	}
	
</style>
<?php
	
	require 'excel.php';
	echo '<div><center><form method="POST" style="padding-top: 30px;">
			<input type="text" name="substring" style="line-height: 30px; margin-right: 30px;" placeholder="Enter Name to be Searched" size="100">
			<input type="submit" style="background-color: #8080ff; color: white;" class="btn" name="search"/>
		</form></center></div>
		';
	function dynamic_searching($data){
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
		$str=strrchr($company,"(");
		$short_company=substr($str,1,strlen($str)-2);

		$f_company=substr($company,0,strlen($company)-strlen($short_company)-3);
		$_SESSION["f_company"]=$f_company;
		$_SESSION['company']=$short_company;
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
		$table='<div id="table-wrapper" style="margin-left: 610px;">';
		$table.='<div id="table-scroll">';
		$table.='<table id="tb" class="table" style="width:750px;">';
		// $table='<table class="scrolldown">';
		foreach($ar as $x){
			

			$table.='<tr>';
			$table.='<td>';
			$table.='<a href="?company='.$x.'">';
			$table.=$x;
			$table.='</a></td></tr>';
		}
		$table.='</table>';
		$table.="</div></div>";
		echo $table;
	}
?>