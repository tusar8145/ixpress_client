<?php

     $doc_id=$_GET['doc'];
	$user=$_GET['user'];
		include('config.php');
		
	 $query = "UPDATE 	tbl_users   SET tender_books='$doc_id' 
	 WHERE userID='$user' ";
try{$update_Result = mysqli_query($connect, $query);if($update_Result){if(mysqli_affected_rows($connect) > 0)
{$say='Update Successful'; 
 
	}else{$say='Update Fail';}}} catch (Exception $ex) { }	
	
	echo '<script> //window.close();
	window.location.href = "https://engineersconsortiumltd.com.bd/admin/index.php#tender_documents";
	
	</script>'; 