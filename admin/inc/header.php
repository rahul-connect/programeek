<?php include "database/db.php"; ?>
<?php
if(!isset($_SESSION['admin'])){
	echo "<script>window.location='login.php'</script>";
	exit();
}
?>
<?php
$doubt_badge = mysqli_query($con,"SELECT id from doubt WHERE status='0'");
$count_doubt = mysqli_num_rows($doubt_badge);

$request_badge = mysqli_query($con,"SELECT id from request WHERE status='0'");
$count_request = mysqli_num_rows($request_badge);
?>
<!DOCTYPE HTML>
<html>
<head>
   <title>Admin | Programeek Blog</title>
   <meta charset="utf-8">
   <meta name="description" content="Free Web tutorials With live Preview">
   <meta name="keywords" content="HTML,CSS,Bootstrap,JavaScript,Php,Mysql,Materialize">
   <meta name="author" content="Rahul Agarwal">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
   <link rel="shortcut icon" href="../images/code1.png">
   <link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="css/style.css">  
   <link rel="stylesheet" href="https://cdn.rawgit.com/konpa/devicon/master/devicon.min.css">
   <link href="plugin/ckeditor/plugins/codesnippet/lib/highlight/styles/dark.css" rel="stylesheet">

 
 
 </head>
 <body>
<header>
 <nav>
     <div class="nav-wrapper">
	 <div class="" style="margin:0px 100px;">
	 
	     <a href="index.php" class="brand-logo">Admin Panel</a>
	     <a href="logout.php" class="brand-logo hide-on-large-only right"><i class="material-icons" style="font-size:30px;">power_settings_new</i></</a>
		 
	   <ul class="right hide-on-med-and-down">
	     <a href="index.php"><li>Dashboard</a></li>
	      <li><a class="dropdown-button" href="#!" data-activates="category" data-beloworigin="true" data-constrainWidth="false">Category<i class="material-icons right" style="margin:0 !important;">arrow_drop_down</i></a></li>
	     <li><a class="dropdown-button" href="#!" data-activates="post" data-beloworigin="true" data-constrainWidth="false">Posts<i class="material-icons right" style="margin:0 !important;">arrow_drop_down</i></a></li>
	     <li><a class="dropdown-button" href="#!" data-activates="doubt" data-beloworigin="true" data-constrainWidth="false">Doubt<i class="material-icons right" style="margin:0 !important;">arrow_drop_down</i><?php if($count_doubt > 0){ echo "<span class='new badge'>$count_doubt</span>";}?></a></li>
	     <li><a class="dropdown-button" href="#!" data-activates="request" data-beloworigin="true" data-constrainWidth="false">Requests<i class="material-icons right" style="margin:0 !important;">arrow_drop_down</i><?php if($count_request > 0){ echo "<span class='new badge'>$count_request</span>";}?></a></li>
		  <li><a href="subscriber.php">Subscribers</a></li>
		  <li><a class="dropdown-button" href="#!" data-activates="account" data-beloworigin="true" data-constrainWidth="false"><i class="material-icons" style="font-size:40px;">person_pin</i></a></li>
	   </ul>
	   </div>
	   <div>
	   
	   <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
	 
	   <!-- Dropdown navigation--->
	   <ul id="category" class="dropdown-content">
		  <li><a href="insert_cat.php">Insert Category</a></li>
		  <li class="divider"></li>
		  <li><a href="view_cat.php">View Category</a></li>
		  <li class="divider"></li>
		  <li><a href="insert_sub.php">Insert Sub-Category</a></li>
		  <li class="divider"></li>
		  <li><a href="view_sub.php">View Sub-Category</a></li>
		</ul>
		
		<ul id="post" class="dropdown-content">
		  <li><a href="insert_post.php">Insert Post</a></li>
		  <li class="divider"></li>
		  <li><a href="view_posts.php">View Posts</a></li>
		</ul>
		
		<ul id="doubt" class="dropdown-content">
		  <li><a href="view_unsolved.php">View Unsolved</a></li>
		   <li class="divider"></li>
		  <li><a href="view_solved.php">View Solved</a></li>
		</ul>
		
		<ul id="request" class="dropdown-content">
		  <li><a href="request_new.php">View NEW Requests</a></li>
		   <li class="divider"></li>
		  <li><a href="request_old.php">View OLD Requests</a></li>
		</ul>
		
		<ul id="account" class="dropdown-content">
		<li><a href="account.php"><i class="material-icons left">settings</i>Account</a></li>
   <li class="divider"></li>		
          <li><a href="logout.php"><i class="material-icons left">power_settings_new</i>Logout</a></li>	
	
		</ul>
	   
	   <ul class="side-nav" id="mobile-demo">
	   <li><a href="index.php"><i class="material-icons left">dashboard</i>Dashboard</a></li>
	     <ul class="collapsible collapsible-accordion">
		    <li>
            <a class="collapsible-header"><i class="material-icons left">label</i>Category</a>
            <div class="collapsible-body">
              <ul>
                <li><a href="insert_cat.php">Insert Category</a></li>
		        <li><a href="view_cat.php">View Category</a></li>
				<li><a href="insert_sub.php">Insert SubCat</a></li>
		        <li><a href="view_sub.php">View SubCat</a></li>
              </ul>
            </div>
          </li>
		 </ul>
		 
		 <ul class="collapsible collapsible-accordion">
		    <li>
            <a class="collapsible-header"><i class="material-icons left">mode_edit</i>Posts</a>
            <div class="collapsible-body">
              <ul>
                 <li><a href="insert_post.php">Insert Post</a></li>
		         <li><a href="view_posts.php">View Posts</a></li>
              </ul>
            </div>
          </li>
		 </ul>
		 
		  <ul class="collapsible collapsible-accordion">
		    <li>
            <a class="collapsible-header"><i class="material-icons left">announcement</i>Doubt<?php if($count_doubt > 0){ echo "<span class='new badge'>$count_doubt</span>";}?></span></a>
            <div class="collapsible-body">
              <ul>
                 <li><a href="view_unsolved.php">View Unsolved</a></li>
	         	  <li><a href="view_solved.php">View Solved</a></li>
              </ul>
            </div>
          </li>
		 </ul>
		 
		 <ul class="collapsible collapsible-accordion">
		    <li>
            <a class="collapsible-header"><i class="material-icons left">forum</i>Requests<?php if($count_request > 0){ echo "<span class='new badge'>$count_request</span>";}?></span></a>
            <div class="collapsible-body">
              <ul>
                 <li><a href="request_new.php">View NEW Requests</a></li>
	         	  <li><a href="request_old.php">View OLD Requests</a></li>
              </ul>
            </div>
          </li>
		 </ul>
	       
          <li><a href="subscriber.php"><i class="material-icons left">email</i>Subscribers</a></li>		   
          <li><a href="account.php"><i class="material-icons left">settings</i>Account</a></li>		   
          <li><a href="logout.php"><i class="material-icons left">power_settings_new</i>Logout</a></li>		   
	    
	   </ul>
	   
	   
	   </div>
	 </div>
 </nav>

</header>