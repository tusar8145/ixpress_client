<?php
		include('config.php');
		
		//Today
		$d1 = new DateTime('now', new DateTimezone('Asia/Dhaka')); $d1=$d1->format('d-m-Y');
		
						$query="select * from notifications WHERE is_key='1' AND is_done='No'";
						$result=mysqli_query($connect,$query);  $rowcount=mysqli_num_rows($result); $row = mysqli_fetch_all($result,MYSQLI_ASSOC);
						for($i=$rowcount-1;$i>=0;$i--)
						{  
							$notifications_id=$row[$i]['notifications_id'];		
							$notifications=$row[$i]['notifications'];		
							$src=$row[$i]['src'];		
							$date_from=$row[$i]['date_from'];		
							$mail_to=$row[$i]['mail_to'];		
							$totalnoti=$row[$i]['totalnoti'];		
							$intervals=$row[$i]['intervals'];		
							$date_before=$row[$i]['date_before'];		
							$count_noti=$row[$i]['count_noti'];		
							$count_noti2=$count_noti+1;		
							$sub=$row[$i]['sub'];		
 
							//check is done
							if($count_noti==$totalnoti){
								$is_done='Yes';
								} else {
								$is_done='No';
								}
   
						//check
						$query1="select * from ".$src;
						$result1=mysqli_query($connect,$query1);   $rowcount1=mysqli_num_rows($result1); $row1 = mysqli_fetch_all($result1,MYSQLI_ASSOC);
						for($j=$rowcount1-1;$j>=0;$j--)
						{ 
							$data=$row1[$j][$src];
							$data2=$row1[$j][$date_from];  //expired date
							
							
							$notifications=str_replace($src,$data,$notifications);
							$notifications=str_replace($date_from,$data2,$notifications);
							$notifications=str_replace('{{','<b>',$notifications);
							$notifications=str_replace('}}','</b>',$notifications);
							
							
						//echo	$newDate = date("d-m-Y", strtotime($data2));  
									$temp=($count_noti*$intervals)+$date_before;  //echo '-';
							$today_date_should=date('d-m-Y', strtotime($newDate. ' + '.$temp.' days'));
							$expired_date_should=date('d-m-Y', strtotime($data2));
							
							if($today_date_should==$expired_date_should){
										//send notifications
										
										$mail_to_array=explode(',',$mail_to);
										
										foreach($mail_to_array as $mail_to_array_single){
													// API URL
														$url = "https://engineersconsortiumltd.com.bd/mailer/index.php";   
														$ch = curl_init($url);
														$data = array(
																	'email' => $mail_to_array_single,
																	'message' => $notifications,
																	'subject'   => $sub
														);
														$payload = json_encode(array("user" => $data));
														curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
														curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
														curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
														$result = curl_exec($ch);

														// Close cURL resource
														curl_close($ch);
											
										}
										
										
										
										
										
										//update table
											echo    $query = "UPDATE notifications SET count_noti='$count_noti2', is_done='$is_done'   WHERE notifications_id='$notifications_id' ";
												try{$update_Result = mysqli_query($connect, $query);if($update_Result){if(mysqli_affected_rows($connect) > 0){$say='Update Successful'; }else{$say='Update Fail';}}} catch (Exception $ex) { }						

										
								}
						echo $today_date_should.'-';
						echo $expired_date_should;		
						echo '</br>';
						}
 
 
 
						} 
						
						
