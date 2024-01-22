<?php

require_once 'dbconfig.php';
include '../configuration.php';



class USER
{	

	private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function lasdID()
	{
		$stmt = $this->conn->lastInsertId();
		return $stmt;
	}
	
	public function register($uname,$email,$upass,$code,$s1,$s2,$s3,$s6,$a4,$a5,$a7)
	{
		try
		{				

			$password = md5($upass);
			
			$stmt = $this->conn->prepare("INSERT INTO tbl_users(userName,userEmail,userPass,tokenCode,firstName,lastName,address) 
			                                             VALUES(:user_name, :user_mail, :user_pass, :active_code, :s1, :s2, :s3)");			
									
														 

											 
			$stmt->bindparam(":user_name",$uname);
			$stmt->bindparam(":user_mail",$email);
			$stmt->bindparam(":user_pass",$password);
			$stmt->bindparam(":active_code",$code);
			$stmt->bindparam(":s1",$s1);
			$stmt->bindparam(":s2",$s2);
			$stmt->bindparam(":s3",$s3);

 
			$stmt->execute();	
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	
		public function login_ok($userID)
	{  $userID=$userID; // return $userID;
	
	include('../config.php');

	
		try
		{
			
			
			
			$stmt = $this->conn->prepare("SELECT * FROM tbl_users WHERE userID=:userID");
			$stmt->execute(array(":userID"=>$userID));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
		 
					
			if($stmt->rowCount() == 1)
			{
				
				
				if($userRow['tbl_users_userStatus']=="Y")
				{
					
				/*	$cc=$userRow['userName'];
	$query="INSERT INTO tbl_users_token (token,creator ) VALUES ('$cc','3')";
	try{$result=mysqli_query($connect,$query);if($result){if(mysqli_affected_rows($connect) > 0){$say='Insert Successful'; }else{$say='Insert Fails';}}} catch (Exception $ex) {}
 */
					
						$_SESSION['userSession'] = $userRow['userID'];
                        $userID=$userRow['userID'];
 	                     $userName=$userRow['userName'];
						return true;

				}
				else
				{

					header("Location: index.php?inactive");
					exit;
				}	
			}
			else
			{
 
				header("Location: index.php?error");
				exit;
			}		
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	public function login($email,$upass)
	{  $email=$email;
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM tbl_users WHERE userEmail=:email_id");
			$stmt->execute(array(":email_id"=>$email));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			
			if($stmt->rowCount() == 1)
			{
				if($userRow['tbl_users_userStatus']=="Y")
				{
					if($userRow['userPass']==md5($upass))
					{
						$_SESSION['userSession'] = $userRow['userID'];
                        $userID=$userRow['userID'];
 	                     $userName=$userRow['userName'];
$ip = getenv('REMOTE_ADDR');
$geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$ip"));
$location = $geo["geoplugin_city"].', '.$geo["geoplugin_countryName"];							
$device=  $_SERVER['HTTP_USER_AGENT'].$_SERVER['LOCAL_ADDR'];				
$browser = get_browser();					
$d1 = new DateTime('now', new DateTimezone('Asia/Dhaka')); $log =$d1->format('F j, Y, g:i a');
include('../config.php');			
 
 
 		$message= "
				   Hello , $userName
				   <br /><br />
				  We noticed a new sign-in to your  Account on a ".$device." device from".$location.". IP: ".$ip.' at '.$log." If this was you, you don’t need to do anything. If not, please change your password.
				   <br /><br />
				   Click Following Link To login Your Account 
				   <br /><br />
				   <a href='".$parent_base_url."/login'>click here to login your account</a>
				   <br /><br />
				   thank you.
				   ";
		$subject = "New sign-in to your  account";
 
 
		$this->send_mail($email,$message,$subject);
 
 
	$query="INSERT INTO activitylog (userID,ip,location,device,browser,log,types) VALUES ('$userID','$ip','$location','$device','$browser','$log','login')";
	try{$result=mysqli_query($connect,$query);if($result){if(mysqli_affected_rows($connect) > 0){$say='Insert Successful'; }else{$say='Insert Fails';}}} catch (Exception $ex) {}
 
 
 return true;
					}
					else
					{
							include('../config.php');
							
						$email=stripcslashes($email); $email =  mysqli_real_escape_string($conn,$email);	
							
						$query="select userID,userName from tbl_users WHERE userEmail='$email'  ";
						$result=mysqli_query($connect,$query);
						$rowcount=mysqli_num_rows($result);
						$row = mysqli_fetch_all($result,MYSQLI_ASSOC);
						$userID=$row[0]['userID'];
						$userName=$row[0]['userName'];
 
$ip = getenv('REMOTE_ADDR');
$geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$ip"));
$location = $geo["geoplugin_city"].', '.$geo["geoplugin_countryName"];							
$device=  $_SERVER['HTTP_USER_AGENT'].$_SERVER['LOCAL_ADDR'];				
$browser = get_browser();					
$d1 = new DateTime('now', new DateTimezone('Asia/Dhaka')); $log =$d1->format('F j, Y, g:i a');
include('../config.php');			
 			
			
			
			
			
	$message= "
				   Hello , $userName
				   <br /><br />
				  We noticed that you are trying to login your Account on a ".$device." device from".$location.". IP: ".$ip.' at '.$log." If this was you, you don’t need to do anything. If not, please change your password.
				   <br /><br />
				   Click Following Link To login Your Account 
				   <br /><br />
				   <a href='".$parent_base_url."/login'>click here to login your account</a>
				   <br /><br />
				   thank you.
				   ";
		$subject = "Fail to login your  account";
 
 
		$this->send_mail($email,$message,$subject);		
			
			
 
			
	$query="INSERT INTO activitylog (userID,ip,location,device,browser,log,types) VALUES ('$userID','$ip','$location','$device','$browser','$log','Failed login')";
	try{$result=mysqli_query($connect,$query);if($result){if(mysqli_affected_rows($connect) > 0){$say='Insert Successful'; }else{$say='Insert Fails';}}} catch (Exception $ex) {}
 


						header("Location: index.php?error");
						exit;
					}
				}
				else
				{

					header("Location: index.php?inactive");
					exit;
				}	
			}
			else
			{
 
				header("Location: index.php?error");
				exit;
			}		
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	
	public function is_logged_in()
	{
		if(isset($_SESSION['userSession']))
		{
			return true;
		}
	}
	
	public function redirect($url)
	{
		header("Location: $url");
	}
	
	public function logout()
	{
$userID=$_SESSION['userSession'];		
$ip = getenv('REMOTE_ADDR');
$geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$ip"));
$location = $geo["geoplugin_city"].', '.$geo["geoplugin_countryName"];							
$device=  $_SERVER['HTTP_USER_AGENT'].$_SERVER['LOCAL_ADDR'];				
$browser = get_browser();					
$d1 = new DateTime('now', new DateTimezone('Asia/Dhaka')); $log =$d1->format('F j, Y, g:i a');
include('../config.php');			
 			
	$query="INSERT INTO activitylog (userID,ip,location,device,browser,log,types) VALUES ('$userID','$ip','$location','$device','$browser','$log','Logout')";
	try{$result=mysqli_query($connect,$query);if($result){if(mysqli_affected_rows($connect) > 0){$say='Insert Successful'; }else{$say='Insert Fails';}}} catch (Exception $ex) {}
 		
		
		session_destroy();
		$_SESSION['userSession'] = false;
		
	}
	
	function send_mail($email1,$message1,$subject1,$phone)
	{
 
		// API URL
	/*	$url = "http://web.rainenterprisebd.com/mailer/index.php";   
		$ch = curl_init($url);
		$data = array(
					'email' => $email1,
					'message' => $message1,
					'subject'   => $subject1
		);
		$payload = json_encode(array("user" => $data));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);

		// Close cURL resource
		curl_close($ch);*/

	}
	
	
	
	
		function send_sms($email1,$message1,$subject1,$phone)
	{
	
	   $url = "https://msg.elitbuzz-bd.com/smsapi";
  $data = [
    "api_key" => "C20083156283cb3a7eed87.11709072",
    "type" => "text",
    "contacts" => $phone,
    "senderid" => "iXpress Ltd",
    "msg" => $message1,
  ];
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $response = curl_exec($ch);
  curl_close($ch);
}
	
	
	
	
	
	
	
	
}