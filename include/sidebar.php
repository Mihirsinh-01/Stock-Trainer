<!DOCTYPE html>
<html>
<head>
	<!-- <link rel="stylesheet" href="temp1.css"> -->
	<!-- <script src="http://www.w3schools.com/lib/w3data.js"></script> -->
	<style type="text/css">
		a:link {color: white; text-decoration: none; cursor: default;}      /* unvisited link */
  	a:visited {color: black; text-decoration: none; cursor: default;}   /* visited link */
  a:hover {color: white; text-decoration: none; cursor: default;}     /* mouse over link */
  a:active {color: black; text-decoration: none; cursor: default;}

  .side{
    padding: 10px 20px;
    background-color: #1E88E5;
    border: 0px;
    color: #fff;
    /*display: flex;
    width:100%;
    align-items: stretch;*/
  }
  .side:hover{
    background-color: #fff;
    border: 1px solid #1E88E5;
    color: #1E88E5;
  }


    html, body {
        height: 100%;
        margin: 0px;
    }
    .contain {
        height: 100%;
        background: #f0e68c;
    }
	</style>
</head>
<body>
    <div class="contain" style="width: 400px; height: 100vh; background-color: red; float: left;">
         <a href ="portfolio.php" id="side">
            <div class="side">
              PORTFOLIO
            </div>
         </a>

         <a href ="transaction.php" id="side"> 
            <div class="side" >
              Transaction
            </div>
         </a>

         <a href ="search.php" id="side"> 
            <div class="side" >
              Search
            </div>
         </a>
    </div>

</body>
</html>