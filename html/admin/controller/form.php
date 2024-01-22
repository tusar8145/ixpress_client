
<?php
		include('../configuration.php'); 
		include('../config.php');
		
		
	$is_mobile	= 0;
function isMobileDevice() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo
|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i"
, $_SERVER["HTTP_USER_AGENT"]);
}
if(isMobileDevice()){
   $is_mobile	= 1;
}
else {
    
}		
		
		
		  
		
		
		
		
		     
		
		
		
		
	$kkk='0';
	$title_array_fsl=array();
	$content_array=array();
	$position=0;
		$export_title=$_POST['export_title'];
		$title=$_POST['f_title'];
		$type=$_POST['f_type'];
		$id=$_POST['f_column'];
		$classes=$_POST['f_classes'];
		$class=$_POST['f_class'];
		$placeholder=$_POST['f_placeh'];
		$button=$_POST['f_buttton'];
		 $table=$_POST['f_table'];
		 $f_functions=$_POST['f_functions'];
		
		
		
		$f_functions_array=explode(',',$f_functions);
		foreach($f_functions_array as $f_functions_array_single){
		

			 $f_functions_array_single_array=explode('@',$f_functions_array_single);
			 
			 $fun=trim($f_functions_array_single_array[0]);
			 $name=trim($f_functions_array_single_array[1]);
			 $fun_id=trim($f_functions_array_single_array[2]);

		$another_table=$f_functions_array_single_array[5];

		 if($fun=='button_expand'){ if($f_functions_array_single_array[4]=='hide'){$hide_button='d-none';} $button_expand_click=$f_functions_array_single_array[3]; $button_expand='1'; $button_expand_id=$fun_id; $button_expand_name=$name;   }	 
		 if($fun=='footer_insert'){  $footer_insert='1'; $footer_insert_name=$name;   } 
 
		}
		
		
		////////join new table
 

 
		
		/**/
		
		
		   
		
		
		
		
		$f_sl=$_POST['f_sl'];

		$col_sm_x='col-sm-2';
		$col_sm_y='col-sm-10';

		$table_info=$_POST['table_info'];
		
		
		$table_info_expand=explode('#',$table_info);
		$t_name=$table_info_expand[0];
		$t_id_name=$table_info_expand[1];
		$t_order=$table_info_expand[2];
		$t_id_value=$table_info_expand[3];
		
		$another_string='';
		$another_string0='';
		$another_mother_table=explode('#',$another_table);
		
			foreach($another_mother_table as $another_mother_table_single){
				
							$another_table_name=explode('=',$another_mother_table_single)[0]; //branch
					    	$another_table_id_column=explode('^',explode(':',explode('=',$another_mother_table_single)[1])[0])[0];//branch_group_id
					    	$another_table_id_column_id=explode('^',explode(':',explode('=',$another_mother_table_single)[1])[0])[1];//branch_id
					    	$another_table_id_column_string=explode('^',explode(':',explode('=',$another_mother_table_single)[1])[0])[2];//Concerning Branch
					    	$another_table_show_column=explode('-',explode(':',explode('=',$another_mother_table_single)[1])[1]);//array
						 
			     			   if($another_table_id_column_id!=''){
			 				
								//select * from branch_group WHERE `branch_group_id`='1';
							  	$queryz2="select * from ".$t_name." WHERE `".$t_id_name."`='$t_id_value'";
								$result=mysqli_query($connect,$queryz2); $rowcount=mysqli_num_rows($result); $row = mysqli_fetch_all($result,MYSQLI_ASSOC);
					 
					 
								//branch_group_id=1
								$t_id_valuex=$row[0][$another_table_id_column];
								if($t_id_valuex==''){
								$another_table_id_column=$another_table_id_column_id;
									$t_id_valuex=$row[0][$another_table_id_column];
									}
								
								//echo $t_id_valuex;
								
								 //$another_table_id_column=$another_table_id_column_id;  //branch_id
								
								//adding 10 oct
								/*if(empty($t_id_valuex)){
										$t_id_valuex=$row[0][$another_table_id_column_id];
										$another_table_id_column=$another_table_id_column.'_id';
								} */
								
								/*if(empty($t_id_valuex)){
								 
										$t_id_valuex=$row[0][$another_table_id_column_id];
										$another_table_id_column=str_replace('_id','',$another_table_id_column);  //find 
										$another_table_id_column2=$another_table_id_column.'_id';  //find 
										
										$queryz2="select * from ".$another_table_id_column." WHERE `".$t_name."`='$t_id_value'";
										$result=mysqli_query($connect,$queryz2); $rowcount=mysqli_num_rows($result); $row = mysqli_fetch_all($result,MYSQLI_ASSOC);
	 
										$t_id_valuex=$row[0][$another_table_id_column2];
								
								} */	
								 
								}else{
								$t_id_valuex=$t_id_value;
								}
								
								
								$sl=1;
							        	$queryz="select * from ".$another_table_name." WHERE ".$another_table_id_column."='$t_id_valuex'";
							
 
 



 if($t_id_valuex!='' && $another_table_name !=''){
	 						  $result=mysqli_query($connect,$queryz); $rowcount=mysqli_num_rows($result); $row = mysqli_fetch_all($result,MYSQLI_ASSOC);
							for($i=$rowcount-1;$i>=0;$i--)
							{  
			 
								
										$another_string0=$another_string0.'<p style="color:green">SL. '.$sl.' ✔'.$row[$i]['created'].'</p>'; $sl++;
										foreach($another_table_show_column as $another_table_show_column_single){
										$x1=explode('>',explode('|',$another_table_show_column_single)[0])[0];
										$x11=explode('>',explode('|',$another_table_show_column_single)[0])[1];
										$have_files=explode('>',explode('|',$another_table_show_column_single)[0])[2];
										$x2=explode('|',$another_table_show_column_single)[1];
										
									    	if($x11==''){
											
											$this_arr=explode('+',$x1);
											$x1=$this_arr[0];
											$final_val_=$row[$i][$x1];
											if(sizeof($this_arr)>1){
												 if($this_arr[1]=='tbl_users')
												{ 
													$new_users='';
													foreach(explode(',',$final_val_) as $_this_data){
														$query2v="select * from ".$this_arr[1]." WHERE `userID`='$_this_data'";
														$result2v=mysqli_query($connect,$query2v);  $row2v = mysqli_fetch_all($result2v,MYSQLI_ASSOC);
														$new_users=$new_users.'#'.$row2v['0']['userName'].' ';
														
													}

													$final_val_=$new_users;
											 
												}	else{
													
													
													$query2v="select * from ".$this_arr[1]." WHERE `".$this_arr[1]."_id`='$final_val_'";
													$result2v=mysqli_query($connect,$query2v);  $row2v = mysqli_fetch_all($result2v,MYSQLI_ASSOC);
													$final_val_=$row2v['0'][$this_arr[1]];
												} 								
											}
						
											  
											
														if($have_files==''){$another_string0=$another_string0.'<tr><td style="width:33%"><p><b>'.$x2.': </b></p></td><td><p>'.$final_val_.'</p></td>';} else{
														$dta=$row[$i][$x1];
														$file_array=explode(',',$dta);
														$file_data='';
														foreach ($file_array as $file_array_single){
																$file_data=$file_data.'<a target="_blank"  href="'.$full_domain_path.'/ecl/uploads/'.$have_files.$file_array_single.'">'. $file_array_single.'</a><br>';
															}
														
														$another_string0=$another_string0.'<tr><td style="width:33%"><p><b>'.$x2.':</b> </p></td><td><p>'.$file_data.'</p></td>';
															}											
											
											
											}else{
															$this_data=$row[$i][$x1];
															$query2="select * from ".$x1." WHERE ".$x1."_id='$this_data'";
															$result2=mysqli_query($connect,$query2); $rowcount2=mysqli_num_rows($result2); $row2 = mysqli_fetch_all($result2,MYSQLI_ASSOC);
															 $dta=$row2['0'][$x11];					 

														      $another_string0=$another_string0.'<tr><td style="width:33%"><p>'.$x2.': </p></td><td><p>'.$dta.'</p></td>';
											}
										
										}
										$another_string0=$another_string0.'<hr>';
										
								 $another_string=$another_string.'<b><p style="color:green !important"><br>'.$another_table_id_column_string.'<hr></p></b>  <table class="table "><tbody>'.$another_string0.' </tbody></table>'; $another_string0='';
			$another_table_id_column_string='';
										
							}   
	 
	 }
 
  
							
							
 
							
							
			}		
							
							
							
							
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
//special 
//if($t_name=='tender_rfp_documents' || $t_name=='tender' || $t_name=='p_cv_staff' || $t_name=='partners' || $t_name=='p_projects' || $t_name=='p_clients'){		
if($is_mobile	== 0){
	$col_sm_x='col-sm-3';
	$col_sm_y='col-sm-9';
	$text_align='text-right'; }
