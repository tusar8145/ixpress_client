<?php
require_once 'class.user.php';
$user = new USER();

if(empty($_GET['id']) && empty($_GET['code']))
{
	$user->redirect('index');
}

if(isset($_GET['id']) && isset($_GET['code']))
{
	$id = base64_decode($_GET['id']);
	$code = $_GET['code'];
	
	$stmt = $user->runQuery("SELECT * FROM tbl_users WHERE userID=:uid AND tokenCode=:token");
	$stmt->execute(array(":uid"=>$id,":token"=>$code));
	$rows = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if($stmt->rowCount() == 1)
	{
		if(isset($_POST['btn-reset-pass']))
		{
			$pass = $_POST['pass'];
			$cpass = $_POST['confirm-pass'];
			
			if($cpass!==$pass)
			{
				$msg = "<div class='alert alert-block'>
						<button class='close' data-dismiss='alert'>&times;</button>
						<strong>Sorry!</strong>  Password Doesn't match. 
						</div>";
			}
			else
			{
				$password = md5($cpass);
				$stmt = $user->runQuery("UPDATE tbl_users SET userPass=:upass WHERE userID=:uid");
				$stmt->execute(array(":upass"=>$password,":uid"=>$rows['userID']));
				
				$msg = "<div class='alert alert-success'>
						<button class='close' data-dismiss='alert'>&times;</button>
						Password Changed.
						</div>";
				//header("refresh:3;index");
				header("Location: http://139.59.120.225/session/signin");
die();
			}
		}	
	}
	else
	{
		$msg = "<div class='alert alert-success'>
				<button class='close' data-dismiss='alert'>&times;</button>
				No Account Found, Try again
				</div>";
				
	}
	
	
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Password Reset</title>
	  <link rel="shortcut icon" type="image/x-icon" href="http://128.199.207.109/admin/assets/img/favicons/fab1.png">

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css" />
		<link rel="stylesheet" href="assets/signup-form.css" type="text/css" />
			<link href="../my/css.css" rel="stylesheet" type="text/css">
	</head>
	
	<link rel="stylesheet" href="assets/signup-form.css" type="text/css" />

  <body id="login"class="bg5">
    <div class="container">
		<div class="signup-form-container">
    	<div class='alert alert-success'>
			<strong>Hello !</strong>  <?php echo $rows['userName'] ?> you are here to reset your forgetton password.
		</div>
        <form class="form-signin" method="post"oninput="result.value=!!txtpass2.value&&(txtpass.value==txtpass2.value)?'Match!':'Nope!'">
						<div class="form-header">
					<h3 class="form-title"><i class="fa fa-user"></i><span class="glyphicon glyphicon-user"></span> Password Reset</h3>
					
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
		?>
 					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
							<input  type="password" id="name" class="form-control" placeholder="New Password" name="pass" required="required" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Password must be 8 characters including 1 uppercase letter, 1 lowercase letter and numeric characters" minlength="8"">
						</div>
						<span class="help-block" id="error"></span>
					</div>		
									
 					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
							<input  type="password" id="name" class="form-control" placeholder="Confirm New Password" name="confirm-pass"  required="required" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Password must be 8 characters including 1 uppercase letter, 1 lowercase letter and numeric characters" minlength="8" oninput="check(this)">
						</div>
						<span class="help-block" id="error"></span>
					</div>		
     	<hr />
        <button class="btn btn-large btn-primary" type="submit" name="btn-reset-pass">Reset Your Password</button>
         </div>
      </form>

    </div> <!-- /container -->
    </div> <!-- /container -->
    <script src="bootstrap/js/jquery-1.9.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>