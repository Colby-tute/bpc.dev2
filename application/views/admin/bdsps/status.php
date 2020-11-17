<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
        <?= $header; ?>
        <div class="container">

                    <!-- breadcrumb -->
                   <div class="breadcrumb-header justify-content-between">
                        <div>
                            <h4 class="content-title mb-2">Operations</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= site_url('admin/home') ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="<?= site_url('admin/bdsps') ?>">Bdsp, Coaches or Mentors</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Update Details</li>
                                </ol>
                            </nav>
                         </div>
                        <div class="my-auto breadcrumb-right">
                        <a href="<?= site_url('admin/bdsps') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-arrow-circle-left mr-2"></i></span><span class="btn-text">Go Back </span></button></a>
							<a href="<?= site_url('admin/bdsps/Bdsps/add') ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-check-square mr-2"></i> </span><span class="btn-text">Create New Profile </span></button></a>
							<button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-question-circle mr-2"></i> </span><span class="btn-text">Help </span></button>
                         
                          <?php //print_r($userdt);
                        //if($personal)
                       
                         foreach ($userdt as $key => $user) {
                             # code...
                         }
                       


                        ?>
                            
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
                                        <?php echo form_open_multipart("admin/bdsps/Bdsps/update_status/".$user->tbl_users_id, 'class="login" data-toggle="validator"'); ?>
                                         <div id="companyform">
                                            <div class="col-md-12"> 
                                                    <div class="row">
                                                        <div id="error_msg"></div>
