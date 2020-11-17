<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
        <?= $header; ?>
        <div class="container">

                    <!-- breadcrumb -->
                    <div class="breadcrumb-header justify-content-between">
                        <div>
                            <h4 class="content-title mb-2">Admin Profile</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= site_url('admin/home') ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
                                </ol>
                            </nav>

                        </div>

                        <?php //print_r($userdt);
                        
                         foreach ($userdt as $key => $user) {
                             # code...
                         }

                        ?>
                        <div class="my-auto breadcrumb-right">
							<a href="<?=site_url('admin/smme/Application')?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-bell mr-2"></i></span><span class="btn-text">Status </span></button></a>
							<a href="<?=site_url('admin/Home/profile') ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Personal Details </span></button></a>
							<button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-question-circle mr-2"></i> </span><span class="btn-text">Help </span></button>
						</div>
                    </div>
                    <!-- breadcrumb -->

                    <!-- row -->
                    

                    <div class="row row-sm">
                        <!-- Col -->

                        <div class="col-lg-4">
                            <div class="card mg-b-20">
                                <div class="card-body">
                                    <?php echo form_open_multipart("admin/Home/update_profile_image/".$user->tbl_admins_id, 'class="login" data-toggle="validator"'); ?>
                                    <div class="pl-0">
                                        <div class="main-profile-overview">
                                            
                                                <!-- <div class="main-img-user profile-user"><img alt="" src="<?php echo base_url(); ?>assets/users/1.jpg?>"><a href="JavaScript:void(0);" class="fas fa-camera profile-edit"></a></div> -->
                                            <?php if($user->tbl_admins_image != ''){ ?>
                                             <div class="main-img-user profile-user"><img alt="" src="<?php echo base_url(); ?>assets/admin/<?php echo $user->tbl_admins_image;?>"><a href="JavaScript:void(0);" class="fas fa-camera profile-edit"></a></div>
                                            <?php 
                                            }
                                            else
                                            {?>
                                                <div class="main-img-user profile-user">
                                                    <div class="avatar avatar-xxl bg-secondary rounded-circle" style="display: inline-block;">
                                                        <span style="padding: 10px 15px;display: flex;"><?php 
                                                        echo substr(ucfirst($this->session->userdata('adminfname')),0,1).substr(ucfirst($this->session->userdata('adminfname')),0,1);
                                                        ?></span>
                                                    </div><a href="JavaScript:void(0);" class="fas fa-camera profile-edit"></a>
                                                </div>
                                            <?php 
                                            }
                                            ?>
                                            <div class="d-flex justify-content-between mg-b-20">
                                                <div>
                                                    <div class="form-group edit_photo">
                                                        <div class="row">
                                                            <div class="col-md-9">
                                                                <input type="file" name="tbl_users_photo" class="custom-file-input" id="tbl_users_photo">
                                                                <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02" id="tbl_users_photo_label">Choose file</label>
                                                                <input type="hidden" name="old_tbl_users_photo" value="<?php echo $user->tbl_admins_image;?>">
                                                            </div>
                                                             <div class="col-md-3">

                                                                <button class="btn btn-primary mr-0" type="Submit">Submit</button>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between mg-b-20">
                                                <div>
                                                    <h5 class="main-profile-name"><?php echo $user->tbl_admins_firstname." ".$user->tbl_admins_lastname?></h5>
                                                </div>
                                            </div>
                                            <!-- main-profile-bio -->
                                            <div class="main-profile-work-list">
                                                <div class="media">
                                                    <div class="media-logo bg-success-transparent text-success">
                                                        <i class="mdi mdi-account-alert"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        
                                                        <p><?php echo $user->tbl_roles_title; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- main-profile-work-list -->

                                            <hr class="mg-y-30">
                                            <label class="main-content-label tx-13 mg-b-20">Login Id</label>
                                            <div class="main-profile-social-list">
                                                <div class="media">
                                                    <div class="media-icon bg-primary-transparent text-primary">
                                                        <i class="la la-envelope"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <span>Email</span> <a href=""><?php echo $user->tbl_admins_email;?></a>
                                                    </div>
                                                </div>
                                                
                                            </div><!-- main-profile-social-list -->
                                        </div><!-- main-profile-overview -->
                                    </div>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                            <div class="card mg-b-20">
                                <div class="card-body">
                                    <div class="main-content-label tx-13 mg-b-25">
                                        Conatct
                                    </div>
                                    <div class="main-profile-contact-list">
                                        <div class="media">
                                            <div class="media-icon bg-primary-transparent text-primary">
                                                <i class="icon ion-md-phone-portrait"></i>
                                            </div>
                                            <div class="media-body">
                                                <span>Mobile</span>
                                                <div>
                                                    <?php echo $user->tbl_admins_mobile;?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="media">
                                            <div class="media-icon bg-success-transparent text-success">
                                                <i class="icon ion-logo-slack"></i>
                                            </div>
                                            <div class="media-body">
                                                <span>Slack</span>
                                                <div>
                                                    @spruko.w
                                                </div>
                                            </div>
                                        </div> -->
                                    </div><!-- main-profile-contact-list -->
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-body tab-content">
                                        <?php foreach ($userdt as $value) {
                                          echo admin_form_open("admin/adminmaster/AdminMaster/update/".$value->tbl_admins_id, 'class="login" data-toggle="validator"');
                                         ?>
                                            <div class="row">
                                                <!-- <div class="col-md-12 form-group mb-3">
                                                    <label for="firstName1">Role*</label>
                                                    <select name="role" class="form-control" id="role">
                                                        <option value="">Select</option>
                                                        <?php foreach ($role as $key => $ro){
                                                            ?>
                                                            <option value="<?php echo $ro->tbl_roles_id; ?> "<?php if($value->tbl_admins_roleid == $ro->tbl_roles_id){echo "selected";} ?>><?php echo $ro->tbl_roles_title; ?></option>
                                                            
                                                        <?php } ?>
                                                    </select>
                                                   
                                                </div> -->
                                                <div class="col-md-6 form-group mb-3">
                                                    <label for="firstName1">First Name*</label>
                                                    <input type="text" name="firstname" class="form-control" id="firstname" pattern="^[A-Za-z -]+$" required="" title="First Name will not contain any number" placeholder="Enter your First Name"
                                                    value="<?php echo $value->tbl_admins_firstname; ?>" />
                                                   
                                                </div>

                                                <div class="col-md-6 form-group mb-3">
                                                    <label for="lastName1">Last Name</label>
                                                    <input type="text" name="lastname" class="form-control" id="lastname" pattern="^[A-Za-z -]+$" title="Last Name will not contain any number" placeholder="Enter your Last Name" value="<?php echo $value->tbl_admins_lastname; ?>"/>
                                                </div>

                                                <div class="col-md-6 form-group mb-3">
                                                    <label for="exampleInputEmail1">Email address*</label>
                                                    <input type="email" name="email" class="form-control" id="email" required="" placeholder="Enter your Email Address" value="<?php echo $value->tbl_admins_email; ?>"/>
                                                </div>

                                                <div class="col-md-6 form-group mb-3">
                                                    <label for="phone">Mobile No.</label>
                                                    <input type="text" name="phone" class="form-control" id="phone" maxlength="13" minlength="8" pattern="[0-9]{8,13}" title="Phone Number length should be between 8-13" placeholder="Enter your Phone Number" value="<?php echo $value->tbl_admins_mobile; ?>" />
                                                    <input type="hidden" name="country_code" id="country_code" class="form-control" value="<?php echo $value->tbl_admins_countrycode; ?>">
                                                </div>

                                                <div class="col-md-12">
                                                    <button class="btn btn-primary sub">Submit</button>
                                                </div>
                                            </div>
                                        <?php echo form_close();  } ?>
                                    </div>
                                </div>
                               
                                <!-- <div class="card-footer">
                                    
                                </div> -->
                            </div>
                        </div>
                        
                        <!-- /Col -->
                    </div>
                    
                    <!-- row closed -->
                </div>
        <?= $footer; ?>
        <script type="text/javascript">
            $('document').ready(function(){
                //alert($(".iti__selected-flag").html());
                
                $('.iti__selected-flag .iti__flag').removeClass('iti__us').addClass('iti__ls');
                var cc = $('#country_code').val();
                var ccf=cc.split('-');
                $('.iti__selected-flag .iti__flag').addClass('iti__'+ccf[0]);
                

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


                $('.edit_photo').hide();

                $('.profile-edit').click(function(){                    
                    $('.edit_photo').toggle();
                });
            });
        </script>
        <script type="text/javascript">
       $(document).ready(function() {
        $('.border').css('border','none');
           // body...
           
        $('#tbl_users_photo').change(function() {
          var file = $('#tbl_users_photo')[0].files[0].name;
          $('#tbl_users_photo_label').text(file);
        });
       })
   </script>
    </body>
</html>