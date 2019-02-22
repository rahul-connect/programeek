<?php include "inc/header.php"; ?>
<main class="container">
<h3 class="center teal-text darken-4">Insert Post</h3><div class="divider"></div>
<div class="card">
   <div class="card-content">
 
	       <form action="function/function.php" method="post" enctype="multipart/form-data">
		        <div class="row">
				   <div class="input-field">
				      <i class="material-icons prefix">star</i>
					  <input id="title" name="title" type="text" required class="validate">
					  <label for="title">Title</label>
				   </div>
				   
				   <div class="input-field">
				   <!-- <i class="material-icons prefix">label</i>-->
					<select name="category" id="category" class='browser-default category'>
					  <option value="" disabled selected>Choose a Category</option>
					  <?php 
					    $fetch_cat = mysqli_query($con,"SELECT id,name FROM category WHERE sub=0");
						while($row = mysqli_fetch_array($fetch_cat)){
							$id = $row['id'];
							$name = strtoupper($row['name']);
							echo "<option value='$id'>$name</option>";
						}
					  ?>
					  
					</select>
					</div>
					<div class="input-field">
					<select name="sub" id="sub" class='browser-default sub'>
					    <option value="" disabled selected>Choose a Sub Category</option>
					
					</select>
				  </div>
				  
				  <div class="input-field">
				   <i class="material-icons prefix">label</i>
				   
				   
				  </div>
				   
				  <div class="file-field input-field">
				 
					  <div class="btn">
						<span>Image</span>
						<input type="file" name="post_image">
					  </div>
					  <div class="file-path-wrapper">
						<input class="file-path validate" name="">
					  </div>
					</div>
					
					 <div class="input-field">
					 
						  <textarea name="editor1" class="browser-default" id="editor1"></textarea>
						  
						</div>
						
				  <div class="input-field">
				      <i class="material-icons prefix">search</i>
					  <input id="keywords" name="keywords" type="text" required class="validate">
					  <label for="keywords">Meta Keywords</label>
				   </div>
				   
				   <div class="input-field">
				      <i class="material-icons prefix">reorder</i>
					  <input id="description" name="description" type="text" required class="validate">
					  <label for="description">Meta Description</label>
				   </div>
						
					 
					
					<div class="input-field">
					
					<p><b>Featured : </b></p>
					<span>
					  <input name="featured" type="radio" id="yes" value="1" />
					  <label for="yes">YES</label>
					</span>
					<span>
					  <input name="featured" type="radio" id="no" value="0" checked />
					  <label for="no">NO</label>
					</span>
					</div>
					 
						
						<center>
						
						<button class="btn waves-effect waves-light" type="submit" name="insert_post" style="margin-top:50px;">Submit
						<i class="material-icons right">send</i>
					  </button>
					  </center>
				</div>
		   </form>
   </div>
</div>
</main>

 
 <!--JavaScript--->
<script rel="javascript" src="../js/jquery.min.js"></script>
<script rel="javascript" src="../js/materialize.min.js"></script>
<script rel="javascript" src="js/custom.js"></script>
 <script src="plugin/ckeditor/ckeditor.js"></script>
 <script src="plugins/ckeditor/plugins/codesnippet/lib/highlight/highlight.pack.js"></script>
<script>hljs.initHighlightingOnLoad();</script>
 <script type="text/javascript">
  CKEDITOR.replace( 'editor1' );
  	 
	$(document).ready(function(){
     $('.category').change(function(){
		
		 var cat_id = $(this).val();
		
		 $.ajax({
			 url:"function/function.php",
			 method: "post",
			 data:{cat_id:cat_id},
			 success: function(data){
				$('#sub').html(data);
			 }
		 })
	 });
	 
	
	 }); 
	  
  
  
  </script>

 </body>
 </html>