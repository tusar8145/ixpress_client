 
		
		
<footer>
            <div class="row g-0 justify-content-between fs--1 mt-4 mb-3" style="
    1position: fixed;
    1bottom: 0;
    1z-index: -1;
">
				<div class="col-12 col-sm-auto text-center">
                <p class="mb-0 text-600">Copyright   <span class="d-none d-sm-inline-block">| </span><br class="d-sm-none" /> 2022 &copy; <a href="<?php echo  $full_domain_path; ?>">All Rights Reserved.  v.1.0</a></p>
              </div>
              <div class="col-12 col-sm-auto text-center">
                <p class="mb-0 text-600">v1.0.0</p>
              </div>
            </div>
          </footer>
 </div><!-- End contant-->
        <div class="modal fade" id="authentication-modal" tabindex="-1" role="dialog" aria-labelledby="authentication-modal-label" aria-hidden="true">
          <div class="modal-dialog mt-6" role="document">
            <div class="modal-content border-0">
              <div class="modal-header px-5 position-relative modal-shape-header bg-shape">
                <div class="position-relative z-index-1 light">
                  <h4 class="mb-0 text-white" id="authentication-modal-label">Register</h4>
                  <p class="fs--1 mb-0 text-white">Please create your free Falcon account</p>
                </div><button class="btn-close btn-close-white position-absolute top-0 end-0 mt-2 me-2" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body py-4 px-5">
                <form>
                  <div class="mb-3"><label class="form-label" for="modal-auth-name">Name</label><input class="form-control" type="text" id="modal-auth-name" /></div>
                  <div class="mb-3"><label class="form-label" for="modal-auth-email">Email address</label><input class="form-control" type="email" id="modal-auth-email" /></div>
                  <div class="row gx-2">
                    <div class="mb-3 col-sm-6"><label class="form-label" for="modal-auth-password">Password</label><input class="form-control" type="password" id="modal-auth-password" /></div>
                    <div class="mb-3 col-sm-6"><label class="form-label" for="modal-auth-confirm-password">Confirm Password</label><input class="form-control" type="password" id="modal-auth-confirm-password" /></div>
                  </div>
                  <div class="form-check"><input class="form-check-input" type="checkbox" id="modal-auth-register-checkbox" /><label class="form-label" for="modal-auth-register-checkbox">I accept the <a href="#!">terms </a>and <a href="#!">privacy policy</a></label></div>
                  <div class="mb-3"><button class="btn btn-primary d-block w-100 mt-3" type="submit" name="submit">Register</button></div>
                </form>
                <div class="position-relative mt-5">
                  <hr class="bg-300" />
                  <div class="divider-content-center">or register with</div>
                </div>
                <div class="row g-2 mt-2">
                  <div class="col-sm-6"><a class="btn btn-outline-google-plus btn-sm d-block w-100" href="#"><span class="fab fa-google-plus-g me-2" data-fa-transform="grow-8"></span> google</a></div>
                  <div class="col-sm-6"><a class="btn btn-outline-facebook btn-sm d-block w-100" href="#"><span class="fab fa-facebook-square me-2" data-fa-transform="grow-8"></span> facebook</a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main><!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->

    <div class="modal fade modal-fixed-right modal-theme overflow-hidden" id="settings-modal" tabindex="-1" role="dialog" aria-labelledby="settings-modal-label" aria-hidden="true">
      <div class="modal-dialog modal-dialog-vertical" role="document">
        <div class="modal-content border-0 vh-100 scrollbar-overlay">
          <div class="modal-header modal-header-settings bg-shape">
            <div class="z-index-1 py-1 light">
              <h5 class="text-white" id="settings-modal-label"> <span class="fas fa-palette me-2 fs-0"></span>Settings</h5>
              <p class="mb-0 fs--1 text-white opacity-75"> Set your own customized style</p>
            </div><button class="btn-close btn-close-white z-index-1 mt-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body px-card" id="themeController">
		  
             <h5 class="fs-0">Custom Link</h5>
            <p class="fs--1 d-none">Choose the perfect color mode for your app. </p>
            <div class="btn-group d-block w-100 btn-group-navbar-style">
              <div class="row gx-2">
			  
			  <?php
			 		    $query="select * from settings_tools WHERE is_key='1'";
						$result=mysqli_query($connect,$query); $rowcount=mysqli_num_rows($result); $row = mysqli_fetch_all($result,MYSQLI_ASSOC);
						for($i=$rowcount-1;$i>=0;$i--)
						{  
						//	$id=$row[$i]['id'];		
							echo '
				<div class="col-4" title="'.$row[$i]['details'].'">   <a target="_blank" href="'.$row[$i]['link'].'">
					   <label class="btn d-inline-block btn-navbar-style fs--1" for=" "> 
							<span class="hover-overlay mb-2 rounded d-block">
								<img class="img-fluid img-prototype mb-0" src="'.$full_domain_path.'/ecl/uploads/tools/'.$row[$i]['logo'].'" alt=""/>
						   </span>
						   <span class="label-text">'.$row[$i]['settings_tools'].'</span>
						</label>
					</a>  </div>';
						}  
			  
			  ?>
			  
			  

					 
               </div>
            </div>
            <hr />
 
 
 
 
  <!--		  
 <div class="btn-group" role="group" aria-label="Basic example" style="margin-bottom:10px">
<button  onclick="sticky_tiny('add')" class="btn btn-secondary" type="button">Sticky  Editor</button>
  <button  onclick="sticky_tiny('remove')" class="btn btn-secondary" type="button">Remove Sticky </button>
