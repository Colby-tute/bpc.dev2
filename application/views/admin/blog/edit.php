<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
        <?= $header; ?>
        <link href="<?php echo base_url(); ?>assets/plugins/select2/css/select2.min.css" rel="stylesheet">
        <div class="container">
                    <div class="breadcrumb-header justify-content-between">
                        <div>
                            <h4 class="content-title mb-2">Resources</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= site_url('admin/home') ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="<?= site_url('admin/blog') ?>">Knowledge Centre</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Knowledge Centre Item</li>
                                </ol>
                            </nav>

                        </div>
                       <div class="my-auto breadcrumb-right">
							<a href="<?= site_url('admin/Blog/add') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-check-square mr-2"></i></span><span class="btn-text">Add New Item </span></button></a>
							<a href="<?= site_url('admin/blog/') ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-folder mr-2"></i> </span><span class="btn-text">Manage Knowledge Centre </span></button></a>
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
                                        foreach ($userdt as $key => $value) {
                                         
                                        echo form_open_multipart("admin/Blog/update/".$value->tbl_blog_id, 'class="login" data-toggle="validator"'); ?>
                                         <div id="companyform">
                                            <div class="col-md-12"> 
                                                <div class="row">
                                                    <div id="error_msg"></div>
                                                    <div class="col-md-6 form-group mb-3">
                                                            <label for="firstName1">Resource Category</label>
                                                            <!-- <input type="text" name="tbl_business_details_industry" class="form-control" id="Insustry" value="<?php if(!empty($business)){ echo $buss->tbl_business_details_industry; } ?>"/> -->
                                                            <select id="tbl_business_details_industry" class="form-control js-example-basic-single" name="tbl_business_details_industry" required="">
                                                                <option value="">Select Category</option>
                                                                    <?php
                                                                    foreach ($industrys as $key => $industry) { ?>
                                                                        <option value="<?php echo $industry->tbl_basecenter_category_id;?>" <?php if ($industry->tbl_basecenter_category_id == $value->tbl_blog_category_id) {
                                                                           echo 'selected';
                                                                        }?>><?php echo $industry->tbl_basecenter_category_name;?></option>
                                                                    <?php }
                                                                    ?>
                                                            </select>
                                                           <input type="hidden" name="ind" id="ind" value="<?php echo $value->tbl_blog_category_id; ?>">
                                                        </div>
                                                        <div class="col-md-6 form-group mb-3">
                                                            <label for="firstName1">Resource Sub Subcategory</label>
                                                            <select id="tbl_business_details_subindustry" class="form-control js-example-basic-single" name="tbl_business_details_subindustry" required="">
                                                                
                                                            </select>
                                                            <input type="hidden" name="sub_ind" id="sub_ind"  value="<?php echo $value->tbl_blog_subcategory_id; ?>">
                                                        </div>
                                                    <div class="col-md-4 form-group mb-3">
                                                        <label for="lastName1">Article Title</label>
                                                        <input type="text" name="tbl_blog_title" class="form-control" id="tbl_blog_title" placeholder="Article Title" value="<?php echo $value->tbl_blog_title;?>" />
                                                    </div>
                                                    <div class="col-md-4 form-group mb-3"><label for="firstName1">Header Photo</label>
                                                        <div class="row">
                                                            <div class="col-md-8 form-group mb-3">
                                                                <div class="custom-file">
                                                                    <input type="file" name="tbl_blog_image" class="custom-file-input" id="tbl_blog_image">
                                                                    <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 form-group mb-3">
                                                                <img src="<?php echo base_url(); ?>assets/blogs/<?php echo $value->tbl_blog_image;?>" style="width: 100px; height: auto;">
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                    </div>
                                                    <div class="col-md-4 form-group mb-3">
                                                        <label for="lastName1">Video Link</label>
                                                        <input type="url" name="tbl_blog_video_link" class="form-control" id="tbl_blog_video_link" placeholder="Video Link" value="<?php echo $value->tbl_blog_video_link;?>"/>
                                                    </div>
                                                    <div class="col-md-6 form-group mb-3">
                                                        <label for="lastName1">Short Description</label>
                                                        <textarea name="tbl_blog_short_desc" class="form-control ckeditor" id="tbl_blog_short_desc" maxlength="100"><?php echo $value->tbl_blog_short_desc;?></textarea> 
                                                    </div> 
                                                    <div class="col-md-6 form-group mb-3">
                                                        <label for="lastName1">Tags</label>
                                                        <div class="example">
                                                            <div class="form-group">
                                                                <input type="text" data-role="tagsinput" value="<?php echo $value->tbl_blog_tags;?>" class="form-control adddt" name="tbl_blog_tags">
                                                            </div>
                                                            <!-- <div class="form-group mb-0">
                                                                <select multiple data-role="tagsinput" class="form-control" id="tbl_blog_tags">
                                                                </select>
                                                            </div> -->
                                                        </div> 
                                                    </div> 
                                                    <div class="col-md-12 form-group mb-3">
                                                        <label for="lastName1">Description</label>
                                                        <div class="ql-wrapper ql-wrapper-demo bg-gray-200">
                                                            <div id="quillEditor">
                                                                <?php echo $value->tbl_blog_long_desc;?>
                                                            </div>
                                                        </div>

                                                        <textarea  name="tbl_blog_long_desc" class="form-control ckeditor" id="tbl_blog_long_desc" style="display:none;"/><?php echo $value->tbl_blog_long_desc;?></textarea>
                                                    </div>
                                                    <div class="col-md-6 form-group mb-3">
                                                            <label for="firstName1">Do You Have Gallery?</label>
                                                          <!-- <div class="custom-file"> -->
                                                            <input type="hidden" value="<?php echo $value->tbl_blog_have_gallery; ?>">
                                                            <?php 
                                                            if($value->tbl_blog_have_gallery == 1)
                                                            {
                                                            ?>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="rdiobox"><input name="tbl_blog_have_gallery" type="radio" value="1" checked=""> <span>Yes</span></label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="rdiobox"><input name="tbl_blog_have_gallery" type="radio" value="0"> <span>No</span></label>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }else
                                                        {
                                                        ?>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="rdiobox"><input name="tbl_blog_have_gallery" type="radio" value="1"> <span>Yes</span></label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="rdiobox"><input name="tbl_blog_have_gallery" type="radio" value="0" checked=""> <span>No</span></label>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        }?>
                                                    </div> 
                                                    <div class="col-md-6 form-group mb-3 team">
                                                        <label for="firstName1">Select New Gallery Images</label>
                                                        <div class="custom-file">
                                                            <input type="file" name="tbl_blog_gallery_image[]" class="custom-file-input" id="tbl_blog_gallery_image" multiple="">
                                                            <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose files</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 form-group mb-3 team">
                                                        <label for="firstName1">Uploaded Image</label>
                                                        <br>
                                                        <?php 
                                                        //print_r($images);
                                                        foreach ($images as $k => $img) {
                                                            ?>

                                                            <input type="hidden" name="image_id" value="<?php echo $img->tbl_blog_gallery_id;?>">
                                                            <?php if($img->tbl_blog_gallery_image != '')
                                                            { ?>
                                                            <img src="<?php echo base_url(); ?>assets/blogs/<?php echo $img->tbl_blog_gallery_image;?>" style="width: 200px; height: auto;">    
                                                        <?php
                                                           }
                                                        }
                                                        ?>
                                                    </div>

                                                </div> 
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                                    <button class="btn btn-primary sub">Submit</button>
                                        
                                        <?php echo form_close(); 
                                        }
                                        ?>
                                         <a class="btn btn-success mr-0" href="<?=site_url('admin/blog') ?>"><span class="icon-label"></span><span class="btn-text">Back </span></a>
                                     </div>
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
                   $('.js-example-basic-single').select2();
                });
        </script>
        <script type="text/javascript">
            $('document').ready(function(){
                
                $(".team").hide();
                $("input[name='tbl_blog_have_gallery']").click(function(){
                    var radioValue = $(this).val();
                    if(radioValue == 1){

                        $(".team").show();
                        
                    }
                    else
                    {
                        $(".team").hide();
                    }
                });
                var radioValue = $("input[name='tbl_blog_have_gallery']:checked").val();
                //alert(radioValue);
                    if(radioValue == 1){

                        $(".team").show();
                        
                    }
                    else
                    {
                        $(".team").hide();
                    }
            });
        </script>
        <script type="text/javascript">
            $('#tbl_business_details_industry').change(function() {
                //alert($(this).val());
                var ind_id = $(this).val();
                if (ind_id == '') {
                    $('#tbl_business_details_subindustry').html('<option value="">Select Sub Category</option>');
                }
                else
                {
                    jQuery.ajax({
                        type: "POST",
                        url: "<?=base_url()?>admin/Blog/get_sub_industries",
                        dataType: 'text',
                        data: {ind_id:ind_id},
                        success: function(data) 
                        {
                            var obj = JSON.parse(data);
                            //console.log(obj);
                            var html = '';
                            $.each(obj, function( index, value ) {
                              html += '<option value="'+value.tbl_basecenter_sub_category_id+'">'+value.tbl_basecenter_sub_category_name+'</option>';
                            });
                            $('#tbl_business_details_subindustry').html(html);
                        }
                    });
                }
            });
        </script>
        <script type="text/javascript">
            var ind_id = $('#ind').val();
            var sub_ind = $('#sub_ind').val();
            //alert(ind_id);
            jQuery.ajax({
                    type: "POST",
                    url: "<?=base_url()?>admin/Blog/get_sub_industries",
                    dataType: 'text',
                    data: {ind_id:ind_id},
                    success: function(data) 
                    {
                        var obj = JSON.parse(data);
                        //console.log(obj);
                        var html = '';
                        $.each(obj, function( index, value ) {
                            if (value.tbl_basecenter_sub_category_id == sub_ind) {
                                html += '<option value="'+value.tbl_basecenter_sub_category_id+'" selected>'+value.tbl_basecenter_sub_category_name+'</option>';      
                            }else{
                                html += '<option value="'+value.tbl_basecenter_sub_category_id+'">'+value.tbl_basecenter_sub_category_name+'</option>';      
                            }
                        });
                        $('#tbl_business_details_subindustry').html(html);
                    }
                });
        </script>
         <script type="text/javascript">
            $(document).ready(function(){

                $(".sub").on("click", function () {


                    $('#tbl_blog_long_desc').val($('#quillEditor .ql-editor').html());
                    //alert($('#quillEditor .ql-editor').html());

                });
                $('#tbl_blog_tags').on('change', function() {

//alert($("#tbl_blog_tags").tagsinput('items'));
                    $(".adddt").val($("#tbl_blog_tags").tagsinput('items'));

                });
                $(".ql-link").hide();
                $(".ql-image").hide();
                $(".ql-video").hide();

            });
        </script>
    </body>
</html>