				

<?php


   $dd='25,31,36,37,38,39,40,41,42,47,48,49,50,51,52,55,56,57,58,59,60,61,62,63,69,70,71,72,73,78,79,80';

$ff=explode(',',$dd);

/*$ffl=0;
foreach ($ff as $f){
    include('config.php');		
    $query = "DELETE FROM tbl_users_permission WHERE tables='$f'";
    if (mysqli_query($conn, $query)) {} else {}	
    $ffl++;
}
echo $ffl;*/

include('config.php');		
    $qry="select * from tbl_users_permission ";

    $result=mysqli_query($conn,$qry);
    echo $rowcount=mysqli_num_rows($result);
    $row = mysqli_fetch_all($result,MYSQLI_ASSOC);
    for($i=0;$i<$rowcount;$i++)
    {
        

             $rr=$row[$i]["tables"];
             $qryc="select * from tbl_users_submenu where submenu_id='$rr'";
             $resultc=mysqli_query($conn,$qryc);
             $rowcountc=mysqli_num_rows($resultc);
            if($rowcountc>0){

            }else{
                $ii=$row[$i]["tbl_users_permission_id"];
                $query = "DELETE FROM tbl_users_permission WHERE tbl_users_permission_id='$ii'";
                if (mysqli_query($conn, $query)) {} else {}	
            }
                 

 

    }

/*<table  id="tableyou" class="table ">
							<thead> <tr> 
								<th>SL</th>
								<th>Sector Title</th>
								<th>Feature Image</th>
								
								<th>Created</th>
								<th>Action</th>
							</tr> </thead>
							<tbody>	
								<?php	include('config.php');								$sl=1;
									$qry="select * from sector  order by sector_id ASC ";
									$result=mysqli_query($conn,$qry);
									echo $rowcount=mysqli_num_rows($result);
									$row = mysqli_fetch_all($result,MYSQLI_ASSOC);
									for($i=0;$i<$rowcount;$i++)
									{
										
										
										echo ' 		
										
										<tr>	
										<td>  '.$sl.'</td>
										<td>  '.$row[$i]["sector"].'</td>
										<td><a target="_blank" style="padding:10px;" href="../ecl/uploads/sector/'.$row[$i]["image"].'" class=" ">'.$row[$i]["image"].'</a></td>
										
										<td>'.$row[$i]["created"].'</td>
										
										<td>         <form  class="row no-print " method="POST"> 
										<button type="submit"   name="edit"value="edit" class="btn btn-success btn-xs" style="border-radius:0px;outline:none;  box-shadow:  5px 10px 18px gray;"> ✎ Edit </button>
										<button type="submit"   name="deletes"value="edit" class="btn btn-danger btn-xs" style="border-radius:0px;outline:none;  box-shadow:  5px 10px 18px gray;"> ✘ Delete </button>
										<input type="text"  style="display:none; " name="sector_id"value="'.$row[$i]["sector_id"].'"   class="form-control"   placeholder="Enter ...">
										</form>	</td>
										</tr>  ';
										
										$sl++;	 
									}   ?> 
							</tbody>
							<tfoot><tr>																	<th>SL</th>
								<th>Sector Title</th>
								<th>Feature Image</th>
								
								<th>Created</th>
							<th>Action</th></tr> </tfoot>										
						</table>