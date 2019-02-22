<?php include "inc/header.php"; ?>
<?php
	  $fetch_website = mysqli_query($con,"select * from account where id='1' LIMIT 1");
	  $account = mysqli_fetch_array($fetch_website);
	  $logo = $account['logo'];
	  $slogan = $account['slogan'];
	  $title = $account['page_title'];
	  $copyright = $account['copyright'];
	  $description = $account['description'];
	  $keywords = $account['keywords'];
	  $construction = $account['construction'];
	  $website_modified = $account['date_modified'];
	  $web_timestamp = strtotime($website_modified);
      $website_modified =  date("j M Y", $web_timestamp);
	  
	  if($construction > 0){
		  $checked = "checked='checked'";
	  }else{
		  $checked = '';
	  }
	  
	  ?>
<div class="container">
<main>
<h3 class="center teal-text darken-4">Account Settings</h3><div class="divider"></div><br>
<div class="row">
<div class="col s12 m5 l4">

<div class="card">

<div class="card-image" style="padding:5px;">
<img src="../images/<?php echo $logo; ?>" style="width:100%;height:250px !important;">
</div>
   <div class="card-action">
     <form action="function/function.php" method="post" enctype="multipart/form-data">
    <div class="file-field input-field">
      <div class="btn">
        <span>File</span>
        <input type="file" name="logo" required>
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" value="<?php echo $logo; ?>" type="text">
      </div>
    </div>
	<center><button class="btn waves-effect waves-light" type="submit" name="logo_update">Submit
    <i class="material-icons right">send</i>
  </button></center><br>
        
  </form>
     </div>
   </div>
   
   <div class="card">
     <div class="card-content">
	   <h5 class="center-align"><b>Under Construction</b></h5><hr>
      <br>
      <center>	  
	  <input type="checkbox" id="checkbox" disabled="disabled" <?php echo $checked; ?> />
      <label for="checkbox">Construction Mode</label>
	  </center>
      <br>
  
     </div>
   </div>
</div>

<div class="col s12 m7 l8">
<div class="card">
   <div class="card-content">
    
	 <h4 class="center-align">WEBSITE SETTING</h4>
	  
        <form action="function/function.php" method="post">
		     <div class="row">
			     <div class="input-field col s12">
				  <i class="material-icons prefix">trending_flat</i>
				  <input id="slogan" name="slogan" type="text" value="<?php echo $slogan; ?>">
				  <label for="slogan">Slogan</label>
				</div>
				 <div class="input-field col s12">
				  <i class="material-icons prefix">label</i>
				  <input id="title" type="text" name="title" value="<?php echo $title; ?>">
				  <label for="title">Page Title</label>
				</div>
				 <div class="input-field col s12">
				  <i class="material-icons prefix">view_headline</i>
				  <input id="description" type="text" name="meta_description" value="<?php echo $description; ?>">
				  <label for="description">Meta Description</label>
				</div>
				<div class="input-field col s12">
				  <i class="material-icons prefix">dialpad</i>
				  <input id="keywords" type="text" name="keywords" value="<?php echo $keywords; ?>">
				  <label for="keywords">Meta Keywords</label>
				</div>
				<div class="input-field col s12">
				  <i class="material-icons prefix">grade</i>
				  <input id="copyright" type="text" name="copyright" value="<?php echo $copyright; ?>">
				  <label for="copyright">Copyright</label>
				</div>
				<div class="input-field col s12">
				  <i class="material-icons prefix">today</i>
				  <input id="date" type="text" name="website_modified" value="<?php echo $website_modified; ?>">
				  <label for="date">Last Modified</label>
				</div>
				<center><button class="btn waves-effect waves-light" type="submit" name="website_update">Update
    <i class="material-icons right">done</i>
  </button></center><br>
			 </div>
		</form>
   </div>
</div>

</div>


</div>

<div class="row">
   <div class="card">
 
   <div class="card-content">
     <h4 class="center-align">ADMIN SETTING</h4>
      <?php
	  $fetch_admin = mysqli_query($con,"SELECT * FROM admin WHERE id='1' LIMIT 1");
	  $admin = mysqli_fetch_array($fetch_admin);
	  $name = $admin['name'];
	  $email = $admin['email'];
	  $password = $admin['password'];
	  $admin_date = $admin['date_modified'];
	  $timestamp = strtotime($admin_date);
      $admin_date =  date("j M Y", $timestamp);
	  
	  ?>
	        <form action="function/function.php" method="post">
		     <div class="row">
			 
			     <div class="input-field col s12 l6">
				  <i class="material-icons prefix">perm_identity</i>
				  <input id="admin_name" type="text" name="admin_name" value="<?php echo $name; ?>">
				  <label for="admin_name">Name</label>
				</div>
				 <div class="input-field col s12 l6">
				  <i class="material-icons prefix">email</i>
				  <input id="admin_email" name="admin_email" type="email" value="<?php echo $email; ?>">
				  <label for="admin_email">Email</label>
				</div>
				 <div class="input-field col s12 l6">
				  <i class="material-icons prefix">lock</i>
				  <input id="password" type="password" readonly value="<?php echo $password; ?>">
				  <label for="password">Password</label>
				</div>
				<div class="input-field col s12 l6">
				  <i class="material-icons prefix">today</i>
				  <input id="date_modified" readonly type="text" value="<?php echo $admin_date; ?>">
				  <label for="date_modified">Date Modified</label>
				</div>
				
				
				<center>
			    <button class="btn waves-effect waves-light red" type="submit" name="update_admin">Update
					<i class="material-icons right">send</i>
				  </button></center>
			 </div>
		</form>
		<br>
	  <div class="row">
      <h4 class="center-align">Change Password</h4>
	  
	       <form action="function/function.php" method="post">
	          <div class="input-field col s12 l6">
				  <i class="material-icons prefix">vpn_key</i>
				  <input id="old_password" name="old_pass" type="password" required>
				  <label for="old_password">Current Password</label>
				</div>
				
				<div class="input-field col s12 l6">
				  <i class="material-icons prefix">lock</i>
				  <input id="new_password" name="new_pass" type="password" required>
				  <label for="new_password">New Password</label>
				</div>
				<center>
			    <button class="btn waves-effect waves-light orange" type="submit" name="update_admin_pass">Update
					<i class="material-icons right">send</i>
				  </button></center>
				
			</form>
 </div>  
   </div>
   </div>
</div>





</main> 
</div>
 <?php include "inc/footer.php"; ?>
   
<!-- Modal Structure -->
<?php
if(isset($_GET['password_incorrect'])){
	echo "<script>alert('Current Password Incorrect !!');</script>";
}
?>


  