 
 
 
 
 
 <?php

$staff_list='';
$temp1='';
$rfp_iden2='';
$name_of_client2='';

 
	function phpAlert($msg) { echo '<script type="text/javascript">alert("' . $msg . '")</script>'; }
	include('config.php');


     $doc_id=$_GET['doc'];
	$user=$_GET['user'];

	//$doc_id=$_POST['doc_id'];	
	$query2="select * from tender_documents WHERE tender_documents_id='$doc_id'";
	$result2=mysqli_query($connect,$query2);  $rowcount2=mysqli_num_rows($result2); $row2 = mysqli_fetch_all($result2,MYSQLI_ASSOC);
	for($k=$rowcount2-1;$k>=0;$k--)
	{  
			 $memo=$row2[$k]['memo'];
 //echo 'memo'.$memo;
 
 
				$tender_books=$row2[$k]['tender_books'];
				$query2x="select * from tender_rfp_documents WHERE tender_books='$tender_books'";
				$result2x=mysqli_query($connect,$query2x);  $rowcount2x=mysqli_num_rows($result2x); $row2x = mysqli_fetch_all($result2x,MYSQLI_ASSOC);
				$tender_rfp_documents=$row2x[0]['tender_rfp_documents_id'];
	
	
		//	 $tender_rfp_documents=$row2[$k]['tender_rfp_documents'];
			 $tender_details=$row2[$k]['details'];
			 
			 $tender_documents=$row2[$k]['tender_documents'];		
			 $tender_documents_id=$row2[$k]['tender_documents_id'];	
			 
			 $tender_documents_tags=$row2[$k]['tender_documents_tags'];	
			 $tender_documents_tags_array=explode(',',$tender_documents_tags);	
				if (in_array("9", $tender_documents_tags_array))
				  {
				$landscape='1';
				  }
				else
				  {
				$landscape='0';
				  }		
			 $tender_phase=$row2[$k]['tender_phase'];					 
			 $tender_documents_details=$row2[$k]['details'];	
 

			 
	}
	
	
if($memo==''){
$d1 = new DateTime('now', new DateTimezone('Asia/Dhaka'));   $t_details=$d1->format('Ymd'); 
$memo='S'.$doc_id.$t_details;

 $query = "UPDATE 	tender_documents   SET memo='$memo' WHERE tender_documents_id='$tender_documents_id' ";
try{$update_Result = mysqli_query($connect, $query);if($update_Result){if(mysqli_affected_rows($connect) > 0)
{$say='Update Successful'; 
 
	}else{$say='Update Fail';}}} catch (Exception $ex) { }					
	
}
	//echo $say;
	
	
	
	$query2="select tender_phase from tender_phase WHERE tender_phase_id='$tender_phase'";
	$result2=mysqli_query($connect,$query2);  $rowcount2=mysqli_num_rows($result2); $row2 = mysqli_fetch_all($result2,MYSQLI_ASSOC);
	$tender_phase=$row2[0]['tender_phase'];	
		
 
  function convert_time_to_days($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
} 
   
   
   
 ?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
  <title>Documents</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel='stylesheet' href='https://www.tiny.cloud/css/codepen.min.css'>
<link rel='stylesheet' href='https://unpkg.com/mathlive/dist/mathlive.core.css'>
<link rel='stylesheet' href='https://unpkg.com/mathlive/dist/mathlive.css'>
 
</head>
<style>
	.title{font-size: 25px;
    font-weight: bold;}
	.width-1{width:5% !important;; }
	.width-2{width:35% !important;; }
	.width-3{width:60% !important;; }
	.td_0{border:1px solid white!important; padding:0px !important; margin:0px !important;}
	td { color: black !important; }
	
	@media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }
}


.ML__keyboard.is-visible {
  z-index: 9999;
}

.ML__keyboard div .rows > ul > li {
  background: #fff !important;
  border-bottom-color: #8d8f92 !important;
}
.ML__keyboard div .rows > ul > li.separator {
  background: transparent !important;
  border: none !important;
  pointer-events: none !important;
}

.ML__keyboard div .rows > ul > li.action.font-glyph[data-alt-keys=delete],
.ML__keyboard div .rows > ul > li.modifier.font-glyph[data-alt-keys=delete] {
  font-size: 34px;
  align-items: center;
}

.sr-only {
  position: absolute !important;
  width: 1px !important;
  height: 1px !important;
  overflow: hidden;
}

.tox .mathlive-input {
  border: 1px solid #207ab7 !important;
  border-radius: 4px !important;
  min-height: 40px !important;
  box-sizing: border-box !important;
  position: static !important;
}
.tox .mathlive-input * {
  position: relative;
}
.tox .mathlive-input .ML__textarea__textarea {
  width: 1px;
  height: 1px;
  position: absolute;
}
.tox .mathlive-input .ML__fieldcontainer__field {
  width: 100%;
}
.tox .mathlive-input .ML__virtual-keyboard-toggle {
  width: 34px;
  height: 34px;
}
.tox .tox-dialog-wrap {
  position: fixed;
}
.tox .tox-dialog.mathlive {
  overflow: visible;
}
.tox .tox-dialog.mathlive .tox-dialog__body-content {
  overflow: visible;
  max-width: 100%;
}
</style>
<body  id="page-content">


<div class="well well-sm no-print">
<div class="container ">
	<!--<a class="word-export" href="javascript:void(0)"> Export as .doc </a> -->
  <p  class="text-center "><?php echo $tender_documents; ?> [ ID=<?php echo $memo; ?>]</p>
     <button type="submit" onclick="save()" style="
    position: fixed;
    right: 0px;
	top:0px;
	z-index: 99999;
"  class="btn btn-danger">Save</button>     
<button type="submit" onclick="print()" style="
    position: fixed;
    right: 50px;
	top:0px;
	z-index: 99999;
"  class="btn btn-danger">Print</button>

<?php
$p=0;
 $query2m="select * from  tbl_users";
	$result2m=mysqli_query($connect,$query2m);  $rowcount2m=mysqli_num_rows($result2m); $row2m = mysqli_fetch_all($result2m,MYSQLI_ASSOC);
	for($km=$rowcount2m-1;$km>=0;$km--)
	{
$this_user=$row2m[$km]['userID'];

 $query2="select tbl_users.userName as userName,tender_change.details as details,tender_change.created as created  from tender_change,tbl_users where tbl_users.userID=tender_change.creator and tender_change.creator='$this_user' and tender_change.tender_documents='$doc_id' ";
	$result2=mysqli_query($connect,$query2);  $rowcount2=mysqli_num_rows($result2); $row2 = mysqli_fetch_all($result2,MYSQLI_ASSOC);
	for($k=$rowcount2-1;$k>=0;$k--)
	{  
		$p++;	 $creator=$row2[$k]['userName'];
		$crea=$row2[$k]['created'];
			// $tender_details=$row2[$k]['details'];
	 if($k==$rowcount2-1){
	echo '
	   <div id="accordion">
    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#collapseOne">
         '.$creator.' ('.$rowcount2.')
        </a>
      </div>
      <div id="collapseOne" class="collapse " data-parent="#accordion">
        <div class="card-body">';
	 }
 
 echo  '<li class="list-group-item">'.$crea.' <x style="margin-left:25px;cursor: pointer;" class="btn btn-success btn-xs"  onclick="save_pre(\''.$p.'\')">load => '.convert_time_to_days($crea).'</x></li>

<div style="display:none" id="previewx'.$p.'">
'.$row2[$k]['details'].' 
</div> 

 ';

 
 if($k==0){
      	echo '  </div>
      </div>
    </div>
    </div>';
 }
	
	 
			  
	}
	
	}
?>


	
	
	
	
  </div>
  
</div>
 
  
  

<input id="docId" style="display:none" value="<?php echo $tender_documents_id;  ?>">
<input id="user_id" style="display:none " value="<?php echo $user;  ?>">
  
  
  
  
<textarea id="editor"><?php echo $all_content; 

