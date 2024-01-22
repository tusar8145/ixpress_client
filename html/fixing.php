 <?php
 include('config.php');
 echo $connect;
 
		$sql = "DELETE FROM tbl_users  WHERE `userID`=1";
 
		if(mysqli_query($connect,$sql)){
			echo 1;
		} else {
			 echo 2;
		}
		
		
		
		 	/*$query="INSERT INTO `tbl_users` (`userID`, `userName`, `access_client`, `branch_code`, `userPass`, `firstName`, `lastName`, `address`, `userEmail`, `userPhone`, `mobile`, `userType`, `create_date`, `is_key`, `tokenCode`, `image`, `modified`, `creator`, `modifier`, `created`, `tender_books`, `tbl_users_userStatus`, `branch_id`, `userStatus`, `files`, `zone_districts_id`, `employee_id`) VALUES
(1, 'Admin', '', 'IXPDH00', 'fb1509cf8c69e2b08b377dcf61bbdb84', 'Administrator', '', 'Dhaka', 'admin@ixpressbd.com', '01730310833', '356546345', 1, 3243178, 1, '6c57a2a181f8c381003ee364defb62de', '3008608687-pro.jpg', 'April 11, 2023, 9:21 pm', NULL, '1', NULL, NULL, 'Y', '75', NULL, NULL, 1, '1095')";
	try{$result=mysqli_query($connect,$query);if($result){if(mysqli_affected_rows($connect) > 0){$say='Insert Successful'; }else{$say='Insert Fails';}}} catch (Exception $ex) {}
*/