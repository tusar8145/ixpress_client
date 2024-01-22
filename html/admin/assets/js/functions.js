 //Table

function deleteRow(rowid)  
{  
	$('#'+rowid).children(':first').trigger('click');
    var row = document.getElementById(rowid);
    row.parentNode.removeChild(row);
}





//Alert
function reset_alert(){
	document.getElementById("alert").innerHTML='';	
	document.getElementById("center_loader").innerHTML='';
} 





function lottie_loading_start(url){
	if(url!=''){
		url="https://assets10.lottiefiles.com/packages/lf20_2plouhmo.json";		
		}else {
		//url="https://assets3.lottiefiles.com/packages/lf20_njklfbjr.json";		
		url="https://assets10.lottiefiles.com/packages/lf20_2plouhmo.json";		
		}	
		document.getElementById("loader_place").innerHTML=' <lottie-player src="'+url+'" background="transparent"  speed="1"  style="  width: 100%; height: 150px;" loop   autoplay></lottie-player>';	
	}

	



function lottie_loading_stop(){
	document.getElementById("loader_place").innerHTML=' ';
}





function loading_start(gif){
	document.getElementById("center_loader").innerHTML='  <img src="assets/custom/'+gif+'"  id="center_loader" alt="Girl in a jacket" style="    width: 58px; z-index: 9999; border-radius: 50%; margin-top: 7px; margin-left: 10px; position: fixed; left: 50%; top: 50%; box-shadow: 5px 10px 18px #888888;">';	
}

function loading_stop(){
	document.getElementById("center_loader").innerHTML=' ';
}



function success_alert(say){  
 	//var sw=document.getElementById("alert_place").clientWidth;
	/// document.getElementById("alert").innerHTML='<div  class="alert_height alert alert-success border-2 d-flex  align-items-center alert"   role="alert" style="width:'+sw+'px; box-shadow: 5px 10px 18px #888888;   "> <div class="bg-success me-3 icon-item"><svg class="svg-inline--fa fa-check-circle fa-w-16 text-white fs-3" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"></path></svg></div><p class="mb-0 flex-1 fs-1" id="alert1_say">'+say+'</p><button class="btn-close fs-1" id="close_alert" type="button" data-bs-dismiss="alert" aria-label="Close"></button></div>'; 

	const myArr = say.split("@");
	var say = myArr[0];
	var noti = myArr[1];	
	if(typeof noti === "undefined") {
   noti='';
}
						 var pops='<div class="toast animated   notice shadow-none bg-transparent" id="cookie-notice" role="alert" data-options=\'{"autoShow":true,"autoShowDelay":3000,"showOnce":true,"cookieExpireTime":7200000}\' data-autohide="false" aria-live="assertive" aria-atomic="true" style="max-width:23rem;z-index: 10500; opacity: 1;">'
						+'<div class="toast-body my-3 ms-0 ms-md-5">'
						+'<div class="card"> <div class="card-body"> <div class="d-flex">'
						+'<div class="pe-3"><div class="bg-success me-3 icon-item"><svg class="svg-inline--fa fa-check-circle fa-w-16 text-white fs-3" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"></path></svg> </div> </div> <div><p style=" font-size: 13px;color: #2c7be5;font-weight: bold;font-size: 14px; margin-bottom: 5;">'+say+'</p>'
						+'<p style=" margin-bottom: 5;">'+noti+'</p><button class="btn btn-sm btn-falcon-primary me-3" onclick="close_pops()" type="button" data-bs-dismiss="toast" aria-label="Close">Okay</button></div></div></div></div> </div></div>';
						$("#pops").fadeIn("slow").html(pops);
						
						
						$('#cookie-notice').css({ 'bottom': '', 'bottom': '0px' }).animate({ 'bottom' : '30px'}); 
						 setTimeout(function() { close_pops(); }, 10000); 	
	
	// //setTimeout(function() { reset_alert(); }, 3000);
}

 

