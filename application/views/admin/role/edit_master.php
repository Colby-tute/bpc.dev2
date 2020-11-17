<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?> <?= $header; ?>
        <div class="container">
                    <div class="breadcrumb-header justify-content-between">
                        <div>
                            <h4 class="content-title mb-2">General Settings</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= site_url('admin/home') ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="<?= site_url('admin/role') ?>">System Users & Roles</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Update Role</li>
                                </ol>
                            </nav>

                        </div>
						
						<div class="my-auto breadcrumb-right">
							<a href="<?= site_url('admin/role') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-pen mr-2"></i></span><span class="btn-text">Go Back </span></button></a>
							<a href="<?= site_url('admin/Home/Profile') ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Personal Details </span></button></a>
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
                                     echo admin_form_open("admin/role/Role/update/".$value->tbl_roles_id, 'class="login" data-toggle="validator"'); 
                                     ?>
                                        <div class="row">
                                            <div class="col-md-6 form-group mb-3">
                                                <label for="firstName1">Role Title*</label>
                                                <input type="text" name="name" class="form-control" id="name" required="" placeholder="Enter Role Title" value="<?php echo $value->tbl_roles_title; ?>" />
                                               
                                            </div>

                                            <div class="col-md-12">
                                                <button class="btn btn-primary">Submit</button>
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
  