//}

		if($button_expand=='1'){
		$form_content=$form_content. '
				<p>
				<a class="'.$hide_button.' btn btn-falcon-default mt-2" id="'.$button_expand_id.'" data-bs-toggle="collapse" href="#collapseExample'.$button_expand_id.'" role="button" aria-expanded="false" aria-controls="collapseExample'.$button_expand_id.'"><span class="  far fa-plus-square"></span> Add new</a>
				</p>
				<div class="collapse" id="collapseExample'.$button_expand_id.'">
					
				<div class="card mb-3">
				<div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../assets/img/illustrations/corner-4.png);"></div>
				<div class="card-body position-relative">
				<div class="row">		
						';
			
			
			}else{$form_content=$form_content. '
				<div class="card mb-3">
				<div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../assets/img/illustrations/corner-4.png);"></div>
				<div class="card-body position-relative">
				<div class="row">';			
			
			}



		$form_content=$form_content. '<form method="post" id="_'.$t_name.'" enctype="multipart/form-data" > ';

		if($t_id_value !=''){
							$qry="select * from ".$t_name."  where  `".$t_id_name."`= '".$t_id_value."'";
							$result=mysqli_query($conn,$qry);
							$rowcount=mysqli_num_rows($result);
							$row = mysqli_fetch_all($result,MYSQLI_ASSOC);
		}


	 
				$title_array=explode('#',$title);
				$type_array=explode('#',$type);
				$id_array=explode('#',$id);
				$classes_array=explode('#',$classes);
				$placeholder_array=explode('#',$placeholder);
				$button_array=explode('@',$button);	
					$sl=0;
					foreach($title_array as $title_array_single){
					
							
					
							$title_array_single_required=explode('@',$title_array_single);
							
							
							if($title_array_single_required[1]=='r'){$required='required'; $star='<x style="color:red">*</x>';}else {$required='';$star='';}
							
							$typ='';
						
							
							$array_for_type=explode('=',$title_array_single_required[2]);
							
							if(trim($array_for_type[0])=='t'){$typ='text'; if($array_for_type[1]!=''){$max='Max="'.$array_for_type[1].'"';$min='min="'.$array_for_type[2].'"';}}
							if(trim($array_for_type[0])=='n'){$typ='number'; if($array_for_type[1]!=''){$max='Max="'.$array_for_type[1].'"';$min='min="'.$array_for_type[2].'"';}}
							if(trim($array_for_type[0])=='e'){$typ='email'; if($array_for_type[1]!=''){$max='Max="'.$array_for_type[1].'"';$min='min="'.$array_for_type[2].'"';}}
							if(trim($array_for_type[0])=='p'){$typ='password'; if($array_for_type[1]!=''){$max='Max="'.$array_for_type[1].'"';$min='min="'.$array_for_type[2].'"';}}
							
							$id_array[$sl]=trim($id_array[$sl]);
				 
							$type_array_expand=explode('@',$type_array[$sl]);
							$_this_type_array_0=$type_array_expand[0];
							
							if(empty(trim($placeholder_array[$sl]))){  $placeholder_array[$sl]=explode('</sub>',explode('<sub>',$title_array_single_required[0])[1])[0];   $title_array_single_required[0]=explode('<sub>',$title_array_single_required[0])[0];}
							$title_array_fsl[$id_array[$sl]]=$title_array_single_required[0];
							
							$services = $row[0][$id_array[$sl]];
							$q_array=explode(',',$services);					

							//separator
							
							$get_sep=explode('>',explode('<sectionequal',$title_array_single_required[0])[1])[0];
							if(!empty($get_sep)){ 
								if($get_sep_count>0){$get_sep_count=$get_sep_count+1;} else {$get_sep_count=1;}
								if($get_sep_count==1){$this_br='';}else{$this_br='</br>'; }
								$default_sep=$this_br.'<center><span style="font-weight: 700;opacity: .6; font-size: small;">'.$get_sep.'</span></center><hr></br>'; }else{ $default_sep=''; }
							
 
							if(trim($_this_type_array_0)=='input'){
							if($classes_array[$sl]=='datetimepicker time'){$data_option=' data-options=\'{\"enableTime\":true,\"dateFormat\":\"d/m/y H:i\",\"disableMobile\":true}\''; } else{$data_option='';}
							

							
							$form_content=$form_content. $default_sep.'<div class="mb-3 row"><label class="'.$col_sm_x.' form-label  '.$text_align.'  " for="'.$id_array[$sl].'">'.$title_array_single_required[0].' '.$star.'</label>
							 <div class="'.$col_sm_y.'"><input '.$required.'     value="'.$row[0][$id_array[$sl]].'" '.$max.' '.$min.' class="form-control '.$classes_array[$sl].' '.$class.'" id="'.$id_array[$sl].'" type="'.$typ.'" placeholder="'.$placeholder_array[$sl].'" /></div></div>';
							$content_array[$id_array[$sl]]='<p class="font_form  ">'.$row[0][$id_array[$sl]].'</p>';
						//	$class_array[$id_array[$sl]]=$classes_array[$sl];
							}
							
		if(explode('+',trim($_this_type_array_0))[0]=='input_mul')
		{ $form_content_title=''; $form_content_data='';
			//if($classes_array[$sl]=='datetimepicker time'){$data_option=' data-options=\'{\"enableTime\":true,\"dateFormat\":\"d/m/y H:i\",\"disableMobile\":true}\''; } else{$data_option='';}
			
			$this_ar_mulx0=explode('---',$title_array_single_required[0]);
			$this_ar_mulx=explode('+',$this_ar_mulx0[1]);
			$cvb=str_replace(' ','',$this_ar_mulx0[0]);
			
			$form_content=$form_content.  '
			 
			<div class="mb-3 row">
				<label style="margin-top:10px; cursor: pointer;"class="col-sm-12 form-label  text-center " for="'.$id_array[$sl].'">'.$this_ar_mulx0[0].' '.$star.' </label>
				<style="margin-bottom:10px" hr>';
			
				//process 
				 $get_data=$row[0][$id_array[$sl]];
				$make_string='';
 
 
				$arr3=json_decode($get_data, true);
				$title_array3=array(); 
				$array_data3=array();
				foreach($arr3 as $key3=> $arr_single3){
					$title_array3[$key3]=$key3;
					foreach($arr_single3  as $arr_single23){
					//echo $arr_single2;
					$array_data3[]=$arr_single23;
					}
				}		

				foreach($array_data3  as $array_data_single3){
				if($array_data_single3=='' || $array_data_single3=='undefined' || $array_data_single3=='null'){$array_data_single3='';}
					if($make_string==''){$make_string=$array_data_single3;}else{$make_string=$make_string.'@@@@@'.$array_data_single3;} 
				}				
				
				
				
				
				
				$_items_array=explode('@@@@@',$make_string);
				$_items_array_size=sizeof($_items_array);
				$itm=explode('+',trim($_this_type_array_0))[1];
				$box=$_items_array_size/$itm;
				$_counter=0;
				$_new_string='';
				for($b=0;$b<$box;$b++)
				{
					for($c=0;$c<$itm;$c++)
					{
						if($_new_string==''){$_new_string=$_items_array[$b+($c*$box)];}else{$_new_string=$_new_string.'#####'.$_items_array[$b+($c*$box)];}
						$_counter++;
					}					
				}
				$_new_string_array=explode('#####',$_new_string);
				$input_c=0;
				//start main
				$form_content=$form_content.'
				<div id='.$cvb.'>';
				$th_array=array();
				$th_td_array=array();

				$xp=0;
				for($xc=0;$xc<$box;$xc++){
					$form_content=$form_content.'
					<div>';
					
					$x1='';$x2='';
					
					foreach($this_ar_mulx as $this_ar_mul_each)
					{  
					$org_this_ar_mul_each=$this_ar_mul_each;
					$this_ar_mul_each=explode('=',$org_this_ar_mul_each)[0];
					$this_ar_mul_each_extension=explode('=',$org_this_ar_mul_each)[1];
					$area=explode('=',$org_this_ar_mul_each)[2];
					
					$th_array[$this_ar_mul_each]=$this_ar_mul_each;
					$th_td_array[$xp]=$_new_string_array[$input_c]; $xp++;

//echo $this_ar_mul_each.'/';
				 	if($this_ar_mul_each=='Provider'){
					
					$query1b="select * from `services_provider` WHERE `services_provider_id`='$_new_string_array[$input_c]'";
					$result1b=mysqli_query($connect,$query1b); $rowcount1b=mysqli_num_rows($result1b); $row1b = mysqli_fetch_all($result1b,MYSQLI_ASSOC);
					$xx=$row1b[0]['services_provider'];	
					
					$_new_string_array[$input_c]='rr';
					$x1=$x1.$this_ar_mul_each.':<br>';  $x2=$x2.$xx.'<br>';
					 }else {
					 $x1=$x1.$this_ar_mul_each.':<br>';  $x2=$x2.$_new_string_array[$input_c].'<br>';
					 }
					
					
					
					
					
					//special
					$form_content=$form_content.'
					 <div class="mb-3 row">
						<label class="'.$col_sm_x.' form-label  '.$text_align.'  " for="'.$id_array[$sl].'">'.$this_ar_mul_each.' '.$star.'</label>
						<div class="'.$col_sm_y.'">';
						
						if($this_ar_mul_each_extension==''){
							if($area==''){
								$form_content=$form_content.'<input '.$required.'  title="'.$this_ar_mul_each.'"   value="'.$_new_string_array[$input_c].'" '.$max.' '.$min.' class="form-control '.$classes_array[$sl].' '.$class.'" id="'.$id_array[$sl].'" type="'.$typ.'" placeholder="'.$placeholder_array[$sl].'" />';
							
							}else{
								$form_content=$form_content.'<textarea   '.$required.'  title="'.$this_ar_mul_each.'"  class="form-control '.$classes_array[$sl].' '.$class.'"  id="'.$id_array[$sl].'"  rows="3">'.$_new_string_array[$input_c].'</textarea>';
								}
							}else{ 
							
							if($kkk=='x'){$kkk=0;}else{}
							//select input

								$form_content=$form_content.'
                                <select  style="margin-bottom:15px"   title="'.$this_ar_mul_each.'"  id="'.$id_array[$sl].'"   class="form-select  '.$classes_array[$sl].'  js-choice"  size="1" name="organizerSingle" data-options=\'{"removeItemButton":true,"placeholder":true}\'>
								<option value="" selected=""></option>';
								
 
								 $qry1="select * from ".$this_ar_mul_each_extension." order by ".$this_ar_mul_each_extension." asc ";
								$result1=mysqli_query($conn,$qry1);
								$rowcount1=mysqli_num_rows($result1);
								$rows = mysqli_fetch_all($result1,MYSQLI_ASSOC);
								for($j=0;$j<$rowcount1;$j++)
								{
							
									if ($rows[$j][$this_ar_mul_each_extension."_id"]==$array_data3[$kkk]){
										$is_select="selected"; $values=$rows[$j][$this_ar_mul_each_extension]; 
									}else{ 
									$is_select="";
									}
									//echo $kkk;
									
	
							 
								$form_content=$form_content. '
								
								<option '.$is_select.'  value="'.$rows[$j][$this_ar_mul_each_extension.'_id'].'">'.$rows[$j][$this_ar_mul_each_extension].'</option>
							
								';	
 			 
								}
								if($kkk=='x'){}else{$kkk++;}
								$form_content=$form_content. '</select>';

							}
					
					    $form_content=$form_content.' </div>
					</div>';
					
					$input_c++;
					}
					//special
					if($this_ar_mulx0[0]=='Employment Record'){$br='</br>';}else{$br='';}
					if($this_ar_mulx0[0]=='Employment Record'){$placed='<b>Employer-'.($xc+1).'</b>'.$br.'';}else {$placed='<b></b>'.$br.'';}
					
					//special
					// $x2='jjj'; 
					
					
					$form_content_title=$form_content_title.'<tr><td style="width:35%"><b><p style="text-align: right";>'.$br.''.$x1.'</b></p></td><td  style="width:65%"><p>'.$placed.''.$x2.'</p></td></tr>';
					
					$form_content=$form_content.'
					<hr style="margin:10px"> 
					<input type="button" value="-" style="position: absolute; margin-top: -3.1%; background: red;color: white;font-weight: bold;border: 3px solid #ff8e00a3;" onclick="removeRow(this)">
					</div>';
				}
				
				$form_content=$form_content.'
				</div>';  //end main id
			
			
			$form_content=$form_content.'
			</div>	
			<div   style="margin-top: -4.699%;margin-left: 6%;margin-bottom: 15px;cursor: pointer;position: absolute;" >
				<span  onclick="colone(\''.$cvb.'\')"class="far fa-plus-square text-danger fs-3"></span>
			</div>';
			
			$content_array[$id_array[$sl]]='<table class="table table-condensed"><tbody>'.$form_content_title.' </tbody></table>';	
			
			if($this_ar_mulx0[0]=='Language and Degree of Proficiency'){
				$data_table='';
				foreach($th_array as $th_array_each){
					$data_table=$data_table.'<th><p>'.$th_array_each.'</p></th>';
				}
				$data_table='<thead><tr>'.$data_table.'</tr></thead>';
				
				$array_ele=count($th_array);
				$p=1;
				foreach($th_td_array as $th_td_array_each){
					if($p==1){$data_table='<tr>'.$data_table;}
					$data_table=$data_table.'<td><p>'.$th_td_array_each.'</p></td>';
					if($p==$array_ele){$data_table=$data_table.'</tr>'; $p=0;}  $p=$p+1;
				}
				$data_table='<tbody>'.$data_table.'</tbody>';
				$data_table='  <table class="table table-condensed">'.$data_table.' </table>';
			$content_array[$id_array[$sl]]=	$data_table;
			}
		}
							
							else if(trim($_this_type_array_0)=='area' && $type_array_expand[1]!='tiny'){
							$form_content=$form_content.$default_sep. '<div class="mb-3"><label class="form-label  '.$text_align.'" for="'.$id_array[$sl].'">'.$title_array_single_required[0].' '.$star.'</label>
							<textarea data-bs-toggle="tooltip" data-bs-placement="top"  title="'.$placeholder_array[$sl].'"  '.$required.' class="form-control '.$classes_array[$sl].' '.$class.'"  id="'.$id_array[$sl].'"  rows="3">'.$row[0][$id_array[$sl]].'</textarea></div>';
							$content_array[$id_array[$sl]]='<p class="font_form">'.$row[0][$id_array[$sl]].'</p>';
							}
							 
							else if(trim($_this_type_array_0)=='area' && $type_array_expand[1]=='tiny'){
							$id_array[$sl]=trim($id_array[$sl]);
							$form_content=$form_content. $default_sep.'<div class="mb-3"><label class="form-label  '.$text_align.'" for="'.$id_array[$sl].'">'.$title_array_single_required[0].' '.$star.'</label>
							<textarea name="tiny" '.$required.' class="form-control '.$classes_array[$sl].' '.$class.'"  id="'.$id_array[$sl].'"  rows="3">'.$row[0][$id_array[$sl]].'</textarea></div>';
							$content_array[$id_array[$sl]]='<p class="font_form">'.$row[0][$id_array[$sl]].'</p>';
							}
							
							else if(trim($_this_type_array_0)=='file'){ 
							if(trim($type_array_expand[1])=='multi'){$multi='multiple';}else {$multi='';}
							$form_content=$form_content. '<div class="mb-3 row"><label class="'.$col_sm_x.' form-label  '.$text_align.'" for="'.$id_array[$sl].'">'.$title_array_single_required[0].' '.$star.'</label>
							<div class="'.$col_sm_y.'"><input  '.$required.' '.$multi.' class="form-control'.$classes_array[$sl].' '.$class.'" id="'.$id_array[$sl].'"   name="file[]" type="file" /> </div></div>';

							$all_image=explode(',',$row[0][$id_array[$sl]]);
							$file_s='';
							foreach($all_image as $all_image_single){
							//echo $all_image_single;
							if($all_image_single !=''){
							$mediapath=$parent_url.str_replace('../','',$type_array_expand[2]).$all_image_single;
							$cc='../'.str_replace('../','',$type_array_expand[2]).$all_image_single;
							$dd=$parent_url.$cc;
							$this_src='../'.str_replace('../','',$type_array_expand[2]);
							
try {
   								/*	$mimeType = curl_getinfo($mediapath, CURLINFO_CONTENT_TYPE);
									if($mimeType == 'application/zip') {
									$file_ype_this='assets/img/icons/zip.png';
									} else{
									$file_ype_this='assets/img/icons/docs.png';
									} 
									if(@is_array(getimagesize($mediapath))){
									$file_ype_this=$cc;
									} else {} */
									
									$file_ype_this=$cc;
}
catch(Exception $e) { }	


                          
     $remoteFile = $full_domain_path.'/'.str_replace('../','',$cc);

// Initialize cURL
$ch = curl_init($remoteFile);
curl_setopt($ch, CURLOPT_NOBODY, true);
curl_exec($ch);
$responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Check the response code
if($responseCode == 200){
     $message='';
  $green='<img class="border h-10 w-10 fit-cover rounded-2" height="20px" src="'.$full_domain_path.'/mark.webp" alt="">';
}else{
    $message= '<p  style="
    font-weight: bold ;
    font-size: 12px !important;
    color: red !important;
">File not found</p>';
    $green='<img class="border h-10 w-10 fit-cover rounded-2" height="20px" src="'.$full_domain_path.'/fail.png" alt="">';
}
                              
                              
                              
                              
                              
									$position++;
									$file_s=$file_s.$message.'
									
                                    
									<div  id="files'.$position.'"  style=" margin-bottom: 0px !important;" class="col-lg-12 d-flex mb-3 hover-actions-trigger align-items-center">
									<div class="file-thumbnail">
                                  
                               <img class="border h-100 w-100 fit-cover rounded-2" src="'.$file_ype_this.'" alt="">
                                    
                                    
                                    </div>
									<div class="ms-3 flex-shrink-1 flex-grow-1">
									  <h6 class="mb-1"><a class="stretched-link text-900 fw-semi-bold" id="set_name'.$position.'"  target="_blank" href="'.$cc.'" style="caursor:pointer"  alt="">'.$all_image_single.'
                                      
                       <span>    '.$green.'</span>               
                                      </a></h6>
									  <!--<div class="fs--1"><span class="fw-semi-bold">'.$mimeType.'</span><span class="fw-medium text-600 ms-2">'.$mimeType.'</span></div>-->
									  <div class="hover-actions end-0 top-50 translate-middle-y">
									  <a  Title="Download" id="download_link'.$position.'" class="btn btn-light border-300 btn-sm me-1 text-600" data-bs-toggle="tooltip" data-bs-placement="top" title="" href="'.$cc.'" download="'.$all_image_single.'" data-bs-original-title="Download" aria-label="Download">
									  <img src="assets/img/icons/cloud-download.svg" alt="" width="15"></a>';
									  
									  
									 if($t_name=='tender_documents'){ $file_s=$file_s.'
									  <button Title="Extract" onclick="renderPDF(\''.$cc.'\',\''.$t_id_value.'\')"  class="btn btn-light border-300 btn-sm me-1 text-600 shadow-none" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit" aria-label="Edit">
									  <img src="assets/img/icons/extract.png" alt="" style="opacity: .6;" width="15"></button>';
									 }	
									 
									 //if($t_name=='p_cv_staff'){ 
									 $file_s=$file_s.'
									 <input type="text"    placeholder="Enter New File Name..."    id="file_rename_'.$position.'">
									 <input  id="file_holder_'.$position.'" type="text" value="'.$all_image_single.'" class="d-none">
									  <button Title="Rename File" onclick="rename_file(\''.$position.'\',\''.$t_id_value.'\',\''.$this_src.'\',\''.$t_name.'\',\''.$t_id_name.'\')"  class="btn btn-light border-300 btn-sm me-1 text-600 shadow-none" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Rename" aria-label="Edit">
									  <img src="assets/img/icons/rename.png" alt=""  width="15"></button>';
									// }
									 
									 $file_s=$file_s.'
									  <button  Title="Delete"  onclick="deleteme(\''.$t_id_value.'@'.str_replace('.','',$all_image_single).'@'.$id_array[$sl].'@'.$all_image_single.'@'.$type_array_expand[2].'@'.$position.'\','.'\''.$t_name.'\''.','.'\''.$t_id_name.'\''.','.'\'0\''.','.'\'2\''.')"  class="btn btn-light border-300 btn-sm me-1 text-600 shadow-none" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit" aria-label="Edit">
									  <img src="assets/img/icons/delete.png" alt="" width="15"></button></div> 
								   </div>
								  </div>
								  <hr class="bg-200">';
								
							}else {
							}
							if($all_image_single ==''){
							$file_s='<svg style="    opacity: .2;" class="svg-inline--fa fa-file-image fa-w-12 text-900 fs-3" aria-hidden="true" focusable="false" data-prefix="far" data-icon="file-image" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M369.9 97.9L286 14C277 5 264.8-.1 252.1-.1H48C21.5 0 0 21.5 0 48v416c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V131.9c0-12.7-5.1-25-14.1-34zM332.1 128H256V51.9l76.1 76.1zM48 464V48h160v104c0 13.3 10.7 24 24 24h104v288H48zm32-48h224V288l-23.5-23.5c-4.7-4.7-12.3-4.7-17 0L176 352l-39.5-39.5c-4.7-4.7-12.3-4.7-17 0L80 352v64zm48-240c-26.5 0-48 21.5-48 48s21.5 48 48 48 48-21.5 48-48-21.5-48-48-48z"></path></svg>';
							}
							$content_array[$id_array[$sl]]=$file_s;
							}}
							
							if(trim($_this_type_array_0)=='checkbox'  && explode('~',$type_array_expand[1])[0]=='newTable'){
								$values='';
								$form_content=$form_content. '<div class="mb-3"><label class="form-label  '.$text_align.'" for="'.$id_array[$sl].'">'.$title_array_single_required[0].' '.$star.'</label>  <br>';
								$qry1=explode('~',$type_array_expand[1])[1];
								$result1=mysqli_query($conn,$qry1);
								$rowcount1=mysqli_num_rows($result1);
								$rows = mysqli_fetch_all($result1,MYSQLI_ASSOC);
								for($j=0;$j<$rowcount1;$j++)
								{
							
								$c_g_id=$rows[$j][$id_array[$sl].'_id'];
								if (in_array($c_g_id, $q_array)) {  $js_select="checked";  $js_color="color: blueviolet;";   }
								else  { $js_select=""; $js_color=""; } 
							
							
								$form_content=$form_content. '
								 <div class="form-check form-check-inline">
								<input  '.$js_select.'   style="cursor: pointer;" class="checked form-check-input" type="checkbox" id="'.$id_array[$sl].$j.'" name="'.$id_array[$sl].'[]" value="'.$rows[$j][$id_array[$sl].'_id'].'">
								<label style="cursor: pointer;" class="form-check-label" for="'.$id_array[$sl].$j.'"> '.$rows[$j][$id_array[$sl]].' 
								</label>
								 </div>								
								';	
								$values=$values.'<span class="badge me-1 py-2 badge-soft-success" style="margin-bottom:6px">'.$rows[$j][$id_array[$sl]].'</span>';
								}	
								$content_array[$id_array[$sl]]='<div class=""style="margin-bottom:3px">'.$values.'</div>';
							}
							
							

							if(trim($_this_type_array_0)=='select'  && explode('~',$type_array_expand[1])[0]=='newTable'){
								$form_content=$form_content. '<div class="mb-3 row"><label class="'.$col_sm_x.'  form-label  '.$text_align.'" for="'.$id_array[$sl].'">'.$title_array_single_required[0].' '.$star.'</label>  
								 <div class="'.$col_sm_y.'"><select  style="margin-bottom:15px"  id="'.$id_array[$sl].'"   class="form-select js-choice"  size="1" name="organizerSingle" data-options=\'{"removeItemButton":true,"placeholder":true}\'>
								<option value="" selected=""></option>';
								
								$xpp=explode('~',$type_array_expand[1])[2];
								if( $xpp!=''){$xxx=$xpp;}else {$xxx=$id_array[$sl];}
								
 			  
							    $qry1=str_replace('?','"',explode('~',$type_array_expand[1])[1]); echo '<hr>';
								if(strlen($services)>0){ $qry1=str_replace('STABLEID',$services,$qry1); 	}else{ $qry1=str_replace('STABLEID','0',$qry1); }
							 
								$result1=mysqli_query($conn,$qry1);
								$rowcount1=mysqli_num_rows($result1);
								$rows = mysqli_fetch_all($result1,MYSQLI_ASSOC);
								for($j=0;$j<$rowcount1;$j++)
								{	
							    if(count(explode('_id',$xxx))==2){ $xxx=str_replace('_id','',$xxx);   }
								if(empty($rows[$j][$xxx."_id"])){$rows[$j][$xxx."_id"]=$rows[$j]["userID"];}
								if($services==$rows[$j][$xxx."_id"]){$is_select="selected"; $values=$rows[$j][$xxx]; }else{$is_select="";}
							
 								$form_content=$form_content. '
								
								<option '.$is_select.'  value="'.$rows[$j][$xxx.'_id'].'">'.$rows[$j][$xxx].'</option>
							
								';	
 			 
								}
								$form_content=$form_content. '</select></div></div>';
								$content_array[$id_array[$sl]]='<span class="badge me-1 py-2 badge-soft-primary">'.$values.'</span>';
								$form_content=$form_content.'<script>   const element = document.getElementById("'.$id_array[$sl].'"); const choices = new Choices(element);</script>';
							}
														
							
							if(trim($_this_type_array_0)=='selectMulti'  && explode('~',$type_array_expand[1])[0]=='newTable'){
								$form_content=$form_content. '<div class="mb-3 row"><label class="'.$col_sm_x.'  form-label  '.$text_align.'" for="'.$id_array[$sl].'">'.$title_array_single_required[0].' '.$star.'</label>  
								 <div class="'.$col_sm_y.'"><select  style="margin-bottom:15px"  id="'.$id_array[$sl].'"  class="form-select js-choice" multiple="multiple" size="1"   name="organizerMultiple" data-options=\'{"removeItemButton":true,"placeholder":true}\'>
								<option value="" selected=""></option>';
								$values='';
								$str='';
								 $qry1=explode('~',$type_array_expand[1])[1];
								$have_index=explode('~',$type_array_expand[1])[2];
								$show_index=explode('~',$type_array_expand[1])[3];
								$result1=mysqli_query($conn,$qry1);
								$rowcount1=mysqli_num_rows($result1);
								$rows = mysqli_fetch_all($result1,MYSQLI_ASSOC);
								for($j=0;$j<$rowcount1;$j++)
								{
						    	 if(count(explode('_id',$id_array[$sl]))==2){ $xxxz=str_replace('_id','',$id_array[$sl]);   }else{
									 $xxxz=$id_array[$sl];}
								 
								if($have_index!='') {
								$c_g_idv=$rows[$j][$have_index]; 
								
								} else {
								
								   
									$c_g_idv=$rows[$j][$xxxz.'_id'];
									 
								}
								
								if (in_array($c_g_idv, $q_array)) {$is_select="selected"; 
									
									$str=$str.' <span class="badge mb-2  bg-secondary">'.$rows[$j][$xxxz].' </span> ';
									//$str=$str.'<p>'.$rows[$j][$show_index].'</p>';
									 
									$values=$values.'<span class="badge me-1 py-2 badge-soft-primary">'.$rows[$j][$xxxz].'</span>'; }else{$is_select="";}
							
								if($have_index!='') {
								
								$form_content=$form_content. '
								<option '.$is_select.'  value="'.$rows[$j][$have_index].'">'.$rows[$j][$show_index].'</option>';	

								} else {
							    $form_content=$form_content. '
								<option '.$is_select.'  value="'.$rows[$j][$xxxz.'_id'].'">'.$rows[$j][$xxxz].'</option>';	

								}
								 
								}
								$form_content=$form_content. '</select></div></div>';
							// $content_array[$id_array[$sl]]=$values;
							//$values='';
							$form_content=$form_content.'<script>   const element = document.getElementById("'.$id_array[$sl].'"); const choices = new Choices(element);</script>';
							$content_array[$id_array[$sl]]=$str;
							}
							
							if(trim($_this_type_array_0)=='moreSettings'){
								$form_content=$form_content. '<div class="mb-3 row"><label class="'.$col_sm_x.'  form-label  '.$text_align.'" for="'.$id_array[$sl].'">'.$title_array_single_required[0].' '.$star.'</label>  
								 <div class="'.$col_sm_y.'"><select  style="margin-bottom:15px"  id="'.$id_array[$sl].'"   class="form-select js-choice"  size="1" name="organizerSingle" data-options=\'{"removeItemButton":true,"placeholder":true}\'>
								<option value="" selected=""></option>';
								
								$have_index=explode('~',$type_array_expand[1])[0];
								$qry1="select * from settings  where  `setting`= '".$have_index."'";
								$result1=mysqli_query($conn,$qry1);
								$rowcount1=mysqli_num_rows($result1);
								$rows = mysqli_fetch_all($result1,MYSQLI_ASSOC);
								for($j=0;$j<$rowcount1;$j++)
								{
								$req_val=$rows[$j]["value"]; 

								
								$req_val_array=explode(',',$req_val);
								foreach($req_val_array as $req_val_array_single ){
								
								if($services==trim($req_val_array_single)){$is_select="selected";  $values=$req_val_array_single; }else{$is_select="";}								
								
								$form_content=$form_content. '<option '.$is_select.'  value="'.$req_val_array_single.'">'.$req_val_array_single.'</option>';	
									
									}
 			 
								}
								$form_content=$form_content. '</select></div></div>';
								$content_array[$id_array[$sl]]='<span class="badge me-1 py-2 badge-soft-primary">'.$values.'</span>';
								$form_content=$form_content.'<script>  const choices = new Choices(\'select\', {    });</script>';
							
							$form_content=$form_content.'<script>   const element = document.getElementById("'.$id_array[$sl].'"); const choices = new Choices(element);</script>';
							}							
														
							
							
							
							
							$sl++;		
						}	
				$form_content=$form_content. '<p class="d-none">\''.implode("','",$id_array).'\' </p> 
				<p id="t_id_value" class="d-none">'.$t_id_value.'</p>
				<p id="t_id_name" class="d-none">'.$t_id_name.'</p>
				<hr>
				 
			 <div class="card-body bg-light">
              <div class="tab-content">
                <div class="tab-pane preview-tab-pane active" role="tabpanel" aria-labelledby="tab-dom-719b3dd4-a601-4e87-ad44-72bab81dc7d0" id="dom-719b3dd4-a601-4e87-ad44-72bab81dc7d0">

