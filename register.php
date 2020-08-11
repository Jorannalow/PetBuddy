<?php
session_start();
include('header.php');
?>

<title>PetBuddy - Singapore Pet Adoption Platform</title>
<body>
<?php
include('navbar.php');
?>

<div class="container" id="registration">
  <h2>Registration</h2>
  <br/>
  <?php
  	if(isset($_GET['error'])){
		if($_GET['error'] == "emptyfields"){
			echo '<p class="text-danger">Fill in all fields!</p>';
		}else if($_GET['error'] == "passwordcheck"){
			echo '<p class="text-danger">Confirm password do not match.</p>';
		}else if($_GET['error'] == "emailtaken"){
			echo '<p class="text-danger">This email already has an account.</p>';
		}
	}else if(isset($_GET['signup'])){
			if($_GET['signup'] == "success"){
				echo '<div class="alert alert-success">
				<span class="glyphicon glyphicon-ok"></span>
				<strong>Sign up sucessful!</strong> </div>';
			}
	}
  ?>
  <form class="form-signup" action="includes/signup.php" method="post">
    <div class="form-group">
      <input type="email" class="form-control" name="email" placeholder="Enter email">
    </div>
    <div class="form-group">
      <input type="password" class="form-control" name="pwd" placeholder="Enter password">
    </div>
    <div class="form-group">
      <input type="password" class="form-control" name="pwdconfirm" placeholder="Enter confirm password">
    </div>
    <div class="form-check-inline">
      <label class="form-check-label" for="radio1">
        <input type="radio" class="form-check-input" name="usertype" value="1">I am a adopter
      </label>
    </div>
    <div class="form-check-inline">
      <label class="form-check-label" for="radio2">
        <input type="radio" class="form-check-input" name="usertype" value="2" >I am a shelter/fosterer
      </label>
    </div><br><br>
    
    <button type="submit" name="signup-submit" class="btn btn-success">Submit</button>
  </form><br>
</div>

<?php
include('footer.php');
?>
</body>
</html>
