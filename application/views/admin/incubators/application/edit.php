<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
        <?= $header; ?>
        <div class="container">
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">Edit Application</h4>
               <!--  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Analytics &amp; Monitoring</li>
                    </ol>
                </nav> -->

            </div>
            <div class="my-auto breadcrumb-right">
                <!-- <button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-envelope mr-2"></i></span><span class="btn-text">Email </span></button>
                <button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-print mr-2"></i> </span><span class="btn-text">Print </span></button> -->
                <a class="btn btn-success mr-0" href="<?= site_url('User/SMME/Application') ?>"><span class="icon-label"></span><span class="btn-text">Back </span></a>
            </div>
        </div>

        <div class="">
            <!-- row opened -->
            <div class="row row-sm">
                <div class="col-lg-10">
                    <div class="card">
                        <?php 
                        foreach ($edit_data as $key => $value) { 
                        echo form_open_multipart("User/SMME/Application/update/".$value->tbl_application_id, 'class="login" data-toggle="validator"'); ?>
                        <div class="card-body">
                            <!-- <div class="mb-4 main-content-label">Personal Information</div> -->
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">Business Document</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="file" class="form-control" name="business_doc" id="business_doc">
                                             <input type="hidden" name="old_business_doc" id="old_business_doc" value="<?php echo $value->tbl_application_business_doc; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">Motivation Letter</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="file" class="form-control" name="motivation_letter" id="motivation_letter">
                                            <input type="hidden" name="old_motivation_letter" id="old_motivation_letter" value="<?php echo $value->tbl_application_motivation_letter; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">Motivation Text</label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea id="motivation_text" name="motivation_text" class="form-control ckeditor" rows="5" required=""><?php echo $value->tbl_application_motivation_text; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                        </div>
                        <?php echo form_close(); } ?>
                    </div>
                </div>
            </div>
            <!-- row closed -->
        </div>
    </div>
        <?= $footer; ?>
    