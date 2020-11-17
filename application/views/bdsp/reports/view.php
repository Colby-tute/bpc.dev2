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
					<li class="breadcrumb-item active" aria-current="page">View Evaluation</li>
				</ol>
			</nav>
		</div>
		
		<div class="my-auto breadcrumb-right">
			<button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-envelope mr-2"></i></span><span class="btn-text">Email </span></button>
			<button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-print mr-2"></i> </span><span class="btn-text">Print </span></button> 
			<a class="btn btn-success mr-0" href="<?= site_url('bdsp/Reports/create') ?>"><span
					class="icon-label"></span><span class="btn-text">Evaluate </span></a>
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

							<div class="col-sm-12" style="margin-bottom: 20px">
								<h4>Report about <?= $user->tbl_users_firstname ?> <?= $user->tbl_users_lastname ?></h3>
							</div>

							<div class="col-sm-12">

								<label><strong>Shared services/equipment and office space offered by the Incubator</strong></label>
								<p><?= $evaluation->services ?></p>
								<hr>
							</div>

							<div class="col-sm-12">

								<label><strong>Relevant Training / Workshops offered by the Incubator</strong></label>
								<p><?= $evaluation->rel_train ?></p>
								<hr>
							</div>

							<div class="col-sm-12">

								<label><strong>Networking opportunities created by the Incubator</strong></label>
								<p><?= $evaluation->network ?></p>
								<hr>
							</div>

							<div class="col-sm-12">

								<label><strong>Incubator's responsiveness to requests by BDSP / MSME</strong></label>
								<p><?= $evaluation->respnosive ?></p>
								<hr>
							</div>

							<div class="col-sm-12">

								<label><strong>Relevant and updated information in Knowledge Bank</strong></label>
								<p><?= $evaluation->rel_and_upd ?></p>
								<hr>
							</div>

							<div class="col-sm-12">

								<label><strong>Professionalism of Incubator's infrastructure and office space</strong></label>
								<p><?= $evaluation->prof ?></p>
								<hr>
							</div>

							<div class="col-sm-12">

								<label><strong>Professionalism of Incubator's staff</strong></label>
								<p><?= $evaluation->prof_staff ?></p>
								<hr>
							</div>


							<div class="col-sm-12">

								<label><strong>Comment</strong></label>
								<p><?= $evaluation->comment ?></p>

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
