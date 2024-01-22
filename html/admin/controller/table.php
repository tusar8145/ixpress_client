<?php
	
		include('../config.php');
		include('../configuration.php');
		
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
	    $books=$row['tender_books'];
	    $userName=$row['userName'];
	    $userType=$row['userType'];
	    $userImage=$row['image'];
		$is_key=$row['is_key'];
			
	 
			
	
if($userName ==''){ echo '<script> window.location = '.$parent_base_url.'"/login/"; </script>';}
if($is_key =='0'){ echo '<script> window.location = '.$parent_base_url.'"/login/"; </script>';}

		$th=$_POST['th'];
		$table_info=$_POST['table_info'];
		$table_request=$_POST['table_request'];
		$td=$_POST['td'];
		$table_place=$_POST['table_place'];
		$t_sl=$_POST['_t_sl'];
		$table_functions=$_POST['table_functions'];
		$export_title=$_POST['export_title'];

		$table_info_expand=explode('#',$table_info);
		$t_name_=$table_info_expand[0];
		$t_name=explode('@',$t_name_)[0];
		$t_class=explode('@',$t_name_)[1];
		
		$t_id_name=$table_info_expand[1];
		

		$t_order=explode('@',$table_info_expand[2])[0];
		$t_order_column=explode('@',$table_info_expand[2])[1];	
		 
		$this_user_id=$table_info_expand[3];
		$have_where=$table_info_expand[4];
		$have_where2=$table_info_expand[5];
				
				
		if($table_functions !=''){
			$table_functions_array=explode(',',$table_functions);
			foreach($table_functions_array as $table_functions_single){
				$table_functions_single_array=explode('@',$table_functions_single);
				if($table_functions_single_array[0]=='this_function'){
				$this_function=$table_functions_single_array[1];
					}else {
						foreach($table_functions_single_array as $table_functions_single_array_each){
							if($table_functions_single_array_each=='multiselect'){$multiselect='1';}
							if($table_functions_single_array_each=='button_delete'){$button_delete='1';}
							if($table_functions_single_array_each=='button_mark_as_seen'){$button_mark_as_seen='1';}
						}						
					}

			}					
		}
		
		
					//	 if($t_name!='tender')
					//	{		
							 if($books!='' && ($t_name=='tender_documents' ||  $t_name=='certificate_books' ||  $t_name=='tender' ||  $t_name=='tender_rfp_documents'))	{	
							  $query2="select * from tender_books WHERE tender_books_id='$books'";
								 $result2=mysqli_query($connect,$query2);  
								$rowcount2=mysqli_num_rows($result2); 
								$row2 = mysqli_fetch_all($result2,MYSQLI_ASSOC); 
								$tender_books=$row2[0]['tender_books'];	 
								}	 
					//	}
	
				
		if($t_sl=='1'){
?>
<div class="card <?php echo $t_class; 

   

?>">
		<div class="card-header"style="  padding: 5px 0px 2px 0px;  text-align: center;">
			<p id="table_title" class=" "style="margin-bottom: 0; font-size: 14px; font-weight: bold;"><?php  if($tender_books!=''){echo $tender_books.' / '; } echo $export_title;?></p>
		</div>
		<div class="card-body pt-0">
			<h4 id="currentPage" class="currentPage" > </h4>
			<table id="<?php echo str_replace("#","",$table_place).'_'; ?>" class="table table-hover responsive     " style="width:100%">
				<thead>
				<tr>
				<?php 
				

				if($have_where !=''){$this_user_id_value=$this_user_id;}
				
 
				$th_1st=explode('@',$th);
				$th_all=explode(',',$th_1st[0]);
				$con=0;
				foreach($th_all as $th_all_single){
						$all_th_slide=explode('#',$th_all_single);
						
						
						
						if($con==0){
							if($t_id_name=='i_packaging_type_id' || $t_id_name=='i_product_type_id' || $t_id_name=='i_payment_type_id'){
								$th_here="ID";
								}else{
								$th_here="SL";
								}
							$con++;
						}else{
						$th_here=$all_th_slide[0];
						}

						
						echo '<th class="'.$th_1st[1].' '.$all_th_slide[1].'">'.$th_here.'</th>';
				}				
				

				?>
				</tr>
				</thead>
				<tbody>
						<?php	 	$sl=1;	 
						if($t_order_column!=''){
						$order_by=$t_order_column;}else{
							$order_by=$t_id_name;
						}
						    
							
						$qry="select * from ".$t_name." ".$have_where.$this_user_id_value."  ".$have_where2." order by ".$order_by." ".$t_order;
						
						 if(($t_name=='tender_documents'  || $t_name=='certificate_books'  || $t_name=='tender'  || $t_name=='tender_rfp_documents') && $books!='')
						{
					 
							 if($this_user_id_value !='' && $have_where !=''){
								 $qry="select * from ".$t_name." ".$have_where.$this_user_id_value."  ".$have_where2.") and tender_books='$books' order by ".$order_by." ".$t_order;
								 $qry=str_replace('where','where(',$qry);
							 }else {
								$qry="select * from ".$t_name." where tender_books='$books' order by ".$order_by." ".$t_order;
							}
					 		 
						} 
 //echo $qry;
$c_tr_id='';
						$result=mysqli_query($conn,$qry);
							$rowcount=mysqli_num_rows($result);
							$row = mysqli_fetch_all($result,MYSQLI_ASSOC); 
							for($i=0;$i<$rowcount;$i++)
							{
 
 
			$row[$i]['memo']='S'.$row[$i][$t_id_name].str_replace('-','',$row[$i]['date']);
   				
								$c_tr_id='d'.$row[$i][$t_id_name];
								if($sl==1){ $ftable_row='d'.$row[$i][$t_id_name]; }
								echo '<tr style="  " id="d'.$row[$i][$t_id_name].'" >
								<td>';
								
								if($multiselect=='1'){
								$sl_here=$sl;
								
								if($t_id_name=='i_packaging_type_id' || $t_id_name=='i_product_type_id' || $t_id_name=='i_payment_type_id'){
									$sl_here=$row[$i][$t_id_name];
								}
								
								echo '
								<div class="form-check" style="cursor: pointer;" >
								<input style="cursor: pointer;" class="checked form-check-input" type="checkbox" id="flexCheckDefault'.$sl.'"   name="'.str_replace("#","",$table_place).'[]'.'" value="'.$row[$i][$t_id_name].'" />
								<label style="cursor: pointer;" class="form-check-label" for="flexCheckDefault'.$sl.'"> '.$sl_here.'
								</label>
								</div>	
									
									
									';}else {
									echo $sl;
									
									}
								echo '</td>';
					
								$td_each=explode(',',$td);
							$t_co=0; 
							foreach($td_each as $td_each_single)
							{
							$td_each_forclass=explode('@',$td_each_single);
							$css=explode('*',explode('<',$td_each_forclass[1])[1])[0];
							$class=explode('*',explode('[',$td_each_forclass[1])[1])[0];
							$subtract_value=explode('!',explode('_',$td_each_forclass[1])[1])[0];
		
							if($t_co==0){ echo '<td  onclick="'.$this_function.'(\'\',\'\',\'3\',\''.$row[$i][$t_id_name].'\')" style="'.$css.'; '.$color.'; cursor: pointer;" class=" '.$th_1st[1].' '.$class.' ">'; }else{echo '<td  style="'.$css.'" class=" '.$th_1st[1].' '.$class.' ">'; }
							$t_co++;
							   $td_each_forMultiple=explode('+',$td_each_forclass[0]);
							  
								foreach($td_each_forMultiple as $td_each_forMultiple_single)
								{ 	
									//button
									if(substr(trim($td_each_forMultiple_single),0,1)=='_'){
									   
									   if(trim($td_each_forMultiple_single)=='_edit_1'){
											echo '<button   onclick="'.$this_function.'(\'\',\'\',\'1\',\''.$row[$i][$t_id_name].'\')"   class="btn p-0 ms-2"   data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete" style="opacity: .6; "> <svg class="svg-inline--fa fa-edit fa-w-18 text-900 fs-3" aria-hidden="true" focusable="false" data-prefix="far" data-icon="edit" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M402.3 344.9l32-32c5-5 13.7-1.5 13.7 5.7V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V112c0-26.5 21.5-48 48-48h273.5c7.1 0 10.7 8.6 5.7 13.7l-32 32c-1.5 1.5-3.5 2.3-5.7 2.3H48v352h352V350.5c0-2.1.8-4.1 2.3-5.6zm156.6-201.8L296.3 405.7l-90.4 10c-26.2 2.9-48.5-19.2-45.6-45.6l10-90.4L432.9 17.1c22.9-22.9 59.9-22.9 82.7 0l43.2 43.2c22.9 22.9 22.9 60 .1 82.8zM460.1 174L402 115.9 216.2 301.8l-7.3 65.3 65.3-7.3L460.1 174zm64.8-79.7l-43.2-43.2c-4.1-4.1-10.8-4.1-14.8 0L436 82l58.1 58.1 30.9-30.9c4-4.2 4-10.8-.1-14.9z"></path></svg>
											</button>';
											echo '<button   onclick="'.$this_function.'(\'\',\'\',\'3\',\''.$row[$i][$t_id_name].'\')"   class="d-none btn p-0 ms-2"   data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete" style="opacity: .6; "> <svg class="svg-inline--fa fa-eye fa-w-18 text-900 fs-3" aria-hidden="true" focusable="false" data-prefix="far" data-icon="eye" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M288 144a110.94 110.94 0 0 0-31.24 5 55.4 55.4 0 0 1 7.24 27 56 56 0 0 1-56 56 55.4 55.4 0 0 1-27-7.24A111.71 111.71 0 1 0 288 144zm284.52 97.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400c-98.65 0-189.09-55-237.93-144C98.91 167 189.34 112 288 112s189.09 55 237.93 144C477.1 345 386.66 400 288 400z"></path></svg>
											</button>';
										   }		
										   
									   if(trim($td_each_forMultiple_single)=='_edit_able'){
									   
									   $approved_edit_restrict=0;
										   $have_final_status=$row[$i]['final_status'];
										   
										   if($have_final_status != ''){
										   if(($have_final_status=='<span class="badge me-1 py-2 badge-soft-danger" style="padding: 3px !important;background: #831212c7;color: white;">Cancel</span>') || ($have_final_status=='<span class="badge me-1 py-2 badge-soft-danger" style="padding: 3px !important;background: #27bcfd;margin: 2px !important;color: white;">Approved</span>')  ||  ($have_final_status=='<span class="badge me-1 py-2 badge-soft-danger" style="padding: 3px !important;background: #25bb1bc7;margin: 2px !important;color: white;">Completed</span>')){
										      $approved_edit_restrict=1;
										   }
										   }
									   
									   
									   $have_edit_permission=$row[$i]['is_editable'];
									   
									   $have_creator=$row[$i]['creator'];
									   $have_usertype=$row[$i]['creator'];
									   
									   $view_edit=1;
									   $have_modifiers=$row[$i]['access_by'];
									   $have_accessable=$row[$i]['accessable'];
									   
									   
									   if($have_accessable=='Modifiers'){
									   $view_edit=0; 
									  
									   
									   $people = explode(',',$have_modifiers);
									   if (in_array($userID, $people)) { $view_edit=1; } else  { $view_edit=0; } if($have_creator==$userID)	  {$view_edit=1;} } 
									   
									   
									   if($have_accessable=='Public'){ $view_edit=1; $have_edit_permission=1;} //new added
									   
									   
									   if($approved_edit_restrict==0){
									   if($view_edit==1){
									   if($have_edit_permission=='1' || $have_creator==$userID || $userType=='1'){
											echo '<button   onclick="'.$this_function.'(\'\',\'\',\'1\',\''.$row[$i][$t_id_name].'\')"   class="btn p-0 ms-2"   data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete" style="opacity: .6; "> <svg class="svg-inline--fa fa-edit fa-w-18 text-900 fs-3" aria-hidden="true" focusable="false" data-prefix="far" data-icon="edit" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M402.3 344.9l32-32c5-5 13.7-1.5 13.7 5.7V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V112c0-26.5 21.5-48 48-48h273.5c7.1 0 10.7 8.6 5.7 13.7l-32 32c-1.5 1.5-3.5 2.3-5.7 2.3H48v352h352V350.5c0-2.1.8-4.1 2.3-5.6zm156.6-201.8L296.3 405.7l-90.4 10c-26.2 2.9-48.5-19.2-45.6-45.6l10-90.4L432.9 17.1c22.9-22.9 59.9-22.9 82.7 0l43.2 43.2c22.9 22.9 22.9 60 .1 82.8zM460.1 174L402 115.9 216.2 301.8l-7.3 65.3 65.3-7.3L460.1 174zm64.8-79.7l-43.2-43.2c-4.1-4.1-10.8-4.1-14.8 0L436 82l58.1 58.1 30.9-30.9c4-4.2 4-10.8-.1-14.9z"></path></svg>
											</button>';
											echo '<button   onclick="'.$this_function.'(\'\',\'\',\'3\',\''.$row[$i][$t_id_name].'\')"   class="d-none btn p-0 ms-2"   data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete" style="opacity: .6; "> <svg class="svg-inline--fa fa-eye fa-w-18 text-900 fs-3" aria-hidden="true" focusable="false" data-prefix="far" data-icon="eye" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M288 144a110.94 110.94 0 0 0-31.24 5 55.4 55.4 0 0 1 7.24 27 56 56 0 0 1-56 56 55.4 55.4 0 0 1-27-7.24A111.71 111.71 0 1 0 288 144zm284.52 97.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400c-98.65 0-189.09-55-237.93-144C98.91 167 189.34 112 288 112s189.09 55 237.93 144C477.1 345 386.66 400 288 400z"></path></svg>
											</button>';
										  } 
									   }
									   }
									   }
										   
									   if(trim($td_each_forMultiple_single)=='_email_1'){
											echo ' <a href="email_send.php?ad='.$row[$i]["email"].'"  >
												<button class="btn p-0" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Reply" aria-label="Edit">
													<svg class="svg-inline--fa fa-edit fa-w-18 text-500" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="edit" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z"></path></svg>
												</button>
											</a> ';
											
										   }
									   if(trim($td_each_forMultiple_single)=='_newtab_1'){
											echo ' <a target="_blank" Title="View Documents" href="'.$base_url.'/admin/documents.php?doc='.$row[$i][$t_id_name].'&user='.$userID.'"  >
												<button class="btn p-0" style="opacity:.6" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Reply" aria-label="Edit">
<svg class="svg-inline--fa fa-paper-plane fa-w-8 text-900 fs-3" aria-hidden="true" focusable="false" data-prefix="far" data-icon="paper-plane" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M440 6.5L24 246.4c-34.4 19.9-31.1 70.8 5.7 85.9L144 379.6V464c0 46.4 59.2 65.5 86.6 28.6l43.8-59.1 111.9 46.2c5.9 2.4 12.1 3.6 18.3 3.6 8.2 0 16.3-2.1 23.6-6.2 12.8-7.2 21.6-20 23.9-34.5l59.4-387.2c6.1-40.1-36.9-68.8-71.5-48.9zM192 464v-64.6l36.6 15.1L192 464zm212.6-28.7l-153.8-63.5L391 169.5c10.7-15.5-9.5-33.5-23.7-21.2L155.8 332.6 48 288 464 48l-59.4 387.3z"></path></svg>												</button>
											</a> ';
											
										   }	

									   if(trim($td_each_forMultiple_single)=='_newtab_2'){
											echo '  
												<button onclick="pin_project(\''.$row[$i][$t_id_name].'\' ,\''.$userID.'\')"  class="btn p-0" style="margin-left:15px;opacity:.6;color:green;" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Set Default" data-bs-original-title="Reply" aria-label="Edit">
												Set Default				
												</button>
  
						 
												<button onclick="pin_project(\'?\' ,\''.$userID.'\')" class="btn" style="margin-left:10px;opacity:.6;color:red;" type="button">
												Clear Default						
												</button>
												
												<a target="_blank"  href="'.$full_domain_path.'/admin/FileManager/projects/index.php?project='.$row[$i][$t_id_name].'&&user='.$userID.'&&name='.$row[$i][$t_name].'">
												<button  class="btn" style="margin-left:10px;opacity:.6;color:gray;" type="button">
												File Manager			
												</button>
												</a>
											';
											
										   }	
										   
									   if(trim($td_each_forMultiple_single)=='_delete_1'){
									   $have_edit_permission=$row[$i]['is_editable'];
									   
									   $have_creator=$row[$i]['creator'];
									   $have_usertype=$row[$i]['creator'];
									   
									   if($have_edit_permission=='1' || $have_creator==$userID || $userType=='1'){
											echo '<button   onclick="deleteme(\''.$row[$i][$t_id_name].'\','.'\''.$t_name.'\''.','.'\''.$t_id_name.'\''.','.'\'0\''.','.'\'1\''.')"   class="btn p-0 ms-2"   data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete"><svg class="svg-inline--fa fa-trash-alt fa-w-14 text-500" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M32 464a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128H32zm272-256a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zM432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16z"></path></svg>
											</button>';
									   
										   }
									   } 
									   
									   if(trim($td_each_forMultiple_single)=='_completed'){
										   echo ' <button   onclick="approved(\''.$row[$i][$t_id_name].'\','.'\''.$t_name.'\''.','.'\''.$t_id_name.'\''.','.'\'0\''.','.'\'3\''.')"   class="btn p-0 ms-2 btn-success"   data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete">
Completed	</button> ';
									   }
									   
									   if(trim($td_each_forMultiple_single)=='_approved'){
										   echo ' <button   onclick="approved(\''.$row[$i][$t_id_name].'\','.'\''.$t_name.'\''.','.'\''.$t_id_name.'\''.','.'\'0\''.','.'\'1\''.')"   class="btn p-0 ms-2 btn-primary"   data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete">
Approved	</button> ';
									   }									   
									   
									   
									   if(trim($td_each_forMultiple_single)=='_clear'){
										   echo ' <button   onclick="approved(\''.$row[$i][$t_id_name].'\','.'\''.$t_name.'\''.','.'\''.$t_id_name.'\''.','.'\'0\''.','.'\'5\''.')"   class="btn p-0 ms-2 btn-default"   data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete">
Clear Status	</button> ';
									   }
									   
									   
										   if(trim($td_each_forMultiple_single)=='_cancel'){
										   echo ' 
										   
										   
										   <textarea class="d-none " name="cancel_note'.$row[$i][$t_id_name].'" id="cancel_note'.$row[$i][$t_id_name].'"   rows="1" cols="20"></textarea>
										   
										   
										   
										   <button   onclick="approved(\''.$row[$i][$t_id_name].'\','.'\''.$t_name.'\''.','.'\''.$t_id_name.'\''.','.'\'0\''.','.'\'2\''.')"   class="btn p-0 ms-2 btn-danger"   data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete">
 Cancel	 </button> ';
									   }								   
									   
										   
										   
									   if(trim($td_each_forMultiple_single)=='_delete_able'){
										   $approved_edit_restrict=0;
										   $have_final_status=$row[$i]['final_status'];
										   



										   
										   if($have_final_status != ''){
										   if(($have_final_status=='<span class="badge me-1 py-2 badge-soft-danger" style="padding: 3px !important;background: #831212c7;color: white;">Cancel</span>') || ($have_final_status=='<span class="badge me-1 py-2 badge-soft-danger" style="padding: 3px !important;background: #27bcfd;margin: 2px !important;color: white;">Approved</span>')  ||  ($have_final_status=='<span class="badge me-1 py-2 badge-soft-danger" style="padding: 3px !important;background: #25bb1bc7;margin: 2px !important;color: white;">Completed</span>')){
										      $approved_edit_restrict=1;
										   }
										   }
										   
										   $view_edit=1;
										   $have_modifiers=$row[$i]['access_by'];
										   $have_creator=$row[$i]['creator'];
										   $have_accessable=$row[$i]['accessable'];
										   if($have_accessable=='Modifiers'){
										   $view_edit=0; 
										   $people = explode(',',$have_modifiers);
										   if (in_array($userID, $people)) { $view_edit=1; } else  { $view_edit=0; } if($have_creator==$userID)	  {$view_edit=1;} } 
										   
										    
										   if($approved_edit_restrict==0){
										   if($view_edit==1){
											   echo '<button   onclick="deleteme(\''.$row[$i][$t_id_name].'\','.'\''.$t_name.'\''.','.'\''.$t_id_name.'\''.','.'\'0\''.','.'\'1\''.')"   class="btn p-0 ms-2"   data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete"><svg class="svg-inline--fa fa-trash-alt fa-w-14 text-500" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M32 464a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128H32zm272-256a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zM432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16z"></path></svg></button>';
										   }else{
											  echo ' <span class="badge me-1 py-2 badge-soft-danger">No Access</span> '; 
										   }
										   }else{
											    echo ' <span class="badge me-1 py-2 badge-soft-danger">No Access</span> '; 
										   }	
									   }
									    
									   
										$td_each_forMultiple_single_main=explode('{',$td_each_forMultiple_single)[0];
									   
									   if(trim($td_each_forMultiple_single_main)=='_mark_1'){
										$td_each_forMultiple_single_id=explode('}',explode('{',$td_each_forMultiple_single)[1])[0];
									
										if($td_each_forMultiple_single_id==''){
										$td_each_forMultiple_single_id='is_key';
										$c_switch=$row[$i][$td_each_forMultiple_single_id];
										if($c_switch=='1'){$checkedchecked='checked';  } else {$checkedchecked='no';}
										}else {
										$c_switch=$row[$i][$td_each_forMultiple_single_id];
										if($c_switch=='1'){$checkedchecked='checked';  } else {$checkedchecked='no';}
										}										   
										?>
										 <div class="form-check form-switch">
											 <input  class="form-check-input ms-0 radi" type="checkbox"  id="change_switch1" onclick="mark('<?php echo $row[$i][$t_id_name];?>','<?php echo $t_name; ?>','<?php echo $t_id_name; ?>','<?php echo $td_each_forMultiple_single_id; ?>','','1')"  value="1" <?php if($c_switch==1){ ?>  checked="checked"<?php }?>  name="change_switch1"  <?php echo $checkedchecked; ?> >
										</div>									   
										 <?php  }		   
									
									}else{
									//none button
										$separate_label=explode('#',$td_each_forMultiple_single);
											 $field=trim($separate_label[0]);
											$_other_part_field=$separate_label[1];
											
											$image_line=explode('*',explode('~!',$_other_part_field)[1])[0];
											$image_view=explode('*',explode('!~',$_other_part_field)[1])[0];
											$image_css=explode('*',explode('!<',$_other_part_field)[1])[0];
											
											$label=explode('*',explode('|',$_other_part_field)[1])[0];
											$new_table=explode('**',explode('&',$_other_part_field)[1])[0];
									        $new_table_id_name=explode('}',explode('{',$_other_part_field)[1])[0];
									        $need_to_show=explode(']',explode('[',$_other_part_field)[1])[0];
											$function=explode('*',explode('(',$_other_part_field)[1])[0];
											
											
											//website seting
											if($src ==''){
												$src=explode('src=',$row[$i][$field])[1];  $src=str_replace("../","",$src); //ok
												}
												
											$this_parent_url=explode('//',$image_view)[0].'//'.explode('//',$image_view)[1].'/'.$src;
												

												 
											
											if($image_line !=''){
												    if (file_exists($full_domain_path.'/ecl/'.$image_line.'/'.$row[$i][$field])) {$src_f=$image_line.'/'.$row[$i][$field]; } else{
													$src_f=$full_domain_path.'/assets/img/Engineers-Consortium-Limited-logo.png';
													}										
													echo '<img style="'.$image_css.'" src="'.$src_f.'"  >';	
												}else if($image_view !=''){
												
												//website seting
												if($src !=''){$src_f=$this_parent_url.$row[$i][$field]; $src='';} else{$src_f=$image_view.'/'.$row[$i][$field];}
												
												if(@getimagesize($src_f)){
													  echo '<img  style="'.$image_css.'" src="'.$src_f.'"  >';	
												}else{
													  echo '<svg style="    opacity: .2;" class="svg-inline--fa fa-file-image fa-w-12 text-900 fs-3" aria-hidden="true" focusable="false" data-prefix="far" data-icon="file-image" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M369.9 97.9L286 14C277 5 264.8-.1 252.1-.1H48C21.5 0 0 21.5 0 48v416c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V131.9c0-12.7-5.1-25-14.1-34zM332.1 128H256V51.9l76.1 76.1zM48 464V48h160v104c0 13.3 10.7 24 24 24h104v288H48zm32-48h224V288l-23.5-23.5c-4.7-4.7-12.3-4.7-17 0L176 352l-39.5-39.5c-4.7-4.7-12.3-4.7-17 0L80 352v64zm48-240c-26.5 0-48 21.5-48 48s21.5 48 48 48 48-21.5 48-48-21.5-48-48-48z"></path></svg>';

												//image does not exist.
												}	
												
												
												
												   
												}else{
													if($label==''){$label='xx';}
													if($label !=''){ if($label=='xx'){$label='';}else {$label=$label.': ';}
														if($function!=''){
															 echo wordwrap($row[$i][$field], 30, "<br>", false);
															}else{
															if($new_table!=''){		
																$this_clients=$row[$i][$field];
																$is_eligible_sep=1;
																
																$this_clients_array=explode(',',$this_clients);
																foreach($this_clients_array as $this_clients_array_){
																	if(is_numeric($this_clients_array_)){
																		
																	}else{
																		$is_eligible_sep=0;
																	}
																}
																
																if($is_eligible_sep==0){
																	$this_clients_array=explode('765###4684',$this_clients);
																}
																foreach($this_clients_array as $this_clients_array_){
																	
																	
																    $qrys=$new_table."='$this_clients_array_'";
																
																	$results=mysqli_query($conn,$qrys);
																	$rows = mysqli_fetch_all($results,MYSQLI_ASSOC);
																	
																	if($need_to_show!=''){ //Open
																	if($badge==1){$class_='bg-primary';}
																	if($badge==2){$class_='bg-success';}
																	if($badge==3){$class_='bg-primary';}
																	if($badge==4){$class_='bg-info';}
																	else{$class_='bg-primary';}
																	    
																		if($rows[0][$need_to_show]=='Open'){$class_='bg-info';}
																		else if($rows[0][$need_to_show]=='Completed'){$class_='badge bg-dark';
																			
																			echo '<script>document.getElementById("'.$c_tr_id.'").style.backgroundColor = "lightgreen"; document.getElementById("'.$c_tr_id.'").style.color = "black";</script>';
																			
																			}
																		else if($rows[0][$need_to_show]=='Incompleted'){$class_='badge bg-danger';
																			
																			echo '<script>document.getElementById("'.$c_tr_id.'").style.backgroundColor = "red"; document.getElementById("'.$c_tr_id.'").style.color = "white";</script>';
																			
																			}
																		else{ 
																			
																			}
																	 if(strlen($rows[0][$need_to_show])>0) { echo '<b>'.$label.'</b><span class="badge   '.$class_.'"  >'.$rows[0][$need_to_show].' </span><br>';	}
																		else {
																			echo '<i class="fas fa-unlink"></i>';
																			}
																		
																		
																		} else {
																		echo '<b>'.$label.'</b><span class="badge me-1 py-2 badge-soft-primary"  style=" padding: 3px !important; background: #d5e5fac7; margin: 2px !important;">'.$rows[0][$field].'</span><br>';	
																		}
																}

																	
						
															}else{
															
															if($row[$i][$field] !=''){
																	if($subtract_value>0){echo '<b>'.$label.'</b>'.($subtract_value-(int)$row[$i][$field]).'<br>';	}else{echo '<b>'.$label.'</b>'.$row[$i][$field].'<br>';	}
																}
																					
															}						
	 							
															}

														}else{
														if($function!=''){
															echo wordwrap($row[$i][$field], 30, "<br>", false);
															}else{
																echo $row[$i][$field];														
															}																					
														}												
												}

									}
								
								}
							 
							}				
								echo '</tr>  '; 
								$sl++;	 
							}     
				?>
				</tbody>
				<tfoot>
					<tr>
				<?php
				foreach($th_all as $th_all_single){
						$all_th_slide=explode('#',$th_all_single);
						echo '<th class="'.$th_1st[1].' '.$all_th_slide[1].'">'.$all_th_slide[0].'</th>';
				}				
				?>
					</tr>
				</tfoot>
			</table>
			
			<?php
			if($button_delete=='1'){
  echo ' <div class="footer-button">
 <input style="cursor: pointer;margin-left: 17px !important;"  onclick="check_all(this)" id="check_all" class="checked form-check-input"  type="checkbox" value="" /> 
 <label class="form-check-label" for="check_all" style="cursor: pointer;user-select: none;-webkit-user-select: none;"> Check All</label> 
 
  <button  style="margin-left: 30px !important;"  onclick="deleteme(\''.str_replace("#","",$table_place).'\',\''.$t_name.'\''.','.'\''.$t_id_name.'\''.','.'\''.str_replace("#","",$table_place).'[]'.'\''.','.'\'1\''.')"   
  class="btn p-0 ms-2"   data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" 
  aria-label="Delete"><svg class="svg-inline--fa fa-trash-alt fa-w-14 text-500" aria-hidden="true" focusable="false" data-prefix="fas" 
  data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor"
  d="M32 464a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128H32zm272-256a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zM432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16z"></path></svg>
				Delete</button></div>'; 
				}
			?>
			
			
		</div>
</div>
 				
<?php
	$c=1;
 		if($table_request !=''){
			 echo '<script>';
		$table_request_array=explode(',',$table_request);
			foreach($table_request_array as $table_request_array_single){
				$field=explode('#',$table_request_array_single)[0];
				
				
			if($field !='gets_html'){	
				$id=explode('#',$table_request_array_single)[1];
				$img=explode('#',$table_request_array_single)[2];
				$have_newTable=explode('#',$table_request_array_single)[3];
				
				$new_table_qry=explode('@',$have_newTable)[0]; $new_table_qry=str_replace("$",",",$new_table_qry);
				$new_table_field=explode('@',$have_newTable)[1];
				$new_table_field_pre=explode('@',$have_newTable)[2];
				$new_table_field_post=explode('@',$have_newTable)[3];
				$new_table_script=explode('@',$have_newTable)[4];
				$new_table_script_con=explode('@',$have_newTable)[5];  $new_table_script_con=str_replace('^',"\'",$new_table_script_con);
				$new_table_script_con_fresh=$new_table_script_con;
				if($c==1){}
	 
				if($new_table_field !=''){ //complete qry
					$qry1=$new_table_qry;
					} else {$qry1=$new_table_qry."= '".$row[0][$field]."'";}
 
				    if($have_newTable !=''){
				
								if($field =='JSON'){$qry1=$new_table_qry;}
								$result1=mysqli_query($conn,$qry1);
								$rowcount1=mysqli_num_rows($result1);
								$rows = mysqli_fetch_all($result1,MYSQLI_ASSOC);
								
								//make 
								$make_for_json='';
								for($j=0;$j<$rowcount1;$j++)
								{
								if($field =='JSON'){
								$fieldx=explode('@',$have_newTable)[6];
								
								$fieldx_array=explode('$',$fieldx);
								foreach($fieldx_array as $fieldx_array_single){
								if($new_table_script_conx==''){$new_table_script_con_fresh=$new_table_script_con;}else{$new_table_script_con_fresh=$new_table_script_conx;}
									$new_table_script_conx=str_replace('{{'.$fieldx_array_single.'}}',$rows[$j][$fieldx_array_single],$new_table_script_con_fresh);
									//echo 'console.log(\''.$new_table_script_con.'\');';
									}
								$make_for_json=$make_for_json.$new_table_script_conx;
								$new_table_script_conx='';									
								}							
									if($field !='JSON'){
										if($new_table_field!=''){ echo 'document.getElementById("'.$id.'").innerHTML=\''.$new_table_field_pre.$rows[$j][$new_table_field].$new_table_field_post.'\';';
										}else{
										  echo 'document.getElementById("'.$id.'").innerHTML=\''.$rows[$j][$row[0][$field]].'\';';
										}									
									}
								}
								if($field =='JSON'){
								  echo 'document.getElementById("'.$id.'").innerHTML=\''.$make_for_json.'\';';
								}									
					}else{			
						if($img!=''){  //image						
							  echo 'document.getElementById("'.$id.'").src = \''.$img.$row[0][$field].'\';';							 
							}else{
							  echo 'document.getElementById("'.$id.'").innerHTML=\''.$row[0][$field].'\';';
							}					
					} 
				}else{
				
				//gets_html
				$qry=explode('@',explode('#',$table_request_array_single)[1])[0];
				$head_=explode('@',explode('#',$table_request_array_single)[1])[1];
				$itiration_=explode('@',explode('#',$table_request_array_single)[1])[2];
				$trail_=explode('@',explode('#',$table_request_array_single)[1])[3];
				$find_=explode('@',explode('#',$table_request_array_single)[1])[4];
				$post_id=explode('#',$table_request_array_single)[2];
				
				$this_data='';
								$result1=mysqli_query($conn,$qry);
								$rowcount1=mysqli_num_rows($result1);
								$rows = mysqli_fetch_all($result1,MYSQLI_ASSOC);
								for($j=0;$j<$rowcount1;$j++)
								{
									$vals_=$rows[$j][$find_];
									$this_data=$this_data. str_replace($find_,$vals_,$itiration_);
								}
				 $this_data=$head_.$this_data.$trail_;				
				 echo 'document.getElementById("'.$post_id.'").innerHTML=\''.$this_data.'\';';
				}	
					
					
					
			}
				//extra
				 echo $new_table_script.' try {
					 document.getElementById("profile_check").classList.remove("d-none"); 	
				} catch(err) { }';

		 echo '</script>';
		}
}
 