</div>-->

             <h5 class="fs-0">Color Scheme</h5>
            <p class="fs--1">Choose the perfect color mode for your app. </p>
            <div class="btn-group d-block w-100 btn-group-navbar-style">
              <div class="row gx-2">
                <div class="col-6"><input class="btn-check" id="themeSwitcherLight" name="theme-color" type="radio" value="light" data-theme-control="theme" /><label class="btn d-inline-block btn-navbar-style fs--1" for="themeSwitcherLight"> <span class="hover-overlay mb-2 rounded d-block"><img class="img-fluid img-prototype mb-0" src="<?php echo $base_u; ?>assets/img/generic/falcon-mode-default.jpg" alt=""/></span><span class="label-text">Light</span></label></div>
                <div class="col-6"><input class="btn-check" id="themeSwitcherDark" name="theme-color" type="radio" value="dark" data-theme-control="theme" /><label class="btn d-inline-block btn-navbar-style fs--1" for="themeSwitcherDark"> <span class="hover-overlay mb-2 rounded d-block"><img class="img-fluid img-prototype mb-0" src="<?php echo $base_u; ?>assets/img/generic/falcon-mode-dark.jpg" alt=""/></span><span class="label-text"> Dark</span></label></div>
              </div>
            </div>
            <hr />
            <div class="d-flex justify-content-between">
              <div class="d-flex align-items-start"><img class="me-2" src="<?php echo $base_u; ?>assets/img/icons/left-arrow-from-left.svg" width="20" alt="" />
                <div class="flex-1">
                  <h5 class="fs-0">RTL Mode</h5>
                  <p class="fs--1 mb-0">Switch your language direction </p>
                </div>
              </div>
              <div class="form-check form-switch"><input class="form-check-input ms-0" id="mode-rtl" type="checkbox" data-theme-control="isRTL" /></div>
            </div>
            <hr />
            <div class="d-flex justify-content-between">
              <div class="d-flex align-items-start"><img class="me-2" src="<?php echo $base_u; ?>assets/img/icons/arrows-h.svg" width="20" alt="" />
                <div class="flex-1">
                  <h5 class="fs-0">Fluid Layout</h5>
                  <p class="fs--1 mb-0">Toggle container layout system </p>
                </div>
              </div>
              <div class="form-check form-switch"><input class="form-check-input ms-0" id="mode-fluid" type="checkbox" data-theme-control="isFluid" /></div>
            </div>
            <hr />
            <!--<div class="d-flex align-items-start"><img class="me-2" src="<?php echo $base_u; ?>assets/img/icons/paragraph.svg" width="20" alt="" />
              <div class="flex-1">
                <h5 class="fs-0 d-flex align-items-center">Navigation Position </h5>
                <p class="fs--1 mb-2">Select a suitable navigation system for your web application </p>
                <div>
                  <div class="form-check form-check-inline"><input class="form-check-input" id="option-navbar-vertical" type="radio" name="navbar" value="vertical" data-theme-control="navbarPosition" /><label class="form-check-label" for="option-navbar-vertical">Vertical</label></div>
                  <div class="form-check form-check-inline"><input class="form-check-input" id="option-navbar-top" type="radio" name="navbar" value="top" data-theme-control="navbarPosition" /><label class="form-check-label" for="option-navbar-top">Top</label></div>
                  <div class="form-check form-check-inline me-0"><input class="form-check-input" id="option-navbar-combo" type="radio" name="navbar" value="combo" data-theme-control="navbarPosition" /><label class="form-check-label" for="option-navbar-combo">Combo</label></div>
                </div>
              </div>
            </div>
            <hr />-->
            <h5 class="fs-0 d-flex align-items-center">Vertical Navbar Style</h5>
            <p class="fs--1 mb-0">Switch between styles for your vertical navbar </p>
            <p> </p>
            <div class="btn-group d-block w-100 btn-group-navbar-style">
              <div class="row gx-2">
                <div class="col-6"><input class="btn-check" id="navbar-style-transparent" type="radio" name="navbarStyle" value="transparent" data-theme-control="navbarStyle" /><label class="btn d-block w-100 btn-navbar-style fs--1" for="navbar-style-transparent"> <img class="img-fluid img-prototype" src="<?php echo $base_u; ?>assets/img/generic/default.png" alt="" /><span class="label-text"> Transparent</span></label></div>
                <div class="col-6"><input class="btn-check" id="navbar-style-inverted" type="radio" name="navbarStyle" value="inverted" data-theme-control="navbarStyle" /><label class="btn d-block w-100 btn-navbar-style fs--1" for="navbar-style-inverted"> <img class="img-fluid img-prototype" src="<?php echo $base_u; ?>assets/img/generic/inverted.png" alt="" /><span class="label-text"> Inverted</span></label></div>
                <div class="col-6"><input class="btn-check" id="navbar-style-card" type="radio" name="navbarStyle" value="card" data-theme-control="navbarStyle" /><label class="btn d-block w-100 btn-navbar-style fs--1" for="navbar-style-card"> <img class="img-fluid img-prototype" src="<?php echo $base_u; ?>assets/img/generic/card.png" alt="" /><span class="label-text"> Card</span></label></div>
                <div class="col-6"><input class="btn-check" id="navbar-style-vibrant" type="radio" name="navbarStyle" value="vibrant" data-theme-control="navbarStyle" /><label class="btn d-block w-100 btn-navbar-style fs--1" for="navbar-style-vibrant"> <img class="img-fluid img-prototype" src="<?php echo $base_u; ?>assets/img/generic/vibrant.png" alt="" /><span class="label-text"> Vibrant</span></label></div>
              </div>
            </div>
 
          </div>
        </div>
      </div>
    </div><a class="card setting-toggle" href="#settings-modal" data-bs-toggle="modal">
      <div class="card-body d-flex align-items-center py-md-2 px-2 py-1">
        <div class="bg-soft-primary position-relative rounded-start" style="height:34px;width:28px">
          <div class="settings-popover"> <span class="ripple"><span class="fa-spin position-absolute all-0 d-flex flex-center">
		  <span class="icon-spin position-absolute all-0 d-flex flex-center">
		  <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.7369 12.3941L19.1989 12.1065C18.4459 11.7041 18.0843 10.8487 18.0843 9.99495C18.0843 9.14118 18.4459 8.28582 19.1989 7.88336L19.7369 7.59581C19.9474 7.47484 20.0316 7.23291 19.9474 7.03131C19.4842 5.57973 18.6843 4.28943 17.6738 3.20075C17.5053 3.03946 17.2527 2.99914 17.0422 3.12011L16.393 3.46714C15.6883 3.84379 14.8377 3.74529 14.1476 3.3427C14.0988 3.31422 14.0496 3.28621 14.0002 3.25868C13.2568 2.84453 12.7055 2.10629 12.7055 1.25525V0.70081C12.7055 0.499202 12.5371 0.297594 12.2845 0.257272C10.7266 -0.105622 9.16879 -0.0653007 7.69516 0.257272C7.44254 0.297594 7.31623 0.499202 7.31623 0.70081V1.23474C7.31623 2.09575 6.74999 2.8362 5.99824 3.25599C5.95774 3.27861 5.91747 3.30159 5.87744 3.32493C5.15643 3.74527 4.26453 3.85902 3.53534 3.45302L2.93743 3.12011C2.72691 2.99914 2.47429 3.03946 2.30587 3.20075C1.29538 4.28943 0.495411 5.57973 0.0322686 7.03131C-0.051939 7.23291 0.0322686 7.47484 0.242788 7.59581L0.784376 7.8853C1.54166 8.29007 1.92694 9.13627 1.92694 9.99495C1.92694 10.8536 1.54166 11.6998 0.784375 12.1046L0.242788 12.3941C0.0322686 12.515 -0.051939 12.757 0.0322686 12.9586C0.495411 14.4102 1.29538 15.7005 2.30587 16.7891C2.47429 16.9504 2.72691 16.9907 2.93743 16.8698L3.58669 16.5227C4.29133 16.1461 5.14131 16.2457 5.8331 16.6455C5.88713 16.6767 5.94159 16.7074 5.99648 16.7375C6.75162 17.1511 7.31623 17.8941 7.31623 18.7552V19.2891C7.31623 19.4425 7.41373 19.5959 7.55309 19.696C7.64066 19.7589 7.74815 19.7843 7.85406 19.8046C9.35884 20.0925 10.8609 20.0456 12.2845 19.7729C12.5371 19.6923 12.7055 19.4907 12.7055 19.2891V18.7346C12.7055 17.8836 13.2568 17.1454 14.0002 16.7312C14.0496 16.7037 14.0988 16.6757 14.1476 16.6472C14.8377 16.2446 15.6883 16.1461 16.393 16.5227L17.0422 16.8698C17.2527 16.9907 17.5053 16.9504 17.6738 16.7891C18.7264 15.7005 19.4842 14.4102 19.9895 12.9586C20.0316 12.757 19.9474 12.515 19.7369 12.3941ZM10.0109 13.2005C8.1162 13.2005 6.64257 11.7893 6.64257 9.97478C6.64257 8.20063 8.1162 6.74905 10.0109 6.74905C11.8634 6.74905 13.3792 8.20063 13.3792 9.97478C13.3792 11.7893 11.8634 13.2005 10.0109 13.2005Z" fill="#2A7BE4"></path></svg>
	</span>
		  </span>
		  </span>	  
		  </div>
        </div><small class="text-uppercase text-primary fw-bold bg-soft-primary py-2 pe-2 ps-1 rounded-end">customize</small>
      </div>
    </a>
	

    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="<?php echo $base_u; ?>vendors/popper/popper.min.js"></script>
    <script src="<?php echo $base_u; ?>vendors/bootstrap/bootstrap.min.js"></script>
    <script src="<?php echo $base_u; ?>vendors/anchorjs/anchor.min.js"></script>
    <script src="<?php echo $base_u; ?>vendors/is/is.min.js"></script>
 
    <script src="<?php echo $base_u; ?>vendors/progressbar/progressbar.min.js"></script>
 
    <script src="<?php echo $base_u; ?>vendors/lodash/lodash.min.js"></script>
    <script src="../../../polyfill.io/v3/polyfill.min58be.js?features=window.scroll"></script>
    <script src="<?php echo $base_u; ?>vendors/list.js/list.min.js"></script>
	<script src="<?php echo $base_u; ?>assets/js/theme.js"></script>
	<script src="<?php echo $base_u; ?>assets/js/functions.js"></script>
	<script src="<?php echo $base_u; ?>vendors/choices/choices.min.js"></script>	
	
	<!--Data Table-->
	<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script> 
	<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js'></script>
	 
	<script src='https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/jquery.dataTables.min.js'></script>
	<script src='https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js'></script>

	<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.min.js'></script>
	 
	<script src='https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js'></script>
	<script src='https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js'></script>
	<script src='https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js'></script>
 
 
	<script src='https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js'></script>
	<script src='https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js'></script>
	<script src='https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js'></script>
    
 
	
	<script src="<?php echo $base_u; ?>vendors/countup/countUp.umd.js"></script>
	
	<!--File-->
	<script src="<?php echo $base_u; ?>vendors/dropzone/dropzone.min.js"></script>
	
	<!--Tiny-->
	<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.0.5/tinymce.min.js'></script>
	<script src='https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc'></script>
 <script src='https://cdn.tiny.cloud/1/qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc/tinymce/5/tinymce.min.js?apiKey=qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc'></script>-->


 

