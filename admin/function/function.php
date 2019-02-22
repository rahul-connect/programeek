<?php
include_once('../database/db.php');


// Insert Category
if(isset($_POST['insert_cat'])){
	$cat_name = mysqli_real_escape_string($con,$_POST['cat_name']);
	$icon_name = mysqli_real_escape_string($con,$_POST['icon']);
	$sub = 0;
	
	if($cat_name != ''){
		$insert_cat = "INSERT INTO category(name,icon,sub) VALUES('$cat_name','$icon_name','$sub')";
	$run_insert_cat = mysqli_query($con,$insert_cat);
	
	if($run_insert_cat){
		header('Location:../insert_cat.php?success');
	}else{
		header('Location:../insert_cat.php?failure');
	}
	
	}else{
		header('Location:../insert_cat.php?failure=empty_field');
	}
	
	
	
}

// Insert Post

if(isset($_POST['insert_post'])){
	$title = $_POST['title'];
	$category = $_POST['category'];
	$sub = $_POST['sub'];
	$image = $_FILES['post_image']['name'];
	$image_tmp = $_FILES['post_image']['tmp_name'];
	$content = mysqli_real_escape_string($con,$_POST['editor1']);
	$keywords = $_POST['keywords'];
	$description = $_POST['description'];
	$featured = $_POST['featured'];
	

	
	// URL SLUG FOR SEO
    $str = strtolower(trim($title));
	$str = preg_replace('/[^a-z0-9-]/', '-', $str);
	$slug = preg_replace('/-+/', "-", $str);

	
	$move_image = move_uploaded_file($image_tmp,'../../images/'.$image);
	
	if($move_image){
		$insert_post = "INSERT INTO blog(title,category,sub,image,content,featured,description,keywords,slug) VALUES('$title','$category','$sub','$image','$content','$featured','$description','$keywords','$slug')";
		$run_insert_post = mysqli_query($con,$insert_post);
		if($run_insert_post){
			header('Location:../insert_post.php?success');
		}
	}
	
	
	
}


// Insert Sub Category
if(isset($_POST['insert_sub'])){
	$sub_name = $_POST['sub_name'];
	$category = $_POST['category'];
	
	if($sub_name != '' AND $category!=''){
		$insert_sub = "INSERT INTO category(name,sub) VALUES('$sub_name','$category')";
	$run_insert_sub = mysqli_query($con,$insert_sub);
	
	if($run_insert_sub){
		header('Location:../insert_sub.php?success');
	}else{
		header('Location:../insert_sub.php?failure');
	}
	
	}else{
		header('Location:../insert_sub.php?failure=empty_field');
	}
	
	
}

