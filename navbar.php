<nav class="navbar navbar-expand-sm navbar-light " style="background-color: #EBF5FB;">
  <div class="container"> <a class="navbar-brand" href="home.php">PetBuddy</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar"> <span class="navbar-toggler-icon"></span> </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"> <a class="nav-link" href="petforadoption.php">Pets For Adoption</a> </li>
        <?php
    if(isset($_SESSION['email'])){ // if a user have logged in
	        echo'
			<li class="nav-item">
        	<a class="nav-link" href="myprofile.php">Profile</a>
     	 	</li>
			';
		if(!empty($_SESSION['roleId'])){
		if ($_SESSION['roleId']== '2'){
			echo'
			<li class="nav-item">
        	<a href="listanimal.php" class="btn btn-primary mr-2" type="button">Add Animal for Adoption</a>
			</li>
			';
		}}
			echo'<form action="includes/logout.php" method="post">
    		<button type="submit" name="logout-submit" class="btn btn-danger">Log Out</button>
    		</form>';	
		}else{	
			echo'
			<li class="nav-item">
        	<a class="nav-link" href="register.php">Register</a>
    		</li>
			<li class="nav-item">
    		<a href="login.php" class="btn btn-outline-primary" type="button">Log In</a>
			</li>
    		';}
		?>
      </ul>
    </div>
  </div>
</nav>