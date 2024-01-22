<?php
	session_start();
	require_once '../class.user.php';
	require_once '../../configuration.php';
	
	$reg_user = new USER();
	
	if($reg_user->is_logged_in()!="")
	{
		$reg_user->redirect('home');
	}
	

	
	
	if(isset($_POST['btn-signup']))
	{
		$uname = trim($_POST['txtuname']);
		$email = trim($_POST['txtemail']);
		$upass = trim($_POST['txtpass']);
		$s1 = trim($_POST['s1']);
		$s2 = trim($_POST['s2']);
		$s3 = trim($_POST['s3']);
		$s6 = trim($_POST['s6']);
		$code = md5(uniqid(rand()));
		
$user_ip = getenv('REMOTE_ADDR');
$geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
$a4 = $geo["geoplugin_city"];
$a5 = $geo["geoplugin_regionName"];
$a7 = $geo["geoplugin_countryName"];	
		
		$stmt = $reg_user->runQuery("SELECT * FROM tbl_users WHERE userEmail=:email_id");
		$stmt->execute(array(":email_id"=>$email));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if($stmt->rowCount() > 0)
		{
			$msg = "
			<div class='alert alert-error'>
			<button class='close' data-dismiss='alert'>&times;</button>
			<strong>Sorry !</strong>  email allready exists , Please Try another one
			</div>
			";
		}
		else
		{
			if($reg_user->register($uname,$email,$upass,$code,$s1,$s2,$s3,$s6,$a4,$a5,$a7))
			{			
				$id = $reg_user->lasdID();		
				$key = base64_encode($id);
				$id = $key;
				
				$message = "					
				Hello $uname,
				<br /><br />
				Welcome to Engineers Consortium Limited<br/>
				To complete your registration  please , just click following link<br/>
				<br /><br />
				<a href='https://web.rainenterprisebd.com/login/verify.php?id=$id&code=$code'>Click HERE to Activate </a>
				<br /><br />
				Thanks,";
				
				$subject = "Confirm Registration";
				
				$reg_user->send_mail($email,$message,$subject);	
				$msg = "
				<div class='alert alert-success'>
				<button class='close' data-dismiss='alert'>&times;</button>
				<strong>Success!</strong>  We've sent an email to $email.
				Please click on the confirmation link in the email to create your account. 
				</div>
				";
			}
			else
			{
				echo "sorry , Query could no execute...";
			}		
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Signup </title>
	  <link rel="shortcut icon" type="image/x-icon" href="http://128.199.207.109/admin/assets/img/favicons/fab1.png">
		<!-- Bootstrap -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" type="text/css" />
		<link rel="stylesheet" href="../assets/signup-form.css" type="text/css" />
			<link href="../../my/css.css" rel="stylesheet" type="text/css">
	</head>
	
	<link rel="stylesheet" href="../assets/signup-form.css" type="text/css" />
<style>	

</style>		
</head>
<body  class="bg5">
	<div class="container">
		<div class="signup-form-container">
			
			
			<?php if(isset($msg)) echo $msg;  ?>
			<form class="" method="post"oninput="result.value=!!txtpass2.value&&(txtpass.value==txtpass2.value)?'Match!':'Nope!'" >
				<div class="form-header">
					<h3 class="form-title"><i class="fa fa-user"></i><span class="glyphicon glyphicon-user"></span> Sign Up</h3>
					
					<div class="pull-right">
						<h3 class="form-title"><span class="glyphicon glyphicon-pencil"></span></h3>
					</div>
					
				</div>
				
				<div class="form-body">
				
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
							<input  type="text" id="name" class="form-control" placeholder="First Name "  pattern=".{2,20}" name="s1" maxlength="40" autofocus="true" required minlength="2">
						</div>
						<span class="help-block" id="error"></span>
					</div>					
					
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
							<input  type="text" id="name" class="form-control" placeholder="Last Name "   name="s2" maxlength="40"   minlength="2">
						</div>
						<span class="help-block" id="error"></span>
					</div>						 						
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon"><span class="glyphicon glyphicon-book"></span></div>
							<input  type="text" id="name" class="form-control" placeholder="Address "  pattern=".{2,20}" name="s3" maxlength="40"  required minlength="2"title="Enter a valid address">
						</div>
						<span class="help-block" id="error"></span>
					</div>
			
					</div>				
                   <div class="form-footer">				
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
							<input  type="text" id="name" class="form-control" placeholder="Username" name="txtuname" maxlength="40"pattern=".{5,20}" required minlength="5" maxlength="20" title="Minimum 5 digit & Maximum 20 digit required">
						</div>
						<span class="help-block" id="error"></span>
					</div>
					
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
							<input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"  id="email"   class="form-control"   maxlength="50"placeholder="Email address" name="txtemail" required >
						</div> 
						<span class="help-block" id="error"></span>                     
					</div>					
										<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon"><span class="glyphicon glyphicon-road"></span></div>
							<input  type="text" id="name" class="form-control" placeholder="Phone "  pattern=".{2,20}" name="s6" maxlength="40"  required minlength="2">
						</div>
						<span class="help-block" id="error"></span>
					</div>	
										<div class="row">
                        
						<div class="form-group col-lg-6">
							<div class="input-group">
								<div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
								<input  id="password" type="password" class="form-control" placeholder="Password"name="txtpass" required="required" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Password must be 8 characters including 1 uppercase letter, 1 lowercase letter and numeric characters" minlength="8">
							</div>  
							<span class="help-block" id="error"></span>                    
						</div>
						
						<div class="form-group col-lg-6">
							<div class="input-group">
								<div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
								<input name="txtpass_confirm"required="required" type="password" class="form-control" name="txtpass2" placeholder="Retype Password"id="password_confirm" oninput="check(this)">
							</div>  
							<span class="help-block" id="error"></span>                    
						</div>
						
					</div>
						
				</div>
				
				<div class="form-footer">
					<button type="submit" class="btn btn-danger" id="btn-signup"name="btn-signup"><span class="glyphicon glyphicon-log-in"></span> Sign Me Up</button>
										<a href="../index.php" style="float:right;" class="btn btn-large text-danger"> <span class="glyphicon glyphicon-tag"></span> Sign In    </a>
				</div>
				
			</form>
			
			
			
			
			
		</div> 
	</div> <!-- /container -->
	

<script language='javascript' type='text/javascript'>
    function check(input) {
        if (input.value != document.getElementById('password').value) {
            input.setCustomValidity('Password Must be Matching.');
        } else {
            // input is valid -- reset the error message
            input.setCustomValidity('');
        }
    }
</script>	
	
	<script src="bootstrap/js/bootstrap.min.js"></script>
	
	<script src="assets/jquery-1.12.4-jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/jquery.validate.min.js"></script>
    <script src="assets/register.js"></script>
</body>
</html>