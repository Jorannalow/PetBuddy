<?php
session_start();
include('header.php');
?>

<title>PetBuddy - Singapore Pet Adoption Platform</title>
<body>
<?php
include('navbar.php');
?>

<div class="container min-vh-75" id="registration">
  <h2>Login</h2>
  <?php
    	if(isset($_GET['error'])){
					if($_GET['error'] == "emptyfields"){
						echo'
						<div class="alert alert-danger" role="alert">
  						Please fill in the fields.
						</div>
						';
					}else if($_GET['error'] == "wrongpwd"){
						echo'
						<div class="alert alert-danger" role="alert">
  						Password does not match the email.
						</div>
						';
					}else if($_GET['error'] == "nouser"){
						echo'
						<div class="alert alert-danger" role="alert">
  						This email does not have an account.
						</div>
						';
					}
		}
  ?>
  <form action="includes/loginaction.php" method="post">
    <div class="form-group">
      <input type="email" name="email" class="form-control" id="email" placeholder="Email">
    </div>
    <div class="form-group">
      <input type="password" name="pwd" class="form-control" id="pwd" placeholder="Password">
    </div>
    <button type="submit" name="login-submit" class="btn btn-success">
    Submit
    </button>
  </form>
</div>

<?php
include('footer.php');
?>
</body>
</html>
