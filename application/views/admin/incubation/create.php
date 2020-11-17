<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?= $header; ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<div class="container">
	<div class="breadcrumb-header justify-content-between">
		<div>
			<h4 class="content-title mb-2">General Settings</h4>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= site_url('admin/home') ?>">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="<?= site_url('admin/incubation/Incubation/index') ?>">Incubator Programme</a></li>
					<li class="breadcrumb-item active" aria-current="page">New Incubator Programme</li>
				</ol>
			</nav>
		</div>
		<div class="my-auto breadcrumb-right">
							<a href="<?= site_url('admin/incubation/Incubation/index') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-arrow-circle-left mr-2"></i></span><span class="btn-text">Go Back </span></button></a>
							<a href="<?= site_url('admin/Home/profile') ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Personal Details </span></button></a>
							<button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-question-circle mr-2"></i> </span><span class="btn-text">Help </span></button>
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
						<?php echo form_open_multipart("admin/incubation/Incubation/create", 'class="login" data-toggle="validator"'); ?>

						<div class="row">
							<div class="col-sm-6" style="padding-top:5px;">
								<label for="">Enter Incubator Name</label>
								<input type="text" name="title" placeholder="Name" class="form-control"/>
							</div>
							<div class="col-sm-6">
								<label for="">Enter Incubator Description</label>
								<textarea name="description" placeholder="Description" class="form-control ckeditor" rows="2"></textarea>
							</div>
							<div class="col-sm-6" style="padding-top:5px;">
								<label for="">Physical Address</label>
								<input type="text" name="address" placeholder="Address" class="form-control"/>
							</div>
							<div class="col-sm-6" style="padding-top:5px;">
								<label for="">Telephone Number</label>
								<input type="number" name="phone" placeholder="Phone" class="form-control"/>
							</div>
							<div class="col-sm-6" style="padding-top:5px;">
								<label for="">Assign Incubator Manager</label>
								<select id="incubators" name="incubators[]" multiple class="form-control">
									<?php if ($incubators) {
										foreach ($incubators as $incubator) {
											echo "<option value='{$incubator->id}'>{$incubator->name} {$incubator->last_name}</option>";
										}
									} ?>
								</select>
							</div>
							<div class="col-sm-6" style="padding-top:5px;">
								<label for="">Assign bdsp, Coaches or Mentors</label>
								<select id="coaches" name="coaches[]" multiple class="form-control">
									<?php if ($coaches) {
										foreach ($coaches as $coach) {
											echo "<option value='{$coach->id}'>{$coach->name} {$coach->last_name}</option>";
										}
									} ?>
								</select>
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
<script>
	$("#incubators").select2()
	$("#coaches").select2()
</script>
