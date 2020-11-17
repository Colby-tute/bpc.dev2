<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
        <?= $header; ?>
        <div class="container">
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">Application</h4>
               <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/home') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Analytics &amp; Monitoring</li>
                    </ol>
                </nav>

            </div>
			
			
			<div class="my-auto breadcrumb-right">
                        <a href="<?= site_url('User/SMME/Application') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-arrow-circle-left mr-2"></i></span><span class="btn-text">Go Back </span></button></a>
							<a href="<?= site_url('admin/bdsps/Bdsps/add') ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-check-square mr-2"></i> </span><span class="btn-text">Create New Profile </span></button></a>
							<button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-question-circle mr-2"></i> </span><span class="btn-text">Help </span></button>
                         
                            
                        </div>
			
        </div>

        <div class="">
            <!-- row opened -->
            <div class="row row-sm">
                <div class="col-lg-10">
                    <div class="card">
                        <?php echo form_open_multipart("User/SMME/Application/add", 'class="login" data-toggle="validator"'); ?>
                        <div class="card-body">
                            <!-- <div class="mb-4 main-content-label">Personal Information</div> -->
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">Business Document</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="file" class="form-control" name="business_doc" id="business_doc" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">Motivation Letter</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="file" class="form-control" name="motivation_letter" id="motivation_letter" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">Motivation Text</label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea id="motivation_text" name="motivation_text" class="form-control ckeditor" rows="5" required=""></textarea>
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
    