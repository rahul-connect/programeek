<?php include "inc/header.php"; ?>

<main class="container">
<h3 class="center teal-text darken-4">Insert Category</h3><div class="divider"></div>
<div class="card">
   <div class="card-content">
 
	       <form action="function/function.php" method="post">
		        <div class="row">
				   <div class="input-field">
				      <i class="material-icons prefix">label</i>
					  <input id="title" type="text" name="cat_name" class="validate" required>
					  <label for="title">Name</label>
				   </div>
				   
				   <div class="input-field">
				      <i class="material-icons prefix">android</i>
					  <input id="title" name="icon" type="text" class="validate" required>
					  <label for="title">Icon</label>
				   </div>
				   					 
						<center>
						<button class="btn waves-effect waves-light" type="submit" name="insert_cat" style="margin-top:50px;">Submit
						<i class="material-icons right">send</i>
					  </button>
					  </center>
				</div>
		   </form>
   </div>
</div>
</main>


<?php include "inc/footer.php"; ?>