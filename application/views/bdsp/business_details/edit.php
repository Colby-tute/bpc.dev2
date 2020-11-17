<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?= $header; ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet"/>
<div class="container">

	<!-- breadcrumb -->
	<div class="breadcrumb-header justify-content-between">
		<div>
			<h4 class="content-title mb-2">Business Details</h4>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= site_url('bdsp/Home') ?>">Dashboard</a></li>
					<li class="breadcrumb-item active" aria-current="page">Business Details</li>
				</ol>
			</nav>

		</div>

		<?php

		foreach ($business as $key => $buss) {
			# code...
		}

		?>
	        <div class="d-flex my-auto breadcrumb-right">
	            <a href="<?= site_url('bdsp/team'); ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-users mr-2"></i></span><span class="btn-text">Business Team Members </span></button></a>
				<a href="<?= site_url('bdsp/partner'); ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-briefcase mr-2"></i> </span><span class="btn-text">Business Partners</span></button></a>
	            <button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-question-circle mr-2"></i> </span><span class="btn-text">Help </span></button>

	        </div>
	</div>
	<!-- breadcrumb -->

	<!-- row -->


	<div class="row row-sm">
		<!-- Col -->

		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					
				<p><?php if ($this->session->flashdata('danger')) { ?>
						<div id="infoMessage"
							 class="alert alert-danger mt25"><?php echo $this->session->flashdata('danger'); ?></div>
						<?php } else if ($this->session->flashdata('success')) { ?>
							<div id="infoMessage"
								 class="alert alert-success mt25"><?php echo $this->session->flashdata('success'); ?></div>
						<?php }
						?>
						</p>
					<div class="border">
						<div class="bg-gray-300 nav-bg">
							<nav class="nav nav-tabs">
								<a class="nav-link active" data-toggle="tab" href="#tabCont1">Business Details</a>
								<a class="nav-link tabCont2" data-toggle="tab" href="#tabCont2">Business Short Description</a>
								<a class="nav-link tabCont3" data-toggle="tab" href="#tabCont3">Business Profile</a>								
								<a class="nav-link tabCont4" data-toggle="tab" href="#tabCont4">Business Product & Services</a>
								<a class="nav-link tabCont5" data-toggle="tab" href="#tabCont5">Business Logo</a>
								
								<!-- <a class="nav-link teamdt" data-toggle="tab" href="#tabCont3">SMME Team</a> -->
							</nav>
						</div>
						<div class="card-body tab-content">
							<div class="tab-pane active show" id="tabCont1">

								<div class="form-group">
                                       <div class="row">
                                            <div class="col text-right">
                                            	<?php if (!empty($business[0]->tbl_business_details_email)) { ?>
														  
													   
                                                <a href="javascript:void(0)" class="btn btn-outline-primary mr-3 edit_biz"><span class="icon-label"><i class="fa fa-pen"></i></span> <span class="btn-text"> Update Details</span></a>

                                                <a href="javascript:void(0)" class="btn btn-outline-danger mr-3 close_biz" style="display: none;"><span class="icon-label"></span> <span class="btn-text">Close</span></a>
                                                <?php } else { ?>
                                                	<a style="display: none;" href="javascript:void(0)" class="btn btn-outline-primary mr-3 edit_biz"><span class="icon-label"><i class="fa fa-pen"></i></span> <span class="btn-text"> Update Details</span></a>
                                                	<a href="javascript:void(0)" class="btn btn-outline-danger mr-3 close_biz"><span class="icon-label"></span> <span class="btn-text">Close</span></a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                </div>


								<div class="business_details_show" <?php if (!empty($business[0]->tbl_business_details_email)) { echo "style='display:none !important;'"; } ?> >
									<!-- <div class="form-group" style="margin-bottom: 20px;">
										<a href="javascript:void(0)" class="btn btn-primary pull-right edit">Edit</a><br>
									</div> -->
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
													Business Sub Industry </label>
												<b class="b_font">
													<?php
													if (!empty($business)) {
														echo $business[0]->tbl_sub_industry_name;
													} else {
														echo "[Unspecified]";
													} ?>
												</b>
											</div>

											<div class="col-md-3">
												<label class="form-label label_font">Business Email Address </label>
												<b class="b_font">
													<?php if (!empty($business)) {
														echo $business[0]->tbl_business_details_email;
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

											<div class="col-md-3 d-none">
												<label class="form-label label_font">No of Employees</label>
												<b class="b_font">
													<?php if (!empty($business)) {
														echo $business[0]->tbl_business_details_employees;
													} else {
														echo "[Unspecified]";
													} ?>
												</b>
											</div>
											
											<div class="col-md-3">
                                                <label class="form-label label_font">Do you have a team?</label>
                                                <b class="b_font">
                                                    <?php
                                                    if (!empty($business) && $business[0]->tbl_business_details_areyouteam == '1') {
                                                        echo "Yes";
                                                    } else {
                                                        echo "No";
                                                    }
                                                    ?>
                                                </b>
                                            </div>
													
											
										</div>
									</div>

									<div class="form-group ">
										<div class="row">
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
											
											<!--<div class="col-md-3">
												<label class="form-label label_font">Business Logo</label>
												<b class="b_font">
											  <?php if(!empty($business))
											   { 

													echo "<img src='".base_url().'assets/users/'.$business[0]->tbl_business_details_business_logo."' width='100' />";
												}else{
													echo "[Unspecified]";
												} ?> 
											</b>
											</div> -->
										</div>
                                    </div>
									
									<!-- <div class="form-group ">
                                        <div class="row">
                                            <div class="col-md-6">
												<label class="form-label label_font">Business Details</label>
												<p>
													<?= !empty($business) ? $business[0]->tbl_business_details_desc : ""?>
												</p>
											</div>
										</div>
									</div> -->
								</div>


								<div class="business_details_edit" <?php if (empty($business[0]->tbl_business_details_email)) { echo "style='display:block !important;'"; }?> >
									<?php echo form_open_multipart("bdsp/BusinessDetails/update/" . $this->session->userdata('id_user'), 'class="login" data-toggle="validator"'); ?>
									<!-- <div class="form-group" style="margin-bottom: 25px;">
										<a href="javascript:void(0)" class="btn btn-primary close">Close</a><br>
									</div> -->

									<div class="form-group">
										<div class="row">
											<input type="hidden" name="tbl_business_details_id"
												   value="<?php if (!empty($business)) {
													   echo $business[0]->tbl_business_details_id;
												   } ?>">
											<div class="col-md-2">
												<label class="form-label">Business Name</label>
											</div>
											<div class="col-md-2">
												<input type="text" name="tbl_business_details_name" class="form-control"
													   id="tbl_business_details_name" placeholder="Business Name"
													   value="<?php if (!empty($business)) {
														   echo $business[0]->tbl_business_details_name;
													   } ?>" required/>
											</div>
											<div class="col-md-2">
												<label class="form-label">Business Industry</label>
											</div>
											<div class="col-md-2">

												<select id="tbl_business_details_industry"
														class="form-control js-example-basic-single"
														name="tbl_business_details_industry">
													<option value=""></option>
													<?php
													if ($industrys) {
														foreach ($industrys as $key => $industry) { ?>
															<option value="<?php echo $industry->tbl_industry_id; ?>" <?php ?> <?php if (isset($business[0]) && $business[0]->tbl_business_details_industry == $industry->tbl_industry_id) {
																echo "selected";
															} ?>><?php echo $industry->tbl_industry_name; ?></option>
														<?php }
													}
													?>
												</select>
												<input type="hidden" name="ind" id="ind"
													   value="<?php if (!empty($business)) {
														   echo $business[0]->tbl_business_details_industry;
													   } ?>">
											</div>
											<div class="col-md-2">
												<label class="form-label">Business Sub Industry</label>
											</div>
											<div class="col-md-2">
												<select id="tbl_business_details_subindustry"
														class="form-control js-example-basic-single"
														name="tbl_business_details_subindustry">
													<option value="<?php echo $business[0]->tbl_business_details_sub_industry ?>"><?php echo $business[0]->tbl_sub_industry_name; ?></option>
													<option value=""></option>
												</select>
												<input type="hidden" name="sub_ind" id="sub_ind"
													   value="<?php if (!empty($business)) {
														   echo $business[0]->tbl_business_details_sub_industry;
													   } ?>">
											</div>
										</div>
									</div>

									<div class="form-group ">
										<div class="row">
											<div class="col-md-2">
												<label class="form-label">Business Email Address</label>
											</div>
											<div class="col-md-2">
												<input type="email" name="tbl_business_details_email"
													   class="form-control" id="tbl_business_details_email"
													   placeholder="Enter your Email Address"
													   value="<?php if (!empty($business)) {
														   echo $business[0]->tbl_business_details_email;
													   } ?>" required/>
											</div>
											<div class="col-md-2">
												<label class="form-label">Business Telephone</label>
											</div>
											<div class="col-md-2">
												<!-- <input type="tel" name="tbl_business_details_phone" class="form-control" id="tbl_business_details_phone" placeholder="Enter Optopnal Phone Number" value="<?php if (!empty($business)) {
													echo $business[0]->tbl_business_details_phone;
												} ?>" /> -->
												<input class="form-control" id="phone" name="tbl_business_details_phone"
													   type="tel" placeholder="0123456789"
													   value="<?php if (!empty($business)) {
														   echo $business[0]->tbl_business_details_phone;
													   } ?>" maxlength="10" required>
												<input type="hidden" name="country_code" id="country_code"
													   class="form-control" value="<?php if (!empty($business)) {
													echo $business[0]->tbl_business_details_countrycode;
												} else {
													echo 'ls-266';
												} ?>">

											</div>
											<div class="col-md-2">
												<label class="form-label">Business District</label>
											</div>
											<div class="col-md-2">
												<input type="text" name="tbl_business_details_district"
													   class="form-control" id="tbl_business_details_district"
													   placeholder="Business District"
													   value="<?php if (!empty($business)) {
														   echo $business[0]->tbl_business_details_district;
													   } ?>"/>
											</div>
										</div>
									</div>

									<div class="form-group ">
										<div class="row">
											<div class="col-md-2">
												<label class="form-label">Business Town/Village</label>
											</div>
											<div class="col-md-2">
												<input type="text" name="tbl_business_details_town_village"
													   class="form-control" id="tbl_business_details_town_village"
													   placeholder="Business Town/Village"
													   value="<?php if (!empty($business)) {
														   echo $business[0]->tbl_business_details_town_village;
													   } ?>"/>
											</div>
											<!-- <div class="col-md-2">
												<label class="form-label">Gender</label>
											</div>
											<div class="col-md-2">
										<select id="tbl_business_details_business_gender" class="form-control" name="tbl_business_details_business_gender[]">
										<option value="Male" <?php echo set_select('tbl_business_details_business_gender[]',"Male",($value->tbl_business_details_business_gender == "Male" ? TRUE : FALSE )) ?>>Male</option>
										<option value="Female" <?php echo set_select('tbl_business_details_business_gender[]',"Female",($value->tbl_business_details_business_gender == "Female" ? TRUE : FALSE )) ?>>Female</option>
										<option value="Other" <?php echo set_select('tbl_business_details_business_gender[]',"Other",($value->tbl_business_details_business_gender == "Other" ? TRUE : FALSE )) ?>>Other</option> 
																			</select>
											</div> -->
											
											<div class="col-md-2 d-none">
												<label class="form-label">No of Employees</label>
											</div>
											<div class="col-md-2 d-none">
												<input type="Number" name="tbl_business_details_employees"
													   class="form-control" id="tbl_business_details_employees"
													   placeholder="No Of Employees"
													   value="<?php if (!empty($business)) {
														   echo $business[0]->tbl_business_details_employees;
													   } ?>"/>
											</div>

											<div class="col-md-2">
											<label class="form-label">Business Start Date</label>
											</div>
											<div class="col-md-2">
											<input name="tbl_business_details_date_hired" class="qty form-control" id="tbl_business_details_date_hired"  type="date" placeholder="" value="<?php if(!empty($business)){ echo $business[0]->tbl_business_details_date_hired; } ?>"  required>
																											</div>
											<div class="col-md-2">
												<label class="form-label">Business Logo</label>
											</div>
											<div class="col-md-2">
											<input name="tbl_business_details_business_logo" class="qty form-control <?php if(!empty($business) && ($business[0]->tbl_business_details_business_logo != "")){ echo 'd-none1'; } ?>" id="tbl_business_details_business_logo"  type="file" placeholder=""  <?php if(!empty($business) && ($business[0]->tbl_business_details_business_logo == "")){ ?>required <?php } ?>>
												<?php if(!empty($business) && ($business[0]->tbl_business_details_business_logo != "")){ echo '<img src="'.base_url().'assets/users/'.$business[0]->tbl_business_details_business_logo.'" width="50" />'; } ?>
												<input type="hidden" name="tbl_business_details_business_logo_old" class="form-control" id="tbl_business_details_business_logo_old" value="<?php if(!empty($business)){ echo $business[0]->tbl_business_details_business_logo; } ?>" />
                                                                </div>
										</div>
									</div>

									<div class="form-group">
										<div class="row">
										<div class="col-md-2">
												<label class="form-label">Do you have a team?</label>
											</div>
											<?php
											if (!empty($business) && $business[0]->tbl_business_details_areyouteam == '1') {
												?>
												<div class="col-md-1">
													<label class="rdiobox"><input name="tbl_business_details_areyouteam"
																				  type="radio" value="1" checked=""
																				  class='one'> <span>Yes</span></label>

												</div>
												<div class="col-md-1">
													<label class="rdiobox"><input name="tbl_business_details_areyouteam"
																				  type="radio" value="0" class="zero">
														<span>No</span></label>
												</div>
												<?php
											} else {
												?>
												<div class="col-md-1">
													<label class="rdiobox"><input name="tbl_business_details_areyouteam"
																				  type="radio" value="1" class='one'>
														<span>Yes</span></label>

												</div>
												<div class="col-md-1">
													<label class="rdiobox"><input name="tbl_business_details_areyouteam"
																				  type="radio" value="0" checked=""
																				  class="zero"> <span>No</span></label>
												</div>
												<?php
											}
											?>
										</div>
									</div>

									<div class="form-group">
										<div class="row">
											<div class="col-sm-12">
												<label class="form-label">Provide Business Quick Description</label>
												<textarea class="form-control ckeditor" name="tbl_business_details_desc" id="" rows="4" required><?php if (!empty($business)) { echo $business[0]->tbl_business_details_desc; } ?></textarea>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<button class="btn btn-primary sub5">Update Details</button>
									</div>
									<?php echo form_close(); ?>
								</div>

							</div>
							
							<div class="tab-pane" id="tabCont2">
								<!-- <div class="alert alert-success" role="alert">
									<button aria-label="Close" class="close" data-dismiss="alert" type="button">
									   <span aria-hidden="true">&times;</span>
								  </button>
									<strong>Elevator Pitch!</strong><br /> Just a short description of an idea, product or company that explains the concept in a way such that any listener can understand it in a short period of time.
								</div> -->
                                
                                <div class="col-md-12">
												<label class="form-label label_font"></label>
												<p style="text-align:justify;">
													<?= !empty($business) ? $business[0]->tbl_business_details_desc : ""?>
												</p>
											</div>

                                
                            </div>
							<div class="tab-pane" id="tabCont3">
								<div class="row row-sm">
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
										<?php echo form_open_multipart("bdsp/BusinessDetails/insert_business_doc", 'class="login" data-toggle="validator"'); ?>


										<div class="card-body iconfont text-left">
											<div class="form-group">
												<input type="hidden" name="tbl_business_details_id"
													   value="<?php if (!empty($business)) {
														   echo $business[0]->tbl_business_details_id;
													   } ?>">
												<div class="row">
													<div class="col-md-5">
														<input type="text" name="business_doc_title"
															   id="business_doc_title" class="form-control"
															   placeholder="Enter document name or description" required>
													</div>
													<div class="col-md-5">
														<input type="file" name="business_doc_files"
															   id="business_doc_files" class="form-control">
													</div>
													<div class="col-md-2">
														<button class="btn btn-primary" type="submit" id="add_mul_doc">
															Upload
														</button>
													</div>
												</div>
											</div>
											<div class="table-responsive">
												<table class="table table-bordered mg-b-0 text-md-nowrap"
													   style="width: 100%;">
													<thead>
													<tr>
														<th scope="col">PID</th>
														<th scope="col" class="table_title_width">Document Name / Description</th>
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
									<button style="width:35%" data-toggle="dropdown" class="btn btn-primary btn-block button_width"><i class="la la-cog setting"></i></button>
															<div class="dropdown-menu">

																<a href="<?php echo base_url(); ?>assets/Application/Business_Document/<?php echo $value->tbl_all_documents_document; ?>"
																   target="_blank"
																   class="btn btn-success btn-block btn_width"><i
																			class="far fa-eye"></i></a>


																<a href="<?= site_url('bdsp/BusinessDetails/delete/' . $value->tbl_all_documents_id) ?>"
																   class="btn btn-danger btn-block btn_width"><i
																			class="far fa-times-circle"></i></a>
																			</div>
															</td>
														</tr>

														<?php $i++;
													}
													?>
													</tbody>
												</table>
											</div>
										</div>
										<?php echo form_close(); ?>
									</div>
								</div>
							</div>
							
							
							
								
							<div class="tab-pane" id="tabCont4">
                                <div class="row">
                                    <div class="col text-right">
                                    	<?php if (!empty($business[0]->tbl_business_details_email)) { ?>
                                        <a href="javascript:void(0)" class="btn btn-outline-primary mr-3 edit_product_services"><span class="icon-label"><i class="fa fa-pen"></i></span> <span class="btn-text"> Update Details</span></a>
                                        <a href="javascript:void(0)" class="btn btn-outline-danger mr-3 close_product_services" style="display: none;"><span class="icon-label"></span> <span class="btn-text">Close</span></a>
                                        <?php } else { ?>
										<a style="display: none;" href="javascript:void(0)" class="btn btn-outline-primary mr-3 edit_product_services"><span class="icon-label"><i class="fa fa-pen"></i></span> <span class="btn-text"> Update Details</span></a>
                                        <a href="javascript:void(0)" class="btn btn-outline-danger mr-3 close_product_services" ><span class="icon-label"></span> <span class="btn-text">Close</span></a>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="row row-sm product_services_edit">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <?php echo form_open_multipart("bdsp/BusinessDetails/update_service/". $this->session->userdata("id_user"), 'class="login" data-toggle="validator"'); ?>

                                        <div class="col-sm-12">
                                        <label class="form-label">Describe your Products & Services</label>
                                         <textarea class="form-control ckeditor" name="product_service" required><?= !empty($business) ? trim($business[0]->product_service) : "" ?></textarea>
                                         </div>
                                         <div class="col-sm-12" style="margin-top: 15px">
                                             <button class="btn btn-primary sub5">Update Details</button>
                                         </div>

                                        <?php echo form_close(); ?>
                                    </div>
                                </div>

                                <div class="row row-sm product_services_show">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                     
                                        <div class="col-sm-12">
										<div class="alert alert-success" role="alert">
		<button aria-label="Close" class="close" data-dismiss="alert" type="button">
		   <span aria-hidden="true">&times;</span>
	  </button>
		<strong>Products & Services!</strong><br /> Just anything that your business offers to a market for attention, acquisition, use or consumption that could satisfy a need or want.
	</div>
                                        <label class="form-label"></label>
                                         <textarea readonly class="form-control ckeditor" name="product_service"><?= !empty($business) ? trim($business[0]->product_service) : "" ?></textarea>
                                         </div>
                                    </div>
                                </div>
                            </div>
							<!-- <div class="tab-pane" id="tabCont3">

								<button type="submit" class="btn btn-primary waves-effect waves-light sub1">Update Profile</button>
							</div> -->
							
							
							<div class="tab-pane" id="tabCont5">
                                
                                <div class="col-md-3">
												<label class="form-label label_font"></label>
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
					<!-- <?php echo form_close(); ?> -->
				</div>

				<!-- <div class="card-footer">

				</div> -->
			</div>
		</div>

		<!-- /Col -->
	</div>

	<!-- row closed -->
</div>
<?= $footer; ?>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script type="text/javascript">
	$('document').ready(function () {

		// $('.iti__selected-flag .iti__flag').removeClass('iti__us').addClass('iti__ls');

		$('.iti__selected-flag .iti__flag').removeClass('iti__us').addClass('iti__ls');
		var cc = $('#country_code').val();
		var ccf = cc.split('-');
		var input = document.querySelector("#phone");
		intlTelInput(input, {
			initialCountry: ccf[0]
		});
		//$('.iti__selected-flag .iti__flag').addClass('iti__'+ccf[0]);


		/* $('#country-listbox li').click(function() {
			 var country_code = $(this).data("dial-code");
			 $('#country_code').val(country_code);
			 //alert($(".iti__selected-flag").attr('title'));
			 //var tdTitleAttr = $(your-td-element).attr('title');
		 });*/

		$("#country-listbox li").focusout(function () {
			var country_code = $(this).data("dial-code");
			var country_code_flag = $(this).data("country-code");
			//alert(country_code_flag+'-'+country_code);
			$('#country_code').val(country_code_flag + '-' + country_code);
		});

		if ($('#tbl_business_details_id').val() == '' || $("#tbl_business_details_email").val() == '') {
			$('.business_details_edit').show();
			$('.business_details_show').hide();
			$('.product_services_edit').show();
			$('.product_services_show').hide();
			$(".sub5").show();
		} else {
			$(".tabCont2").show();
			$('.business_details_edit').hide();
			$('.business_details_show').show();
			$('.product_services_edit').hide();
			$('.product_services_show').show();
			$(".sub5").hide();
		}
		
		$('.tabCont2').click(function () {
			$('.nav-tabs a[href="#tabCont2"]').tab('show');
		});

		$(".teams").hide();
		$(".teamdt").hide();
		$(".sub").show();
		$(".addnewpartner").show();
		$(".sub1").hide();
		$(".partner_edit_table_row").hide();
        $(".partner_update").hide();	

		$('.edit_biz').click(function () {
			//$("input").removeClass("textbox-border-hide");
			$(".sub5").show();
			$('.business_details_edit').show();
			$('.business_details_show').hide();
			$('.close_biz').show();
			$('.edit_biz').hide();

		});

		$('.close_biz').click(function () {
			$('.business_details_edit').hide();
			$('.business_details_show').show();
			$('.edit_biz').show();
			$('.close_biz').hide();
		});


        $('.edit_product_services').click(function() {
            //$("input").removeClass("textbox-border-hide");
            $(".sub5").show();
            $('.product_services_show').hide();
            $('.product_services_edit').show();
            $('.close_product_services').show();
            $('.edit_product_services').hide();

        });

        $('.close_product_services').click(function() {
            $('.product_services_show').show();
            $('.product_services_edit').hide();
            $('.edit_product_services').show();
            $('.close_product_services').hide();
            $('.sub5').hide();
        });

        $('.edit_business_partners').click(function() {
            //$("input").removeClass("textbox-border-hide");
            $(".sub5").show();
            $('.edit_business_partners').hide();
            $('.close_business_partners').show();
            $('.partner_edit_table_row').show();
            $('.partner_show_table_row').hide();
            $(".addnewpartner").hide();

        });

        $('.close_business_partners').click(function() {
            $(".sub5").hide();
            $('.edit_business_partners').show();
            $('.close_business_partners').hide();
            $('.partner_edit_table_row').hide();
            $('.partner_show_table_row').show();
            $(".addnewpartner").show();
        });

		$('#tbl_business_details_employees').keyup(function () {
			//alert($(this).val());
			if ($(this).val() != 0) {
				//alert('if');
				$(".one").prop('checked', true);
				$(".teamdt").show();
				$(".teams").show();
				/*$(".sub").hide();
				$(".sub1").show();*/

			} else {
				$(".zero").prop('checked', true);
				$(".teamdt").hide();
				$(".teams").hide();
				/* $(".sub").show();
				 $(".sub1").hide();*/
			}
		});

		var radioValue = $("input[name='tbl_business_details_areyouteam']:checked").val();
		if (radioValue == 1) {

			$(".teamdt").show();
			$(".teams").show();
			/*$(".sub").hide();
			$(".sub1").show(); */
		} else {

			$(".teamdt").hide();
			$(".teams").hide();
			/*$(".sub").show();
			$(".sub1").hide();*/

		}
		$("input[name='tbl_business_details_areyouteam']").click(function () {
			var radioValue = $(this).val();

			if (radioValue == 1) {
				$(".teamdt").show();
				$(".teams").show();
				/*$(".sub").hide();
				$(".sub1").show();*/

			} else {
				$(".teamdt").hide();
				$(".teams").hide();
				/* $(".sub").show();
				 $(".sub1").hide();*/
			}
		});
	});
</script>
<script type="text/javascript">
	$(document).ready(function () {

		$("#btnAdd").bind("click", function () {
			//alert('click');
			var div = $("<tr />");
			div.html(GetDynamicTextBox(""));
			$("#TextBoxContainer").append(div);

		});
		$("body").on("click", ".remove", function () {

			$(this).closest("tr").remove();

		});
	});

	function GetDynamicTextBox(value) {
		return '<td><input name="tbl_smme_teams_first_name[]" class="sku form-control" id="tbl_smme_teams_first_name" type="text"  placeholder="Enter First Name"></td><td><input  name="tbl_smme_teams_last_name[]" class="form-control" id="tbl_smme_teams_last_name" type="text" placeholder="Enter Last Name"></td><td><input name="tbl_smme_teams_email[]" class="gst form-control" id="tbl_smme_teams_email"  type="email" placeholder="Enter Emailid" required></td><td><input name="tbl_smme_teams_mobile[]" class="qty form-control" id="tbl_smme_teams_mobile"  type="tel" placeholder="Enter Mobile No." required></td><td><button type="button" class="btn btn-danger remove" data-toggle="tooltip" data-original-title="Remove" style="float: right;padding: 4px 10px;"><i class="typcn typcn-archive icon_margin_remove font_size"></i></button></td>';
	}
</script>
<script type="text/javascript">
	$('#tbl_business_details_industry').change(function () {
		//alert($(this).val());
		var ind_id = $(this).val();
		jQuery.ajax({
			type: "POST",
			url: "<?=base_url()?>bdsp/BusinessDetails/get_sub_industries",
			dataType: 'text',
			data: {ind_id: ind_id},
			success: function (data) {
				var obj = JSON.parse(data);
				//console.log(obj);
				var html = '';
				$.each(obj, function (index, value) {
					html += '<option value="' + value.tbl_sub_industry_id + '">' + value.tbl_sub_industry_name + '</option>';
				});
				$('#tbl_business_details_subindustry').html(html);
			}
		});
	});
</script>
<script type="text/javascript">
	var ind_id = $('#ind').val();
	var sub_ind = $('#sub_ind').val();
	//alert(sub_ind);
	jQuery.ajax({
		type: "POST",
		url: "<?=base_url()?>bdsp/BusinessDetails/get_sub_industries",
		dataType: 'text',
		data: {ind_id: ind_id},
		success: function (data) {
			var obj = JSON.parse(data);
			//console.log(obj);
			var html = '';
			$.each(obj, function (index, value) {
				if (value.tbl_sub_industry_id == sub_ind) {
					html += '<option value="' + value.tbl_sub_industry_id + '" selected>' + value.tbl_sub_industry_name + '</option>';
				} else {
					html += '<option value="' + value.tbl_sub_industry_id + '">' + value.tbl_sub_industry_name + '</option>';
				}
			});
			$('#tbl_business_details_subindustry').html(html);
		}
	});
</script>
</body>
</html>