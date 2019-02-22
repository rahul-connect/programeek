<?php include "inc/header.php"; ?>

<main class="container">
<h3 class="center teal-text darken-4">Insert Sub-Category</h3><div class="divider"></div>
<div class="card">
   <div class="card-content">
 
	       <form action="function/function.php" method="post">
		        <div class="row">
				   <div class="input-field">
				      <i class="material-icons prefix">label</i>
					  <input id="title" type="text" name="sub_name" class="validate" required>
					  <label for="title">Sub-Category Name</label>
				   </div>
				   
				  <div class="input-field">
				   <i class="material-icons prefix">label</i>
					<select name="category">
					  <option value="" disabled selected>Choose a Category</option>
					  <?php 
					    $fetch_cat = mysqli_query($con,"SELECT id,name FROM category");
						while($row = mysqli_fetch_array($fetch_cat)){
							$id = $row['id'];
							$name = strtoupper($row['name']);
							echo "<option value='$id'>$name</option>";
						}
					  ?>
					  
					</select>
					<label>Select Category</label>
					
				  </div>
				   					 
						<center>
						<button class="btn waves-effect waves-light" type="submit" name="insert_sub" style="margin-top:50px;">Submit
						<i class="material-icons right">send</i>
					  </button>
					  </center>
				</div>
		   </form>
   </div>
</div>
</main>


<?php include "inc/footer.php"; ?>