function fail_alert(say){
	const myArr = say.split("@");
	var say = myArr[0];
	var noti = myArr[1];
	if(typeof noti === "undefined") {
   noti='';
}
						 var pops='<div class="toast animated   notice shadow-none bg-transparent" id="cookie-notice" role="alert" data-options=\'{"autoShow":true,"autoShowDelay":3000,"showOnce":true,"cookieExpireTime":7200000}\' data-autohide="false" aria-live="assertive" aria-atomic="true" style="max-width:23rem;z-index: 10500; opacity: 1;">'
						+'<div class="toast-body my-3 ms-0 ms-md-5">'
						+'<div class="card"> <div class="card-body"> <div class="d-flex">'
						+'<div class="pe-3"><div class="bg-danger me-3 icon-item"><svg class="svg-inline--fa fa-times-circle fa-w-16 text-white fs-3" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm121.6 313.1c4.7 4.7 4.7 12.3 0 17L338 377.6c-4.7 4.7-12.3 4.7-17 0L256 312l-65.1 65.6c-4.7 4.7-12.3 4.7-17 0L134.4 338c-4.7-4.7-4.7-12.3 0-17l65.6-65-65.6-65.1c-4.7-4.7-4.7-12.3 0-17l39.6-39.6c4.7-4.7 12.3-4.7 17 0l65 65.7 65.1-65.6c4.7-4.7 12.3-4.7 17 0l39.6 39.6c4.7 4.7 4.7 12.3 0 17L312 256l65.6 65.1z"></path></svg><!-- <span class="fas fa-times-circle text-white fs-3"></span> Font Awesome fontawesome.com --></div> </div> <div><p style=" font-size: 13px;color: #dc2f2f !important;font-weight: bold;font-size: 14px;  margin-bottom: 5;">'+say+'</p>'
						+'<p style=" margin-bottom: 5;">'+noti+'</p><button class="btn btn-sm btn-falcon-primary me-3" onclick="close_pops()" type="button" data-bs-dismiss="toast" aria-label="Close">Okay</button></div></div></div></div> </div></div>';
						$("#pops").fadeIn("slow").html(pops);
						$('#cookie-notice').css({ 'bottom': '', 'bottom': '0px' }).animate({ 'bottom' : '30px'});
						 setTimeout(function() { close_pops(); }, 10000); 	
	
	
	//var sw=document.getElementById("alert_place").clientWidth;
	//document.getElementById("alert").innerHTML='<div class="alert_height alert alert-danger border-2 d-flex  align-items-center alert"   role="alert" style="width:'+sw+'px; box-shadow: 5px 10px 18px #888888;   "> <div class="bg-danger me-3 icon-item"><svg class="svg-inline--fa fa-times-circle fa-w-16 text-white fs-3" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm121.6 313.1c4.7 4.7 4.7 12.3 0 17L338 377.6c-4.7 4.7-12.3 4.7-17 0L256 312l-65.1 65.6c-4.7 4.7-12.3 4.7-17 0L134.4 338c-4.7-4.7-4.7-12.3 0-17l65.6-65-65.6-65.1c-4.7-4.7-4.7-12.3 0-17l39.6-39.6c4.7-4.7 12.3-4.7 17 0l65 65.7 65.1-65.6c4.7-4.7 12.3-4.7 17 0l39.6 39.6c4.7 4.7 4.7 12.3 0 17L312 256l65.6 65.1z"></path></svg></div><p class="mb-0 flex-1 fs-1" id="alert1_say">'+say+'</p><button class="btn-close fs-1" id="close_alert" type="button" data-bs-dismiss="alert" aria-label="Close"></button></div>'; 
	//setTimeout(function() { reset_alert(); }, 3000);
}



function get_width(wideOf){
	  var her=document.getElementsByClassName(wideOf)[0].clientWidth; 
	  return her;
}





			const profile_element ='<div class="card mb-3">'
            +'<div class="card-header position-relative min-vh-25 mb-7">'
              +'<div class="bg-holder rounded-3 rounded-bottom-0" style="background-image:url(assets/img/generic/4.jpg);"></div>'
              +'<div class="avatar avatar-5xl avatar-profile"><img class="rounded-circle img-thumbnail shadow-sm"  id="{{image}}"  width="200"  ></div>'
            +'</div>'
            +'<div class="card-body">'
              +'<div class="row">'
                +'<div class="col-lg-8">'
                  +'<h4 class="mb-1"><x id="{{userName}}"><div class="loader"></div> </x><span data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Verified" aria-label="Verified"><svg id="profile_check" class="d-none svg-inline--fa fa-check-circle fa-w-16 text-primary" data-fa-transform="shrink-4 down-2" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="check-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="" style="transform-origin: 0.5em 0.625em;"><g transform="translate(256 256)"><g transform="translate(0, 64)  scale(0.75, 0.75)  rotate(0 0 0)"><path fill="currentColor" d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z" transform="translate(-256 -256)"></path></g></g></svg><!-- <small class="fa fa-check-circle text-primary" data-fa-transform="shrink-4 down-2"></small> Font Awesome fontawesome.com --></span></h4>'
                  +'<h5 class="fs-0 fw-normal"><x id="{{a1}}"><div class="loader"></div> </x> <x id="{{a2}}"><div class="loader"></div> </x></h5>'
                  +'<p class="text-500"><x id="{{userType}}"> </x></p><button  data-bs-toggle="collapse" href="#collapseExampleadd_new_button" role="button" aria-expanded="false" aria-controls="collapseExampleadd_new_button" class="btn btn-falcon-primary btn-sm px-3" type="button">Edit Profile</button><button class="btn btn-falcon-default btn-sm px-3 ms-2 collapsed" type="button"             id="add_new_button2" data-bs-toggle="collapse" href="#collapseExampleadd_new_button2" role="button" aria-expanded="false" aria-controls="collapseExampleadd_new_button2"                 >Change Password</button>'
                 +' <div class="border-dashed-bottom my-4 d-lg-none"></div>'
                +'</div>'
              +'</div>'
            +'</div>'
        +'</div>';

		



function close_pops(){
  $( "#cookie-notice" ).fadeOut( "slow", function() {
    // Animation complete.
  });	
}


function layout_content(name){

	if(name=='basic'){
			var layout_element = '<div id="profile_place"></div>' 
			+'<div id="form_place2"></div>'	  
			 +'<div id="form_place"></div>'
			 +'<div id="modal_place"></div>'
			 +'<div id="pops"></div>'
			 +'<div id="table_place2"></div>'
			 +'<div style="margin-top: 5px;" id="table_place"></div>';
	}
	document.getElementById("layout_content").innerHTML=layout_element;
}





