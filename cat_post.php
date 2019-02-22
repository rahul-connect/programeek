<?php
include_once('admin/database/db.php');
if(isset($_GET['sub'])){
	$fetch_id = $_GET['sub'];
	$fetch = 'sub';
	$pagination= 'sub';
}else if(isset($_GET['cat'])){
	$fetch_id = $_GET['cat'];
	$fetch = 'category';
	$pagination= 'cat';
}else{
	echo "window.location='index.php'";
}
?>
<?php
$per_page =6;

if(isset($_GET['page'])){
	$page = $_GET['page'];
}else{
	$page=1;
}

$start = ($page-1)*$per_page;
$pagination_query = mysqli_query($con,"SELECT id FROM blog WHERE status='1' AND $fetch='$fetch_id'");
$total = mysqli_num_rows($pagination_query);
$total_pages = ceil($total/$per_page);

function getUserIP(){
		$client = @$_SERVER['HTTP_CLIENT_IP'];
		$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
		$remote = $_SERVER['REMOTE_ADDR'];
		
		if(filter_var($client, FILTER_VALIDATE_IP)){
			$ip = $client;
		}else if(filter_var($forward,FILTER_VALIDATE_IP)){
			$ip = $forward;
		}else {
			$ip = $remote;
		}
		return $ip;
}
	
	$user_ip = getUserIP();


?>

<?php include "inc/header.php"; ?>

<!---Main Content --->
<div class="main">
<div class="row">
   <!-- LEFT SIDEBAR--->
  <div id="scrollbar" class="col l3 m0">
   <?php include "inc/leftbar.php"; ?>
  </div>
  
  <div class="col s12 m7 l5">
  <div class="hide-on-med-and-up" style="margin-bottom:20px;">
     <h4 class="center teal-text">Search Results</h4><hr>
	</div>
	   
	   	<?php
	    $fetch_post = mysqli_query($con,"SELECT id,title,category,image,slug,views,date_created FROM blog WHERE status = '1' && $fetch ='$fetch_id' ORDER BY id DESC LIMIT $start,$per_page");
		$count_post = mysqli_num_rows($fetch_post);
		if($count_post < 1){
						echo "
			<div style='margin:0px 50px;'>
			<img src='images/no_result.png' alt='no result found' class='responsive-img center' style='height:100%;width:100%;'><br>
			</div>
			<h3 class='center' style='margin-bottom:100px;'>No result Found...</h3>
			";
		}else{
			
		while($post = mysqli_fetch_array($fetch_post)){
			$id = $post['id'];
			$title = $post['title'];
			$cat = $post['category'];
			$image = $post['image'];
			$slug = $post['slug'];
			$date = $post['date_created'];
			$views = $post['views'];
			$timestamp = strtotime($date);
            $date =  date("j M Y", $timestamp);
			if($views > 1000 AND $views < 1000000){
					$views = floor($views / 1000) . "K";
				}else if($views >= 1000000){
					$views = floor($views / 1000000) . "M";
				}
			
			$category_fetch = mysqli_query($con,"SELECT name FROM category WHERE id = '$cat' LIMIT 1");
			$row = mysqli_fetch_array($category_fetch);
			$cat_name = strtoupper($row['name']); 
			
			echo "
     <a href='single.php?post=$slug' class='black-text'>
	 <div class='hide-on-small-only'>
	 <div class='card  horizontal hoverable'>
	 <div class='card-image'>
        <img src='images/$image' class='responsive-img' alt='$title' style='height:100%;width:100%;'>
      </div>
	  
	 <div class='card-content' style='padding-bottom:0;'>
        
		 
       <p><b>$title</b></p><br><div class='divider'></div><br>
         
       
	   <div class='row'>
	   
	   <span class='col s12 l12'><i class='material-icons left'>today</i> $date</span>
	 
        <span class='col s12 l12'><i class='material-icons left'>label</i> $cat_name</span>
	
        <span class='col s12 l12'><i class='material-icons left'>visibility</i> $views</span>
		
	   </div>
	   </div>
	  </div>
	  </div>
	  
	  	   <div class='hide-on-med-and-up'>
	  <div class='card hoverable'>
	      <div class='card-image'>
        <img src='images/$image' class='responsive-img' alt='$title' style='height:200px;width:100%;'>
         <span class='card-title black-text'></span>
	  </div>
	  <div class='card-content' style='padding:10px 25px!important;'>
	  <b>$title</b>
	  </div>
	  <div class='card-action' style='padding-bottom:1px !important;'>
	  <div class='row'>
	    <span class='col s12 l12'><i class='material-icons left'>today</i> $date</span>
	 
        <span class='col s12 l12'><i class='material-icons left'>label</i> $cat_name</span>
	
        <span class='col s12 l12'><i class='material-icons left'>visibility</i> $views</span>
		</div>
	  </div>
	  </div>
	  </div>
	  
	  </a>
	  ";
		}
	?>
	  
	

	  
 <!-- Pagination --->
	 <div id="pagination" class="center">
	  <ul class="pagination"> 
	 <?php
         if($page < 2){
			 echo "<li class='disabled'><a href='javascript:void(0)'><i class='material-icons'>chevron_left</i></a></li>";
		 }else{
			 $back = $page-1;
			 echo "<li class='waves-effect'><a href='cat_post.php?$pagination=$fetch_id&page=$back'><i class='material-icons'>chevron_left</i></a></li>";
		 }
		 
		 for($i = 1;$i<=$total_pages;$i++){
			 if($i == $page){
				 echo "<li class='active'><a href='javascript:void(0)'>$i</a></li>";
			 }else{
			 echo "<li class='waves-effect'><a href='cat_post.php?$pagination=$fetch_id&page=$i'>$i</a></li>";
			 }
		 }
		 
		 
		   if($page == $total_pages){
			 echo "<li class='disabled'><a href='javascript:void(0)'><i class='material-icons'>chevron_right</i></a></li>";
		 }else{
			 $next = $page+1;
			 echo "<li class='waves-effect'><a href='cat_post.php?$pagination=$fetch_id&page=$next'><i class='material-icons'>chevron_right</i></a></li>";
		 }
	 
    ?>
	</ul>
	</div>
	
	
	<?php } ?>
  </div>
  
  
   <!-- RIGHT SIDEBAR--->
  <div class="col s12 m4 l3">
     <?php include "inc/rightbar.php"; ?>
  </div>
  
</div>

</div>

<!---Footer--->

   
<?php include "inc/footer.php"; ?>