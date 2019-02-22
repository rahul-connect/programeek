
<?php include "inc/header.php"; ?>
<?php
if(isset($_GET['edit'])){
	$edit_id = $_GET['edit'];
	$select = mysqli_query($con,"SELECT * FROM blog WHERE id='$edit_id'");
	$fetch = mysqli_fetch_array($select);
	$title = $fetch['title'];
	$cat = $fetch['category'];
	$sub = $fetch['sub'];
	$image = $fetch['image'];
	$content = htmlspecialchars($fetch['content']);
	$featured = $fetch['featured'];
	$description = $fetch['description'];
	$keywords = $fetch['keywords'];
	
}else{
	echo "<script>window.location='view_posts.php'</script>";
	exit();
}
?>
<main class="container">
<h3 class="center teal-text darken-4">Edit Post</h3><div class="divider"></div>
<div class="card">
   <div class="card-content">
 
	       <form action="function/function.php" method="post" enctype="multipart/form-data">
		        <div class="row">
				   <div class="input-field">
				      <i class="material-icons prefix">star</i>
					  <input id="title" name="title" type="text" required class="validate" value="<?php echo $title; ?>">
					  <input name="edit_id" type="hidden" required  value="<?php echo $edit_id; ?>">
					  <label for="title">Title</label>
				   </div>
				   
				   <div class="input-field">
				   <!-- <i class="material-icons prefix">label</i>-->
					<select name="category" id="category" class='browser-default category'>
					  <!---<option value="" disabled selected>Choose a Category</option>--->
					  <?php 
					    $fetch_cat = mysqli_query($con,"SELECT id,name FROM category WHERE sub=0");
						while($row = mysqli_fetch_array($fetch_cat)){
							$id = $row['id'];
							$name = strtoupper($row['name']);
							if($id == $cat){
								$selected = 'selected';
							}else{
								$selected = '';
							}
							
							echo "<option value='$id' $selected>$name</option>";
						}
					  ?>
					  
					</select>
					</div>
					<div class="input-field">
					<select name="sub" id="sub" class='browser-default sub'>
					<?php
					$fetch_sub = mysqli_query($con,"select * from category WHERE sub='$cat'");
					$count = mysqli_num_rows($fetch_sub);
					  if($count > 0){
						  while($row=mysqli_fetch_array($fetch_sub)){
							  $sub_id = $row['id'];
							  $sub_name = strtoupper($row['name']);
							  if($sub_id == $sub){
								  $select = 'selected';
							  }else{
								  $select = '';
							  }
							  echo "<option value='$sub_id' $select>$sub_name</option>";
						
						  }
						  
					  }else{
						  echo "<option value='0' selected>No Sub Category Available</option>";
						  
					  }
					
					?>
					    <!--<option value="" disabled selected>Choose a Sub Category</option>--->
					
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
						<input class="file-path validate" value="<?php echo $image; ?>" name="">
					  </div>
					</div>
					
					 <div class="input-field">
					 
						  <textarea name="editor1" class="browser-default" id="editor1"><?php echo $content ;?></textarea>
						  
						</div>
						
				  <div class="input-field">
				      <i class="material-icons prefix">search</i>
					  <input id="keywords" name="keywords" type="text" required class="validate" value="<?php echo $keywords; ?>">
					  <label for="keywords">Meta Keywords</label>
				   </div>
				   
				   <div class="input-field">
				      <i class="material-icons prefix">reorder</i>
					  <input id="description" name="description" type="text" required value="<?php echo $description; ?>" class="validate">
					  <label for="description">Meta Description</label>
				   </div>
						
					 
					
					<div class="input-field">
					
					<p><b>Featured : </b></p>
					<span>
					<?php
					if($featured ==1){
						$yes = 'checked';
					}else{
						$yes = '';
					}
					?>
					  <input name="featured" type="radio" <?php echo $yes; ?> id="yes" value="1">
					  <label for="yes">YES</label>
					</span>
					<span>
					<?php
					if($featured ==0){
						$no = 'checked';
					}else{
						$no = '';
					}
					?>
					  <input name="featured" type="radio" <?php echo $no; ?> id="no" value="0">
					  <label for="no">NO</label>
					</span>
					</div>
					 
						
						<center>
						
						<button class="btn waves-effect waves-light" type="submit" name="update_post" style="margin-top:50px;">Update
						<i class="material-icons right">send</i>
					  </button>
						<a href="view_posts.php"class="btn orange" style="margin-top:50px;">Cancel
						<i class="material-icons right">fast_rewind</i>
					  </a>
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