
<?php include "database/db.php"; ?>
<?php 
if(isset($_POST['admin_login'])){
	$user = mysqli_real_escape_string($con,$_POST['username']);
	$pass = mysqli_real_escape_string($con,$_POST['password']);
	$password = md5($pass);
	
	$select = mysqli_query($con,"SELECT * FROM admin WHERE name='$user' && password='$password' LIMIT 1");
	$count = mysqli_num_rows($select);
if($count > 0){
	$fetch = mysqli_fetch_array($select);
	$_SESSION["admin"] = $fetch['name'];
	
	header("Location:index.php");
}else{
	
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
	$rply = "Someone Tried to login to the Admin Panel with wrong credentials. User:$user , Pass:$pass , IP : $user_ip";
	$email = "ceorahulagarwal@gmail.com";
	$name = 'Rahul Agarwal';
	
 require 'plugin/PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'programeek.tech@gmail.com';                 // SMTP username
$mail->Password = 'xyzzyspoon';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('programeek.tech@gmail.com', 'Programeek Tech');
$mail->addAddress($email, $name);     // Add a recipient
$mail->addReplyTo($email, $name);

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Attention !!! Someone tried to login Programeek';
$mail->Body    = $rply;
if($mail->send()) {
	echo "<script>window.location='login.php?incorrect'</script>";
}
}
	
}


?>
<!DOCTYPE HTML>
<html>
<head>
  <title>Admin Login | Programeek</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
   <link rel="shortcut icon" href="../images/code1.png">
   <link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="teal">
<div class="container">
<div class="row">
<div class="col s1 l3"></div>
<div class="col s10 l6">
<div class="card-panel z-depth-5" style="margin-top:150px;">         
<div class="card-content">
     <form action="login.php" method="post">
        <div class="input-field">
          <i class="material-icons prefix">account_circle</i>
          <input id="icon_prefix" type="text" name="username" required class="validate">
          <label for="icon_prefix">User Name</label>
        </div>
		 <div class="input-field">
          <i class="material-icons prefix">vpn_key</i>
          <input id="icon_prefix" type="password" name="password" required class="validate">
          <label for="icon_prefix">Password</label>
        </div><br>
		<center><button class="btn waves-effect waves-light green" type="submit" name="admin_login">Submit
      <i class="material-icons right">send</i>
     </button></center>
        
	 </form>
	 </div>
</div>
</div>
<div class="col s1 l3"></div>
</div>

</div>


<script rel="javascript" src="../js/jquery.min.js"></script>
<script rel="javascript" src="../js/materialize.min.js"></script>
</body>
</html>