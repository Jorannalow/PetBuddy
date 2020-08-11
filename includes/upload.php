<?php
session_start();
if(isset($_POST['submit'])){
	require 'dbhandler.php';
		
	$name = $_POST['name'];
	$gender = $_POST['gender'];
	$type = $_POST['type'];
	$breed = $_POST['breed'];
	$age = $_POST['age'];
	$description = $_POST['description'];
	$statusid = '1';
	$shelterid = $_SESSION['uid'];
	$date = date("Y-m-d");
	
	$file = $_FILES['file'];
	$fileName = $_FILES['file']['name'];
	$fileTmpName = $_FILES['file']['tmp_name'];
	$fileSize = $_FILES['file']['size'];
	$fileError = $_FILES['file']['error'];
	$fileType = $_FILES['file']['type'];
	
	$fileExt = explode('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));
	
	$allowed = array('jpg', 'jpeg', 'png');
	
	if(empty($name) || empty($gender) || empty($type) || empty($breed) || empty($breed) ){
		header("Location: ../listanimal.php?error=emptyfields");
		exit();
	}else if(in_array($fileActualExt, $allowed)){
		if($fileError === 0){ 
			if($fileSize < 5000000){
				$fileNameNew = uniqid('', true).".".$fileActualExt; 
				$fileDestination = '../uploads/'.$fileNameNew;

				$sql = "INSERT INTO animals (name, gender, type, breed, age, description, statusId, shelterId, date) VALUES (?,?,?,?,?,?,?,?,?)";
				$stmt = mysqli_stmt_init($connection);
				echo $sql;
					if(!mysqli_stmt_prepare($stmt, $sql)){
						header("Location: ../listanimal.php?error=sqlerror");
						exit();
					}else{
						mysqli_stmt_bind_param($stmt, "ssssssiis", $name, $gender, $type, $breed, $age, $description, $statusid, $_SESSION['shelterId'], $date);
						mysqli_stmt_execute($stmt);
						echo "Success";
						
						echo "New Record has id ", $stmt->insert_id;
						$animalid = $stmt->insert_id;
						
						$sql = "INSERT INTO images (filename, animalid) VALUES (?, ?)";
						if(!mysqli_stmt_prepare($stmt, $sql)){
							header("Location: ../listanimal.php?error=sqlerror");
							exit();
						}else{
							mysqli_stmt_bind_param($stmt, "si", $fileNameNew, $animalid);
							mysqli_stmt_execute($stmt);
							echo "<br>";
							echo "$fileNameNew";
							move_uploaded_file($fileTmpName, $fileDestination);
							header("Location: ../listanimal.php?upload=success");
						}						
						exit();
					}
			}else{
				header("Location: ../listanimal.php?error=size");
				exit();
			}
		}else{
			header("Location: ../listanimal.php?error=upload");
		 	exit();
		}
	}else{
		header("Location: ../listanimal.php?error=filetype");
		 exit();
		echo "You cannot upoad files of this type.";
	}

}