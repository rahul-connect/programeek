<?php include "inc/header.php"; ?>
<?php
if(isset($_GET['del'])){
	$del_id = $_GET['del'];
	$delete  = mysqli_query($con,"DELETE FROM subscribe WHERE id='$del_id'");
	if($delete){
		echo "<script>window.location='subscriber.php?success'</script>";
		exit();
	}else{
		echo "<script>window.location='subscriber.php?failure'</script>";
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
$pagination_query = mysqli_query($con,"SELECT id FROM subscribe");
$total = mysqli_num_rows($pagination_query);
$total_pages = ceil($total/$per_page);

?>
<main class="container">
<h3 class="center teal-text darken-4">View Subscribers</h3><div class="divider"></div>
<table class="highlight centered">
        <thead>
          <tr>
              <th>S.No</th>
              <th>Email</th>
			  <th class=''>Date</th>
              <th class='hide-on-small-only'>Ip Address</th>
              <th>Remove</th>
          </tr>
        </thead>
        <tbody>
		<?php 
		$fetch_subscriber = mysqli_query($con,"SELECT * FROM subscribe ORDER BY id DESC LIMIT $start,$per_page");
		if(mysqli_num_rows($fetch_subscriber) > 0){
		$i = ($page*5)-5;
		while($row = mysqli_fetch_array($fetch_subscriber)){
		$id = $row['id'];
		$email = $row['email'];
		$ip = $row['ip_address'];
		$date = $row['date'];
		$timestamp = strtotime($date);
        $date =  date("j M Y", $timestamp);
	    $i++;
		
		
		echo "
		<tr>
           <td>$i</td>
            <td>$email</td>
			<td>$date</td>
            <td class='hide-on-small-only'>$ip</td>
            <td><a onclick='return confirm(\"Are you sure you want to delete the Subscriber?\");' href='subscriber.php?del=$id' class='red-text text-lighten-1'><i class='material-icons'>delete</i></a></td>
          </tr>
		
		";
		}
		}else{
			echo "<td colspan='5'><h4>No Subscribers Till Now</h4></td>";
		}
	  ?>
         
         
        </tbody>
      </table>
	    <!-- Pagination --->
	 <div id="pagination" class="center">
	  <ul class="pagination"> 
	 <?php
	    if(mysqli_num_rows($fetch_subscriber) > 0){
         if($page < 2){
			 echo "<li class='disabled'><a href='javascript:void(0)'><i class='material-icons'>chevron_left</i></a></li>";
		 }else{
			 $back = $page-1;
			 echo "<li class='waves-effect'><a href='subscriber.php?page=$back'><i class='material-icons'>chevron_left</i></a></li>";
		 }
		 
		 for($i = 1;$i<=$total_pages;$i++){
			 if($i == $page){
				 echo "<li class='active'><a href='javascript:void(0)'>$i</a></li>";
			 }else{
			 echo "<li class='waves-effect'><a href='subscriber.php?page=$i'>$i</a></li>";
			 }
		 }
		 
		 
		   if($page == $total_pages){
			 echo "<li class='disabled'><a href='javascript:void(0)'><i class='material-icons'>chevron_right</i></a></li>";
		 }else{
			 $next = $page+1;
			 echo "<li class='waves-effect'><a href='subscriber.php?page=$next'><i class='material-icons'>chevron_right</i></a></li>";
		 }
	 }
	 
    ?>
	</ul>
	</div>
</main>


<?php include "inc/footer.php"; ?>