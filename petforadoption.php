<?php
session_start();
include('header.php');
?>

<title>PetBuddy - Singapore Pet Adoption Platform</title>
<script src="js/search.js"></script>
<style>
.breedSection{
	height: 280px; 
	overflow-y: auto; 
	overflow-x: hidden;
}
</style>

<body>
<?php
include('navbar.php');

/* Title: Product Filter Search with Ajax, PHP & MySQL
Author: PHPZAG Team
Date: 4/12/2019
Availability: https://www.phpzag.com/product-filter-search-with-ajax-php-mysql/
*/
?>

<div class="container pt-4 pb-4">  
<?php
include 'includes/Animal.php';
$animal = new Animal();
?>
  <div class="row">
  <div class="col-md-3">  
	<div class="list-group">
    <h4>Gender</h4>
	<div class="genderSection">
    <?php
	$gender = $animal->getGender();
	foreach($gender as $genderDetails){
	?>
    <div class="list-group-item checkbox">
    <label>
    <input type="checkbox" class="animalDetails gender" value="<?php echo $genderDetails['gender']; ?>">
    <?php echo $genderDetails['gender']; ?>
    </label>
	</div>
    <?php } ?>
	</div>
	</div>
    	<br/>
    <div class="list-group">
    <h4>Type</h4>
	<div class="typeSection">
    <?php
	$type = $animal->getType();
	foreach($type as $typeDetails){
	?>
    <div class="list-group-item checkbox">
    <label>
    <input type="checkbox" class="animalDetails animaltype" value="<?php echo $typeDetails['type']; ?>">
    <?php echo $typeDetails['type']; ?>
    </label>
	</div>
    <?php } ?>
	</div>
	</div>
    	<br/>
    <div class="list-group">
    <h4>Breed</h4>
	<div class="breedSection">
    <?php
	$breed = $animal->getBreed();
	foreach($breed as $breedDetails){
	?>
    <div class="list-group-item checkbox">
    <label>
    <input type="checkbox" class="animalDetails breed" value="<?php echo $breedDetails['breed']; ?>">
    <?php echo $breedDetails['breed']; ?>
    </label>
	</div>
    <?php } ?>
	</div>
	</div>
    	<br/>
  </div>
    
  

  <div class="col-md-9">
  <h3>Search Results</h3>
<div class="row searchResult">

</div>
</div>
</div>
</div>

<?php
include('footer.php');
?>

</body>
</html>
