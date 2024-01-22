<?php
	

 

 include('../config.php');
/*$cc='Bagerhat,Bandarban,Barguna,Barisal,Bhola,Bogra,Brahmanbaria,Chandpur,Chapainawabganj,Chittagong,Chuadanga,Comilla,Dhaka,Dinajpur,Faridpur,Feni,Gaibandha,Gazipur,Gopalganj,Habiganj,Jamalpur,Jessore,Jhalokati,Jhenaidah,Joypurhat,Khagrachhari,Khulna,Kishoreganj,Kurigram,Kushtia,Lakshmipur,Lalmonirhat,Madaripur,Magura,Manikganj,Meherpur,Moulvibazar,Munshiganj,Mymensingh,Naogaon,Narail,Narayanganj,Narsingdi,Natore,Netrokona,Nilphamari,Noakhali,Pabna,Panchagarh,Patuakhali,Pirojpur,Rajbari,Rajshahi,Rangamati,Rangpur,Satkhira,Shariatpur,Sherpur,Sirajganj,Sunamganj,Sylhet,Tangail,Thakurgaon';
$ff=explode(',',$cc);	
foreach($ff as $fp){
		$query="INSERT INTO p_projects_district (p_projects_district) VALUES ('$fp')";
		try{$result=mysqli_query($connect,$query);if($result){if(mysqli_affected_rows($connect) > 0)
		{$say='Insert Successful'; }else{$say2='Insert Fails'; }}} 
		catch (Exception $ex) {}if($say!='Insert Successful'){$say2='Please input another name'; }    

}*/	
	
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
	
	 if(empty($userID)){
				header("Location: https://www.codegrepper.com/my-redirect-page.php");
				die();
		 }
		 
 	$is_key=$row['is_key'];
	if($is_key =='0'){ echo '<script> window.location = '.$parent_base_url.'"/login/"; </script>';}
	
  	$d1 = new DateTime('now', new DateTimezone('Asia/Dhaka')); $created=$modified=$d1->format('F j, Y, g:i a'); $t_details=$d1->format('d-m-y, h:i'); $date=$d1->format('Y-m-d');  
	
	 
		$table_name=$_POST['table_name'];
		$data_string=$_POST['data_string'].',\''.$created.'\',\''.$userID.'\'';
		
		 $data_string2=$_POST['data_string2'];  
		 $id_string2=$_POST['id_string2'];
		
		$ids_string=$_POST['ids_string'].',`created`,`creator`';
		$ids_string_update=$_POST['ids_string'].',`modified`,`modifier`';
		$type_string=$_POST['type_string'];
		
		
		$t_id_value=$_POST['t_id_value'];
		$t_id_name=$_POST['t_id_name'];
		$crud_action=$_POST['crud_action'];
		$file_prefix=$_POST['file_prefix'];
 

 
$type_string_array=explode('~^~',$type_string);
$data_string_array=explode(',',$data_string);



//for file 
$file_related=0;
//settings
$setting_holder=array();
$query1="select * from settings where is_key='1'";
$result1=mysqli_query($connect,$query1); $rowcount1=mysqli_num_rows($result1); 
$row1 = mysqli_fetch_all($result1,MYSQLI_ASSOC);
for($j=$rowcount1-1;$j>=0;$j--)
{  
		$setting_holder[$row1[$j]['setting']]=$row1[$j]['value'];
}
		


