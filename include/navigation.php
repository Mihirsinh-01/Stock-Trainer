<nav class="navbar navbar-light bg-dark navbar-expand">
  <div class="container-fluid" style=" margin-left: 10%;">
    <a class="navbar-brand" href="#">	    	
      <font color="white" style="font-size: 30px; font-family: 'Robosto'">Stock Trainer</font>
    </a>
  </div>
  <div class="dropdown">
  	<a class="dropbtn" style="font-size: 30px; padding-right: 100px;">
  		<i class="fa fa-user" aria-hidden="true">
	  	<?php echo $_SESSION['username'];?>
	  	 <!-- Mihir --></i>
  	</a>
  	<div class="dropdown-content">
  		<a href class="btn">My Profile</a>
  		<a href class="btn">Logout</a>
  	</div>
  </div>
</nav>