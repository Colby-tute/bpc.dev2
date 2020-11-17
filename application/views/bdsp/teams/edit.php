<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
        <?= $header; ?>
        <div class="container">
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">Business Details</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?= site_url('Home') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('bdsp/team') ?>">Business Team Members</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Member Details</li>
                    </ol>
                </nav>

            </div>
            <div class="my-auto breadcrumb-right">
							<a href="<?= site_url('bdsp/team') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-chevron-circle-left mr-2"></i></span><span class="btn-text">Go Back </span></button></a>
							<a href="<?= site_url('bdsp/Profile/view_profile/'.$this->session->userdata('id_user')) ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Personal Details </span></button></a>
							<button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-question-circle mr-2"></i> </span><span class="btn-text">Help </span></button>
						</div>
            
        </div>

        <div class="">
            <!-- row opened -->
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                        <?php 
                        //print_r($select_mul_doc);
                        foreach ($edit_data as $key => $value) { 
                        echo form_open_multipart("bdsp/team/update/".$value->tbl_smme_teams_id, 'data-toggle="validator"'); ?>
                        <div class="card-body">
							<div class="row">
								<div class="col-md-4 form-group mb-3">
									<label class="form-label">First Name</label>
									<input name="tbl_smme_teams_first_name" class="sku form-control" required id="tbl_smme_teams_first_name" type="text"  placeholder="Enter First Name" value="<?= $value->tbl_smme_teams_first_name; ?>">
									
									<input name="tbl_smme_teams_user_id" class="sku form-control" required id="tbl_smme_teams_user_id" type="hidden"  placeholder="" value="<?= $id_user; ?>">
									
									<input name="tbl_smme_teams_bussiness_id" class="sku form-control" required id="tbl_smme_teams_bussiness_id" type="hidden"  placeholder="" value="<? //= $bussiness_detail[0]->tbl_business_details_id; ?>">
									<input name="tbl_smme_teams_id" class="sku form-control" required id="tbl_smme_teams_id" type="hidden"  placeholder="" value="<?= $tbl_smme_teams_id; ?>">
												   
								</div>

								<div class="col-md-4 form-group mb-3">
									<label class="form-label">Last Name</label>
									<input name="tbl_smme_teams_last_name" class="sku form-control" required id="tbl_smme_teams_last_name" type="text"  placeholder="Enter Last Name" value="<?= $value->tbl_smme_teams_last_name; ?>">
								</div>
								
								<div class="col-md-4 form-group mb-3">
									<label class="form-label">Email Address</label>
									<input name="tbl_smme_teams_email" class="gst form-control" required id="tbl_smme_teams_email" pattern="^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$" type="email" placeholder="Enter Emailid" value="<?= $value->tbl_smme_teams_email; ?>">
								</div>
							</div>
						
							<div class="row">
								<div class="col-md-4 form-group mb-3">
									<label class="form-label">Mobile Number</label>
									<input name="tbl_smme_teams_mobile" class="sku form-control" required id="tbl_smme_teams_mobile" type="tel" maxlength="13" minlength="8" pattern="[0-9]{8,13}" title="Phone Number length should be between 8-13" placeholder="Enter Mobile No." maxlength="10" value="<?= $value->tbl_smme_teams_mobile; ?>">
								</div>
								
								<div class="col-md-4 form-group mb-3">
									<label class="form-label">Gender</label>
									<select id="tbl_smme_teams_gender" class="form-control" name="tbl_smme_teams_gender">
										<option value="Male" <?php echo ($value->tbl_smme_teams_gender == "Male" ? 'selected' : '' );?>>Male</option>
										<option value="Female" <?php echo ($value->tbl_smme_teams_gender == "Female" ? 'selected' : '' );?>>Female</option>
										<option value="Other" <?php echo ($value->tbl_smme_teams_gender == "Other" ? 'selected' : '' );?>>Other</option> 
									</select>
								</div>
								
								<div class="col-md-4 form-group mb-3">
									<label class="form-label">Date Hired</label>
									<input name="tbl_smme_teams_date_hired" class="sku form-control" required id="tbl_smme_teams_date_hired" type="date" placeholder="Enter Hired Date" value="<?= $value->tbl_smme_teams_date_hired; ?>">
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-4 form-group mb-3">
									<label class="form-label">Job Title</label>
									<input name="tbl_smme_teams_job_title" class="sku form-control" required id="tbl_smme_teams_job_title" type="text" placeholder="Enter job Title" value="<?= $value->tbl_smme_teams_job_title; ?>">
								</div>

                                <div class="col-md-4 form-group mb-3">
                                    <label class="form-label">Qualification</label>
                                    <input name="tbl_smme_teams_qualification" class="sku form-control" required id="tbl_smme_teams_qualification" type="text" placeholder="Enter Qualification" value="<?= $value->tbl_smme_teams_qualification; ?>">
                                </div>

                                <div class="col-md-4 form-group mb-3">
                                    <label class="form-label">Experience</label>
                                    <input name="tbl_smme_teams_experience" class="sku form-control" required id="tbl_smme_teams_experience" type="text" placeholder="Enter Experience" value="<?= $value->tbl_smme_teams_experience; ?>">
                                </div>
							</div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Update Details</button>
                        </div>
                        <?php echo form_close(); } ?>
                    </div>
                </div>
            </div>
            <!-- row closed -->
        </div>
    </div>
        <?= $footer; ?>
    <script type="text/javascript">
        $(document).ready(function(){
            var clubed = '';
           $('#checkall').click(function(){
            if($(this). prop("checked") == true){
                 $(".text-md-nowrap tbody .checkbox").prop("checked",true);  
                 $.each($(".text-md-nowrap tbody .checkbox:checked"), function(){
                favorite += $(this).val()+",";
                });
                $('#checked_doc').val(favorite);
            }
            else
            {
                $(this).prop("checked",false);
                $(".text-md-nowrap tbody .checkbox").prop("checked",false);
                $.each($(".text-md-nowrap tbody .checkbox:checked"), function(){
                favorite += $(this).val()+",";
                });
                $('#checked_doc').val(favorite);
            }
            var favorite ='';
            $(".text-md-nowrap tbody .checkbox").click(function(){
            $.each($(".text-md-nowrap tbody .checkbox:checked"), function(){
                favorite += $(this).val()+",";
            });
            $('#checked_doc').val(favorite);
          });
            

        });
           
       });
    </script>