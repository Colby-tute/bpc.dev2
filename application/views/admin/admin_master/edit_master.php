<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
   <?= $header; ?>
        <div class="container">
                    <div class="breadcrumb-header justify-content-between">
                        <div>
                            <h4 class="content-title mb-2">General Settings</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= site_url('admin/home') ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="<?= site_url('admin/adminmaster') ?>">System Users & Roles</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Update Administrator Details</li>
                                </ol>
                            </nav>

                        </div>
                       <div class="my-auto breadcrumb-right">
							<a href="<?= site_url('admin/adminmaster/AdminMaster/add') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i></span><span class="btn-text">Add Administrator </span></button></a>
							<a href="<?=site_url('admin/Home/profile') ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Personal Details </span></button></a>
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
                                 <div id="infoMessage" class="alert alert-danger" style="margin-top: 25px;"><?php echo $this->session->flashdata('danger');?></div>
                            <?php } ?>
                            <?php
                            //print_r($userdt);
                            foreach ($userdt as $value) {
                             echo admin_form_open("admin/adminmaster/AdminMaster/update/".$value->tbl_admins_id, 'class="login" data-toggle="validator"'); 
                             ?>
                                <div class="row">
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="firstName1">First Name*</label>
                                        <input type="text" name="firstname" class="form-control" id="firstname" pattern="^[A-Za-z -]+$" required="" title="First Name will not contain any number" placeholder="Enter your First Name"
                                        value="<?php echo $value->tbl_admins_firstname; ?>" />
                                       
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="lastName1">Last Name</label>
                                        <input type="text" name="lastname" class="form-control" id="lastname" pattern="^[A-Za-z -]+$" title="Last Name will not contain any number" placeholder="Enter your Last Name" value="<?php echo $value->tbl_admins_lastname; ?>"/>
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="exampleInputEmail1">Email address*</label>
                                        <input type="email" name="email" class="form-control" id="email" required="" placeholder="Enter your Email Address" value="<?php echo $value->tbl_admins_email; ?>"/>
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="phone">Mobile Number</label>
                                        <input type="text" name="phone" class="form-control" id="phone" maxlength="13" minlength="8" pattern="[0-9]{8,13}" title="Phone Number length should be between 8-13" placeholder="Enter your Phone Number" value="<?php echo $value->tbl_admins_mobile; ?>" />
                                        <input type="hidden" name="country_code" id="country_code" class="form-control" value="<?php echo $value->tbl_admins_countrycode; ?>">
                                    </div>

                                    <div class="col-md-12">
                                        <button class="btn btn-primary sub">Submit</button>
                                    </div>
                                </div>
                            <?php echo form_close();  } ?>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- row closed -->
                    </div>
        </div>
   <?= $footer; ?>
   <script type="text/javascript">
            $('document').ready(function(){
                //alert($(".iti__selected-flag").html());
                
                $('.iti__selected-flag .iti__flag').removeClass('iti__us').addClass('iti__ls');
                var cc = $('#country_code').val();
                var ccf=cc.split('-');
                $('.iti__selected-flag .iti__flag').addClass('iti__'+ccf[0]);
                

               /* $('#country-listbox li').click(function() {
                    var country_code = $(this).data("dial-code");
                    $('#country_code').val(country_code);
                    //alert($(".iti__selected-flag").attr('title'));
                    //var tdTitleAttr = $(your-td-element).attr('title');
                });*/

                $( "#country-listbox li" )
                  .focusout(function() {
                    var country_code = $(this).data("dial-code");
                    var country_code_flag = $(this).data("country-code");
                    //alert(country_code_flag+'-'+country_code);
                    $('#country_code').val(country_code_flag+'-'+country_code);
                });
            });
        </script>