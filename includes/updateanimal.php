<?php
session_start();
	
require 'dbhandler.php';
	
if(isset($_POST['update-submit-animal'])){
		$animalId = $_POST['animalId'];
		$name = $_POST['name'];
		$gender = $_POST['gender'];
		$type = $_POST['type'];
		$breed = $_POST['breed'];
		$age = $_POST['age'];
		$description = $_POST['description'];
		$status = $_POST['status'];
			
		if(empty($name)|| empty($breed)){
			header("Location: ../updateanimal.php?error=emptyfields&name=".$name."&breed=".$breed);
			exit();
		} else {
			$sql = "UPDATE animals SET 
					name = '".$name."', gender = '".$gender."', type = '".$type."', breed = '".$breed."', age = '".$age."', description = '".$description."'
					, statusId = '".$status."'
					WHERE animalId = '".$animalId."'";
			$stmt = mysqli_stmt_init($connection);
			echo $sql;
			if(!mysqli_stmt_prepare($stmt, $sql)){
				header("Location: ../updateanimal.php?error=sqlerror");
				exit();
			} else {
				mysqli_stmt_execute($stmt);
				header("Location: ../animalinfo.php?id=$animalId&update=success");
				exit();
			}
		}
		
		mysqli_stmt_close($stmt);
		mysqli_close($connection);

}else{
	header("Location: ../petforadoption.php");
	exit();
}
	
