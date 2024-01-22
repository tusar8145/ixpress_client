<?php

	include('header.php'); 
    include('configuration.php'); 
 
?>

  
<!--Alert place--> 
<div class=""> <div class=" " id="alert_place"> </div> </div>
		  
<!--layout content place--> 		

	<div class="cardx br" id="shimmer" style="display:none">
	<div class="wrapper">
       
	  
	  <div class="row">
			    <div class="col-md-5">
 				</div>			    
				<div class="col-md-2">
				   <div class="profilePic animate"></div>

				</div>
				<div class="col-md-5">
				</div>
		  </div>       
	  
	      <div class="row">
			    <div class="col-md-4">
						<div class="profilePic animate"></div>
				</div>			    
				<div class="col-md-6">
						 
				</div>
				<div class="col-md-2">
						<div class="profilePic animate"></div>
				</div>
		  </div>
		  
      <div class="comment br animate w80"></div>
      <div class="comment br animate"></div>
      <div class="comment br animate"></div>
      <div class="comment br animate"></div>
      <div class="comment br animate"></div>
      <div class="comment br animate"></div>
      <div class="comment br animate"></div>
      <div class="comment br animate"></div>
      <div class="comment br animate"></div>
      <div class="comment br animate"></div>
      <div class="comment br animate"></div>
      <div class="comment br animate"></div>
   </div>
</div>

<div id="layout_content">
	

	
	</div>	
<div id="xx"></div>	
<div id="holder" style="display:none"></div>                     
 
               
 <div id="multi_select"></div>   
 
<!-- <div class="modal fade" id="scrollinglongcontentb" data-keyboard="false" tabindex="-1" aria-labelledby="scrollinglongcontentLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
	<div class="modal-header">
        <h5 class="modal-title" id="scrollinglongcontentLabel">File Manager</h5><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
	  

      <div class="modal-body modal-dialog modal-dialog-scrollable mt-0">
	<iframe class="mp"style=" " src="http://dev.engineersconsortiumltd.com/admin2/FileManager/index.html" width="100%"  height="800px" frameborder="0" marginwidth="0" marginheight="0"></iframe>
      </div>
      <div class="modal-footer"><button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button><button class="btn btn-primary" type="button">Understood</button></div>
    </div>
  </div>
</div>-->
 
				  
				  
				 <?php include('view/dashboard.php'); ?> 

