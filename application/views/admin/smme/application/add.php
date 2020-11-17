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
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/smme/application') ?>">Applications</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Incubation Application & Status</li>
                    </ol>
                </nav>

            </div>
            <div class="my-auto breadcrumb-right">
							<a href="<?= site_url('admin/smme/Application') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-arrow-circle-left mr-2"></i></span><span class="btn-text">Go Back </span></button></a>
							<a href="<?= site_url('admin/Home/Profile') ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Personal Details </span></button></a>
							<button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-question-circle mr-2"></i> </span><span class="btn-text">Help </span></button>
						</div>
        </div>

        <div class="">
            <!-- row opened -->
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                        <?php echo form_open_multipart("admin/smme/Application/add", 'class="login" data-toggle="validator"'); ?>
                        <div class="card-body">
                            <!-- <div class="mb-4 main-content-label">Personal Information</div> -->
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">Choose MSME</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select id="smme_id" name="smme_id" class="form-control">
                                                <option value="">--</option>
                                                <?php
                                                foreach ($select_smme as $key => $value) { ?>
                                                    <option value="<?php echo $value->tbl_users_id; ?>"><?php echo $value->tbl_users_firstname.' '.$value->tbl_users_lastname;?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">Choose Incubator (INCU)</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select id="incubator_id" name="incubator_id" class="form-control">
                                                <option value="">--</option>
                                                <?php
                                                foreach ($select_incubator as $key => $value) { ?>
                                                    <option value="<?php echo $value->tbl_users_id; ?>"><?php echo $value->tbl_users_firstname.' '.$value->tbl_users_lastname;?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">Choose BDSP | Coach | Memntor</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select id="bdsp_id" name="bdsp_id" class="form-control">
                                                <option value="">--</option>
                                                <?php
                                                foreach ($select_bdsp as $key => $value) { ?>
                                                    <option value="<?php echo $value->tbl_users_id; ?>"><?php echo $value->tbl_users_firstname.' '.$value->tbl_users_lastname;?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

<!--                                 <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">Attach MSME Business Document</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="file" class="form-control" name="business_doc" id="business_doc" required="">
                                        </div>
                                    </div>
                                </div> -->
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">Attach MSME Application document</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="file" class="form-control" name="motivation_letter" id="motivation_letter" required="">
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
    