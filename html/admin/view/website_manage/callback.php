<?php

$currentPage ='Call Back';
$title ='Call Back';
include('../../header.php'); 
  
 
$export_title="Callback -ECL";
$export_columns="[ 0, 1, 2 ]";
 
		 
?>


 <?php echo table_start('SL,Callback Number,Created,Action,Make as Seen#text-end','fs--2','All callback'); ?>
    

						<tbody>

						<?php	include('../../../config.php'); 								$sl=1;
  						$sl=1;
							$qry="select * from callback  order by callback_id ASC ";
							$result=mysqli_query($conn,$qry);
							$rowcount=mysqli_num_rows($result);
							$row = mysqli_fetch_all($result,MYSQLI_ASSOC);
							for($i=0;$i<$rowcount;$i++)
							{
								  
								$c_switch=$row[$i]["is_key"];
									if($c_switch=='1'){$checkedchecked='checked'; $checkedchecked_0=0; $k_d='Seen';} else {$checkedchecked='no'; $checkedchecked_0=1;  $k_d='';}
								
								if($sl==1){ $ftable_row='d'.$row[$i]["callback_id"]; }
								echo ' 		
								
								<tr id="d'.$row[$i]["callback_id"].'">	
								<td  class="fs-0">    '.$sl.'</td>
								<td  class="fs-0">    '.wordwrap($row[$i]["callback"], 30, "<br>", false).'    <b>'.$k_d.'</b></td>
							
								 
			 
								 	<td  class="fs-0">  '.$row[$i]["created"].'</td>
								 
								
								<td  class="fs-0">  
								
								
								<div>
 
								<button   onclick="deleteme(\''.$row[$i]["callback_id"].'\','.'\'callback\''.','.'\'callback_id\''.','.'\'0\''.','.'\'1\''.')"   class="btn p-0 ms-2"   data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete"><svg class="svg-inline--fa fa-trash-alt fa-w-14 text-500" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M32 464a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128H32zm272-256a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zM432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16z"></path></svg>
								</button>
								
								</div>
						 
								<input type="text"  style="display:none; " name="callback_id"value="'.$row[$i]["callback_id"].'"   class="form-control"   placeholder="Enter ...">
								 
								
								
								</td>
								<td  class="fs-0 text-end"  > 
								
								 
						';    
								 
								?>
 
 					
 <div class="form-check form-switch" >
  <input  class="form-check-input ms-0 radi" type="checkbox"  id="change_switch1" onclick="mark('<?php echo $row[$i]['callback_id'];?>','callback','callback_id','is_key','','1')"  value="1" <?php if($c_switch==1){ ?>  checked="checked"<?php }?>  name="change_switch1"  <?php echo $checkedchecked; ?> >
</div>	
								
 
 
 					
								
							<?php	
								echo '		
								
								</td></tr>  '; 
								
								$sl++;	 
							}   ?> 

     </tbody>
 
  <?php echo table_end('SL,Callback Number,Created,Action,Make as Seen#text-end','fs--2'); ?>

	

 
 
 
 
		
		

        
<?php include('../../footer.php'); ?>


