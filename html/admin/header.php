<?php


	

	
	function phpAlert($msg) { echo '<script type="text/javascript">alert("' . $msg . '")</script>'; }
	include('config.php');
	$temp=substr($_SERVER['REQUEST_URI'],-10);
	$queryz2="select * from tbl_users_token WHERE `token`='$temp'";
	$result=mysqli_query($connect,$queryz2); $rowcount=mysqli_num_rows($result); 
 
	$row = mysqli_fetch_all($result,MYSQLI_ASSOC);
	
	
	require_once '../login/class.user.php';
    include('configuration.php'); 
	session_start();
	
	
	$user_home = new USER();	
	
	if($rowcount>0){
		
		$creator=$row['0']['creator'];	
	if($user_home->login_ok($creator))
	{
		
	}	
		$sql = "DELETE FROM tbl_users_token   WHERE `token`='$temp'";
 
		if(mysqli_query($connect,$sql)){
			
		} else {
			 
		}		
	}
	

	 
	 

 

 	
    if(!$user_home->is_logged_in())
	{

	} else{
		 
	}
	
	
	
	
	//error_reporting(0); 
	
	
 
 
	$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
	$stmt->execute(array(":uid"=>$_SESSION['userSession']));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	
	$userID=$row['userID'];
	$userName=$row['userName'];
	$userType=$row['userType'];
	$userImage=$row['image'];
	$is_key=$row['is_key'];
	
    $c_month=$row['month'];
	$c_year=$row['year'];
 
	if($userName ==''){ echo '<script> window.location = '.$parent_base_url.'"/login/"; </script>';}
	
	if($userType !=''){} else{ phpAlert($_SESSION['userSession']." Fail to login! Session not found."); echo '<script> window.location = "'.$parent_base_url.'login/"; </script>';}
	if($is_key =='1'){} else{ phpAlert("Fail to login! Session not found."); echo '<script> window.location = "'.$parent_base_url.'login/"; </script>';}
	

	$d1 = new DateTime('now', new DateTimezone('Asia/Dhaka')); $created=$modified=$d1->format('F j, Y, g:i a'); $t_details=$d1->format('d-m-y, h:i'); $date=$d1->format('Y-m-d');   $month=$d1->format('F');   $year=$d1->format('Y');  
	
	
	function compress($source, $destination, $quality) {
		$info = getimagesize($source);
		if ($info['mime'] == 'image/jpeg') 
			$image = imagecreatefromjpeg($source);
		elseif ($info['mime'] == 'image/gif') 
			$image = imagecreatefromgif($source);
		elseif ($info['mime'] == 'image/png') 
			$image = imagecreatefrompng($source);
		imagejpeg($image, $destination, $quality);
		return $destination;
	}	
	
 function interactions($msg,$times,$by,$seen,$is_stock)
 { 

	include('config.php');
 	$query="INSERT INTO interactions (msg,times,user,seen,is_stock) VALUES ('$msg','$times','$by','$seen','$is_stock')";
	try{$result=mysqli_query($connect,$query);if($result){if(mysqli_affected_rows($connect) > 0){$say='Insert Successful'; }else{$say='Insert Fails';}}} catch (Exception $ex) {}

}	
	
