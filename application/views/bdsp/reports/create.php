<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?= $header; ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/css/bootstrap-datepicker.min.css" rel="stylesheet">
<div class="container">
	<div class="breadcrumb-header justify-content-between">
		<div>
			<h4 class="content-title mb-2">Evaluations</h4>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= site_url('bdsp/home') ?>">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="<?= site_url('bdsp/Reports/index') ?>">Evaluations</a></li>
					<li class="breadcrumb-item" aria-current="page">Evaluate</li>
				</ol>
			</nav>
		</div>
		
		<div class="my-auto breadcrumb-right">
			<button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-envelope mr-2"></i></span><span class="btn-text">Email </span></button>
			<button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-print mr-2"></i> </span><span class="btn-text">Print </span></button> 
			<!-- <a class="btn btn-success mr-0" href="<?= site_url('bdsp/Reports/create') ?>"><span
					class="icon-label"></span><span class="btn-text">Evaluate </span></a> -->
		</div>
	</div>

	<div class="">
		<!-- row opened -->
		<div class="row row-sm">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
				<div class="card">
					<div class="card-body iconfont text-left">
						<?php if ($this->session->flashdata('danger')) { ?>
							<div id="infoMessage" class="alert alert-danger"
								 style="margin-top: 25px;"><?php echo $this->session->flashdata('danger'); ?></div>
						<?php } ?>
						<?php echo form_open_multipart("bdsp/Reports/create", 'class="login" data-toggle="validator"'); ?>
						<input type="hidden" name="report[reporter_id]" value="<?= $this->session->userdata('id_user') ?>">
						<div class="row">
							<div class="col-sm-6">
								<label for="">Evaluation Title</label>
								<input type="text" name="report[title]" placeholder="Title" class="form-control"/>
							</div>
							<div class="col-sm-6">
								<label for="">Evaluation Description</label>
								<textarea name="report[description]" placeholder="Description" class="form-control ckeditor" rows="2"></textarea>
							</div>
							<div class="col-sm-6">
								<label for="">SMME</label>
								<select id="incubators" name="report[smme_id]" class="form-control">
									<?php if ($smmes) {
										foreach ($smmes as $smme) {
											echo "<option value='{$smme->tbl_users_id}'>{$smme->tbl_users_firstname} {$smme->tbl_users_lastname}</option>";
										}
									} ?>
								</select>
							</div>
							<div class="col-sm-6">
								<label for="">Date</label>
								<input type="text" class="form-control datepicker" value="" name="report[date]"/>
							</div>
						</div>

						<div class="row mg-t-15">
							<div class="col-sm-12">
								<button class="btn btn-primary sub">Submit</button>
							</div>
						</div>
						<?php echo form_close(); ?>
					</div>

				</div>
			</div>
		</div>
		<!-- row closed -->
	</div>
</div>
<?= $footer; ?>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.min.js"></script>
<script>
	$("#incubators").select2()
	$(".datepicker").datepicker({
		format: "yyyy-mm-dd"
	})
</script>