';
				
				
	if($button_expand_name=='Change Password'){
		$insert='insert';
		}else{
		$insert='insert';
		}			
				
				
				if($t_id_value !=''){
 
if($footer_insert=='1'){		$button_expand_class=explode('#',$button_expand_name)[1];	$button_expand_name=explode('#',$button_expand_name)[0];			$form_content=$form_content. '
<button  id='.$button_array[1].' class="btn btn-outline-primary me-1 mb-1" onclick="'.$button_array[2].'(\''.implode("*",$id_array).'\',\''.implode("^",$type_array).'\',\''.implode("*",$title_array).'\',\''.$table.'\',\'insert\')"  type="button"><svg class="svg-inline--fa fa-plus fa-w-14 me-1" data-fa-transform="shrink-3" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="" style="transform-origin: 0.4375em 0.5em;"><g transform="translate(224 256)"><g transform="translate(0, 0)  scale(0.8125, 0.8125)  rotate(0 0 0)"><path fill="currentColor" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z" transform="translate(-224 -256)"></path></g></g></svg> '.$footer_insert_name.'</button>				
 <button     style="margin-left:20px" class=" btn btn-primary me-1 mb-1  '.$button_expand_class.' "  onclick="'.$insert.'(\''.implode("*",$id_array).'\',\''.implode("^",$type_array).'\',\''.implode("*",$title_array).'\',\''.$table.'\',\'update\')"  type="button">'.$button_expand_name.'</button>

';}else {
$form_content=$form_content. '<button     style="margin-left:20px" class=" btn btn-primary me-1 mb-1"  onclick="'.$insert.'(\''.implode("*",$id_array).'\',\''.implode("^",$type_array).'\',\''.implode("*",$title_array).'\',\''.$table.'\',\'both\')"  type="button">'.$button_expand_name.'</button>
';
}




if($button_expand_click=='click'){$form_content=$form_content. '
<script>  document.getElementById(\'add_new_button\').click();</script>
';}
				
				}else {
						$form_content=$form_content. '<button id='.$button_array[1].'  style=" " class="btn btn-secondary me-1 mb-1" onclick="'.$button_array[2].'(\''.implode("*",$id_array).'\',\''.implode("^",$type_array).'\',\''.implode("*",$title_array).'\',\''.$table.'\')"  type="button">'.$button_array[0].'</button> <button onclick="reset(\''.$id.'\')" class="btn btn-outline-danger me-1 mb-1" type="button"style=" position: absolute;right: 10%;">Reset Form</button>';	 
				}
					
				 
				 $form_content=$form_content. '</div>                </div>
              			</div>';
            		if($button_expand=='1'){ 
					$form_content=$form_content. ' </div>';
					}
			 
			
           $form_content=$form_content. ' </div>
           
             ';		
				//return $string;
 		 
?>
 
 </form>



<?php
if($f_sl==2){
?>
<button class="btn btn-primary d-none" type="button" id="this_modal" data-bs-toggle="modal" data-bs-target="#add_new_button2">Launch static backdrop modal</button>


<?php
	$xl=0;
	$form_contents=$form_contents. '<div class="table-responsive"> <table class="table"> <tbody>';
	foreach($title_array_fsl as $key => $title_array_single){
	
	
		//$content_array['files']='';
		//$form_contents=$form_contents. '<h5 class="mb-2 fs-0 '.$class_array[$key].'">'.explode('---',$title_array_single)[0].'</h5><p class="text-word-break fs--1 '.$class_array[$key].'">'.$content_array[$key].'</p>';

	//	if($key !='files'){
				//$form_contents=$form_contents. '<tr><td><h5 class="mb-2 fs-0  ">'.explode('---',$title_array_single)[0].'</h5></td><td><p class="text-word-break fs--1  ">'.$content_array[$key].'</p></td></tr>';
				$form_contents=$form_contents. '<tr><td style="width:25%"><h6>'.explode('---',$title_array_single)[0].'</h6></td><td>'.$content_array[$key].'</td></tr>';
		/*	}else{
			$file_content=$content_array[$key];
			}*/
		
		
		$xl++; }
		$form_contents=$form_contents. '</tbody></table>';
		
		
		
		/*if($t_name=='tender_books'){
				 $finals=$form_contents; 
    			$query1="select * from tbl_users,tender_documents where (`tender_documents`.`creator`=`tbl_users`.`userID` OR `tender_documents`.`modifier`=`tbl_users`.`userID`) AND `tender_documents`.`is_key`='1' order by tender_documents desc";
				$result1=mysqli_query($connect,$query1);  $rowcount1=mysqli_num_rows($result1); $row1 = mysqli_fetch_all($result1,MYSQLI_ASSOC);
				
				for($j=$rowcount1-1;$j>=0;$j--)
				{  //echo $j;
					$str=$row1[$j]['tender_documents'];
				    //$str = str_replace(array("\r", "\n"), '', $str); 
					
					$finals=str_replace('['.$str.']',$row1[$j]['details'],$finals);
					$finals=str_replace('Created on','',$finals);
					$finals=str_replace($row1[$j]['userName'],'',$finals);
					$finals=str_replace($row1[$j]['created'],'',$finals);
					$finals=str_replace('And Last Modified','',$finals);
					$finals=str_replace($row1[$j]['modified'],'',$finals);
					$finals=str_replace($row1[$j]['userName'],'',$finals);
					$finals=str_replace('By','',$finals);
					$finals=str_replace('//','',$finals);
 

				}		
				$form_contents=$finals;
			}*/
?>
		
		
<div class="modal fade" id="add_new_button2" data-bs-keyboard="false"   tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg mt-6" role="document">
    <div class="modal-content border-0 modal_content_margin">
      <div class="position-absolute top-0 end-0 mt-3 me-3 z-index-1"><button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button></div>
      <div class="modal-body p-0">
        <div class="bg-light rounded-top-lg py-3 ps-4 pe-6  "style="
    padding-top: 5px !important;
    padding-bottom: 1px !important;
">
          <h4 class="mb-1" id="staticBackdropLabel"> <?php echo $export_title; ?> <span onclick="pri('<?php echo $export_title;?>')" class="  " style="      display: inline-block;
    /* height: 2em; */
    position: relative;
    width: 2.5em;  cursor: pointer;text-align:right"> <i class=" far fa-file-pdf text-primary  " data-fa-transform="shrink-2"></i></span></h4>
		  
          <p class="fs--2 mb-0 d-none">Added by <a class="link-600 fw-semi-bold" href="#!">user</a></p>
        </div>
        <div class="p-4">
          <div class="row">
		  <div class="col-lg-12"style="
 
">
		  <?php echo $file_content; ?>
		  </div>
            <div class="col-lg-12"  id='print_here'>
              <div class="">
			  
                <div class="flex-1">
<p class="text-word-break fs--1">	
		
		
		<?php
		  echo $form_contents;
		?>
		
		
		
		
		<?php
		if($another_string!=''){
				echo ''.$another_string;
			}
		
		?>
		
                </p>  <hr class="my-4" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php 
	
	if($button_expand_click=='click'){ echo  ' <script>  document.getElementById(\'this_modal\').click();</script>';
		}
	} else {echo $form_content; }
 

	?>