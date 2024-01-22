<?php


include('../../header.php'); 
	 
?>

 

 <div class=""> <div class=" " id="_card-body"> </div> </div>
		  
		  
		  
<div id="form_place"></div>
	
<div class="card">
		<div class="card-header">
			<p id="table_title" class="d-none"></p>
		</div>
		<div class="card-body pt-0">
			<h4 id="currentPage" class="currentPage" > </h4>
			<div id="table_head_content"></div>
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
 	
	
	<script>
 

		function contact(current_page,li_id){

				page_function(current_page,li_id);

				var th='SL,Name,Contact,Message,Action,Make as Seen#text-end@fs--2';
				var table_info='contact#contact_id#desc';
				var td='contact#(wordwrap30*@[fs--1*, email#|Email*^b+phone#|Phone*^b+created#|Created*, message@<white-space: break-spaces;*, _email_1+_delete_1, _mark_1';
				var _t_sl='1';  
				
				var export_columns_='[ 0, 1, 2, 3 ]';
				var export_title='Contact -ECL';
				
			 	table(th,table_info,td,_t_sl,export_columns_,export_title);

		}	
		
		function callback(current_page,li_id){

				page_function(current_page,li_id);

				var th='SL,Callback Number,Created,Action,Make as Seen#text-end@fs--2';
				var table_info='callback#callback_id#desc';
				var td='callback#(wordwrap30*@[fs-0*, created#@[fs-0*,_delete_1, _mark_1';
				var _t_sl='1';  
				
				var export_columns_='[ 0, 1, 2]';
				var export_title='Callback -ECL';
				
			 	table(th,table_info,td,_t_sl,export_columns_,export_title);

		}	
		
		function news(current_page,li_id,call_for,id_value){
				$("#current_page_function").html('news');
				//Form
				var f_title='News Title@r@t=  #News Brief@r@t= #News Details@r@t= #Freature Image@@t=';
				var f_type='input#area#area@tiny#file@single';
				var f_column='news #brief #details #image';
				var f_classes='ind_class	#	#tinymce#';
				var f_class='custom_class';
				var f_placeh=' 			 #				 #		 #';
				var f_buttton='Save@news_button@insert';
				var f_table='news';
				var f_sl='1';
 
				//Table
				var th='SL,News Title,Brief,Image,Created,Action#text-end,Key#text-end@fs--1';
				var table_info='news#news_id#desc#'+id_value;
				var td='news#@[fs--0*,brief,image#!~'+parent_base_url()+'/ecl/uploads/news/*!<width: 8vw;*, created#@[fs--1*,_edit_1+_delete_1, _mark_1';
				var _t_sl='1';  
				
				var export_columns_='[ 0, 1, 2]';
				var export_title='News -ECL';
				
				if(call_for=='1&2'){
				    page_function(current_page,li_id);
					make_form(f_title,f_type,f_column,f_classes,f_class,f_placeh,f_buttton,f_table,f_sl,table_info);
					table(th,table_info,td,_t_sl,export_columns_,export_title);
				}
				
				if(call_for=='1'){
					make_form(f_title,f_type,f_column,f_classes,f_class,f_placeh,f_buttton,f_table,f_sl,table_info);
				}
				
				if(call_for=='2'){
					table(th,table_info,td,_t_sl,export_columns_,export_title);
				}
		}
		
		
		function subscriber(current_page,li_id){

				page_function(current_page,li_id);

				var th='SL,Email,Created,Action,Make as Seen#text-end@fs--2';
				var table_info='subscriber#id#desc';
				var td='email#(wordwrap30*@[fs-0*, created#@[fs-0*,_delete_1, _mark_1';
				var _t_sl='1';  
				
				var export_columns_='[ 0, 1, 2]';
				var export_title='Subscriber -ECL';
				
			 	table(th,table_info,td,_t_sl,export_columns_,export_title);

		}
		
	</script>
	
	
