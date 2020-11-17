<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
   <?= $header; ?>
        <div class="container">
                    <div class="breadcrumb-header justify-content-between">
                        <div>
                            <h4 class="content-title mb-2">Change Password</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= site_url('Home') ?>">Home</a></li>
                                    <li class="breadcrumb-item active">Settings</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="my-auto breadcrumb-right">
                            <!-- <button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-envelope mr-2"></i></span><span class="btn-text">Email </span></button>
                            <button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-print mr-2"></i> </span><span class="btn-text">Print </span></button> -->
                            <a class="btn btn-success mr-0" href="<?= site_url('Home') ?>"><span class="icon-label"></span><span class="btn-text">Back </span></a>
                        </div>
                    </div>

                    <div class="">
                        <!-- row opened -->
                        <div class="row row-sm">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="card">
                                    <div class="card-body iconfont text-left">
                                        <p><?php if ($this->session->flashdata('danger')) { ?>
                                            <div id="infoMessage" class="alert alert-danger mt25"><?php echo $this->session->flashdata('danger');?></div>
                                              <?php } else if ($this->session->flashdata('success')) { ?>
                                            <div id="infoMessage" class="alert alert-success mt25"><?php echo $this->session->flashdata('success');?></div>
                                              <?php }?>
                                        </p>
                                    </div>
                             <?php echo admin_form_open("user/smme/change_password", 'class="login" data-toggle="validator"'); ?>
                                            <div id="companyform">
                                                <div class="col-md-12"> 
                                                    <div class="row">
                                                        <div class="col-md-4 form-group mb-3">
                                                            <label for="lastName1">Current Password</label>
                                                            <input type="password" name="oldpass" class="form-control" id="oldpass" placeholder="Enter your Old Password"/>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4 form-group mb-3">
                                                            <label for="credit1">New Password*</label>
                                                            <input type="password" name="password" class="form-control" id="password" minlength="8" required="" placeholder="Enter your Password" />
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4 form-group mb-3">
                                                            <label for="credit1">Confirm New Password*</label>
                                                            <input type="password" name="confirm_password" class="form-control" id="confirm_password" required="" placeholder="Please Confirm your Password" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-4 form-group mb-3">
                                                            <button class="btn btn-primary sub">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
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