<script>	
$(document).ready(function() {
	 
     $.getScript("https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"); 
     $.getScript("https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"); 
     $.getScript("<?php echo $base_u; ?>vendors/echarts/echarts.min.js"); 
     $.getScript("https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"); 
     $.getScript("https://cdn.tiny.cloud/1/otvcrxjnxxxovlroyy3l3z3e2jhwefnvduc3uoi164milhfw/tinymce/5/tinymce.min.js"); 
     $.getScript("https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"); 
     $.getScript("https://cdn.jsdelivr.net/npm/pdfjs-dist@2.0.385/build/pdf.min.js"); 
     $.getScript("<?php echo $base_u; ?>vendors/fontawesome/all.min.js"); 
	 
     $.getScript("<?php echo $base_u; ?>vendors/fontawesome/all.min.js"); 
     $.getScript("<?php echo $base_u; ?>vendors/fontawesome/all.min.js"); 
     $.getScript("<?php echo $base_u; ?>vendors/fontawesome/all.min.js"); 
     $.getScript("<?php echo $base_u; ?>vendors/fontawesome/all.min.js"); 
     $.getScript("<?php echo $base_u; ?>vendors/fontawesome/all.min.js"); 
});


</script>

<!--	Animation-->
 
 
<script>
 
 
$( document ).ready(function() {
  var this_location=window.location.href;
  var last_part=this_location.split("#")[1];

  if(last_part===undefined){}else{
  window[last_part]('','','1&2','');   }
});

 function pri(name)
 {
 
 
  var doc = new jsPDF(); 

 

    doc.fromHTML($('#print_here').html(), 15, 15, { 
        'width': 190
            
    }); 
    doc.save(name+'.pdf'); 

 }
 
 <!--Insert & Update-->	
 function reset(ids)
 {
	 const ids_array = ids.split("#"); 
	 ids_array.forEach((entry) => {
	 entry.trim();
	 document.getElementById(entry).value='';
	 });
 }
 
 
