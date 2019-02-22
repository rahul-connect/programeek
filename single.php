<?php 
include "admin/database/db.php";
if(isset($_GET['post']) && $_GET['post'] != ''){
	   $post = $_GET['post'];
}else{
	header("Location:index.php");
	exit();
}

$fetch = mysqli_query($con,"SELECT * FROM blog WHERE slug='$post' LIMIT 1");
$count = mysqli_num_rows($fetch);
if($count < 1){
	header("Location:index.php");
	exit();
}
$row = mysqli_fetch_array($fetch);
$post_id = $row['id'];
$title = $row['title'];
$category = $row['category'];
$image = $row['image'];
$content = $row['content'];
$description = $row['description'];
$keywords = $row['keywords'];
$views = $row['views'];
$date = $row['date_created'];
$timestamp = strtotime($date);
$date =  date("j M Y", $timestamp);

if($views > 1000 AND $views < 1000000){
	$views = floor($views / 1000) . "K";
}else if($views >= 1000000){
	$views = floor($views / 1000000) . "M";
}


$category_fetch = mysqli_query($con,"SELECT name FROM category WHERE id = '$category' LIMIT 1");
$row = mysqli_fetch_array($category_fetch);
$category_name = strtoupper($row['name']); 

$fetch_web = mysqli_query($con,"select logo,slogan,copyright,construction FROM account WHERE id='1'");
$web = mysqli_fetch_array($fetch_web);
$logo = $web['logo'];
$slogan = $web['slogan'];
$copyright = $web['copyright'];
$construction = $web['construction'];

?>
<?php
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


$host  = $_SERVER['HTTP_HOST'];
$url = $_SERVER['REQUEST_URI'];
$http = $_SERVER['SERVER_PROTOCOL'];
$full_url = $http.$host.$url;
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
   <title><?php echo $title; ?> | Programeek</title>
   <meta charset="UTF-8">
   <meta name="description" content="<?php echo $description; ?>">
   <meta name="keywords" content="<?php echo $keywords; ?>">
   <meta name="author" content="Rahul Agarwal">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="canonical" href="<?php echo $full_url; ?>" />
   
   <link rel="shortcut icon" href="images/<?php echo $logo; ?>">
   <link rel="stylesheet" type="text/css" href="css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="css/custom.css">  
   <link rel="stylesheet" href="https://cdn.rawgit.com/konpa/devicon/master/devicon.min.css">
    <link rel="stylesheet" href="highlight/styles/agate.css">
	<link rel="stylesheet" href="admin/plugin/rrssb-master/css/rrssb.css"/>
 
  <meta property="og:locale" content="en_US" />
  <meta property="og:url"         content="<?php echo $full_url; ?>" />
  <meta property="og:type"          content="article" />
  <meta property="og:title"         content="<?php echo $title; ?>" />
  <meta property="og:description"   content="<?php echo $description; ?>" />
  <meta property="og:image"         content="<?php echo $http.$host; ?>/images/<?php echo $image; ?>" />
  
	
   <style>
   #scrollbar ::-webkit-scrollbar {
    width: 10px;
}
 
#scrollbar ::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
    border-radius: 10px;
}
 
#scrollbar ::-webkit-scrollbar-thumb {
    border-radius: 10px;
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 
}


	  #popular{
	     margin-top:50px;
	  }
	  
   
	  
    code{
		padding-left:20px !important;
	}
        
   </style>
</head>
<body class="grey lighten-4">


<!--- Top Navigation --->
<header>

<nav>  
   <div class="nav-wrapper">
    <div class="container">
	<div class="row">
	   <div class="col l2 s2">
	   <!---here the class is button and not button-collapse--->
	       <a href="#" data-activates="slide-out" class="button"><i class="material-icons">menu</i></a>
	   </div>
	   <div class="col l5 s4">
	   <!-- Brand-logo Class omitted-->
	      <center> <a href="index.php" class="" style="font-family:papyrus;font-size:30px;">Programeek</a></center>
		  
	   </div>
	   
	   
	 <div class="col l4 s4 hide-on-med-and-down">
	      
		     <div class="right input-field">
		 <form method="get" action="search.php">
			     <input type="search" name="search" id="search">
				 <label class="label-icon" for="search"><i class="material-icons">search</i></label>
			     
		 </form>
	   </div>
	 
	</div>
	
	<!---Mobile search button-->
	   <div class="col l3 s4 hide-on-large-only">
	     
		     <div class="right">
			    <a href="#modal1"> <i class="material-icons">search</i>	</a>
	        </div>
			 
	</div>
	
	
	
	
<div class="col l1 s1">
	<a class='dropdown-button' href='#' data-beloworigin="true" data-constrainWidth="false" data-activates='dropdown1'>
    <i class="material-icons">more_vert</i>
	</a>


<ul id='dropdown1' class='dropdown-content'>
    
    <li><a href="index.php">Home</a></li>
    
	 <li><a href="about.php">About Us</a></li>
    <li class="divider"></li>
    <li><a href="#modal2">Request a Tutorial</a></li>
  </ul>
  
  
	</div>

	  </div>
   </div>
   </div>
  
  
</nav>

</header>

