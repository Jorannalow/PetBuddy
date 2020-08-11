<?php
session_start();
include('header.php');
include_once 'includes/dbhandler.php';
?>

<title>PetBuddy - Singapore Pet Adoption Platform</title>

<body>
<?php
include('navbar.php');
?>

<div class="container" id="registration">
  <h2>Add animal for adoption</h2>
  <?php
  if(!empty($_SESSION['uid'])){
  	if(isset($_GET['error'])){
		if($_GET['error'] == "emptyfields"){
			echo '<div class="alert alert-danger">Fill in all fields!</div>';
		}else if($_GET['error'] == "sqlerror"){
			echo '<div class="alert alert-danger">System error, please contact admin.</div>';
		}else if($_GET['error'] == "size"){
			echo '<div class="alert alert-danger">Your file is too big.</div>';
		}else if($_GET['error'] == "upload"){
			echo '<div class="alert alert-danger">Error uploading your file.</div>';
		}else if($_GET['error'] == "filetype"){
			echo '<div class="alert alert-danger">
			You cannot upoad files of this type, only .jpg, .jpeg and .png is allowed.
			</div>';
		}
	}else if(isset($_GET['upload'])){
			if($_GET['upload'] == "success"){
				echo '<div class="alert alert-success">
				<span class="glyphicon glyphicon-ok"></span>
				<strong>Animal added sucessful!</strong> </div>';
			}
	}
  ?>
  <form class="form-signup" action="includes/upload.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="sel1">Name:</label>
      <input type="text" class="form-control" name="name" placeholder="Enter name">
    </div>
    <label for="sel1">Gender:</label>
    <br/>
    <div class="form-check-inline">
      <label class="form-check-label" for="radio1">
        <input type="radio" class="form-check-input" name="gender" value="Female">
        Female </label>
    </div>
    <div class="form-check-inline">
      <label class="form-check-label" for="radio2">
        <input type="radio" class="form-check-input" name="gender" value="Male" >
        Male </label>
    </div>
    <br/>
    <br/>
    <div class="form-group">
      <label for="sel1">Animal type:</label>
      <select class="form-control" name="type">
        <option value="Dog">Dog</option>
        <option value="Cat">Cat</option>
      </select>
    </div>
    <div class="form-group">
      <label for="comment">Breed of animal:</label>
      <input type="text" class="form-control" name="breed" placeholder="Enter breed">
    </div>
    <div class="form-group"> 
      <label class="control-label" for="date">Age (in years):</label>
      <input type="text" class="form-control" name="age" placeholder="Enter age">
    </div>
    <div class="form-group">
      <label for="comment">Description of animal:</label>
      <textarea class="form-control" rows="3" id="description" name="description">
         </textarea>
    </div>
    <div class="form-group">
      <label for="comment">Photo of animal:</label><br/>
      <input type="file" name="file">
    </div>
    <button type="submit" name="submit" class="btn btn-success"> 
    Submit
    </button>
  </form>
  <br>
</div>

<?php
	}else{
				echo'
				<div class="alert alert-danger" role="alert">
  				Error! Please log in to access this page.
				</div>';
	}
include('footer.php');
?>

</body>
</html>
