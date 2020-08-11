<?php

if(isset($_POST['login-submit'])){

	require 'dbhandler.php';
	
	$email = $_POST['email'];
	$password = $_POST['pwd'];
	
	if(empty($email) || empty($password)){
		header("Location: ../login.php?error=emptyfields");
		exit();
	}else{
		$sql = "SELECT * FROM user WHERE email=?";
		$stmt = mysqli_stmt_init($connection);
		if(!mysqli_stmt_prepare($stmt, $sql)){
			header("Location: ../login.php?error=sqlerror");
			exit();
		}else{
			mysqli_stmt_bind_param($stmt, "s", $email);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			if($row = mysqli_fetch_assoc($result)){
				$passwordCheck = password_verify($password, $row['password']);
				if($passwordCheck == false){
					header("Location: ../login.php?error=wrongpwd");
					exit();
				}else if($passwordCheck == true){
					//login user to website
					session_start();
					$_SESSION['uid']= $row['id'];
					$userid = $row['id'];
					$_SESSION['email']= $row['email'];
					$_SESSION['roleId']= $row['roleId'];
					
					if ($_SESSION['roleId']== '2'){
						$sql = "SELECT shelterId FROM shelter WHERE userId = '$userid'";
						$result = mysqli_query($connection, $sql);
								while($row = mysqli_fetch_array($result)){
									$resultstring = $row['shelterId']; 
									$_SESSION['shelterId'] = $resultstring;
									//echo $_SESSION['shelterId'];
								}
					}else if ($_SESSION['roleId']== '1'){
						$sql = "SELECT adopterId FROM adopter WHERE userId = '$userid'";
						$result = mysqli_query($connection, $sql);
							while($row = mysqli_fetch_array($result)){
								$resultstring = $row['adopterId']; 
								$_SESSION['adopterId'] = $resultstring;
							}
					}

					header("Location: ../home.php?login=success");
					exit();
				}else{
					header("Location: ../login.php?error=wrongpwd");
					exit();
				}
			}else{
				header("Location: ../login.php?error=nouser");
				exit();
			}
		}
	}
		
}else{
	header("Location: ../login.php");
	exit();
}