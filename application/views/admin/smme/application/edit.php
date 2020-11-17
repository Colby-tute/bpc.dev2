<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
        <?= $header; ?>
        <div class="container">
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">Applications</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/Home') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/smme/Application') ?>">Application</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Application</li>
                    </ol>
                </nav>

            </div>
            <div class="my-auto breadcrumb-right">
							<a href="<?= site_url('admin/smme/Application/add') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-check-square mr-2"></i></span><span class="btn-text">Add New Application </span></button></a>
							<a href="<?= site_url('admin/Home/Profile') ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Personal Details </span></button></a>
							<button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-question-circle mr-2"></i> </span><span class="btn-text">Help </span></button>
						</div>
        </div>

        <div class="">
            <!-- row opened -->
            <div class="row row-sm">
                <div class="col-lg-10">
                    <div class="card">
                        <?php 
                        foreach ($edit_data as $key => $value) { 
                        echo form_open_multipart("admin/smme/Application/update/".$value->tbl_application_id, 'class="login" data-toggle="validator"'); ?>
                        <div class="card-body">
                            <!-- <div class="mb-4 main-content-label">Personal Information</div> -->
                             <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">Select SMME</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select id="incubator_id" name="incubator_id" class="form-control">
                                                <option value="">Select SMME</option>
                                                <?php
                                                foreach ($select_smme as $key => $smme) { ?>
                                                    <option value="<?php echo $value->tbl_users_id; ?>"<?php if ($value->tbl_application_smme_id == $smme->tbl_users_id) {
                                                        echo "selected";
                                                    }?>><?php echo $smme->tbl_users_firstname.' '.$smme->tbl_users_lastname;?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">Select Incubator</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select id="incubator_id" name="incubator_id" class="form-control">
                                                <option value="">Select Incubator</option>
                                                <?php
                                                foreach ($select_incubator as $key => $inc) { ?>
                                                    <option value="<?php echo $inc->tbl_users_id; ?>"<?php if ($value->tbl_application_incubator_id == $inc->tbl_users_id) {
                                                        echo "selected";
                                                    }?>><?php echo $inc->tbl_users_firstname.' '.$inc->tbl_users_lastname;?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">Select BDSP</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select id="bdsp_id" name="bdsp_id" class="form-control">
                                                <option value="">Select BDSP</option>
                                                <?php
                                                foreach ($select_bdsp as $key => $bdsp) { ?>
                                                    <option value="<?php echo $bdsp->tbl_users_id; ?>" <?php if ($value->tbl_application_bdsp_id == $bdsp->tbl_users_id) {
                                                        echo "selected";
                                                    }?>><?php echo $bdsp->tbl_users_firstname.' '.$bdsp->tbl_users_lastname;?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

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
    