$sl=0; $file_exist=0;
foreach($type_string_array as $type_string_array_single)
{
		// location inside string check 
		$type_string_array_single_expand=explode('@',$type_string_array_single);
		if(trim($type_string_array_single_expand[0])=='file'){
			$file_related=1;
			$default_src=$type_string_array_single_expand[2];
		 
			$src=explode("'",explode('src=',$data_string)[1])[0];	
			if($src !=''){$default_src=$src;} 
		 
			if ($_POST["label"]) {
				$label = $_POST["label"];
			}

			//universal
			$file_default_size=$setting_holder['file_default_size_kb'];
			$file_default_type_overwrite=$setting_holder['file_default_type'];
			
			
			$section_wish_file=$setting_holder['section_wish_file_type_size_kb'];
			$section_wish_file = trim(preg_replace('/\s+/', '', $section_wish_file));
			$section_wish_file_array = explode('#',$section_wish_file);
			foreach($section_wish_file_array  as $section_wish_file_array_each){ 
				$section_wish_file_array_each_array = explode('@',$section_wish_file_array_each);
				if($table_name==$section_wish_file_array_each_array[0]){
					$file_default_size=(int)$section_wish_file_array_each_array[2];
					$file_default_type_overwrite=$section_wish_file_array_each_array[1];
					}
			}
			
		$total = count($_FILES['file']['name']);
	
			for( $i=0 ; $i < $total ; $i++ ) {
			$allowedExts = explode(',',$file_default_type_overwrite);
			$extension =end(explode(".", $_FILES["file"]["name"][$i]));
 
			$uploadNot = 0;
			// Check file size
			$now_file_size=$_FILES["file"]["size"][$i]/1024; $now_file_size=(int)$now_file_size;
			if ($now_file_size > $file_default_size) {
			  $log="Your File Size: ".($_FILES["file"]["size"][$i]/1024) ."kb Max SIze: ".($file_default_size)."kb Sorry, your file is too large.<br>";
			  $uploadNot++;
			}else{

			}

			// Check file format
			 if(in_array($extension, $allowedExts)) {   
			 			 $filename = $_FILES["file"]["name"][$i];
			 if( $filename !=''){
				 $log=$log."Your files are allowed.<br>";
			 }
			}else{
			  $log=$log."Your file type: ".$extension.". Sorry, only ".$file_default_type_overwrite." type files are allowed.<br>";
			   $uploadNot++;	
			}  
		 
			if ( $uploadNot>0) {
			$log=$log."Sorry, your file was not uploaded.<br>";
			$file_related='2';
			} else {  $filename = $_FILES["file"]["name"][$i];
				  // Check File already exists
				  
				  if (file_exists(trim($default_src).$filename)) {
				    $file_related='2';
						$this_file_name=$_FILES["file"]["name"][$i]; if(strlen($this_file_name)>22){$this_file_name=substr($this_file_name,0,22).'....';}
					$log=$log."But File ".$this_file_name." already exists";
					$file_exist++;
				 } else {
				    $file_related='1';
					//move_uploaded_file($_FILES["file"]["tmp_name"][$i],
					//trim($default_src).$filename);
					$this_file_name=$_FILES["file"]["name"][$i]; if(strlen($this_file_name)>22){$this_file_name=substr($this_file_name,0,22).'....';}
					$log=$log."File Size: ".$now_file_size."Kb <br> File Type: ".$extension." <br> File Name: ".$this_file_name;
				 }
				 
				 
		    }
			}
	 }	 
	 $sl++;
}

if($file_exist!=-1){
$sl=0; $log='';
foreach($type_string_array as $type_string_array_single)
{
		// location inside string check 
		$type_string_array_single_expand=explode('@',$type_string_array_single);
		if(trim($type_string_array_single_expand[0])=='file'){
			$file_related=1;
			$default_src=$type_string_array_single_expand[2];
		 
			$src=explode("'",explode('src=',$data_string)[1])[0];	
			if($src !=''){$default_src=$src;} 
		 
			if ($_POST["label"]) {
				$label = $_POST["label"];
			}

			//universal
			$file_default_size=$setting_holder['file_default_size_kb'];
			$file_default_type_overwrite=$setting_holder['file_default_type'];
			
			
			$section_wish_file=$setting_holder['section_wish_file_type_size_kb'];
			$section_wish_file = trim(preg_replace('/\s+/', '', $section_wish_file));
			$section_wish_file_array = explode('#',$section_wish_file);
			foreach($section_wish_file_array  as $section_wish_file_array_each){ 
				$section_wish_file_array_each_array = explode('@',$section_wish_file_array_each);
				if($table_name==$section_wish_file_array_each_array[0]){
					$file_default_size=(int)$section_wish_file_array_each_array[2];
					$file_default_type_overwrite=$section_wish_file_array_each_array[1];
					}
			}
			
		$total = count($_FILES['file']['name']);
	
			for( $i=0 ; $i < $total ; $i++ ) {
			$allowedExts = explode(',',$file_default_type_overwrite);
			$extension = end(explode(".", $_FILES["file"]["name"][$i]));
 
       	///$query="INSERT INTO 1test (value) VALUES ('$extension')";
		//try{$result=mysqli_query($connect,$query);if($result){if(mysqli_affected_rows($connect) > 0){}else{}}} catch (Exception $ex) {} 

 
 
			$uploadNot = 0;
			// Check file size
			$now_file_size=$_FILES["file"]["size"][$i]/1024; $now_file_size=(int)$now_file_size;
			if ($now_file_size > $file_default_size) {
			  $log="Your File Size: ".($_FILES["file"]["size"][$i]/1024) ."kb Max SIze: ".($file_default_size)."kb Sorry, your file is too large.<br>";
			  $uploadNot++;
			}else{

			}

			// Check file format
			 if(in_array($extension, $allowedExts)) {
			 
			 $filename = $_FILES["file"]["name"][$i];
			 if( $filename !=''){
					$log=$log."Your files are allowed.<br>";
				 }
			 
			 
			}else{
			  $log=$log."Your file types: ".$extension.". Sorry, only ".$file_default_type_overwrite." type files are allowed.<br>";
			   $uploadNot++;	
			}  
		 
			if ( $uploadNot>0) {
			$log=$log."Sorry, your file was not uploaded.<br>";
			$file_related='2';
			} else {  $filename = $_FILES["file"]["name"][$i];
				  // Check File already exists
				  if (file_exists(trim($default_src).$filename)  && $filename!='') {
				    $file_related='2';
					$log=$log."But File already exists";
				 } else {
				    $file_related='1';
					
					if($filename!=''){
						move_uploaded_file($_FILES["file"]["tmp_name"][$i],
						trim($default_src).$file_prefix.'-'.$filename);
						$this_file_name=$_FILES["file"]["name"][$i]; if(strlen($this_file_name)>22){$this_file_name=substr($this_file_name,0,22).'....';}
						$log=$log."File Size: ".$now_file_size."Kb <br> File Type: ".$extension." <br> File Name: ".$this_file_name;
					}
				 }
		    }
			}
	 }	 
	 $sl++;
}
}

 
		
