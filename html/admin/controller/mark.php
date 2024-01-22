 
    
<?php
		//'1','tbl_users_permission','tbl_users_permission_id','alls','','1'
		//id,table_name,id_name,column_name,conditions,f_sl
		
		$table_name=$_POST['table_name'];
		$id_name=$_POST['id_name'];  //contact_id
		$column_name=$_POST['column_name']; //is_key
		$id=$_POST['id']; //int
		$f_sl=$_POST['f_sl'];    
 
		include('../config.php');
	 
	 
		if($f_sl=='1'){	 

	 				 	$query="select ".$column_name." from ".$table_name." WHERE ".$id_name."='$id'";
						$result=mysqli_query($connect,$query);   $rowcount=mysqli_num_rows($result); $row = mysqli_fetch_all($result,MYSQLI_ASSOC);
						for($i=$rowcount-1;$i>=0;$i--)
						{  
							$is_key=$row[$i][$column_name];		
						} 

							 
						if($is_key==0){
							 $query = "UPDATE ".$table_name." SET ".$column_name."='1'  WHERE ".$id_name."='$id'";
						}
						else {
							 $query = "UPDATE ".$table_name." SET ".$column_name."='0'  WHERE ".$id_name."='$id'";
						}
								   

						try{$update_Result = mysqli_query($connect, $query);if($update_Result){if(mysqli_affected_rows($connect) > 0){$say_code='1'; $say='Update Successfully'; }else{$say_code='0'; $say='Update Fail';}}} catch (Exception $ex) { }						

						echo $y='{ "say":"'.$query.'", "say_code":"'.$say_code.'"}';	
 
		}