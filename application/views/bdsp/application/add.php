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
                        <li class="breadcrumb-item"><a href="<?= site_url('bdsp/Home') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('bdsp/application') ?>">Application</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Incubation Application</li>
                    </ol>
                </nav>

            </div>
            <div class="my-auto breadcrumb-right">
							<a href="Analytics/registrationsReport" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-bell mr-2"></i></span><span class="btn-text">Analytics </span></button></a>
							<a href="<?= site_url('bdsp/Profile/view_profile/'.$this->session->userdata('id_user')) ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Personal Details </span></button></a>
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
                                            <label class="form-label">MSME</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select id="smme_id" name="smme_id" class="form-control">
                                                <option value="">MSME</option>
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
                                            <label class="form-label">INCU</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select id="incubator_id" name="incubator_id" class="form-control">
                                                <option value="">INCU</option>
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
                                            <label class="form-label">BDSP</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select id="bdsp_id" name="bdsp_id" class="form-control">
                                                <option value="">BDSP</option>
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
                                            <label class="form-label">MSME Proposal</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="file" class="form-control" name="motivation_letter" id="motivation_letter" required="">
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Submit Application</button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <!-- row closed -->
        </div>
    </div>
        <?= $footer; ?>
    