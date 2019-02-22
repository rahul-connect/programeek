<?php include "inc/header.php"; ?>
<?php
$per_page =5;

if(isset($_GET['page'])){
	$page = $_GET['page'];
}else{
	$page=1;
}

$start = ($page-1)*$per_page;
$pagination_query = mysqli_query($con,"SELECT id FROM request WHERE status='0'");
$total = mysqli_num_rows($pagination_query);
$total_pages = ceil($total/$per_page);

?>
<main class="container">
<h3 class="center teal-text darken-4">View NEW Requests</h3><div class="divider"></div>
<table class="highlight centered">
        <thead>
          <tr>
              <th>S.No</th>
              <th>NAME</th>
              <th>EMAIL</th>
              <th>Description</th>
              <th>Date</th>
              <th class='hide-on-small-only'>View</th>
          </tr>
        </thead>
        <tbody>
		<?php 
		$fetch_request = mysqli_query($con,"SELECT * FROM request WHERE status='0' ORDER BY id DESC LIMIT $start,$per_page");
		if(mysqli_num_rows($fetch_request) >0){
		$i = ($page*5)-5;
		while($row = mysqli_fetch_array($fetch_request)){
		$id = $row['id'];
		$name = ucfirst($row['name']);
		$email = $row['email'];
		$description = substr($row['description'],0,60);
		$date = $row['date'];
		$timestamp = strtotime($date);
        $date =  date("j M Y", $timestamp);
	    $i++;
		
		
		echo "
           <td>$i</td>
            <td><a href='view_request.php?request_id=$id' class='black-text'>$name</a></td>
            <td><a href='view_request.php?request_id=$id' class='black-text'>$email</a></td>
            <td>$description</td>
            <td>$date</td>
            <td class='hide-on-small-only'><a href='view_request.php?request_id=$id' class='teal-text'><i class='material-icons'>visibility</i></a></td>
          </tr>
		
		";
		}
		}else{
			echo "<td colspan='6'><h3 class='center-align'>No New Request Availbale </h3></td>";
		}
	  ?>
         
         
        </tbody>
      </table>
	    <!-- Pagination --->
	 <div id="pagination" class="center">
	  <ul class="pagination"> 
	 <?php
	 if(mysqli_num_rows($fetch_request) >0){
         if($page < 2){
			 echo "<li class='disabled'><a href='javascript:void(0)'><i class='material-icons'>chevron_left</i></a></li>";
		 }else{
			 $back = $page-1;
			 echo "<li class='waves-effect'><a href='request_new.php?page=$back'><i class='material-icons'>chevron_left</i></a></li>";
		 }
		 
		 for($i = 1;$i<=$total_pages;$i++){
			 if($i == $page){
				 echo "<li class='active'><a href='javascript:void(0)'>$i</a></li>";
			 }else{
			 echo "<li class='waves-effect'><a href='request_new.php?page=$i'>$i</a></li>";
			 }
		 }
		 
		 
		   if($page == $total_pages){
			 echo "<li class='disabled'><a href='javascript:void(0)'><i class='material-icons'>chevron_right</i></a></li>";
		 }else{
			 $next = $page+1;
			 echo "<li class='waves-effect'><a href='request_new.php?page=$next'><i class='material-icons'>chevron_right</i></a></li>";
		 }
	 }
    ?>
	</ul>
	</div>
</main>


<?php include "inc/footer.php"; ?>