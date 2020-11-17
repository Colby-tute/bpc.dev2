<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
        <?= $header; ?>
        <div class="container">
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">Incubation</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url('Home') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('user/smme/Application') ?>">Application</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Application for Incubation</li>
                    </ol>
                </nav>

            </div>
            <div class="my-auto breadcrumb-right">
							<a href="<?= site_url('user/smme/Application') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-bell mr-2"></i></span><span class="btn-text">Status </span></button></a>
							<a href="<?= site_url('user/smme/Analytics/incprogress') ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-bars mr-2"></i> </span><span class="btn-text">Monitoring & Reports </span></button></a>
							<button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-question-circle mr-2"></i> </span><span class="btn-text">Help </span></button>
						</div>
        </div>

        <div class="">
            <!-- row opened -->
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                        <?php echo form_open_multipart("user/smme/Application/add", 'class="login" data-toggle="validator"'); ?>
                        <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 form-group mb-3">
                                        <label class="form-label">Preferred Incubation Manager</label>
                                        <select id="incubator_id" name="incubator_id" class="form-control">
                                                <option value="">Select</option>
                                                <?php
                                                foreach ($select_incubator as $key => $value) { ?>
                                                    <option value="<?php echo $value->tbl_users_id; ?>"><?php echo $value->tbl_users_firstname.' '.$value->tbl_users_lastname;?></option>
                                                <?php } ?>
                                            </select>
                                                       
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label class="form-label">Preferred BDSP, Coach or Mentor</label>
                                        <select id="bdsp_id" name="bdsp_id" class="form-control">
                                                <option value="">Select</option>
                                                <?php
                                                foreach ($select_bdsp as $key => $value) { ?>
                                                    <option value="<?php echo $value->tbl_users_id; ?>"><?php echo $value->tbl_users_firstname.' '.$value->tbl_users_lastname;?></option>
                                                <?php } ?>
                                            </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                   
                                   <div class="alert alert-warning" role="alert" style="text-align:justify;">
<button aria-label="close" class="close" data-dismiss="alert" type="button">
<span aria-hidden="true">&times;</span>
</button>
<strong> Terms & Conditions </strong> <br /> By applying, you agree  to  the  terms  and  conditions  outlined  in  the BEDCO Virtual Business Incubator's Agreement. The  Agreement constitutes   the   entire   and   only   agreement   between BEDCO and   Participant,   and supersedes  all  prior  or  contemporaneous  agreements,  representations,  warranties  and understandings with respect to the Business  Incubator Program, the  content, products or services  provided  by us and  the  subject  matter  of  this  Agreement <a href="#"><i>[Read more]</i></a>  
</div>
                                   
                                   
                                  
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                       <div class="col-md-3">
                                            <label class="form-label">Attach Your Application</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="file" class="form-control" name="motivation_letter" id="motivation_letter" required="">
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Process Application</button>
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
