<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
        <?= $header; ?>
        <div class="container">
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">General Settings</h4>
               <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/home') ?>">Dashboard</a></li>
						<li class="breadcrumb-item"><a href="<?= site_url('admin/role_rights') ?>">System Users & Roles</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Manage Permissions</li>
                    </ol>
                </nav>

            </div>
            <div class="my-auto breadcrumb-right">
							<a href="<?=site_url('admin/smme/Application')?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-bell mr-2"></i></span><span class="btn-text">Status </span></button></a>
							<a href="<?=site_url('admin/Home/profile') ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Personal Details </span></button></a>
							<button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-question-circle mr-2"></i> </span><span class="btn-text">Help </span></button>
						</div>
        </div>

        <div class="">
            <!-- row opened -->
            <div class="row row-sm">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-body iconfont text-left">
                            <p><?php if ($this->session->flashdata('danger')) { ?>
                     <div id="infoMessage" class="alert alert-danger mt25"><?php echo $this->session->flashdata('danger');?></div>
                <?php } else if ($this->session->flashdata('success')) { ?>
                     <div id="infoMessage" class="alert alert-success mt25"><?php echo $this->session->flashdata('success');?></div>
                <?php }
                //echo count($tdata);
                //print_r($tdata);?></p>
                <?php echo admin_form_open("admin/Role_Rights/add", 'class="login" data-toggle="validator"'); ?>
                                <div class="col-md-12">
                                    <div class="col-md-12 form-group mb-3 centerdt">
                                        <input type="hidden" id="usertype" name="usertype" value="employee">
                                            <div class="form-group">
                                                    <label for="message-text-1" class="col-form-label">Select Which You Want to Give Role Rights</label>
                                                    <select class="form-control" id="company_id" name="company_id" required>
                                                        <option value="">Select</option>
                                                        <?php
                                                        foreach ($company as $key => $value) 
                                                        { ?>
                                                            <option value="<?php echo $value->tbl_roles_id; ?>"><?php echo $value->tbl_roles_title; ?></option>
                                                        <?php 
                                                        }
                                                        ?>
                                                    </select>
                                            </div> 
                                    </div> 
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-4 form-group mb-3 centerdt">
                                        check all
                                                        <div class="checked" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" name="checkall" id="checkall">
                                                        </div>
                                    </div> 
                                </div>
                                 
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col" rowspan="2">Module Name</th>
                                                    <th scope="col" colspan="4">Permissions</th>
                                                </tr>
                                                <tr>
                                                    <th class="text-center">View</th>
                                                    <th class="text-center">Add</th>
                                                    <th class="text-center">Edit</th>
                                                    <th class="text-center">Delete</th>
                                                </tr>        
                                            </thead>
                                            <tbody>
                                                <?php
                                                $rightsaccess = array('adminmaster' => 'Admin Master','role_rights' => 'Role Rights','user' => 'Users','login_history' => 'Login History');
                                                foreach ($rightsaccess as $key => $value) {
                                                ?>

                                                <tr>
                                                    <td><?php echo $value;?><input type="hidden" class="controller" name="controller[<?php echo $key; ?>]" id="controller" value="Rights"></td>
                                                    <td class="text-center">
                                                        <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" value="1" class="checkbox" name="<?php echo $key; ?>[index]" id="index">
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" value="1" class="checkbox" name="<?php echo $key; ?>[add]" id="add">
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" value="1" class="checkbox" name="<?php echo $key; ?>[edit]" id="edit">
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" value="1" class="checkbox" name="<?php echo $key; ?>[delete]" id="delete">
                                                        </div>
                                                    </td>                
                                                </tr>

                                                <?php
                                                }
                                                ?>
                                            </tbody>        
                                        </table>          
                                    </div>        
                                </div>         
                                <div class="col-md-12">
                                    <button class="btn btn-primary">Submit</button>
                                </div>
                            <?php echo form_close(); ?>
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
        //alert("jfgjjhfkjh");
        $('.checkbox').change(function() {
            //alert($(this).val());
            if ($(this).prop('checked')==true){ 
                //do something
                //alert("checked");
                $(this).val(1);
            }
            else
            {
                $(this).val(0);
            }
        });
        var clubed = '';
       $('#checkall').click(function(){
        if($(this). prop("checked") == true){
             $(".table .checkbox").prop("checked",true);  
             $(".table .checkbox").val(1);
        }
        else
        {
            $(this).prop("checked",false);
            $(".table .checkbox").prop("checked",false);
            $(".table .checkbox").val(0);
        }

      });
            

            $("#company_id").change(function() {
                var childuser = $(this).val();
                //alert(childuser);
                jQuery.ajax({
                    type: "POST",
                    url: "<?=base_url()?>admin/Role_Rights/show_data_child",
                    dataType: 'text',
                    data: {childuser:childuser},
                    success: function(res) 
                    {
                      //alert(res);
                            var obj = jQuery.parseJSON(res);
                            //alert(obj);
                            //console.log(obj);
                            
                            if(obj != 0)
                            {
                                var editnewdt = obj.editdata;
                                //alert(editnewdt);
                                //console.log(editnewdt);
                                var jsdataedit = JSON.stringify(editnewdt);
                               // console.log(jsdataedit);

                                $.each(editnewdt, function(k, v) {
                                    /// do stuff
                                    //console.log(v.tbl_role_rights_page_name);
                                    //alert(k);
                                    //alert(k);
                                    if(v.tbl_role_rights_add == 1)
                                    {
                                        
                                        $('input[name="'+v.tbl_role_rights_page_name+'[add]"]').prop("checked", true).trigger("change");
                                    }
                                    if(v.tbl_role_rights_edit == 1)
                                    {
                                        //alert('fhjfg');
                                        $('input[name="'+v.tbl_role_rights_page_name+'[edit]"]').prop("checked", true).trigger("change");
                                    }
                                    if(v.tbl_role_rights_delete == 1)
                                    {
                                        //alert('fhjfg');
                                        $('input[name="'+v.tbl_role_rights_page_name+'[delete]"]').prop("checked", true).trigger("change");
                                    }
                                    if(v.tbl_role_rights_view == 1)
                                    {
                                        //alert('fhjfg');
                                        $('input[name="'+v.tbl_role_rights_page_name+'[index]"]').prop("checked", true).trigger("change");
                                    }

                                    /*if(k == 'tbl_role_rights_view')
                                    {
                                        if(v != 1)
                                        {
                                            $("#index").prop("checked", false).trigger("change");
                                        }
                                        else
                                        {
                                           $("#index").prop("checked", true).trigger("change");
                                        }
                                    }
                                    if(k == 'tbl_role_rights_edit')
                                    {
                                        if(v != 1)
                                        {
                                            $("#edit").prop("checked", false).trigger("change");
                                        }
                                        else
                                        {
                                           $("#edit").prop("checked", true).trigger("change");
                                        }
                                    }
                                    if(k == 'tbl_role_rights_delete')
                                    {
                                        if(v != 1)
                                        {
                                            $("#delete").prop("checked", false).trigger("change");
                                        }
                                        else
                                        {
                                           $("#delete").prop("checked", true).trigger("change");
                                        }
                                    }*/
                                });
                                $("#infoMessages").hide();
                            }
                            else
                            {  $("#infoMessages").show();
                               $("#infoMessages").html('Add Access To this user');
                            }
                            
                    }
                });
            });
            
            $("input[name='adminmaster[index]']").change(function(){
                //alert($(this).val());
                if ($(this).val() == '1') {
                    $('input[name="adminmaster[add]"]').prop("checked", true).trigger("change");
                    $('input[name="adminmaster[edit]"]').prop("checked", true).trigger("change");
                    $('input[name="adminmaster[delete]"]').prop("checked", true).trigger("change");
                }
                else{
                    $('input[name="adminmaster[add]"]').prop("checked", false).trigger("change");
                    $('input[name="adminmaster[edit]"]').prop("checked", false).trigger("change");
                    $('input[name="adminmaster[delete]"]').prop("checked", false).trigger("change"); 
                }
            });

            $("input[name='role_rights[index]']").change(function(){
                //alert($(this).val());
                if ($(this).val() == '1') {
                    $('input[name="role_rights[add]"]').prop("checked", true).trigger("change");
                    $('input[name="role_rights[edit]"]').prop("checked", true).trigger("change");
                    $('input[name="role_rights[delete]"]').prop("checked", true).trigger("change");
                }
                else{
                    $('input[name="role_rights[add]"]').prop("checked", false).trigger("change");
                    $('input[name="role_rights[edit]"]').prop("checked", false).trigger("change");
                    $('input[name="role_rights[delete]"]').prop("checked", false).trigger("change"); 
                }
            });

            $("input[name='user[index]']").change(function(){
                //alert($(this).val());
                if ($(this).val() == '1') {
                    $('input[name="user[add]"]').prop("checked", true).trigger("change");
                    $('input[name="user[edit]"]').prop("checked", true).trigger("change");
                    $('input[name="user[delete]"]').prop("checked", true).trigger("change");
                }
                else{
                    $('input[name="user[add]"]').prop("checked", false).trigger("change");
                    $('input[name="user[edit]"]').prop("checked", false).trigger("change");
                    $('input[name="user[delete]"]').prop("checked", false).trigger("change"); 
                }
            });

            $("input[name='login_history[index]']").change(function(){
                //alert($(this).val());
                if ($(this).val() == '1') {
                    $('input[name="login_history[add]"]').prop("checked", true).trigger("change");
                    $('input[name="login_history[edit]"]').prop("checked", true).trigger("change");
                    $('input[name="login_history[delete]"]').prop("checked", true).trigger("change");
                }
                else{
                    $('input[name="login_history[add]"]').prop("checked", false).trigger("change");
                    $('input[name="login_history[edit]"]').prop("checked", false).trigger("change");
                    $('input[name="login_history[delete]"]').prop("checked", false).trigger("change"); 
                }
            });

    });
    </script>
      <!--   <script type="text/javascript">
            $(document).ready(function(){
                //$('#companyform').show();
              $("#usertypesub").click(function(e){
                e.preventDefault();

                var type = $("#usertype").val();
                //alert(type);
                $(".modal").hide();
                if(type == 'company')
                {
                    $('#companyform').show();
                    $('#showseluser').hide();
                    $('#type').val(type);
                    $("#company_id").prop('required',false);
                    $("#tbl_user_state").prop('required',false);

                }
                else if(type == 'admin')
                {
                    $('#companyform').show();
                    $('#showseluser').hide();
                    $('#type').val(type);
                    $("#company_id").prop('required',true);
                    $("#tbl_user_state").prop('required',false);
                }
                else
                {   //$('#otheruserform').show();
                    $('#showseluser').hide();
                    $('#companyform').show();
                    $("#company_id").prop('required',true);
                    $("#tbl_user_state").prop('required',true);
                    /*jQuery.ajax({
                    type: "POST",
                    url: "<?=base_url()?>company/Company/companydata",
                    dataType: 'json',
                    data: {},
                    success: function(res) {
                    if (res)
                    {
                        alert(res);
                        console.log(res);
                        var obj = JSON.stringify(res);
                        alert(obj);
                    // Show Entered Value
                    }
                    }
                    });*/
                }
              });

              $("#generatepass").click(function(){

                //alert("generatepass");

                /*function randomPassword() {*/
                    var chars = "abcdefghijklmnopqrstuvwxyz!@#$%^&*()-+<>ABCDEFGHIJKLMNOP1234567890";
                    var pass = "";
                    for (var x = 0; x < 11; x++) {
                        var i = Math.floor(Math.random() * chars.length);
                        pass += chars.charAt(i);
                    }
                    //alert(pass);
                    $('#password').val(pass);
                    
                //}
              });
            });
        </script> -->
    </body>
</html>