//database


if($file_related=='0' || $file_related=='1'){
	
	
	if($crud_action=='insert'){
		$t_id_value='';
	}

	IF($t_id_value !=''){
	  $query = "UPDATE ".$table_name." SET";
	  
	  $ids_string_array=explode(',',$ids_string_update);
	  $data_string_array=explode('\',',$data_string);
	  //$data_string_array2=explode('#',$data_string2);
	  
	  $x=0;
	  $check='';
	  foreach($ids_string_array as $ids_string_array_single){
	 // $check=$check.' '.$data_string_array2[$x];
	  $query =$query.$ids_string_array_single.'='.$data_string_array[$x].'\', '; 
	  $x++;
	  }
			//for update get previous files
							$qry="select * from ".$table_name."  where  ".$t_id_name."= '".$t_id_value."'";
							$result=mysqli_query($conn,$qry);
							$rowcount=mysqli_num_rows($result);
							$row = mysqli_fetch_all($result,MYSQLI_ASSOC);
							$file_x=$row[0][$id_string2];
							$file_x_array=explode(',',$file_x);
			
	        $query =substr($query, 0, -3);
	        $query =$query. " where ".$t_id_name." = '".$t_id_value."'";
			
	   /*$rr=str_replace("'",'?',$query);
      	$queryx="INSERT INTO 1test (`value1`) VALUES ('$rr')";
		try{$resultx=mysqli_query($connect,$queryx);if($resultx){if(mysqli_affected_rows($connect) > 0){}else{}}} catch (Exception $ex) {}  */

			
	        try{$update_Result = mysqli_query($connect, $query);if($update_Result){
              if(mysqli_affected_rows($connect) > 0){$say_code='1'; $say='Data Update Successfully'; }else{$say_code='0'; $say='Nothing Change';}
            }else{
            $say_code='0'; $say='Update Fails with '.str_replace("'",'',mysqli_error($connect));
            }
               } catch (Exception $ex) { }		
      
      

 
							$qry="select * from ".$table_name."  where  ".$t_id_name."= '".$t_id_value."'";
							$result=mysqli_query($conn,$qry);
							$rowcount=mysqli_num_rows($result);
							$row = mysqli_fetch_all($result,MYSQLI_ASSOC);
							 $file_x2=$row[0][$id_string2];	 
							$file_x2_array=explode(',',$file_x2);
							
							//special
							if($table_name=='tbl_users'){$new_join=$file_x2_array; }else{$new_join=array_unique(array_merge($file_x_array,$file_x2_array), SORT_REGULAR);}
							
							$new_join_string=implode(',',$new_join); $g_f=substr($new_join_string,0,1); if($g_f==','){$new_join_string = substr($new_join_string, 1);}
					$cv=	$query = "UPDATE  ".$table_name."  set  ".$id_string2." = '".$new_join_string."' where  ".$t_id_name."= '".$t_id_value."'";
						try{$update_Result = mysqli_query($connect, $query);if($update_Result){if(mysqli_affected_rows($connect) > 0){$say_code2='1'; $say2='Data Update Successfully'; }else{$say_code1='0'; $say1='Update Fails.'.mysqli_error($connect);}}} catch (Exception $ex) { }						
								
	  //query
   /*$queryx="INSERT INTO 1test (value) VALUES ('$new_join_string')";
  try{$result=mysqli_query($connect,$queryx);if($result){if(mysqli_affected_rows($connect) > 0){}else{}}} catch (Exception $ex) {}*/
   						
	 
	}ELSE {
	
	
	
     $query="INSERT INTO ".$table_name." (".$ids_string.") VALUES (".$data_string.")";
	 try{$result=mysqli_query($connect,$query);if($result){if(mysqli_affected_rows($connect) > 0){
	 $say_code='1'; $say='Data Insert Successfully'; }else{$say_code='0'; $say='Insert Fails';}}
        
     } catch (Exception $ex) {}
      
      
     if(mysqli_error($connect)){
	//.str_replace('"','', $query)
     $say_code='0'; $say='Insert Fails with '.str_replace("'",'',mysqli_error($connect));
     } 
     
 
   
	}


  

	if($say==''){
		$say='Insert Fail! Some data maybe unique';
	}
	
}else {
	$say_code='0'; $say='File Upload Fails';
}	



