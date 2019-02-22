<?php include "inc/header.php"; ?>
<?php
$per_page =6;

if(isset($_GET['page'])){
	$page = $_GET['page'];
}else{
	$page=1;
}

$start = ($page-1)*$per_page;
$pagination_query = mysqli_query($con,"SELECT id FROM blog WHERE status='1'");
$total = mysqli_num_rows($pagination_query);
$total_pages = ceil($total/$per_page);
?>

<main class="container">
<h3 class="center teal-text darken-4">View Posts</h3><div class="divider"></div>
<table class="centered" id="posts">
        <thead>
          <tr>
              <th>S.No</th>
              <th>Title</th>
              <th>Category</th>
              <th class='hide-on-small-only'>Sub</th>
              <th class='hide-on-small-only'>Featured</th>
              <th class='hide-on-small-only'>Date</th>
              <th>Edit</th>
              <th>Delete</th>
          </tr>
        </thead>
        <tbody>
		<?php 
		$fetch_post = mysqli_query($con,"SELECT id,title,category,sub,featured,date_created FROM blog WHERE status='1' ORDER BY id DESC LIMIT $start,$per_page");
		$i = ($page*6)-6;
		while($row = mysqli_fetch_array($fetch_post)){
		$id = $row['id'];
		$title = ucfirst($row['title']);
		$cat = $row['category'];
		$sub = $row['sub'];
		$featured = $row['featured'];
		$date = $row['date_created'];
		$timestamp = strtotime($date);
        $date =  date("j M Y", $timestamp);
	    $i++;
		
		$category_fetch = mysqli_query($con,"SELECT name FROM category WHERE id = '$cat' LIMIT 1");
		$fetch = mysqli_fetch_array($category_fetch);
		$cat_name = strtoupper($fetch['name']); 
		
		$category_sub = mysqli_query($con,"SELECT name FROM category WHERE id = '$sub' LIMIT 1");
		$fetch_sub = mysqli_fetch_array($category_sub);
		$sub_name = ucfirst($fetch_sub['name']); 
		
		if($featured == 0){
			$featured = "<span>NO</span>";
		}else{
		   $featured = "<span class='green-text'>YES</span>";
		}
		
		if($sub == 0){
			$sub_name = "---";
		}
		
		echo "
	 
		 
            <td>$i</td>
            <td>$title</td>
            <td>$cat_name</td>
            <td class='hide-on-small-only'>$sub_name</td>
            <td class='hide-on-small-only'>$featured</td>
            <td class='hide-on-small-only'>$date</td>
            <td><a href='edit_post.php?edit=$id' class=''><i class='material-icons'>mode_edit</i></a></td>
			<td><a onclick='return confirm(\"Are you sure you want to delete the category?\");' href='function/function.php?del_post=$id' class='red-text text-lighten-1'><i class='material-icons'>delete</i></a></td>
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
			 echo "<li class='waves-effect'><a href='view_posts.php?page=$back'><i class='material-icons'>chevron_left</i></a></li>";
		 }
		 
		 for($i = 1;$i<=$total_pages;$i++){
			 if($i == $page){
				 echo "<li class='active'><a href='javascript:void(0)'>$i</a></li>";
			 }else{
			 echo "<li class='waves-effect'><a href='view_posts.php?page=$i'>$i</a></li>";
			 }
		 }
		 
		 
		   if($page == $total_pages){
			 echo "<li class='disabled'><a href='javascript:void(0)'><i class='material-icons'>chevron_right</i></a></li>";
		 }else{
			 $next = $page+1;
			 echo "<li class='waves-effect'><a href='view_posts.php?page=$next'><i class='material-icons'>chevron_right</i></a></li>";
		 }
	 
    ?>
	</ul>
	</div>
	  
	  
</main>

<?php include "inc/footer.php"; ?>