// AJax Sub category Fetch
  if(isset($_POST['cat_id'])){
	  $output = '';
	  $cat_id = $_POST['cat_id'];
	  
	  $fetch = mysqli_query($con,"select * from category WHERE sub='$cat_id'");
	  $count = mysqli_num_rows($fetch);
	  if($count > 0){
		  while($row=mysqli_fetch_array($fetch)){
			  $sub_id = $row['id'];
			  $sub_name = strtoupper($row['name']);
			  $output = "<option value='$sub_id'>$sub_name</option>";
			  echo $output;
		  }
		  
	  }else{
		  $output = "<option value='0' selected>No Sub Category Available</option>";
		  echo $output;
	  }
	  
	  
	  
  }

  // Delete Post
  
  if(isset($_GET['del_post'])){
	  $del_post = $_GET['del_post'];
	  $fetch_image = mysqli_query($con,"select image from blog where id='$del_post'");
	  $row = mysqli_fetch_array($fetch_image);
	  $image = $row['image'];
	  if(unlink('../../images/'.$image)){
	  $delete = mysqli_query($con,"DELETE FROM blog WHERE id='$del_post'");
	  
	  if($delete){
		echo "<script>window.location='../view_posts.php?success'</script>";  
  }
	  else{
	  echo "<script>window.location='../view_posts.php?failure'</script>";  
  }
  }else{
	  echo "<script>window.location='../view_posts.php?error_unlink'</script>";  
  }
  }
  
  
 // Reply Doubt 

 if(isset($_POST['doubt_repy'])){
	 $reply = mysqli_real_escape_string($con,$_POST['reply']);
	 $doubt_id = $_POST['update_doubt__id'];
	 $email = $_POST['email'];
	 $name = $_POST['name'];
	
	  require '../plugin/PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = '';                 // SMTP username
$mail->Password = '';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('', 'Programeek Tech');
$mail->addAddress($email, $name);     // Add a recipient
$mail->addReplyTo($email, $name);

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Programeek Reply to your Doubt';
$mail->Body    = $reply;


if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
	$query = mysqli_query($con,"UPDATE doubt SET reply='$reply',reply_date=NOW(),status=1 WHERE id='$doubt_id'");
	if($query){
		 echo "<script>window.location='../view_solved.php?replied_success';</script>";
	}
   
}
	   
 }
 
 
 // Reply Request
 
 if(isset($_POST['request_repy'])){
    $request_id = $_POST['update_request__id'];	 
	$rply = $_POST['reply_request'];
	$email = $_POST['email'];
	$name = $_POST['name'];
	
	  require '../plugin/PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = '';                 // SMTP username
$mail->Password = '';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('', 'Programeek Tech');
$mail->addAddress($email, $name);     // Add a recipient
$mail->addReplyTo($email, $name);

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Programeek Reply to your Request';
$mail->Body    = $rply;


if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
	$query = mysqli_query($con,"UPDATE request SET reply='$rply',reply_date=NOW(),status=1 WHERE id='$request_id'");
	if($query){
		 echo "<script>window.location='../request_old.php?replied_success';</script>";
	}
   
}
	
 }
 
 
 // Function to Update Website Setting
 if(isset($_POST['website_update'])){
	 $slogan = $_POST['slogan'];
	 $title = $_POST['title'];
	 $description = $_POST['meta_description'];
	 $keywords = $_POST['keywords'];
	 $copyright = $_POST['copyright'];
	 
	 $update_website = mysqli_query($con,"UPDATE account SET slogan='$slogan',page_title='$title',copyright='$copyright',description='$description',keywords='$keywords',date_modified=NOW() WHERE id=1");
	 if($update_website){
		 echo "<script>window.location='../account.php?success';</script>";
	 }else{
		 echo "ERROR :".mysqli_errno();;
	 }
	 
	 
 }
 
 // Function to update Website Logo
 
 if(isset($_POST['logo_update'])){
	 $logo = $_FILES['logo']['name'];
	 $tmp_logo = $_FILES['logo']['tmp_name'];
	 
	 $ext = pathinfo($logo,PATHINFO_EXTENSION);

	 
	 $fetch_image = mysqli_query($con,"select logo from account WHERE id='1'");
	 $image_name = mysqli_fetch_array($fetch_image);
	 $img = $image_name['logo'];
	 
	 if(unlink('../../images/'.$img)){
		 $update = mysqli_query($con,"UPDATE account set logo ='$logo' WHERE id='1'");
		 if($update){
			  move_uploaded_file($tmp_logo,"../../images/".$logo);
			  echo "<script>window.location='../account.php?logo_updated'</script>";
		 }
		 
	 }
	 
 }
 
 // Function to update Admin Name and Email
 
 if(isset($_POST['update_admin'])){
	 $admin_name = $_POST['admin_name'];
	 $admin_email = $_POST['admin_email'];
	 
	 $update = mysqli_query($con,"update admin set name='$admin_name',email='$admin_email',date_modified=NOW() WHERE id='1'");
	 if($update){
		 echo "<script>window.location='../account.php?success'</script>";
	 }
	 
 }
 
 // Function to update Admin Password
 if(isset($_POST['update_admin_pass'])){
	 $old_pass = md5($_POST['old_pass']);
	 $new_pass = md5($_POST['new_pass']);
	 
	 $check_pass = mysqli_query($con,"select * from admin where password='$old_pass' LIMIT 1");
	 if(mysqli_num_rows($check_pass) > 0){
		 $update_pass = mysqli_query($con,"update admin set password='$new_pass' WHERE id='1' LIMIT 1");
		 if($update_pass){
			 echo "<script>window.location='../account.php?password_success'</script>";
		 }
	 }else{
		 echo "<script>window.location='../account.php?password_incorrect'</script>";
	 }
	 
	 
 }
 
 // Function to Update Post
 
 if(isset($_POST['update_post'])){
    $post_id = $_POST['edit_id'];
	 
	$title = $_POST['title'];
	$category = $_POST['category'];
	$sub = $_POST['sub'];
	$image = $_FILES['post_image']['name'];
	$content = mysqli_real_escape_string($con,$_POST['editor1']);
	$keywords = $_POST['keywords'];
	$description = $_POST['description'];
	$featured = $_POST['featured'];
		
	// URL SLUG FOR SEO
    $str = strtolower(trim($title));
	$str = preg_replace('/[^a-z0-9-]/', '-', $str);
	$slug = preg_replace('/-+/', "-", $str);
	

	
	 if($image != ''){	 
	$image_tmp = $_FILES['post_image']['tmp_name'];
	$query_image = mysqli_query($con,"select image from blog WHERE id='$post_id'");
	$fetch_old = mysqli_fetch_array($query_image);
	$img = $fetch_old['image'];
	
	if(unlink('../../images/'.$img)){
		$move_image = move_uploaded_file($image_tmp,'../../images/'.$image);
		if($move_image){
			$update = "UPDATE blog set title='$title',category='$category',sub='$sub',image='$image',content='$content',featured='$featured',description='$description',keywords='$keywords',slug='$slug',date_modified=NOW() WHERE id='$post_id'";
			$run_update = mysqli_query($con,$update);
			if($run_update){
				echo "<script>window.location='../view_posts.php?edit_success'</script>";
			}else{
				echo "ERROR";
			}
		}
		
		
	}

	 }else{
		 
		   $update = "UPDATE blog set title='$title',category='$category',sub='$sub',content='$content',featured='$featured',description='$description',keywords='$keywords',slug='$slug',date_modified=NOW() WHERE id='$post_id'";
			$run_update = mysqli_query($con,$update);
			if($run_update){
				echo "<script>window.location='../view_posts.php?edit_success'</script>";
			}else{
				echo "Error";
			}
		 
	 }
	 
 }
 
 
 
?>