<?php include "inc/header.php"; ?>

<?php
if(isset($_GET['del_id'])){
	  $del_id = $_GET['del_id'];
	  if($del_id !=''){
		  $del_post = mysqli_query($con,"DELETE FROM blog WHERE sub='$del_id'");
		  if($del_post){
			  $del_sub = mysqli_query($con,"DELETE FROM category WHERE id ='$del_id'");
			  if($del_sub){
						echo "<script>window.location='view_sub.php?del_sub=success';</script>";
			  }
		  }
	  }else{
		  echo "<script>alert('Something Went Wrong !!');</script>";
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
$pagination_query = mysqli_query($con,"SELECT id FROM category WHERE sub !='0'");
$total = mysqli_num_rows($pagination_query);
$total_pages = ceil($total/$per_page);

?>

<main class="container">
<h4 class="center teal-text darken-4">View Sub Categories</h4><div class="divider"></div>
<table class="highlight centered">
        <thead>
          <tr>
              <th>S.No</th>
              <th>Name</th>
              <th class='hide-on-small-only'>Date</th>
              <th>Category</th>
              <th>Edit</th>
              <th>Delete</th>
          </tr>
        </thead>
        <tbody>
		<?php 
		$fetch_sub = mysqli_query($con,"SELECT * FROM category WHERE sub != '0' ORDER BY id DESC LIMIT $start,$per_page");
		$i = ($page*5)-5;
		while($row = mysqli_fetch_array($fetch_sub)){
		$id = $row['id'];
		$name = ucwords($row['name']);
		$date = $row['date_created'];
		$sub = $row['sub'];
		
		$fetch_cat = mysqli_query($con,"select name from category WHERE id='$sub'");
		$run_cat = mysqli_fetch_array($fetch_cat);
		$category_name = $run_cat['name'];
		
		$timestamp = strtotime($date);
        $date =  date("j M Y", $timestamp);
	    $i++;
		
		
		echo "
	 
		 
            <td>$i</td>
            <td>$name</td>
            <td class='hide-on-small-only'>$date</td>
            <td>$category_name</td>
            <td><a href='edit_sub.php?edit=$id' class=''><i class='material-icons'>mode_edit</i></a></td>
			<td><a onclick='return confirm(\"Are you sure you want to delete the Subcategory?\");' href='view_sub.php?del_id=$id' class='red-text text-lighten-1'><i class='material-icons'>delete</i></a></td>
          </tr>
		
		";
		}
	  ?>
         
         
        </tbody>
      </table>
	  	  <!-- Pagination --->
	 <div id="pagination" class="center">
	  <ul class="pagination"> 
	 <?php
         if($page < 2){
			 echo "<li class='disabled'><a href='javascript:void(0)'><i class='material-icons'>chevron_left</i></a></li>";
		 }else{
			 $back = $page-1;
			 echo "<li class='waves-effect'><a href='view_sub.php?page=$back'><i class='material-icons'>chevron_left</i></a></li>";
		 }
		 
		 for($i = 1;$i<=$total_pages;$i++){
			 if($i == $page){
				 echo "<li class='active'><a href='javascript:void(0)'>$i</a></li>";
			 }else{
			 echo "<li class='waves-effect'><a href='view_sub.php?page=$i'>$i</a></li>";
			 }
		 }
		 
		 
		   if($page == $total_pages){
			 echo "<li class='disabled'><a href='javascript:void(0)'><i class='material-icons'>chevron_right</i></a></li>";
		 }else{
			 $next = $page+1;
			 echo "<li class='waves-effect'><a href='view_sub.php?page=$next'><i class='material-icons'>chevron_right</i></a></li>";
		 }
	 
    ?>
	</ul>
	</div>
	  
</main>
<?php
if(isset($_GET['del_sub'])){
	echo "
	<script>
	alert('You have Successfully Deleted the Subcategory !');
	</script>
	";
}
?>

<?php include "inc/footer.php"; ?>