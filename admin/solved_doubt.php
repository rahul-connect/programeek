<?php
include "inc/header.php";
?>

<?php
if(isset($_GET['solved_id']) && $_GET['solved_id'] !=''){
	$doubt_id = $_GET['solved_id'];
	$fetch_all = mysqli_query($con,"SELECT * FROM doubt WHERE id='$doubt_id' && status='1' LIMIT 1");
	$row = mysqli_fetch_array($fetch_all);
	$post_id = $row['post_id'];
	$name = $row['name'];
	$email = $row['email'];
	$doubt = $row['doubt'];
	$date = $row['date'];
	$ip = $row['ip_address'];
	$status = $row['status'];
	$reply = $row['reply'];
	$reply_date = $row['reply_date'];
	
	$reply_timestamp = strtotime($reply_date);
    $reply_date =  date("j M Y", $reply_timestamp);
	
	$timestamp = strtotime($date);
    $date =  date("j M Y", $timestamp);
	
	$fetch_post = mysqli_query($con,"SELECT title from blog WHERE id='$post_id' LIMIT 1");
	$post = mysqli_fetch_array($fetch_post);
	$post_name = $post['title'];
	
	
}else{
	echo "<script>window.location='index.php';</script>";
	exit();
}

?>

<main class="container">
<h4 class="center teal-text darken-4">DOUBT ID : <?php echo $doubt_id; ?></h4><div class="divider"></div>
<div class="card">
   <div class="card-content">
 
	       <form action="view_solved.php" method="">
		        <div class="row">
				<div class="col l5 s12">
				   <div class="input-field">
				      <i class="material-icons prefix">perm_identity</i>
					  <input id="name" name="name" type="text"  readonly value="<?php echo $name; ?>">
					  <label for="name">Name</label>
				   </div>
				   </div>
				   <div class="col l6 s12">
				   <div class="input-field">
				      <i class="material-icons prefix">email</i>
					  <input id="email" name="email" type="email"  readonly value="<?php echo $email; ?>">
					  <label for="email">Email</label>
				   </div>
				   </div>
				   
				    </div>
					<div class="row">
					  <div class="col l12 s12">
				   <div class="input-field">
				      <i class="material-icons prefix">trending_flat</i>
					  <input id="post" name="post" type="text"   value="<?php echo $post_name; ?>">
					  <label for="post">Post</label>
				   </div>
				   </div>
					</div>
					
					<div class="row">
					  <div class="row">
						<div class="input-field col s12">
						<i class="material-icons prefix">message</i>
						  <textarea id="doubt" readonly class="materialize-textarea"><?php echo $doubt; ?></textarea>
						  <label for="doubt">DOUBT</label>
						</div>
					  </div>
					
				  </div>
				  
				  <div class="row">
					  <div class="col l6 s12">
				   <div class="input-field">
				      <i class="material-icons prefix">today</i>
					  <input id="date" name="date" type="text"   readonly value="<?php echo $date; ?>">
					  <label for="date">Date</label>
				   </div>
				   </div>
				   
				   <div class="col l6 s12">
				   <div class="input-field">
				      <i class="material-icons prefix">location_on</i>
					  <input id="ip" name="ip" type="text"   readonly value="<?php echo $ip; ?>">
					  <label for="ip">Ip Address</label>
				   </div>
				   </div>
					</div>
					<br>
			 <div class="row">
			    <h4 class="center-align teal-text">Your Reply</h4>
				<div class="col l4 s0"></div>
				<div class="col l4 s12"><hr></div>
				<div class="col l4 s0"></div>
			 </div>
			 
			 
              <div class="row">
					  <div class="row">
						<div class="input-field col s12">
						<i class="material-icons prefix">mode_edit</i>
						  <textarea id="reply" class="materialize-textarea" required name="reply"><?php echo $reply; ?></textarea>
						  <label for="reply">REPLY</label>
						</div>
					  </div>
					
				  </div>
				  
				   <div class="row">
					  <div class="row">
						<div class="input-field col s12">
						<i class="material-icons prefix">query_builder</i>
						  <input id="reply_date" name="reply_date" type="text"   readonly value="<?php echo $reply_date; ?>">
						  <label for="reply_date">REPLY DATE</label>
						</div>
					  </div>
					
				  </div>
				  
				  <div class="center-align">
				  <a href="view_solved.php"><button class="btn waves-effect waves-light orange darken-1" type="button" name="doubt_repy">Cancel
						<i class="material-icons right">fast_rewind</i>
					  </button></a>
                  </div>
					
			</form>
    </div>			
    </div>			
</main>





<?php include "inc/footer.php"; ?>