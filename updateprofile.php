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
    <h5 class="card-header">Update Profile</h5>
    <div class="card-body">
            <?php
			if(!empty($_SESSION['uid'])){

			if ($_SESSION['roleId']== '1'){
				$result = mysqli_query($connection, "SELECT * FROM useradopter WHERE id ='".$_SESSION['uid']."'");
				$row = mysqli_fetch_array($result);
				
				echo'
				<form name="form-updateProfile" method="post" action="includes/updateprofile.php">
				<div class="form-group">
					<label>Name:</label>
					<input type = "text" class="form-control" name= "name" class="txtField" value="'.$row['name'].'">
				</div>
				<div class="form-group">
					<label>Occupation:</label>
					<input type = "text" class="form-control" name= "occupation" class="txtField" value="'.$row['occupation'].'">
				</div>
					<div class="form-group">
					<label>Date of birth:</label>
				<input type = "date" class="form-control" name= "dob" class="txtField" value="'.$row['dob'].'">
				</div>
					<div class="form-group">
					<label>Property Type:</label>
					<select class="form-control" name="propertyId">
      					<option value="1">HDB 2-Room Flexi</option>
      					<option value="2">HDB 3-Room</option>
      					<option value="3">HDB 4-Room</option>
      					<option value="4">HDB 5-Room</option>
      					<option value="5">HDB 3Gen</option>
						<option value="6">HDB Executive Flat</option>
						<option value="7">Condominium</option>
						<option value="8">Landed</option>
					</select>
				</div>
				<div class="form-group">
					<label>Experience with Pets (in years):</label>
					<input type = "number" class="form-control" name= "petExp" class="txtField"  min="0" value="'.$row['petExp'].'">
				</div>
				<div class="form-group">
					<label>Living with no. of adults:</label>
					<input type = "number" class="form-control" name= "noOfAdults" class="txtField"  min="0" value="'.$row['noOfAdults'].'">
				</div>
				<div class="form-group">
					<label>Living with no. of children (below 12):</label>
					<input type = "number" class="form-control" name= "noOfChildren" class="txtField" min="0" value="'.$row['noOfChildren'].'">
				</div>
				<div class="form-group">
					<label>Have pets at the moment:</label>
					<input type = "number" class="form-control" name= "noOfPets" class="txtField" min="0" value="'.$row['noOfPets'].'">
				</div>
            	<input type="submit" name="update-submit-adopter" value="Submit" class="btn btn-primary">
				</form>
				';
			}else if ($_SESSION['roleId']== '2'){
			$result = mysqli_query($connection, "SELECT * FROM usershelter WHERE id ='".$_SESSION['uid']."'");
			$row = mysqli_fetch_array($result);
			
            echo'
            <form name="form-updateProfile" method="post" action="includes/updateprofile.php">
            <div>
            </div>
            <div class="form-group">
            <label>Name:</label>
            <input type = "text" class="form-control" name= "name" class="txtField" value="'.$row['name'].'">
            </div>
            <div class="form-group">
            <label>Website:</label>
            <input type = "text" class="form-control" name= "website" class="txtField" value="'.$row['website'].'">
            </div>
            <div class="form-group">
            <label>Description:</label>
            <input type = "text" class="form-control" name= "description" class="txtField" value="'.$row['description'].'">
            </div>
            <input type="submit" name="update-submit-shelter" value="Submit" class="btn btn-primary">
            </form>
			';
            }
			}else{
				echo'
				<div class="alert alert-danger" role="alert">
  				Error! Please log in to access this page.
				</div>';
			}?>
    </div>
  </div>
</div>

<?php
include('footer.php');
?>

</body>
</html>
