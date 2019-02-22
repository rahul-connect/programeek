<?php include "inc/header.php"; ?>
<?php
$count_posts = mysqli_query($con,"SELECT * FROM blog where status='1'");
$num_posts = mysqli_num_rows($count_posts);
$count_doubt = mysqli_query($con,"SELECT * FROM doubt where status='1'");
$num_doubt = mysqli_num_rows($count_doubt);
$count_request = mysqli_query($con,"SELECT * FROM request");
$num_request = mysqli_num_rows($count_request);
$count_subscriber = mysqli_query($con,"SELECT * FROM subscribe");
$num_subscriber = mysqli_num_rows($count_subscriber);

?>
<main class="container">

<div class="row">
     <h4 class='center-align'>Welcome Rahul</h4><hr>
      <div class="col s6 m6 l3">
        <div class="card-panel green" style="padding:0px;">
		<div class="row">
           <center><i class="material-icons white-text" style="margin-right:5px;">mode_edit</i><span class='white-text' style='font-size:30px;'><?php echo $num_posts; ?></span></center>
		
			<h5 class='center-align white-text'>Posts</h5>
			  
			</div>
        </div>
      </div>
	  
	  <div class="col s6 m6 l3">
        <div class="card-panel teal" style="padding:0px;">
		<div class="row">
           <center><i class="material-icons white-text" style="margin-right:5px;">comment</i><span class='white-text' style='font-size:30px;'><?php echo $num_doubt; ?></span></center>
		
			<h5 class='center-align white-text'>Doubts <span class="hide-on-small-only">Solved</span></h5>
			  
			</div>
        </div>
      </div>
	  
	   <div class="col s6 m6 l3">
        <div class="card-panel lime darken-2" style="padding:0px;">
		<div class="row">
           <center><i class="material-icons white-text" style="margin-right:5px;">assignment</i><span class='white-text' style='font-size:30px;'><?php echo $num_request; ?></span></center>
		
			<h5 class='center-align white-text'>Requests</h5>
			  
			</div>
        </div>
      </div>
	  
	  <div class="col s6 m6 l3">
        <div class="card-panel purple lighten-1" style="padding:0px;">
		<div class="row">
           <center><i class="material-icons white-text" style="margin-right:5px;">email</i><span class='white-text' style='font-size:30px;'><?php echo $num_subscriber; ?></span></center>
		
			<h5 class='center-align white-text'>Subscribers</h5>
			  
			</div>
        </div>
      </div>
	  
	  
    </div>



</main>

 
 
 <?php include "inc/footer.php"; ?>