function time_dif($t1,$t2) {
			$timeFirst  = strtotime($t1);
			$timeSecond = strtotime($t2);
			$differenceInSeconds = $timeSecond - $timeFirst;
			return $differenceInSeconds;
}	
	
	
	
	
	
	
	
	/*<div class="list-group-item">
                          <a class="notification notification-flush notification-unread" href="#!">
                            <div class="notification-avatar">
                              <div class="avatar avatar-2xl me-3">
                                <div class="avatar-name rounded-circle"><span>AB</span></div>
                              </div>
                            </div>
                            <div class="notification-body">
                              <p class="mb-1"><strong>Albert Brooks</strong> reacted to <strong>Mia Khalifa\'s</strong> status</p>
                              <span class="notification-time"><svg class="svg-inline--fa fa-gratipay fa-w-16 me-2 text-danger" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="gratipay" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg=""><path fill="currentColor" d="M248 8C111.1 8 0 119.1 0 256s111.1 248 248 248 248-111.1 248-248S384.9 8 248 8zm114.6 226.4l-113 152.7-112.7-152.7c-8.7-11.9-19.1-50.4 13.6-72 28.1-18.1 54.6-4.2 68.5 11.9 15.9 17.9 46.6 16.9 61.7 0 13.9-16.1 40.4-30 68.1-11.9 32.9 21.6 22.6 60 13.8 72z"></path></svg><!-- <span class="me-2 fab fa-gratipay text-danger"></span> Font Awesome fontawesome.com -->9hr</span>
                            </div>
                          </a>
                        </div> */
	
	$std='';
	/*$query="select tbl_users_notification.message as  message,  tbl_users_notification.created as  created,tbl_users.userName as userName from 	tbl_users_notification,tbl_users where tbl_users.userID=tbl_users_notification.userID  ORDER by tbl_users_notification.notification_id  desc LIMIT 130";
	$result=mysqli_query($connect,$query); $rowcount=mysqli_num_rows($result); $row = mysqli_fetch_all($result,MYSQLI_ASSOC);
	for($i=$rowcount-1;$i>=0;$i--)
	{ 
$std=$std.'
 <div id="" class="list-group-title border-bottom">
	 <div class="list-group-item">
		<a class="border-bottom-0 notification-unread  notification notification-flush" href="#!">
		 <div class="notification-avatar"> 
			 <div class="avatar avatar-xl me-3">
				<img class="rounded-circle" src="assets/img/logos/oxford.png" alt="">
			 </div> 
		 </div> 
	 <div class="notification-body">
	 <p class="mb-1"><strong>'.$row[$i]['userName'].'</strong> created '.explode(':',$row[$i]['message'])[0].'</p>
	 <span class="notification-time">
	 <span class="me-2" role="img" aria-label="Emoji">✌️</span>'.$row[$i]['created'].'</span>
	 </div> 
	 </a>
	</div>
</div>
';
	}
	*/
	
	$notification='
	              <a class="nav-link notification-indicator notification-indicator-primary px-0 icon-indicator" id="navbarDropdownNotification" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fas fa-bell" data-fa-transform="shrink-6" style="font-size: 33px;"></span></a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-card" aria-labelledby="navbarDropdownNotification">
                <div class="card card-notification shadow-none">
                  <div class="card-header">
                    <div class="row justify-content-between align-items-center">
                      <div class="col-auto">
                        <h6 class="card-header-title mb-0">Notifications</h6>
                      </div>
                      <div class="col-auto"><a class="card-link fw-normal" href="#">Mark all as read</a></div>
                    </div>
                  </div>
				  <div class="scrollbar-overlay" style="max-height:19rem">
                    <div class="list-group list-group-flush fw-normal fs--1">
                      <div class="list-group-title border-bottom">NEW</div>
 
					
                        <div id="noti_earlier" class="list-group-title border-bottom">EARLIER</div>
'.$std.'
 
 
                    </div>
                  </div>
				  <div class="card-footer text-center border-top"><a class="card-link d-block" href="#" onclick="notification()">View all</a></div>
                </div>
              </div>';
				  
				  
				  $menue='
				  
				  
				  ';
				  
 
	$id=$row1[$j]['subgroups_id'];	
	$list='';
	
	$subgroups=array();
	$groups=array();
	
	$query="select * from 	tbl_users_permission,tbl_users_submenu WHERE  tbl_users_permission.tables=tbl_users_submenu.submenu_id and  tbl_users_permission.userType='$userType' and tbl_users_submenu.is_key='1'";
	$result=mysqli_query($connect,$query);   $rowcount=mysqli_num_rows($result); $row = mysqli_fetch_all($result,MYSQLI_ASSOC);
	for($i=$rowcount-1;$i>=0;$i--)
	{  
		if(($row[$i]['alls']==1) || ($row[$i]['view']==1)){
				if($list==''){$list=$row[$i]['submenu'];}else{$list=$list.','.$row[$i]['submenu'];}
			}
		$t2=$row[$i]['alls'];	
		if($userType=='1')	{ $t2=1; }
		
		if(($t2==1) || ($row[$i]['view']==1)){
				$subgroups[$row[$i]['subgroups']]=$row[$i]['subgroups'];
				$tt=$row[$i]['subgroups'];
				$query1="select `groups` from tbl_users_subgroups WHERE subgroups_id='$tt'";
				$result1=mysqli_query($connect,$query1); $rowcount1=mysqli_num_rows($result1); $row1 = mysqli_fetch_all($result1,MYSQLI_ASSOC);
				for($j=$rowcount1-1;$j>=0;$j--)
				{ 
				 	$groups[$row1[$j]['groups']]=$row1[$j]['groups'];
				}
			}	
			
			
	}

	$user_access =explode(',',$list);
 
	
	?>

	
