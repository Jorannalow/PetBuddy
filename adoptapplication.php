<?php
session_start();
include('header.php');
?>
<html>

<title>PetBuddy - Singapore Pet Adoption Platform</title>
<body>
<?php
include('navbar.php');
?>
<div class="container">
<table class="table">
  	<thead>
  	<tr>
		<th scope="col">Adopter Name</th>
      	<th scope="col">Animal Name</th>
		<th scope="col">Status</th>
  	</tr>
  	</thead>
	<tbody>
    <?php
		include_once 'includes/dbhandler.php';
		$shelterId = $_SESSION['shelterId'];
		  
		$sql = "Select * FROM animalsapplication WHERE shelterId = '$shelterId'";
		$stmt = mysqli_stmt_init($connection);
		if(!mysqli_stmt_prepare($stmt, $sql)){
			header("Location: ../adoptapplication.php?error=sqlerror");
			exit();
		}else{
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			while($row = mysqli_fetch_assoc($result)){
				echo'
				<tr>
					<td>'.$row['adoptername'].'</td>
      				<td>'.$row['name'].'</td>
      				<td>'.$row['status'].'</td>
				</tr>
				';
			}
		}
	?>
	</tbody>
</table>
</div>
<?php
include('footer.php');
?>

</body>
</html>