<!--Insert & Update-->	
 function insert(ids,type,title,table_name,crud_action)
 {
 
 var have_required_error=0;
 
 const ids_array = ids.split("*");
 const type_array = type.split("^");
 const title_array = title.split("*");
 
 const ids_vals = [""]; 
 const ids_vals_files = [""]; 
 const ids_vals_id = [""]; 
	
 const null_id = [""];
 var null_id_inc=0;

 var file_prefix=Math.floor(1000000000 + Math.random() * 9000000000);

	$ind=0;
	$indx=0;
	
	ids_array.forEach((entry) => {
	type_array[$ind].trim();
	entry.trim();
	
	const type_array_expand = type_array[$ind].split("@");
	
		if(type_array_expand[0]=='input'){
		ids_vals[$ind]=document.getElementById(entry).value;
		}
		
		
		
		
		if(type_array_expand[0].split("+")[0]=='input_mul'){
 
		var elementx =document.getElementsByClassName(entry);
		var valuesx= '';
		var myTitle= '';
			for(var ix=0; ix<elementx.length; ix++) {
				if(valuesx==''){valuesx=elementx[ix].value;}else {valuesx= valuesx+'@@@'+elementx[ix].value;}
				if(myTitle==''){myTitle=elementx[ix].getAttribute('title');}else {myTitle=myTitle+'@@@'+elementx[ix].getAttribute('title');}		
			}
			const myArr1 = valuesx.split("@@@");
			const myArr2 = myTitle.split("@@@");
			
			
			var array_length=myArr1.length;
			
			var items=type_array_expand[0].split("+")[1];
			var total_box=array_length/items;
			
			var final_val=''; 
			for(var item_no=0; item_no<items; item_no++){//4 times
			 sl_val='';
				for(var box_no=0; box_no<total_box; box_no++){//8 times
				//every first value
				var ind=(box_no*items)+item_no;
					if(sl_val==''){sl_val='"'+myArr1[ind]+'"';}else {sl_val=sl_val+',"'+myArr1[ind]+'"';}
				//if((box_no+1)==total_box){sl_val=sl_val;}else{sl_val=sl_val+','; }
				}
				
				//console.log('val:'+sl_val);
				var use_title=myArr2[item_no];
				if(final_val==''){final_val='"'+use_title+'":['+sl_val+']'; } else {final_val=final_val+'"'+use_title+'"'+':['+sl_val+']';}
				if((item_no+1)==items){}else{final_val=final_val+',';}
			}
			
			ids_vals[$ind]='{'+final_val+'}';
			//alert(ids_vals[$ind]);
			//alert(final_val);
		}




		
		if(type_array_expand[0]=='area'){
		ids_vals[$ind]=document.getElementById(entry).value;
		}

		//new table
		if(type_array_expand[0]=='checkbox'){
			var checkboxes = document.getElementsByName(entry+'[]');
			var vals = "";
			for (var i=0, n=checkboxes.length;i<n;i++) 
			{
				if (checkboxes[i].checked) 
				{
					vals += ","+checkboxes[i].value;
				}
			}
			if (vals) vals = vals.substring(1);		
 
		ids_vals[$ind] = vals;
		}
		
		if(type_array_expand[0]=='select' || type_array_expand[0]=='moreSettings' ){
		ids_vals[$ind]=document.getElementById(entry).value;
		}
		
		if(type_array_expand[0]=='selectMulti'){
		ids_vals[$ind]=$("#"+entry).html();
		let str = ids_vals[$ind];
		
		
		var options = document.getElementById(entry).options;
		var this_string='';
		for (let i = 0; i < options.length; i++) { 
		if(this_string==''){this_string=options[i].value;}
		else {this_string=this_string+','+options[i].value;} 
		}		
		
		ids_vals[$ind]=this_string;
		
 
		}
		
		//console.log(ids_vals[$ind]);//-----------------------------------------------------

		if(type_array_expand[0]=='area' && type_array_expand[1]=='tiny'){
		ids_vals[$ind] = tinymce.get(entry).getContent();
		}
		
		
		if(type_array_expand[0]=='file' && type_array_expand[1]=='single'){
			var fileInput = document.getElementById(entry);   
			ids_vals[$ind] = '';
			
			try {
			  ids_vals[$ind] = file_prefix+"-"+fileInput.files[0].name;
			  ids_vals_files[$indx]=ids_vals[$ind];
			  ids_vals_id[$indx]=entry;
			  $indx++;
			}
			catch(err) {
			}
			
		}		
		 if(type_array_expand[0]=='file' && type_array_expand[1]=='multi'){
			var fileInput = document.getElementById(entry);   
			ids_vals[$ind] = '';
			
			var f_names='';
			for (var i = 0; i < fileInput.files.length; ++i) {
			
				try {
				  var name = fileInput.files.item(i).name;
				  if(f_names==''){f_names=file_prefix+"-"+name;} else {f_names=f_names+','+file_prefix+"-"+name;}
					}
				
			catch(err) { alert(1);}
			
			}
			 ids_vals_files[$indx]=f_names;
			 ids_vals_id[$indx]=entry;
			 $indx++;
			 ids_vals[$ind] =f_names;
		} 
		

		// for ''
		try {
		ids_vals[$ind] = ids_vals[$ind].replace(/'/g, "\\'");}
		catch(err) {  }
			
		 
		//check_required
		 
		const title_array_split=title_array[$ind].split("@");
		title_array_split[1].trim();
		if(title_array_split[1]=='r'){
				document.getElementById(entry).style.border='0px solid red';
			 if(ids_vals[$ind]==''){
					 document.getElementById(entry).style.border='1px solid red';
					 have_required_error++;
				 }
			}
		
		if(ids_vals[$ind]=='' && type_array_expand[0]=='file'){
				null_id[null_id_inc]=$ind;	null_id_inc++;
			}
		
		
		$ind++;
		
	});

	if(have_required_error==0){
	
	
	var ppp='\''+ids_vals.join('\',\'')+'\''; 
	//console.log(ppp);///////////////////////////////////////////////
	
	 	if(null_id_inc > 0){
			null_id.forEach((entry) => {
			ids_vals.splice(entry, 1);
			ids_array.splice(entry, 1);
			type_array.splice(entry, 1);
			
			});
		}	 
  //////////////////////////////////////////////////////////
		var data_string='\''+ids_vals.join('\',\'')+'\'';  // console.log(data_string);
		
		var data_string2=ids_vals_files.join('#');
		var id_string2=ids_vals_id.join('#');
		var ids_string=ids_array.join(',');
		 ids_string=ids_string.replace(/,/g, '`,`');
		 ids_string='`'+ids_string+'`';
		var type_string=type_array.join('~^~');
		
		
	
		
		//console.log(type_string);
		
					 reset_alert();
				//3	 lottie_loading_start("https://assets9.lottiefiles.com/packages/lf20_x62chJ.json");
					 
					 var uurl="<?php echo $base_u;?>controller/insert.php";
					 if(ids=='op*np*rnp'){var uurl="<?php echo $base_u;?>controller/change_password.php";}
					 
					 var fd = new FormData(document.getElementById("_"+table_name));
		  console.log(fd);
					  fd.append("label", "WEBUPLOAD");
					  fd.append("data_string", data_string);
					  fd.append("data_string2", data_string2);
					  fd.append("id_string2", id_string2);
					  fd.append("ids_string", ids_string);
					  fd.append("type_string", type_string);
					  fd.append("table_name", table_name);
					  fd.append("crud_action", crud_action);
					  fd.append("file_prefix", file_prefix);
				
				
						try {
						  var t_id_value = document.getElementById("t_id_value").innerHTML;
						  var t_id_name = document.getElementById("t_id_name").innerHTML;
						  if(t_id_value > 0){
							  fd.append("t_id_value", t_id_value);
							  fd.append("t_id_name", t_id_name);
							  
							  }
						}
						catch(err) {
						}

				$.ajax({
				  url: uurl,
				  type: "POST",
				  data: fd,
				  processData: false,  // tell jQuery not to process the data
				  contentType: false   // tell jQuery not to set contentType
				}).done(function( data ) {

						var txt = data; 
						var obj = JSON.parse(txt);  
						var say=obj.say;
						var say_code=obj.say_code;
						var logs=obj.log;
						var noti=obj.noti;

						if(noti !=''){
						var pre_noti=$("#noti_earlier").html();
						var noti='<div class="list-group-item">'
                          +'<a class="border-bottom-0 notification-unread  notification notification-flush" href="#!">'
                            +'<div class="notification-avatar"> <div class="avatar avatar-xl me-3"> <img class="rounded-circle" src="assets/img/logos/oxford.png" alt="">'
                              +'</div> </div> <div class="notification-body">'
                             +'<p class="mb-1"><strong>'+noti.split("~*")[0]+'</strong> created '+noti.split("~*")[1]+': "'+noti.split("~*")[2]+'"</p>'
                             +'<span class="notification-time"><span class="me-2" role="img" aria-label="Emoji">✌️</span>'+noti.split("~*")[3]+'</span>'
                            +'</div> </a> </div>'+pre_noti;
						
							$("#noti_earlier").html(noti);
						}
						
						if(logs !=''){console.log(logs);
						
							
						/*var pops='<div class="toast animated   notice shadow-none bg-transparent" id="cookie-notice" role="alert" data-options=\'{"autoShow":true,"autoShowDelay":3000,"showOnce":true,"cookieExpireTime":7200000}\' data-autohide="false" aria-live="assertive" aria-atomic="true" style="max-width:23rem;z-index: 10500; opacity: 1;">'
						+'<div class="toast-body my-3 ms-0 ms-md-5">'
						+'<div class="card"> <div class="card-body"> <div class="d-flex">'
						+'<div class="pe-3"><img src="<?php echo $base_u; ?>assets/img/icons/cookie-1.png" width="40" alt="cookie" /></div> <div><p style=" font-size: 13px;">'+logs+'</p>'
						+'<button class="btn btn-sm btn-falcon-primary me-3" onclick="close_pops()" type="button" data-bs-dismiss="toast" aria-label="Close">Okay</button></div></div></div></div> </div></div>';
						$("#pops").fadeIn("slow").html(pops);
						setTimeout(function() { close_pops(); }, 10000);		*/ 
							}
						 
						if(say_code=='1'){
							 //console.log(say)
							 success_alert(say+'@'+logs);
							 lottie_loading_stop();
							 
						var current_page=document.getElementById("current_page_function").innerHTML;
					 
						if(crud_action=='both'){
							window[current_page]('','','1&2',t_id_value);   
						}else {
							window[current_page]('','','2',t_id_value);   
						}							 	 
							 
						}else{
							 fail_alert(say+'@'+logs);
							 lottie_loading_stop();
						}  	
						

							
					 
					
				});
		}else{
		 reset_alert();
		 fail_alert('Red Border Fields are Required*');
		}		
			
 
 }
 
 <!--Approved-->	
 function approved(delid,table_name,id_name,conditions,f_sl)
 {
	 var cancel_note='';
	 
 
			 cancel_note= $("#cancel_note"+delid).html();  
			// alert(cancel_note+'cancel_note'+delid);
 
	  var st='';
	 if(f_sl=='1'){
		   st="Do you want to change status - Approved?";
	 }else if(f_sl=='2'){
		    st="Do you want to change status - Cancel?";
	 }else if(f_sl=='3'){
		    st="Do you want to change status - complete?";
	 }else if(f_sl=='5'){
		    st="Do you want to change status - clear?";
	 }
	 if(confirm(st)){
		 
		 if(f_sl=='1'){
	 var temp1=parseInt(delid);
     if(Number.isInteger(temp1)==true){}else{
			var checkboxes = document.getElementsByName(conditions);
			var vals = "";
			for (var i=0, n=checkboxes.length;i<n;i++) 
			{
				if (checkboxes[i].checked) 
				{
					vals += ","+checkboxes[i].value;
				}
			}
			if (vals) vals = vals.substring(1);		
		
			delid=vals;
		}}
 

 
			if(delid !=''){
				var uurl="<?php echo $base_u;?>controller/approved.php";
				
				 reset_alert();
			//4     lottie_loading_start("https://assets9.lottiefiles.com/packages/lf20_x62chJ.json");
					 
		    $.ajax({
				type: "POST",
				url: uurl,
				data: {cancel_note:cancel_note,delid:delid,table_name:table_name,id_name:id_name,f_sl:f_sl},
				dataType: "TEXT",
				success: function(data) {
					
				/*if(f_sl=='1'){
				      if(Number.isInteger(temp1)==true){ deleteRow("d"+delid);}else{
					 const myArr = vals.split(",");
						for (i = 0; i < myArr.length; i++) {
						  deleteRow("d"+myArr[i]);  
						} 
											 
					}}else{
					const myArr = delid.split("@");
					//myArr[1].split(' ').join('');
					$( "#files"+myArr[5] ).addClass( "d-none" );
					}*/
				      
					var txt = data;
					var obj = JSON.parse(txt);
					var say=obj.say;
					var say_code=obj.say_code;
 
						
					if(say_code=='1'){
						success_alert(say);
						 lottie_loading_stop();
						 
						 
						 if(table_name=='pro_problem'){
							 var current_page='pro_problem_app';
						 }else if(table_name=='pro_solution'){
							  var current_page='pro_solution_app';
						 }else{
							  var current_page=document.getElementById("current_page_function").innerHTML;
						 }
						
 
						//if(crud_action=='both'){
							//window[current_page]('','','1&2',t_id_value);   
						//}else {
						 	window[current_page]('','','2',t_id_value);   
						//}
						 
						 
						 
					}else{
						fail_alert(say);
						 lottie_loading_stop();
					}

				},
				error: function(err) {
					alert(err);
				}
			}); }else{
			fail_alert("Nothing Sellect");
			} 
 
	 }
 } 


 
<!--Delete-->	
 function deleteme(delid,table_name,id_name,conditions,f_sl)
 {
	 if(confirm("Do you want Delete!")){
		 
		 if(f_sl=='1'){
	 var temp1=parseInt(delid);
     if(Number.isInteger(temp1)==true){}else{
			var checkboxes = document.getElementsByName(conditions);
			var vals = "";
			for (var i=0, n=checkboxes.length;i<n;i++) 
			{
				if (checkboxes[i].checked) 
				{
					vals += ","+checkboxes[i].value;
				}
			}
			if (vals) vals = vals.substring(1);		
		
			delid=vals;
		}}
 

 
			if(delid !=''){
				var uurl="<?php echo $base_u;?>controller/delete.php";
				
				 reset_alert();
			     loading_start("del.gif");
				 
		    $.ajax({
				type: "POST",
				url: uurl,
				data: {delid:delid,table_name:table_name,id_name:id_name,f_sl:f_sl},
				dataType: "TEXT",
				success: function(data) {
					
					var txt = data;
					console.log(txt)
					var obj = JSON.parse(txt);
					var say=obj.say;
					var say_code=obj.say_code;
 					
					if(say_code=='1'){
						
				if(f_sl=='1'){
				      if(Number.isInteger(temp1)==true){ deleteRow("d"+delid);}else{
					 const myArr = vals.split(",");
						for (i = 0; i < myArr.length; i++) {
						  deleteRow("d"+myArr[i]);  
						} 
											 
					}}else{
					const myArr = delid.split("@");
					//myArr[1].split(' ').join('');
					$( "#files"+myArr[5] ).addClass( "d-none" );
					}						
						
						success_alert(say);
						loading_stop();
					}else{
						fail_alert(say);
						loading_stop();
					}					
					
 
				},
				error: function(err) {
					alert(err);
				}
			}); }else{
			fail_alert("Nothing Sellect");
			} 
 
	 }
 } 
 
//mark
 function mark(id,table_name,id_name,column_name,conditions,f_sl)
 {
		var uurl="<?php echo $base_u;?>controller/mark.php";
		
	 	$.ajax({
				type: "POST",
				url: uurl,
				data: {id:id,table_name:table_name,id_name:id_name,column_name:column_name,f_sl:f_sl},
				dataType: "TEXT",
				success: function(data) {
					var txt = data;
				},
				error: function(err) {
					alert(err);
				}
	 }); 
	 
}
 
 
//table

 function table(th,table_info,table_functions,td,_t_sl,export_columns_,export_title,table_request,table_place)
 {	
	   var uurl="<?php echo $base_u;?>controller/table.php";
 
	 	$.ajax({
				type: "POST",
				url: uurl,
				data: {th:th,table_info:table_info,export_title:export_title,table_functions:table_functions,td:td,table_request:table_request,_t_sl:_t_sl,table_place:table_place},
				dataType: "TEXT",
				success: function(data) {
					//$(table_place).hide().html(data).fadeIn();
				   $("#shimmer").hide();

				 	$(table_place).html(data);
				    data_table(export_columns_,export_title,table_place);
				},
				error: function(err) {
					//alert(err);
				}
	 });  
	 
} 


 //form
function make_form(f_title,f_type,f_column,export_title,f_classes,f_class,f_placeh,f_buttton,f_table,f_sl,table_info,f_functions,view_place)
 {	
	   var uurl="<?php echo $base_u;?>controller/form.php";
 //1lottie_loading_start("https://assets9.lottiefiles.com/packages/lf20_x62chJ.json");
	 	$.ajax({
				type: "POST",
				url: uurl,
				data: {export_title:export_title,f_title:f_title,f_type:f_type,f_column:f_column,f_classes:f_classes,f_class:f_class,f_placeh:f_placeh,f_buttton:f_buttton,f_table:f_table,f_sl:f_sl,f_functions:f_functions,table_info:table_info},
				dataType: "TEXT",
				success: function(data) {
					 $(view_place).html(data).fadeIn();
  lottie_loading_stop();
                    tinymce_init('1,2','');
					tinymce_simple_init();
   

					$(".datetimepicker ").flatpickr({
				
					 dateFormat:  "F j, Y",
					 altInput:true,
					 altFormat: "F j, Y"
					});     

				 	$(".yearonly ").flatpickr({
					
					 enableTime: false,		

					 dateFormat:  "Y",
					 altInput:true,
					 altFormat: "Y"
					});    

//$( ".yearonly" ).datepicker({dateFormat: 'yy'});

					$(".time").flatpickr({
					 enableTime:true,
					 dateFormat:  "F j, Y  (h:i K)",
					 altInput:true,
					 altFormat: "F j, Y  (h:i K)"
					});
					
				}, 
				error: function(err) {
					//alert(err);
					lottie_loading_stop();
					alert('Connection Failed!');
					 
				}
	 });  
	 
} 


 //After windows ready
 $(document).ready(function() { 
 
  var her=get_width("card-body")*.80;
  var style = document.createElement('style');
  style.type = 'text/css';
 // style.innerHTML = '.child li { width: '+her+'px; font-size:3vw;}';
  document.getElementsByTagName('head')[0].appendChild(style);

 
 });




 function data_table(export_columns_,export_title,table_place) {

    lottie_loading_stop()
 // var table_title=document.getElementById("table_title").innerHTML;
  var export_title=export_title;
    <?php if($export_columns==''){
		$export_columns='\':visible\'';
		}?>
 
  var table =$(table_place+'_').DataTable({
    aaSorting: [],
    responsive: true,

   "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
	
 dom: 'Bfrt<"col-md-6 inline"i> <"col-md-6 inline"p>',	
	buttons: {
          dom: {
            container:{
              tag:'div',
              className:'flexcontent'
            },
            buttonLiner: {
              tag: null
            }
          },

          
          buttons: [


                    {
                        extend:    'copyHtml5',
                        text:      '<i class="fa fa-clipboard"> </i> Copy',
                        title:export_title,
                        titleAttr: 'Copiar',
                        className: 'btn btn-app export barras',
                        exportOptions: {
                              columns: <?php echo $export_columns;?>
                        }
                    },

                    {
                        extend:    'pdfHtml5',
                        text:      '<i class="fas fa-file-pdf"> </i> PDF',
                        title:export_title,
                        titleAttr: 'PDF',
                        className: 'btn btn-app export pdf',
                        exportOptions: {
                            columns: <?php echo $export_columns;?>
                        },
                        customize:function(doc) {

                            doc.styles.title = {
                                color: '#4c8aa0',
                                fontSize: '30',
                                alignment: 'center'
                            }
                            doc.styles['td:nth-child(2)'] = { 
                                width: '100px',
                                'max-width': '100px'
                            },
                            doc.styles.tableHeader = {
                                fillColor:'#4c8aa0',
                                color:'white',
                                alignment:'center'
                            },
                            doc.content[1].margin = [ 100, 0, 100, 0 ]

                        }

                    },

                    {
                        extend:    'excelHtml5',
                        text:      '<i class="fas fa-file-excel"> </i> Excel',
                        title:export_title,
                        titleAttr: 'Excel',
                        className: 'btn btn-app export excel',
                        exportOptions: {
                            columns: <?php echo $export_columns;?>
                        },
                    },
                    {
                        extend:    'csvHtml5',
                        text:      '<i class="fas fa-file-csv"> </i> CSV',
                        title:export_title,
                        titleAttr: 'CSV',
                        className: 'btn btn-app export csv',
                        exportOptions: {
                            columns: <?php echo $export_columns;?>
                        }
                    },
                    {
                        extend:    'print',
                        text:      '<i class="fa fa-print"> </i> print',
                        title:export_title,
                        titleAttr: 'Imprimir',
                        className: 'btn btn-app export imprimir',
                        exportOptions: {
                             columns: <?php echo $export_columns;?>
                        }
                    },
                    {
                        extend:    'pageLength',
                        titleAttr: 'Registros a mostrar',
                        className: 'selectTable'
                    }
					]

        }	
	

  });
  
  
  

 $('#myInput').on( 'keyup', function () {
  table.search( this.value ).draw();
} );
 
  $('[data-toggle="tooltip"]').tooltip();
}
  
  
  
  
  
  
  
 function check_all(source){ 
 
    var checkboxes = document.querySelectorAll('.checked');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
 }
 
$(document).ready(function(){

 $('#this_9').trigger('click');
 
 
  var this_location=window.location.href;
  var last_part=this_location.split("#")[1];
  if(last_part===undefined){
 
	  $('#this_profile').trigger('click');
	  }
 
 
var x3= document.getElementById("details ").value;
$(".ql-editor").html(x3);
});

$(".ql-editor").keyup(function(){
var x3= $(".ql-editor").html();
document.getElementById("details ").innerHTML=x3;
}); 



function page_function(current_page,li_id,restrict,function_name){
$("#languages").html(""); 
	var current_page_link=window.location.href;
 
	 var obj = { Title: '', Url: '#'+function_name};
     history.pushState(obj, obj.Title, obj.Url);
	 
	//alert(function_name);
	//Close mobile nab
	if(function_name=='Activity' ||  function_name=='Profile'){
		//$("#shimmer").hide();
	}else{
	
 	$("#shimmer").show(); 
	
			if(get_width("main")<1181){
			 $( ".navbar-toggler" ).click();	
				}		
		}

		if(restrict=='#profile_place'){
		}else{
		$('#profile_place').html("");
		}
    // $('#form_place').html("");
    // $('#form_place2').html("");
     //$('#table_place').html("gggggggggggggggggggggggggggg");
 //  $('#table_place2').html("");
     document.getElementById("dashboard_content").classList.add("d-none"); 	
	 //lottie_loading_start("https://assets3.lottiefiles.com/packages/lf20_njklfbjr.json");
	//2 lottie_loading_start("https://assets9.lottiefiles.com/packages/lf20_x62chJ.json");
	 document.getElementById("p_title").innerHTML=current_page+' |  <?php echo  $common_page_title; ?>';
	 var last_id_nav=document.getElementById("last_id_nav").innerHTML;
	 
	 try {
		$("#"+last_id_nav).removeClass("active");
	  } catch(err) { }

	 document.getElementById("last_id_nav").innerHTML=li_id;
	 
	 try {
		document.getElementById(li_id).classList.add("active");
	  } catch(err) { }
}


function parent_base_url(){
	var bu_img=document.getElementById("parent_base_url").innerHTML;
	return bu_img;
}



function tinymce_simple_init(){
	tinymce.remove(".tinymce_simple");
	tinymce.init({
  selector: '.tinymce_simple',
  height: 200,
  menubar: false,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor textcolor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code help wordcount'
  ],
  mobile: { 
    theme: 'mobile' 
  },
  toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tiny.cloud/css/codepen.min.css'
  ],
});
}



