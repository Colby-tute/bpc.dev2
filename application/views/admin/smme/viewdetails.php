<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?= $header; ?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet"/>
<style>
	.select2 {
		width: 100% !important;
	}
</style>
<div class="container">
	<div class="breadcrumb-header justify-content-between">
		<div>
			<h4 class="content-title mb-2">View MSME Details
			</h4>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= site_url('admin/Home') ?>">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="<?= site_url('admin/smme') ?>">MSME Management</a></li>
					<li class="breadcrumb-item active" aria-current="page"><?= $userdt[0]->tbl_users_firstname;?>
				<?= $userdt[0]->tbl_users_lastname; ?> /
				MSME-<?= $userdt[0]->tbl_users_user_uniqueid; ?></li>
				</ol>
			</nav>

		</div>
		<!-- Just implementing a different view -->
		<!-- <?php 
		if($userdt[0]->stage != "Approved" && $userdt[0]->stage != "Incubation") {
			?>
			<div class="my-auto breadcrumb-right">

				<a style="color: white" class="btn btn-success statuscheck" data-status="Approved" data-id="<?php echo $app_id; ?>">Approve</a>&nbsp;<a style="color: white"
						class="btn btn-warning statuscheck" href="#" data-id="<?php echo $app_id; ?>"
						data-status="Declined">Decline</a>
			</div>
		<?php 
		}
		?> -->
		
		
		<div class="my-auto breadcrumb-right">
							<a href="<?= site_url('admin/smme') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-arrow-circle-left mr-2"></i></span><span class="btn-text">Go Back </span></button></a>
							<a href="<?= site_url('admin/Home/profile') ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Personal Details </span></button></a>
							<button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-question-circle mr-2"></i> </span><span class="btn-text">Help </span></button>
						</div>
		
		
		
		
		
		
		
		
		
		
		
		
	</div>

	<div class="">
		<!-- row opened -->
		<?php 
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
		
		foreach ($application as $key => $appli) {
			# code...
		}
		
		foreach ($coachname as $key => $coach) {
			# code...
		}

		foreach ($incucoachname as $key => $incucoach) {
			# code...
		}

		?>
		<div class="row row-sm">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
				<div class="card">
					<div class="card-body iconfont text-left">
						<div class="border">
							<div class="bg-gray-300 nav-bg">
								<nav class="nav nav-tabs">
									<a class="nav-link active" data-toggle="tab" href="#tabCont1">MSME Summary</a>
									<a class="nav-link" data-toggle="tab" href="#tabCont2">MSME Business Details</a>
									<a class="nav-link" data-toggle="tab" href="#tabCont3">MSME Personal Details</a>
									<a class="nav-link" data-toggle="tab" href="#tabCont4">Incubator Manager</a>
									<a class="nav-link" data-toggle="tab" href="#tabCont5">Business Documents</a>
									<a class="nav-link" data-toggle="tab" href="#tabCont6">MSME Staff Members</a>
								</nav>
							</div>
							<div class="card-body tab-content">

								<div class="tab-pane active" id="tabCont1">
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label label_font">MSME Full Name</label>
											<b class="b_font"><?php if (!empty($userdt)) {
														echo $user->tbl_users_firstname.' '.$user->tbl_users_lastname;
													} ?></b>
												<label id="smme_id" hidden><?= $id ?></label>
											</div>
											<div class="col-md-3">
													<label class="form-label label_font">Business Name</label>
													<b class="b_font">
														<?php
														if (!empty($business)) {
															echo $buss->tbl_business_details_name;
														} else {
															echo '[Unspecified]';
														}
														?></b>
												</div>
												<div class="col-md-3">
												<label class="form-label label_font">Business Start Date</label>
												<b class="b_font"><?php if (!empty($business)) {
															echo $buss->tbl_business_details_date_hired;
														} else {
															echo "[Unspecified]";
														} ?></b>
											</div>
											<div class="col-md-3">
												<label class="form-label label_font">MSME Mobile Number</label>
												<?php
												if (!empty($userdt)) {
													if ($user->tbl_users_mobile != '') {
														if ($user->tbl_users_contrycode != '') {
															$exp = explode('-', $user->tbl_users_contrycode);
															/*print_r($exp);*/
															$code = $exp[1];
														} else {
															$code = '';
														}
														$mobile = '(+' . $code . ')' . $user->tbl_users_mobile;
													} else {
														$mobile = '';
													}
												}
												?>
												<b class="b_font"><?php echo $mobile; ?></b>
											</div>
											
											
										</div>
									</div>

									<div class="form-group">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label label_font">Business Incubation Status</label>
												<b class="b_font"><?php if (!empty($userdt)) {
														echo $user->stage;
													} ?></b>
											</div>
											<div class="col-md-3">
												<label class="form-label label_font">Incubation Application Date</label>
																								
												<b class="b_font"><?php if (!empty($application)) {
															echo $appli->tbl_application_insertdate;
														} else {
															echo "[Unspecified]";
														} ?></b>
											</div>
											
											<div class="col-md-3">
												<label class="form-label label_font">Application Approval Date</label>
												<b class="b_font"><?php if (!empty($application)) {
														echo $appli->tbl_application_admin_approve_date;
													} ?></b>
											</div>
											
											<div class="col-md-3">
												<label class="form-label label_font">BDSP | Coach | Mentor Name</label>
												<b class="b_font"><?php if (!empty($coachname)) {
														echo $coach->tbl_users_firstname . ' ' . $coach->tbl_users_lastname;
													} ?></b>
											</div>
											
										</div>
									</div>

								</div>

								<div class="tab-pane" id="tabCont2">
									<div class="business_details_show">
										<div class="form-group">
											<div class="row">
												<div class="col-md-3">
													<label class="form-label label_font">Business Name</label>
													<b class="b_font">
														<?php
														if (!empty($business)) {
															echo $buss->tbl_business_details_name;
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
															echo $buss->tbl_industry_name;
														} else {
															echo "[Unspecified]";
														} ?>
													</b>
												</div>

												<div class="col-md-3">
													<label class="form-label label_font">Business Email</label>
													<b class="b_font">
														<?php if (!empty($business)) {
															echo $buss->tbl_business_details_email;
														} else {
															echo "[Unspecified]";
														} ?>
													</b>
												</div>

												<div class="col-md-3">
													<label class="form-label label_font">Business Phone Number</label>
													<b class="b_font">
														<?php if (!empty($business)) {
															echo $buss->tbl_business_details_phone;
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
													<label class="form-label label_font">Business District</label>
													<b class="b_font">
														<?php if (!empty($business)) {
															echo $buss->tbl_business_details_district;
														} else {
															echo "[Unspecified]";
														} ?>
													</b>
												</div>

												<div class="col-md-3">
													<label class="form-label label_font">Business Town/Village</label>
													<b class="b_font">
														<?php if (!empty($business)) {
															echo $buss->tbl_business_details_town_village;
														} else {
															echo "[Unspecified]";
														} ?>
													</b>
												</div>

												<div class="col-md-3">
													<label class="form-label label_font">MSME Investment Required</label>
													<b class="b_font">M
														<?php if (!empty($business)) {
															echo $buss->tbl_business_details_investmant_need;
														} else {
															echo "[Unspecified]";
														} ?>
													</b>
												</div>
												
												<div class="col-md-3">
													<label class="form-label label_font">Business Incubator Funding</label>
													<b class="b_font">M
														<?php if (!empty($business)) {
															echo $buss->tbl_business_details_revenue_raised;
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
													<label class="form-label label_font">Does MSME work in a team?</label>
													<b class="b_font">
														<?php
														if (!empty($business) && $buss->tbl_business_details_areyouteam == '1') {
															echo "Yes";
														} else {
															echo "No";
														}
														?>
													</b>
												</div>
												
												<div class="col-md-3">
													<label class="form-label label_font">Business Sub-industry</label>
													<b class="b_font">
														<?php
														if (!empty($business)) {
															echo $buss->tbl_sub_industry_name;
														} else {
															echo "[Unspecified]";
														} ?>
													</b>
												</div>
												
												<div class="col-md-3">
												<label class="form-label label_font">Business Start Date</label>
												<b class="b_font"><?php if (!empty($business)) {
															echo $buss->tbl_business_details_date_hired;
														} else {
															echo "[Unspecified]";
														} ?></b>
											</div>
												
												<div class="col-md-3">
													<label class="form-label label_font">Corporate Logo</label>
													<b class="b_font">
														<?php if (!empty($business)) {
															echo "<img src='".base_url().'assets/users/'.$buss->tbl_business_details_business_logo."' width='100' />";
															
														} else {
															echo "[Unspecified]";
														} ?>
													</b>
												</div>

											</div>
										</div>

										
									</div>
								</div>

								<div class="tab-pane" id="tabCont3">
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label label_font">First Name</label>
												<b class="b_font"><?php if (!empty($userdt)) {
														echo $user->tbl_users_firstname;
													} ?></b>
											</div>
											<div class="col-md-3">
												<label class="form-label label_font">Last Name</label>
												<b class="b_font"><?php if (!empty($userdt)) {
														echo $user->tbl_users_lastname;
													} ?></b>
											</div>
											<div class="col-md-3">
												<label class="form-label label_font">Mobile Number</label>
												<?php
												if (!empty($userdt)) {
													if ($user->tbl_users_mobile != '') {
														if ($user->tbl_users_contrycode != '') {
															$exp = explode('-', $user->tbl_users_contrycode);
															/*print_r($exp);*/
															$code = $exp[1];
														} else {
															$code = '';
														}
														$mobile = '(+' . $code . ')' . $user->tbl_users_mobile;
													} else {
														$mobile = '';
													}
												}
												?>
												<b class="b_font"><?php echo $mobile; ?></b>
											</div>
											<div class="col-md-3">
												<label class="form-label label_font">Optional Phone Number</label>
												<b class="b_font"><?php if (!empty($personal)) {
														echo $per->tbl_personal_details_optional_telephone;
													} ?></b>
											</div>
										</div>
									</div>

									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label label_font">Gender</label>
												<b class="b_font">
													<?php
													if (!empty($userdt)) {
														if ($user->tbl_users_gender == 'M') {
															echo "Male";
														} elseif ($user->tbl_users_gender == 'F') {
															echo "Female";
														} else {
															echo "others";
														}
													}
													?>
												</b>
											</div>
											<div class="col-md-3">
												<label class="form-label label_font">How did MSME Know?</label>
												<b class="b_font"><?php if (!empty($personal)) {
														echo $per->tbl_personal_details_howdidyouknow;
													} ?></b>
											</div>
											<div class="col-md-3">
												<label class="form-label label_font">Occupation</label>
												<b class="b_font"><?php if (!empty($personal)) {
														echo $per->tbl_personal_details_occupation;
													} ?></b>
											</div>
											<div class="col-md-3">
												<label class="form-label label_font">Education</label>
												<b class="b_font"><?php if (!empty($personal)) {
														echo $per->tbl_personal_details_education;
													} ?></b>
											</div>
										</div>
									</div>

									<div class="form-group">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label label_font">Date of Birth</label>
												<b class="b_font"><?php if (!empty($personal)) {
														echo $per->tbl_personal_details_dob;
													} ?></b>
											</div>
											<div class="col-md-3">
												<label class="form-label label_font">District</label>
												<b class="b_font"><?php if (!empty($personal)) {
														echo $per->tbl_personal_details_district;
													} ?></b>
											</div>
											<div class="col-md-3">
												<label class="form-label label_font">Town/Village</label>
												<b class="b_font"><?php if (!empty($personal)) {
														echo $per->tbl_personal_details_town_village;
													} ?></b>
											</div>
											<div class="col-md-3">
												<label class="form-label label_font">Post Code</label>
												<b class="b_font"><?php if (!empty($personal)) {
														echo $per->tbl_personal_details_postcode;
													} ?></b>
											</div>
										</div>
									</div>
									
									
								</div>

								<div class="tab-pane" id="tabCont4">
								
								<div class="alert alert-success" role="alert">
		<button aria-label="Close" class="close" data-dismiss="alert" type="button">
		   <span aria-hidden="true">&times;</span>
	  </button>
		<strong>Incubator Manager!</strong> <br /> The entity managing the current MSME's incubation or business acceleration processes.
	</div>
								<div class="col-md-3">
												<label class="form-label label_font">Incubator Full Name</label>
												<b class="b_font"><?php if (!empty($incucoachname)) {
														echo $incucoach->tbl_users_firstname . ' '. $incucoach->tbl_users_lastname;
													} ?></b>
													
											</div>
											
								
								
								
								
								
																	</div>
																	<div class="tab-pane" id="tabCont5">
																	
																	
																	<div class="form-group ">
										<div class="row">
											<div class="col-md-12">
												
												<table class="table text-md-nowrap dataTable no-footer" id="example1" role="grid" aria-describedby="example1_info">
													<thead>
													<tr>
														<th class="wd-10p border-bottom-0">PID</th>
														<th class="wd-90p border-bottom-0">MSME Business Documents</th>
													</tr>
													</thead>
													<tbody>
													<!--<?php
													$i=0;
													foreach($businessdoc as $row) { 
													 if($row->tbl_all_documents_document !="" || $row->tbl_all_documents_document != null){
													?> -->
														<tr>
															<td><?php echo $i + 1; ?></td>
															<td>
																<a href="<?php echo base_url(); ?>assets/Application/Business_Document/<?php echo $row->tbl_all_documents_document; ?>"
																   target="_blank"><?php echo $row->tbl_all_documents_title; ?></a>
															</td>
														</tr>
													<!--<?php } }
													?> -->
													</tbody>
												</table>
											</div>
										</div>
									</div>
																	</div>
																	
																	
																	
																	<div class="tab-pane" id="tabCont6">
																	
																	<div class="col-md-12 team">
											<div class="row ">
												<section class="container col-xs-12">
													<div class="table table-responsive">
														
														<table class="table text-md-nowrap" id="example2"
															   style="width: 100%;">
															<thead>
															<tr>
																<th>PID</th>
																<th class="wd-15p border-bottom-0">First Name</th>
																<th class="wd-15p border-bottom-0">Last Name</th>
																<th class="wd-25p border-bottom-0">Email</th>
																<th class="wd-15p border-bottom-0">Mobile Number</th>
																<th class="wd-15p border-bottom-0">Gender</th>
																<th class="wd-15p border-bottom-0">Date Hired</th>
															</tr>
															</thead>
															<tbody>
															<?php
															if (!empty($smme_teams)) {
																$i = 1;
																foreach ($smme_teams as $key => $value) {
																	# code...
																	if ($value->tbl_smme_teams_first_name) { ?>
																	<tr>
																		<td>
																			<?php echo $i; ?>
																		</td>
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
																		<td>
																			<?php echo $value->tbl_smme_teams_date_hired; ?>
																		</td>
																	</tr>
																	<?php  }
																	$i++;																
																}//foreach
															}
															?>
															</tbody>
														</table>
													</div>
												</section>
											</div>
										</div>
																	
																	
																	
																	
																	
																	
																	</div>

							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		<!-- row closed -->
	</div>
</div>
<?= $footer; ?>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script type="text/javascript">
	$('document').ready(function () {

		$('.tabCont2').click(function () {
			$('.nav-tabs a[href="#tabCont2"]').tab('show');
		});

		$('.tabCont3').click(function () {
			$('.nav-tabs a[href="#tabCont3"]').tab('show');
		});


	});
</script>

<script type="text/javascript">
	$(document).ready(function () {
		$('.statuscheck').click(function () {
			var id = $(this).data('id');
			var status = $(this).data('status');

			var dataTable = $(".view_history_table").DataTable();
			dataTable.clear().draw();

			var incubators = $('#inc-select').val();
			var coaches = $('#bdsp-select').val();
			var smme_id = $('#smme_id').text();
		

			jQuery.ajax({
				type: "POST",
				url: "<?=base_url()?>admin/smme/Application/stats_change",
				dataType: 'text',
				data: {status: status, id: id, user_id: '<?= $user_id ?>'},
				success: function (data) {
								jQuery.ajax({
									type: "POST",
									url: "<?=base_url()?>admin/smme/Application/update_inc_coaches",
									data: {app_id: id, smme_id: smme_id, newCoaches: coaches, newInc: incubators}
								});
								alert("Application status updated successfully!");
				}

			});


		});

		$("#inc-select").select2()
		$("#bdsp-select").select2()
	});
</script>
