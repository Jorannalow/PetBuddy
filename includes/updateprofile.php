<?php
session_start();
require 'dbhandler.php';

if(isset($_POST['update-submit-shelter'])){
	$name = $_POST['name'];
	$website = $_POST['website'];
	$description = $_POST['description'];
	
	echo $name;
	echo $website;
	echo $description;
	
	if(empty($name)|| empty($website) || empty($description)){
		header("Location: ../updateprofile.php?error=emptyfields&name=".$name."&website=".$website);
		exit();
	} else {
		$sql = "UPDATE usershelter SET 
				name = '".$name."', website = '".$website."', description = '".$description."'
				WHERE id = '".$_SESSION['uid']."'";
				
		$stmt = mysqli_stmt_init($connection);
		echo $sql;
		if(!mysqli_stmt_prepare($stmt, $sql)){
			header("Location: ../updateprofile.php?error=sqlerror");
			exit();
		} else {
			mysqli_stmt_execute($stmt);
			header("Location: ../myprofile.php?update=success");
			exit();

		}
	}
	mysqli_stmt_close($stmt);
	mysqli_close($connection);
	
}else if (isset($_POST['update-submit-adopter'])){
	$name = $_POST['name'];
	$occupation = $_POST['occupation'];
	$dob = $_POST['dob'];
	$propertyId = $_POST['propertyId'];
	$petExp = $_POST['petExp'];
	$noOfAdults = $_POST['noOfAdults'];
	$noOfChildren = $_POST['noOfChildren'];
	$noOfPets = $_POST['noOfPets'];	
	
	if(empty($name)|| empty($occupation) || empty($dob)  || empty($propertyId) ){
		header("Location: ../updateprofile.php?error=emptyfields");
		exit();
	}else {
		$sql = "UPDATE useradopter SET 
				name = '".$name."', occupation = '".$occupation."', dob = '".$dob."', propertyId = '".$propertyId."', petExp = '".$petExp."', 
				noOfAdults = '".$noOfAdults."', noOfChildren = '".$noOfChildren."', noOfPets = '".$noOfPets."'
				WHERE id = '".$_SESSION['uid']."'";
				echo $sql;
		$stmt = mysqli_stmt_init($connection);
		echo $sql;
		if(!mysqli_stmt_prepare($stmt, $sql)){
			header("Location: ../updateprofile.php?error=sqlerror");
			exit();
		} else {
			mysqli_stmt_execute($stmt);
			header("Location: ../myprofile.php?update=success");
			exit();

		}
	}

	mysqli_stmt_close($stmt);
	mysqli_close($connection);
		
}else{
	header("Location: ../updateprofile.php");
	exit();
}