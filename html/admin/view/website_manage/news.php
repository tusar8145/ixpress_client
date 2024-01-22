<?php

 
 
$currentPage ='News';
$title ='News';
include('../../header.php'); 
 
$export_title="News -ECL";
$export_columns="[ 0, 1, 2, 3 ]";
 
		 
?>

<p>
  <a class="btn btn-falcon-default mt-2" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><span class="  far fa-plus-square"></span> Add new</a>
  <!--<button class="btn btn-falcon-default ms-sm-2 mt-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Button with data-bs-target</button>-->
</p>
<div class="collapse" id="collapseExample">
  <div class="border p-card rounded">
 <form method="post" id="news" >    

 <?php 
 //make_form -v. 1.0
 echo make_form('News Title@r@t=  #News Brief@r@t= #News Details@r@t= #Freature Image@@t=',//Label@Required=>r@HTML=>t=
		        'input#area#area@tiny#file@single',//type
		        'news #brief #details #image',//id,column_name
				'ind_class	#	#tinymce#',//classes
		        'custom_class',//class
				' 			 #				 #		 #',//placeholder
				'Save@news_button@insert',//Print_button@button_id@action
				'news');//table name
 ?>
 
 </form>
 
   
<!-- <form class="dropzone dropzone-multiple p-0" id="my-awesome-dropzone" data-dropzone="data-dropzone" action="#!">
  <div class="fallback"><input name="file" type="file" multiple="multiple" /></div>
  <div class="dz-message" data-dz-message="data-dz-message"> <img class="me-2" src="<?php echo $base_u; ?>assets/img/icons/cloud-upload.svg" width="25" alt="" />Drop your files here</div>
  <div class="dz-preview dz-preview-multiple m-0 d-flex flex-column">
    <div class="d-flex media align-items-center mb-3 pb-3 border-bottom btn-reveal-trigger"><img class="dz-image" src="<?php echo $base_u; ?>assets/img/generic/image-file-2.png" alt="..." data-dz-thumbnail="data-dz-thumbnail" />
      <div class="flex-1 d-flex flex-between-center">
        <div>
          <h6 data-dz-name="data-dz-name"></h6>
          <div class="d-flex align-items-center">
            <p class="mb-0 fs--1 text-400 lh-1" data-dz-size="data-dz-size"></p>
            <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress=""></span></div>
          </div>
        </div>
        <div class="dropdown font-sans-serif"><button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal dropdown-caret-none" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h"></span></button>
          <div class="dropdown-menu dropdown-menu-end border py-2"><a class="dropdown-item" href="#!" data-dz-remove="data-dz-remove">Remove File</a></div>
        </div>
      </div>
    </div>
  </div>
</form>  -->
   
   
   
   
   </div>
</div>


 <?php echo table_start('SL,News,Brief,Created,Action,Make as Seen#text-end','fs--2','All News'); ?>
    <tbody>

						<?php	include('../../../config.php'); 								$sl=1;
							$qry="select * from news  order by news_id desc ";
							$result=mysqli_query($conn,$qry);
							$rowcount=mysqli_num_rows($result);
							$row = mysqli_fetch_all($result,MYSQLI_ASSOC);
							for($i=0;$i<$rowcount;$i++)
							{
								 
								
								$c_switch=$row[$i]["is_key"];
									if($c_switch=='1'){$checkedchecked='checked'; $checkedchecked_0=0; $k_d='Seen';} else {$checkedchecked='no'; $checkedchecked_0=1;  $k_d='';}
								
								
								if($sl==1){ $ftable_row='d'.$row[$i]["news_id"]; }
								
								echo ' 		
								
								<tr id="d'.$row[$i]["news_id"].'">	
								<td>  '.$sl.'</td>
								<td class="fs--2">  '.wordwrap($row[$i]["news"], 30, "<br>", false).'    <b>'.$k_d.'</b></td>
 
								<td  class="fs--2" style="white-space: break-spaces;">'.$row[$i]["brief"].'</td>
								<td  class="fs--2" style="white-space: break-spaces;">'.$row[$i]["created"].'</td>
							 
								 
								
								<td  class="fs--2">  
								
								
								<div>
								<a href="email_send.php?ad='.$row[$i]["email"].'"  >
									<button class="btn p-0" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Reply" aria-label="Edit">
										<svg class="svg-inline--fa fa-edit fa-w-18 text-500" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="edit" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z"></path></svg>
									</button>
								</a>
								
								<button   onclick="deleteme('.$row[$i]["news_id"].','.'\'news\''.','.'\'news_id\''.','.'\'0\''.','.'\'basic\''.')"   class="btn p-0 ms-2"   data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete"><svg class="svg-inline--fa fa-trash-alt fa-w-14 text-500" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M32 464a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128H32zm272-256a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zM432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16z"></path></svg>
								</button>
								
								</div>
						 
								<input type="text"  style="display:none; " name="news_id"value="'.$row[$i]["news_id"].'"   class="form-control"   placeholder="Enter ...">
								 
								
								
								</td>
								<td  class="fs--2">  
						';    
								 
								?>
 
 					
 <div class="form-check form-switch">
  <input  class="form-check-input ms-0 radi" type="checkbox"  id="change_switch1" onclick="mark('<?php echo $row[$i]['news_id'];?>','news','news_id','is_key','','1')"  value="1" <?php if($c_switch==1){ ?>  checked="checked"<?php }?>  name="change_switch1"  <?php echo $checkedchecked; ?> >
</div>	
 
 					
								
							<?php	
								echo '		
								
								</td></tr>  '; 
								
								$sl++;	 
							}   ?> 

    </tbody>

  <?php echo table_end('SL,News,Brief,Created,Action,Make as Seen#text-end','fs--2'); ?>

	

 
 
 
 
		
		

        
<?php include('../../footer.php'); ?>