<!DOCTYPE html>
<html lang="en-US" dir="ltr">

  
<!-- Mirrored from prium.github.io/falcon/v3.0.0-beta7/# by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 23 May 2021 19:26:45 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
 
        <meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
        <meta   name='viewport'  content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'  />
    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title id="p_title">  |  <?php echo $common_page_title; ?></title>

    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
 
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $base_u; ?>assets/img/favicons/fab1.png">
    <link rel="manifest" href="<?php echo $base_u; ?>assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="<?php echo $base_u; ?>assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">
    <script src="<?php echo $base_u; ?>assets/js/config.js"></script>
    <script src="<?php echo $base_u; ?>vendors/overlayscrollbars/OverlayScrollbars.min.js"></script>



    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
    <link href="<?php echo $base_u; ?>vendors/overlayscrollbars/OverlayScrollbars.min.css" rel="stylesheet">
    <link href="<?php echo $base_u; ?>assets/css/theme-rtl.min.css" rel="stylesheet" id="style-rtl">
    <link href="<?php echo $base_u; ?>assets/css/theme.min.css" rel="stylesheet" id="style-default">
    <link href="<?php echo $base_u; ?>assets/css/user-rtl.min.css" rel="stylesheet" id="user-style-rtl">
    <link href="<?php echo $base_u; ?>assets/css/user.min.css" rel="stylesheet" id="user-style-default">
	<link href="<?php echo $base_u; ?>vendors/flatpickr/flatpickr.min.css" rel="stylesheet" />
	<link href="<?php echo $base_u; ?>vendors/choices/choices.min.css" rel="stylesheet" />
	<!--Data Table-->
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css'>
<link rel='stylesheet' href='https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css'>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/boxicons@2.0.0/css/boxicons.min.css'>
	
 
<link rel='stylesheet' href='https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css'>
	<!--File-->	
