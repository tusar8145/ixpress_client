<?php
	










 include('../config.php');
		
  	$d1 = new DateTime('now', new DateTimezone('Asia/Dhaka')); $created=$modified=$d1->format('F j, Y, g:i a'); $t_details=$d1->format('d-m-y, h:i'); $date=$d1->format('Y-m-d');  
	
	 
		 
	 $data_string=$_POST[data_string];
 
 
		 $ids_string_array=explode(',',$data_string);
		
		$t_id_value=$_POST[t_id_value];
		$t_id_name=$_POST[t_id_name];
 


		 	$old=trim($ids_string_array[0]); $old=str_replace("'","",$old);
		 	$new=trim($ids_string_array[1]); $new=str_replace("'","",$new);
		 	$new2=trim($ids_string_array[2]); $new2=str_replace("'","",$new2);
 
	  	 
if($new == $new2){
	$new_haash=md5($new);
	$old_haash=md5($old);
	
		    $sqlx = "UPDATE tbl_users SET userPass='$new_haash' where  userID='$t_id_value' AND userPass='$old_haash'  "   ;
		
       try{
            $update_Result = mysqli_query($conn, $sqlx);
			
            if($update_Result)
            {
                if(mysqli_affected_rows($conn) > 0)
                { $say_code='1';
					$say="Your password has been changed successfully!";
					}else{
						$say="Password Incorrect";
	$say_code='0';
				}
			}
			} catch (Exception $ex) {
			
           
		}	 
} else {
	
	$say="New Password not Match";
	$say_code='0';
}

 


 
	 echo $y='{ "say":"'.$say.'", "say_code":"'.$say_code.'"}';	 	
 


 