<?php include('footer.php'); ?>
 	
	 
	<script>
	var common_creator=
				'Created➤created+creator#{userID}[userName]&select * from tbl_users where userID**@[fs--1*➤'
				//+'Creator➤creator#{userID}[userName]&select * from tbl_users where userID**@[fs--1*➤'
				+'LastModify➤modified+modifier#{userID}[userName]&select * from tbl_users where userID**@[fs--1*➤'
			//	+'Modifier➤modifier#{userID}[userName]&select * from tbl_users where userID**@[fs--1*➤'
	;
	
 
	 
	
	function form_split(form){
				var first1='0';var first2='0';var first3='0';var first4='0';
				var str_array = form.split('➤');
				var f_title='';  var f_type='';	var f_column='';	var f_classes=''; var x=0;
				for(var i = 0; i < str_array.length; i++) {
					if(x==4){x=0;}
					if(x==0){if(first1=='0'){first1='1'; f_title=str_array[i]; }else{ f_title=f_title+'#'+str_array[i]; }}
					if(x==1){if(first2=='0'){first2='1'; f_type=str_array[i]; }else{ f_type=f_type+'#'+str_array[i]; }}
					if(x==2){if(first3=='0'){first3='1'; f_column=str_array[i]; }else{ f_column=f_column+'#'+str_array[i]; }}
					if(x==3){if(first4=='0'){first4='1'; f_classes=str_array[i]; }else{ f_classes=f_classes+'#'+str_array[i]; }}
					 
					x++;
				}
				//console.log(f_classes);
				return f_title+'➤'+f_type+'➤'+f_column+'➤'+f_classes;
	}
	
		function search_bar(key,type){
		if(type==1){
				if(key!=''){
										return 'gets_html#select*from '+key+' @<datalist id=languages>@<option value=" '+key+' "></option>@</datalist>@ '+key+' #languages';

				}else{
						return 'gets_html#select*from clients@<datalist id=languages>@<option value=""></option>@</datalist>@#languages';
					}
			 
			}if(type==2){
				const myArray = key.split(" ");
				return 'gets_html#select * from '+myArray[0]+' @<datalist id=languages>@<option value="'+myArray[1]+'"></option>@</datalist>@'+myArray[1]+'#languages';
			}
		}
	
	function table_split(table){
				var str_array = table.split('➤');
				var t1='';  var t2='';	 var x=0; var first1='0';var first2='0';
				for(var i = 0; i < str_array.length; i++) {
					if(x==2){x=0;}
					if(x==0){if(first1=='0'){first1='1';  t1=str_array[i]; }else{ t1=t1+','+str_array[i]; }}
					if(x==1){if(first2=='0'){first2='1';  t2=str_array[i]; }else{ t2=t2+','+str_array[i]; }}
					x++;
				}
				console.log(t1);
				console.log(t2);
				return t1+'➤'+t2.substring(2);
	}
	
	function newtable(t1,t2,t3){
		if(t3==''){t3=t1+'_id ASC';}
		return 'select@newTable~select * from  '+t1+'  where  '+t2+'    order by  '+t3+' ';
		}		
		
	function newtableMulti(t1,t2,t3){
		if(t3==''){t3=t1+'_id ASC';}
		return 'selectMulti@newTable~select * from  '+t1+'  where  '+t2+'    order by  '+t3;
		}

		
	function newtable_table(t1,t2){
	    if(t2==''){t2=t1+'_id';}
		return  t1+'_id#{'+t1+'_id}['+t1+']&select * from '+t1+' where '+t2+' **@[fs--1*';
		}
		
 
			function website_settings(current_page,submenu_li_id,call_for,this_user_id){
				
				$("#current_page_function").html('website_settings');
				//Form
				var f_title='Setting Name@r@t=  #Value@r@t= #Image@@';
				var f_type='input#area#file@single@../../ecl/uploads/settings/';
				var f_column='setting #value #image';
				var f_classes='ind_class ##';
				var f_class='custom_class';
				var f_placeh='#sector@gif,jpeg,png,PNG@200#';
				var f_buttton='Insert@setting_button@insert';
				var f_table='settings';
				var f_sl='1';
				var f_functions='button_expand@Update@add_new_button@click,footer_insert@Insert';
				var f_view_place='#form_place';
				var table_request='';
				//Table
				var th='SL,Setting Name,Setting Value,Action#text-end,Created,Active#text-end@fs--1';
				var table_info='settings#id#desc#'+this_user_id;
				var table_functions='this_function@'+website_settings.name;
				var td='setting#@[fs--0*,value#(wordwrap30*@[fs--1*,_delete_1+_edit_1,created#@[fs--1*,_mark_1';
				var _t_sl='1';  
				
				var export_columns_='[ 0, 1, 2]';
				var export_title='Website Settings ';
				
				if(call_for=='1&2'){
				    layout_content("basic");
				    page_function(current_page,submenu_li_id,'',website_settings.name);
					make_form(f_title,f_type,f_column,export_title,f_classes,f_class,f_placeh,f_buttton,f_table,f_sl,table_info,f_functions,f_view_place);
					table(th,table_info,table_functions,td,_t_sl,export_columns_,export_title,table_request,'#table_place');
				}
				
				if(call_for=='1'){
					scroll_to_top();
					make_form(f_title,f_type,f_column,export_title,f_classes,f_class,f_placeh,f_buttton,f_table,f_sl,table_info,f_functions,f_view_place);
				}
				
								if(call_for=='2'){
					table(th,table_info,table_functions,td,_t_sl,export_columns_,export_title,table_request,'#table_place');
				}
				
				if(call_for=='3'){
				var f_sl='2';
				var f_view_place='#modal_place';
				make_form(f_title,f_type,f_column,export_title,f_classes,f_class,f_placeh,f_buttton,f_table,f_sl,table_info,f_functions,f_view_place);
				}
		}
		
 		function Activity(current_page,submenu_li_id,call_for,this_user_id){
				layout_content("basic");

				$("#current_page_function").html('Profile');
				
				profile_element.replace("{{a1}}", "W3Schools");
				
				$('#profile_place').hide().html(profile_element).fadeIn();
				
				//Form
				var f_title='First Name@r@t=  #Last Name@@t=   #UserName@r@t=  #Profile Image@@t= #Phone@@t= #Address@@t=';
				var f_type='input#input#input#file@multi@../assets/img/team/#input#input#input';
				var f_column='firstName#lastName#userName#image#userPhone#address';
				var f_classes='';
				var f_class='custom_class';
				var f_placeh='';
				var f_buttton='';
				var f_table='tbl_users';
				var f_sl='1';
				var f_functions='button_expand@Update@add_new_button@@hide';
				var f_view_place='#form_place';
				

				var th='SL,Name,Username,Email,Usertype,Phone,Address@fs--2';
				var table_info='tbl_users#userID#desc#'+this_user_id+'#Where userID=';
				var table_functions='';
				var td='firstName#@+lastName#@,userName#@,userEmail#@,userType#{userType_id}&select * from tbl_users_userType where userType_id**@[fs--0*,userPhone#@,address#@';
				var _t_sl='1';  
				var table_request='userName#avater_name,userName#{{userName}},firstName#{{a1}},lastName#{{a2}},userType#{{userType}}##select * from tbl_users_userType where userType_id,image#{{image}}#assets/img/team/,image#{{image_top}}#assets/img/team/'; //field#id
				var export_columns_='[ 0, 1, 2, 3 ]';
				var export_title='Profile ';
				
				if(call_for=='1&2' || call_for=='2'){
				page_function(current_page,submenu_li_id,'#profile_place',Profile.name);		
				make_form(f_title,f_type,f_column,export_title,f_classes,f_class,f_placeh,f_buttton,f_table,f_sl,table_info,f_functions,f_view_place);
			 	table(th,table_info,table_functions,td,_t_sl,export_columns_,export_title,table_request,'#table_place');	
				
				
				
				 var th='SL,Type,Log,Device,IP,Location@fs--2';
				 var table_info2='activitylog#id#desc#'+this_user_id+'#Where userID=';
				 var td='types#@,log#@,device#@,ip#@,location#@';
				  var table_request='';
				table(th,table_info2,table_functions,td,_t_sl,export_columns_,export_title,table_request,'#table_place2');				
				
				
				
				
				} 
				if(call_for=='1'){
				make_form(f_title,f_type,f_column,export_title,f_classes,f_class,f_placeh,f_buttton,f_table,f_sl,table_info,f_functions,f_view_place);
				} 
				
				//form 2
				var f_view_place='#form_place2';
				var f_title='Old Password@r@p=5=10  #New Password@r@p=5=10 #Retype New Password@r@p=5=10';
				var f_type='input#input#input';
				var f_column='op#np#rnp';
				var f_classes='';
				var f_class='custom_class';
				var f_placeh='';
				var f_buttton='';
				var f_table='tbl_users';
				var f_sl='1';
				var f_functions='button_expand@Change Password@add_new_button2@@hide';
				var table_info='tbl_users#userID#desc#'+this_user_id;		
				var table_functions='';
				
				
				
				
				if(call_for=='1&2' || call_for=='2'){
				page_function(current_page,submenu_li_id,'#profile_place',Profile.name);		
				make_form(f_title,f_type,f_column,export_title,f_classes,f_class,f_placeh,f_buttton,f_table,f_sl,table_info,f_functions,f_view_place);	
				}
				
				if(call_for=='1'){
				make_form(f_title,f_type,f_column,export_title,f_classes,f_class,f_placeh,f_buttton,f_table,f_sl,table_info,f_functions,f_view_place);
				}				






			 
		}
		
		
		function Profile(current_page,submenu_li_id,call_for,this_user_id){
				layout_content("basic");
				 
				$("#current_page_function").html('Profile');
				this_user_id=document.getElementById('this_user_id_value').innerHTML;
				
				$('#profile_place').hide().html(profile_element).fadeIn();
					//$("#shimmer").hide();
				//Form
				var f_title='First Name@r@t=  #Last Name@@t=   #UserName@r@t=  #Profile Image@@t= #Phone@@t= #Address@@t=';
				var f_type='input#input#input#file@multi@../assets/img/team/#input#input#input';
				var f_column='firstName#lastName#userName#image#userPhone#address';
				var f_classes='';
				var f_class='custom_class';
				var f_placeh='';
				var f_buttton='';
				var f_table='tbl_users';
				var f_sl='1';
				var f_functions='button_expand@Update@add_new_button@@hide';
				var f_view_place='#form_place2';
				var th='SL,First Name,Last Name,Username,Email,Usertype,Phone,Address@fs--2';
				var table_info='tbl_users#userID#desc#'+this_user_id+'#Where userID=';
				var table_functions='';
				var td='firstName#@,lastName#@,userName#@,userEmail#@,userType#{userType_id}&select * from tbl_users_userType where userType_id**@[fs--0*,userPhone#@,address#@';
				var _t_sl='1';  
				var table_request='userName#{{userName}},firstName#{{a1}},lastName#{{a2}},userType#{{userType}}##select * from tbl_users_userType where userType_id,image#{{image}}#assets/img/team/,image#{{image_top}}#assets/img/team/'; //field#id
				var export_columns_='[ 0, 1, 2, 3 ]';
				var export_title='Profile ';
				
				if(call_for=='1&2'){
				page_function(current_page,submenu_li_id,'#profile_place',Profile.name);		
				make_form(f_title,f_type,f_column,export_title,f_classes,f_class,f_placeh,f_buttton,f_table,f_sl,table_info,f_functions,f_view_place);
			 	table(th,table_info,table_functions,td,_t_sl,export_columns_,export_title,table_request,'#table_place');	
				} 
				if(call_for=='1'){
				make_form(f_title,f_type,f_column,export_title,f_classes,f_class,f_placeh,f_buttton,f_table,f_sl,table_info,f_functions,f_view_place);
				} 
				if(call_for=='2'){
			 	table(th,table_info,table_functions,td,_t_sl,export_columns_,export_title,table_request,'#table_place');	
				} 
				
				//form 2
				var f_view_place='#form_place';
				var f_title='Old Password@r@p=5=10  #New Password@r@p=5=10 #Retype New Password@r@p=5=10';
				var f_type='input#input#input';
				var f_column='op#np#rnp';
				var f_classes='';
				var f_class='custom_class';
				var f_placeh='';
				var f_buttton='';
				var f_table='tbl_users';
				var f_sl='1';
				var f_functions='button_expand@Change Password@add_new_button2@@hide';
				var table_info='tbl_users#userID#desc#'+this_user_id;		
				var table_functions='';
				
				
				
				
				if(call_for=='1&2'){
				page_function(current_page,submenu_li_id,'#profile_place',Profile.name);		
				make_form(f_title,f_type,f_column,export_title,f_classes,f_class,f_placeh,f_buttton,f_table,f_sl,table_info,f_functions,f_view_place);	
				}
				
				if(call_for=='1'){
				make_form(f_title,f_type,f_column,export_title,f_classes,f_class,f_placeh,f_buttton,f_table,f_sl,table_info,f_functions,f_view_place);
				}				

			 
		}
		
  
	 
		
		
		//user
 		function users(current_page,submenu_li_id,call_for,this_user_id){
				
				$("#current_page_function").html('users');
				
				//Form
				var f_title='First Name@r@t=  #Last Name@@t=   #UserName@r@t=  #Profile Image@@t= #Email@r@t= #Phone@@t= #Address@@t= #User Type@r@t= #Email Validation@@t=#Select Branch@@t='; 
				var f_type='input#input#input#file@single@../assets/img/team/#input#input#input#select@newTable~select * from tbl_users_userType  order by userType_id ASC#moreSettings@email_validate#select@newTable~select * from branch  order by branch_id ASC';
				var f_column='firstName#lastName#userName#image#userEmail#userPhone#address#userType#tbl_users_userStatus#branch_id';
				var f_classes='';
				var f_class='custom_class';
				var f_placeh='';
				var f_buttton='Insert@users_button@insert';
				var f_table='tbl_users';
				var f_sl='1';
				var f_functions='button_expand@Update@add_new_button@click,footer_insert@Insert';
				var f_view_place='#form_place';
				

				var th='SL,Name,Email,Branch,Usertype,Username,Phone,Action#text-end,Active#text-end,Created@fs--1';
				var table_info='tbl_users#userID#desc#'+this_user_id;
				var table_functions='multiselect@button_delete,this_function@'+users.name;
				var td='firstName#@+lastName#@,userEmail#@,branch_id#{branch_id}[branch]&select * from branch where branch_id+branch_id#{branch_id}[branch_code]&select * from branch where branch_id**@[fs--0*,userType#{userType_id}&select * from tbl_users_userType where userType_id**@[fs--0*#,userName#@,userPhone,_edit_1, _mark_1,created#@[fs--1*';
				
				
				var _t_sl='1';  
				var table_request=search_bar('tbl_users_userType userType','2'); //field#id
				var export_columns_='[ 0, 1, 2, 3 ]';
				var export_title='';
				
				if(call_for=='1&2'){
				layout_content("basic");
				page_function(current_page,submenu_li_id,'#form_place',users.name);		
				make_form(f_title,f_type,f_column,export_title,f_classes,f_class,f_placeh,f_buttton,f_table,f_sl,table_info,f_functions,f_view_place);
			 	table(th,table_info,table_functions,td,_t_sl,export_columns_,"User List",table_request,'#table_place2');	
				
				
				
				 var th='SL,UserName,Type,Log,Device,IP,Location@fs--2';
				 var table_info2='activitylog#id#desc#'+this_user_id;
				 var td='userID#[userName]{userID}&select * from tbl_users where userID**@[fs--0*,types#@,log#@,device#@,ip#@,location#@';
				  var table_request='';
				 table(th,table_info2,table_functions,td,_t_sl,export_columns_,"User Activity Log",table_request,'#table_place');				

				} 		
				
				if(call_for=='1'){
	
				make_form(f_title,f_type,f_column,export_title,f_classes,f_class,f_placeh,f_buttton,f_table,f_sl,table_info,f_functions,f_view_place);
			 	table(th,table_info,table_functions,td,_t_sl,export_columns_,"User List",table_request,'#table_place2');	

				 var th='SL,UserName,Type,Log,Device,IP,Location@fs--2';
				 var table_info2='activitylog#id#desc#'+this_user_id;
				 var td='userID#[userName]{userID}&select * from tbl_users where userID**@[fs--0*,types#@,log#@,device#@,ip#@,location#@';
				  var table_request='';
				 table(th,table_info2,table_functions,td,_t_sl,export_columns_,"User Activity Log",table_request,'#table_place');				

				} 
				if(call_for=='2'){
				make_form(f_title,f_type,f_column,export_title,f_classes,f_class,f_placeh,f_buttton,f_table,f_sl,table_info,f_functions,f_view_place);
				table(th,table_info,table_functions,td,_t_sl,export_columns_,"User List",table_request,'#table_place2');
			
				} 
	 
		}					
		function userRole(current_page,submenu_li_id,call_for,this_user_id){
				var name_sm='userType';
				var name_cap='User Role';
				var table_name='tbl_users_userType';
				var parent_function=userRole.name;
				
				var f_title=name_cap+' Name@r@t=';
				var f_type='input#input';
				var f_column=name_sm;
				var f_classes='ind_class';
								
				var th='SL,'+name_cap+' Name,Created,Action#text-end@fs--1';
				var td=name_sm+'#@[fs--0*,created#@[fs--1*,_delete_1+_edit_1@[text-end';
				
				
				var table_info=table_name+'#'+name_sm+'_id#desc#'+this_user_id;	
				var table_functions='this_function@'+parent_function;    var table_request=''; 
				var f_functions='button_expand@Update@add_new_button@click,footer_insert@Insert';
				basic_fun(f_title,f_type,f_classes,f_column,th,td,table_info,table_request,table_functions,current_page,submenu_li_id,call_for,this_user_id,parent_function,name_sm,name_cap,table_name,f_functions); 
		}			
		function groups(current_page,submenu_li_id,call_for,this_user_id){
				var name_sm='groups';
				var name_cap='Groups';
				var table_name='tbl_users_groups';
				var parent_function=groups.name;
				
				var f_title=name_cap+' Name@r@t= 	#Position@r@t=';
				var f_type='input#input';
				var f_column=name_sm+'#position';
				var f_classes='ind_class';
								
				var th='SL,'+name_cap+' Name,Position,Created,Action#text-end@fs--1';
				var td=name_sm+'#@[fs--0*,position#@[fs--0*,created#@[fs--1*,_delete_1+_edit_1@[text-end';
				
				
				var table_info=table_name+'#position#asc#'+this_user_id;	
				var table_functions='this_function@'+parent_function;    var table_request=''; 
				var f_functions='button_expand@Update@add_new_button@click,footer_insert@Insert';
				basic_fun(f_title,f_type,f_classes,f_column,th,td,table_info,table_request,table_functions,current_page,submenu_li_id,call_for,this_user_id,parent_function,name_sm,name_cap,table_name,f_functions); 
		}	
		function subgroups(current_page,submenu_li_id,call_for,this_user_id){
				var name_sm='subgroups';
				var name_cap='Subgroups';
				var table_name='tbl_users_subgroups';
				var parent_function=subgroups.name;
				
				var f_title=name_cap+' Name@r@t=	#Groups@r@t= #Icon@r@t=  #Position@r@t=';
				var f_type='input#select@newTable~select * from tbl_users_groups  order by groups_id ASC#area#input';
				var f_column=name_sm+'#groups#icon#position';
				var f_classes='ind_class';
								
				var th='SL,'+name_cap+' Name,Groups,Position,Created,Action#text-end@fs--1';
				var td=name_sm+'#@[fs--0*,groups#{groups_id}&select * from tbl_users_groups where groups_id**@[fs--0*,position#@[fs--0*,created#@[fs--1*,_delete_1+_edit_1@[text-end';
				
				
				var table_info=table_name+'#subgroups_id#desc@subgroups_id#'+this_user_id+'## where 1';
				var table_functions='this_function@'+parent_function;    var table_request=''; 
				var f_functions='button_expand@Update@add_new_button@click,footer_insert@Insert';
				basic_fun(f_title,f_type,f_classes,f_column,th,td,table_info,table_request,table_functions,current_page,submenu_li_id,call_for,this_user_id,parent_function,name_sm,name_cap,table_name,f_functions); 
		}	
		
		function submenu(current_page,submenu_li_id,call_for,this_user_id){
				var name_sm='submenu';
				var name_cap='Submenu';
				var table_name='tbl_users_submenu';
				var parent_function=submenu.name;
				
				var f_title='Submenu Name@r@t=#Mainmenu Name@r@t#Table Name@r@t#Call Function@r@t#Capital Title@r@t#Small Title (Single Word)@r@t#Position@r@t#Icon@@t';
				var f_type='input#select@newTable~select * from tbl_users_subgroups  order by subgroups_id ASC#input#input#input#input#input#area';
				var f_column='submenu#subgroups#tables#function_name#capital#small#position#icon';
				var f_classes='ind_class';
								
				var th='SL,'+name_cap+' Name,Groups,Function,IsOperational,IsActive#text-end,Edit#text-end,Position,Created@fs--1';
				var td=name_sm+'#@[fs--0*,subgroups#{subgroups_id}&select * from tbl_users_subgroups where subgroups_id**@[fs--0*,function_name#@[fs--0*,_mark_1{is_operational},_mark_1,_edit_1,position#@[fs--0*,created#@[fs--1*@[text-end';
				
				
				var table_info=table_name+'#submenu_id#desc#'+this_user_id;	
				var table_functions='multiselect@button_delete,this_function@'+parent_function;    var table_request=''; 
				var f_functions='button_expand@Update@add_new_button@click,footer_insert@Insert';
				basic_fun(f_title,f_type,f_classes,f_column,th,td,table_info,table_request,table_functions,current_page,submenu_li_id,call_for,this_user_id,parent_function,name_sm,name_cap,table_name,f_functions); 
		}	
		
 			
		
		function userPermission(current_page,submenu_li_id,call_for,this_user_id){
				
				var name_cap='User Permission'; //Title table
				var table_name='tbl_users_permission'; 
				var table_id_name='tbl_users_permission_id';  

				var f_title='User Permission Name@r@t=';
				var f_type='input';
				var f_column='userType';
				var f_classes='ind_class';
								
				var th='SL,	User Type, Section,	All Permission#text-end, View#text-end,Insert#text-end, Update#text-end, Delete#text-end@fs--1';
				var td='userType#[userType]{userType_id}&select * from tbl_users_userType where userType_id**@[fs--0*,	tables#[submenu]{submenu_id}&select * from tbl_users_submenu where submenu_id**@[fs--0*,	_mark_1{alls}, _mark_1{view},	_mark_1{inserts},	_mark_1{updates},	_mark_1{deletes}';
				
				var table_info=table_name+'#tbl_users_permission_id#desc#'+this_user_id;
				var parent_function=userPermission.name;	
				var table_functions='this_function@'+parent_function;    var table_request=search_bar('tbl_users_submenu submenu','2'); 
				var name_sm=table_name;		
				var f_functions='button_expand@Update@add_new_button@click@hide,footer_insert@Insert';
				basic_fun(f_title,f_type,f_classes,f_column,th,td,table_info,table_request,table_functions,current_page,submenu_li_id,call_for,this_user_id,parent_function,name_sm,name_cap,table_name,f_functions); 
		}			

	 
 		function tiny_template(current_page,submenu_li_id,call_for,this_user_id){
				var name_sm='tinyTemplate';
				var name_cap='Tiny Template';
				var table_name='tiny_template';
				var parent_function=tiny_template.name;
				 
				var f_title='Title@r@t=#Description@r@t=#Content@@t=#Position@@t=';
				var f_type='input#input#area@tiny#input';
				var f_column='tiny_template#description#content#position';
				var f_classes='ind_class##tinymce#';
								
				var th='SL,'+name_cap+' Name,Position,Created,Action#text-end,Active#text-end@fs--1';
				var td='tiny_template#@[fs--0*,position#@[fs--0*,created#@[fs--1*,_delete_1+_edit_1,_mark_1@[text-end';
				
				
				var table_info=table_name+'#tiny_template_id#desc#'+this_user_id;	
				var table_functions='this_function@'+parent_function;    var table_request=''; 
				var f_functions='button_expand@Update@add_new_button@click,footer_insert@Insert';
				basic_fun(f_title,f_type,f_classes,f_column,th,td,table_info,table_request,table_functions,current_page,submenu_li_id,call_for,this_user_id,parent_function,name_sm,name_cap,table_name,f_functions); 
		}		
 		 
				
				
			 
			 
		
 		function settings_tools(current_page,submenu_li_id,call_for,this_user_id){
				var name_sm='settings_tools';
				var name_cap='Tools';
				var table_name='settings_tools';
				var parent_function=settings_tools.name;
				
				var f_title='Title@r@t= 	#Link@r@t=	#Hints@r@t=	#logo@@t=	';
				var f_type='input#input#area#file@single@../../ecl/uploads/tools/';
				var f_column='settings_tools#link#details#logo';
				var f_classes='ind_class';
								
				var th='SL,Title,Created,Action#text-end,Active#text-end@fs--1';
				var td='settings_tools#@[fs--0*,created#@[fs--1*,_delete_1+_edit_1,_mark_1@[text-end';
				
				
				var table_info=table_name+'#settings_tools_id#desc#'+this_user_id;	
				var table_functions='this_function@'+parent_function;    var table_request=''; 
				var f_functions='button_expand@Update@add_new_button@click,footer_insert@Insert';
				basic_fun(f_title,f_type,f_classes,f_column,th,td,table_info,table_request,table_functions,current_page,submenu_li_id,call_for,this_user_id,parent_function,name_sm,name_cap,table_name,f_functions); 
		}		
		


 		function email_addresses(current_page,submenu_li_id,call_for,this_user_id){
				var name_sm='systemEmails';
				var name_cap='System Email Addresses';
				var table_name='email_addresses';
				var parent_function=email_addresses.name;
				
				var f_title='Email Id@r@e= 	#Password@r@t=	#SetFrom@r@t=	#AddReplyTo@r@t=	#Mail Title@r@t=	';
				var f_type='input#input#input#input#input';
				var f_column='email_addresses#password#setFrom#replyTo#title';
				var f_classes='ind_class';
								
				var th='SL,Email Id,Created,Action#text-end,Active#text-end@fs--1';
				var td='email_addresses#@[fs--0*,created#@[fs--1*,_delete_1+_edit_1,_mark_1@[text-end';
				
				
				var table_info=table_name+'#email_addresses_id#desc#'+this_user_id;	
				var table_functions='this_function@'+parent_function;    var table_request=''; 
				var f_functions='button_expand@Update@add_new_button@click,footer_insert@Insert';
				basic_fun(f_title,f_type,f_classes,f_column,th,td,table_info,table_request,table_functions,current_page,submenu_li_id,call_for,this_user_id,parent_function,name_sm,name_cap,table_name,f_functions); 
		}		
		
		 function email_outbox(current_page,email_outbox_li_id,call_for,this_user_id){
				var name_sm='email_outbox';
				var name_cap='Email Outbox';
				var table_name='email_outbox';
				var parent_function=email_outbox.name;
				
				var f_title='Send From@r@t=#Send to@r@t=#Subject@@t#Message@@t #Attachment File@@t';
				var f_type='select@newTable~select * from email_addresses  order by email_addresses_id ASC#input#input#area@tiny#file@single@../../ecl/uploads/email_outbox/';
				var f_column='email_addresses_id#email_to#email_outbox#details#files';
				var f_classes='###tinymce#';
				
				var th='SL,Subject,Send From,Send To,Created,Action#text-end@fs--1';
				var td=name_sm+'#@[fs--0*,'+newtable_table('email_addresses','')+',email_to#*^b,created,_delete_able+_edit_able@[text-end';
				
				var this_user_id_value=document.getElementById('this_user_id_value').innerHTML;
				
				var table_info=table_name+'#email_outbox_id#desc#'+this_user_id;	
				var table_functions='multiselect@button_delete,this_function@'+parent_function;    
				var table_request=search_bar();
				var f_functions='button_expand@Update#invisible@add_new_button@click,footer_insert@Send';
				basic_fun(f_title,f_type,f_classes,f_column,th,td,table_info,table_request,table_functions,current_page,email_outbox_li_id,call_for,this_user_id,parent_function,name_sm,name_cap,table_name,f_functions); 
		}
		 
		
		function notifications(current_page,notifications_li_id,call_for,this_user_id){
				var name_sm='notifications';
				var name_cap='Notification Manager';
				var table_name='notifications';
				var parent_function=notifications.name;
				
				var f_title='Notification Content@r@t=#Submenu Name@r@t #Date name@r@t=#Total  counts@r@n=#Interval Days@r@n=#Start before Days@r@n=#Mail to@r@t=#Mail Sub@r@t=#Accessibility@r@t=#Modifiers@@t=';
				var f_type='area#input#input#input#input#input#input#input#moreSettings@documents_accessable'
				+'#selectMulti@newTable~select * from tbl_users  order by userID ASC~userID~userName';
				var f_column='notifications#src#date_from#totalnoti#intervals#date_before#mail_to#sub#accessable#access_by';
				var f_classes='#######';
				
				var th='SL,Notification,Is done,Counts,Created,Creator,LastModify,Modifier,Action#text-end,Active#text-end,Editable@fs--1';
				var td=name_sm+'#@[fs--0*,is_done@[fs--0*,count_noti@[fs--0,created#@[fs--1*,creator#{userID}[userName]&select * from tbl_users where userID**@[fs--0*,modified#@[fs--1*,modifier#{userID}[userName]&select * from tbl_users where userID**@[fs--0*,_delete_able+_edit_able+,_mark_1@[text-end,_mark_1{is_editable}@[text-end';
				
				var this_user_id_value=document.getElementById('this_user_id_value').innerHTML;
				
				var table_info=table_name+'#notifications_id#desc#'+this_user_id+'## where     (creator='+this_user_id_value+') OR (accessable=\'public\') OR ((accessable=\'Modifiers\') AND (access_by Like \'%'+this_user_id_value+'%\' OR access_by Like \''+this_user_id_value+'%\' OR access_by Like \'%'+this_user_id_value+'\'))';	
				var table_functions='multiselect@button_delete,this_function@'+parent_function;    
				var table_request=''; 
				var f_functions='button_expand@Update@add_new_button@click,footer_insert@Insert@@@@';
				basic_fun(f_title,f_type,f_classes,f_column,th,td,table_info,table_request,table_functions,current_page,notifications_li_id,call_for,this_user_id,parent_function,name_sm,name_cap,table_name,f_functions); 
		}		
 
		
		//dashboard		
		//Basic 
		function basic_fun(f_title,f_type,f_classes,f_column,th,td,table_info,table_request,table_functions,current_page,submenu_li_id,call_for,this_user_id,parent_function,name_sm,name_cap,table_name,f_functions){
				$("#current_page_function").html(parent_function);
				//Form
				var f_class='custom_class';
				 
				
				//speachal
				if(parent_function=='email_documents'){
						var f_buttton='Send@'+name_sm+'_button@insert';
						var f_placeh='#Use Comma (, ) to separate multiple recipients#';
					}else {
						var f_buttton='Insert@'+name_sm+'_button@insert';
						var f_placeh='			 #		 #';
					}
				
				
				
				var f_table=table_name;
				var f_sl='1';
				
				var f_view_place='#form_place';
				//var table_request='';
				//Table
				var _t_sl='1';  
				var export_columns_='[ 0, 1, 2]';
				var export_title=name_cap+' '; 
				
			if(call_for=='1&2'){
				  layout_content("basic");

				  page_function(current_page,submenu_li_id,'',parent_function);			 	
				  table(th,table_info,table_functions,td,_t_sl,export_columns_,export_title,table_request,'#table_place'); 

			      make_form(f_title,f_type,f_column,export_title,f_classes,f_class,f_placeh,f_buttton,f_table,f_sl,table_info,f_functions,f_view_place); 
				}
				
				 	if(call_for=='1'){
			    	scroll_to_top();
					make_form(f_title,f_type,f_column,export_title,f_classes,f_class,f_placeh,f_buttton,f_table,f_sl,table_info,f_functions,f_view_place);
				}
				
								if(call_for=='2'){
					table(th,table_info,table_functions,td,_t_sl,export_columns_,export_title,table_request,'#table_place');
				}
				
				if(call_for=='3'){
				var f_sl='2';
				var f_view_place='#modal_place';
				make_form(f_title,f_type,f_column,export_title,f_classes,f_class,f_placeh,f_buttton,f_table,f_sl,table_info,f_functions,f_view_place);
				} 
		}			
	
	
	
		function dashboard(current_page,submenu_li_id,call_for,this_user_id){
				  dashboard_call(current_page,submenu_li_id,call_for,this_user_id,dashboard.name,'sector','Dashboard');
		}			
		
		
		function dashboard_call(current_page,submenu_li_id,call_for,this_user_id,parent_function,name_sm,name_cap){
				
				$("#current_page_function").html(name_sm);
				//Form+'sector_id#{{planning}}##SELECT count(tender_books_id) FROM  tender_books  @count(tender_books_id),'
				var table_request=
				+'sector_id#{{sector_count}}##SELECT count(certificate_books_id) FROM certificate_books  WHERE tender_books_type=2@count(certificate_books_id),'
				+'sector_id#{{clients_count}}##SELECT count(clients_id) FROM clients  WHERE 1@count(clients_id),'
				
				+'sector_id#{{p0}}##SELECT count(tender_books_id) FROM tender_books  WHERE tender_status=13@count(tender_books_id),'
				+'sector_id#{{p1}}##SELECT count(tender_books_id) FROM tender_books  WHERE tender_status=14@count(tender_books_id),'
				+'sector_id#{{p2}}##SELECT count(tender_books_id) FROM tender_books  WHERE tender_status=15@count(tender_books_id),'
				+'sector_id#{{p3}}##SELECT count(tender_books_id) FROM tender_books  WHERE tender_status=16@count(tender_books_id),'
				+'sector_id#{{p4}}##SELECT count(tender_books_id) FROM tender_books  WHERE tender_status=17@count(tender_books_id),'
				+'sector_id#{{p5}}##SELECT count(tender_books_id) FROM tender_books  WHERE tender_status=18@count(tender_books_id),'
				+'sector_id#{{p6}}##SELECT count(tender_books_id) FROM tender_books  WHERE tender_status=19@count(tender_books_id),'
				
				
				+'sector_id#{{service_count}}##SELECT count(certificate_books_id) FROM certificate_books  WHERE tender_books_type=3@count(certificate_books_id),'
				+'sector_id#{{Callback_count}}##SELECT count(callback_id) FROM callback  WHERE 1@count(callback_id),'
				+'sector_id#{{News_count}}##SELECT count(news_id) FROM news  WHERE 1@count(news_id),'
				+'JSON#{{users_list}}##SELECT  tbl_users_userType.userType as userType $ tbl_users.a1 as a1 $ tbl_users.image as image $ tbl_users.a2 as a2 FROM tbl_users$tbl_users_userType  WHERE tbl_users.userType=tbl_users_userType.userType_id@@@@@<div class=^d-flex align-items-center mb-3^><div class=^avatar avatar-2xl status-offline^><img class=^rounded-circle^ src=^<?php echo $full_domain_path; ?>/admin/assets/img/team/{{image}}^ alt=^^></div><div class=^flex-1 ms-3^><h6 class=^mb-0 fw-semi-bold^><a class=^text-900^ href=^ ^>{{a1}} {{a2}}</a></h6><p class=^text-500 fs--2 mb-0^>{{userType}}</p></div></div>@userType$a1$a2$image,'	
				+'sector_id#{{Subscriber_count}}##SELECT count(subscriber_id) FROM subscriber  WHERE 1@count(subscriber_id),'
				+'sector_id#{{projects_count}}##SELECT count(certificate_books_id) FROM certificate_books  WHERE tender_books_type=1@count(certificate_books_id)@@@ document.getElementById("dashboard_content").classList.remove("d-none");'
				;  
				//Table
				var th='SL@fs--1';
				var table_info=name_sm+'@d-none#'+name_sm+'_id#desc#'+this_user_id;
				var table_functions='';
				var td='';
				var _t_sl='1';  
				var export_columns_='';
				var export_title=name_cap+' '; 
				
				if(call_for=='1&2'){
				    layout_content("basic");
				    page_function(current_page,submenu_li_id,'',parent_function);
					table(th,table_info,table_functions,td,_t_sl,export_columns_,export_title,table_request,'#table_place'); 
				}

		}		
 
	 
 		//i helpers
		 function tracking_status(current_page,i_tracking_status_li_id,call_for,this_user_id){
				var name_sm='tracking_status';
				var name_cap='Tracking Status';
				var table_name='i_tracking_status';
				var parent_function=tracking_status.name;
				
 	
				var form=
				'Tracking Status Title@r@t=➤input➤i_tracking_status'
				;

				var str_array = form_split(form).split('➤');
				var f_title=str_array[0];  var f_type=str_array[1];	var f_column=str_array[2];	var f_classes=str_array[3];  

				var table=
				'SL➤ ➤'
				+'Tracking Status Title➤i_tracking_status#@[fs--1*➤'
				+common_creator
 				+'Active#text-end➤_mark_1{is_active}#@[fs--1*➤'
 				+'Edit#text-end@fs--1➤_edit_able@[text-end';
				
				var str_array = table_split(table).split('➤');
				var th=str_array[0];  var td=str_array[1];	  
				
				var this_user_id_value=document.getElementById('this_user_id_value').innerHTML;
				
				var table_info='i_tracking_status#i_tracking_status_id#asc@i_tracking_status_id#'+this_user_id+'## where 1';	
				var table_functions='multiselect@button_delete,this_function@'+parent_function;  
				var table_request= search_bar();
				var f_functions='button_expand@Update@add_new_button@click,footer_insert@Insert';
				basic_fun(f_title,f_type,f_classes,f_column,th,td,table_info,table_request,table_functions,current_page,i_tracking_status_li_id,call_for,this_user_id,parent_function,name_sm,name_cap,table_name,f_functions); 
		}
		 function payment_type(current_page,i_payment_type_li_id,call_for,this_user_id){
				var name_sm='payment_type';
				var name_cap='Payment Type';
				var table_name='i_payment_type';
				var parent_function=payment_type.name;
				
 	
				var form=
				'Payment Type Title@r@t=➤input➤i_payment_type'
				;

				var str_array = form_split(form).split('➤');
				var f_title=str_array[0];  var f_type=str_array[1];	var f_column=str_array[2];	var f_classes=str_array[3];  

				var table=
				'SL➤ ➤'
				+'Payment Type Title➤i_payment_type#@[fs--1*➤'
				+common_creator
 				+'Active#text-end➤_mark_1{is_active}#@[fs--1*➤'
 				+'Edit#text-end@fs--1➤_edit_able@[text-end';
				
				var str_array = table_split(table).split('➤');
				var th=str_array[0];  var td=str_array[1];	  
				
				var this_user_id_value=document.getElementById('this_user_id_value').innerHTML;
				
				var table_info='i_payment_type#i_payment_type_id#asc@i_payment_type_id#'+this_user_id+'## where 1';	
				var table_functions='multiselect@button_delete,this_function@'+parent_function;  
				var table_request= search_bar();
				var f_functions='button_expand@Update@add_new_button@click,footer_insert@Insert';
				basic_fun(f_title,f_type,f_classes,f_column,th,td,table_info,table_request,table_functions,current_page,i_payment_type_li_id,call_for,this_user_id,parent_function,name_sm,name_cap,table_name,f_functions); 
		}		
		
				 function packaging_type(current_page,i_packaging_type_li_id,call_for,this_user_id){
				var name_sm='packaging_type';
				var name_cap='Packaging Type';
				var table_name='i_packaging_type';
				var parent_function=packaging_type.name;
				
 	
				var form=
				'Packaging Type Title@r@t=➤input➤i_packaging_type	➤➤'
			    +'Select Services@r@t=➤'+newtableMulti('services','1','')+'➤services_id	➤➤'
				+'Weight (Kg)@r@n=➤input➤weight	➤';
				; 

				var str_array = form_split(form).split('➤');
				var f_title=str_array[0];  var f_type=str_array[1];	var f_column=str_array[2];	var f_classes=str_array[3];  

				var table=
				'SL➤ ➤'
				+'Packaging Type Title➤i_packaging_type#@[fs--1*➤'
				+'Weight➤weight#@[fs--1*➤'
 				+'Servics➤'+newtable_table('services','')+'@[fs--1*➤'

				+common_creator
 				+'Active#text-end➤_mark_1{is_active}#@[fs--1*➤'
 				+'Edit#text-end@fs--1➤_edit_able@[text-end';
				
				var str_array = table_split(table).split('➤');
				var th=str_array[0];  var td=str_array[1];	  
				
				var this_user_id_value=document.getElementById('this_user_id_value').innerHTML;
				
				var table_info='i_packaging_type#i_packaging_type_id#asc@i_packaging_type_id#'+this_user_id+'## where 1';	
				var table_functions='multiselect@button_delete,this_function@'+parent_function;  
				var table_request= search_bar();
				var f_functions='button_expand@Update@add_new_button@click,footer_insert@Insert';
				basic_fun(f_title,f_type,f_classes,f_column,th,td,table_info,table_request,table_functions,current_page,i_packaging_type_li_id,call_for,this_user_id,parent_function,name_sm,name_cap,table_name,f_functions); 
		}
		
			 function delivery_status(current_page,i_delivery_status_li_id,call_for,this_user_id){
				var name_sm='delivery_status';
				var name_cap='Delivery Status';
				var table_name='i_delivery_status';
				var parent_function=delivery_status.name;
				
 	
				var form=
				'Delivery Status Title@r@t=➤input➤i_delivery_status'
				;

				var str_array = form_split(form).split('➤');
				var f_title=str_array[0];  var f_type=str_array[1];	var f_column=str_array[2];	var f_classes=str_array[3];  

				var table=
				'SL➤ ➤'
				+'Delivery Status Title➤i_delivery_status#@[fs--1*➤'
				+common_creator
 				+'Active#text-end➤_mark_1{is_active}#@[fs--1*➤'
 				+'Edit#text-end@fs--1➤_edit_able@[text-end';
				
				var str_array = table_split(table).split('➤');
				var th=str_array[0];  var td=str_array[1];	  
				
				var this_user_id_value=document.getElementById('this_user_id_value').innerHTML;
				
				var table_info='i_delivery_status#i_delivery_status_id#asc@i_delivery_status_id#'+this_user_id+'## where 1';	
				var table_functions='multiselect@button_delete,this_function@'+parent_function;  
				var table_request= search_bar();
				var f_functions='button_expand@Update@add_new_button@click,footer_insert@Insert';
				basic_fun(f_title,f_type,f_classes,f_column,th,td,table_info,table_request,table_functions,current_page,i_delivery_status_li_id,call_for,this_user_id,parent_function,name_sm,name_cap,table_name,f_functions); 
		}
		
			 function shipment_method(current_page,i_shipment_method_li_id,call_for,this_user_id){
				var name_sm='shipment_method';
				var name_cap='Shipment Method';
				var table_name='i_shipment_method';
				var parent_function=shipment_method.name;
				
 	
				var form=
				'Shipment Method Title@r@t=➤input➤i_shipment_method'
				;

				var str_array = form_split(form).split('➤');
				var f_title=str_array[0];  var f_type=str_array[1];	var f_column=str_array[2];	var f_classes=str_array[3];  

				var table=
				'SL➤ ➤'
				+'Shipment Method Title➤i_shipment_method#@[fs--1*➤'
				+common_creator
 				+'Active#text-end➤_mark_1{is_active}#@[fs--1*➤'
 				+'Edit#text-end@fs--1➤_edit_able@[text-end';
				
				var str_array = table_split(table).split('➤');
				var th=str_array[0];  var td=str_array[1];	  
				
				var this_user_id_value=document.getElementById('this_user_id_value').innerHTML;
				
				var table_info='i_shipment_method#i_shipment_method_id#asc@i_shipment_method_id#'+this_user_id+'## where 1';	
				var table_functions='multiselect@button_delete,this_function@'+parent_function;  
				var table_request= search_bar();
				var f_functions='button_expand@Update@add_new_button@click,footer_insert@Insert';
				basic_fun(f_title,f_type,f_classes,f_column,th,td,table_info,table_request,table_functions,current_page,i_shipment_method_li_id,call_for,this_user_id,parent_function,name_sm,name_cap,table_name,f_functions); 
		}
		
		 function priority(current_page,i_priority_li_id,call_for,this_user_id){
				var name_sm='priority';
				var name_cap='Products Priority';
				var table_name='i_priority';
				var parent_function=priority.name;
				
 	
				var form=
				'Products Priority Title@r@t=➤input➤i_priority'
				;

				var str_array = form_split(form).split('➤');
				var f_title=str_array[0];  var f_type=str_array[1];	var f_column=str_array[2];	var f_classes=str_array[3];  

				var table=
				'SL➤ ➤'
				+'Products Priority Title➤i_priority#@[fs--1*➤'
				+common_creator
 				+'Active#text-end➤_mark_1{is_active}#@[fs--1*➤'
 				+'Edit#text-end@fs--1➤_edit_able@[text-end';
				
				var str_array = table_split(table).split('➤');
				var th=str_array[0];  var td=str_array[1];	  
				
				var this_user_id_value=document.getElementById('this_user_id_value').innerHTML;
				
				var table_info='i_priority#i_priority_id#asc@i_priority_id#'+this_user_id+'## where 1';	
				var table_functions='multiselect@button_delete,this_function@'+parent_function;  
				var table_request= search_bar();
				var f_functions='button_expand@Update@add_new_button@click,footer_insert@Insert';
				basic_fun(f_title,f_type,f_classes,f_column,th,td,table_info,table_request,table_functions,current_page,i_priority_li_id,call_for,this_user_id,parent_function,name_sm,name_cap,table_name,f_functions); 
		}	
		
			 function zone(current_page,zone_li_id,call_for,this_user_id){
				var name_sm='zone';
				var name_cap='Zone';
				var table_name='zone';
				var parent_function=zone.name;
				
 	
				var form=
				'Zone Title@r@t=➤input➤zone'
				;

				var str_array = form_split(form).split('➤');
				var f_title=str_array[0];  var f_type=str_array[1];	var f_column=str_array[2];	var f_classes=str_array[3];  

				var table=
				'SL➤ ➤'
				+'Zone Title➤zone#@[fs--1*➤'
				+common_creator
 				+'Active#text-end➤_mark_1{is_active}#@[fs--1*➤'
 				+'Edit#text-end@fs--1➤_edit_able@[text-end';
				
				var str_array = table_split(table).split('➤');
				var th=str_array[0];  var td=str_array[1];	  
				
				var this_user_id_value=document.getElementById('this_user_id_value').innerHTML;
				
				var table_info='zone#zone_id#asc@zone_id#'+this_user_id+'## where 1';	
				var table_functions='multiselect@button_delete,this_function@'+parent_function;  
				var table_request= search_bar();
				var f_functions='button_expand@Update@add_new_button@click,footer_insert@Insert';
				basic_fun(f_title,f_type,f_classes,f_column,th,td,table_info,table_request,table_functions,current_page,zone_li_id,call_for,this_user_id,parent_function,name_sm,name_cap,table_name,f_functions); 
		}			
		
		
 function unit(current_page,i_unit_li_id,call_for,this_user_id){
	 var name_sm='unit';
				var name_cap='Unit';
				var table_name='i_unit';
				var parent_function=unit.name;
				
 	
				var form=
				'Unit Title@r@t=➤input➤i_unit'
				;

				var str_array = form_split(form).split('➤');
				var f_title=str_array[0];  var f_type=str_array[1];	var f_column=str_array[2];	var f_classes=str_array[3];  

				var table=
				'SL➤ ➤'
				+'Unit Title➤i_unit#@[fs--1*➤'
				+common_creator
 				+'Active#text-end➤_mark_1{is_active}#@[fs--1*➤'
 				+'Edit#text-end@fs--1➤_edit_able@[text-end';
				
				var str_array = table_split(table).split('➤');
				var th=str_array[0];  var td=str_array[1];	  
				
				var this_user_id_value=document.getElementById('this_user_id_value').innerHTML;
				
				var table_info='i_unit#i_unit_id#asc@i_unit_id#'+this_user_id+'## where 1';	
				var table_functions='multiselect@button_delete,this_function@'+parent_function;  
				var table_request= search_bar();
				var f_functions='button_expand@Update@add_new_button@click,footer_insert@Insert';
				basic_fun(f_title,f_type,f_classes,f_column,th,td,table_info,table_request,table_functions,current_page,i_unit_li_id,call_for,this_user_id,parent_function,name_sm,name_cap,table_name,f_functions); 
		}			
		
 function relation(current_page,i_relation_li_id,call_for,this_user_id){
				var name_sm='relation';
				var name_cap='Relation';
				var table_name='i_relation';
				var parent_function=relation.name;
				
 	
				var form=
				'Relation Title@r@t=➤input➤i_relation➤➤'
				+'Short Name@r@t=➤input➤short_name'
				;

				var str_array = form_split(form).split('➤');
				var f_title=str_array[0];  var f_type=str_array[1];	var f_column=str_array[2];	var f_classes=str_array[3];  

				var table=
				'SL➤ ➤'
				+'Relation Title➤i_relation#@[fs--1*➤'
				+'Short Name➤short_name#@[fs--1*➤'
				+common_creator
 				+'Active#text-end➤_mark_1{is_active}#@[fs--1*➤'
 				+'Edit#text-end@fs--1➤_edit_able@[text-end';
				
				var str_array = table_split(table).split('➤');
				var th=str_array[0];  var td=str_array[1];	  
				
				var this_user_id_value=document.getElementById('this_user_id_value').innerHTML;
				
				var table_info='i_relation#i_relation_id#asc@i_relation_id#'+this_user_id+'## where 1';	
				var table_functions='multiselect@button_delete,this_function@'+parent_function;  
				var table_request= search_bar();
				var f_functions='button_expand@Update@add_new_button@click,footer_insert@Insert';
				basic_fun(f_title,f_type,f_classes,f_column,th,td,table_info,table_request,table_functions,current_page,i_relation_li_id,call_for,this_user_id,parent_function,name_sm,name_cap,table_name,f_functions); 
		}	
		
 function product_type(current_page,i_product_type_li_id,call_for,this_user_id){
				var name_sm='product_type';
				var name_cap='Product type';
				var table_name='i_product_type';
				var parent_function=product_type.name;
				
 	
				var form=
				'Select Services@r@t=➤'+newtableMulti('services','1','')+'➤services_id	➤➤'
				+'Product type Title@r@t=➤input➤i_product_type'
 				;

				var str_array = form_split(form).split('➤');
				var f_title=str_array[0];  var f_type=str_array[1];	var f_column=str_array[2];	var f_classes=str_array[3];  

				var table=
				'SL➤ ➤'
				+'Product type Title➤i_product_type#@[fs--1*➤'
 				+common_creator
 				+'Service Name➤'+newtable_table('services','')+'@[fs--1*➤'
 				+'Is Active#text-end➤_mark_1{is_active}#@[fs--1*➤'
 				+'Edit#text-end@fs--1➤_edit_able@[text-end';
				
				var str_array = table_split(table).split('➤');
				var th=str_array[0];  var td=str_array[1];	  
				
				var this_user_id_value=document.getElementById('this_user_id_value').innerHTML;
				
				var table_info='i_product_type#i_product_type_id#asc@i_product_type_id#'+this_user_id+'## where 1';	
				var table_functions='multiselect@button_delete,this_function@'+parent_function;  
				var table_request= search_bar();
				var f_functions='button_expand@Update@add_new_button@click,footer_insert@Insert';
				basic_fun(f_title,f_type,f_classes,f_column,th,td,table_info,table_request,table_functions,current_page,i_product_type_li_id,call_for,this_user_id,parent_function,name_sm,name_cap,table_name,f_functions); 
		} 
		
		
		 function return_cause(current_page,i_return_cause_li_id,call_for,this_user_id){
				var name_sm='return_cause';
				var name_cap='Return Cause';
				var table_name='i_return_cause';
				var parent_function=return_cause.name;
				
 	
				var form=
				'Return Cause Title@r@t=➤input➤i_return_cause'
 				;

				var str_array = form_split(form).split('➤');
				var f_title=str_array[0];  var f_type=str_array[1];	var f_column=str_array[2];	var f_classes=str_array[3];  

				var table=
				'SL➤ ➤'
				+'Return Cause Title➤i_return_cause#@[fs--1*➤'
 				+common_creator
 				+'Active#text-end➤_mark_1{is_active}#@[fs--1*➤'
 				+'Edit#text-end@fs--1➤_edit_able@[text-end';
				
				var str_array = table_split(table).split('➤');
				var th=str_array[0];  var td=str_array[1];	  
				
				var this_user_id_value=document.getElementById('this_user_id_value').innerHTML;
				
				var table_info='i_return_cause#i_return_cause_id#asc@i_return_cause_id#'+this_user_id+'## where 1';	
				var table_functions='multiselect@button_delete,this_function@'+parent_function;  
				var table_request= search_bar();
				var f_functions='button_expand@Update@add_new_button@click,footer_insert@Insert';
				basic_fun(f_title,f_type,f_classes,f_column,th,td,table_info,table_request,table_functions,current_page,i_return_cause_li_id,call_for,this_user_id,parent_function,name_sm,name_cap,table_name,f_functions); 
		}
			 function sms_template(current_page,i_sms_template_li_id,call_for,this_user_id){
				var name_sm='sms_template';
				var name_cap='Sms Template';
				var table_name='i_sms_template';
				var parent_function=sms_template.name;
				
 	
				var form=
				'Sms Template Title@r@t=➤input➤i_sms_template➤➤'
				+'Message@r@t=➤area➤message➤➤'
				+'Step@r@t=➤input➤step'
 				;

				var str_array = form_split(form).split('➤');
				var f_title=str_array[0];  var f_type=str_array[1];	var f_column=str_array[2];	var f_classes=str_array[3];  

				var table=
				'SL➤ ➤'
				+'Sms Template Title➤i_sms_template#@[fs--1*➤'
				+'Step➤step#@[fs--1*➤'
				+'Message➤message#@[fs--1*➤'
 				+common_creator
 				+'Active#text-end➤_mark_1{is_active}#@[fs--1*➤'
 				+'Edit#text-end@fs--1➤_edit_able@[text-end';
	
	
				var str_array = table_split(table).split('➤');
				var th=str_array[0];  var td=str_array[1];	  
				
				var this_user_id_value=document.getElementById('this_user_id_value').innerHTML;
				
				var table_info='i_sms_template#i_sms_template_id#asc@i_sms_template_id#'+this_user_id+'## where 1';	
				var table_functions='multiselect@button_delete,this_function@'+parent_function;  
				var table_request= search_bar();
				var f_functions='button_expand@Update@add_new_button@click,footer_insert@Insert';
				basic_fun(f_title,f_type,f_classes,f_column,th,td,table_info,table_request,table_functions,current_page,i_sms_template_li_id,call_for,this_user_id,parent_function,name_sm,name_cap,table_name,f_functions); 
		}	
		
		
			 function oc_country(current_page,i_oc_country_li_id,call_for,this_user_id){
				var name_sm='oc_country';
				var name_cap='Oc Country';
				var table_name='i_oc_country';
				var parent_function=oc_country.name;
				
 	
				var form=
				'Country Name@r@t=➤input➤i_oc_country➤➤'
				+'ISO Code 2@@t=➤input➤iso_code_2➤➤'
				+'ISO Code 3@@t=➤input➤iso_code_3➤➤'
				+'Address Formate@@t=➤input➤address_format➤➤'
				+'Zone@@t=➤input➤zone➤➤'
				+'TNT Zone@@t=➤input➤tnt_zone'
  				;

				var str_array = form_split(form).split('➤');
				var f_title=str_array[0];  var f_type=str_array[1];	var f_column=str_array[2];	var f_classes=str_array[3];  

				var table=
				'SL➤ ➤'
				+'Country Name➤i_oc_country#@[fs--1*➤'
				+'ISO Code 2➤iso_code_2#@[fs--1*➤'
				+'ISO Code 3➤iso_code_3#@[fs--1*➤'
 
 				+'Tnt Surcharge#text-end➤_mark_1{tnt_surcharge}#@[fs--1*➤'
 				+'Status#text-end➤_mark_1{is_active}#@[fs--1*➤'
 				+'Postcode required#text-end➤_mark_1{postcode_required}#@[fs--1*➤'
				+common_creator
 				+'Edit#text-end@fs--1➤_edit_able@[text-end';
				
				var str_array = table_split(table).split('➤');
				var th=str_array[0];  var td=str_array[1];	  
				
				var this_user_id_value=document.getElementById('this_user_id_value').innerHTML;
				
				var table_info='i_oc_country#i_oc_country_id#asc@i_oc_country_id#'+this_user_id+'## where 1';	
				var table_functions='multiselect@button_delete,this_function@'+parent_function;  
				var table_request= search_bar();
				var f_functions='button_expand@Update@add_new_button@click,footer_insert@Insert';
				basic_fun(f_title,f_type,f_classes,f_column,th,td,table_info,table_request,table_functions,current_page,i_oc_country_li_id,call_for,this_user_id,parent_function,name_sm,name_cap,table_name,f_functions); 
		}	


			 function countries(current_page,zone_countries_li_id,call_for,this_user_id){
				var name_sm='countries';
				var name_cap='Countries';
				var table_name='zone_countries';
				var parent_function=countries.name;
				
 	
				var form=
				'Country Name@r@t=➤input➤zone_countries➤➤'
				+'A2@@t=➤input➤A2➤➤'
				+'A3@@t=➤input➤A3➤➤'
				+'NUM@@t=➤input➤NUM'
  				;

				var str_array = form_split(form).split('➤');
				var f_title=str_array[0];  var f_type=str_array[1];	var f_column=str_array[2];	var f_classes=str_array[3];  

				var table=
				'SL➤ ➤'
				+'Country Name➤zone_countries#@[fs--1*➤'
				+'A2➤A2#@[fs--1*➤'
				+'A3➤A3#@[fs--1*➤'
				+'NUM➤NUM#@[fs--1*➤'
 				+common_creator
			    +'Active#text-end➤_mark_1{is_active}#@[fs--1*➤'
 				+'Edit#text-end@fs--1➤_edit_able@[text-end';
				
				var str_array = table_split(table).split('➤');
				var th=str_array[0];  var td=str_array[1];	  
				
				var this_user_id_value=document.getElementById('this_user_id_value').innerHTML;
				
				var table_info='zone_countries#zone_countries_id#asc@zone_countries_id#'+this_user_id+'## where 1';	
				var table_functions='multiselect@button_delete,this_function@'+parent_function;  
				var table_request= search_bar();
				var f_functions='button_expand@Update@add_new_button@click,footer_insert@Insert';
				basic_fun(f_title,f_type,f_classes,f_column,th,td,table_info,table_request,table_functions,current_page,zone_countries_li_id,call_for,this_user_id,parent_function,name_sm,name_cap,table_name,f_functions); 
		}	
			 function gateway(current_page,i_gateway_li_id,call_for,this_user_id){
				var name_sm='gateway';
				var name_cap='Gateway';
				var table_name='i_gateway';
				var parent_function=gateway.name;
				
 	
				var form=
				'Country Name@r@t=➤input➤i_gateway➤➤'
				+'Trackurl@@t=➤input➤trackurl'
  				;

				var str_array = form_split(form).split('➤');
				var f_title=str_array[0];  var f_type=str_array[1];	var f_column=str_array[2];	var f_classes=str_array[3];  

				var table=
				'SL➤ ➤'
				+'Country Name➤i_gateway#@[fs--1*➤'
				+'Track url➤trackurl#@[fs--1*➤'
 				+common_creator
			    +'Active#text-end➤_mark_1{is_active}#@[fs--1*➤'
 				+'Edit#text-end@fs--1➤_edit_able@[text-end';
				
				var str_array = table_split(table).split('➤');
				var th=str_array[0];  var td=str_array[1];	  
				
				var this_user_id_value=document.getElementById('this_user_id_value').innerHTML;
				
				var table_info='i_gateway#i_gateway_id#asc@i_gateway_id#'+this_user_id+'## where 1';	
				var table_functions='multiselect@button_delete,this_function@'+parent_function;  
				var table_request= search_bar();
				var f_functions='button_expand@Update@add_new_button@click,footer_insert@Insert';
				basic_fun(f_title,f_type,f_classes,f_column,th,td,table_info,table_request,table_functions,current_page,i_gateway_li_id,call_for,this_user_id,parent_function,name_sm,name_cap,table_name,f_functions); 
		}

			 function branch(current_page,branch_li_id,call_for,this_user_id){
				var name_sm='branch';
				var name_cap='Branch';
				var table_name='branch';
				var parent_function=branch.name;
				
 	
				var form=
				'Branch Name@r@t=➤input➤branch➤➤'
				+'Branch code@@t=➤input➤branch_code➤➤'
				+'Branch Group@r@t=➤'+newtableMulti('branch_group','1','')+'➤branch_group_id➤➤'
				+'Web@@t=➤input➤web➤➤'
				+'Address@@t=➤area➤address➤➤'
				+'location@@t=➤area➤location➤➤'
				+'phone@@t=➤input➤phone➤➤'
				+'fax@@t=➤input➤fax➤➤'
				+'Email@@t=➤input➤email➤➤'
				+'Office days@@t=➤area➤officedays➤➤'
				+'office start time@@t=➤area➤office_stime➤➤'
				+'office end time@@t=➤area➤office_etime➤➤'
				+'Cl@@t=➤input➤cl➤➤'
				+'Sl@@t=➤input➤sl'
   				;

				var str_array = form_split(form).split('➤');
				var f_title=str_array[0];  var f_type=str_array[1];	var f_column=str_array[2];	var f_classes=str_array[3];  

				var table=
				'SL➤ ➤'
				+'Branch Name➤branch#@[fs--1*➤'
				+'Branch Code➤branch_code#@[fs--1*➤'
				+'Branch Group➤'+newtable_table('branch_group','')+'@[fs--1*➤'  
				+'Web➤web#@[fs--1*➤'
				+'Address➤address#@[fs--1*➤'
				+'location➤location#@[fs--1*➤'
				+'Phone➤phone#@[fs--1*➤'
  				+'Status#text-end➤_mark_1{is_active}#@[fs--1*➤'
 				+common_creator
 				+'Edit#text-end@fs--1➤_edit_able@[text-end';
				
				var str_array = table_split(table).split('➤');
				var th=str_array[0];  var td=str_array[1];	  
				
				var this_user_id_value=document.getElementById('this_user_id_value').innerHTML;
				
				var table_info='branch#branch_id#desc@branch_id#'+this_user_id+'## where 1';	
				var table_functions='multiselect@button_delete,this_function@'+parent_function;  
				var table_request= search_bar();
				var f_functions='button_expand@Update@add_new_button@click,footer_insert@Insert';
				basic_fun(f_title,f_type,f_classes,f_column,th,td,table_info,table_request,table_functions,current_page,branch_li_id,call_for,this_user_id,parent_function,name_sm,name_cap,table_name,f_functions); 
		}
		
			 function branch_group(current_page,branch_group_li_id,call_for,this_user_id){
				var name_sm='branch_group';
				var name_cap='Branch Group';
				var table_name='branch_group';
				var parent_function=branch_group.name;
   
				var form=
				'Branch Group Name@r@t=➤input➤branch_group➤➤'
				+'Branch Group code@@t=➤input➤branch_group_code➤➤'
			    +'Responsible Persion---Name+Designation+Phone+Details@@t=➤input_mul+4➤responsible_persion➤responsible_persion'
   				;

				var str_array = form_split(form).split('➤');
				var f_title=str_array[0];  var f_type=str_array[1];	var f_column=str_array[2];	var f_classes=str_array[3];  

				var table= 
				'SL➤ ➤'
				+'Branch Group Name➤branch_group#@[fs--1*➤'
				+'Branch Group Code➤branch_group_code#@[fs--1*➤'
  				+'Status#text-end➤_mark_1{is_active}#@[fs--1*➤'
 				+common_creator
 				+'Edit#text-end@fs--1➤_edit_able@[text-end';
				
				var str_array = table_split(table).split('➤');
				var th=str_array[0];  var td=str_array[1];	  
				
				var this_user_id_value=document.getElementById('this_user_id_value').innerHTML;
				
				var table_info='branch_group#branch_group_id#desc@branch_group_id#'+this_user_id+'## where 1';	
				var table_functions='multiselect@button_delete,this_function@'+parent_function;  
				var table_request= search_bar();
				var f_functions='button_expand@Update@add_new_button@click,footer_insert@Insert@@@@'
				+'#branch=branch_group_id^branch_id^Concerning Branch:branch|Branch Name-branch_code|Branch Code-address|Address-location|Location'
				;
				basic_fun(f_title,f_type,f_classes,f_column,th,td,table_info,table_request,table_functions,current_page,branch_group_li_id,call_for,this_user_id,parent_function,name_sm,name_cap,table_name,f_functions); 
		}		
		
		
		
			 function zone_divisions(current_page,zone_divisions_lid,call_for,this_user_id){
				var name_sm='zone_divisions';
				var name_cap='Zone divisions';
				var table_name='zone_divisions';
				var parent_function=zone_divisions.name;
				
 	
				var form=
				'Divisions Name (EN)@r@t=➤input➤zone_divisions➤➤'
				+'Divisions Name (BN)@@t=➤input➤zone_divisions_bn'
    			;

				var str_array = form_split(form).split('➤');
				var f_title=str_array[0];  var f_type=str_array[1];	var f_column=str_array[2];	var f_classes=str_array[3];  

				var table=
				'SL➤ ➤'
				+'Divisions Name (EN)➤zone_divisions#@[fs--1*➤'
				+'Divisions Name (BN)➤zone_divisions_bn#@[fs--1*➤'
  				+'Active#text-end➤_mark_1{is_active}#@[fs--1*➤'
 				+common_creator
 				+'Edit#text-end@fs--1➤_edit_able@[text-end';
				
				var str_array = table_split(table).split('➤');
				var th=str_array[0];  var td=str_array[1];	  
				
				var this_user_id_value=document.getElementById('this_user_id_value').innerHTML;
				
				var table_info='zone_divisions#zone_divisions_id#desc@zone_divisions_id#'+this_user_id+'## where 1';	
				var table_functions='multiselect@button_delete,this_function@'+parent_function;  
				var table_request= search_bar();
				var f_functions='button_expand@Update@add_new_button@click,footer_insert@Insert';
				basic_fun(f_title,f_type,f_classes,f_column,th,td,table_info,table_request,table_functions,current_page,zone_divisions_lid,call_for,this_user_id,parent_function,name_sm,name_cap,table_name,f_functions); 
		}			
		
		 function zone_districts(current_page,zone_districts_lid,call_for,this_user_id){
				var name_sm='zone_districts';
				var name_cap='Zone districts';
				var table_name='zone_districts';
				var parent_function=zone_districts.name;
				
 	
				var form=
				'Districts Name (EN)@r@t=➤input➤zone_districts➤➤'
				+'Districts Name (BN)@@t=➤input➤zone_districts_bn➤➤'
			    +'Select Division@r@t=➤select@newTable~select * from zone_divisions where 1    order by zone_divisions_id ASC➤zone_divisions_id➤ ➤'

				+'lat@@t=➤input➤lat➤➤'
				+'lon@@t=➤input➤lon➤➤'
				+'website@r@t=➤input➤website'
    			;

				var str_array = form_split(form).split('➤');
				var f_title=str_array[0];  var f_type=str_array[1];	var f_column=str_array[2];	var f_classes=str_array[3];  

				var table=
				'SL➤ ➤'
				+'Districts Name (EN)➤zone_districts#@[fs--1*➤'
				+'Districts Name (BN)➤zone_districts_bn#@[fs--1*➤'
		        +'Division➤zone_divisions_id#{zone_divisions_id}[zone_divisions]&select * from zone_divisions where zone_divisions_id**@[fs--1*➤'
				+'lat ➤lat#@[fs--1*➤'
				+'lon ➤lon#@[fs--1*➤'
				+'Website➤website#@[fs--1*➤'
  				+'Active#text-end➤_mark_1{is_active}#@[fs--1*➤'
 				+common_creator
 				+'Edit#text-end@fs--1➤_edit_able@[text-end';
				
				var str_array = table_split(table).split('➤');
				var th=str_array[0];  var td=str_array[1];	  
				
				var this_user_id_value=document.getElementById('this_user_id_value').innerHTML;
				
				var table_info='zone_districts#zone_districts_id#desc@zone_districts_id#'+this_user_id+'## where 1';	
				var table_functions='multiselect@button_delete,this_function@'+parent_function;  
				var table_request= search_bar();
				var f_functions='button_expand@Update@add_new_button@click,footer_insert@Insert';
				basic_fun(f_title,f_type,f_classes,f_column,th,td,table_info,table_request,table_functions,current_page,zone_districts_lid,call_for,this_user_id,parent_function,name_sm,name_cap,table_name,f_functions); 
		}	

		 function zone_upazilas(current_page,zone_upazilas_lid,call_for,this_user_id){
				var name_sm='zone_upazilas';
				var name_cap='Zone upazilas';
				var table_name='zone_upazilas';
				var parent_function=zone_upazilas.name;
				
 	
				var form=
				'Upazilas Name (EN)@r@t=➤input➤zone_upazilas➤➤'
				+'Upazilas Name (BN)@@t=➤input➤zone_upazilas_bn➤➤'
			    +'Select District@r@t=➤select@newTable~select * from zone_districts where 1    order by zone_districts_id ASC➤zone_districts_id'

     			;

				var str_array = form_split(form).split('➤');
				var f_title=str_array[0];  var f_type=str_array[1];	var f_column=str_array[2];	var f_classes=str_array[3];  

				var table=
				'SL➤ ➤'
				+'Upazilas Name (EN)➤zone_upazilas#@[fs--1*➤'
				+'Upazilas Name (BN)➤zone_upazilas_bn#@[fs--1*➤'
		        +'District➤zone_districts_id#{zone_districts_id}[zone_districts]&select * from zone_districts where zone_districts_id**@[fs--1*➤'
 
  				+'Active#text-end➤_mark_1{is_active}#@[fs--1*➤'
 				+common_creator
 				+'Edit#text-end@fs--1➤_edit_able@[text-end';
				
				var str_array = table_split(table).split('➤');
				var th=str_array[0];  var td=str_array[1];	  
				
				var this_user_id_value=document.getElementById('this_user_id_value').innerHTML;
				
				var table_info='zone_upazilas#zone_upazilas_id#desc@zone_upazilas_id#'+this_user_id+'## where 1';	
				var table_functions='multiselect@button_delete,this_function@'+parent_function;  
				var table_request= search_bar();
				var f_functions='button_expand@Update@add_new_button@click,footer_insert@Insert';
				basic_fun(f_title,f_type,f_classes,f_column,th,td,table_info,table_request,table_functions,current_page,zone_upazilas_lid,call_for,this_user_id,parent_function,name_sm,name_cap,table_name,f_functions); 
		}
		
		