<link href="<?php echo $base_u; ?>vendors/dropzone/dropzone.min.css" rel="stylesheet" />	
	
	
    <script>
      var isRTL = JSON.parse(localStorage.getItem('isRTL'));
      if (isRTL) {
        var linkDefault = document.getElementById('style-default');
        var userLinkDefault = document.getElementById('user-style-default');
        linkDefault.setAttribute('disabled', true);
        userLinkDefault.setAttribute('disabled', true);
        document.querySelector('html').setAttribute('dir', 'rtl');
      } else {
        var linkRTL = document.getElementById('style-rtl');
        var userLinkRTL = document.getElementById('user-style-rtl');
        linkRTL.setAttribute('disabled', true);
        userLinkRTL.setAttribute('disabled', true);
      }
    </script>
	
	<style>


			.radi{ font-size: 20px; cursor: pointer; }
			div#alert1 {margin: 0px !important;height: 20px;padding-top: 24px;}
			div#alert2 {margin: 0px !important;height: 20px;padding-top: 24px;}
			a.page-link {padding: 0px 10px 0px 10px;}

			<?php //export--   ?> 			
		   .btn-app { color: white; box-shadow: none; border-radius: 3px; position: relative; padding: 10px 15px; margin: 0; min-width: 60px; max-width: 80px; text-align: center; border: 1px solid #ddd; background-color: #f4f4f4; font-size: 12px; transition: all .2s; background-color: steelblue !important;}.btn-app > .fa, .btn-app > .glyphicon, .btn-app > .ion { font-size: 30px; display: block;}.btn-app:hover { border-color: #aaa; transform: scale(1.1);}.pdf { background-color: #dc2f2f !important;}.excel { background-color: #3ca23c !important;}.csv { background-color: #e86c3a !important;}.imprimir { background-color: #8766b1 !important;} .selectTable{ height:40px; float:right;} .btn-secondary { color: #fff; background-color: #4682b4; border-color: #4682b4;}.btn-secondary:hover { color: #fff; background-color: #315f86; border-color: #545b62;}.titulo-tabla{ color:#606263; text-align:center; margin-top:15px; margin-bottom:15px; font-weight:bold;}.inline{ display:inline-block; padding:0;}
		   .btn-app { padding: 5px 5px; margin: 0; min-width: 60px; max-width: 80px; font-size: 12px; transition: all .2s;}
					
						
 <?php //600--   ?>  
		@media only screen and (max-width: 600px) {
			.d-none-m{display:none;}
		    .alert-success,.alert-danger {color: #007e49;background-color: #ccf6e4f0;border-color: #b3f2d7d1;}	
			.invisible_m{visibility: hidden;} 
			 input.form-control.form-control-sm { max-width: 200px;}
			.btn-app {min-width: 40px; } 
		
		}	
		
 <?php //600++   ?>  
		@media only screen and (min-width: 600px) {
			.alert_height{height: 50px;}
			.d-none-c{display:none;}
			.mt20{margin-top:20px;}
			.alert_m{margin-left: 13px;margin-right: 13px;margin-bottom: 30px;}
			.pt0{padding-top:4px !important;}
			.p30{padding-left: 30px; padding-right: 30px; }
			.never_c{display:none;}
			.navbar {padding-top: 0rem;padding-bottom: 0rem;} 
			.nhc40{height: 40px;} 
			.mt5com{margin-top: -1rem;margin-bottom: -7px; } 
			input.form-control.search-input.fuzzy-search {height: 30px;margin-top: -1px;}
			img.rounded-circle {margin-top: 4px;}
			.avatar img, .avatar .avatar-name {width: 80%;height: 80%;}		
		}
	
 <?php //1000++   ?>    
	@media only screen and (min-width: 1000px) {
	.modal_content_margin {
    margin-top: -50px !important;
}
				a#add_new_button {  position: fixed;  top: -7px; z-index: 1050; left: 55%;}
			.footer-button { margin: auto;  width: 30%;  padding: 0px;}
			.dataTables_wrapper .dataTables_filter {float: right;text-align: right;visibility: hidden;}
			.currentPage{position: absolute; text-align: right; right: 2%;}
			 div.dataTables_wrapper div.dataTables_paginate ul.pagination {justify-content: flex-end;}
			
        }
	
 <?php //1000--   ?> 	
	@media only screen and (max-width: 1000px) {
	ul.pagination {
    width: 100% !important;
    padding: 0px 0px 20px 0px;
    margin-left: 40% !important;
}
			div#table_place__info { margin: auto; width: 60%; padding: 10px;}
			div#layout_content {  margin-left: -.9rem; margin-right: -.9rem;}
 			.currentPage{text-align: center;left: 0%;} 
			div.dataTables_wrapper div.dataTables_paginate ul.pagination {justify-content: center;}
			button.btn.btn-secondary.buttons-collection.dropdown-toggle.buttons-page-length.selectTable {  margin-top: 10px; margin-bottom: 20px;  text-align: center;}									
	        
		}
	

	@media (min-width: 576px){ .flexcontent { margin-bottom: -50px; }}
			button.btn.btn-secondary.buttons-collection.dropdown-toggle.buttons-page-length.selectTable {height: 30px;padding: 0px 5px 0px 5px;font-size: 13px;}

 <?php //Tiny--   ?> 
  .mce-notification {display: none !important;}
  
  
  .center_div {
    position: fixed;
    z-index:999;
    left: 50%;
    top: 40%;
    transform: translate(-50%, -50%);
}
  
  
  .loader {
  border: 3px solid #f3f3f3;
  border-radius: 50%;
  border-top: 3px solid #3498db;
  width: 20px;
  height: 20px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}


.alert-success {
    color: #ffffff;
    background-color: #2c7be5f5;
    border-color: #2e8ce5cf;
    background: linear-gradient(to right,#006dff, #f0fff6cc), url(https://picsum.photos/1280/853/?random=1) no-repeat top center;
}
.bg-success {
    background-color: #2c7be5 !important;
}
span.nav-link-text.ps-1 {
    cursor: pointer;
}

@media screen and (max-width: 767px) { li.paginate_button.previous { display: inline;} li.paginate_button.next {  display: inline; } li.paginate_button { display: none; }}
 
 td{
 padding-top: 5px !important;
 padding-bottom: 0px !important;
 
 }
 .svg-inline--fa.fa-w-18 {
    width: 0.9em;
}
svg.svg-inline--fa.fa-edit.fa-w-18.text-900.fs-3 {
    margin-left: 6px;
}

.zindex_minus {
	z-index:2 !important;
} 
 
 
.mce-container, .mce-container *, .mce-widget, .mce-widget *  {
 
}
 .mce-reset {
  
}

.modal-content{
    z-index: 99999999 !important;
}

.tox-notifications-container {
   
}


.tox-toolbar__primary {
    background-color: white !important;
}


 ::-ms-clear {
  display: none;
}

.form-control-clear {
  z-index: 10;
  pointer-events: auto;
  cursor: pointer;
}


/* Custom page CSS (Not required)
--------------------------------------------- */

#exampleContainer {
  padding: 50px;
}

.text-right {
    text-align: right;
}

.mce-content-body p {
    margin: 1px 0 !important;
}

p {
    margin: 0px !important;
	font-size: 13px !important;
	padding: 5px 10px 5px 10px;
} 
h5.mb-2.fs-0 {
    font-size: 14px !important;
    margin-top: 5px !important;
}

.modal-body table {
  border-collapse: collapse;
}
.modal-body th {
	padding:3px;
	    color: black;
  border: 1px solid lightgray;
}
.modal-body td {
	    color: black;
		padding:3px;
  border: 1px solid lightgray;
}

.modal-body p {
	    color: black !important;
}
span.fa-stack {
    margin-top: -35px;
}
 

 
.border_less{
	border: 0px; padding: 0px !important; margin: 0px !important;
}

body#tinymce {
    background: aliceblue !important;
}

body.mceContentBody { 
   background: aliceblue !important;
   color:#000;
}

 
hr {
    margin: 0rem 0;
    color: var(--falcon-border-color);
    background-color: currentColor;
    border: 0;
    opacity: 1;
}

body {

    color: #000000 !important;
}



#outer
{
    width:100%;
 
}
.inner
{
    display: inline-block;
}

.float-right
{
        float: right;
}
.ui-datepicker-calendar {
   display: none;
}

input{
    /*border-radius: 0px !important;*/
    padding: 1px 5px 1px 10px !important;
}

.choices__inner {

    min-height: 0px !important;
}

.choices[data-type*=select-one] .choices__inner {
    padding-bottom: 5px !important;
}

.choices .choices__inner {
    padding: 0px 0px 10px 10px !important;
}

label.form-label.text-right {
    padding-right: 0px;
}

a#add_new_button {
    padding: 0px 10px 0px 10px !important;
    margin-top: 14px !important;
}

