<footer class="page-footer">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">Subscribe Newsletter</h5>
				<form id="subscribe_form">
                <div class="input-field">
				  <input id="subscribe_ip" type="hidden" name="ip" value="<?php echo $user_ip; ?>">
				  <input id="subscribe_email" name="subscribe_email" class="white-text" type="email" class="validate">
				  <label for="subscribe_email" class="white-text">Email</label>
				</div>
				
				<div id="success_msg" style="color:#64ffda;"></div>
				<div id="error_msg" style="color:#ffcc80 ;"></div>
				
				<button class="btn waves-effect waves-light" type="submit" id="subscribe_btn" name="subscribe">Submit
					<i class="material-icons right">send</i>
				  </button>
				</form>
              </div>
              <div class="col l4 offset-l2 s12 hide-on-med-and-down">
                <h5 class="white-text">Quick Links</h5>
                <ul>
                  <li><a class="grey-text text-lighten-3" href="index.php">Home</a></li>
                  
                  <li><a class="grey-text text-lighten-3" href="about.php">About Us</a></li>
                  <li><a class="grey-text text-lighten-3" href="#modal2">Request a Tutorial</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright center">
            <div class="container">
            © <?php echo date('Y'); ?> <?php echo $copyright; ?>
            </div>
          </div>
        </footer>


<!--JavaScript--->
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
<script src="js/jquery.unveil.js" type="text/javascript"></script>
<script src="js/custom.js" type="text/javascript"></script>


<script>
$(".button-collapse").sideNav();

$('.collapsible').collapsible();
 $('.button-collapse').sideNav({
      menuWidth: 260, // Default is 300
      edge: 'left', // Choose the horizontal origin
      closeOnClick: false, // Closes side-nav on <a> clicks, useful for Angular/Meteor
      draggable: true // Choose whether you can drag to open on touch screens
    }
  );
  
  $(".button").sideNav();
 $('.button').sideNav({
      menuWidth: 260, // Default is 300
      edge: 'left', // Choose the horizontal origin
      closeOnClick: false, // Closes side-nav on <a> clicks, useful for Angular/Meteor
      draggable: true // Choose whether you can drag to open on touch screens
    }
  );
  
  $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();
	$("img").unveil();



  
  });
  

</script>
<div id="modal1" class="modal">
    <div class="modal-content">
      <h4 class="center">Search</h4>
      <div class="input-field">
			   <form action="search.php" method="get">
			     <input type="search" name="search" id="search">
				 <label class="label-icon" for="search"><i class="material-icons">search</i></label>  
		<button class="center btn waves-effect waves-light" type="submit">Submit
    <i class="material-icons right">send</i>
  </button>
		 </form>
	   </div>
    </div>
    <div class="modal-footer">
      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">close</a>
    </div>
  </div>
  
  
  
    <div id="modal2" class="modal">
    <div class="modal-content">
      <h4 class="center">Request a Tutorial</h4>
      <div class="input-field">
	  
			  <form action="">
			     <div class="input-field">
		  <input id="request_ip" type="hidden" name="ip" value="<?php echo $user_ip; ?>">
          <input id="request_name" type="text" class="validate">
          <label for="request_name">Full Name</label>
        </div>
				
		     <div class="input-field">
          <input id="request_email" type="email" class="validate">
          <label for="request_email">Email</label>
        </div>
		
		<div class="input-field">
          <textarea id="request_description" class="materialize-textarea"></textarea>
          <label for="request_description">Description</label>
        </div>     
		
    		<center> 
			   <div id="success_rply" style="color:#26a69a;margin-bottom:10px;"></div>
				<div id="error_rply" style="color:#e57373 ;margin-bottom:10px;"></div>
				
			<button class="btn waves-effect waves-light center" id="request" type="submit" name="search">Submit
					<i class="material-icons right">send</i>
				  </button><a href="javascript:void(0)" style="margin-left:10px;" class="btn modal-action modal-close waves-effect waves-green btn-flat">close</a></center>
			</form>
		 
	   </div>
    </div>
	
    
	
  </div>
</body>
</html>
<script>
// Subscrbe user 
$(document).ready(function(){
	$("#subscribe_btn").on('click',function(e){
		e.preventDefault();
		var email = $('#subscribe_email').val();
		var ip = $('#subscribe_ip').val();
		
		if(email != ''){
			$.ajax({
				url : "function/function.php",
				method: "get",
				data : {subscribe:email,
				        ip:ip
				},
				success : function(msg){
				   if(msg == 1){
					   $('#subscribe_email').val('');
					     $("#error_msg").show().html("Email Address already Subscribed !!");		 
			setTimeout(function() {
					$('#error_msg').fadeOut("slow");
				}, 2000 );
				   }else if(msg == 'invalid'){
					   $('#subscribe_email').val('');
					     $("#error_msg").show().html("Invalid Email Address !!");		 
			setTimeout(function() {
					$('#error_msg').fadeOut("slow");
				}, 2000 );
				   }else{	
					$('#subscribe_email').val('');
				    $("#success_msg").show().html("You have Subscribed Successfully !!");
			setTimeout(function() {
					$('#success_msg').fadeOut("slow");
				}, 2000 );

				}
				
			}
			})
			
		}else{
			$("#error_msg").show().html("Please enter an Email !!");
			setTimeout(function() {
					$('#error_msg').fadeOut("slow");
				}, 2000 );
		}
	});
	
	
	// Function to request a tutorial
	
	$("#request").on('click',function(e){
		e.preventDefault(); 
		var name = $('#request_name').val();
		var email = $('#request_email').val();
		var request = $('#request_description').val();
		var ip = $('#request_ip').val();
		
		if(name != '' && email !='' && request !=''){
					$.ajax({
			url: 'function/function.php',
            method: 'post',
			data:{r_name:name,
			      r_email:email,
				  request:request,
				  r_ip:ip
			},
			success: function(data){
				  if(data == 'invalid'){
					   $('#request_email').val('');
					     $("#error_rply").show().html("Invalid Email Address !!");		 
			setTimeout(function() {
					$('#error_rply').fadeOut("slow");
				}, 2000 );
				   }else{	
					$('#request_name').val('');
					$('#request_email').val('');
					$('#request_description').val('');
				    $("#success_rply").show().html("You have Requested Successfully !!");
			setTimeout(function() {
					$('#success_rply').fadeOut("slow");
				}, 2000 );
					setTimeout(function() {
					$(".modal-close").trigger('click'); 
				}, 3000 );
				}
			}
		});
		}else{
			$("#error_rply").show().html("Attention , Please donot leave any field empty !!");		 
			setTimeout(function() {
					$('#error_rply').fadeOut("slow");
				}, 2000 );
			
				
            
		}

		
	});
	
	
	
});



</script>

