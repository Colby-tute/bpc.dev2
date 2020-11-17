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
			<h4 class="content-title mb-2">Applications 
				
			</h4>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= site_url('admin/Home') ?>">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="<?= site_url('admin/smme/Application') ?>">Applications</a></li>
					<li class="breadcrumb-item active" aria-current="page"><?= $userdt[0]->tbl_users_firstname;?> <?= $userdt[0]->tbl_users_lastname; ?> /
				MSME-<?= $userdt[0]->tbl_users_user_uniqueid; ?></li>
				</ol>
			</nav>

		</div>
		<?php 
		if($userdt[0]->stage != "Approved" && $userdt[0]->stage != "Incubation") {
			?>
			<div class="my-auto breadcrumb-right">

				<a style="color: white" class="btn btn-success statuscheck" data-status="Approved" data-id="<?php echo $app_id; ?>">Approve</a>&nbsp;<a style="color: white"
						class="btn btn-warning statuscheck" href="#" data-id="<?php echo $app_id; ?>"
						data-status="Declined">Decline</a>
			</div>
		<?php 
		}
		?>
		<a href="<?= site_url('admin/smme/Application') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-arrow-circle-left mr-2"></i></span><span class="btn-text">Go Back </span></button></a>
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

		foreach ($edit_data as $key => $value) {
		}

		foreach ($bdsp_incubator_smme_name as $key => $bs_ic_smme) {
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
									<a class="nav-link" data-toggle="tab" href="#tabCont4">Incubator | BDSP | Coaches |
										Mentors</a>
											<a class="nav-link" data-toggle="tab" href="#tabCont5">MSME Staff Members</a>
										
								</nav>
							</div>
							<div class="card-body tab-content">

								<div class="tab-pane active" id="tabCont1">
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label label_font">MSME Full Name</label>
												<b class="b_font"><?php if (!empty($bdsp_incubator_smme_name)) {
														echo $bs_ic_smme->smme_firstname . ' ' . $bs_ic_smme->smme_lastname;
													} ?></b>
												<label id="smme_id" hidden><?= $id ?></label>
											</div>
											<div class="col-md-3">
												<label class="form-label label_font">Preferred Incubator</label>
												<b class="b_font"><?php if (!empty($bdsp_incubator_smme_name)) {
														echo $bs_ic_smme->inc_firstname . ' ' . $bs_ic_smme->inc_lastname;
													} ?></b>
											</div>
											<div class="col-md-3">
												<label class="form-label label_font">Preferred BDSP | Coach | Mentor</label>
												<b class="b_font"><?php if (!empty($bdsp_incubator_smme_name)) {
														echo $bs_ic_smme->bdsp_firstname . ' ' . $bs_ic_smme->bdsp_lastname;
													} ?></b>
											</div>
											<div class="col-md-3">
												<label class="form-label label_font">Incubation Application Date</label>
												<b class="b_font"><?php if (!empty($bdsp_incubator_smme_name)) {
														echo $bs_ic_smme->tbl_application_insertdate;
													} ?></b>
											</div>
										</div>
									</div>

									<div class="form-group">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label label_font">Application Status</label>
												<b class="b_font"><?php if (!empty($userdt)) {
														echo $user->stage;
													} ?></b>
											</div>
											<div class="col-md-3">
												<label class="form-label label_font">Application pproval Date</label>
												<b class="b_font"><?php if (!empty($bdsp_incubator_smme_name)) {
														echo $bs_ic_smme->tbl_application_admin_approve_date;
													} ?></b>
											</div>
											<div class="col-md-3">
												<label class="form-label label_font">Application Support Document</label>
												<a class="b_font"
												   href="<?php echo base_url(); ?>assets/Application/Motivation_Letter/<?php echo $value->tbl_application_motivation_letter; ?>"
												   target="_blank">Download file <i class="fa fa-download"></i></a>
											</div>
										</div>
									</div>

									<div class="form-group ">
										<div class="row">
											<div class="col-md-12">
												
												<table class="table text-md-nowrap" id="example1">
													<thead>
													<tr>
														<th class="wd-10p border-bottom-0">PID</th>
														<th class="wd-90p border-bottom-0">MSME Business Documents</th>
													</tr>
													</thead>
													<tbody>
													<?php
													$count = count($select_mul_doc);
													for ($i = 0; $i < $count; $i++) { ?>
														<tr>
															<td><?php echo $i + 1; ?></td>
															<td>
																<a href="<?php echo base_url(); ?>assets/Application/Business_Document/<?php echo $select_mul_doc[$i]->tbl_business_document_document; ?>"
																   target="_blank"><?php echo $select_mul_doc[$i]->tbl_business_document_document; ?></a>
															</td>
														</tr>
													<?php }
													?>
													</tbody>
												</table>
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
													<label class="form-label label_font">Business Email Address</label>
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
												<div class="col-md-3">
													<label class="form-label label_font">MSME Investment Need</label>
													<b class="b_font">M
														<?php if (!empty($business)) {
															echo $buss->tbl_business_details_investmant_need;
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
													<label class="form-label label_font">Business Sub Industry</label>
													<b class="b_font">
														<?php
														if (!empty($business)) {
															echo $buss->tbl_sub_industry_name;
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
													<label class="form-label label_font">Do you have a team?</label>
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
														$mobile = '+' . $code . '' . $user->tbl_users_mobile;
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
												<label class="form-label label_font">How did you know about the VBI?</label>
												<b class="b_font"><?php if (!empty($personal)) {
														echo $per->tbl_personal_details_howdidyouknow;
													} ?></b>
											</div>
											<div class="col-md-3">
												<label class="form-label label_font">Eduction</label>
												<b class="b_font"><?php if (!empty($personal)) {
														echo $per->tbl_personal_details_education;
													} ?></b>
											</div>
											<div class="col-md-3">
												<label class="form-label label_font">Eduction</label>
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
									<div class="business_details_show">
										<?php echo form_open_multipart("admin/smme/Application/view/".$app_id."/".$id, 'class="login" data-toggle="validator"'); ?>
										<div class="row">
											<div class="col-sm-6">
												<label class="form-label">Incubator</label>
												<select name="incubators[]" single id="inc-select" class="form-control">
													<?php if ($incubators) {
														foreach ($incubators as $incubator) {
															echo "<option ".(in_array($incubator->id, $selectedIncubators) ? "selected" : "")." value='{$incubator->id}'>{$incubator->name} {$incubator->last_name}</option>";
														}
													} ?>
												</select>
											</div>
											<div class="col-sm-6">
												<label class="form-label">BDSP | Coaches | Mentors</label>
												<select name="coaches[]" multiple id="bdsp-select" class="form-control">
													<?php if ($bdsps) {
														foreach ($bdsps as $bdsp) {
															echo "<option ".(in_array($bdsp->id, $selectedBdsps) ? "selected" : "")." value='{$bdsp->id}'>{$bdsp->name} {$bdsp->last_name}</option>";
														}
													} ?>
												</select>
											</div>
										</div>
										<div class="row" style="margin-top: 15px">
											<div class="col-sm-12">
												<button class="btn btn-primary">Update</button>
											</div>
										</div>
										<?php echo form_close() ?>
									</div>
								</div>
								
								<div class="tab-pane" id="tabCont5">
								
										<div class="col-md-12 team">
											<div class="row ">
												<section class="container col-xs-12">
													<div class="table table-responsive">
														<!--<label class="form-label" style="font-size: 16px;">Staff</label> -->
														<table class="table text-md-nowrap" id="example2"
															   style="width: 100%;">
															<thead>
															<tr>
																<th>PID</th>
																<th class="wd-15p border-bottom-0">First Name</th>
																<th class="wd-15p border-bottom-0">Last Name</th>
																<th class="wd-25p border-bottom-0">Email Address</th>
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
