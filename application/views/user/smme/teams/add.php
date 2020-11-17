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
                        <li class="breadcrumb-item"><a href="<?= site_url('user/smme/team') ?>">Business Team Members</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add New Member</li>
                    </ol>
                </nav>

            </div>
             <div class="my-auto breadcrumb-right">
							<a href="<?= site_url('user/smme/team') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-chevron-circle-left mr-2"></i></span><span class="btn-text">Go Back </span></button></a>
							<a href="<?= site_url('Profile/view_profile/'.$this->session->userdata('id_user')) ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Personal Details </span></button></a>
							<button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-question-circle mr-2"></i> </span><span class="btn-text">Help </span></button>
						</div> 

        </div>

        <div class="">
            <!-- row opened -->
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                        <?php echo form_open_multipart("user/smme/team/create", 'data-toggle="validator"'); ?>
                        <div class="card-body">
							<div class="row">
								<div class="col-md-4 form-group mb-3">
									<label class="form-label">First Name</label>
									<input name="tbl_smme_teams_first_name" class="sku form-control" required id="tbl_smme_teams_first_name" type="text"  placeholder="Enter First Name" value="">
									
									<input name="tbl_smme_teams_user_id" class="sku form-control" required id="tbl_smme_teams_user_id" type="hidden"  placeholder="" value="<?= $id_user; ?>">
									<?php if(!empty($bussiness_detail)){ ?>
									<input name="tbl_smme_teams_bussiness_id" class="sku form-control" required id="tbl_smme_teams_bussiness_id" type="hidden"  placeholder="" value="<?= $bussiness_detail[0]->tbl_business_details_id; ?>">
									<?php } ?>
												   
								</div>

								<div class="col-md-4 form-group mb-3">
									<label class="form-label">Last Name</label>
									<input name="tbl_smme_teams_last_name" class="sku form-control" required id="tbl_smme_teams_last_name" type="text"  placeholder="Enter Last Name" value="">
								</div>
								
								<div class="col-md-4 form-group mb-3">
									<label class="form-label">Email Address</label>
									<input name="tbl_smme_teams_email" class="gst form-control" required id="tbl_smme_teams_email" pattern="^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$" type="email" placeholder="Enter Email" value="">
								</div>
							</div>
						
							<div class="row">
								<div class="col-md-4 form-group mb-3">
									<label class="form-label">Mobile Number</label>
									<input name="tbl_smme_teams_mobile" class="sku form-control" required id="tbl_smme_teams_mobile" type="tel" title="Phone Number length should be 10" placeholder="Enter Mobile No." maxlength="13" minlength="8" pattern="[0-9]{8,13}"  value="">
								</div>
								
								<div class="col-md-4 form-group mb-3">
									<label class="form-label">Gender</label>
									<select id="tbl_smme_teams_gender" class="form-control" name="tbl_smme_teams_gender">
										<option value="Male">Male</option>
										<option value="Female">Female</option>
										<option value="Other">Other</option> 
									</select>
								</div>
								
								<div class="col-md-4 form-group mb-3">
									<label class="form-label">Date Hired</label>
									<input name="tbl_smme_teams_date_hired" class="sku form-control" required id="tbl_smme_teams_date_hired" type="date" placeholder="Enter Hired Date" value="">
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-4 form-group mb-3">
									<label class="form-label">Job Title</label>
									<input name="tbl_smme_teams_job_title" class="sku form-control" required id="tbl_smme_teams_job_title" type="text" placeholder="Enter job Title" value="">
								</div>
                                
                                <div class="col-md-4 form-group mb-3">
                                    <label class="form-label">Qualification</label>
                                    <input name="tbl_smme_teams_qualification" class="sku form-control" required id="tbl_smme_teams_qualification" type="text" placeholder="Enter Qualification" value="">
                                </div>

                                <div class="col-md-4 form-group mb-3">
                                    <label class="form-label">Experience (years)</label>
                                    <input name="tbl_smme_teams_experience" class="sku form-control" required id="tbl_smme_teams_experience" type="text" placeholder="Number of years" value="">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Add Member</button>
                        </div>
                        <?php echo form_close(); ?>
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