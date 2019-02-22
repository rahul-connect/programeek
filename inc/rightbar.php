     <h4 class="center" id="popular">Popular Posts</h4><hr>
	 
	 <div id="popular_post">
        <ul class="collection teal-text">
		<?php
		  $popular_fetch = mysqli_query($con,"SELECT id,title,slug FROM blog ORDER BY views DESC LIMIT 7");
		  
		  while($row_fetch = mysqli_fetch_array($popular_fetch)){
			  $p_title = $row_fetch['title'];
			  $p_slug = $row_fetch['slug'];
			  echo "<li class='collection-item'><a href='single.php?post=$p_slug'>$p_title</a></li>";
		  }

		?>

    </ul>
     
	 </div><br>
	 
	 <h4 class="center" id="popular">Featured Posts</h4><hr>
	 
	 <div id="popular_post">
        <ul class="collection teal-text">
     <?php
		  $featured_fetch = mysqli_query($con,"SELECT id,title,slug FROM blog WHERE featured = 1 ORDER BY RAND() LIMIT 7");
		  if(mysqli_num_rows($featured_fetch) > 0){
			  while($row_fetch = mysqli_fetch_array($featured_fetch)){
			  $f_title = $row_fetch['title'];
			  $f_slug = $row_fetch['slug'];
			  echo "<li class='collection-item'><a href='single.php?post=$f_slug'>$f_title</a></li>";
		  }
		  }else{
			   echo "<li class='collection-item'><center><b style='font-size:20px;'>No Featured Post Available</b></center></li>";
		  }
		  
		  

		?>
    </ul>
     
	 </div>