function tinymce_init(title,link){
 
 

      
	
    tinymce.remove(".tinymce");
 
	const a =  title.split(",");
  for (const val of a) { // You can use `let` instead of `const` if you like
    console.log(val);
}  

tinymce.init({
 selector: '.tinymce',
  content_style: `
  
  p { margin:0px !important; padding:0px 5px 0px 0px!important; }   
  td { padding: 0px 3px 0px 3px !important; margin: 0px !important; }      
  @media print {
    table { page-break-inside:auto }
    tr    { page-break-inside:avoid; page-break-after:auto }
    thead { display:table-header-group }
    tfoot { display:table-footer-group }
	p { font-size: 16px; color:black !important;}
}

	p { font-size: 16px; color:black !important;}
	.mce-content-body ol li, .mce-content-body ul li { margin-bottom: 2px;}
	.mce-content-body ol li, .mce-content-body ul li {margin-top: 2px;}

	.width-1{width:5% !important;; }
	.width-2{width:35% !important;; }
	.width-3{width:60% !important;; }
	.td_0{border:1px solid white!important; padding:0px !important; margin:0px !important;}
	td { color: black !important; }
  `,

  
  plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
  imagetools_cors_hosts: ['picsum.photos'],
  menubar: 'file edit view insert format tools table help',
  toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview  print | insertfile image media template link anchor codesample | ltr rtl',
  toolbar_sticky: true,
  pagebreak_split_block: true,
  autosave_ask_before_unload: true,
  autosave_interval: "30s",
  autosave_prefix: "{path}{query}-{id}-",
  autosave_restore_when_empty: false,
  autosave_retention: "2m",
  image_advtab: true,
  content_css: '//www.tiny.cloud/css/codepen.min.css',

  link_list: [
    { title: 'My page 1', value: 'http://www.moxiecode.com'},
    { title: 'My page 2', value: 'http://www.moxiecode.com' }
  ],
   image_list: [
    { title: 'My page 1', value: 'http://www.tinymce.com' },
    { title: 'My page 2', value: 'http://www.moxiecode.com' }
  ], 
  image_class_list: [
    { title: 'None', value: '' },
    { title: 'Some class', value: 'class-name' }
  ],
  importcss_append: true,
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
  
  <?php
  				$query1="select * from tiny_template where `is_key`='1' order by position desc";
				$result1=mysqli_query($connect,$query1); $rowcount1=mysqli_num_rows($result1); $row1 = mysqli_fetch_all($result1,MYSQLI_ASSOC);
				for($j=$rowcount1-1;$j>=0;$j--)
				{  
					$str=$row1[$j]['content'];
				    $str = str_replace(array("\r", "\n"), '', $str); 
					echo '{ title: \''.$row1[$j]['tiny_template'].'\', description: \''.$row1[$j]['description'].'\', content: \''.$str.'\' },';				
				}
				
    	/*	 	$query1="select * from tbl_users,tender_documents where (`tender_documents`.`creator`=`tbl_users`.`userID` OR `tender_documents`.`modifier`=`tbl_users`.`userID`) AND `tender_documents`.`is_key`='1' order by tender_documents desc";
				$result1=mysqli_query($connect,$query1); $rowcount1=mysqli_num_rows($result1); $row1 = mysqli_fetch_all($result1,MYSQLI_ASSOC);
				
				$s1='';
				for($j=$rowcount1-1;$j>=0;$j--)
				{  
					$str=$row1[$j]['tender_documents'];
				    $str = str_replace(array("\r", "\n"), '', $str); 
					$s1=$s1.'['.$str.'] //Created on '.$row1[$j]['created'].' By '.$row1[$j]['userName'].' And Last Modified '.$row1[$j]['modified'].' By '.$row1[$j]['userName'].''.'<br>';
			
				}
				echo '{ title: \'Tender Active Documents\', description: \'Tender Active Documents\', content: \''.$s1.'\' },';	*/
  ?>
  
  { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
  
  
  ],
  template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
  template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
  height: 320,
  image_caption: true,
  quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
  noneditable_noneditable_class: "mceNonEditable",
  toolbar_mode: 'sliding',
  contextmenu: "link image imagetools table",
 });
				
 		
}

