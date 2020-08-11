<?php
class Animal{

	private $dbServername = "localhost";
	private $dbUsername = "root";
	private $dbPassword = "";
	private $dbName = "petbuddy";
	private $animalTable = 'animallisting';

	private $dbConnect = false;
	
    public function __construct(){
        if(!$this->dbConnect){ 
            $conn = new mysqli($this->dbServername, $this->dbUsername, $this->dbPassword, $this->dbName);
            if($conn->connect_error){
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            }else{
                $this->dbConnect = $conn;
            }
        }
    }

	private function getData($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$data= array();
		while ($row = mysqli_fetch_array($result)) {
			$data[]=$row;            
		}
		return $data;
	}
	
	private function getNumRows($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$numRows = mysqli_num_rows($result);
		return $numRows;
	}		
	
	public function getGender(){
		$sqlQuery = "
			SELECT DISTINCT(gender)
			FROM animallisting ";
        return  $this->getData($sqlQuery);
	}
	
	public function getType(){
		$sqlQuery = "
			SELECT DISTINCT(type)
			FROM animallisting ";
        return  $this->getData($sqlQuery);
	}
	
	public function getBreed(){
		$sqlQuery = "
			SELECT DISTINCT(breed)
			FROM animallisting ";
        return  $this->getData($sqlQuery);
	}
	
/* Title: Product Filter Search with Ajax, PHP & MySQL
Author: PHPZAG Team
Date: 4/12/2019
Availability: https://www.phpzag.com/product-filter-search-with-ajax-php-mysql/
*/
	
public function searchAnimals(){
	$sqlQuery = "SELECT * FROM ".$this->animalTable." WHERE statusId = '1'";
	if(isset($_POST["gender"])){
		$genderFilterData = implode("','", $_POST["gender"]);
		$sqlQuery .=
		" AND gender IN('".$genderFilterData."')";
	}
	if(isset($_POST["animaltype"])){
		$typeFilterData = implode("','", $_POST["animaltype"]);
		$sqlQuery .=
		" AND type IN('".$typeFilterData."')";
	}
	if(isset($_POST["breed"])){
		$breedFilterData = implode("','", $_POST["breed"]);
		$sqlQuery .=
		" AND breed IN('".$breedFilterData."')";
	}
	
	$result = mysqli_query($this->dbConnect, $sqlQuery);
	$totalResult = mysqli_num_rows($result);
	$searchResultsHTML = '';
	if($totalResult > 0){
	while($row = mysqli_fetch_array($result)){
		$searchResultsHTML .='
		<div class="col-xl-4 col-lg-5 col-md-6">
		<div class="card mb-4">
		<div class="animal">
		<img class="card-img-top embed-responsive-item" src="uploads/'.$row["filename"].'">
		<div class="card-body">
		<h6 class="card-title">'. $row['name'] .'</h6>
		<p class="card-text">'.$row["gender"].', '.$row["age"].' years old
		<br />
		<small>Date Posted: '.$row["date"].'</small>
		</p>
		
		<a href="animalinfo.php?id='.$row["animalId"].'" class="stretched-link"></a>
		</div>
		</div>
		</div>
		</div>
		';
	}
}else{
	$searchResultsHTML = '<h3>No animals found.</h3>';
}
	return $searchResultsHTML;
}

}
?>