<!---Main Content --->
<div class="main">
<div class="row">
  <div id="scrollbar" class="col l0 m0">
  <!---Side Navigation --->
   <ul id="slide-out" class="side-nav">
    <li>
	<div class="userView blue-grey lighten-1">
      
      <a href="index.php" class="center"><img style="width:150px !important;height:150px !important;" src="images/code1.png" alt="programeek logo"></a>
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
 
  
  </div>
  
  <div class="col s12 m7 l7 offset-l1">

  <h1 style="font-size:40px;font-weight:bolder;" class="hide-on-small-only"><?php echo $title; ?></h1>
  <h1 style="font-size:30px;font-weight:bolder;" class="hide-on-med-and-up"><b><?php echo $title; ?></b></h1>
  <br>
 <div class="row">
 
  <div class="col s4 m5 l3"> <i class="material-icons left">schedule</i> <?php echo $date; ?></div>
  <div class="col s5 m4 l3"> <i class="material-icons left">label</i> <?php echo $category_name; ?></div>
  <div class="col s3 m3 l3"><i class="material-icons left">visibility</i> <?php echo $views; ?></div>
               
  </div>
  <div class="divider"></div>
  
  <div id="single_image">
  <img src="images/<?php echo $image; ?>" alt="<?php echo $title; ?>" class="responsive-img" style="height:100%;width:100%;">
  </div>
  
  <!--<div id="live_demo" class=" center container" style="margin-top:50px;">
    <a class="waves-effect waves-light btn"><i class="material-icons right">visibility</i>Live Preview</a>
  </div>-->
   
  
  
  <!--- Main Content Div--->
  
 <div class="" style="margin-top:50px;margin-bottom:50px;text-align:justify;">
    <?php echo $content; ?>
    
  </div>
  
  
  <!---Share --->
 <center>
  <div>
    
	
  </div>
  </center><br>
  

  
  <div id="doubt">
  
    <h3 class="center" style="font-family:Garamond;">Ask any Doubt</h3>
    
   
     <form id="doubt_form">
	 <div class="row">
	     <div class="input-field col l6 m6 s12">
          <input id="full_name" type="text" name="full_name" class="validate">
          <label for="full_name">Full Name</label>
        </div>
		<div class="input-field col l6 m6 s12">
          <input id="email" type="email" name="email" class="validate">
          <label for="email">Email</label>
		  <input id="ip" type="hidden" name="ip" value="<?php echo $user_ip; ?>">
          <input id="post_id" type="hidden" name="post_id" value="<?php echo $post_id; ?>">
        </div>
		
          
       
		<div class="input-field col l12 m12 s12">
          <textarea id="textarea" name="description" class="materialize-textarea" maxlength="1000" data-length="1000"></textarea>
          <label for="textarea">Description</label>
        </div>
		 <center>
		 <div class="preloader-wrapper big active">
    <div class="spinner-layer spinner-blue-only">
      <div class="circle-clipper left">
        <div class="circle"></div>
      </div><div class="gap-patch">
        <div class="circle"></div>
      </div><div class="circle-clipper right">
        <div class="circle"></div>
      </div>
    </div>
  </div></center><center>
		 
		 <button class="btn waves-effect waves-light center" name="submit_doubt" id="submit_doubt" type="submit">Submit
    <i class="material-icons right">question_answer</i>
  </button>
  </center>
		</div>
	 </form>
  </div>
 


 </div>
 



 <div class="col s12 m4 l3 hide-on-small-only">
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
     
	 </div>
	 
 <h4 class="center" id="popular">Related Posts</h4><hr>
	 
	 <div id="popular_post">
        <ul class="collection teal-text">
     <?php
		  $featured_fetch = mysqli_query($con,"SELECT id,title,slug FROM blog WHERE category = '$category' && title !='$title' ORDER BY RAND() LIMIT 7");
		  if(mysqli_num_rows($featured_fetch) > 0){
			  while($row_fetch = mysqli_fetch_array($featured_fetch)){
			  $f_title = $row_fetch['title'];
			  $f_slug = $row_fetch['slug'];
			  echo "<li class='collection-item'><a href='single.php?post=$f_slug'>$f_title</a></li>";
		  }
		  }else{
			   echo "<li class='collection-item'><center><b style='font-size:20px;'>No Related Post Available</b></center></li>";
		  }
		  
		  

		?>
    </ul>
     
	 </div>
	 
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
	 
  </div>
</div>
</div>

<!---Footer--->

<?php include "inc/footer.php"; ?>

<script src="highlight/highlight.pack.js"></script>

<script>
hljs.initHighlightingOnLoad();
</script>



<script>
// Function to ASK A DOUBT
$(document).ready(function(){
    $('.preloader-wrapper').hide();
    $("#submit_doubt").on('click',function(e){
		e.preventDefault();
		var name = $('#full_name').val();
		var email = $('#email').val();
		var doubt = $('#textarea').val();
		var ip = $('#ip').val();
		var post_id = $('#post_id').val();
		
		if(name != '' && email !='' && doubt !=''){
			$.ajax({
		    url: 'function/function.php',
            method: 'post',
			beforeSend : function(){
				$("#submit_doubt").hide();
				$(".preloader-wrapper").show();
				
				
			},
            data:{user_name:name,
			      user_email:email,
				  doubt:doubt,
				  ip_address:ip,
				  post_id:post_id
			},
            success : function(data){
			 $("#submit_doubt").show();
				$(".preloader-wrapper").hide();
				if(data == 'invalid'){
					 var $toastContent = $("<h5 style='color:#fff176;'>Invalid Email Address !!</h5>");
                    Materialize.toast($toastContent, 3000);
					$('#email').val('');
				}else if(data == 0){
					 var $toastContent = $("<h6 style='color:#c8e6c9;'>Success ! You will get a reply within 24hr !!</h6>");
                    Materialize.toast($toastContent, 3000);
					$("#doubt_form").trigger("reset");
				}
			}			
		})
		
		}else{
			     var $toastContent = $("<h5 style='color:#ffab91;'>Please fill all the fields !!</h5>");
                    Materialize.toast($toastContent, 2000);
		}
		
		
		
	});
	
	var view_id = $('#post_id').val();
	$.ajax({
		url: 'function/function.php',
		method: 'post',
		data: {view_id:view_id },
		success : function(){
			
		}
	})


  });
</script>
