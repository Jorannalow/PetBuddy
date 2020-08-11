<?php
session_start();
include('header.php');
?>

<title>PetBuddy - Singapore Pet Adoption Platform</title>

<body>
<?php
include('navbar.php');
?>

<div class="container mt-4">
<h4>Pets Available for Adoption</h4>
 <br />
  <div class="row">
    <?php
	include_once 'includes/dbhandler.php';
	
	$sql = "Select * from animallisting";
	$stmt = mysqli_stmt_init($connection);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		header("Location: ../allanimals.php?error=sqlerror");
		exit();
	}else{
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		while($row = mysqli_fetch_assoc($result)){
			echo'
			<div class="col-xl-3 col-lg-4 col-md-6"> 
			   <div class="card mb-4">

					<img class="card-img-top embed-responsive-item"  src="uploads/'.$row["filename"].'">

					<div class="card-body">
					<h6 class="card-title">'. $row['name'] .'</h6>
					<p class="card-text">'.$row["gender"].', '.$row["age"].' years old</p>
					<p class="card-text"><small class="text-muted">Date Posted: '.$row["date"].'</small></p>
					
					<a href="animalinfo.php?id='.$row["animalId"].'" class="stretched-link">View more</a>
					</div>
				</div>
    		</div>
			';
		}
	}
	
	?>
    </div>
    </div>

<?php
include('footer.php');
?>

</body>
</html>