//Services & Clients
		 function services(current_page,services_lid,call_for,this_user_id){
				var name_sm='services';
				var name_cap='Services';
				var table_name='services';
				var parent_function=services.name;
				
 	
				var form=
				'Services Name@r@t=➤input➤services'
 
     			;

				var str_array = form_split(form).split('➤');
				var f_title=str_array[0];  var f_type=str_array[1];	var f_column=str_array[2];	var f_classes=str_array[3];  

				var table=
				'SL➤ ➤'
				+'Services Name➤services#@[fs--1*➤'
  
  				+'Active#text-end➤_mark_1{is_active}#@[fs--1*➤'
 				+common_creator
 				+'Edit#text-end@fs--1➤_edit_able@[text-end';
				
				var str_array = table_split(table).split('➤');
				var th=str_array[0];  var td=str_array[1];	  
				
				var this_user_id_value=document.getElementById('this_user_id_value').innerHTML;
				
				var table_info='services#services_id#asc@services_id#'+this_user_id+'## where 1';	
				var table_functions='multiselect@button_delete,this_function@'+parent_function;  
				var table_request= search_bar();
				var f_functions='button_expand@Update@add_new_button@click,footer_insert@Insert';
				basic_fun(f_title,f_type,f_classes,f_column,th,td,table_info,table_request,table_functions,current_page,services_lid,call_for,this_user_id,parent_function,name_sm,name_cap,table_name,f_functions); 
		}		
 
		
		 function services_clients_type(current_page,services_clients_type_lid,call_for,this_user_id){
				var name_sm='services_clients_type';
				var name_cap='Client Types';
				var table_name='services_clients_type';
				var parent_function=services_clients_type.name;
				
 	
				var form=
				'Client Type Name@r@t=➤input➤services_clients_type'
 				;

				var str_array = form_split(form).split('➤');
				var f_title=str_array[0];  var f_type=str_array[1];	var f_column=str_array[2];	var f_classes=str_array[3];  

				var table=
				'SL➤ ➤'
				+'Client Type Name➤services_clients_type#@[fs--1*➤'
 				+common_creator
 				+'Active#text-end➤_mark_1{is_active}#@[fs--1*➤'
 				+'Edit#text-end@fs--1➤_edit_able@[text-end';
				
				var str_array = table_split(table).split('➤');
				var th=str_array[0];  var td=str_array[1];	  
				
				var this_user_id_value=document.getElementById('this_user_id_value').innerHTML;
				
				var table_info='services_clients_type#services_clients_type_id#asc@services_clients_type_id#'+this_user_id+'## where 1';	
				var table_functions='multiselect@button_delete,this_function@'+parent_function;  
				var table_request= search_bar();
				var f_functions='button_expand@Update@add_new_button@click,footer_insert@Insert';
				basic_fun(f_title,f_type,f_classes,f_column,th,td,table_info,table_request,table_functions,current_page,services_clients_type_lid,call_for,this_user_id,parent_function,name_sm,name_cap,table_name,f_functions); 
		}		
 		 function services_clients	(current_page,services_clients_lid,call_for,this_user_id){
				var name_cap='All Clients';
				var table_name=name_sm='services_clients';
				var parent_function=services_clients.name;
				
 	
				var form=
				 '<sectionequalClients Basic Information & Services>Clients Name<sectionequalClients Basic Information & Services>@r@t=➤input➤services_clients➤➤'
				+'Clientsid@r@t=➤input➤clientsid	➤➤' 
 
				+'Client type @r@t=➤'+newtable('services_clients_type','1','')+'➤services_clients_type_id	➤➤'
				+'<sectionequalServices Configaration>Select Services<sectionequalServices Configaration> @r@t=➤'+newtableMulti('services','1','')+'➤services_id ➤➤'
				+'Select Providers @r@t=➤'+newtableMulti('services_provider','1','')+'➤services_provider_id ➤➤'
				+'Select SMS Template @@t=➤'+newtableMulti('i_sms_template','1','')+'➤i_sms_template_id ➤➤'
				+'Select SMS Products @@t=➤'+newtableMulti('i_product_type','1','')+'➤i_product_type_id ➤➤'
				+'Select Cost Packages @@t=➤'+newtableMulti('services_packages','1','')+'➤services_packages_id ➤➤'
				+'Discount Percent@@n=➤input➤discount_percent	➤➤'
				
				+'<sectionequalContact Information>Phone<sectionequalContact Information><sub>01.......<sub>@r@t=➤input➤phone	➤➤'
				+'Email<sub><sub>@@e=➤input➤email	➤➤'
				+'Branch Manage---Branch Name+Branch Address+Branch Phone+Contact Name+Contact Role+Contact Details@@t=➤input_mul+6➤branch➤branch'
     			;

				var str_array = form_split(form).split('➤');
				var f_title=str_array[0];  var f_type=str_array[1];	var f_column=str_array[2];	var f_classes=str_array[3];  
 
				var table= 
				'SL➤ ➤'
				+'Clients Name➤services_clients#@[fs--1*➤'
				+'Clients Type➤'+newtable_table('services_clients_type','')+'@[fs--1*➤'
				+'Active Services➤'+newtable_table('services','')+'@[fs--1*➤'
				+'Cost Packages➤'+newtable_table('services_packages','')+'@[fs--1*➤'
				+'Discount %➤discount_percent#@[fs--1*➤'
				+'Service Providers➤'+newtable_table('services_provider','')+'@[fs--1*➤'
				+'Clientsid➤clientsid#@[fs--1*➤'
				+'Address➤address#@[fs--1*➤'
  				+'Active#text-end➤_mark_1{is_active}#@[fs--1*➤'
 				+common_creator
 				+'Edit#text-end@fs--1➤_edit_able@[text-end';
				
				var str_array = table_split(table).split('➤');
				var th=str_array[0];  var td=str_array[1];	  
				
				var this_user_id_value=document.getElementById('this_user_id_value').innerHTML;
				
				var table_info='services_clients#services_clients_id#desc@services_clients_id#'+this_user_id+'## where 1';	
				var table_functions='multiselect@button_delete,this_function@'+parent_function;  
				var table_request= search_bar('services_clients_type services_clients_type','2');
				var f_functions='button_expand@Update@add_new_button@click,footer_insert@Insert';
				basic_fun(f_title,f_type,f_classes,f_column,th,td,table_info,table_request,table_functions,current_page,services_clients_lid,call_for,this_user_id,parent_function,name_sm,name_cap,table_name,f_functions); 
		}		
		
 
		
