
<ul id="slide-out" class="side-nav fixed">
    <li>
	<div class="userView blue-grey lighten-1">
      
      <a href="index.php" class="center"><img style="width:150px !important;height:150px !important;" src="images/<?php echo $logo; ?>" alt="Programeek Logo"></a>
	  <div class="center" style="margin-top:-25px;color:#eeeeee "><small style="font-size:15px;font-family:Courier New"><b><?php echo $slogan; ?></b></small></div>
      
    </div>
	</li>
    
    <li><h4 class="center" style="font-family:Brush Script MT, cursive">Categories</h4></li>
    <li><div class="divider"></div></li>
	
   <?php
      $fetch_cat = "SELECT * FROM category WHERE sub =0";
	  $run_fetch_cat = mysqli_query($con,$fetch_cat);
	  while($row = mysqli_fetch_array($run_fetch_cat)){
             $cat_id = $row['id'];
             $cat_name = strtoupper($row['name']);
             $cat_icon = $row['icon'];
			 
	  $fetch_sub = mysqli_query($con,"SELECT * FROM category WHERE sub=$cat_id");
	  $count_sub = mysqli_num_rows($fetch_sub);
	  
	  if($count_sub > 0){
		  ?>
		   <ul class='collapsible collapsible-accordion'>
		     <li>
		  <a class='waves-effect waves-red collapsible-header'><i class='devicon-<?php echo $cat_icon; ?>-plain colored'></i><?php echo $cat_name; ?></a>
		  <div class='collapsible-body'>
              <?php
			   while($sub = mysqli_fetch_array($fetch_sub)){
			  $sub_id = $sub['id'];
			  $sub_name = ucwords($sub['name']);
			  echo "
			  <ul>
                <li><a class='waves-effect waves-teal' href='cat_post.php?sub=$sub_id'>$sub_name</a></li>
              </ul>";
			   }
			  ?> 
            </div>
				   </li>
		      </ul>
			  <?php 
		  }
	   else{
		   echo "<li><a class='waves-effect waves-red collapsible-header' href='cat_post.php?cat=$cat_id'><i class='devicon-$cat_icon-plain colored'></i>$cat_name</a></li>";
	   }
				
	}
		  
   ?> 
  </ul>
