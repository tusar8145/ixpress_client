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
	
	
	
	
	
		$del_id=$_POST[delid];
		$table_name=$_POST[table_name];
		$id_name=$_POST[id_name];
		$f_sl=$_POST[f_sl];
		$cancel_note=$_POST[cancel_note];

		$del_id_array=explode(',',$del_id);

			foreach($del_id_array as $del_id_array_each){ 
			
			
			if($f_sl==1){
			$query ="UPDATE ".$table_name."
			SET `status`=CONCAT(`status`,',Approved'), is_approved=1, final_status_updated='$created', final_status = '$cancel_note', final_status = '<span class=\"badge me-1 py-2 badge-soft-danger\" style=\"padding: 3px !important;background: #27bcfd;margin: 2px !important;color: white;\">Approved</span>', final_status_by = '$userID', status_by = CONCAT(`status_by`,',$userID'), status_updated = CONCAT(`status_updated`,'/$created')
			WHERE ".$id_name."='$del_id_array_each'";
			
				if (mysqli_query($conn, $query)) {} else {}	
				$say_code='1'; $say='Approved Successfully';
				
			}
			 if($f_sl==2){
			$query ="UPDATE ".$table_name."
			SET `cancel_note`='$cancel_note',is_approved=0, final_status_updated='$created', final_status = '<span class=\"badge me-1 py-2 badge-soft-danger\" style=\"padding: 3px !important;background: #831212c7;color: white;\">Cancel</span>', final_status_by = '$userID'
			WHERE ".$id_name."='$del_id_array_each'";
			
				if (mysqli_query($conn, $query)) {} else {}	
				$say_code='1'; $say='Cancel Successfully';
				
			}	
			 if($f_sl==3){
			$query ="UPDATE ".$table_name."
			SET `status`=CONCAT(`status`,',Approved'), is_approved=1, final_status_updated='$created', final_status = '$cancel_note', final_status = '<span class=\"badge me-1 py-2 badge-soft-danger\" style=\"padding: 3px !important;background: #25bb1bc7;margin: 2px !important;color: white;\">Completed</span>', final_status_by = '$userID', status_by = CONCAT(`status_by`,',$userID'), status_updated = CONCAT(`status_updated`,'/$created')
			WHERE ".$id_name."='$del_id_array_each'";
			
				if (mysqli_query($conn, $query)) {} else {}	
				$say_code='1'; $say='Approved Successfully';
				
			}	
			 if($f_sl==5){
			$query ="UPDATE ".$table_name."
			SET `status`=CONCAT(`status`,',Approved'), is_approved=0, final_status_updated='$created', final_status = 'Pending', final_status_by = '$userID', status_by = CONCAT(`status_by`,',$userID'), status_updated = CONCAT(`status_updated`,'/$created')
			WHERE ".$id_name."='$del_id_array_each'";
			
				if (mysqli_query($conn, $query)) {} else {}	
				$say_code='1'; $say='Clear Successfully';
				
			}	 		
			}	
			
			if($say==''){$say_code='0'; $say='Error!';}
			 echo $y='{ "say":"'.$say.'", "say_code":"'.$say_code.'"}';



    
				 $msg=$say.' at '.$table_name.' : <b>'.$userName.'</b>';
 
				//$query="INSERT INTO tbl_users_notification (userID,message,created) VALUES ('$userID','$msg','$created')";
				//try{$result=mysqli_query($connect,$query);if($result){if(mysqli_affected_rows($connect) > 0){   }else{  }}} catch (Exception $ex) {}
 


//echo $y=$y.', "log":"'.$log.'", "noti":"'.$userName.'~*'.$say.'~*'.$table_name.'~*'.$created.'"}';	