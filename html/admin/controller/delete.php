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
	
	
	
	
	
		$del_id=$_POST['delid'];
		$table_name=$_POST['table_name'];
		$id_name=$_POST['id_name'];
		$f_sl=$_POST['f_sl'];

		$del_id_array=explode(',',$del_id);
		if($f_sl=='1'){
			foreach($del_id_array as $del_id_array_each){ 
	$tt='';		
try {
					$query = "DELETE FROM ".$table_name." WHERE ".$id_name."='$del_id_array_each'";
							if (mysqli_query($conn, $query)) {
							$query="select  ".$id_name." from ".$table_name." WHERE  ".$id_name."='$del_id_array_each'"; $result=mysqli_query($connect,$query);$c_total=mysqli_num_rows($result);
							if($c_total>0){$say_code='0'; $say='Delete Fail';}else{$say_code='1'; $say='Data Deleted Successfully';} 

							} else {
								
								$say_code='0'; $say='error '.mysqli_error($conn);
								$tt='error !'.mysqli_error($conn);
							}	

	
 }
catch(Exception $e) {
	$say_code='0'; $say='Fail to delete. This data already used.';
 }
			
							  
							
										
			}	
			
			if($say==''){$say_code='0'; $say='Error!';}
			 echo $y='{ "say":"'.$say.'", "say_code":"'.$say_code.'"}';
		}else{// file delete only
				$rows_id=explode('@',$del_id)[0];
				$replace=explode('@',$del_id)[3];
				$replace_from=explode('@',$del_id)[2];
				$file_unlink=explode('@',$del_id)[4].$replace;
				
				if($replace !='def1.jpg'){
				unlink($file_unlink);
				unlink(str_replace('../','',$file_unlink));}
				
				$query2="select  ".$replace_from." from ".$table_name." WHERE  ".$id_name."='$rows_id'"; 
				$result=mysqli_query($connect,$query2);
				$c_total=mysqli_num_rows($result);
				$row = mysqli_fetch_all($result,MYSQLI_ASSOC);
 
				$vals=$row[0][$replace_from];	
				$vals_array=explode(',',$vals);
				$new_vals='';
				foreach($vals_array as $vals_array_single){
				if(($replace != $vals_array_single) && ($replace !='def1.jpg')){
						if($new_vals==''){$new_vals=$vals_array_single;}else{$new_vals=$new_vals.','.$vals_array_single;}
					}
				}
				//update
		$query = "UPDATE ".$table_name." SET ".$replace_from."='$new_vals' WHERE ".$id_name."='$rows_id'";
		try{$update_Result = mysqli_query($connect, $query);if($update_Result){if(mysqli_affected_rows($connect) > 0){ $say_code='1'; $say='Data Deleted Successfully'; }else{ }}} catch (Exception $ex) { }						
			 echo $y='{ "say":"'.$say.'", "say_code":"'.$say_code.'"}';
		}


    
				 $msg=$say.' at '.$table_name.' : <b>'.$userName.'</b>';
 
				$query="INSERT INTO tbl_users_notification (userID,message,created) VALUES ('$userID','$msg','$created')";
				try{$result=mysqli_query($connect,$query);if($result){if(mysqli_affected_rows($connect) > 0){   }else{  }}} catch (Exception $ex) {}
 


//echo $y=$y.', "log":"'.$log.'", "noti":"'.$userName.'~*'.$say.'~*'.$table_name.'~*'.$created.'"}';	