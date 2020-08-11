<?php
	session_start();
	
	require 'dbhandler.php';
	
	$animalId = $_GET['id'];
	$adopterId = $_SESSION['adopterId'];
	$status = 'Pending';
	
	if(empty($_GET["id"])){
		header("Location: ../animalinfo.php?error=noid");
		exit();
	} else {
		$sql = "SELECT applicationid FROM application WHERE adopterid=? AND animalid=?";
		$stmt = mysqli_stmt_init($connection);
		if(!mysqli_stmt_prepare($stmt, $sql)){
			header("Location: ../animalinfo.php?id=$animalId&error=sqlerror");
			exit();
		} else {
			mysqli_stmt_bind_param($stmt, "ii", $adopterId, $animalId);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$resultCheck = mysqli_stmt_num_rows($stmt);
			if($resultCheck > 0){
				header("Location: ../animalinfo.php?id=$animalId&error=applied");
				exit();
			}else{
				$sql = "INSERT INTO application (adopterid, animalid, status) VALUES (?,?,?)";
				if(!mysqli_stmt_prepare($stmt, $sql)){
					header("Location: ../animalinfo.php?error=sqlerror");
					exit();
			}else{
				mysqli_stmt_bind_param($stmt, "iis", $adopterId, $animalId, $status);
				mysqli_stmt_execute($stmt);	
				header("Location: ../animalinfo.php?id=$animalId&success=reqsent");
				exit();
			}
			}
		}
	}
	mysqli_stmt_close($stmt);
	mysqli_close($connection);