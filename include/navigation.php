<nav class="navbar navbar-light bg-dark navbar-expand">
  <div class="container-fluid" style=" margin-left: 6%;">
    <a class="navbar-brand" href="#">	    	
      <font color="white" style="font-size: 30px; font-family: 'Robosto'">Stock Trainer</font>
    </a>
  </div>
  <div class="dropdown">
  	<a class="dropbtn" style="font-size: 30px; padding-right: 100px;">
  		<i class="fa fa-user" aria-hidden="true">
	  	<?php echo $_SESSION['username'];?>  
      </i>
  	</a>
  	<div class="dropdown-content" style="z-index: 2;">
  		<a href="myaccount.php" class="btn" style="color:black;">My Profile</a>
  		<a href="logout.php" class="btn" style="color: black;">Logout</a>
  	</div>
  </div>
</nav>