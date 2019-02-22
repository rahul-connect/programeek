<!DOCTYPE HTML>
<html lang="en">
<head>
<?php
$fetch_website = mysqli_query($con,"SELECT * from account where id='1' LIMIT 1");
$web = mysqli_fetch_array($fetch_website);
$logo = $web['logo'];
$slogan = $web['slogan'];
$page_title = $web['page_title'];
$copyright = $web['copyright'];
$description = $web['description'];
$keywords = $web['keywords'];
$construction = $web['construction'];

?>
   <title><?php echo $page_title; ?></title>
   <meta charset="utf-8">
   <meta name="description" content="<?php echo $description; ?>">
   <meta name="keywords" content="<?php echo $keywords; ?>">
   <meta name="author" content="Rahul Agarwal">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="canonical" href="https://programeek.tech" />
   
   
   <link rel="shortcut icon" href="images/<?php echo $logo; ?>">
   <link rel="stylesheet" type="text/css" href="css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="css/custom.css">  
   <link rel="stylesheet" href="https://cdn.rawgit.com/konpa/devicon/master/devicon.min.css">
   <style>
   
input:-webkit-autofill,
input:-webkit-autofill:hover,
input:-webkit-autofill:focus,
input:-webkit-autofill:active {
    transition: background-color 5000s ease-in-out 0s;
}


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


     
    header , footer {
      padding-left: 250px;
    }
	

       @media only screen and (max-width : 992px) {
      header, footer {
        padding-left: 0;
      }
	  #popular{
	     margin-top:50px;
	  }
	  
    }
        
   </style>
</head>
<body class="grey lighten-4">
<!--- Top Navigation --->
<header>
<div class="">
<nav>  
   <div class="nav-wrapper">
    <div class="container">
	<div class="row">
	   <div class="col l2 s2">
	       <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
	   </div>
	   <div class="col l5 s4">
	   <!-- Brand-logo Class omitted-->
	      <a href="index.php" class="" style="font-family:papyrus;font-size:30px;">Programeek</a>
		  
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
</div>
</header>