<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
        <?= $header; ?>
        <div class="container">

                    <!-- breadcrumb -->
                   <div class="breadcrumb-header justify-content-between">
                        <div>
                            <h4 class="content-title mb-2">SMME Edit Details</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= site_url('incubator/home') ?>">Home</a></li>
                                    <li class="breadcrumb-item"><a href="<?= site_url('incubator/smme') ?>">SMME</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit SMME</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="my-auto">
                            <div class="d-flex">
                               <!-- <h4 class="content-title mb-0 my-auto">SMME Details</h4> <span class="text-muted mt-1 tx-13 ml-2 mb-0">/ Edit-Profile</span> -->
                            </div>
                        </div>

                        <?php //print_r($userdt);
                        //if($personal)
                        foreach ($personal as $key => $per) {
                             # code...
                         }
                         foreach ($userdt as $key => $user) {
                             # code...
                         }
                         foreach ($business as $key => $buss) {
                             # code...
                         } 



                        ?>
                        <!-- <div class="d-flex my-auto breadcrumb-right">
                            <button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-envelope"></i></span> <span class="btn-text">Email</span></button> <button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-print"></i></span> <span class="btn-text">Print</span></button> <button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-download"></i></span> <span class="btn-text">Export</span></button>
                        </div> -->
                    </div>
                    <!-- breadcrumb -->

                    <!-- row -->
                    

                    <div class="row row-sm">
                        <!-- Col -->

                        <div class="col-lg-4">
                            <div class="card mg-b-20">
                                <div class="card-body">
                                    <?php echo form_open_multipart("incubator/smme/Smme/update_profile_image/".$user->tbl_users_id, 'class="login" data-toggle="validator"'); ?>
                                    <div class="pl-0">
                                        <div class="main-profile-overview">
                                            <?php if($user->tbl_users_photo != ''){ ?>
                                             <div class="main-img-user profile-user"><img alt="" src="<?php echo base_url(); ?>assets/users/<?php echo $user->tbl_users_photo;?>"><a href="JavaScript:void(0);" class="fas fa-camera profile-edit"></a></div>
                                            <?php 
                                            }
                                            else
                                            {?>
                                                <div class="main-img-user profile-user"><img alt="" src="<?php echo base_url(); ?>assets/users/1.jpg?>"><a href="JavaScript:void(0);" class="fas fa-camera profile-edit"></a></div>
                                            <?php 
                                            }
                                            ?>
                                            <div class="d-flex justify-content-between mg-b-20">
                                                <div>
                                                    <div class="form-group edit_photo">
                                                        <div class="row">
                                                            <div class="col-md-9">
                                                                <input type="file" name="tbl_users_photo" class="custom-file-input" id="tbl_users_photo">
                                                                <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                                <input type="hidden" name="old_tbl_users_photo" value="<?php echo $user->tbl_users_photo;?>">
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
                                                    <h5 class="main-profile-name"><?php echo $user->tbl_users_firstname." ".$user->tbl_users_lastname?></h5>
                                                    <p class="main-profile-name-text"><?php if(!empty($personal)){echo $per->tbl_personal_details_occupation; }?></p>
                                                </div>
                                            </div>
                                            <h6>Bio</h6>
                                            <div class="main-profile-bio">
                                                pleasure rationally encounter but because pursue consequences that are extremely painful.occur in which toil and pain can procure him some great pleasure.. <a href="">More</a>
                                            </div>

                                            <!-- main-profile-bio -->
                                            <div class="main-profile-work-list">
                                                <div class="media">
                                                    <div class="media-logo bg-success-transparent text-success">
                                                        <i class="mdi mdi-account-alert"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6>Gender
                                                        <p><?php if($user->tbl_users_gender == 'M')
                                                        {
                                                            echo "Male";

                                                        }else if($user->tbl_users_gender == 'F')
                                                        {
                                                            echo "Female";

                                                        }
                                                        else
                                                        {
                                                            echo "Other";

                                                        } ?></p>
                                                    </div>
                                                </div>
                                                <div class="media">
                                                    <div class="media-logo bg-primary-transparent text-primary">
                                                        <i class="icon ion-logo-buffer"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6>Education <a href=""></a></h6><!-- <span>2004-2008</span>-->
                                                        <p><?php if(!empty($personal)){ echo $per->tbl_personal_details_education; } ?></p> 
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- main-profile-work-list -->

                                            <hr class="mg-y-30">
                                            <label class="main-content-label tx-13 mg-b-20">Social</label>
                                            <div class="main-profile-social-list">
                                                <div class="media">
                                                    <div class="media-icon bg-primary-transparent text-primary">
                                                        <i class="la la-envelope"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <span>Email</span> <a href=""><?php echo $user->tbl_users_email;?></a>
                                                    </div>
                                                </div>
                                                <!-- <div class="media">
                                                    <div class="media-icon bg-success-transparent text-success">
                                                        <i class="icon ion-logo-twitter"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <span>Twitter</span> <a href="">twitter.com/spruko.me</a>
                                                    </div>
                                                </div>
                                                <div class="media">
                                                    <div class="media-icon bg-info-transparent text-info">
                                                        <i class="icon ion-logo-linkedin"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <span>Linkedin</span> <a href="">linkedin.com/in/spruko</a>
                                                    </div>
                                                </div>
                                                <div class="media">
                                                    <div class="media-icon bg-danger-transparent text-danger">
                                                        <i class="icon ion-md-link"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <span>My Portfolio</span> <a href="">spruko.com/</a>
                                                    </div>
                                                </div> -->
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
                                                    <?php echo "+".$user->tbl_users_contrycode."".$user->tbl_users_mobile;?>
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
                                        <div class="media">
                                            <div class="media-icon bg-info-transparent text-info">
                                                <i class="icon ion-md-locate"></i>
                                            </div>
                                            <div class="media-body">
                                                <span>Current Address</span>
                                                <div>
                                                    <?php
                                                    if(!empty($personal)){
                                                     echo $per->tbl_personal_details_town_village."<br>".$per->tbl_personal_details_district."<br>".$per->tbl_personal_details_postcode;
                                                     }
                                                     ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- main-profile-contact-list -->
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <?php echo form_open_multipart("incubator/smme/Smme/update/".$user->tbl_users_id, 'class="login" data-toggle="validator"'); ?>
                                    <div class="border">
                                            <div class="bg-gray-300 nav-bg">
                                                <nav class="nav nav-tabs">
                                                    <a class="nav-link active" data-toggle="tab" href="#tabCont1">Personal Information</a>
                                                    <a class="nav-link" data-toggle="tab" href="#tabCont2">Business Details</a>
                                                    <a class="nav-link teamdt" data-toggle="tab" href="#tabCont3">SMME Team</a>
                                                </nav>
                                            </div>
                                            <div class="card-body tab-content">
                                                <div class="tab-pane active show" id="tabCont1">
                                                    <div class="form-group ">
                                                        <div class="row">
                                                            <input type="hidden" name="tbl_users_id" value="<?php echo $user->tbl_users_id;?>">
                                                            <input type="hidden" name="tbl_personal_details_id" value="<?php if(!empty($personal)){ echo $per->tbl_personal_details_id; } ?>">
                                                            <input type="hidden" name="tbl_business_details_id" value="<?php if(!empty($business)){ echo $buss->tbl_business_details_id; } ?>">
                                                            <div class="col-md-3">
                                                                <label class="form-label">Occupation</label>
                                                            </div>
                                                             <div class="col-md-9">
                                                                <input type="text" name="tbl_personal_details_occupation" class="form-control" id="tbl_personal_details_occupation" placeholder="Occupation" value="<?php if(!empty($personal)){echo $per->tbl_personal_details_occupation; }?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="mb-4 main-content-label">Name</div> -->
                                                    <div class="form-group ">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label class="form-label">First Name</label>
                                                            </div>
                                                            <div class="col-md-9">
                                                            <input type="text" name="tbl_users_firstname" class="form-control" id="tbl_users_firstname" placeholder="First Name" value="<?php if(!empty($userdt)){ echo $user->tbl_users_firstname; } ?>"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label class="form-label">Last Name</label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="text" name="tbl_users_lastname" class="form-control" id="tbl_users_lastname" placeholder="Last Name" value="<?php if(!empty($userdt)){ echo $user->tbl_users_lastname; } ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label class="form-label">Mobile No.</label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                    <input class="form-control" id="phone" name="tbl_users_mobile" type="tel" value="<?php if(!empty($userdt)){ echo $user->tbl_users_mobile; } ?>">
                                                                    <input type="hidden" name="country_code" id="country_code" class="form-control" value="<?php if(!empty($userdt)){ echo $user->tbl_users_contrycode; } ?>">
                                                                    <!-- <div class="col-md-2"><?php
                                                                    ?>
                                                                        <select class="form-control js-example-basic-single" id="tbl_users_contrycode" name="tbl_users_contrycode">
                                                                           <option value="">Select</option>
                                                                            <?php 
                                                                            foreach ($array as $key => $value) 
                                                                            {?>
                                                                                <option value="<?php echo $key;?>"<?php if($key == $user->tbl_users_contrycode){echo "selected";} ?>><?php echo "+".$key;?></option>
                                                                            <?php 
                                                                            }
                                                                            ?>
                                                                        </select> 
                                                                    </div>
                                                                    <div class="col-md-10">
                                                                        <input type="text" name="tbl_users_mobile" class="form-control" id="tbl_users_mobile"  pattern="[0-9]{10}" title="Phone Number length should be 10" placeholder="Enter your Mobile Number" value="<?php if(!empty($userdt)){ echo $user->tbl_users_mobile; } ?>"/>
                                                                    </div> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label class="form-label">Optional Phone No.</label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="text" name="tbl_personal_details_optional_telephone" class="form-control" id="tbl_personal_details_optional_telephone" placeholder="Enter Optopnal Phone Number" value="<?php if(!empty($personal)){ echo $per->tbl_personal_details_optional_telephone; } ?>"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label class="form-label">Gender</label>
                                                            </div>
                                                            <?php
                                                            if(!empty($user) && $user->tbl_users_gender == 'M')
                                                            {
                                                            ?>
                                                            <div class="col-md-3">
                                                               <label class="rdiobox"><input name="tbl_users_gender" type="radio" value="M" checked=""> <span>Male</span></label>

                                                            </div>
                                                            <div class="col-md-3">
                                                               <label class="rdiobox"><input name="tbl_users_gender" type="radio" value="F"> <span>Female</span></label>
                                                            </div>
                                                            <div class="col-md-3">
                                                               <label class="rdiobox"><input name="tbl_users_gender" type="radio" value="O"> <span>Other</span></label>
                                                            </div>
                                                            <?php
                                                            }else if(!empty($user) && $user->tbl_users_gender == 'F')
                                                            {
                                                            ?>
                                                            <div class="col-md-3">
                                                               <label class="rdiobox"><input name="tbl_users_gender" type="radio" value="M" > <span>Male</span></label>

                                                            </div>
                                                            <div class="col-md-3">
                                                               <label class="rdiobox"><input name="tbl_users_gender" type="radio" value="F" checked=""> <span>Female</span></label>
                                                            </div>
                                                            <div class="col-md-3">
                                                               <label class="rdiobox"><input name="tbl_users_gender" type="radio" value="O"> <span>Other</span></label>
                                                            </div>
                                                            <?php
                                                            }else                                  
                                                            {
                                                            ?>
                                                            <div class="col-md-3">
                                                               <label class="rdiobox"><input name="tbl_users_gender" type="radio" value="M" > <span>Male</span></label>

                                                            </div>
                                                            <div class="col-md-3">
                                                               <label class="rdiobox"><input name="tbl_users_gender" type="radio" value="F" > <span>Female</span></label>
                                                            </div>
                                                            <div class="col-md-3">
                                                               <label class="rdiobox"><input name="tbl_users_gender" type="radio" value="O" checked=""> <span>Other</span></label>
                                                            </div>
                                                            <?php
                                                            }
                                                            ?>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label class="form-label">How Did You Know?</label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <?php $social = 
                                                                array('others','facebook','instagram','twitter','hordings','addvertisements','website');
                                                                //print_r($social);
                                                                ?>
                                                                <select name="tbl_personal_details_howdidyouknow" class="form-control" id="tbl_personal_details_howdidyouknow">
                                                                    <?php
                                                                    foreach ($social as $key => $value) { 
                                                                        if(!empty($personal)){ ?>
                                                                        <option value="<?php echo $value;?>"<?php if($value == $per->tbl_personal_details_howdidyouknow){echo "selected";}?>><?php echo $value;?></option>
                                                                        <?php }else{ ?>
                                                                            <option value="<?php echo $value;?>"><?php echo $value;?></option>
                                                                        <?php } ?>
                                                                   <?php }?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label class="form-label">Eduction</label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="text" name="tbl_personal_details_education" class="form-control" id="tbl_personal_details_education" placeholder="Education" value="<?php if(!empty($personal)){ echo $per->tbl_personal_details_education; } ?>"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label class="form-label">Eduction Doc.</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="custom-file">
                                                                    <input type="file" name="tbl_personal_details_educational_doc" class="custom-file-input" id="tbl_personal_details_educational_doc">
                                                                    <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <img alt="" src="<?php echo base_url(); ?>assets/users/<?php if(!empty($personal)){ echo $per->tbl_personal_details_educational_doc; } ?>">
                                                                <input type="hidden" name="old_tbl_personal_details_educational_doc" value="<?php if(!empty($personal)){ echo $per->tbl_personal_details_educational_doc; } ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label class="form-label">District</label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="text" name="tbl_personal_details_district" class="form-control" id="tbl_personal_details_district" placeholder="District" value="<?php if(!empty($personal)){ echo $per->tbl_personal_details_district; } ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label class="form-label">Town/Village</label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="text" name="tbl_personal_details_town_village" class="form-control" id="tbl_personal_details_town_village" placeholder="Town/Village" value="<?php if(!empty($personal)){ echo $per->tbl_personal_details_town_village; } ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <div class="form-group ">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label class="form-label">Post Code</label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="text" name="tbl_personal_details_postcode" class="form-control" id="tbl_personal_details_postcode" placeholder="Post Code" value="<?php if(!empty($personal)){ echo $per->tbl_personal_details_postcode; } ?>"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a class="btn btn-primary waves-effect waves-light next tabCont2">Next</a>
                                                </div>
                                                <div class="tab-pane" id="tabCont2">
                                                    
                                                    <div class="form-group ">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label class="form-label">Business Name</label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                 <input type="text" name="tbl_business_details_name" class="form-control" id="tbl_business_details_name" placeholder="Business Name" value="<?php if(!empty($business)){ echo $buss->tbl_business_details_name; } ?>"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label class="form-label">Insustry</label>
                                                            </div>
                                                            <div class="col-md-9">
                                                            <input type="text" name="tbl_business_details_industry" class="form-control" id="Insustry" value="<?php if(!empty($business)){ echo $buss->tbl_business_details_industry; } ?>"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label class="form-label">Business Email</label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="email" name="tbl_business_details_email" class="form-control" id="tbl_business_details_email"  placeholder="Enter your Email Address" value="<?php if(!empty($business)){ echo $buss->tbl_business_details_email; } ?>"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label class="form-label">Business Phone No.</label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="text" name="tbl_business_details_phone" class="form-control" id="tbl_business_details_phone" pattern="[0-9]{10}" title="Phone Number length should be 10" placeholder="Enter Optopnal Phone Number" value="<?php if(!empty($business)){ echo $buss->tbl_business_details_phone; } ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label class="form-label">Business District</label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="text" name="tbl_business_details_district" class="form-control" id="tbl_business_details_district" placeholder="Business District" value="<?php if(!empty($business)){ echo $buss->tbl_business_details_district; } ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label class="form-label">Business Town/Village</label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="text" name="tbl_business_details_town_village" class="form-control" id="tbl_business_details_town_village" placeholder="Business Town/Village" value="<?php if(!empty($business)){ echo $buss->tbl_business_details_town_village; } ?>"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label class="form-label">Business Doc.</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="custom-file">
                                                                    <input type="file" name="tbl_business_details_business_doc" class="custom-file-input" id="tbl_business_details_business_doc">
                                                                    <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose
                                                                                file</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <?php if(!empty($business)){
                                                                ?>

                                                                <img alt="" src="<?php echo  base_url(); ?>assets/users/<?php echo $buss->tbl_business_details_business_doc;?>">
                                                                <input type="hidden" name="old_tbl_business_details_business_doc" value="<?php echo $buss->tbl_business_details_business_doc;?>">
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label class="form-label">No Of Employees</label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="Number" name="tbl_business_details_employees" class="form-control" id="tbl_business_details_employees" placeholder="No Of Employees" value="<?php if(!empty($business)){ echo $buss->tbl_business_details_employees; } ?>"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label class="form-label">Investment Need</label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="text" name="tbl_business_details_investmant_need" class="form-control" id="tbl_business_details_investmant_need" placeholder="Investment Need" value="<?php if(!empty($business)){ echo $buss->tbl_business_details_investmant_need; } ?>"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label class="form-label">Are You a Team?</label>
                                                            </div>
                                                            <?php
                                                            if(!empty($business) && $buss->tbl_business_details_areyouteam == '1')
                                                            {
                                                            ?>
                                                            <div class="col-md-4">
                                                               <label class="rdiobox"><input name="tbl_business_details_areyouteam" type="radio" value="1" checked=""> <span>Yes</span></label>

                                                            </div>
                                                            <div class="col-md-4">
                                                               <label class="rdiobox"><input name="tbl_business_details_areyouteam" type="radio" value="0"> <span>No</span></label>
                                                            </div>
                                                            <?php
                                                            }else
                                                            {
                                                            ?>
                                                            <div class="col-md-4">
                                                               <label class="rdiobox"><input name="tbl_business_details_areyouteam" type="radio" value="1" > <span>Yes</span></label>

                                                            </div>
                                                            <div class="col-md-4">
                                                               <label class="rdiobox"><input name="tbl_business_details_areyouteam" type="radio" value="0" checked=""> <span>No</span></label>
                                                            </div>
                                                            <?php
                                                            }
                                                            ?>
                                                            
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-12">
                                                    <?php
                                                    if(!empty($business) && $buss->tbl_business_details_areyouteam == '1')
                                                    {
                                                    ?>
                                                    <a class="btn btn-primary waves-effect waves-light next tabCont3">Next</a>
                                                    <?php
                                                    }
                                                    else
                                                    {?>
                                                    <button class="btn btn-primary sub5">Submit</button>
                                                    <?php
                                                    }?>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="tabCont3">
                                                     <div class="col-md-12 team">
                                                        <div class="row ">
                                                             <section class="container col-xs-12">
                                                                <div class="table table-responsive">
                                                                <h4><!-- Select Team Details --></h4>
                                                                <table id="ppsale" class="table table-responsive table-striped table-bordered">
                                                                  <thead>
                                                                    <tr>
                                                                        <td style="background: none;">First Name</td>
                                                                        <td style="background: none;">Last Name</td>
                                                                        <td style="background: none;">Email</td>
                                                                        <td style="background: none;">Mobile NO.</td>
                                                                        <td style="background: none;">Remove</td>
                                                                      </tr>
                                                                  </thead>
                                                                  <tbody id="TextBoxContainer">
                                                                    <?php 
                                                                    if(!empty($smme_teams))
                                                                    {
                                                                    foreach ($smme_teams as $key => $value) {
                                                                        # code...
                                                                    ?>
                                                                   <tr>
                                                                       <td>
                                                                          <input name="tbl_smme_teams_first_name[]" class="sku form-control form-control-lg" id="tbl_smme_teams_first_name" type="text"  placeholder="Enter First Name" value="<?php echo $value->tbl_smme_teams_first_name; ?>">
                                                                        </td>
                                                                        <td>
                                                                          <input  name="tbl_smme_teams_last_name[]" class="form-control form-control-lg" id="tbl_smme_teams_last_name" type="text" placeholder="Enter Last Name" value="<?php echo $value->tbl_smme_teams_last_name; ?>">
                                                                        </td>
                                                                        <td>
                                                                          <input name="tbl_smme_teams_email[]" class="gst form-control form-control-lg" id="tbl_smme_teams_email"  type="text" placeholder="Enter Emailid"  value="<?php echo $value->tbl_smme_teams_email; ?>">
                                                                        </td>
                                                                        <td>
                                                                          <input name="tbl_smme_teams_mobile[]" class="qty form-control form-control-lg" id="tbl_smme_teams_mobile"  type="text" placeholder="Enter Mobile No."value="<?php echo $value->tbl_smme_teams_mobile; ?>">
                                                                        </td>                                           
                                                                        <td><button type="button" class="btn btn-danger remove" data-toggle="tooltip" data-original-title="Remove"><i class="typcn typcn-archive"></i></button></td>
                                                                   </tr>
                                                                   <?php
                                                                    } 
                                                                    }
                                                                    else
                                                                    {?>
                                                                        <td>
                                                                          <input name="tbl_smme_teams_first_name[]" class="sku form-control form-control-lg" id="tbl_smme_teams_first_name" type="text"  placeholder="Enter First Name">
                                                                        </td>
                                                                        <td>
                                                                          <input  name="tbl_smme_teams_last_name[]" class="price form-control form-control-lg" id="tbl_smme_teams_last_name" type="text" placeholder="Enter Last Name">
                                                                        </td>
                                                                        <td>
                                                                          <input name="tbl_smme_teams_email[]" class="gst form-control form-control-lg" id="tbl_smme_teams_email"  type="text" placeholder="Enter Emailid">
                                                                        </td>
                                                                        <td>
                                                                          <input name="tbl_smme_teams_mobile[]" class="qty form-control form-control-lg" id="tbl_smme_teams_mobile"  type="text" placeholder="Enter Mobile No.">
                                                                        </td>                                           
                                                                        <td>
                                                                            &nbsp;
                                                                        </td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                  </tbody>
                                                                  <tfoot>
                                                                    <tr>
                                                                      <th colspan="6">
                                                                      <button id="btnAdd" type="button" class="btn btn-success" data-toggle="tooltip" data-original-title="Add more" style="float: right;">+</button></th>
                                                                    </tr>
                                                                  </tfoot>
                                                                </table>
                                                                </div>
                                                              </section>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light sub1">Update Profile</button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php echo form_close(); ?>
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
                
                var cc = $('#country_code').val();
                var ccf=cc.split('-');
                $('.iti__selected-flag .iti__flag').addClass('iti__'+ccf[0]);
                $('#country-listbox li').click(function() {
                    var country_code = $(this).data("dial-code");
                    var country_code_flag = $(this).data("country-code");
                    $('#country_code').val(country_code_flag+'-'+country_code);
                });

                var pageURL = $(location).attr("href");
                if(pageURL.includes("#tabCont2"))
                {
                    var check = pageURL.split("#");
                    $('.nav-tabs a[href="#tabCont2"]').tab('show');
                }

                $('.edit_photo').hide();
                $('.profile-edit').click(function(){                    
                  $('.edit_photo').show();
                });
                $('.tabCont2').click(function(){
                  $('.nav-tabs a[href="#tabCont2"]').tab('show');
                });
                $('.tabCont3').click(function(){
                  $('.nav-tabs a[href="#tabCont3"]').tab('show');
                });
                $(".team").hide();
                $(".tabCont3").hide();
                $(".teamdt").hide();
                $(".sub").show();
                $(".sub1").hide();
                var radioValue = $("input[name='tbl_business_details_areyouteam']").val();
                    if(radioValue == 1){

                        $(".tabCont3").show();
                        $(".teamdt").show();
                        $(".team").show();
                        $(".sub").hide();
                        $(".sub1").show();

                        
                    }
                    else
                    {

                        $(".tabCont3").hide();
                        $(".teamdt").hide();
                        $(".team").hide();
                        $(".sub").show();
                        $(".sub1").hide();
                    }
                $("input[name='tbl_business_details_areyouteam']").click(function(){
                    var radioValue = $(this).val();
                    if(radioValue == 1){

                        $(".tabCont3").show();
                        $(".teamdt").show();
                        $(".team").show();
                        $(".sub").hide();
                        $(".sub1").show();

                        
                    }
                    else
                    {

                        $(".tabCont3").hide();
                        $(".teamdt").hide();
                        $(".team").hide();
                        $(".sub").show();
                        $(".sub1").hide();
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
                              return '<td><input name="tbl_smme_teams_first_name[]" class="sku form-control form-control-lg" id="tbl_smme_teams_first_name" type="text"  placeholder="Enter First Name"></td><td><input  name="tbl_smme_teams_last_name[]" class="form-control form-control-lg" id="tbl_smme_teams_last_name" type="text" placeholder="Enter Last Name"></td><td><input name="tbl_smme_teams_email[]" class="gst form-control form-control-lg" id="tbl_smme_teams_email"  type="text" placeholder="Enter Emailid"></td><td><input name="tbl_smme_teams_mobile[]" class="qty form-control form-control-lg" id="tbl_smme_teams_mobile"  type="text" placeholder="Enter Mobile No."></td><td><button type="button" class="btn btn-danger remove" data-toggle="tooltip" data-original-title="Remove"><i class="typcn typcn-archive"></i></button></td>';
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
