 

    

<?php


		$book=$_POST[book];  //contact_id

		$user=$_POST[user]; //is_key


		include('../config.php');

if($book>0){
		    $query = "UPDATE tbl_users SET tender_books='$book'  WHERE userID='$user' ";
		try{$update_Result = mysqli_query($connect, $query);if($update_Result){if(mysqli_affected_rows($connect) > 0){$say='Set Default Successful'; }else{$say='Set Default  Fail';}}} catch (Exception $ex) { }						

	
}else{
		    $query = "UPDATE tbl_users SET tender_books=''  WHERE userID='$user' ";
		try{$update_Result = mysqli_query($connect, $query);if($update_Result){if(mysqli_affected_rows($connect) > 0){$say='Clear Default  Successful'; }else{$say='Clear Default  Fail';}}} catch (Exception $ex) { }						

	
}

echo $say;