function services_packages	(current_page,services_packages_lid,call_for,this_user_id){
				var name_sm='services_packages';
				var name_cap='Services Packages';
				var table_name='services_packages';
				var parent_function=services_packages.name;
				
 	
				var form=
				'Packages Name@r@t=➤input➤services_packages➤➤'
  				+'Activate Date@@t=➤input➤activate_date➤datetimepicker➤'
 				+'Expired Date@@t=➤input➤expired_date➤datetimepicker'
     			;

				var str_array = form_split(form).split('➤');
				var f_title=str_array[0];  var f_type=str_array[1];	var f_column=str_array[2];	var f_classes=str_array[3];  

				var table= 
				'SL➤ ➤'
		        +'Packages Name➤services_packages#@[fs--1*➤'
				+'Activate Date➤activate_date#@[fs--1*➤'
				+'Expired Date➤expired_date#@[fs--1*➤'	
   				+'Active#text-end➤_mark_1{is_active}#@[fs--1*➤'
 				+common_creator
 				+'Edit#text-end@fs--1➤_edit_able@[text-end';
				
				var str_array = table_split(table).split('➤');
				var th=str_array[0];  var td=str_array[1];	  
				
				var this_user_id_value=document.getElementById('this_user_id_value').innerHTML;
				
				var table_info='services_packages#services_packages_id#desc@services_packages_id#'+this_user_id+'## where 1';	
				var table_functions='multiselect@button_delete,this_function@'+parent_function;  
				var table_request= search_bar();
				var f_functions='button_expand@Update@add_new_button@click,footer_insert@Insert';
				basic_fun(f_title,f_type,f_classes,f_column,th,td,table_info,table_request,table_functions,current_page,services_packages_lid,call_for,this_user_id,parent_function,name_sm,name_cap,table_name,f_functions); 
		}		
		
		
		
		function services_packages_cost_config	(current_page,services_packages_cost_config_lid,call_for,this_user_id){
				var name_sm='services_packages_cost_config';
				var name_cap='Packages Cost Config';
				var table_name='services_packages_cost_config';
				var parent_function=services_packages_cost_config.name;
				
 	
				var form=
 				'Select Packages@r@t=➤'+newtableMulti('services_packages','1','')+'➤services_packages_id	➤➤'
				+'Select Services@r@t=➤'+newtableMulti('services','1','')+'➤services_id➤➤'
				+'Select Zone@r@t=➤'+newtableMulti('zone','1','')+'➤zone_id➤➤'
 				+'Select Shipment Method@r@t=➤'+newtableMulti('i_shipment_method','1','')+'➤i_shipment_method_id➤➤' 				
				+'Select Priority@r@t=➤'+newtableMulti('i_priority','1','')+'➤i_priority_id➤➤'
				+'First Kg Price@r@n=➤input➤first_kg	➤➤' 
				+'Additional Per Kg Price@r@n=➤input➤additional_kg	➤➤' 
				+'COD Cost %@r@n=➤input➤cod_cost➤➤' 
				+'Return Cost@r@n=➤input➤return_cost➤➤' 
				+'Fixed Cost Qty@r@n=➤input➤fixed_cost' 
     			;

				var str_array = form_split(form).split('➤');
				var f_title=str_array[0];  var f_type=str_array[1];	var f_column=str_array[2];	var f_classes=str_array[3];  

				var table= 
				'SL➤ ➤'
				+'Packages➤'+newtable_table('services_packages','')+'@[fs--1*➤'  
				+'Services➤'+newtable_table('services','')+'@[fs--1*➤'  
				+'Zone➤'+newtable_table('zone','')+'@[fs--1*➤'  
				+'Shipment Method➤'+newtable_table('i_shipment_method','')+'@[fs--1*➤'
				+'Product Priority➤'+newtable_table('i_priority','')+'@[fs--1*➤'
		        +'First Kg Price➤first_kg#@[fs--1*➤'
		        +'Additional Per Kg ➤additional_kg#@[fs--1*➤'
		        +'COD Cost %➤cod_cost#@[fs--1*➤'
		        +'Return Cost ➤return_cost#@[fs--1*➤'
		        +'Fixed Cost Qty ➤fixed_cost#@[fs--1*➤'
  				+'Active#text-end➤_mark_1{is_active}#@[fs--1*➤'
 				+common_creator
 				+'Edit#text-end@fs--1➤_edit_able@[text-end';
				
				var str_array = table_split(table).split('➤');
				var th=str_array[0];  var td=str_array[1];	  
				
				var this_user_id_value=document.getElementById('this_user_id_value').innerHTML;
				
				var table_info='services_packages_cost_config#services_packages_cost_config_id#desc@services_packages_cost_config_id#'+this_user_id+'## where 1';	
				var table_functions='multiselect@button_delete,this_function@'+parent_function;  
				var table_request= search_bar();
				var f_functions='button_expand@Update@add_new_button@click,footer_insert@Insert';
				basic_fun(f_title,f_type,f_classes,f_column,th,td,table_info,table_request,table_functions,current_page,services_packages_cost_config_lid,call_for,this_user_id,parent_function,name_sm,name_cap,table_name,f_functions); 
		}	
 
 
		
		
 
	</script>
	
	
