<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
        <?= $header; ?>
        <div class="container">
                    <div class="breadcrumb-header justify-content-between">
                        <div>
                            <h4 class="content-title mb-2">Resources</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= site_url('admin/home') ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="<?= site_url('admin/faq') ?>">Frequently Asked Questions</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add New Item</li>
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
                                        <?php } ?>
                                       <?php echo form_open_multipart("admin/Faq/add", 'class="login" data-toggle="validator"'); ?>
                                      <!--  <form> -->
                                        <div id="companyform">
                                            <div class="col-md-12"> 
                                                <div class="row">
                                                    <div id="error_msg"></div>
                                                    <div class="col-md-12 form-group mb-3">
                                                        <label for="firstName1">Select Role*</label>
                                                        <select name="tbl_faqs_role_type" class="form-control" id="tbl_faqs_role_type" required="">
                                                            <option value="">Select</option>
                                                            <?php foreach ($role as $key => $ro){
                                                                ?>
                                                                <option value="<?php echo $ro->tbl_roles_id; ?>"><?php echo $ro->tbl_roles_title; ?></option>
                                                                
                                                            <?php } ?>
                                                        </select>                                                           
                                                    </div>
                                                    <div class="col-md-12 form-group mb-3">
                                                        <label for="lastName1">Short Question</label>
                                                        <textarea  name="tbl_faqs_title" class="form-control ckeditor" id="tbl_faqs_title" /></textarea> 
                                                    </div>
                                                    <div class="col-md-12 form-group mb-3">
                                                        <label for="lastName1">Answer / Description</label>
                                                        <div class="ql-wrapper ql-wrapper-demo bg-gray-200">
                                                            <div id="quillEditor">
                                                                <!-- <p><strong>Quill</strong> is a free, open source <a href="https://github.com/quilljs/quill/">WYSIWYG editor</a> built for the modern web. With its <a href="https://quilljs.com/docs/modules/">modular architecture</a> and expressive API, it is completely customizable to fit any need.</p><br>
                                                                <p>The icons use here as a replacement to default svg icons are from <a href="https://icons8.com/line-awesome">Line Awesome Icons</a>.</p> -->
                                                            </div>
                                                        </div>

                                                        <textarea  name="tbl_faqs_desc" class="form-control ckeditor" id="tbl_faqs_desc" style="display:none;"/></textarea>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <button class="btn btn-primary sub">Submit</button>
                                        </div>
                                       <?php echo form_close(); ?>
                                       <!-- </form> -->
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- row closed -->
                    </div>
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

             /*var form = document.querySelector('form');
                form.onsubmit = function() {
                    alert('okayyy');
                  // Populate hidden form on submit
                  var about = document.querySelector('input[name=about]');
                  about.value = JSON.stringify(quill.getContents());
                  
                  console.log("Submitted", $(form).serialize(), $(form).serializeArray());
                  
                  // No back end to actually submit to!
                  alert('Open the console to see the submit data!')
                  return false;
                };*/

            });
        </script>
    </body>
</html>