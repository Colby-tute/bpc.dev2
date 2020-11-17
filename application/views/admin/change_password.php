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
                                    <li class="breadcrumb-item"><a href="<?= site_url('admin/home') ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                                </ol>
                            </nav>

                        </div>
                        <div class="my-auto breadcrumb-right">
							<a href="<?=site_url('admin/smme/Application')?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-bell mr-2"></i></span><span class="btn-text">Status </span></button></a>
							<a href="<?=site_url('admin/Home/profile') ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Personal Details </span></button></a>
							<button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-question-circle mr-2"></i> </span><span class="btn-text">Help </span></button>
						</div>
                    </div>


                <div class="main-signin-wrapper">
                    <div class="main-card-signin d-md-flex wd-100p">
                   
                    <div class="sign-up-body wd-md-50p">
                        <div class="main-signin-header">
                            <div class="">
                                <!-- <h2>Change Password?</h2>
                                <h4 class="text-left">Reset Your Password</h4> -->
                               <?php echo form_open_multipart("admin/Home/change_password", 'class="login" data-toggle="validator"'); ?>
                                    <div class="form-group text-left">
                                        <label>Current Password</label>
                                        <input type="password" name="oldpass" class="form-control" id="oldpass" placeholder="Enter your Old Password"/>
                                    </div>
                                    <div class="form-group text-left">
                                        <label>New Password</label>
                                        <input type="password" name="password" class="form-control" id="password" minlength="8" required="" placeholder="Enter your Password" />
                                    </div>
                                    <div class="form-group text-left">
                                        <label>Confirm Password</label>
                                        <input type="password" name="confirm_password" class="form-control" id="confirm_password" required="" placeholder="Please Confirm your Password" />
                                    </div>
                                    <button class="btn ripple btn-main-primary btn-block sub">Reset Password</button>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                        <!-- <div class="main-signup-footer mg-t-10">
                            <p>Already have an account? <a href="signin.html">Sign In</a></p>
                        </div> -->
                        </div>
                    </div>
                </div>
        </div>
        <?= $footer; ?>