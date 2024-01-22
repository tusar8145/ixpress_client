<?php
session_start();
require_once '../class.user.php';
$user = new USER(); 

if($user->is_logged_in()!="")
{
	//$user->redirect('home.php');
}

if(isset($_POST['btn-submit']))
{
	$email = $_POST['txtemail'];
	
	$stmt = $user->runQuery("SELECT userID,userPhone,userName FROM tbl_users WHERE userEmail=:email LIMIT 1");
	$stmt->execute(array(":email"=>$email));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);	
	if($stmt->rowCount() == 1)
	{
		$id = base64_encode($row['userID']);
		$userName = $row['userName'];
		$userPhone = $row['userPhone'];
		$code = md5(uniqid(rand()));
		
		$stmt = $user->runQuery("UPDATE tbl_users SET tokenCode=:token WHERE userEmail=:email");
		$stmt->execute(array(":token"=>$code,"email"=>$email));
		/*$message= "
				   Hello , $email
				   <br /><br />
				   We got requested to reset your password, if you do this then just click the following link to reset your password, if not just ignore    this email,
				   <br /><br />
				   Click Following Link To Reset Your Password 
				   <br /><br />
				   <a href='http://159.223.76.11/login/resetpass.php?id=$id&code=$code'>click here to reset your password</a>
				   <br /><br />
				   thank you.
				   ";*/
		$message= "Hello , $userName  http://159.223.76.11/login/resetpass.php?id=$id&code=$code visit this link to reset your password. thank you Ixpress Ltd.";
		$subject = "Password Reset";
 
 	
		
		 $user->send_sms($email,$message,$subject,$userPhone);
		
		$msg = "<div class='alert alert-success'>
					<button class='close' data-dismiss='alert'>&times;</button>
					We've sent an sms to $userPhone.
                    Please click on the password reset link in the sms to generate new password. 
			  	</div>";
	}
	else
	{
		$msg = "<div class='alert alert-danger'>
					<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Sorry!</strong>  this email not found. 
			    </div>";
	}
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Forgot Password</title>
	  <link rel="shortcut icon" type="image/x-icon" href="http://159.223.76.11/admin/assets/img/favicons/fab1.png">

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" type="text/css" />
		<link rel="stylesheet" href="../assets/signup-form.css" type="text/css" />
			<link href="../../my/css.css" rel="stylesheet" type="text/css">
	</head>
	
	<link rel="stylesheet" href="../assets/signup-form.css" type="text/css" />
	
  <body id="login"class="bg5">
    <div class="container">
		<div class="signup-form-container">
      <form class="form-signin" method="post">
				<div class="form-header">
					<h3 class="form-title"><i class="fa fa-user"></i><span class="glyphicon glyphicon-user text-danger"></span> Forgot Password</h3>
					
					<div class="pull-right">
						<h3 class="form-title"><span class="glyphicon glyphicon-pencil"></span></h3>
					</div>
					
				</div>

		<div class="form-body">
        	<?php
			if(isset($msg))
			{
				echo $msg;
			}
			else
			{
				?>
              	<div class='alert alert-info'>
				Please enter your email address. You will receive a link to create a new password via phone number.!
				</div>  
                <?php
			}
			?>
        					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
							<input   id="email" type="text" class="form-control"   maxlength="50"placeholder="Email address" name="txtemail" required >
						</div> 
						<span class="help-block" id="error"></span>                     
					</div>	
 
     	<hr />
        <button class="btn btn-danger btn-primary text-danger" type="submit" name="btn-submit">Generate new Password</button>
      </div>
	  </form>

    </div> <!-- /container -->
    </div> <!-- /container -->
    <script src="bootstrap/js/jquery-1.9.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>