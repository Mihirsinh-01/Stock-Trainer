<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
	<style type="text/css">
		a:link {color: white; text-decoration: none; cursor: default;}      /* unvisited link */
  	a:visited {color: black; text-decoration: none; cursor: default;}   /* visited link */
  a:hover {color: white; text-decoration: none; cursor: default;}     /* mouse over link */
  a:active {color: black; text-decoration: none; cursor: default;}

  .side{
    padding: 10px 20px;
    background-color: #f0f0f5;
    /*background-color: #8080ff;*/
    border: 1px solid #f0f0f5;
    color: black;
    height: 50px;
    font-size: 20px;

    /*display: flex;
    width:100%;
    align-items: stretch;*/
  }
  .side:hover{
    /*background-color: #b3b3ff;*/
    background-color: #b3b3cc;
    /*border: 1px solid black;*/
    color: white;
  }


    html, body {
        height: 100%;
        margin: 0px;
        /*background-color: #f0f0f5;*/
        font-family: "Robosto";
    }
    .contain {
        height: 100%;
        background: #f0e68c;
    }
	</style>
</head>
<body>
    <div class="contain" style="width: 350px; height: 100vh; background-color: #f0f0f5; float: left; padding-top: 50px;">
         <a href ="portfolio.php" id="side">
            <div class="side">
              <i class="fa fa-book" style="color: #8080ff; padding-right: 10px;"></i>
              PORTFOLIO
            </div>
         </a>

         <a href ="transaction.php" id="side"> 
            <div class="side" >
              <i class="fa fa-random" style="color: #8080ff; padding-right: 10px;"></i>
              TRANSACTION
            </div>
         </a>

         <a href ="search.php" id="side"> 
            <div class="side" >
              <i class="fa fa-search" style="color: #8080ff; padding-right: 10px;"></i>
              SEARCH
            </div>
         </a>

         <a href ="watchlist.php" id="side"> 
            <div class="side" >
              <i class="fa fa-bookmark" style="color: #8080ff; padding-right: 10px;"></i>
              WATCHLIST
            </div>
         </a>

         <a href ="myaccount.php" id="side"> 
            <div class="side" >
              <i class="fa fa-user" style="color: #8080ff; padding-right: 10px;"></i>
              MY ACCOUNT
            </div>
         </a>
    </div>
    <div style="border-left: 2px solid black; height: 100vh;position: absolute; left: 350px;">
      
    </div>

</body>
</html>