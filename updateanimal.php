<?php
session_start();
include('header.php');
include_once 'includes/dbhandler.php';
?>

<title>PetBuddy - Singapore Pet Adoption Platform</title>
<body>
<?php
include('navbar.php');
?>

<div class="container pt-4 pb-4">
  <div class="card mb-4">
    <h5 class="card-header">Update Animal</h5>
    <div class="card-body">
            <?php
			  if(!empty($_SESSION['uid'])){

				$animalId = $_GET['id'];
				$result = mysqli_query($connection, "SELECT * FROM animals WHERE animalId = '$animalId'");
				$row = mysqli_fetch_array($result);
				
				echo'
				<form name="form-updateProfile" method="post" action="includes/updateanimal.php">
				<div class="form-group">
				<label>Name:</label>
				<input type = "text" class="form-control" name= "name" class="txtField" value="'.$row['name'].'">
				</div>
				<div class="form-group">
					<label>Gender:</label>
					<select class="form-control" name="gender">
      					<option value="Female">Female</option>
      					<option value="Male">Male</option>
					</select>				
				</div>
				<div class="form-group">
					<label>Type:</label>
					<select class="form-control" name="type">
      					<option value="Dog">Dog</option>
      					<option value="Cat">Cat</option>
					</select>				
				</div>
				<div class="form-group">
					<label>Breed:</label>
					<input type = "text" class="form-control" name= "breed" class="txtField" value="'.$row['breed'].'">
				</div>	
				<div class="form-group">
					<label>Age:</label>
					<input type = "text" class="form-control" name= "age" class="txtField" value="'.$row['age'].'">
				</div>	
				<div class="form-group">
					<label>Description:</label>
					<input type = "text"  class="form-control" name= "description" class="txtField" value="'.$row['description'].'">
				</div>
				<div class="form-group">
					<label>Status:</label>
					<select class="form-control" name="status">
      				<option value="1">Available</option>
      				<option value="2">On Home Trial</option>
					<option value="3">Adopted</option>
					</select>				
				</div>
				<div class="form-group">
				<input type="hidden" name="animalId" value="'.$row['animalId'].'">
            	<input type="submit" name="update-submit-animal" value="Submit" class="btn btn-primary">
				</form>
				';
				}else{
					echo'
					<div class="alert alert-danger" role="alert">
  							Error! Please log in to access this page.
					</div>';
				}
			
  			?>
    </div>
  </div>
</div>

<?php
include('footer.php');
?>

</body>
</html>
