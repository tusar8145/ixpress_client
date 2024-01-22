<?php
			$docId=$_POST[docId]; //int
			$vv=$userId=$_POST[userId]; //int 
			$contents=$_POST[contents];  	 
			$cat=$_POST[cat];  	 
			include('../config.php');
			$contents=addslashes($contents);
			
			$d1 = new DateTime('now', new DateTimezone('Asia/Dhaka')); $created=$modified=$d1->format('F j, Y, g:i a'); $t_details=$d1->format('d-m-y, h:i'); $date=$d1->format('Y-m-d');   $month=$d1->format('F');   $year=$d1->format('Y');  
			
		$query = "UPDATE 	tender_documents   SET modified='$created',modifier='$vv',details='$contents',book='read'   WHERE tender_documents_id='$docId' ";
		try{$update_Result = mysqli_query($connect, $query);if($update_Result){if(mysqli_affected_rows($connect) > 0){$say='Update Successful'; 
		
	
		if($cat !='2'){
				$query="INSERT INTO tender_change (created,creator,tender_documents,details) VALUES ('$created','$vv','$docId','$contents')";
			try{$result=mysqli_query($connect,$query);if($result){if(mysqli_affected_rows($connect) > 0){//$say='Insert Successful';
			}else{//$say2='Insert Fails'; 
			}}} catch (Exception $ex) {}
			//if($say!='Insert Successful'){$say2='Please input another name'; }    
					
		}

		
		}else{$say='Update Fail';}}} catch (Exception $ex) { }						

 echo $say;