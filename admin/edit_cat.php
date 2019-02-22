<?php include "inc/header.php"; ?>
<?php

if(isset($_POST['edit_cat'])){
	$cat_id = $_POST['cat_id'];
	$name = $_POST['cat_name'];
	$icon = $_POST['icon'];
	
	$update = mysqli_query($con,"UPDATE category SET name='$name',icon='$icon' WHERE id='$cat_id'");
	if($update){
		echo "<script>window.location='view_cat.php?edit=success'</script>";
		exit();
	}
}

if(isset($_GET['edit']) && $_GET['edit'] !=''){
	$edit_id = $_GET['edit'];
	$fetch = mysqli_query($con,"SELECT * FROM category WHERE id='$edit_id'");
	$run = mysqli_fetch_array($fetch);
	$name = $run['name'];
	$icon = $run['icon'];
	
}else{
	echo "<script>window.location='index.php'</script>";
    exit();
	}
	
	
?>

<main class="container">
<h3 class="center teal-text darken-4">Edit Category</h3><div class="divider"></div>
<div class="card">
   <div class="card-content">
 
	       <form action="edit_cat.php" method="post">
		        <div class="row">
				   <div class="input-field">
				      <i class="material-icons prefix">label</i>
					  <input id="title" type="text" name="cat_name" value="<?php echo $name; ?>" class="validate" required>
					  <input id="edit_id" type="hidden" name="cat_id" value="<?php echo $edit_id; ?>">
					  <label for="title">Name</label>
				   </div>
				   
				   <div class="input-field">
				      <i class="material-icons prefix">android</i>
					  <input id="title" name="icon" type="text" value="<?php echo $icon; ?>" class="validate" required>
					  <label for="title">Icon</label>
				   </div>
				   					 
						<center>
						<button class="btn waves-effect waves-light" type="submit" name="edit_cat" style="margin-top:50px;">Update
						<i class="material-icons right">send</i>
					  </button>
					  <a href="view_cat.php" class="btn orange" style="margin-top:50px;">Cancel</a>
					  </center>
				</div>
		   </form>
   </div>
</div>
</main>


<?php include "inc/footer.php"; ?>