 
 <div id="dashboard_content" class="row g-0 d-none">

			
			<div class="col-sm-4 col-xxl-4 pe-sm-2 mb-3 mb-xxl-0">
			  <div class="card">
                <div class="card-header d-flex flex-between-center bg-light py-2">
				  <div class="row align-items-center">
					<div class="col">
					  <h6 class="mb-0">Project Status</h6>
					</div>
					<div class="col-auto text-center pe-card">
						<!--<select class="form-select form-select-sm">
						<option>Working Time</option>
						<option>Estimated Time</option>
						<option>Billable Time-->
					  </div>
					   </div>
				</div>
				<div class="card-body p-0">
			
<?php 
$data='Planning,Processing,System Designing,Developing,Completed,Maintenance,Cancel';
foreach(explode(',',$data) as $key=>$_dta){
?>			
				
				  <div class="row g-0 align-items-center py-2 position-relative border-bottom border-200">
					<div class="col ps-card py-1 position-static">
					  <div class="d-flex align-items-center">
						<div class="avatar avatar-xl me-3">
						  <div class="avatar-name rounded-circle bg-soft-primary text-dark" style="font-size: 20px;opacity: .6;"><span class="fas fa-star-half-alt"></span></div>
						</div>
						<div class="flex-1">
						  <h6 class="mb-0 d-flex align-items-center"><a class="text-800 stretched-link" href="#!"><?php echo $_dta; ?></a></h6>
						</div>
					  </div>
					</div>
					<div class="col py-1">
					  <div class="row flex-end-center g-0">
						<div class="col-auto pe-2">
						  <div class="fs-2 fw-normal font-sans-serif text-700 lh-1 mb-1" id="{{<?php echo 'p'.$key; ?>}}">0</div>
						</div>

					  </div>
					</div>
				  </div>
<?php } ?>
 
				</div>
				
				
				<div class="card-footer bg-light p-0"><a class="btn btn-sm btn-link d-block w-100 py-2" href="#!" onclick=" "> <!-- <span class="fas fa-chevron-right ms-1 fs--2"></span> Font Awesome fontawesome.com --></a></div>
			  </div>
			</div>
			
			
		            <div class="col-sm-4 col-xxl-4 pe-sm-2 mb-3 mb-xxl-0">
			  <div class="card">
                <div class="card-header d-flex flex-between-center bg-light py-2">
               
                  <div class="row align-items-center">
                    <div class="col">
                      <h6 class="mb-0">Project Types</h6>
                    </div>
                    <div class="col-auto text-center pe-card">
						<!--<select class="form-select form-select-sm">
                        <option>Working Time</option>
                        <option>Estimated Time</option>
                        <option>Billable Time--></option>
                      </select></div>
					   </div>
                </div>
                <div class="card-body p-0">
                  <div class="row g-0 align-items-center py-2 position-relative border-bottom border-200">
                    <div class="col ps-card py-1 position-static">
                      <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl me-3">
                          <div class="avatar-name rounded-circle bg-soft-primary text-dark"><span class="fs-0 text-primary">1</span></div>
                        </div>
                        <div class="flex-1">
                          <h6 class="mb-0 d-flex align-items-center"><a class="text-800 stretched-link" href="#!">Apps</a></h6>
                        </div>
                      </div>
                    </div>
                    <div class="col py-1">
                      <div class="row flex-end-center g-0">
                        <div class="col-auto pe-2">
                          <div class="fs-2 fw-normal font-sans-serif text-700 lh-1 mb-1" id="{{sector_count}}"><div data-countup='{"endValue":0}'>0</div></div>
                        </div>

                      </div>
                    </div>
                  </div>
                  <div class="row g-0 align-items-center py-2 position-relative border-bottom border-200">
                    <div class="col ps-card py-1 position-static">
                      <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl me-3">
                          <div class="avatar-name rounded-circle bg-soft-success text-dark"><span class="fs-0 text-success">2</span></div>
                        </div>
                        <div class="flex-1">
                          <h6 class="mb-0 d-flex align-items-center"><a class="text-800 stretched-link" href="#!">Software</a></h6>
                        </div>
                      </div>
                    </div>
                    <div class="col py-1">
                      <div class="row flex-end-center g-0">
                        <div class="col-auto pe-2">
                          <div class="fs-2 fw-normal font-sans-serif text-700 lh-1 mb-1  " id="{{service_count}}"><div class="loader"></div></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row g-0 align-items-center py-2 position-relative border-bottom border-200">
                    <div class="col ps-card py-1 position-static">
                      <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl me-3">
                          <div class="avatar-name rounded-circle bg-soft-info text-dark"><span class="fs-0 text-info">3</span></div>
                        </div>
                        <div class="flex-1">
                          <h6 class="mb-0 d-flex align-items-center"><a class="text-800 stretched-link" href="#!">Website</a> </h6>
                        </div>
                      </div>
                    </div>
                    <div class="col py-1">
                      <div class="row flex-end-center g-0">
                        <div class="col-auto pe-2">
                          <div class="fs-2 fw-normal font-sans-serif text-700 lh-1 mb-1" id="{{projects_count}}"><div class="loader"></div></div>
                        </div>
 
                      </div>
                    </div>
                  </div>
                  <div class="row g-0 align-items-center py-2 position-relative border-bottom border-200">
                    <div class="col ps-card py-1 position-static">
                      <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl me-3">
						  <div class="avatar-name rounded-circle bg-soft-primary text-dark" style="font-size: 20px;opacity: .6;"><span class="fas fa-users"></span></div>
                        </div>
                        <div class="flex-1">
                          <h6 class="mb-0 d-flex align-items-center"><a class="text-800 stretched-link" href="#!">Clients</a> </h6>
                        </div>
                      </div>
                    </div>
                    <div class="col py-1">
                      <div class="row flex-end-center g-0">
                        <div class="col-auto pe-2">
                          <div class="fs-2 fw-normal font-sans-serif text-700 lh-1 mb-1" id="{{clients_count}}"><div class="loader"></div></div>
                        </div>
                      </div>
                    </div>
                  </div>
 
                </div>
                <div class="card-footer bg-light p-0"><a class="btn btn-sm btn-link d-block w-100 py-2" href="#!" onclick="tender_books('Project Register','_tenderBooks_a','1&2','')">Show all projects<svg class="svg-inline--fa fa-chevron-right fa-w-10 ms-1 fs--2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path></svg><!-- <span class="fas fa-chevron-right ms-1 fs--2"></span> Font Awesome fontawesome.com --></a></div>
              </div>
            </div>	
			
	<div class="col-sm-4 col-xxl-4 pe-sm-2 mb-3 mb-xxl-0">
              <div class="card">
                <div class="card-header d-flex flex-between-center bg-light py-2">
                  <h6 class="mb-0">All Users</h6>
                  <div class="dropdown font-sans-serif btn-reveal-trigger"><button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal dropdown-caret-none" type="button" id="dropdown-active-user" data-bs-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><svg class="svg-inline--fa fa-ellipsis-h fa-w-16 fs--2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="ellipsis-h" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M328 256c0 39.8-32.2 72-72 72s-72-32.2-72-72 32.2-72 72-72 72 32.2 72 72zm104-72c-39.8 0-72 32.2-72 72s32.2 72 72 72 72-32.2 72-72-32.2-72-72-72zm-352 0c-39.8 0-72 32.2-72 72s32.2 72 72 72 72-32.2 72-72-32.2-72-72-72z"></path></svg><!-- <span class="fas fa-ellipsis-h fs--2"></span> Font Awesome fontawesome.com --></button>
                    <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="dropdown-active-user"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                      <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                    </div>
                  </div>
                </div>
                <div class="card-body py-2" id="{{users_list}}">
				
                  <!--<div class="d-flex align-items-center mb-3">
                    <div class="avatar avatar-2xl status-online">
                      <img class="rounded-circle" src="assets/img/team/1-thumb.png" alt="">
                    </div>
                    <div class="flex-1 ms-3">
                      <h6 class="mb-0 fw-semi-bold"><a class="text-900" href="pages/user/profile.html">Emma Watson</a></h6>
                      <p class="text-500 fs--2 mb-0">Admin</p>
                    </div>
                  </div>-->

                  <div class="d-flex align-items-center mb-3">
                    <div class="avatar avatar-2xl status-offline">
                      <img class="rounded-circle" src="assets/img/team/5-thumb.png" alt="">
                    </div>
                    <div class="flex-1 ms-3">
                      <h6 class="mb-0 fw-semi-bold"><a class="text-900" href="pages/user/profile.html">{{userType}}</a></h6>
                      <p class="text-500 fs--2 mb-0">Editor</p>
                    </div>
                  </div>
				  
                </div>
                <div class="card-footer bg-light p-0"><a class="btn btn-sm btn-link d-block w-100 py-2"  onclick="users('Users','_users_a','1&2','')" href="#">All active users<svg class="svg-inline--fa fa-chevron-right fa-w-10 ms-1 fs--2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path></svg><!-- <span class="fas fa-chevron-right ms-1 fs--2"></span> Font Awesome fontawesome.com --></a></div>
              </div>
            </div>		
			
			
			
			
          </div>
