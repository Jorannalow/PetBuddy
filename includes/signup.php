<?php
if(isset($_POST['signup-submit'])){
	
	require 'dbhandler.php';
	
	$email = $_POST['email'];
	$password = $_POST['pwd'];
	$confirmpassword = $_POST['pwdconfirm'];
	$usertype = $_POST['usertype'];
	
	if(empty($email) || empty($password) || empty($confirmpassword) || empty($usertype)){
		header("Location: ../register.php?error=emptyfields&email=".$email."&usertype=".$usertype);
		exit();
	}else if($password !== $confirmpassword){
		header("Location: ../register.php?error=passwordcheck&email=".$email."&usertype=".$usertype);
		exit();
	} else {
		$sql = "SELECT email FROM user WHERE email=?";
		$stmt = mysqli_stmt_init($connection);
		if(!mysqli_stmt_prepare($stmt, $sql)){
			header("Location: ../register.php?error=sqlerror");
			exit();
		} else {
			mysqli_stmt_bind_param($stmt, "s", $email);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$resultCheck = mysqli_stmt_num_rows($stmt);
			if($resultCheck > 0){
				header("Location: ../register.php?error=emailtaken&usertype=".$usertype);
				exit();
			}else{
				$sql = "INSERT INTO user (email, password, roleId)
				VALUES (?,?,?)";
				$stmt = mysqli_stmt_init($connection);
				
				if(!mysqli_stmt_prepare($stmt, $sql)){
					header("Location: ../register.php?error=sqlerror");
					exit();
				}else{
					$hashedPwd = password_hash($password, PASSWORD_DEFAULT);
					mysqli_stmt_bind_param($stmt, "ssi", $email, $hashedPwd, $usertype);
					mysqli_stmt_execute($stmt);	
									
						if ($usertype == '1'){
							$sql = "SELECT id FROM user WHERE email = '$email'";
							$result = mysqli_query($connection, $sql);
								while($row = mysqli_fetch_array($result)){
									$resultstring = $row['id']; 
									//echo $resultstring;
								}
								$sql2 = "INSERT INTO adopter (userId) VALUES (?)";
								$stmt2 = mysqli_stmt_init($connection);
								if(!mysqli_stmt_prepare($stmt2, $sql2)){
									header("Location: ../register.php?error=sqlerror");
									exit();
								}else{
									mysqli_stmt_bind_param($stmt2, "s", $resultstring);
									mysqli_stmt_execute($stmt2);	
									//echo "Insert into Shelter Successfully.";
									header("Location: ../home.php?signup=success");
								}
							
						}else if ($usertype == '2'){
							$sql = "SELECT id FROM user WHERE email = '$email'";
							$result = mysqli_query($connection, $sql);
								while($row = mysqli_fetch_array($result)){
									$resultstring = $row['id']; 
									//echo $resultstring;
								}
								$sql2 = "INSERT INTO shelter (userId) VALUES (?)";
								$stmt2 = mysqli_stmt_init($connection);
								if(!mysqli_stmt_prepare($stmt2, $sql2)){
									header("Location: ../register.php?error=sqlerror");
									exit();
								}else{
									mysqli_stmt_bind_param($stmt2, "s", $resultstring);
									mysqli_stmt_execute($stmt2);	
									//echo "Insert into Shelter Successfully.";
									header("Location: ../home.php?signup=success");
								}
						}
					header("Location: ../register.php?signup=success");
					exit();
				}
			}
		}
	}
	mysqli_stmt_close($stmt);
	mysqli_close($connection);
}else{
	header("Location: ../register.php");
	exit();
}