if($tender_phase=='CV Documents' || $tender_phase=='Document Registrar' || $tender_phase=='Others'){
if($tender_details=='' && $tender_rfp_documents!=''){
	
	    $query2="select * from tender_rfp_documents WHERE tender_rfp_documents_id='$tender_rfp_documents'";
		$result2=mysqli_query($connect,$query2);  $rowcount2=mysqli_num_rows($result2); $row2 = mysqli_fetch_all($result2,MYSQLI_ASSOC);
		$identification=$row2[0]['identification'];		
		$clients=$row2[0]['p_clients'];		
		$staff_involve=$row2[0]['staff_involve'];		

	    $query2="select * from p_clients WHERE p_clients_id='$clients'";
		$result2=mysqli_query($connect,$query2);  $rowcount2=mysqli_num_rows($result2); $row2 = mysqli_fetch_all($result2,MYSQLI_ASSOC);
		$p_clients=$row2[0]['p_clients'];		
 
$t1= explode(']',explode('[',explode('"Position"',$staff_involve)[0])[1])[0];
$t1=str_replace('"','',$t1);
$name_array=explode(',',$t1);

$t2= explode(']',explode('[',explode('"Position"',$staff_involve)[1])[1])[0];
$t2=str_replace('"','',$t2);
$position_array=explode(',',$t2);
	
$xx=0; $staff_st='';
foreach($name_array as $name_array_single){
	
	    $query2="select * from p_cv_staff WHERE p_cv_staff_id='$name_array_single'";
		$result2=mysqli_query($connect,$query2);  $rowcount2=mysqli_num_rows($result2); $row2 = mysqli_fetch_all($result2,MYSQLI_ASSOC);
		$p_cv_staff=$row2[0]['p_cv_staff'];	
	
	    $staff_st=$staff_st.'#'.$p_cv_staff.'[position]'.$position_array[$xx].'#<br>'; $xx++;
}	
	$this_xx=explode('#[position]#',$staff_st)[0];
$contents_go='
[RFP IDENTIFICATION NO.]'.$identification.'<br>
[Name of The Client]'.$p_clients.',
<br><br><br> '.$this_xx.'';	echo $contents_go;}}
?> 

  </textarea>
  
  
  
  
  
  
  
  

  
  
<?php if($tender_phase=='PDS -With Contract Value' || $tender_phase=='PDS -Without Contract Value'){
	    $query2="select * from tender_rfp_documents WHERE tender_rfp_documents_id='$tender_rfp_documents'";
		$result2=mysqli_query($connect,$query2);  $rowcount2=mysqli_num_rows($result2); $row2 = mysqli_fetch_all($result2,MYSQLI_ASSOC);
		$pds=$row2[0]['pds'];		
		$clients=$row2[0]['p_clients'];		
		$staff_involve=$row2[0]['staff_involve'];
?>
<div class="container" style="margin-top:25px;display:none" class='editable'  id='contents' >
 




<?php 

	$pds_array=explode(',',$pds);
	$staff_head=0;  $sl=0;  foreach($pds_array as $pds_array_single ){  

  						$query="select * from p_projects WHERE p_projects_id='$pds_array_single'";
						$result=mysqli_query($connect,$query); $rowcount=mysqli_num_rows($result); $row = mysqli_fetch_all($result,MYSQLI_ASSOC);
						for($i=$rowcount-1;$i>=0;$i--)
						{  $sl++;  
 
  ?>	
  <p class="text-center title" style="text-align: center; font-size:20px;">
	<b> Form 5A2  Consultant’s Organization and Experience<br>
	Major Works Undertaken that best Illustrates Qualifications 
	</b>
</p> 

  <table class="table table-bordeblack" style="margin-top:20px"  >
    <tbody> 
       <tr>
        <td colspan="2"  style=" padding:3px; margin:0px; border: 1px solid black !important; width:50% "><b>Assignment Name:<u><?php echo $row[$i]['project_name'];?></u></b></td>
        <td colspan="2" style="  padding:3px; margin:0px;  border: 1px solid black !important; width:50% "><b>Approx value of the Contract:</b><?php echo $row[$i]['project_cost']; ?></td>
      </tr>
	  
	  
       <tr>
        <td  colspan="2" style="  padding:3px; margin:0px;  border: 1px solid black !important; width:50% "><b>Country:</b><?php 
		$cid=$row[$i]['country'];
	    $query2="select * from country WHERE country_id='$cid'";
		$result2=mysqli_query($connect,$query2);  $rowcount2=mysqli_num_rows($result2); $row2 = mysqli_fetch_all($result2,MYSQLI_ASSOC);
		$countrys=$row2[0]['country'];			
		
		echo $countrys;?><br><b>Location within country</b><?php echo $row[$i]['in_location'];?></td>
        <td  colspan="2" style=" padding:3px; margin:0px;   border: 1px solid black !important; width:50% ">Duration of assignment (months): <?php echo $row[$i]['staff_months'];?> months.</td>
      </tr> 


	  <?php if($tender_phase=='PDS -With Contract Value'){?>
       <tr>
        <td  colspan="2" style="  padding:3px; margin:0px;  border: 1px solid black !important; width:50% "><b>Name of Client:</b><?php 
		$cid=$row[$i]['p_clients'];
	    $query2="select * from p_clients WHERE p_clients_id='$cid'";
		$result2=mysqli_query($connect,$query2);  $rowcount2=mysqli_num_rows($result2); $row2 = mysqli_fetch_all($result2,MYSQLI_ASSOC);
		$countrys=$row2[0]['p_clients'];			
		
		echo $countrys;
		echo '<br>Address:'.$row2[0]['client_address'];
		
		
		?></td>
        <td  colspan="2" style=" padding:3px; margin:0px;   border: 1px solid black !important; width:50% ">
		Total No. of Staff-Months of the assignment: <?php echo $row[$i]['staff_months'];?> man months. </td>
      </tr>   

       <tr>
        <td colspan="1" style=" padding:3px; margin:0px;  border: 1px solid black !important; "><b>Start Date:</b><br>(Month/Year)<br><?php  $orgDate = substr($row[$i]['start_date'], 0, 10); $newDate = date("M-Y", strtotime($orgDate)); echo $newDate;?></td>
        <td colspan="1"  style=" padding:3px; margin:0px;  border: 1px solid black !important; "><b>Completion Date:</b><br>(Month/Year)<br><?php $orgDate = substr($row[$i]['end_date'], 0, 10); $newDate = date("M-Y", strtotime($orgDate)); echo $newDate; ?><br>(Design Phase Completed)</td>
		<td  colspan="2"  style=" padding:3px; margin:0px;   border: 1px solid black !important;  ">Approx value of services provided by your firm under the contract Tk.   Lacs. </td>	
	 </tr> 
<?php }else { ?>
	 
       <tr>
        <td  colspan="2" style="  padding:3px; margin:0px;  border: 1px solid black !important; width:50% "><b>Name of Client:</b><?php 
		$cid=$row[$i]['p_clients'];
	    $query2="select * from p_clients WHERE p_clients_id='$cid'";
		$result2=mysqli_query($connect,$query2);  $rowcount2=mysqli_num_rows($result2); $row2 = mysqli_fetch_all($result2,MYSQLI_ASSOC);
		$countrys=$row2[0]['p_clients'];			
		
		echo $countrys;
		echo '<br>Address:'.$row2[0]['client_address'];
		
		
		?></td>
        <td  colspan="2" rowspan="2" style=" padding:3px; margin:0px;   border: 1px solid black !important; width:50% ">
		Professional staff provided by our Organization:<br>
No of Staff: <br>

No. of Staff-Months: <?php echo $row[$i]['staff_months'];?>  man months.<br>
</td>
      </tr>   

       <tr>
        <td colspan="1" style=" padding:3px; margin:0px;  border: 1px solid black !important; "><b>Start Date:</b><br>(Month/Year)<br><?php  $orgDate = substr($row[$i]['start_date'], 0, 10); $newDate = date("M-Y", strtotime($orgDate)); echo $newDate;?></td>
        <td colspan="1"  style=" padding:3px; margin:0px;  border: 1px solid black !important; "><b>Completion Date:</b><br>(Month/Year)<br><?php $orgDate = substr($row[$i]['end_date'], 0, 10); $newDate = date("M-Y", strtotime($orgDate)); echo $newDate; ?><br>(Design Phase Completed)</td>
	 </tr> 	 
	 
<?php } ?>	  
       <tr>
        <td  colspan="2" style="  padding:3px; margin:0px;  border: 1px solid black !important; width:50% "><b>Name of Joint Venture/Associated Consultants, if any: N/A:</b>
		<?php 
		$cid=$row[$i]['p_clients'];
	    $query2="select * from p_clients WHERE p_clients_id='$cid'";
		$result2=mysqli_query($connect,$query2);  $rowcount2=mysqli_num_rows($result2); $row2 = mysqli_fetch_all($result2,MYSQLI_ASSOC);
		$countrys=$row2[0]['p_clients'];			
		
		//echo $countrys;
		?>
		</td>
        <td  colspan="2" style=" padding:3px; margin:0px;   border: 1px solid black !important; width:50% ">
		No of Staff-Months of key professional staff provided by Joint Venture/Associated Consultants: N/A</td>
      </tr>  
	  
       <tr>
        <td colspan="4" style="  padding:3px; margin:0px;  border: 1px solid black !important; width:100% "><b>Name of Senior Professional Staff:</b> (Project Director/Coordinator, Team leader) involved and functions performed:
		<?php 
		$cid=$row[$i]['p_clients'];
	    $query2="select * from p_clients WHERE p_clients_id='$cid'";
		$result2=mysqli_query($connect,$query2);  $rowcount2=mysqli_num_rows($result2); $row2 = mysqli_fetch_all($result2,MYSQLI_ASSOC);
		$countrys=$row2[0]['p_clients'];			
		
		//echo $countrys;
		?>
		</td>
	   </tr> 
	   
	   <tr> 
        <td  colspan="4"  style=" padding:3px; margin:0px;   border: 1px solid black !important; width:100% ">
		<b>Narrative Description of Project: The project is comprised of:</b><br>
		<?php echo $row[$i]['project_description'];?>
		<b>(The Project Cost is Taka: <?php echo $row[$i]['project_cost'];?>.)</b></td>
      </tr> 	   
	   <tr> 
        <td  colspan="4"  style=" padding:3px; margin:0px;   border: 1px solid black !important; width:100% ">
		<b><u>Description of Actual Services Provided by our staff:</u></b><br>
		<?php echo $row[$i]['service_render'];?>
		</td>
      </tr>  
    </tbody>
  </table>  
 <table class="table table-bordeblack" style="margin-top:20px"  >
    <tbody> 
       <tr>
        <td style=" padding:3px; margin:0px; border: 1px solid black !important; width:20% ;"><b>Firm’s Name</b> </td>
        <td style="  padding:3px; margin:0px;  border: 1px solid black !important; width:70%; "><b>Engineers Consortium Ltd.</b></td>
      </tr> 
       <tr>
        <td style=" padding:3px; margin:0px; border: 1px solid black !important; width:20% ;"><b>Authorized Signature:</b> </td>
        <td style="  padding:13px; margin:0px;  border: 1px solid black !important; width:70%; "></td>
      </tr>		
    </tbody>
  </table> 	

  
  <!-- pagebreak -->
  <?php
	}
}
?> 
  

  

     <!-- <tr>
        <td style="border: 1px solid black !important ;">
			
			<table  class=" " style='width:100%;border: 0px;'>
			  <tr>
					<td class="width-1 td_0">1</td>
					<td  class="width-2 td_0">Proposed Position for this project</td>
					<td  class="width-3 td_0"><?php echo $exectly_man_position2; ?></td>
				  </tr>
				  <tr>
					<td class="width-1 td_0">2</td>
					<td class="width-2 td_0"> Name of Staff</td>
					<td class="width-3 td_0"><b><?php echo $row[$i]['p_cv_staff']; ?></b></td>
				  </tr>
				  <tr>
					<td class="width-1 td_0">3</td>
					<td class="width-2 td_0">Date of Birth</td>
					<td class="width-3 td_0"><?php   echo $newDate = date("d M, Y", strtotime($row[$i]['birth_date']));  ?> </td>
				  </tr>
				  <tr>
					<td class="width-1 td_0">4</td>
					<td class="width-2 td_0">Nationality</td>
					<td class="width-3 td_0"><?php echo $row[$i]['nationality']; ?>  by birth</td>
				  </tr>
			</table>

		</td>
      </tr>
	  
  
      <tr>
        <td  style="  border: 1px solid black !important;">
			<table  class=" " style='width:100%;border: 0px;'>
			  <tr>
					<td class="width-1 td_0">11</td>
					<td  class="width-2 td_0">WORK UNDERTAKEN THAT BEST ILLUSTRATES HIS CAPABILITY TO HANDLE THIS ASSIGNMENT.</td>
					<td  class="width-3 td_0">Works undertaken that best illustrates the capability of Abu Saleh Md. Main Uddin as “Team Leader” to handle this assignment are as follows:
					<?php echo $row[$i]['work_experience']; ?>
					</td>
				  </tr>
			</table>			
		</td>
      </tr>-->
      

  
  
</div>
 
<?php } ?>

  
  
  
  
  
  
  
  
  
  
    
  
<?php if($tender_phase=='PDS List'){
	    $query2="select * from tender_rfp_documents WHERE tender_rfp_documents_id='$tender_rfp_documents'";
		$result2=mysqli_query($connect,$query2);  $rowcount2=mysqli_num_rows($result2); $row2 = mysqli_fetch_all($result2,MYSQLI_ASSOC);
		$pds=$row2[0]['pds'];		
		$clients=$row2[0]['p_clients'];		
		$staff_involve=$row2[0]['staff_involve'];
?>
<div class="container" style="margin-top:25px;display:none" class='editable'  id='contents' >
<?php 

	$pds_array=explode(',',$pds);
	$staff_head=0;  $sl=0;  foreach($pds_array as $pds_array_single ){  

 
	if($staff_head==0){
		echo '
	<p class="text-center title" style="text-align: center; font-size:20px;"><b><u>Work in Hand</u></b></p>    
							<table class="table table-bordeblack" style="margin-bottom:100px;margin-top:50px;">
	   <thead>
		  <tr style="background:lightgray;padding:2px;">
			<th style="padding: 1px !important; color:black !important; margin: 0px !important;">Sl No.</th>
			<th style="padding: 1px !important;  color:black !important; margin: 0px !important;">Name and Location of the Project</th>
			<th style="padding: 1px !important;  color:black !important; margin: 0px !important;">Project Description</th>
			<th style="padding: 1px !important;  color:black !important; margin: 0px !important;">Project in (Taka)</th>
			<th style="padding: 1px !important;  color:black !important; margin: 0px !important;">Year of Starting </th>
			<th style="padding: 1px !important;  color:black !important; margin: 0px !important;">Year of  Completion  </th>
			<th style="padding: 1px !important;  color:black !important; margin: 0px !important;">Services Rendered by the firm </th>
		  </tr>
		</thead>
		<tbody>	';
	}

	$staff_head++;

 
  						$query="select * from p_projects WHERE p_projects_id='$pds_array_single'";
						$result=mysqli_query($connect,$query); $rowcount=mysqli_num_rows($result); $row = mysqli_fetch_all($result,MYSQLI_ASSOC);
						for($i=$rowcount-1;$i>=0;$i--)
						{  $sl++;  
 
  ?>	
 
       <tr>
        <td style="  border: 0px solid black !important;  "><?php echo $sl;?></td>
        <td style="  border: 0px solid black !important; "><?php echo '<b>'.$row[$i]['project_name'].'</b>'.$row[$i]['in_location']; ?></td>
        <td style="  border: 0px solid black !important;  text-align:justify; "><?php echo $row[$i]['project_description']; ?></td>
        <td style="  border: 0px solid black !important;  "><?php echo $row[$i]['project_cost']; ?></td>
        <td style="  border: 0px solid black !important;  "><?php $orgDate = substr($row[$i]['start_date'], 0, 10); $newDate = date("M-Y", strtotime($orgDate)); echo $newDate; ?></td>
        <td style="  border: 0px solid black !important; "><?php $orgDate = substr($row[$i]['end_date'], 0, 10); $newDate = date("M-Y", strtotime($orgDate)); echo $newDate; ?></td>
        <td style="  border: 0px solid black !important; "><?php echo $row[$i]['service_render']; ?></td>
      </tr>
	  

  <?php
	}
}
?> 
  
  	    </tbody> 
  </table>
</div>
 
<?php } ?>
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
<?php if($tender_phase=='CV Documents' || $tender_phase=='Document Registrar' || $tender_phase=='Others' ){ ?>
<div class="container" style="margin-top:25px;display:none" class='editable'  id='contents' >

 	<?php 
	    //$first=explode('cv-start',$tender_documents_details)[0];
		$staff_head=0;
		$cv_man_array=explode('#',$tender_documents_details);
		//$end=explode('cv-start',$tender_documents_details)[2];
		
		//$cv_man_array=explode('#',$cv_man);
		?>
	
	
<?php	  $sl=0;  foreach($cv_man_array as $cv_man_array_single ){  


$exectly_man_position=explode('[position]',$cv_man_array_single)[1];

if($exectly_man_position !='')
	{
if($staff_head==0){
	echo '
<p class="text-center title" style="text-align: center; font-size:20px;"><b><u>CV OF THE KEY STAFF/PROFESSIONAL</u></b></p>    
						<table class="table table-bordeblack" style="margin-bottom:100px;margin-top:50px;">
   <thead>
      <tr style="background:lightgray;padding:2px;">
        <th style="padding: 1px !important; color:black !important; margin: 0px !important;">Sl No.</th>
        <th style="padding: 1px !important;  color:black !important; margin: 0px !important;">Name</th>
        <th style="padding: 1px !important;  color:black !important; margin: 0px !important;">Education Qualification</th>
        <th style="padding: 1px !important;  color:black !important; margin: 0px !important;">Position Held</th>
        <th style="padding: 1px !important;  color:black !important; margin: 0px !important;">Year of Experience</th>
      </tr>
    </thead>
    <tbody>	';
}

$staff_head++;

 ?>	
  <!--<p class="text-center title">FORM 5A8 - CURRICULUM VITAE (CV) FOR TEAM LEADER</p>            -->
  
  
  <?php 
  
  						/*$query2="select * from tender_documents WHERE tender_documents_id='$tender_documents_id'";
						$result=mysqli_query($connect,$query); $rowcount=mysqli_num_rows($result); $row = mysqli_fetch_all($result,MYSQLI_ASSOC);
						for($i=$rowcount-1;$i>=0;$i--)
						{  
							 $doc_id=$row[$i]['tender_documents'];	*/	  
							 
							 
						$exectly_man=explode('[position]',$cv_man_array_single)[0];
						$exectly_man_position=explode('[position]',$cv_man_array_single)[1];
						
  						$query="select * from p_cv_staff WHERE p_cv_staff='$exectly_man'";
						$result=mysqli_query($connect,$query); $rowcount=mysqli_num_rows($result); $row = mysqli_fetch_all($result,MYSQLI_ASSOC);
						for($i=$rowcount-1;$i>=0;$i--)
						{  $sl++; //$staff_list=$staff_list.','.$exectly_man;
					
					
					$img=$row[$i]['files'];
					$img_array=explode(',',$img);
					foreach($img_array as $img_array_single){
						$staff_list=$staff_list."{ title: '".$row[$i]['p_cv_staff']."=>".$img_array_single."', value: 'https://engineersconsortiumltd.com.bd/ecl/uploads/staff/".$img_array_single."' },";
					}
					
						 //echo	$first;
  ?>	
  <?php if( $exectly_man_position !='') { ?>
	  <tr> <td style="  border: 0px solid black !important;   padding: 0px !important; color:black !important; margin: 0px !important;" ></td><td  colspan="2" style=" border: 0px solid black !important;       padding: 0px !important; color:black !important; margin: 0px !important;"><h3 style="margin-top:10px !important;font-size:21px !important;"><u><?php echo $exectly_man_position; ?></u></h3></td><td  style="   border: 0px solid black !important;    padding: 0px !important; color:black !important; margin: 0px !important;"></td><td   style=" border: 0px solid black !important;    padding: 0px !important; color:black !important; margin: 0px !important;  "></td></tr> <?php } ?>
      <tr>
        <td style="  border: 0px solid black !important; width:5%; "><?php echo $sl;?></td>
        <td style="  border: 0px solid black !important; width:20%; "><?php echo $row[$i]['p_cv_staff']; ?></td>
        <td style="  border: 0px solid black !important; width:50%; text-align:justify; "><?php echo $row[$i]['qualification']; ?></td>
        <td style="  border: 0px solid black !important; width:15%; "><?php echo $row[$i]['position']; ?></td>
        <td style="  border: 0px solid black !important; width:10%; "><?php if($row[$i]['experience']!=''){echo 2021-$row[$i]['experience'];} ?></td>
		</td>
      </tr>
	  

  <?php
	  } 
}}
	  ?> 
  
  	    </tbody> 
  </table> <div class="page-break dnone"  ></div>
  
  
  
	<?php //<!-- pagebreak -->
	    //$first=explode('cv-start',$tender_documents_details)[0];
		$cv_man_array=explode('#',$tender_documents_details);
		//$end=explode('cv-start',$tender_documents_details)[2];
		
		//$cv_man_array=explode('#',$cv_man);
		?>
	
	
	
<?php  foreach($cv_man_array as $cv_man_array_single ){    ?>	
            
  
  <?php 
  
  						/*$query2="select * from tender_documents WHERE tender_documents_id='$tender_documents_id'";
						$result=mysqli_query($connect,$query); $rowcount=mysqli_num_rows($result); $row = mysqli_fetch_all($result,MYSQLI_ASSOC);
						for($i=$rowcount-1;$i>=0;$i--)
						{  
							 $doc_id=$row[$i]['tender_documents'];	*/	  
							 
							 
						$exectly_man=explode('[position]',$cv_man_array_single)[0];	 
						$exectly_man_position=explode('[position]',$cv_man_array_single)[1];  if($exectly_man_position !=''){$exectly_man_position2=$exectly_man_position;}
  						$query="select * from p_cv_staff WHERE p_cv_staff='$exectly_man'";
						$result=mysqli_query($connect,$query); $rowcount=mysqli_num_rows($result); $row = mysqli_fetch_all($result,MYSQLI_ASSOC);
						if($rowcount==0){
								
								
								//$name_of_cons=explode(PHP_EOL,explode('[Name of the Consultant]', $exectly_man)[1])[0];
 
								$x1=$rfp_iden=explode('[Name of The Client]',explode(PHP_EOL,explode('[RFP IDENTIFICATION NO.]', $exectly_man)[1])[0])[0];
								$rfp_iden=substr($rfp_iden, 0, -1);
								$x2=$name_of_client=explode(PHP_EOL,explode('[Name of The Client]', $exectly_man)[1])[0];
								$name_of_client=explode(',',explode(PHP_EOL,explode('[Name of The Client]', $exectly_man)[1])[0])[0];
								/*$name_of_client=substr($name_of_client, 0, -1);
								$thetextstring = preg_replace("#[\s]+#", " ", $name_of_client);
								$words = explode(" ", $thetextstring);
								
								 
								foreach($words as $words_single)	{
										if($temp1==''){$temp1=$words_single;}else{$temp1=$temp1.' '.$words_single;}
									}
									$counter_=count($words);
								 $name_of_client=$counter_.$temp1;*/
								
								$doc_name=explode(',',explode('[doc]', $exectly_man)[1]);
								$doc_name_string='';
								foreach ($doc_name as $doc_name_single){
								if(explode('[doc]', $exectly_man)[1] !=''){
								//////////////////////////////
									
								if($doc_name_string==''){$doc_name_string=$doc_name_single;}	
								else {$doc_name_string=$doc_name_string.','.$doc_name_single;}
								
									$queryx="select * from tender_documents where tender_documents='$doc_name_single'";
									
									
									$resultx=mysqli_query($connect,$queryx);  $rowcountx=mysqli_num_rows($resultx); $rowx = mysqli_fetch_all($resultx,MYSQLI_ASSOC);
									for($ix=$rowcountx-1;$ix>=0;$ix--)
									{   
										echo  $rowx[$ix]['details'];
									} 
									
								}
								}
								//////////////////////////////
								
								
								
								if($rfp_iden==''){$rfp_iden=$rfp_iden2;}else{$rfp_iden2=$rfp_iden;}
								if($name_of_client==''){$name_of_client=$name_of_client2;}else{$name_of_client2=$name_of_client;}
								
								//replace
								
								$exectly_man=str_replace('[RFP IDENTIFICATION NO.]','',$exectly_man);
								$exectly_man=str_replace($x1,'',$exectly_man);
								$exectly_man=str_replace('[Name of The Client]','',$exectly_man);
								$exectly_man=str_replace('[doc]','',$exectly_man);
								$exectly_man=str_replace($doc_name_string,'',$exectly_man);
								$exectly_man=str_replace($x2,'',$exectly_man);
								//$exectly_man=str_replace('>','',$exectly_man);
								echo $exectly_man;
								
							}
						for($i=$rowcount-1;$i>=0;$i--)
						{ 
						 //echo	$first;
  ?>						

  <p class="text-center title" style="text-align: center; font-size:20px;"><b><u>FORM 5A8 - CURRICULUM VITAE (CV) FOR TEAM LEADER</u></b></p>      
  <div class="extra-border" >
  <table class="table table-bordeblack" style="margin-bottom:30px;margin-top:30px; border: 1px solid black !important; padding: 5px !important;" >
    <tbody>
			  <tr>
					<td  class=" td_0" style='width: 30% !important;'>Name of the Consultant</td>
					<td  class=" td_0" style='width: 70% !important;'>Engineers Consortium Ltd.</td>
				  </tr>
				  <tr>
					<td class=" td_0"><b>RFP IDENTIFICATION NO.</b></td>
					<td class=" td_0"><b><?php echo $rfp_iden; ?></b></td>
				  </tr>
				  <tr>
					<td class=" td_0">Name of The Client</td>
					<td class=" td_0"><?php   echo $name_of_client;  ?> </td>
				  </tr>

 	</tbody>  
</table>	
  </div>
  <table class="table table-bordeblack"  style=" width: 100%;" >
    <tbody>
      <tr>
        <td style="border: 1px solid black !important ;">
			
			<table  class=" " style='width:100%;border: 0px;'>
			  <tr>
					<td class="width-1 td_0">1</td>
					<td  class="width-2 td_0">Proposed Position for this project</td>
					<td  class="width-3 td_0"><?php echo $exectly_man_position2; ?></td>
				  </tr>
				  <tr>
					<td class="width-1 td_0">2</td>
					<td class="width-2 td_0"> Name of Staff</td>
					<td class="width-3 td_0"><b><?php echo $row[$i]['p_cv_staff']; ?></b></td>
				  </tr>
				  <tr>
					<td class="width-1 td_0">3</td>
					<td class="width-2 td_0">Date of Birth</td>
					<td class="width-3 td_0"><?php   echo $newDate = date("d M, Y", strtotime($row[$i]['birth_date']));  ?> </td>
				  </tr>
				  <tr>
					<td class="width-1 td_0">4</td>
					<td class="width-2 td_0">Nationality</td>
					<td class="width-3 td_0"><?php echo $row[$i]['nationality']; ?>  by birth</td>
				  </tr>
			</table>

		</td>
      </tr>
	  
	  
      <tr>
        <td  style="  border: 1px solid black !important;">
			<table  class=" " style='width:100%;border: 0px;'>
			  <tr>
					<td class="width-1 td_0">5</td>
					<td  class="width-2 td_0">Membership of Professional Societies</td>
					<td  class="width-3 td_0" style=' text-align:justify; '><?php echo $row[$i]['membership']; ?></td>
				  </tr>
				  <tr><td style="border:0px solid gray" ></td><td style="border:0px solid gray" ></td><td style="border:0px solid gray" ></td></tr>
				  <tr>
					<td style="margin-top:50px !important" class="width-1 td_0">6</td>
					<td style="margin-top:50px !important"class="width-2 td_0">Education</td>
					<td style="margin-top:50px !important; text-align:justify;"class="width-3 td_0"><?php echo $row[$i]['qualification']; ?></td>
				  </tr>
				  <tr><td style="border:0px solid gray" ></td><td style="border:0px solid gray" ></td><td style="border:0px solid gray" ></td></tr>
				  <tr >
					<td style="margin-top:50px !important"class="width-1 td_0">7</td>
					<td style="margin-top:50px !important"class="width-2 td_0">Other Training</td>
					<td style="margin-top:50px !important;text-align:justify;"class="width-3 td_0"><?php echo $row[$i]['training']; ?></td>
				  </tr>
			</table>			
		</td>
      </tr>	  
	  
	  
      <tr>
        <td  style="  border: 1px solid black !important;">
			<table  class=" " style='width:100%;border: 0px;'>
			  <tr>
					<td class="width-1 td_0">8</td>
					<td  class="width-2 td_0">Language & Degree of Proficiency</td>
					<td  class="width-3 td_0">
 

	<?php  
$t_h='';	
$role='';	
$get_count=0;
		
$lan=json_decode($row[$i]['staff_languages'], true);
foreach($lan as $key=>$ln) {
	$t_h=$t_h.'<td style=" padding: 0px;  margin: 0px; border:1px solid white;">'.$key.'</td>';
	if($get_count==0){
		foreach($ln as $key2=>$ln2) {
		  $get_count=count($ln); 
		}	
	}	
}
    ?>
  <table>
    <thead> 
		<tr> <?php echo $t_h; ?>
		</tr>				
    </thead>
    <tbody>
	<?php  
	for($i2=0; $i2<$get_count; $i2++){
		echo ' <tr>';
			foreach($lan as $key=>$ln) {
			 echo '<td style=" padding: 1px;  margin: 0px; ">'.$ln[$i2].'</td>';	
			}
		echo ' </tr>';				
	}
	  ?>
    </tbody>
  </table>		 		 


  
					</td>
			  </tr>
			  <tr>
					<td class="width-1 td_0" style='border:0px'></td>
					<td class="width-2 td_0" style='border:0px'></td>
					<td class="width-3 td_0" style='border:0px'></td>
			  </tr>
			  <tr>
					<td class="width-1 td_0">9</td>
					<td class="width-2 td_0">Countries of work Experience</td>
					<td class="width-3 td_0" style='text-align:justify;'><?php echo $row[$i]['country_w_experience']; ?></td>
			  </tr>
			</table>			
		</td>
      </tr>	  
	  
      <tr>
        <td  style="  border: 1px solid black !important;">
			<table  class=" " style='width:100%;border: 0px;'>
			  <tr>
					<td class="width-1 td_0">10</td>
					<td  class="width-2 td_0">Employment Record: 
						 
						</td>
					<td  class="width-3 td_0">
					
	<?php
	
$t_h='';	
$role='';	
$get_count=0;
$title_array=array();		
$lan=json_decode($row[$i]['employment_record'], true);
$xx=0;
foreach($lan as $key=>$ln) {
				if($key=='employer'){$key='Employer';}
				if($key=='duration'){$key='Duration ';}
				 if($key=='employment_position'){$key='Employment Position';}
				if($key=='duties'){$key='Duties';}	
	
	$title_array[$xx]=$key; $xx++;
	$t_h=$t_h.'<td style=" padding: 0px;  margin: 0px; border:1px solid white;">'.$key.'</td>';
	if($get_count==0){
		foreach($ln as $key2=>$ln2) {
		  $get_count=count($ln); 
		}	
	}	
}
    ?>
  <table>
    <thead> 
		<tr> <?php // echo $t_h; ?>
		</tr>				
    </thead>
    <tbody>
	<?php 
	for($i3=0; $i3<$get_count; $i3++){
		$i3v=$i3+1;
		echo ' <tr><td><b><u>Employer-'.$i3v.'</b></u></br>';
			$kk=0;
			foreach($lan as $key=>$ln) {

			 echo '<b>'.$title_array[$kk].': </b><x style="text-align:justify;">'.$ln[$i3].'</x><br>';
			$kk++;	
			}
		echo ' </td></tr>';				
	}
	
 					
			?>	
	</tbody>
  </table>	
					</td>
				  </tr>
			</table>			
		</td>
      </tr>	  
      <tr>
        <td  style="  border: 1px solid black !important;">
			<table  class=" " style='width:100%;border: 0px;'>
			  <tr>
					<td class="width-1 td_0">11</td>
					<td  class="width-2 td_0">WORK UNDERTAKEN THAT BEST ILLUSTRATES HIS CAPABILITY TO HANDLE THIS ASSIGNMENT.</td>
					<td  class="width-3 td_0">Works undertaken that best illustrates the capability of Abu Saleh Md. Main Uddin as “Team Leader” to handle this assignment are as follows:
					<?php echo $row[$i]['work_experience']; ?>
					</td>
				  </tr>
			</table>			
		</td>
      </tr>
      
    </tbody>
  </table>
  
  <!-- pagebreak --><div class="page-break dnone"  ></div>
  <p style='margin-top:30px'><b><u>Certification :</u></b></p>
<p>&nbsp;</p>
<p style='text-align:justify'>I, the undersigned, certify that (i) I was not a former employee of the Client immediately before the submission of this proposal, (ii) I have not offered my CV to be proposed by a Firm other than this Consultant for this assignment and (iii) to the best of my knowledge and belief, this CV correctly describes myself, my qualifications, and my experience. I also understand that any willful mis-statement described herein may lead to my disqualification or dismissal, if engaged.</p>
<p>&nbsp;</p>
<p style='text-align:justify'>I have been employed by Engineers Consortium Ltd. continuously for the last twelve (12) months as regular full time staff. Indicate &ldquo;Yes&rdquo; or &ldquo;No&rdquo; in the boxes below:</p>
<p>&nbsp;</p>
<table>
<tbody>
<tr><td style='border:0 !important'; width="52">&nbsp;</td>
<td style='border:0 !important'; width="39">Yes <input type="checkbox" id="vehicle1" checked name="vehicle1" value="Bike"></td>
<td style='border:0 !important'; width="39">No <input type="checkbox" id="vehicle1"  name="vehicle1" value="Bike"></td>
<td style='border:0 !important'; width="132">&nbsp;</td>
</tr>
 
</tbody>
</table>
<p>&nbsp;</p>

<table>
<tbody>

<tr>
<td width="213"  style='border:0 !important; Padding:0px !important; margin:0px !important;'></td>
<td width="100" style='Padding:0px !important; margin:0px !important;'><p>Signature:</p></td>
<td width="213" style='Padding:0px !important; margin:0px !important;border:1px solid gray !important;'><br><p>&nbsp;</p><p>&nbsp;</p></td>
<td width="50" style='border:0 !important; Padding:0px !important; margin:0px !important;'><p>&nbsp;</p><p>&nbsp;</p></td>
</tr>

<tr>
<td width="213" style='border:0 !important; Padding:0px !important; margin:0px !important;'> </td>
<td width="100" style='Padding:0px !important; margin:0px !important;'><p>Date of Signing:</p></td>
<td width="213" style='Padding:0px !important; margin:0px !important;border:1px solid gray !important;'><br><br><p style='text-align:center'>Day/Month/Year</p></td>
<td width="50" style='border:0 !important; Padding:0px !important; margin:0px !important;'><p>&nbsp;</p><p>&nbsp;</p></td>

</tr>

</tbody>
</table>
  <!-- pagebreak --><div class="page-break dnone"  ></div>
  
  
  
  
  <?php
	  } 
	echo   $end;
						}
	  ?> 
</div>

<?php } ?>







<form  target="_blank"  style="display: none" action="https://engineersconsortiumltd.com.bd/admin/print.php" method="POST" id="form">

<textarea id="w3review" style="display:none" name="w3review" rows="4" cols="50">
 </textarea>
 <input type="text" style="display:none" value="<?php echo $doc_id;?>" name="doc_id">
</form>









<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src='https://www.jqueryscript.net/demo/Export-Html-To-Word-Document-With-Images-Using-jQuery-Word-Export-Plugin/FileSaver.js'></script>
<script src='https://www.jqueryscript.net/demo/Export-Html-To-Word-Document-With-Images-Using-jQuery-Word-Export-Plugin/jquery.wordexport.js'></script>
<script  src="./script.js"></script>
<script src='https://cdn.jsdelivr.net/npm/tinymce@5.1.5/tinymce.min.js'></script>


<script>
	function getYPosition(){
  var top  = window.pageYOffset || document.documentElement.scrollTop
  return top;
}
$(window).on('scroll', function() {
    console.log( Number($(this).scrollTop()) );
	});	
	
	
	
		 function print(){

		 var docId= document.getElementById("docId").value; 	 
		  //var contents= document.getElementById("contents").innerHTML; 
		 var contents = tinymce.get("editor").getContent();
		 document.getElementById("w3review").innerHTML=contents; 
 $("#form").submit();
			 }	
	
		
		
		 function save_pre(bb){

		 var docId= document.getElementById("docId").value; 	 
		 var userId= document.getElementById("user_id").value; 
         var cat='2';
//alert(userId);
 	 
		  //var contents= document.getElementById("contents").innerHTML; 
		 var contents = document.getElementById("previewx"+bb).innerHTML; 
	 
				var uurl="https://engineersconsortiumltd.com.bd/admin/controller/custom_save_coduments.php";
				$.ajax({
				type: "POST",
				url: uurl,
				data: {docId:docId,contents:contents,userId:userId,cat:cat},
				dataType: "TEXT",
				success: function(data) {
					var txt = data;
					location.reload();
				 
				},
				error: function(err) {
					alert(err);
				}
	 });    }
	 
	 
	
		 function save(){

		 var docId= document.getElementById("docId").value; 	 
		 var userId= document.getElementById("user_id").value; 

//alert(userId);
 	 
		  //var contents= document.getElementById("contents").innerHTML; 
		 var contents = tinymce.get("editor").getContent();
		 
				var uurl="https://engineersconsortiumltd.com.bd/admin/controller/custom_save_coduments.php";
				$.ajax({
				type: "POST",
				url: uurl,
				data: {docId:docId,contents:contents,userId:userId},
				dataType: "TEXT",
				success: function(data) {
					var txt = data;
					alert(data);
				 
				},
				error: function(err) {
					alert(err);
				}
	 });    }
	 
	  jQuery(document).ready(function($) {
		  
		  
		 <?php if($tender_details!=''){  ?> 
		  var contents= document.getElementById("contents").innerHTML; 
		  document.getElementById("editor").innerHTML=contents;
		 <?php } ?>
		  
	  <?php if($tender_phase=='PDS List' || $tender_phase=='PDS -With Contract Value'  || $tender_phase=='PDS -Without Contract Value'){  ?> 
		  var contents= document.getElementById("contents").innerHTML; 
		  document.getElementById("editor").innerHTML=contents;
		 <?php } ?>		 
		  
        $("a.word-export").click(function(event) {
			var new_content = tinymce.get("editor").getContent();
		    document.getElementById("contents").innerHTML=new_content;
            $("#contents").wordExport();
        }); 
    }); 

 
          window.onload = addPageNumbers;

          function addPageNumbers() {
            var totalPages = Math.ceil(document.body.scrollHeight / 1123);  //842px A4 pageheight for 72dpi, 1123px A4 pageheight for 96dpi, 
            for (var i = 1; i <= totalPages; i++) {
              var pageNumberDiv = document.createElement("div");
              var pageNumber = document.createTextNode("Page " + i + " of " + totalPages);
              pageNumberDiv.style.position = "absolute";
              pageNumberDiv.style.top = "calc((" + i + " * (297mm - 0.5px)) - 40px)"; //297mm A4 pageheight; 0,5px unknown needed necessary correction value; additional wanted 40px margin from bottom(own element height included)
              pageNumberDiv.style.height = "16px";
              pageNumberDiv.appendChild(pageNumber);
              document.body.insertBefore(pageNumberDiv, document.getElementById("content"));
              pageNumberDiv.style.left = "calc(100% - (" + pageNumberDiv.offsetWidth + "px + 20px))";
            }
          }
 
 


// RULER
const CLASS_RULER = "document-ruler";
const RULER_PAGEBREAK_CLASS = "mce-ruler-pagebreak";
const RULER_SHORTCUT = "Meta+Q";
const PX_RULER = 3.78; // 3.779527559
const PADDING_RULER = 13; // in millimeters
const FORMAT = <?php if($landscape==1){echo '{ width: 297, height: 210 }'; } else {echo '{ width: 210, height: 297 }';}  ?>; // A4 210, 297
const HEIGHT = FORMAT.height * PX_RULER;
const STYLE_RULER = `
 html.${CLASS_RULER}{
   background: #b5b5b5;
   padding: 0;
   background-image: url(data:image/svg+xml;utf8,%3Csvg%20width%3D%22100%25%22%20height%3D%22${
FORMAT.height
}mm%22%20version%3D%221.1%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cline%20x1%3D%220%22%20y1%3D%22${
FORMAT.height
}mm%22%20x2%3D%22100%25%22%20y2%3D%22${
FORMAT.height
}mm%22%20stroke%3D%22%23${"737373"}%22%20height%3D%221px%22%2F%3E%3C%2Fsvg%3E);
   background-repeat: repeat-y;
   background-position: 0 0;
 }
 html.${CLASS_RULER} body{
   padding: 0 ${PADDING_RULER}mm !important;
   padding-top: ${PADDING_RULER}mm !important;
   margin: 0 auto !important;
   

   background-image: url(data:image/svg+xml;utf8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22${
FORMAT.width
}mm%22%20height%3D%22${FORMAT.height}mm%22%3E%3Crect%20width%3D%22${
FORMAT.width
}mm%22%20height%3D%22${
FORMAT.height
}mm%22%20style%3D%22fill%3A%23fff%22%2F%3E%3Cline%20x1%3D%220%22%20y1%3D%22100%25%22%20x2%3D%22100%25%22%20y2%3D%22100%25%22%20stroke%3D%22%23737373%22%20height%3D%221px%22%2F%3E%3Cline%20x1%3D%22${PADDING_RULER}mm%22%20y1%3D%220%22%20x2%3D%22${PADDING_RULER}mm%22%20y2%3D%22100%25%22%20stroke%3D%22%230168e1%22%20height%3D%221px%22%20stroke-dasharray%3D%225%2C5%22%2F%3E%3Cline%20x1%3D%22${FORMAT.width -
PADDING_RULER}mm%22%20y1%3D%220%22%20x2%3D%22${FORMAT.width -
PADDING_RULER}mm%22%20y2%3D%22100%25%22%20stroke%3D%22%230168e1%22%20height%3D%221px%22%20stroke-dasharray%3D%225%2C5%22%2F%3E%3Cline%20x1%3D%220%22%20y1%3D%22${PADDING_RULER}mm%22%20x2%3D%22100%25%22%20y2%3D%22${PADDING_RULER}mm%22%20stroke%3D%22%230168e1%22%20height%3D%221px%22%20stroke-dasharray%3D%225%2C5%22%2F%3E%3Cline%20x1%3D%220%22%20y1%3D%22${FORMAT.height -
PADDING_RULER}mm%22%20x2%3D%22100%25%22%20y2%3D%22${FORMAT.height -
PADDING_RULER}mm%22%20stroke%3D%22%230168e1%22%20height%3D%221px%22%20stroke-dasharray%3D%225%2C5%22%2F%3E%3C%2Fsvg%3E);



   background-repeat: repeat-y;
   background-position: 0 0;
   width: ${FORMAT.width}mm;
   min-height: ${FORMAT.height}mm !important;
   box-sizing: border-box;
   box-shadow: 4px 4px 13px -3px #3c3c3c;
   -webkit-box-shadow: 4px 4px 13px -3px #3c3c3c;
 }
 

 @media print {
   @page {
	   <?php if($landscape==1){echo 'size: 297mm 210mm;'; } else {echo 'size: 210mm 297mm;';}  ?>; // A4 210, 297
     
     margin: ${PADDING_RULER}mm !important;
     counter-increment: page
   }
   html.${CLASS_RULER}, html.${CLASS_RULER} body {
     background: transparent;
     box-shadow: none
   }
   html.${CLASS_RULER} body {
     padding: 0 !important;
     width: 100%;
     font-size: 13px;
     font-family: Helvetica,Arial,sans-serif !important;
     font-style: normal;
     letter-spacing: 0
   }
   html.${CLASS_RULER} .${RULER_PAGEBREAK_CLASS}{
     margin: 0 !important;
     height: 0 !important
   }
 }
`;

function debounce(fn, wait = 250, immediate) {
  let timeout;

  function debounced() /* ...args */{
    const later = () => {
      timeout = void 0;
      if (immediate !== true) {
        fn.apply(this, arguments);
      }
    };

    clearTimeout(timeout);
    if (immediate === true && timeout === void 0) {
      fn.apply(this, arguments);
    }
    timeout = setTimeout(later, wait);
  }

  debounced.cancel = () => {
    clearTimeout(timeout);
  };

  return debounced;
}

function createStyle(style, doc) {
  const tag = doc.createElement("style");
  tag.innerHTML = style;
  doc.head.appendChild(tag);
}
const pluginManager = tinymce.util.Tools.resolve("tinymce.PluginManager");

function pluginRuler(editor) {
  if (editor.settings.ruler !== true) {
    return void 0;
  }
  const tinyEnv = window.tinymce.util.Tools.resolve("tinymce.Env");

  const FilterContent = {
    getPageBreakClass() {
      return RULER_PAGEBREAK_CLASS;
    },
    getPlaceholderHtml() {
      return (
        '<img src="' +
        tinyEnv.transparentSrc +
        '" class="' +
        this.getPageBreakClass() +
        '" data-mce-resize="false" data-mce-placeholder />');

    } };


  const Settings = {
    getSeparatorHtml() {
      return editor.getParam("pagebreak_separator", "<!-- ruler-pagebreak -->"); // <!-- pagebreak -->
    },
    shouldSplitBlock() {
      return editor.getParam("pagebreak_split_block", false);
    } };


  const separatorHtml = Settings.getSeparatorHtml(editor);
  var pageBreakSeparatorRegExp = new RegExp(
  separatorHtml.replace(/[\?\.\*\[\]\(\)\{\}\+\^\$\:]/g, function (a) {
    return "\\" + a;
  }),
  "gi");

  editor.on("BeforeSetContent", function (e) {
    e.content = e.content.replace(
    pageBreakSeparatorRegExp,
    FilterContent.getPlaceholderHtml());

  });
  editor.on("PreInit", function () {
    editor.serializer.addNodeFilter("img", function (nodes) {
      var i = nodes.length,
      node,
      className;
      while (i--) {
        node = nodes[i];
        className = node.attr("class");
        if (
        className &&
        className.indexOf(FilterContent.getPageBreakClass()) !== -1)
        {
          const parentNode = node.parent;
          if (
          editor.schema.getBlockElements()[parentNode.name] &&
          Settings.shouldSplitBlock(editor))
          {
            parentNode.type = 3;
            parentNode.value = separatorHtml;
            parentNode.raw = true;
            node.remove();
            continue;
          }
          node.type = 3;
          node.value = separatorHtml;
          node.raw = true;
        }
      }
    });
  });

  editor.on("ResolveName", function (e) {
    if (
    e.target.nodeName === "IMG" &&
    editor.dom.hasClass(e.target, FilterContent.getPageBreakClass()))
    {
      e.name = "pagebreak";
    }
  });

  editor.addCommand("mceRulerPageBreak", function () {
    if (editor.settings.pagebreak_split_block) {
      editor.insertContent("<p>" + FilterContent.getPlaceholderHtml() + "</p>");
    } else {
      editor.insertContent(FilterContent.getPlaceholderHtml());
    }
  });

  editor.addCommand("mceRulerRecalculate", function () {
    const $document = editor.getDoc();
    const $breaks = $document.querySelectorAll(`.${RULER_PAGEBREAK_CLASS}`);
    for (let i = 0; i < $breaks.length; i++) {
      const $element = $breaks[i];
      const $parent = $element.parentElement;
      const offsetTop = $element.offsetTop;
      const top = HEIGHT * (i + 1);
      if (top >= offsetTop) {
        $parent.style.marginTop =
        ~~(top - (offsetTop - $parent.style.marginTop.replace("px", ""))) +
        "px";
      }
    }
  });

  editor.addShortcut(RULER_SHORTCUT, "", "mceRulerPageBreak");

  editor.on("init", e => {
    const $document = editor.getDoc();
    createStyle(STYLE_RULER, $document);
    const documentElement = $document.documentElement;
    const hasRuler = documentElement.classList.contains(CLASS_RULER);

    if (hasRuler === false) {
      documentElement.classList.add(CLASS_RULER);
    }
  });

  const recalculate = debounce(() => {
    editor.execCommand("mceRulerRecalculate");
  }, 100);

  editor.on("NodeChange", e => {
    recalculate();
  });
}

tinymce.PluginManager.add("ruler", pluginRuler);

function pluginMath(editor) {
  // Create API
  // https://github.com/mathjax/MathJax-src#using-mathjax-components-in-node-applications
  // https://github.com/uetchy/math-api/blob/master/index.ts

  // https://github.com/mathjax/MathJax-demos-node/blob/master/direct/tex2svg
  const apiMath = "https://math.now.sh/?from="; // 'https://chart.googleapis.com/chart?cht=tx&chf=a,s,000000|bg,s,FFFFFF00&chl='

  const getSrc = function (text) {
    const textURI = window.
    encodeURIComponent(text).
    replace(/[!'()]/g, escape).
    replace(/\*/g, "%2A");
    return apiMath + textURI;
  };

  const createSrc = function (text, width = 0, height = 0) {
    const widthAttr = width > 0 ? `width="${width}" ` : "";
    const heightAttr = height > 0 ? `height="${height}" ` : "";
    return `<img src="${getSrc(
    text)
    }" data-mce-math="true" ${widthAttr}${heightAttr}/>`;
  };

  const isMath = function (node) {
    return (
      node !== void 0 &&
      node.nodeName === "IMG" &&
      node.dataset !== void 0 &&
      node.dataset.mceMath === "true");

  };

  const getMath = function (node) {
    if (isMath(node) === true) {
      const textMath = node.dataset.mceSrc;
      return {
        value: window.decodeURIComponent(String(textMath).replace(apiMath, "")),
        width: +node.getAttribute("width"),
        height: +node.getAttribute("height") };

    }
    return {
      value: "",
      width: 0,
      height: 0 };

  };

  const generateMatrix = function generateMatrix(type, rows, columns) {
    let res = '\\begin{' + type + '}\n';
    for (let i = 1; i <= rows; i++) {
      for (let j = 1; j <= columns; j++) {
        res += '#?';
        if (j !== columns) {
          res += ' & ';
        }
      }
      if (i !== rows) {
        res += ' \\\\';
      }
      res += '\n';
    }
    return res + '\\end{' + type + '}';
  };

  const Dialog = editor => {
    return async () => {
      let configMath;
      if (editor.selection !== void 0 && editor.selection.getNode !== void 0) {
        configMath = getMath(editor.selection.getNode());
      } else {
        configMath = {
          value: "",
          width: 0,
          height: 0 };

      }
      const inputName = "math";
      const inputId = `input_${inputName}_${Date.now()}`;
      let $keyboard;
      const $modal = editor.windowManager.open({
        title: "Formula",
        body: {
          type: "panel",
          items: [
          {
            name: inputName,
            type: "htmlpanel",
            html: `<div class="mathlive-input" id="${inputId}"></div>` }] },



        initialData: {
          [inputName]: configMath.value // Ya no funciona, hasta mejorar type:htmlpanel
        },
        buttons: [
        {
          type: "cancel",
          name: "cancel",
          text: "Cancel" },

        {
          type: "submit",
          name: "save",
          text: "Save",
          primary: true }],


        onSubmit(e) {
          const $input = window.document.querySelector(`#${inputId}`);
          const text = $input.mathfield.$text("latex");
          if (text && typeof text.trim === "function") {
            const img = createSrc(
            text.
            trim().
            replace(/\\mleft\./g, "").
            replace(/\\mright\./g, ""),
            configMath.width,
            configMath.height);

            editor.focus();
            editor.insertContent(img);
          } else {
            editor.focus();
          }
          e.close();
          // const html = katex.renderToString(text, {throwOnError: false})
          // editor.insertContent(e.data[input])
        },
        onClose(e) {
          // const $input = window.document.querySelector(`#${inputId}`)
          if ($keyboard !== void 0) {
            $keyboard.remove();
          }
        } });

      $modal.block("Loading...");

      /** Loading MathLive Dynamic */
      /*const chunkMathLive = new Promise(resolve => {
        require.ensure([], require => {
          require("../mathlive/mathlive.main.scss");
          require("../mathlive/mathlive.min.js");
          resolve();
        });
      });*/
      try {
        // await chunkMathLive;
        setTimeout(() => {
          const $input = window.document.querySelector(`#${inputId}`); // window.document.querySelector('.tox-textfield')
          const $dialog = $input.closest(".tox-dialog");
          $dialog.classList.add("mathlive");

          window.MathLive.makeMathField($input, {
            smartFence: false,
            virtualKeyboardMode: "manual",
            onContentDidChange() {
              // $modal.setData({ [inputName]: $input.mathfield.$text('latex') })
            },
            onVirtualKeyboardToggle(instance, toggle, element) {
              $keyboard = element;
            },
            customVirtualKeyboardLayers: {
              "math": `
        <div class='rows'>
            <ul>
                <li class='keycap tex' data-alt-keys='x-var'><i>x</i></li>
                <li class='keycap tex' data-alt-keys='n-var'><i>n</i></li>
                <li class='separator w5'></li>
                <row name='numpad-1'/>
                <li class='separator w5'></li>
                <li class='keycap tex' data-key='ee' data-alt-keys='ee'>e</li>
                <li class='keycap tex' data-key='ii' data-alt-keys='ii'>i</li>
                <li class='keycap tex' data-latex='\\pi' data-alt-keys='numeric-pi'></li>
            </ul>
            <ul>
                <li class='keycap tex' data-key='<' data-alt-keys='<'>&lt;</li>
                <li class='keycap tex' data-key='>' data-alt-keys='>'>&gt;</li>
                <li class='separator w5'></li>
                <row name='numpad-2'/>
                <li class='separator w5'></li>
                <li class='keycap tex' data-alt-keys='x2' data-insert='#@^{2}'><span><i>x</i>&thinsp;?</span></li>
                <li class='keycap tex' data-alt-keys='^' data-insert='#@^{#?}'><span><i>x</i><sup>&thinsp;<small>&#x2b1a;</small></sup></span></li>
                <li class='keycap tex' data-alt-keys='sqrt' data-insert='\\sqrt{#0}' data-latex='\\sqrt{#0}'></li>
            </ul>
            <ul>
                <li class='keycap tex' data-alt-keys='(' >(</li>
                <li class='keycap tex' data-alt-keys=')' >)</li>
                <li class='separator w5'></li>
                <row name='numpad-3'/>
                <li class='separator w5'></li>
                <li class='keycap tex small' data-alt-keys='int' data-latex='\\int_0^\\infty'><span></span></li>
                <li class='keycap tex' data-latex='\\frac{#0}{#?}' data-alt-keys='logic' ></li>
                <li class='action font-glyph bottom right' data-alt-keys='delete' data-command='["performWithFeedback","deletePreviousChar"]'>&#x232b;</li></ul>
            </ul>
            <ul>
                <li class='keycap' data-alt-keys='foreground-color' data-command='["applyStyle",{"color":"#cc2428"}]'><span style='border-radius: 50%;width:22px;height:22px; border: 3px solid #cc2428; box-sizing: border-box'></span></li>
                <li class='keycap' data-alt-keys='background-color' data-command='["applyStyle",{"backgroundColor":"#fff590"}]'><span style='border-radius: 50%;width:22px;height:22px; background:#fff590; box-sizing: border-box'></span></li>
                <li class='separator w5'></li>
                <row name='numpad-4'/>
                <li class='separator w5'></li>
                <arrows/>
            </ul>
        </div>
    `,
              'functions': `
        <div class='rows'>
                  <ul><li class='separator'></li>
                      <li class='fnbutton small' data-insert='\\sin #?'></li>
                      <li class='fnbutton small' data-insert='\\sin^{-1} #?'></li>
                      <li class='fnbutton small' data-insert='\\ln #?'></li>
                      <li class='fnbutton small' data-insert='\\exponentialE^{#?}'></li>
                      <li class='fnbutton small' data-insert='\\operatorname{lcm}(#?)'></li>
                      <li class='fnbutton small' data-insert='\\operatorname{ceil}(#?)'></li>
                      <li class='fnbutton small' data-insert='\\lim_{n\\to\\infty} #?'></li>
                      <li class='fnbutton small' data-insert='\\int_{#?}^{#?}'></li>
                      <li class='fnbutton small' data-insert='\\operatorname{abs}(#?)'></li>
                  </ul>
                  <ul><li class='separator'></li>
                      <li class='fnbutton small' data-insert='\\cos #?'></li>
                      <li class='fnbutton small' data-insert='\\cos^{-1} #?'></li>
                      <li class='fnbutton small' data-insert='\\ln_{10} #?'></li>
                      <li class='fnbutton small' data-insert='10^{#?}'></li>
                      <li class='fnbutton small' data-insert='\\operatorname{gcd}(#?)'></li>
                      <li class='fnbutton small' data-insert='\\operatorname{floor}(#?)'></li>
                      <li class='fnbutton small' data-insert='\\sum_{n\\mathop=0}^{\\infty}'></li>
                      <li class='fnbutton small' data-insert='\\int_{0}^{\\infty}'></li>
                      <li class='fnbutton small' data-insert='\\operatorname{sign}(#?)'></li>
                  </ul>
                  <ul><li class='separator'></li>
                      <li class='fnbutton small' data-insert='\\tan #?'></li>
                      <li class='fnbutton small' data-insert='\\tan^{-1} #?'></li>
                      <li class='fnbutton small' data-insert='\\log_{#?} #0'></li>
                      <li class='fnbutton small' data-insert='\\sqrt[#?]{#0}'></li>
                      <li class='fnbutton small' data-insert='#0 \\mod' data-latex='\\mod'></li>
                      <li class='fnbutton small' data-insert='\\operatorname{round}(#?)'></li>
                      <li class='bigfnbutton' data-insert='\\prod_{n\\mathop=0}^{\\infty}' data-latex='{\\tiny \\prod_{n=0}^{\\infty}}'></li>
                      <li class='bigfnbutton' data-insert='\\frac{\\differentialD #0}{\\differentialD x}'></li>
                      <li class='action font-glyph bottom right' data-command='["performWithFeedback","deletePreviousChar"]'>&#x232b;</li></ul>
                  <ul><li class='separator'></li>
                      <li class='fnbutton'>(</li>
                      <li class='fnbutton'>)</li>
                      <li class='fnbutton' data-insert='^{#?} ' data-latex='x^{#?} '></li>
                      <li class='fnbutton' data-insert='_{#?} ' data-latex='x_{#?} '></li>
                      <li class='keycap w20 ' data-key=' '>&nbsp;</li>
                      <arrows/>
                  </ul>
              </div>`,
              "matrix": {
                rows: [
                [
                {
                  "class": "keycap tex small w15",
                  "insert": generateMatrix('matrix', 1, 2) },

                {
                  "class": "keycap tex small w15",
                  "insert": generateMatrix("matrix", 2, 1) },

                {
                  "class": "keycap tex small w15",
                  "insert": generateMatrix("matrix", 1, 3) },

                {
                  "class": "keycap tex small w15",
                  "insert": generateMatrix("matrix", 3, 1) }],


                [
                {
                  "class": "keycap tex small w15",
                  "insert": generateMatrix("matrix", 2, 2) },

                {
                  "class": "keycap tex small w15",
                  "insert": generateMatrix("matrix", 2, 3) },

                {
                  "class": "keycap tex small w15",
                  "insert": generateMatrix("matrix", 3, 2) },

                {
                  "class": "keycap tex small w15",
                  "insert": generateMatrix("matrix", 3, 3) }],


                [
                {
                  "class": "keycap tex small w15",
                  "insert": "\\cdots" },

                {
                  "class": "keycap tex small w15",
                  "insert": "\\ldots" },

                {
                  "class": "keycap tex small w15",
                  "insert": "\\vdots" },

                {
                  "class": "keycap tex small w15",
                  "insert": "\\ddots" }],


                [
                {
                  "class": "keycap tex small w15",
                  "insert": generateMatrix("pmatrix", 2, 2) },

                {
                  "class": "keycap tex small w15",
                  "insert": generateMatrix("bmatrix", 2, 2) },

                {
                  "class": "keycap tex small w15",
                  "insert": generateMatrix("vmatrix", 2, 2) },

                {
                  "class": "keycap tex small w15",
                  "insert": generateMatrix("Vmatrix", 2, 2) }]] } },





            customVirtualKeyboards: {
              "qmatrix": {
                label: '<svg viewBox="0 2 60 35" style="width: 45px; height: 25px"><text x="0" y="15">? ? ? ?</text><text x="0" y="30">? ? ? ?</text></svg>',
                tooltip: "Matrix keyboard",
                layer: "matrix" } },


            virtualKeyboards: "numeric roman greek functions command qmatrix" });

          $input.mathfield.$focus();
          $input.mathfield.$latex(configMath.value);
          setTimeout(() => $modal.unblock());
        }, 0);
      } catch (error) {
        $modal.unblock();
      }
    };
  };

  /* const toggleActiveState = function (buttonApi, editor) {
  return function () {
    const self = this
    editor.on('nodechange', function (e) {
      self.active(!editor.readonly && !!isMath(e.element))
    })
  }
  } */

  const registry = editor.ui.registry;

  editor.addCommand("mceMath", Dialog(editor));

  registry.addToggleButton("math", {
    // text: 'Math',
    icon: "superscript", //character-count
    tooltip: "Formula",
    onAction: () => editor.execCommand("mceMath"),
    onSetup: buttonApi => {
      const toggleActiveState = (e) =>
      buttonApi.setActive(!editor.readonly && isMath(e.element) === true);
      editor.on("NodeChange", toggleActiveState);
    } });


  // Verificar bien este proceso
  editor.on("PastePreProcess", e => {
    const text = e.content;
    const characters = ["\\", "^"];
    let includeChar = false;
    for (let i = 0; i < characters.length; i++) {
      if (text.indexOf(characters[i]) >= 0) {
        includeChar = true;
        break;
      }
    }

    if (text && includeChar) {
      try {
        e.content = createSrc(e.content);
      } catch (error) {
        console.error(error);
      }
    }
  });

  registry.addMenuItem("math", {
    icon: "superscript",
    text: "Editar formula",
    onAction: () => editor.execCommand("mceMath") });


  registry.addContextMenu("math", {
    update(element) {
      if (isMath(element) === true) {
        return "math";
      }
    } });

}

tinymce.PluginManager.add("math", pluginMath);

tinymce.init({
  selector: "#editor",
  height: 500,
  menubar: false,
  plugins: 'autoresize fullscreen print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons ruler',


  ruler: true,
  toolbar_sticky: true,
   pagebreak_split_block: true,
   image_advtab: true,
  toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview  print | insertfile image media template link anchor codesample | ltr rtl',
  contextmenu: "image imagetools table math", // No usar link, porque no funcionara con spellchecker
  content_css: [
  "//fonts.googleapis.com/css?family=Lato:300,300i,400,400i",
  "//www.tiny.cloud/css/codepen.min.css"],

  content_style: `
  .mce-content-body p {
    margin: 0
  }
  #tinymce.mce-content-body {
    font-size: 13px;
    font-family: Helvetica,Arial,sans-serif !important;
    font-style: normal;
    letter-spacing: 0;
    color: #262626;
    margin: 8px
  }
  figure {
    outline: 3px solid #dedede;
    position: relative;
    display: inline-block
  }
  figure:hover {
    outline-color: #ffc83d
  }
  figure > figcaption {
    color: #333;
    background-color: #f7f7f7;
    text-align: center
  }
  .title{font-size: 25px;
    font-weight: bold;}
	.width-1{width:5% !important;; }
	.width-2{width:35% !important;; }
	.width-3{width:60% !important;; }
	.td_0{border:1px solid white!important; padding:0px !important; margin:0px !important;}
	td { color: black !important; }
	
	.dnone{ display:none; }
	
	
	@media print {
      table { page-break-inside:auto }
    tr    {   page-break-after: avoid !important; }
  .mce-content-body table td, .mce-content-body table th {
    border: 0px !important;
 
}	


    
    .footerx {
        bottom: 0;  position: fixed;
    }
      .headerx {
        top: 0;  position: fixed;
    }
}
 

 


span {
    color: black;
}
.mce-content-body table {
    border: 0px !important;
}

	

  `,
    image_list: [
	
	<?php echo $staff_list; ?>
	
	
    
    { title: 'My page 2', value: 'http://www.moxiecode.com' }
  ],  
    file_picker_callback: function (callback, value, meta) {
    /* Provide file and text for the link dialog */
    if (meta.filetype === 'file') {
      callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
    }

    /* Provide image and alt text for the image dialog */
    if (meta.filetype === 'image') {
      callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
    }

    /* Provide alternative source and posted for the media dialog */
    if (meta.filetype === 'media') {
      callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
    }
  },
   templates: [
  
 
  
  { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
  
  
  ],
  template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
  template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
    image_caption: true,
  quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
  noneditable_noneditable_class: "mceNonEditable",
  toolbar_mode: 'sliding',
  contextmenu: "link image imagetools table",
  });

</script>
 

</body>
</html>

