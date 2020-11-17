<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
        <?= $header; ?>
        <div class="container">

                    <!-- breadcrumb -->
                   <div class="breadcrumb-header justify-content-between">
                        <div>
                            <h4 class="content-title mb-2">Resources</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= site_url('admin/home') ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="<?= site_url('admin/faq') ?>">Frequently Asked Questions</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Update Item</li>
                                </ol>
                            </nav>
                         </div>
                      <div class="my-auto breadcrumb-right">
							<a href="<?= site_url('admin/smme/application') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-bell mr-2"></i></span><span class="btn-text">Status </span></button></a>
							<a href="<?= site_url('admin/faq/add') ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-check-square mr-2"></i> </span><span class="btn-text">Add New FAQ Entry </span></button></a>
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
                                        <?php } 
                                        //print_r($role);
                                        foreach ($userdt as $key => $value) {
                                            # code...
                                       
                                        ?>
                                        <?php echo form_open_multipart("admin/Faq/update/".$value->tbl_faqs_id, 'class="login" data-toggle="validator"'); ?>
                                        <div id="companyform">
                                            <div class="col-md-12"> 
                                                <div class="row">
                                                    <div id="error_msg"></div>
                                                    <div class="col-md-12 form-group mb-3">
                                                        <label for="firstName1">Role*</label>
                                                        <select name="tbl_faqs_role_type" class="form-control" id="tbl_faqs_role_type" required="">
                                                            <option value="">Select</option>
                                                            <?php foreach ($role as $key => $ro){
                                                                ?>
                                                                <option value="<?php echo $ro->tbl_roles_id; ?>"<?php if($value->tbl_faqs_role_type == $ro->tbl_roles_id){echo "selected";}?>><?php echo $ro->tbl_roles_title; ?></option>
                                                                
                                                            <?php } ?>
                                                        </select>
                                                           
                                                    </div>
                                                    <div class="col-md-12 form-group mb-3">
                                                        <label for="lastName1">FAQ Short Title</label>
                                                        <textarea  name="tbl_faqs_title" class="form-control ckeditor" id="tbl_faqs_title" /><?php echo $value->tbl_faqs_title;?></textarea> 
                                                    </div>
                                                    <div class="col-md-12 form-group mb-3">
                                                        <label for="lastName1">FAQ Description</label>
                                                        <div class="ql-wrapper ql-wrapper-demo bg-gray-200">
                                                            <div id="quillEditor">
                                                                <?php echo $value->tbl_faqs_desc;?>
                                                            </div>
                                                        </div>

                                                        <textarea  name="tbl_faqs_desc" class="form-control ckeditor" id="tbl_faqs_desc" style="display:none;" /></textarea>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <button class="btn btn-primary sub">Submit</button>
                                        </div>
                                        <?php echo form_close();
                                         } ?>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- row closed -->
                    </div>
                    
                    <!-- row closed -->
                </div>
        <?= $footer; ?>
        <script type="text/javascript">
            $(document).ready(function(){

                $(".sub").on("click", function () {

                    //alert($('#quillEditor .ql-editor').html());
                    $('#tbl_faqs_desc').val($('#quillEditor .ql-editor').html());
                });

                $(".ql-link").hide();
                $(".ql-image").hide();
                $(".ql-video").hide();

            });
        </script>
    </body>
</html>