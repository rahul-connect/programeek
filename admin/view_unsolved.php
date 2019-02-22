<?php include "inc/header.php"; ?>
<?php
$per_page =5;

if(isset($_GET['page'])){
	$page = $_GET['page'];
}else{
	$page=1;
}

$start = ($page-1)*$per_page;
$pagination_query = mysqli_query($con,"SELECT id FROM doubt WHERE status='0'");
$total = mysqli_num_rows($pagination_query);
$total_pages = ceil($total/$per_page);

?>
<main class="container">
<h3 class="center teal-text darken-4">View Unsolved Doubts</h3><div class="divider"></div>
<table class="highlight centered">
        <thead>
          <tr>
              <th>S.No</th>
              <th>NAME</th>
              <th class='hide-on-small-only'>EMAIL</th>
              <th class=''>POST</th>
              <th>Date</th>
              <th>View</th>
          </tr>
        </thead>
        <tbody>
		<?php 
		$fetch_doubt = mysqli_query($con,"SELECT * FROM doubt WHERE status='0' ORDER BY id DESC LIMIT $start,$per_page");
		if(mysqli_num_rows($fetch_doubt) >0){
		$i = ($page*5)-5;
		while($row = mysqli_fetch_array($fetch_doubt)){
		$id = $row['id'];
		$post_id = $row['post_id'];
		$fetch_post = mysqli_query($con,"SELECT title from blog WHERE id='$post_id' LIMIT 1");
		$post_name = mysqli_fetch_array($fetch_post);
		$post = $post_name['title'];
		
		$name = ucfirst($row['name']);
		$email = $row['email'];
		$date = $row['date'];
		$timestamp = strtotime($date);
        $date =  date("j M Y", $timestamp);
	    $i++;
		
		
		echo "
           <td>$i</td>
            <td><a href='unsolved_doubt.php?doubt_id=$id' class='black-text'>$name</a></td>
            <td class='hide-on-small-only'><a href='unsolved_doubt.php?doubt_id=$id' class='black-text'>$email</a></td>
            <td class=''>$post</td>
            <td class=''>$date</td>
            <td><a href='unsolved_doubt.php?doubt_id=$id' class='teal-text'><i class='material-icons'>visibility</i></a></td>
          </tr>
		
		";
		}
		}else{
			echo "<td colspan='6'><h3 class='center-align'>No Doubt Availbale </h3></td>";
		}
	  ?>
         
         
        </tbody>
      </table>
	  	  <!-- Pagination --->
	 <div id="pagination" class="center">
	  <ul class="pagination"> 
	 <?php
	 if(mysqli_num_rows($fetch_doubt) >0){
         if($page < 2){
			 echo "<li class='disabled'><a href='javascript:void(0)'><i class='material-icons'>chevron_left</i></a></li>";
		 }else{
			 $back = $page-1;
			 echo "<li class='waves-effect'><a href='view_unsolved.php?page=$back'><i class='material-icons'>chevron_left</i></a></li>";
		 }
		 
		 for($i = 1;$i<=$total_pages;$i++){
			 if($i == $page){
				 echo "<li class='active'><a href='javascript:void(0)'>$i</a></li>";
			 }else{
			 echo "<li class='waves-effect'><a href='view_unsolved.php?page=$i'>$i</a></li>";
			 }
		 }
		 
		 
		   if($page == $total_pages){
			 echo "<li class='disabled'><a href='javascript:void(0)'><i class='material-icons'>chevron_right</i></a></li>";
		 }else{
			 $next = $page+1;
			 echo "<li class='waves-effect'><a href='view_unsolved.php?page=$next'><i class='material-icons'>chevron_right</i></a></li>";
		 }
	 }
	 
    ?>
	</ul>
	</div>
	  
</main>


<?php include "inc/footer.php"; ?>