.card.mb-3 {
    background: aliceblue;
}


@media print {
    .noprint {
        display: none;
    }
}


.a4_print{
	
	position: fixed !important;
    z-index: 9;
    top: 0;
    width: 796.8px;
    height: 1123.2px !important;
	
}

	table { page-break-inside:auto  !important;}  tr    { page-break-inside:avoid  !important; page-break-after:auto  !important;}
	
		p { font-size: 16px !important; }
		
		td{
		 word-wrap: break-word;
		}
		
		.choices__list.choices__list--dropdown {
    z-index: 99999999;
}


p {
    font-size: 14px !important;
    line-height: 1.3;
 
}
p.text-word-break.fs--1 {
    display: ;
}

h5.mb-2.fs-0 {
    margin-bottom: 0
px
 !important;
}

.file-thumbnail {
    height: 1.5rem;
    width: 1.5rem;
}


 
svg#profile_check {
    width: 25px;
}








.br {
  border-radius: 8px;  
}
.w80 {
   width: 80%;
}
.cardx {
  border: 2px solid #fff;
  box-shadow:0px 0px 4px 0 #a9a9a9c4;
  padding: 30px 40px;
  width: 100%;
  margin: 50px auto;
   background: white !important;
   margin-top: 20px !important;
}
.profilePic {
  height: 25px;
  width: 305px;
  border-radius: 5%;
  width: 100%;
  margin: 3px 0px 3px 0px;
}
.comment {
  height: 15px;
  background: #777;
  margin-top: 20px;
}

.wrapper {
  width: 0px;
  animation: fullView 0.5s forwards linear;
}

@keyframes fullView {
  100% {
    width: 100%;
  }
}

