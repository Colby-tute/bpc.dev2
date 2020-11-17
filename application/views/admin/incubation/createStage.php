<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?= $header; ?>
<div class="container">

	<!-- breadcrumb -->
	<div class="breadcrumb-header justify-content-between">
		<div>
			<h4 class="content-title mb-2">General Settings</h4>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= site_url('admin/home') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="<?= site_url('admin/incubation/incubation/stages') ?>">Incubation Stages</a></li>
					<li class="breadcrumb-item active" aria-current="page">Create Incubation Stage</li>
				</ol>
			</nav>
		</div>
		<div class="my-auto breadcrumb-right">
							<a href="<?= site_url('admin/smme/Application') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-bell mr-2"></i></span><span class="btn-text">Status </span></button></a>
							<a href="<?= site_url('admin/incubation/Incubation/create') ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Create New Incubator </span></button></a>
							<button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-question-circle mr-2"></i> </span><span class="btn-text">Help </span></button>
</div>
	</div>

	<div class="">
		<!-- row opened -->
		<div class="row row-sm">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
				<div class="card">
					<div class="card-body iconfont text-left">
						<?php echo form_open_multipart("admin/incubation/Incubation/createStage", 'class="login" data-toggle="validator"'); ?>
						<div class="row">
							<div class="col-md-12">
								<label class="form-label">Stage Name</label>
								<input type="text" name="stage" class="form-control">
							</div>
							<div class="col-md-12" style="margin-top: 20px">
								<button class="btn btn-primary sub">Submit</button>
							</div>
						</div>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
<?php echo $footer ?>

