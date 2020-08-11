<?php
session_start();
include('header.php');?>

<title>PetBuddy - Singapore Pet Adoption Platform</title>
<body>
<?php
include('navbar.php');
?>
<div class="container">
<?php
if(isset($_GET['success'])){
	if($_GET['success'] == "reqsent"){
		echo'
		<div class="alert alert-success" role="alert">
  		Your application to adopt has been sent successfully.
		</div>
	';
	}
}
else if(isset($_GET['error'])){
	if($_GET['error'] == "applied"){
		echo'
		<div class="alert alert-danger" role="alert">
		You have already applied to adopt this animal.
		</div>
		';
	}else if($_GET['error'] == "sqlerror"){
		echo'
		<div class="alert alert-danger" role="alert">
		Error occured, please contact admin.
		</div>
		';
	}
}
?>
     <div class="card">
          <?php		  
		  	include_once 'includes/dbhandler.php';
			
	    	if(isset($_SESSION['email'])){ // if a user have logged in
				$uid = $_SESSION['uid'];
			}
			
			$animalId = $_GET['id'];
			
		  	$sql = "Select * FROM animallisting WHERE animalId = '$animalId'";
			$stmt = mysqli_stmt_init($connection);
			if(!mysqli_stmt_prepare($stmt, $sql)){
				header("Location: ../animalinfo.php?error=sqlerror");
				exit();
			}else{
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				while($row = mysqli_fetch_assoc($result)){
					echo'
					<img class="card-img-top" src="uploads/'.$row["filename"].'" style="width:50%">
         			<div class="card-body">
					<h5 class="card-title">'.$row['name'].'</h5>
					<p class="card-text">Gender: '.$row['gender'].'</p>
					<p class="card-text">Age (in years): '.$row['age'].'</p>
					<p class="card-text">Type: '.$row['type'].'</p>
					<p class="card-text">Description: '.$row['description'].'</p>
					<p class="card-text">Status: '.$row['status'].'</p>
					<small>Date Posted: '.$row["date"].'</small> <br/><br/>
					';
					if(isset($_SESSION['email'])){ // if a user have logged in
						if ($_SESSION['roleId']== '2'){
							if ($row['shelterId']==$_SESSION['shelterId']){
							echo'<a href="updateanimal.php?id='.$animalId.'" class="btn btn-primary">Update</a> <br/> <br/>';

							echo'<a href="includes/deleteanimal.php?id='.$animalId.'" class="btn btn-danger">Delete</a>';
							}
						}else if ($_SESSION['roleId']== '1'){
							echo'<a href="includes/adopt.php?id='.$animalId.'" class="btn btn-primary">Send request to adopt</a> <br/> <br/>';
						}
					}
				}
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
