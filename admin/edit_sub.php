<?php include "inc/header.php"; ?>

<?php
if(isset($_POST['update_sub'])){
   $sub_id = $_POST['sub_id'];	
   $sub_name = $_POST['sub_name'];	
   $sub_cat = $_POST['category'];	
   
   $update = mysqli_query($con,"update category SET name='$sub_name',sub='$sub_cat' WHERE id='$sub_id'");
   if($update){
	   echo "<script>window.location='view_sub.php?edit=success';</script>";
   }
}
?>


<?php
if(isset($_GET['edit'])){
	$edit_id = $_GET['edit'];
    $fetch = mysqli_query($con,"SELECT * FROM category WHERE id='$edit_id'");
	$run = mysqli_fetch_array($fetch);
	$sub_name = $run['name'];
	$sub_cat = $run['sub'];
	
}
?>
<main class="container">
<h3 class="center teal-text darken-4">Edit Sub-Category</h3><div class="divider"></div>
<div class="card">
   <div class="card-content">
 
	       <form action="edit_sub.php" method="post">
		        <div class="row">
				   <div class="input-field">
				      <i class="material-icons prefix">label</i>
					  <input id="title" type="text" name="sub_name" class="validate" value="<?php echo $sub_name; ?>" required>
					  <input id="sub_id" type="hidden" name="sub_id" class="validate" value="<?php echo $edit_id; ?>" required>
					  <label for="title">Sub-Category Name</label>
				   </div>
				   
				  <div class="input-field">
				   <i class="material-icons prefix">label</i>
					<select name="category">
					  
					    <?php 
					    $fetch_cat = mysqli_query($con,"SELECT id,name FROM category WHERE sub=0");
						while($row = mysqli_fetch_array($fetch_cat)){
							$id = $row['id'];
							$name = strtoupper($row['name']);
							if($id == $sub_cat){
								$selected='selected';
							}else{
								$selected='';
							}
							echo "<option value='$id' $selected>$name</option>";
						}
					  ?>
					  
					</select>
					<label>Select Category</label>
					
				  </div>
				   					 
						<center>
						<button class="btn waves-effect waves-light" type="submit" name="update_sub" style="margin-top:50px;">Update
						<i class="material-icons right">send</i>
					  </button>
					  <a href="view_sub.php" class="btn orange" style="margin-top:50px;">Cancel</a>
					  </center>
				</div>
		   </form>
   </div>
</div>
</main>


<?php include "inc/footer.php"; ?>