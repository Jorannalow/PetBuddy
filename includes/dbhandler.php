<?php

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "petbuddy";

$connection = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

if(!$connection){
	die("Connection failed");
}else{
	//echo "connected";
}