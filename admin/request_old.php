<?php include "inc/header.php"; ?>
<?php
if(isset($_GET['del_id']) && $_GET['del_id'] != ''){
	$del_id = $_GET['del_id'];
	$delete = mysqli_query($con,"DELETE FROM request WHERE id='$del_id'");
	if($delete){
		echo "<script>window.location='request_old.php?delete_success';</script>";
		exit();
	}
}
?>
<?php
$per_page =5;

if(isset($_GET['page'])){
	$page = $_GET['page'];
}else{
	$page=1;
}

$start = ($page-1)*$per_page;
$pagination_query = mysqli_query($con,"SELECT id FROM request WHERE status='1'");
$total = mysqli_num_rows($pagination_query);
$total_pages = ceil($total/$per_page);

?>

<main class="container">
<h3 class="center teal-text darken-4">View Replied Requests</h3><div class="divider"></div>
<table class="highlight centered">
        <thead>
          <tr>
              <th class='hide-on-small-only'>S.No</th>
              <th>Name</th>
              <th class='hide-on-small-only'>Email</th>
              <th>Date</th>
              <th>Reply</th>
              <th>Delete</th>
          </tr>
        </thead>
        <tbody>
		<?php 
		$fetch_old = mysqli_query($con,"SELECT * FROM request WHERE status='1' ORDER BY id DESC LIMIT $start,$per_page");
		
		$i = ($page*5)-5;
		if(mysqli_num_rows($fetch_old) >0){
			
		
		while($row = mysqli_fetch_array($fetch_old)){
		$id = $row['id'];
		$name = ucfirst($row['name']);
		$email = $row['email'];
		$reply = substr($row['reply'],0,100);
		$reply_date = $row['reply_date'];
		
		$timestamp = strtotime($reply_date);
        $reply_date =  date("j M Y", $timestamp);
	    $i++;
		
		
		echo "
	 
		 
           <td class='hide-on-small-only'>$i</td>
            <td><a href='replied_request.php?request_id=$id' class='black-text'>$name</a></td>
            <td class='hide-on-small-only'>$email</td>
            <td>$reply_date</td>
            <td>$reply</td>
            <td><a onclick='return confirm(\"Are you sure you want to delete the Request?\");' href='request_old.php?del_id=$id' class='teal-text'><i class='material-icons'>delete</i></a></td>
          </tr>
		
		";
		}
		
		}else{
			echo "<td colspan='6'><h3 class='center-align'>No Post Request Till Now  </h3></td>";
		}
	  ?>
         
         
        </tbody>
      </table>
	  	  <!-- Pagination --->
	 <div id="pagination" class="center">
	  <ul class="pagination"> 
	 <?php
	 if(mysqli_num_rows($fetch_old) >0){
         if($page < 2){
			 echo "<li class='disabled'><a href='javascript:void(0)'><i class='material-icons'>chevron_left</i></a></li>";
		 }else{
			 $back = $page-1;
			 echo "<li class='waves-effect'><a href='request_old.php?page=$back'><i class='material-icons'>chevron_left</i></a></li>";
		 }
		 
		 for($i = 1;$i<=$total_pages;$i++){
			 if($i == $page){
				 echo "<li class='active'><a href='javascript:void(0)'>$i</a></li>";
			 }else{
			 echo "<li class='waves-effect'><a href='request_old.php?page=$i'>$i</a></li>";
			 }
		 }
		 
		 
		   if($page == $total_pages){
			 echo "<li class='disabled'><a href='javascript:void(0)'><i class='material-icons'>chevron_right</i></a></li>";
		 }else{
			 $next = $page+1;
			 echo "<li class='waves-effect'><a href='request_old.php?page=$next'><i class='material-icons'>chevron_right</i></a></li>";
		 }
	 }
    ?>
	</ul>
	</div>
</main>



<?php include "inc/footer.php"; ?>
