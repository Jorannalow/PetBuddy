<?php
session_start();
include('header.php');
?>

<title>PetBuddy - Singapore Pet Adoption Platform</title>

<body>
<?php
include('navbar.php');
?>

<div class="container pt-4 pb-4">
<?php
if(isset($_GET['update'])){
		if($_GET['update'] == "success"){
			echo '<p class="text-success">Animal listing has been deleted successfully.</p>';
		}
	}
?>
  <div class="card mb-4 ">
    <h5 class="card-header"> Profile </h5>
    <div class="card-body">
      <?php
		  	include_once 'includes/dbhandler.php';
			if(!empty($_SESSION['uid'])){

			$uid = $_SESSION['uid'];
			
			if ($_SESSION['roleId']== '1'){
				
		  	$sql = "Select * FROM useradopter where id = '$uid' ";
			$stmt = mysqli_stmt_init($connection);
			
			if(!mysqli_stmt_prepare($stmt, $sql)){
				header("Location: ../myprofile.php?error=sqlerror");
				exit();
			}else{
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				while($row = mysqli_fetch_assoc($result)){
					$propertyId = $row['propertyId'];

					$sql = "Select type FROM property where propertyId = '$propertyId' ";
			
					if(!mysqli_stmt_prepare($stmt, $sql)){
						header("Location: ../myprofile.php?error=sqlerror");
						exit();
					}else{
						mysqli_stmt_execute($stmt);
						$result = mysqli_stmt_get_result($stmt);
						while($row2 = mysqli_fetch_assoc($result)){
							
					echo'
					<p class="card-text">Name: '.$row['name'].'</p>
					<p class="card-text">Email: '.$row['email'].'</p>
					<p class="card-text">Occupation: '.$row['occupation'].'</p>
					<p class="card-text">Date of Birth: '.$row['dob'].'</p>
					<p class="card-text">Property Type: '.$row2['type'].'</p>
					<p class="card-text">Experience with Pets (in years): '.$row['petExp'].'</p>
					<p class="card-text">Living with no. of adults: '.$row['noOfAdults'].'</p>
					<p class="card-text">Living with no. of children (below 12): '.$row['noOfChildren'].'</p>
					<p class="card-text">Have pets at the moment: '.$row['noOfPets'].'</p>
					<a href="updateprofile.php" class="btn btn-primary">Update Profile</a>
					';
						}
				}
				}
			}
				
			}else if ($_SESSION['roleId']== '2'){
			
		  	$sql = "Select * FROM usershelter where id = '$uid' ";
			$stmt = mysqli_stmt_init($connection);
			if(!mysqli_stmt_prepare($stmt, $sql)){
				header("Location: ../myprofile.php?error=sqlerror");
				exit();
			}else{
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				while($row = mysqli_fetch_assoc($result)){
					echo'
					<p class="card-text">Name: '.$row['name'].'</p>
					<p class="card-text">Email: '.$row['email'].'</p>
					<p class="card-text">Website: '.$row['website'].'</p>
					<p class="card-text">Description: '.$row['description'].'</p>
					<a href="adoptapplication.php" class="btn btn-primary">View Adoption Applications</a><br/><br/>
					<a href="updateprofile.php" class="btn btn-primary">Update Profile</a>
					';
				}
			}
			}
				
			}else{
				echo'
				<div class="alert alert-danger" role="alert">
  				Error! Please log in to access this page.
				</div>';
			}
		  ?>
          
    </div>
  </div>
  
  <div class="row">
    <?php
	if(!empty($_SESSION['uid'])){

	if ($_SESSION['roleId']== '2'){
	$sql = "Select shelterId FROM usershelter where id = '$uid' ";
	$stmt = mysqli_stmt_init($connection);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		header("Location: ../myprofile.php?error=sqlerror");
		exit();
	}else{
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		while($row = mysqli_fetch_assoc($result)){
			$resultstring = $row['shelterId'];
		}
	}
	$sql = "Select * from animallisting WHERE shelterId = '$resultstring'";
	if(!mysqli_stmt_prepare($stmt, $sql)){
		header("Location: ../myprofile.php?error=sqlerror");
		exit();
	}else{
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		while($row = mysqli_fetch_assoc($result)){
			echo'
			<div class="col-md-4"> 
			   <div class="card mb-4">
			     <div class="embed-responsive embed-responsive-1by1">
					<img class="card-img-top embed-responsive-item"  src="uploads/'.$row["filename"].'" height="42">
					</div>
        				  <div class="card-body">
          				   <h5 class="card-title">'.$row["name"].'</h5>
						   <p class="card-text">'.$row["gender"].'</p>
						   <p class="card-text">'.$row["description"].'</p>
						   <a href="animalinfo.php?id='.$row["animalId"].'" class="stretched-link">View More</a>
        				  </div>
				</div>
    		</div>
			';
		}
	}
	}//end if
	}//end if
	
	?>
  </div>
</div>

<?php
include('footer.php');
?>

</body>
</html>
