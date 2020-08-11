<?php
	session_start();
	
	require 'dbhandler.php';
	
	$animalId = $_GET['id'];
	
	if(empty($_GET["id"])){
		header("Location: ../animalinfo.php?error=noid");
		exit();
	} else { 
		$sql = "DELETE FROM images WHERE animalId = '$animalId'";
		$stmt = mysqli_stmt_init($connection);
		if(!mysqli_stmt_prepare($stmt, $sql)){
			header("Location: ../animalinfo.php?error=sqlerror");
			exit();
		} else {
			mysqli_stmt_execute($stmt);
			$sql = "DELETE FROM animals WHERE animalId = '$animalId'";
			$stmt = mysqli_stmt_init($connection);
			if(!mysqli_stmt_prepare($stmt, $sql)){
				header("Location: ../animalinfo.php?error=sqlerror");
				exit();
			} else {
				mysqli_stmt_execute($stmt);
				header("Location: ../myprofile.php?update=success");
				exit();
			}
		}
	}
	mysqli_stmt_close($stmt);
	mysqli_close($connection);