function scroll_to_top(){
// $("html, body").animate({ scrollTop: 0 }, "fast"); 
 setTimeout(function() { $(window).scrollTop(0); }, 300);
  
}
 





//Render PDF 
 
 	var xw=1;
	var holder_string='';
	function renderPDF(url,id_value) {
	reset_alert();
	loading_start("loadingSquare.gif");
	canvasContainer=document.getElementById('holder');

		var options = options || { scale: 2 };	
		function renderPage(page) {
		xw++;
			var viewport = page.getViewport(options.scale);
			var wrapper = document.createElement("div");
			wrapper.className = "canvas-wrapper";
			var canvas = document.createElement('canvas');
			canvas.setAttribute("id", "D"+xw);
			
			var ctx = canvas.getContext('2d');
			var renderContext = {
			
			  canvasContext: ctx,
			  viewport: viewport
			};
			
			canvas.height = viewport.height;
			canvas.width = viewport.width;
			wrapper.appendChild(canvas)
			canvasContainer.appendChild(wrapper);
			 

			page.render(renderContext);
 
		}
		
		function renderPages(pdfDoc) {
			for(var num = 1; num <= pdfDoc.numPages; num++){
				pdfDoc.getPage(num).then(renderPage);
			if(num==pdfDoc.numPages){setTimeout(function() { img(pdfDoc.numPages,id_value) },3000);}
			}
		}

		PDFJS.disableWorker = true;
		PDFJS.getDocument(url).then(renderPages);
	}   

 
	
	function img(count,id_value) {	
		 console.log('image_call');
		//document.write('<img src="'+img+'"/>');	
		count=parseInt(count)+2;
		for (var x=2;x<count+2;x++){
		var id="D"+x;
				var canvasx = document.getElementById("D"+x);
				//var img    = canvasx.toDataURL("image/png");
				//console.log(canvasx);
				setImage(canvasx,id);
				//document.getElementById("D"+x).innerHTML('<img src="'+img+'"/>');			
			}
			// console.log(id_value+holder_string);
			 
			 //store
			var uurl="<?php echo $base_u;?>controller/pdf_extract.php";
		    $.ajax({
				type: "POST",
				url: uurl,
				data: {id_value:id_value,holder_string:holder_string},
				dataType: "TEXT",
				success: function(data) {

					var txt = data;
					var obj = JSON.parse(txt);
					var say=obj.say;
					var say_code=obj.say_code;
 
						holder_string='';
					if(say_code=='1'){
					
						success_alert(say);
						loading_stop();
					}else{
						fail_alert(say);
						loading_stop();
					}

				},
				error: function(err) {
					alert(err);
				}
			});			 
	}
	
	function setImage(canvasx,id) {		//
			try {
				var img    = canvasx.toDataURL("image/png");			  
				//console.log(img);
				holder_string=holder_string+'<img style="width:100%" src="'+img+'"/><p><!-- pagebreak --></p>'; 
			}
			catch(err) {
				
			}
			
			//var file = dataURLtoFile(img,'hello.png');
			//document.getElementById(id).innerHTML='<img src="'+file+'"/>';	
			//var blob = dataURLtoBlob(img);
			//console.log(blob);
			//var file =  new File([blob], 'untitled', { type: blob.type });
			//document.getElementById("xx").innerHTML='<img src="'+file+'"/>';		
			
			//var fd = new FormData(document.getElementById("form_id"));
			//fd.append("myFile", blob, "thumb.jpg");
			
			//var file = new File( [blob], 'canvasImage.jpg', { type: 'image/jpeg' } ); 
			//fd.append("canvasImage", file);
			//console.log(fd);
	}	
			
	function dataURLtoBlob(dataurl) {
		var arr = dataurl.split(','), mime = arr[0].match(/:(.*?);/)[1],
			bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
		while(n--){
			u8arr[n] = bstr.charCodeAt(n);
		}
		return new Blob([u8arr], {type:mime});
	}	
 
 
	 function colone(id) {
	 var store_input_mul=document.getElementById('store_input_mul').innerHTML;
	 
	 var ele=document.getElementById(id).firstElementChild.innerHTML;

 data='<div>'+ele+'</div>';
 document.querySelector('#'+id).insertAdjacentHTML('beforeend',data);

	 }
	 
	 
	 function removeRow (input) {	 
	 if(confirm("Do you want to Remove!")){
	 input.parentNode.remove();
	 }
}
 
 
 
 	function rename_file(position,id_value,src,table_name,id_name) {	
		 //console.log('image_call');

			var f_name = document.getElementById("file_rename_"+position).value;
if(f_name!=''){
			
		var old_value=document.getElementById("file_holder_"+position).value;
		
		
		const myArr = old_value.split(".");
		const myArr2 = old_value.split("-");
		var last_part=myArr[myArr.length-1];
		var first_part=myArr2[0];
		
		var final_name=first_part+"-"+f_name+"."+last_part;
		
		//alert(final_name);
		
	try {
		document.getElementById("set_name"+position).innerHTML=final_name;
		document.getElementById("s name"+position).href= "../"+src+""+final_name;
		document.getElementById("download_link"+position).href = "../"+src+""+final_name;

} catch (error) {
  console.error(error);
}
	
		

		
			var uurl="<?php echo $base_u;?>controller/file_rename.php";
		     $.ajax({
				type: "POST",
				url: uurl,
				data: {old_value:old_value,position:position,id_value:id_value,final_name:final_name,src:src,table_name:table_name,id_name:id_name},
				dataType: "TEXT",
				success: function(data) {

					var txt = data;
					var obj = JSON.parse(txt);
					var say=obj.say;
					var say_code=obj.say_code;

					if(say_code=='1'){
					
						success_alert(say);
						loading_stop();
					}else{
						fail_alert(say);
						loading_stop();
					}

				},
				error: function(err) {
					alert(err);
				}
			});	 
		} else {
		
		alert('File name can not be null');
		}		 
	}
 
    
 function sticky_tiny(data)
 {
 
 if(data=='add'){
			 const element = document.querySelector('[role="application"]');
			 document.getElementById("table_place").style.opacity = "0.3";
			element.classList.add("a4_print");
	 }else{
	 			 const element = document.querySelector('[role="application"]');
				 	 document.getElementById("table_place").style.opacity = "1";
			element.classList.remove("a4_print");
	 }

  
 
}

	//custom set default 

 function pin_project(book,user)
 {	
var uurl="<?php echo $base_u;?>controller/pin_project.php";

	 	 $.ajax({
				type: "POST",
				url: uurl,
				data: {book:book,user:user},
				dataType: "TEXT",
				success: function(data) {
				
				success_alert(data);
				},
				error: function(err) {
					alert(err);
				}
	 });  
	 
} 
	
 function logout()
 {	
	 window.location = "../login/logout.php"; 
} 

 
 // A $( document ).ready() block.


 
</script>
<script src="<?php echo $base_u; ?>assets/js/functions.js"></script>
<script src="<?php echo $base_u; ?>assets/js/flatpickr.js"></script>
</body>


</html>
