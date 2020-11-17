<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>
<?= $header; ?>

<div class="container">
	<div class="breadcrumb-header justify-content-between">
		<div>
			<h4 class="content-title mb-2">Operations</h4>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= site_url('incubator/home') ?>">Dashboard</a></li>
					<li class="breadcrumb-item active" aria-current="page">MSME Management</li>
				</ol>
			</nav>

		</div>
		<div class="my-auto breadcrumb-right">
							<a href="incubator/Application" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-bell mr-2"></i></span><span class="btn-text">Status </span></button></a>
							<a href="<?= site_url('incubator/Profile/view_profile/'.$this->session->userdata('id_user')) ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Personal Details </span></button></a>
							<button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-question-circle mr-2"></i> </span><span class="btn-text">Help </span></button>
						</div>
	</div>

	<div class="">
		<!-- row opened -->
		<div class="row row-sm">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
				<div class="card">
					<div class="card-body iconfont text-left">
						<p><?php if ($this->session->flashdata('danger')) { ?>
						<div id="infoMessage"
							 class="alert alert-danger mt25"><?php echo $this->session->flashdata('danger'); ?></div>
						<?php } else if ($this->session->flashdata('success')) { ?>
							<div id="infoMessage"
								 class="alert alert-success mt25"><?php echo $this->session->flashdata('success'); ?></div>
						<?php }
						?>
						</p>
						<div class="table-responsive">
						<?php	foreach ($bdspdata as $row2) { 
							$fullname=$row2->tbl_users_firstname . " " . $row2->tbl_users_lastname;
							$id=$row2->tbl_users_id;
						} ?>
						
						  <?php echo form_open_multipart("incubator/Operations/UpdateAssignedSmme/".$id, 'class="login" data-toggle="validator"'); ?>
                                      
						
						<div><label>BDSP Name:</label><label><?php echo $fullname ?></label></div>
					
							<!-- <table id="example" class="table key-buttons text-md-nowrap"> -->
							<select name="stage" id="stage" class="form-control" >
							<option value="">Select MSME</option>
								<?php
								if (isset($tdata)) {
									foreach ($tdata as $row) {										
										$fullname=$row->tbl_users_firstname . " " . $row->tbl_users_lastname; 	
										echo "<option  value='{$row->tbl_users_id}'>{$fullname}</option>";
									};	
								}
								?>
						</select>
						</div>
						<div>  <button class="btn btn-primary sub">Submit</button></div>
						 <?php echo form_close(); ?>
					</div>
					
				</div>
			</div>
		</div>
		<!-- row closed -->
	</div>
</div>
<?= $footer; ?>