<div class="col-md-4 form-group mb-3" style="flex:0 0 100%;max-width:100%">
                                                          
                                                            <h4><?php echo  $user->tbl_users_firstname; ?>  <?php echo  $user->tbl_users_lastname; ?> </h4>
                                                        </div>



                                                       
														<div class="col-md-4" style="flex:0 0 100%;max-width:33%"> 
                                                        <label>Access Control Status</label> 
														<div class="row">
													     <?php if($user->login_approve==1){ ?>
																  
																  <div class="col-md-4"> 
																    <label class="rdiobox"><input name="tbl_users_status" type="radio" value="1" checked=""> <span>Enable</span></label>
                                                                    </div>
																	 <div class="col-md-4"> 
																	 <label class="rdiobox"><input name="tbl_users_status" type="radio" value="0" > <span>Disable</span></label>
																     </div>
																   <?php }else{ ?>
																   <div class="col-md-4"> 
																   <label class="rdiobox"><input name="tbl_users_status" type="radio" value="1" > <span>Enable</span></label>                                                                    
																    </div>
																  <div class="col-md-4"> 
																	<label class="rdiobox"><input name="tbl_users_status" type="radio" value="0" checked=""> <span>Disable</span></label>
                                                                  </div>															   
																   <?php } ?>
														</div>
														</div>
														<div class="col-md-12">
                                                          <button class="btn btn-primary sub">Submit</button>
                                                       </div> 
													</div>
												</div>
											</div>													   
                                        <?php echo form_close(); ?>
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
                /*$(document).ready(function(){
                   $('.js-example-basic-single').select2();
                });*/
        </script>
        <script type="text/javascript">
            $('#tbl_business_details_industry').change(function() {
                //alert($(this).val());
                var ind_id = $(this).val();
                if (ind_id == '') {
                    $('#tbl_business_details_subindustry').html('<option value="">Select Sub Industry</option>');
                }
                else
                {
                   jQuery.ajax({
                        type: "POST",
                        url: "<?=base_url()?>admin/bdsps/Bdsps/get_sub_industries",
                        dataType: 'text',
                        data: {ind_id:ind_id},
                        success: function(data) 
                        {
                            var obj = JSON.parse(data);
                            //console.log(obj);
                            var html = '';
                            $.each(obj, function( index, value ) {
                              html += '<option value="'+value.tbl_sub_industry_id+'">'+value.tbl_sub_industry_name+'</option>';
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
            //alert(sub_ind);
            jQuery.ajax({
                    type: "POST",
                    url: "<?=base_url()?>admin/bdsps/Bdsps/get_sub_industries",
                    dataType: 'text',
                    data: {ind_id:ind_id},
                    success: function(data) 
                    {
                        var obj = JSON.parse(data);
                        //console.log(obj);
                        var html = '';
                        $.each(obj, function( index, value ) {
                            if (value.tbl_sub_industry_id == sub_ind) {
                                html += '<option value="'+value.tbl_sub_industry_id+'" selected>'+value.tbl_sub_industry_name+'</option>';      
                            }else{
                                html += '<option value="'+value.tbl_sub_industry_id+'">'+value.tbl_sub_industry_name+'</option>';      
                            }
                        });
                        $('#tbl_business_details_subindustry').html(html);
                    }
                });
        </script>
        <script type="text/javascript">
            $('document').ready(function(){
                
                //$('.iti__selected-flag .iti__flag').removeClass('iti__us').addClass('iti__ls');
                var cc = $('#country_code').val();
                var ccf=cc.split('-');
                var input = document.querySelector("#phone");
                intlTelInput(input, {
                    initialCountry:ccf[0]
                });
                //$('.iti__selected-flag .iti__flag').addClass('iti__'+ccf[0]);
                

               /* $('#country-listbox li').click(function() {
                    var country_code = $(this).data("dial-code");
                    $('#country_code').val(country_code);
                    //alert($(".iti__selected-flag").attr('title'));
                    //var tdTitleAttr = $(your-td-element).attr('title');
                });*/

                $( "#country-listbox li" )
                  .focusout(function() {
                    var country_code = $(this).data("dial-code");
                    var country_code_flag = $(this).data("country-code");
                    //alert(country_code_flag+'-'+country_code);
                    $('#country_code').val(country_code_flag+'-'+country_code);
                });


                var radioValue = $("input[name='tbl_business_details_areyouteam']:checked").val();
                    if(radioValue == 1){

                        
                        $(".teams").show();
                        

                        
                    }
                    else
                    {

                        
                        $(".teams").hide();
                        
                    }
                $("input[name='tbl_business_details_areyouteam']").click(function(){
                    var radioValue = $(this).val();
                     if(radioValue == 1){

                        
                        $(".teams").show();
                        

                        
                    }
                    else
                    {

                        
                        $(".teams").hide();
                        
                    }
                });
                 $('#username').on('keyup', function(){
                  var username = $('#username').val();
                  $.ajax({
                    url: '<?=base_url()?>company/Company/check_username',
                    type: 'post',
                    data: {
                        'username' : username,
                        'id':0,
                    },
                    success: function(response){
                        //alert(response);
                        console.log(response);
                        var obj = jQuery.parseJSON(response);
                        var subcat_data = obj;
                      if (subcat_data == 'taken') {
                        //alert("fghdjhd");
                        
                        $('#username').siblings("span").text('Sorry... Username already taken Use Other Username').css("color", "red");
                        $('#sub').attr("disabled", true);
                      }else if (subcat_data == "not_taken") {
                       // alert("sdfre");
                       
                        $('#username').siblings("span").text('Username available').css("color", "green");
                        $('#sub').attr("disabled", false);
                      }/*
                      else
                      {
                        alert("syuerureyt");
                      }*/
                    }
                  });
                 });        
                $('#email').on('keyup', function(){
                    var email = $('#email').val();
                    $.ajax({
                      url: "<?=base_url()?>user/User/check_email",
                      type: 'post',
                      data: {
                        'email' : email,
                        'id':0,
                      },
                      success: function(response){
                        //alert(response);
                         var obj = jQuery.parseJSON(response);
                        var subcat_data = obj;
                        if (subcat_data == 'taken' ) {
                          $('#email').siblings("span").text('Sorry... Email id already taken Use Other Email id').css("color", "red");
                          $('#sub').attr("disabled", true);
                        }else if (subcat_data == 'not_taken') {
                          $('#email').siblings("span").text('Email id available').css("color", "green");
                          $('#sub').attr("disabled", false);
                        }
                      }
                    });
                });
            });
        </script>
        <script type="text/javascript">
                        $(document).ready(function() {
                         
                            $("#btnAdd").bind("click", function () {
                                var div = $("<tr />");
                                div.html(GetDynamicTextBox(""));
                                $("#TextBoxContainer").append(div);
                                
                            });
                            $("body").on("click", ".remove", function () {
                    
                                $(this).closest("tr").remove();
                              
                            });
                          });
                          function GetDynamicTextBox(value) 
                          {
                              return '<td><input name="tbl_smme_teams_first_name[]" class="sku form-control" id="tbl_smme_teams_first_name" type="text"  placeholder="Enter First Name"></td><td><input  name="tbl_smme_teams_last_name[]" class="form-control" id="tbl_smme_teams_last_name" type="text" placeholder="Enter Last Name"></td><td><input name="tbl_smme_teams_email[]" class="gst form-control" id="tbl_smme_teams_email"  type="text" placeholder="Enter Emailid"></td><td><input name="tbl_smme_teams_mobile[]" class="qty form-control" id="tbl_smme_teams_mobile"  type="text" placeholder="Enter Mobile No."></td><td><button type="button" class="btn btn-danger remove" data-toggle="tooltip" data-original-title="Remove" style="float: right;padding: 4px 10px;"><i class="typcn typcn-archive"></i></button></td>';
                          }
        </script>

        <script type="text/javascript">
            $(document).ready(function(){
                //get state
                $("#tbl_user_zone").change(function() {
                    var zone_id = $(this).val();
                   
                    jQuery.ajax({
                        type: "POST",
                        url: "<?=base_url()?>user/User/get_state_by_zone",
                        dataType: 'text',
                        data: {zone_id:zone_id},
                        success: function(data) 
                        { //alert(data);
                            //console.log(data);
                            var obj = jQuery.parseJSON(data);
                            var subcat_data = obj;
                            //console.log(subcat_data);
                            var html = '<option value="">Select</option>';
                            $.each(subcat_data,function(index,data){
                                //alert(data.tbl_subcategory_id);
                                html += '<option value="'+data.tbl_state_id+'">'+data.tbl_state_name+'</option>';
                              });
                            $('#tbl_user_state').html(html);
                        }
                    });
                return false;
                });
                //get city
                $("#tbl_user_state").change(function() {
                    var state_id = $(this).val();
                    
                    jQuery.ajax({
                        type: "POST",
                        url: "<?=base_url()?>user/User/get_city_by_state",
                        dataType: 'text',
                        data: {state_id:state_id},
                        success: function(data) 
                        { //alert(data);
                            //console.log(data);
                            var obj = jQuery.parseJSON(data);
                            var subcat_data = obj;
                            //console.log(subcat_data);
                            var html = '<option value="">Select</option>';
                            $.each(subcat_data,function(index,data){
                                //alert(data.tbl_subcategory_id);
                                html += '<option value="'+data.tbl_city_id+'">'+data.tbl_city_name+'</option>';
                              });
                            $('#tbl_user_city').html(html);
                        }
                    });
                return false;
                });
                $("#tbl_user_city").change(function() {
                    var city_id = $(this).val();
                    
                    jQuery.ajax({
                        type: "POST",
                        url: "<?=base_url()?>company/Company/get_zip_by_city",
                        dataType: 'text',
                        data: {city_id:city_id},
                        success: function(data) 
                        { //alert(data);
                            //console.log(data);
                            var obj = jQuery.parseJSON(data);
                            var subcat_data = obj;
                            //console.log(subcat_data);
                            var html = '<option value="">Select</option>';
                            $.each(subcat_data,function(index,data){
                                //alert(data.tbl_subcategory_id);
                                html += '<option value="'+data.tbl_zip_id+'">'+data.tbl_zip_code+'</option>';
                              });
                            $('#tbl_user_zip').html(html);
                        }
                    });
                return false;
                });
                $("#generatepass").click(function(){

                    var chars = "abcdefghijklmnopqrstuvwxyz!@#$%^&*()-+<>ABCDEFGHIJKLMNOP1234567890";
                    var pass = "";
                    for (var x = 0; x < 11; x++) {
                        var i = Math.floor(Math.random() * chars.length);
                        pass += chars.charAt(i);
                    }
                   
                    $('#password').val(pass);
                    
                 });
            });
        </script>
		 </body>
</html>