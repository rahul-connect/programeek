<?php
include "../admin/database/db.php";

// functionn to subscribe email

if(isset($_GET['subscribe']) && $_GET['subscribe'] != ''){
	 $subscibe_email = mysqli_real_escape_string($con,$_GET['subscribe']);
	 $ip = mysqli_real_escape_string($con,$_GET['ip']);
	 
	 
  if (!filter_var($subscibe_email, FILTER_VALIDATE_EMAIL)) {
    echo 'invalid'; 
}else{
	 
	 $check = mysqli_query($con,"select * from subscribe WHERE email='$subscibe_email'");
	 $count = mysqli_num_rows($check);
	 if($count > 0){
		 echo 1;
	 }else{
		 $insert = mysqli_query($con,"INSERT INTO subscribe(email,ip_address) VALUES('$subscibe_email','$ip')");
		 echo 0;
	 }
	 
}
}

// Function for Doubt

if(isset($_POST['doubt'])){
	$user_name = mysqli_real_escape_string($con,$_POST['user_name']);
	$user_email = mysqli_real_escape_string($con,$_POST['user_email']);
	$doubt = mysqli_real_escape_string($con,$_POST['doubt']);
	$ip_address = $_POST['ip_address'];
	$post_id = $_POST['post_id'];
	

	if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
    echo 'invalid'; 
}else{
	
	$insert_doubt = mysqli_query($con,"INSERT INTO doubt(post_id,name,email,doubt,ip_address) VALUES('$post_id','$user_name','$user_email','$doubt','$ip_address')");
	
	if($insert_doubt){
		echo 0;
	}
	
}
	
}



// Function for request a tutorial
if(isset($_POST['request'])){
	$user_name = mysqli_real_escape_string($con,$_POST['r_name']);
	$user_email = mysqli_real_escape_string($con,$_POST['r_email']);
	$request = mysqli_real_escape_string($con,$_POST['request']);
	$ip_address = $_POST['r_ip'];
	

	if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
    echo 'invalid'; 
}else{
	
	$insert_request = mysqli_query($con,"INSERT INTO request(name,email,description,ip_address) VALUES('$user_name','$user_email','$request','$ip_address')");
	
	if($insert_request){
		echo 0;
	}else{
		echo 1;
	}
	
}
	
}

// Function to increase post views

if(isset($_POST['view_id'])){
	$post_id = $_POST['view_id'];
	$fetch = mysqli_query($con,"select views from blog where id='$post_id' LIMIT 1");
	$run_fetch = mysqli_fetch_array($fetch);
	$old_views = $run_fetch['views'];
	$new_views = $old_views + 1;
	
	$update_view = mysqli_query($con,"update blog SET views='$new_views' WHERE id='$post_id'");
	
}


?>