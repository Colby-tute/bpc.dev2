<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
        <?= $header; ?>
        <div class="container">
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">Operations</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url('Home') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('user/smme/Incubator') ?>">Incubator Managers</a></li>
                        <li class="breadcrumb-item active" aria-current="page">View Profile</li>
                    </ol>
                </nav>

            </div>
            <div class="my-auto breadcrumb-right">
							<a href="<?= site_url('user/smme/Incubator') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-arrow-circle-left mr-2"></i></span><span class="btn-text">Go Back </span></button></a>
							<a href="<?= site_url('Profile/view_profile/'.$this->session->userdata('id_user')) ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Personal Details </span></button></a>
							<button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-question-circle mr-2"></i> </span><span class="btn-text">Help </span></button>
						</div>
        </div>

        <div class="">
            <!-- row opened -->
            <?php //print_r($userdt);
                        //if($personal)
                        foreach ($personal as $key => $per) {
                             # code...
                         }
                         foreach ($userdt as $key => $user) {
                             # code...
                         }

                         foreach ($business as $key => $buss) {
                             # code...
                         } 

                        ?>
          <div class="row row-sm">
		<!-- Col -->

		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					<div class="border">
						<div class="bg-gray-300 nav-bg">
							<nav class="nav nav-tabs">
								<a class="nav-link active" data-toggle="tab" href="#tabCont1">Business Summary</a>
								<a class="nav-link tabCont2" data-toggle="tab" href="#tabCont2">Business Quick Description</a>
								<a class="nav-link tabCont3" data-toggle="tab" href="#tabCont3">Business Product & Services</a>
								<a class="nav-link tabCont4" data-toggle="tab" href="#tabCont4">Business Documents</a>	
                                <a class="nav-link tabCont5" data-toggle="tab" href="#tabCont5">Business Team Members</a>
								<a class="nav-link tabCont6" data-toggle="tab" href="#tabCont6">Business Logo</a>
							
							</nav>
						</div>
						<div class="card-body tab-content">
										<div class="tab-pane active show" id="tabCont1">

								

								<div class="business_details_show">
									<div class="form-group">
										<div class="row">
											<input type="hidden" name="tbl_business_details_id"
												   id="tbl_business_details_id" value="<?php if (!empty($business)) {
												echo $business[0]->tbl_business_details_id;
											} ?>">
											<div class="col-md-3">
												<label class="form-label label_font">Business Name</label>
												<b class="b_font">
													<?php
													if (!empty($business)) {
														echo $business[0]->tbl_business_details_name;
													} else {
														echo '[Unspecified]';
													}
													?></b>
											</div>
											<div class="col-md-3">
    <label class="form-label label_font">Business Start Date</label>
    <b class="b_font">
  <?php if(!empty($business))
    { 

        echo $business[0]->tbl_business_details_date_hired;
    }else{
        echo "[Unspecified]";
    } ?> 
</b>
</div>

											<div class="col-md-3">
												<label class="form-label label_font">Business Industry</label>
												<b class="b_font">
													<?php
													if (!empty($business)) {
														echo $business[0]->tbl_industry_name;
													} else {
														echo "[Unspecified]";
													} ?>
												</b>
											</div>

											<div class="col-md-3">
												<label class="form-label label_font">
													Sub Industry </label>
												<b class="b_font">
													<?php
													if (!empty($business)) {
														echo $business[0]->tbl_sub_industry_name;
													} else {
														echo "[Unspecified]";
													} ?>
												</b>
											</div>

											

										</div>
									</div>

									<div class="form-group ">
										<div class="row">
										<div class="col-md-3">
												<label class="form-label label_font">Business Email Address</label>
												<b class="b_font">
													<?php if (!empty($business)) {
														echo $business[0]->tbl_business_details_email;
													} else {
														echo "[Unspecified]";
													} ?>
												</b>
											</div>

											<div class="col-md-3">
												<label class="form-label label_font">Business Phone Number</label>
												<b class="b_font">
													<?php
													if (!empty($business)) {
														if ($business[0]->tbl_business_details_countrycode != '') {
															$exp = explode('-', $business[0]->tbl_business_details_countrycode);
															$code = '+' . $exp[1];
														} else {
															$code = '';
														}
													}
													?>
													<?php if (!empty($business)) {
														echo $code . '' . $business[0]->tbl_business_details_phone;
													} else {
														echo "[Unspecified]";
													} ?>
												</b>
											</div>

											<div class="col-md-3">
												<label class="form-label label_font">Business District</label>
												<b class="b_font">
													<?php if (!empty($business)) {
														echo $business[0]->tbl_business_details_district;
													} else {
														echo "[Unspecified]";
													} ?>
												</b>
											</div>

											<div class="col-md-3">
												<label class="form-label label_font">Business Town/Village</label>
												<b class="b_font">
													<?php if (!empty($business)) {
														echo $business[0]->tbl_business_details_town_village;
													} else {
														echo "[Unspecified]";
													} ?>
												</b>
											</div> 

											
													
											
										</div>
									</div>

									

									
								</div>
