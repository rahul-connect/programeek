<?php
include "inc/header.php";
?>

<?php
if(isset($_GET['request_id']) && $_GET['request_id'] !=''){
	$request_id = $_GET['request_id'];
	$fetch_all = mysqli_query($con,"SELECT * FROM request WHERE id='$request_id' && status='1' LIMIT 1");
	$row = mysqli_fetch_array($fetch_all);
	
	$name = ucfirst($row['name']);
	$email = $row['email'];
	$request = $row['description'];
	$date = $row['date'];
	$ip = $row['ip_address'];
	$status = $row['status'];
	$reply = $row['reply'];
	$reply_date = $row['reply_date'];
	
	$reply_timestamp = strtotime($reply_date);
    $reply_date =  date("j M Y", $reply_timestamp);
	
	$timestamp = strtotime($date);
    $date =  date("j M Y", $timestamp);
	
}else{
	echo "<script>window.location='index.php';</script>";
	exit();
}

?>

<main class="container">
<h4 class="center teal-text darken-4">REQUEST ID : <?php echo $request_id; ?></h4><div class="divider"></div>
<div class="card">
   <div class="card-content">
 
	       <form action="" method="">
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
					  <div class="row">
						<div class="input-field col s12">
						<i class="material-icons prefix">message</i>
						  <textarea id="doubt" readonly class="materialize-textarea"><?php echo $request; ?></textarea>
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
				  <a href="request_old.php"><button class="btn waves-effect waves-light orange darken-1" type="button" name="doubt_repy">Cancel
						<i class="material-icons right">fast_rewind</i>
					  </button></a>
                  </div>
					
			</form>
    </div>			
    </div>			
</main>





<?php include "inc/footer.php"; ?>