//special Emails
if($table_name=='email_documents'){
	
	
 
	$dd=explode("',",$data_string);
	
	
	$ii=explode("',",$ids_string);	
 
 
	$from=str_replace("'","",$dd[0]);
	$to=str_replace("'","",$dd[1]); 
	$sub=str_replace("'","",$dd[2]); 
	$msg=str_replace("'","",$dd[3]); 
	
	///if(str_replace("'","",$ii[4])=='files') {
		$files=str_replace("'","",$dd[4]);
	//}
				
		        $query1="select * from email_system WHERE email_system_id='$from'";
				$result1=mysqli_query($connect,$query1);   $rowcount1=mysqli_num_rows($result1); $row1 = mysqli_fetch_all($result1,MYSQLI_ASSOC);
			
		    	for($j=$rowcount1-1;$j>=0;$j--)
				{  
    			    $Username=$row1[$j]['email_system'];
    			    $setFrom=$row1[$j]['setFrom'];
    			    $replyTo=$row1[$j]['replyTo'];
    			    $title=$row1[$j]['title'];
    			    $password=$row1[$j]['password']; 
				}
  
  
  
            $url = "http://engineersconsortiumltd.com.bd/mailer/api_send.php";   
            $ch = curl_init($url);
            $data = array(
                        'email' => $to,
                        'message' => $msg,
                        'subject' => $sub,
                        'files' => $files,
             			'title' => $title,
             			'Username' => $Username,
                        'setFrom' => $setFrom,
                        'replyTo' => $replyTo,
                        'password' => $password,
                        'from' => $from
            );
            // echo '<script>console.log(\''.$data.'\');</script>';
            $payload = json_encode(array("user" => $data));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);

            $response = json_decode($result, true); 
  			$count_to=explode(',',$to);
            $say=count($count_to)." Email Send Successfully";
}
 
 $y='{ "say":"'.$say.'", "say_code":"'.$say_code.'"';


 

	
 
  
 
	
//special > Role List

if($table_name=='tbl_users_userType'){
	//submenue
	$submenue=$setting_holder['submenu_items'];
	
	//role list
	$query1="select * from tbl_users_userType where is_key='1'";
	$result1=mysqli_query($connect,$query1); $rowcount1=mysqli_num_rows($result1); 
	$row1 = mysqli_fetch_all($result1,MYSQLI_ASSOC);
	for($j=$rowcount1-1;$j>=0;$j--)
	{  
			$userType=$row1[$j]['userType_id'];

			//role list
			$query1x="select * from tbl_users_submenu where is_key='1'";
			$result1x=mysqli_query($connect,$query1x); $rowcount1x=mysqli_num_rows($result1x); 
			$row1x = mysqli_fetch_all($result1x,MYSQLI_ASSOC);
			for($jx=$rowcount1x-1;$jx>=0;$jx--)
			{  
					$submenu_id=$row1x[$jx]['submenu_id'];
					
					//check present
					$query1xy="select * from tbl_users_permission where userType='$userType' and  tables='$submenu_id' ";
					$result1xy=mysqli_query($connect,$query1xy); $rowcount1xy=mysqli_num_rows($result1xy); 					
					if($rowcount1xy>0){}else{
										$query="INSERT INTO tbl_users_permission (userType,tables) VALUES ('$userType','$submenu_id')";
										try{$result=mysqli_query($connect,$query);if($result){if(mysqli_affected_rows($connect) > 0){   }else{  }}} catch (Exception $ex) {}
					
					}
					

			}
	}	
 	
	
 
}
	

 //Notification
 
 					//check present
				 $msg=$say.' at '.$table_name.' : <b>'.$userName.'</b>';
 
				$query="INSERT INTO tbl_users_notification (userID,message,created) VALUES ('$userID','$msg','$created')";
				try{$result=mysqli_query($connect,$query);if($result){if(mysqli_affected_rows($connect) > 0){   }else{  }}} catch (Exception $ex) {}
 


 echo $y=$y.', "log":"'.$log.'", "noti":"'.$userName.'~*'.$say.'~*'.$table_name.'~*'.$created.'"}';	