<?php

$currentPage ='Contact';
$title ='Contact';
include('../../header.php'); 
 
$export_title="Contact -ECL";
$export_columns="[ 0, 1, 2, 3 ]";
 
		 
?>
<div class="card">
		<div class="card-header">
			<p id="table_title" class="d-none"></p>
		</div>
		<div class="card-body pt-0">
			<h4 id="currentPage" class="currentPage" > </h4>
			<div id="table_content"></div>
		</div>
</div>
 <?php //echo table_start('SL,Name,Contact,Message,Action,Make as Seen#text-end','fs--2','All Contact'); 
 
 /*
 echo generate_table('SL,Name,Contact,Message,Action,Make as Seen#text-end@fs--2', //Table header Footer#individual class @common cleass td th
					 'contact#contact_id#desc',
					 
					 'contact#(wordwrap30*@[fs--1*,
					  email#|Email*^b+phone#|Phone*^b+created#|Created*,  
					  message@<white-space: break-spaces;*,
					  _email_1+_delete_1,
					  _mark_1','1');       //  '\+'=> br  $=> style, $$=>class   //td make => field$style$$class@label@function.function_code	, 
					   
   */
  ?>   
     
<?php include('../../footer.php'); ?>


