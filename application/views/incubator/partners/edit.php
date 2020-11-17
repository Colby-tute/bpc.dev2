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
						<li class="breadcrumb-item"><a href="<?= site_url('incubator/Home') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('incubator/partner') ?>">Business Team Members</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Member Details</li>
                    </ol>
                </nav>

            </div>
            <div class="my-auto breadcrumb-right">
							<a href="<?= site_url('incubator/partner') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-chevron-circle-left mr-2"></i></span><span class="btn-text">Go Back </span></button></a>
							<a href="<?= site_url('Profile/view_profile/'.$this->session->userdata('id_user')) ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Personal Details </span></button></a>
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
                        echo form_open_multipart("incubator/partner/update/".$value->id, 'data-toggle="validator"'); ?>
                        <div class="card-body">
							<div class="row">
								<div class="col-md-4 form-group mb-3">
									<label class="form-label">Full Name</label>
									<input name="name" class="sku form-control" required id="name" type="text"  placeholder="Enter First Name" value="<?= $value->name; ?>">
									
									<input name="user_id" class="sku form-control" required id="user_id" type="hidden"  placeholder="" value="<?= $id_user; ?>">
												   
								</div>

								<div class="col-md-4 form-group mb-3">
									<label class="form-label">Email Address</label>
									<input name="email" class="gst form-control" required id="email" pattern="^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$" type="email" placeholder="Enter Emailid" value="<?= $value->email; ?>">
								</div>
								
								<div class="col-md-4 form-group mb-3">
									<label class="form-label">Mobile Number</label>
									<input name="phone" class="sku form-control" required id="phone" type="tel" maxlength="13" minlength="8" pattern="[0-9]{8,13}" title="Phone Number length should be between 8-13" placeholder="Enter Mobile No." maxlength="10" value="<?= $value->phone; ?>">
								</div>
							</div>
						
							<div class="row">
								<div class="col-md-4 form-group mb-3">
									<label class="form-label">Physical Address</label>
									<input name="address" class="sku form-control" required id="address" type="text" placeholder="Enter Address" value="<?= $value->address; ?>">
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