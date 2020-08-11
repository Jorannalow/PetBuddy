<?php
/* Title: Product Filter Search with Ajax, PHP & MySQL
Author: PHPZAG Team
Date: 4/12/2019
Availability: https://www.phpzag.com/product-filter-search-with-ajax-php-mysql/
*/

	session_start();
	include 'includes/Animal.php';
	$animal = new Animal();

if(isset($_POST["action"])){
	$html = $animal->searchAnimals($_POST);
	$data = array(
	"html" => $html,
	);
	echo json_encode($data); 
}
?>