.animate {
   animation : shimmer 2s infinite;
   background: linear-gradient(to right, #eff1f3 4%, #e2e2e2 25%, #eff1f3 36%);
   background-size: 1000px 100%;
}

@keyframes shimmer {
  0% {
    background-position: -1000px 0;
  }
  100% {
    background-position: 1000px 0;
  }
}








</style>

  </head>

  <body id="bodys">
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
      <div class="container" data-layout="container" style=" ">
	    <x id="this_user_id_value" class="d-none" ><?php echo $userID;?></x>
	    <x id="store_input_mul" class="d-none" >b</x>
	    <x id="last_id_nav" class="d-none" ></x>
	    <x id="current_page_function" class="d-none" ></x>
	    <x id="parent_base_url" class="d-none" ><?php echo $parent_base_url; ?></x>
	  
 
	  
        <script>
          var isFluid = JSON.parse(localStorage.getItem('isFluid'));
          if (isFluid) {
            var container = document.querySelector('[data-layout]');
            container.classList.remove('container');
            container.classList.add('container-fluid');
          }
        </script>
		
		
		
		
        <nav class="navbar navbar-light navbar-vertical navbar-expand-xl zindex_minus" style="display: none;  ">
          <script>
            var navbarStyle = localStorage.getItem("navbarStyle");
            if (navbarStyle && navbarStyle !== 'transparent') {
              document.querySelector('.navbar-vertical').classList.add(`navbar-${navbarStyle}`);
            }
          </script>
          <div class="d-flex align-items-center mt5com"> 
            <div class="toggle-icon-wrapper">
              <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
            </div><a class="navbar-brand" href="#"  style="font-weight: 1 !important;">
              <div class="d-flex align-items-center py-3"style="
    margin-top: 5px;
"><img class="me-2" src="<?php echo $base_u; ?>assets/img/illustrations/falcon.png" alt="" width="160" /><span class="font-sans-serif" style="
    z-index: 9999;
    font-size: 22px;
    font-weight: 600;
"><?php //echo $_brand; 
	?></span></div>
            </a>
          </div>
          <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
            <div class="navbar-vertical-content scrollbar">
              <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
 
 		<?php
		$query2="select * from tbl_users_groups order by position desc";
		$result2=mysqli_query($connect,$query2); $rowcount2=mysqli_num_rows($result2); $row2 = mysqli_fetch_all($result2,MYSQLI_ASSOC);
		 
		for($k=$rowcount2-1;$k>=0;$k--)
		{
			if (in_array($row2[$k]['groups_id'], $groups)){
			
			?>
                <li class="nav-item">
                  <!-- label-->
                  <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                    <div class="col-auto navbar-vertical-label"><?php echo $row2[$k]['groups'];?></div>
                    <div class="col ps-0">
                      <hr class="mb-0 navbar-vertical-divider" />
                    </div>
                  </div>	
			   <?php	
			    $id=$row2[$k]['groups_id'];		
				$query1="select * from tbl_users_subgroups WHERE `groups`='$id'  order by position desc";
				$result1=mysqli_query($connect,$query1); 
				$rowcount1=mysqli_num_rows($result1); 
				$row1 = mysqli_fetch_all($result1,MYSQLI_ASSOC);
				 for($j=$rowcount1-1;$j>=0;$j--)
				{   
					
					if (in_array($row1[$j]['subgroups_id'], $subgroups)){
					?>
					
				      <a id="this_<?php echo $row1[$j]['subgroups_id'];?>"  class="nav-link dropdown-indicator   " href="#<?php echo str_replace(" ","",$row1[$j]['subgroups']).$j;?>" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="user">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="<?php echo $row1[$j]['icon'];?>"></span></span><span class="nav-link-text ps-1"><?php echo $row1[$j]['subgroups'];?></span></div>
                  </a><!-- inner pages-->
                  <ul class="nav collapse false" id="<?php echo str_replace(" ","",$row1[$j]['subgroups']).$j;?>">			
			
					   <?php	
					    $id=$row1[$j]['subgroups_id'];		
						$query="select * from tbl_users_submenu WHERE subgroups='$id' AND is_operational='0'  order by tbl_users_submenu.position desc";
						$result=mysqli_query($connect,$query); $rowcount=mysqli_num_rows($result); $row = mysqli_fetch_all($result,MYSQLI_ASSOC);
						for($i=$rowcount-1;$i>=0;$i--)
						{  
					
					if (in_array($row[$i]['submenu'], $user_access)){
					?>
					
					
					 
				  

				  		<li id="this_<?php echo $row[$i]['function_name'];?>" onclick="<?php echo $row[$i]['function_name'];?>('<?php echo $row[$i]['capital'];?>','_<?php echo $row[$i]['small'];?>_a','1&2','')"  
						class="nav-item <?php if (in_array($row[$i]['submenu'], $user_access)){ } else { echo "d-none"; } ?>"><a id="_<?php echo $row[$i]['small'];?>_a"   class="nav-link  "> <div class="d-flex align-items-center"><span class="nav-link-text ps-1"><?php if($row[$i]['icon'] !=''){ echo $row[$i]['icon'].' '; } echo $row[$i]['submenu'];?></span></div></a></li>

				   
               					
					
					
					
					
					
								
						<?php
						}
							} ?>
                  </ul> 						
				<?php 
					
				}	
					} ?>
				 </li>
		<?php 
			
		}
			
			} ?>				 
				 
				 
				 
 
				
				
              </ul>
            </div>
          </div>
        </nav>
		
		
		
		
		
        <nav class="navbar navbar-light navbar-glass navbar-top navbar-expand-xl nhc40 zindex_minus" style="display: none; ">
          <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarStandard" aria-controls="navbarStandard" aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
          <a class="navbar-brand me-1 me-sm-3" href="#" style="font-weight: 1 !important;">
            <div class="d-flex align-items-center"><img class="me-2" src="<?php echo $base_u; ?>assets/img/illustrations/falcon.png" alt="" width="140" /><span class="font-sans-serif" style="font-size: 23px;font-weight: 500;"><?php echo $_brand; ?></span></div>
          </a>
		  
		  
		  
          <div class="collapse navbar-collapse scrollbar" id="navbarStandard">
            <ul class="navbar-nav" data-top-nav-dropdowns="data-top-nav-dropdowns">
              <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="dashboard">Dashboard</a>
                <div class="dropdown-menu dropdown-menu-card border-0 mt-0" aria-labelledby="dashboard">
                  <div class="bg-white dark__bg-1000 rounded-3 py-2"><a class="dropdown-item link-600 fw-medium" href="#">Default</a><a class="dropdown-item link-600 fw-medium" href="dashboard/alternate.html">Alternate</a></div>
                </div>
              </li> 
            </ul>
          </div>
		  
	
        </nav>
		
		
		
		
		
		
        <div class="content">




	
		
		
		 <nav class="navbar navbar-light navbar-glass navbar-top navbar-expand nhc40 zindex_minus" style="display: none;  ">
            <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
            <a class="navbar-brand me-1 me-sm-3" href="#"  style="font-weight: 1 !important;">
				 <div class="d-flex align-items-center"><img class="me-2" src="<?php echo $base_u; ?>assets/img/illustrations/falcon.png" alt="" width="140" /><span class="font-sans-serif" style="font-size: 23px;font-weight: 500;"><?php echo $_brand=''; ?></span></div>
            </a>
			
		
			
            <ul class="navbar-nav align-items-center d-none d-lg-block" style="margin-right: 20px;">
 
                <div class="search-box" data-list='{"valueNames":["title"]}'>
                  <form class="position-relative" data-bs-toggle="search" data-bs-display="static">
					  <input  list=languages id="myInput" class="form-control   fuzzy-search search-box" type="search" style="    padding-left: 2rem; padding-right: 2rem; line-height: 1.7;  border-radius: 50rem !important; -webkit-box-shadow: none; padding-left: 40px !important;" placeholder="Search..." aria-label="Search" />
            
				   <span class="fas fa-search search-box-icon"></span>
                  </form><button class="btn-close position-absolute end-0 top-50 translate-middle shadow-none p-1 me-1 fs--2" type="button" data-bs-dismiss="search"></button>
 
					<datalist id=languages>
					 <option value="No Suggest"></option>
					</datalist> 
				  
                </div> 
              </li>
            </ul>

 				
			
			
			
			
            <ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">
              <!--<li class="nav-item">
                <a class="nav-link px-0 notification-indicator notification-indicator-warning notification-indicator-fill icon-indicator" href="app/e-commerce/shopping-cart.html"><span class="fas fa-shopping-cart" data-fa-transform="shrink-7" style="font-size: 33px;"></span><span class="notification-indicator-number">1</span></a>
              </li>-->
            <li class="nav-item dropdown">
				<?php echo $notification; ?>
            </li>
              <li class="nav-item dropdown"><a class="nav-link pe-0" id="navbarDropdownUser" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <div class="avatar avatar-xl">
                    <img class="rounded-circle" id="{{image_top}}" src="<?php echo $base_u; ?>assets/img/team/<?php echo $userImage; ?>" alt="" />
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end py-0" aria-labelledby="navbarDropdownUser">
                  <div class="bg-white dark__bg-1000 rounded-2 py-2">
                   <a class="dropdown-item fw-bold text-warning" href="#!"><span class="fas fa-crown me-1"></span><span id="avater_name"><?php echo $userName; ?></span></a>
                    <div class="dropdown-divider"></div>  
                    <!--<a class="dropdown-item" href="#!">2Set status</a>-->
                    <a class="dropdown-item" id="this_profile" onclick="Profile('Profile','_profile_a','1&2','<?php echo $userID; ?>')"   href="#Profile"><svg style="opacity:.4" class="svg-inline--fa fa-user-circle fa-w-16 text-900 fs-0" aria-hidden="true" focusable="false" data-prefix="far" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg=""><path fill="currentColor" d="M248 104c-53 0-96 43-96 96s43 96 96 96 96-43 96-96-43-96-96-96zm0 144c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm0-240C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 448c-49.7 0-95.1-18.3-130.1-48.4 14.9-23 40.4-38.6 69.6-39.5 20.8 6.4 40.6 9.6 60.5 9.6s39.7-3.1 60.5-9.6c29.2 1 54.7 16.5 69.6 39.5-35 30.1-80.4 48.4-130.1 48.4zm162.7-84.1c-24.4-31.4-62.1-51.9-105.1-51.9-10.2 0-26 9.6-57.6 9.6-31.5 0-47.4-9.6-57.6-9.6-42.9 0-80.6 20.5-105.1 51.9C61.9 339.2 48 299.2 48 256c0-110.3 89.7-200 200-200s200 89.7 200 200c0 43.2-13.9 83.2-37.3 115.9z"></path></svg> Profile &amp; account</a>
                    <a class="dropdown-item"  onclick="Activity('Activity','_Activity_a','1&2','<?php echo $userID; ?>')"  href="#Activity"><svg  style="opacity:.4" class="svg-inline--fa fa-clock fa-w-16 text-900 fs-0" aria-hidden="true" focusable="false" data-prefix="far" data-icon="clock" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm61.8-104.4l-84.9-61.7c-3.1-2.3-4.9-5.9-4.9-9.7V116c0-6.6 5.4-12 12-12h32c6.6 0 12 5.4 12 12v141.7l66.8 48.6c5.4 3.9 6.5 11.4 2.6 16.8L334.6 349c-3.9 5.3-11.4 6.5-16.8 2.6z"></path></svg> Activity Log</a>
                    <div class="dropdown-divider"></div>
                    <!--<a class="dropdown-item" href="#"><svg style="opacity:.4" class="svg-inline--fa fa-sun fa-w-16 text-900 fs-0" aria-hidden="true" focusable="false" data-prefix="far" data-icon="sun" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M494.2 221.9l-59.8-40.5 13.7-71c2.6-13.2-1.6-26.8-11.1-36.4-9.6-9.5-23.2-13.7-36.2-11.1l-70.9 13.7-40.4-59.9c-15.1-22.3-51.9-22.3-67 0l-40.4 59.9-70.8-13.7C98 60.4 84.5 64.5 75 74.1c-9.5 9.6-13.7 23.1-11.1 36.3l13.7 71-59.8 40.5C6.6 229.5 0 242 0 255.5s6.7 26 17.8 33.5l59.8 40.5-13.7 71c-2.6 13.2 1.6 26.8 11.1 36.3 9.5 9.5 22.9 13.7 36.3 11.1l70.8-13.7 40.4 59.9C230 505.3 242.6 512 256 512s26-6.7 33.5-17.8l40.4-59.9 70.9 13.7c13.4 2.7 26.8-1.6 36.3-11.1 9.5-9.5 13.6-23.1 11.1-36.3l-13.7-71 59.8-40.5c11.1-7.5 17.8-20.1 17.8-33.5-.1-13.6-6.7-26.1-17.9-33.7zm-112.9 85.6l17.6 91.2-91-17.6L256 458l-51.9-77-90.9 17.6 17.6-91.2-76.8-52 76.8-52-17.6-91.2 91 17.6L256 53l51.9 76.9 91-17.6-17.6 91.1 76.8 52-76.8 52.1zM256 152c-57.3 0-104 46.7-104 104s46.7 104 104 104 104-46.7 104-104-46.7-104-104-104zm0 160c-30.9 0-56-25.1-56-56s25.1-56 56-56 56 25.1 56 56-25.1 56-56 56z"></path></svg> Settings</a>-->
                    <a class="dropdown-item"style=" cursor: pointer;" onclick="logout()"><svg  style="opacity:.4" class="svg-inline--fa fa-sign-out-alt fa-w-16 text-900 fs-0" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="sign-out-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M497 273L329 441c-15 15-41 4.5-41-17v-96H152c-13.3 0-24-10.7-24-24v-96c0-13.3 10.7-24 24-24h136V88c0-21.4 25.9-32 41-17l168 168c9.3 9.4 9.3 24.6 0 34zM192 436v-40c0-6.6-5.4-12-12-12H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h84c6.6 0 12-5.4 12-12V76c0-6.6-5.4-12-12-12H96c-53 0-96 43-96 96v192c0 53 43 96 96 96h84c6.6 0 12-5.4 12-12z"></path></svg> Logout</a>
 		   
			   
			   </div>
                </div>
              </li>
            </ul>
          </nav>
		
		
		
          <nav class="navbar navbar-light navbar-glass navbar-top navbar-expand nhc40 zindex_minus" style="display: none;  ">
          </nav> 
		  
  <x id="center_loader"></x>
 <x id="alert" style="position: fixed; z-index: 9;margin-top:3px;">  </x>
<div id="loader_place" class="center_div"> </div>

   
 

					  
 
            
 
		  
		  
		  
          <script>
            var navbarPosition = localStorage.getItem('navbarPosition');
            var navbarVertical = document.querySelector('.navbar-vertical');
            var navbarTopVertical = document.querySelector('.content .navbar-top');
            var navbarTop = document.querySelector('[data-layout] .navbar-top');
            var navbarTopCombo = document.querySelector('.content [data-navbar-top="combo"]');
            if (navbarPosition === 'top') {
              navbarTop.removeAttribute('style');
              navbarTopVertical.remove(navbarTopVertical);
              navbarVertical.remove(navbarVertical);
              navbarTopCombo.remove(navbarTopCombo);
            } else if (navbarPosition === 'combo') {
              navbarVertical.removeAttribute('style');
              navbarTopCombo.removeAttribute('style');
              navbarTop.remove(navbarTop);
              navbarTopVertical.remove(navbarTopVertical);
            } else {
              navbarVertical.removeAttribute('style');
              navbarTopVertical.removeAttribute('style');
              navbarTop.remove(navbarTop);
              navbarTopCombo.remove(navbarTopCombo);
            }
          </script>
 
