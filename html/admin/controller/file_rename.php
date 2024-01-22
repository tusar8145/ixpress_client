 

    

<?php

		

		$final_name=$_POST[final_name];

		$position=$_POST[position];  //contact_id

		$id_value=$_POST[id_value]; //is_key

		$old_value=$_POST[old_value]; //is_key
		
		
		$src=$_POST[src];  
		$table_name=$_POST[table_name];  
		$id_name=$_POST[id_name]; //is_key

		

		

		

		include('../config.php');

		

						$cc=$query="select files from ".$table_name." WHERE ".$id_name."='$id_value'";

						$result=mysqli_query($connect,$query); $rowcount=mysqli_num_rows($result); $row = mysqli_fetch_all($result,MYSQLI_ASSOC);

						for($i=$rowcount-1;$i>=0;$i--)

						{  

							$files=$row[$i]['files'];		

						} 	 

	 

						$f_array=explode(',',$files);

						//unset($f_array[$position]);

						

						$reset_string='';

						$p=0;

						foreach($f_array as $f_array_single){

						$p++;

						$old_name='';

						if($p!=$position){

								if($reset_string==''){$reset_string=$f_array_single;}

								else{$reset_string=$reset_string.','.$f_array_single;}

							}else{

								$old_name=$f_array_single;

								if($reset_string==''){$reset_string=$final_name;}

								else{$reset_string=$reset_string.','.$final_name;}

							}

						}

						

						if(rename('../'.$src.$old_value, '../'.$src.$final_name)){
 

 	    $query = "UPDATE  ".$table_name."  SET files='$reset_string' where  ".$id_name."='$id_value'";
		try{$update_Result = mysqli_query($connect, $query);if($update_Result){if(mysqli_affected_rows($connect) > 0){$say_code='1'; $say='File Rename Successfully'; }else{$say_code='0'; $say='File Rename Fails';}}} catch (Exception $ex) { }						
        }	echo $y='{ "say":"'.$say.':'.$old_value.' to '.$final_name.'", "say_code":"'.$say_code.'"}';
		
 