</div>

								
							<div class="tab-pane" id="tabCont2">
								
								<div class="col-md-12">
												<!--<label class="form-label label_font">Business Description</label> -->
												<p style="text-align:justify;">
													<?= !empty($business) ? $business[0]->tbl_business_details_desc : ""?>
												</p>
											</div>
								
								
								</div>


							<div class="tab-pane" id="tabCont3">
                                
                                <div class="row row-sm product_services_edit">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                       
                                        <div class="col-sm-12">
                                      
                                       <p style="text-align:justify;"> <?= !empty($business) ? trim($business[0]->product_service) : "" ?> </p>
                                         </div>
                                        

                                       
                                    </div>
                                </div>

                                
                            </div>

<div class="tab-pane" id="tabCont4">
								<div class="row row-sm">
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
									
										<div class="card-body iconfont text-left">
											
											<div class="table-responsive">
												<table class="table table-bordered mg-b-0 text-md-nowrap"
													   style="width: 100%;">
													<thead>
													<tr>
														<th scope="col">PID</th>
														<th scope="col" class="table_title_width">Docuement Name / Description</th>
														<th scope="col">Action</th>
													</tr>
													</thead>
													<tbody>
													<?php
													$i = 1;
													foreach ($business_doc as $key => $value) { ?>
														<tr>
															<td><?php echo $i; ?></td>
															<td><?php echo $value->tbl_all_documents_title; ?></td>
															<td>

																<a href="<?php echo base_url(); ?>assets/Application/Business_Document/<?php echo $value->tbl_all_documents_document; ?>"
																   target="_blank"
																   class="btn btn-success btn-block btn_width"><i
																			class="far fa-eye"></i></a>

																
															</td>
														</tr>

														<?php $i++;
													}
													?>
													</tbody>
												</table>
											</div>
										</div>
										
									</div>
								</div>
							</div>
							  <div class="tab-pane" id="tabCont5">
                   <div class="col-md-12 team">
										<div class="row ">
											<section class="container col-xs-12">
												<div class="table table-responsive">
													<h4><!-- Select Team Details --></h4>
													<table class="table text-md-nowrap" id="example2"
															   style="width: 100%;">
														<thead>
														<tr>
															<td style="background: none;">First Name</td>
															<td style="background: none;">Last Name</td>
															<td style="background: none;">Email Address</td>
															<td style="background: none;">Mobile Number</td>
															<td style="background: none;">Gender</td>
														</tr>
														</thead>
														<tbody>
														<?php
														if (!empty($smme_teams)) {
															foreach ($smme_teams as $key => $value) {
																# code...
																?>
																<tr>
																	<td>
																		<?php echo $value->tbl_smme_teams_first_name; ?>
																	</td>
																	<td>
																		<?php echo $value->tbl_smme_teams_last_name; ?>
																	</td>
																	<td>
																		<?php echo $value->tbl_smme_teams_email; ?>
																	</td>
															<td>
														<?php echo $value->tbl_smme_teams_mobile; ?>
																	</td>

																	<td>
														<?php echo $value->tbl_smme_teams_gender; ?>
																	</td>
																</tr>
																<?php
															}
														} else {
															?>
															<td>
																
															</td>
															<td>
																
															</td>
															<td>

															</td>
															<td>
																
															</td>
															</tr>
															<?php
														}
														?>
														</tbody>
													</table>
												</div>
											</section>
										</div>
									</div>
                              
                            </div>
							  <div class="tab-pane" id="tabCont6">
							  
							  <div class="col-md-3">
    <!-- <label class="form-label label_font">Business Logo</label> -->
    <b class="b_font">
  <?php if(!empty($business))
   { 

        echo "<img src='".base_url().'assets/users/'.$business[0]->tbl_business_details_business_logo."' width='100' />";
    }else{
        echo "[Unspecified]";
    } ?> 
</b>
</div>	
							  </div>
						</div>
					</div>
					
				</div>

				<!-- <div class="card-footer">

				</div> -->
			</div>
		</div>

		<!-- /Col -->
	</div>
            <!-- row closed -->
        </div>
    </div>
        <?= $footer; ?>
        <script type="text/javascript">
            $('document').ready(function(){

                $('.tabCont2').click(function(){
                  $('.nav-tabs a[href="#tabCont2"]').tab('show');
                });

                $('.tabCont3').click(function(){
                  $('.nav-tabs a[href="#tabCont3"]').tab('show');
                });




            });
        </script>
    