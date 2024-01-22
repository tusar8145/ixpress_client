<?php
	
		include('../config.php');
//security
session_start();
	require_once '../../login/class.user.php';
	$user_home = new USER();
	
	if(!$user_home->is_logged_in())
	{
 
	} 
 
	$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
	$stmt->execute(array(":uid"=>$_SESSION['userSession']));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	
	$userID=$row['userID'];
	$userName=$row['userName'];

  	$d1 = new DateTime('now', new DateTimezone('Asia/Dhaka')); $created=$modified=$d1->format('F j, Y, g:i a'); $t_details=$d1->format('d-m-y, h:i'); $date=$d1->format('Y-m-d');  
	
	
	
	
	
		$id_value=$_POST[id_value];
		$holder_string=$_POST[holder_string];
		
 		$query = "UPDATE tender_documents SET details=' ' WHERE tender_documents_id='$id_value'";
		try{$update_Result = mysqli_query($connect, $query);if($update_Result){if(mysqli_affected_rows($connect) > 0){ $say_code='1'; $say='Data Extract Successfully'; }else{ $say_code='0'; $say='Data Extract Fails'; }}} catch (Exception $ex) { }						

 
		$query = "UPDATE tender_documents SET details='$holder_string' WHERE tender_documents_id='$id_value'";
		try{$update_Result = mysqli_query($connect, $query);if($update_Result){if(mysqli_affected_rows($connect) > 0){ $say_code='1'; $say='Data Extract Successfully'; }else{ $say_code='0'; $say='Data Extract Fails'; }}} catch (Exception $ex) { }						
		 echo $y='{ "say":"'.$say.'", "say_code":"'.$say_code.'"}';
		
 


//echo $y=$y.', "log":"'.$log.'", "noti":"'.$userName.'~*'.$say.'~*'.$table_name.'~*'.$created.'"}';	