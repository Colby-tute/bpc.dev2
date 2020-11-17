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
					<li class="breadcrumb-item"><a href="<?= site_url('incubator/Operations/allbdsp') ?>">BDSP, Coaches & Mentors</a></li>
					<li class="breadcrumb-item active" aria-current="page">Service Assignments</li>
				</ol>
			</nav>

		</div>
		<div class="my-auto breadcrumb-right">
							<a href="<?= site_url('incubator/Operations/allbdsp') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-arrow-circle-left mr-2"></i></span><span class="btn-text">Go Back </span></button></a>
							<a href="<?= site_url('incubator/Profile/view_profile/'.$this->session->userdata('id_user')) ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Personal Details </span></button></a>
							<button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-question-circle mr-2"></i> </span><span class="btn-text">Help </span></button>
						</div>
	</div>

	<div class="">
	
	            <!-- row opened -->
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                       <div class="card-body">
					   
					   
					   
                            <div class="form-group ">
                                    <div class="row">
									 <div class="col-md-12">
									
									<p><?php if ($this->session->flashdata('danger')) { ?>
						<div id="infoMessage"
							 class="alert alert-danger mt25"><?php echo $this->session->flashdata('danger'); ?></div>
						<?php } else if ($this->session->flashdata('success')) { ?>
							<div id="infoMessage" class="alert alert-success mt25"><?php echo $this->session->flashdata('success'); ?></div>
						<?php }
						?>
						</p>
								<?php	foreach ($bdspdata as $row2) { 
							$fullname=$row2->tbl_users_firstname . " " . $row2->tbl_users_lastname;
							$id=$row2->tbl_users_id;
						} ?>
						
						  <?php echo form_open_multipart("incubator/Operations/UpdateAssignedSmme/".$id, 'class="login" data-toggle="validator"'); ?>	
									</div>
								</div>
</div>								
									<div class="form-group ">
                                    <div class="row">
									 <div class="col-md-4">
									 <h4><?php echo $fullname ?></h4>
									 </div>
</div>
</div>									
									 
									 
									 
									 
									 
									 <div class="form-group ">
                                    <div class="row">
									
                                        <div class="col-md-3">
                                            <label class="form-label">
											Select the MSME profile you would like to assign <b><?php echo $fullname ?></b> to for services</label>
                                        </div>
                                        <div class="col-md-5">
                                            <select name="stage" id="stage" class="form-control" >
							<option value="">---</option>
								<?php
								if (isset($tdata)) {
									foreach ($tdata as $row) {										
										$fullname=$row->tbl_users_firstname . " " . $row->tbl_users_lastname." | MSME-".$row->tbl_users_user_uniqueid; 	
										echo "<option  value='{$row->tbl_users_id}'>{$fullname}</option>";
									};	
								}
								?>
						</select>
                                        </div>
                                    </div>
                                </div>
                               
                               
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <!-- row closed -->
	
	
	</div>
</div>
<?= $footer; ?>
