<?php

 include('config.php');
  $data=$_GET['data'];
  $data2=': '.$_GET['data'];

 
  $cc=$query="select * from developer_bug WHERE developer_bug='$data' OR  developer_bug='$data2'";

$result=mysqli_query($connect,$query); $rowcount=mysqli_num_rows($result); $row = mysqli_fetch_all($result,MYSQLI_ASSOC);

//for($i=$rowcount-1;$i>=0;$i--)

//{  



	
if($rowcount==0){
	echo 'Nothing Found';
}else{
	if($row[0]['is_editable']=='1'){
		 echo	$files=$row[0]['details'];	
		// $array = json_decode($files,true);
		// print_r($array);
	}else{
		echo	$files=$row[0]['details2'];	
	}
}
//} 