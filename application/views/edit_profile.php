<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
        <?= $header; ?>
        <div class="container">

                    <!-- breadcrumb -->
                    <div class="breadcrumb-header justify-content-between">
                        <div>
                <h4 class="content-title mb-2">Personal Details</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url('Home') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Update Personal Details</li>
                    </ol>
                </nav>

            </div>

                        <?php //print_r($userdt);
                      //if($personal)
                        foreach ($personal as $key => $per) {
                             # code...
                         }
                         foreach ($userdt as $key => $user) {
                             # code...
                         }

                        ?>
                        <div class="my-auto breadcrumb-right">
							<a href="<?= site_url('user/smme/Application') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-bell mr-2"></i></span><span class="btn-text">Status </span></button></a>
							<a href="<?= site_url('Profile/view_profile/'.$this->session->userdata('id_user')) ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Personal Details </span></button></a>
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
                                    <?php echo form_open_multipart("Profile/update_profile_image/".$user->tbl_users_id, 'class="login" data-toggle="validator"'); ?>
                                    <div class="pl-0">
                                        <div class="main-profile-overview">
                                            <?php if($user->tbl_users_photo != ''){ ?>
                                             <div class="main-img-user profile-user"><img alt="" src="<?php echo base_url(); ?>assets/users/<?php echo $user->tbl_users_photo;?>"><a href="JavaScript:void(0);" class="fas fa-camera profile-edit"></a></div>
                                            <?php 
                                            }
                                            else
                                            {?>
                                                <!-- <div class="main-img-user profile-user">
                                                    <img alt="" src="<?php echo base_url(); ?>assets/users/1.jpg"><a href="JavaScript:void(0);" class="fas fa-camera profile-edit"></a></div> -->
                                                    <div class="main-img-user profile-user">
                                                        <div class="avatar avatar-xxl bg-secondary rounded-circle" style="display: inline-block;">
                                                            <span style="padding: 10px 15px;display: flex;"><?php 
                                                            $explode = explode(' ',$this->session->userdata('username'));
                                                            echo substr(ucfirst($explode[0]),0,1).substr(ucfirst($explode[1]),0,1);
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
                                                                <input type="hidden" name="old_tbl_users_photo" value="<?php echo $user->tbl_users_photo;?>">
                                                            </div>
                                                             <div class="col-md-3">

                                                                <button class="btn btn-primary mr-0" type="Submit">Upload</button>
                                                                
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
                                                        <h6>Education Level<a href=""></a></h6><!-- <span>2004-2008</span>-->
                                                        <p><?php if(!empty($personal)){ echo $per->tbl_personal_details_education; } ?></p> 
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- main-profile-work-list -->

                                            <hr class="mg-y-30">

                                            <div class="main-profile-social-list">
                                                <!-- <div class="media">
                                                    <div class="media-icon bg-danger-transparent text-danger">
                                                        <i class="mdi mdi-account-card-details"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <span><?php echo $this->session->userdata('user_type_name');?> Login ID</span> 
                                                    </div>
                                                </div> -->

                                                <label class="main-content-label tx-13 mg-b-20"><?php echo $this->session->userdata('user_type_name');?> USERID</label> 
                                            <!-- main-profile-social-list -->
                                            <div class="media">
                                                    <div class="media-icon bg-primary-transparent text-primary">
                                                        <i class="la la-envelope"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <span>Email Address</span> <a href=""><?php echo $user->tbl_users_email;?></a>
                                                    </div>
                                                </div>
                                                
                                                
                                            </div>
                                            
                                        </div><!-- main-profile-overview -->
                                    </div>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                            <div class="card mg-b-20">
                                <div class="card-body">
                                    <div class="main-content-label tx-13 mg-b-25">
                                        Contact Details
                                    </div>
                                    <div class="main-profile-contact-list">
                                        <div class="media">
                                            <div class="media-icon bg-primary-transparent text-primary">
                                                <i class="icon ion-md-phone-portrait"></i>
                                            </div>
                                            <div class="media-body">
                                                <span>Mobile Number</span>
                                                <div>
                                                    <?php echo $user->tbl_users_mobile;?>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="media">
                                            <div class="media-icon bg-info-transparent text-info">
                                                <i class="icon ion-md-locate"></i>
                                            </div>
                                            <div class="media-body">
                                                <span>Physical Address</span>
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
                                    <div class="border">
                                        <div class="bg-gray-300 nav-bg">
                                            <nav class="nav nav-tabs">
                                                <a class="nav-link active" data-toggle="tab" href="#tabCont1">Personal Information</a>
                                                <a class="nav-link" data-toggle="tab" href="#tabCont2">Identity Document</a>
                                                <a class="nav-link" data-toggle="tab" href="#tabCont3">Educational Documents</a>
                                            </nav>
                                        </div>
                                        <div class="card-body tab-content">
                                            <div class="tab-pane active show" id="tabCont1">
                                                <?php echo form_open_multipart("Profile/update/".$user->tbl_users_id, 'class="login" data-toggle="validator"'); ?>
                                                <div class="form-group ">
                                                    <div class="row">
                                                        <input type="hidden" name="tbl_users_id" value="<?php echo $user->tbl_users_id;?>">
                                                        <input type="hidden" name="tbl_personal_details_id" value="<?php if(!empty($personal)){ echo $per->tbl_personal_details_id; } ?>">
                                                        <input type="hidden" name="tbl_business_details_id" value="<?php if(!empty($business)){ echo $buss->tbl_business_details_id; } ?>">
                                                        <div class="col-md-3">
                                                            <label class="form-label">Current Occupation</label>
                                                        </div>
                                                         <div class="col-md-9">
                                                            <input type="text" name="tbl_personal_details_occupation" class="form-control" id="tbl_personal_details_occupation" placeholder="Occupation" value="<?php if(!empty($personal)){echo $per->tbl_personal_details_occupation; }?>" required/>
                                                        </div>
                                                    </div>
                                                </div>
                            
                                                <div class="form-group ">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label class="form-label">First Name</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                        <input type="text" name="tbl_users_firstname" class="form-control" id="tbl_users_firstname" placeholder="First Name" value="<?php if(!empty($userdt)){ echo $user->tbl_users_firstname; } ?>" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label class="form-label">Last Name</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input type="text" name="tbl_users_lastname" class="form-control" id="tbl_users_lastname" placeholder="Last Name" value="<?php if(!empty($userdt)){ echo $user->tbl_users_lastname; } ?>" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label class="form-label">Mobile Number</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                                <input class="form-control" id="phone" name="tbl_users_mobile" type="tel" maxlength="10" value="<?php if(!empty($userdt)){ echo $user->tbl_users_mobile; } ?>">
                                                                <input type="hidden" name="country_code" id="country_code" class="form-control" value="<?php if(!empty($userdt)){ echo $user->tbl_users_contrycode; } ?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label class="form-label">Other Phone Number</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input type="text" name="tbl_personal_details_optional_telephone" class="form-control" maxlength="10" id="tbl_personal_details_optional_telephone" placeholder="Enter Optional Number" value="<?php if(!empty($personal)){ echo $per->tbl_personal_details_optional_telephone; } ?>" required/>
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
                                                            <label class="form-label">How did you hear about the VBI?</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <?php $social = 
                                                            array('Referral','Advertisements','Social Media','University','Business Plan Competition','Conference','Exhibition','Other');
                                                            //print_r($social);
                                                            ?>
                                                            <select name="tbl_personal_details_howdidyouknow" class="form-control" id="tbl_personal_details_howdidyouknow" required>
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
                                                            <label class="form-label">Education Level</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input type="text" name="tbl_personal_details_education" class="form-control" id="tbl_personal_details_education" placeholder="Education" value="<?php if(!empty($personal)){ echo $per->tbl_personal_details_education; } ?>" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label class="form-label">Date of Birth</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input type="date" name="tbl_personal_details_dob" class="form-control" id="tbl_personal_details_dob" value="<?php if(!empty($personal)){ echo $per->tbl_personal_details_dob; } ?>" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label class="form-label">District</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input type="text" name="tbl_personal_details_district" class="form-control" id="tbl_personal_details_district" placeholder="District" value="<?php if(!empty($personal)){ echo $per->tbl_personal_details_district; } ?>" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label class="form-label">Village/Town</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input type="text" name="tbl_personal_details_town_village" class="form-control" id="tbl_personal_details_town_village" placeholder="Town/Village" value="<?php if(!empty($personal)){ echo $per->tbl_personal_details_town_village; } ?>" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label class="form-label">Postal Code</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input type="text" name="tbl_personal_details_postcode" class="form-control" id="tbl_personal_details_postcode" placeholder="Post Code" value="<?php if(!empty($personal)){ echo $per->tbl_personal_details_postcode; } ?>" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary waves-effect waves-light sub1">Update Profile</button>
                                            <?php echo form_close(); ?>
                                            </div>
                                            <div class="tab-pane" id="tabCont2">
                                                <div class="row row-sm">
                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                        <?php echo form_open_multipart("Profile/identity_doc/".$user->tbl_users_id, 'class="login" data-toggle="validator"'); ?>
                                                        
                                                        <div class="card-body iconfont text-left">
                                                            <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="row">
                                                                        <div class="col-sm-7">    
                                                                            <label>
                                                                                Please select the type of document, select the document from your device/laptop and click on Upload
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-sm-5">    
                                                                            <select id="doc_type" name="doc_type" class="form-control">
                                                                                <option value="National Identity Document">National Identity Document</option>
                                                                                <option value="Passport">Passport</option>
                                                                                <option value="Driving License">Driving License</option>
                                                                                <option value="Other">Other</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-7">
                                                                            <input type="file" name="identity_doc_files" id="identity_doc_files" class="form-control" required>
                                                                        </div>
                                                                        <div class="col-md-5" style="text-align: right; ">
                                                                            <button class="btn btn-primary" type="submit" id="add_mul_doc">Upload</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered mg-b-0 text-md-nowrap" style="width: 100%;">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">PID</th>
                                                                        <th scope="col" class="table_title_width">Document Type</th>
                                                                        <!-- <th scope="col">Document</th> -->
                                                                        <th scope="col">Actions</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $i = 1;
                                                                    foreach ($identity_doc as $key => $value) { ?>
                                                                        <tr>
                                                                            <td><?php echo $i;?></td>
                                                                            <td><?php echo $value->doc_type;?></td>
                                                                            <td>
																			<button style="width:65%" data-toggle="dropdown" class="btn btn-primary btn-block button_width"><i class="la la-cog setting"></i></button>
															<div class="dropdown-menu">
                                                                                <a href="<?php echo base_url(); ?>assets/users/identity_document/<?php echo $value->tbl_all_documents_document;?>" target="_blank" class="btn btn-success btn-block btn_width"><i class="far fa-eye"></i></a>
                                                                                <a href="<?php echo site_url('Profile/delete_doc/') . $value->tbl_all_documents_id; ?>"  class="btn btn-danger btn-block btn_width"><i class="fa fa-trash"></i></a>
</div>                                                                       
																	   </td>
                                                                        </tr>
                                                                    <?php $i++; }
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        </div> 
                                                        <?php echo form_close(); ?>
                                                         
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tabCont3">
                                                <div class="row row-sm">
                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                        <?php echo form_open_multipart("Profile/education_doc/".$user->tbl_users_id, 'class="login" data-toggle="validator"'); ?>
                                                        
                                                        
                                                        <div class="card-body iconfont text-left">
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <label class="form-label">Document Name / Description</label>
                                                                        <input type="text" placeholder="Document Name" name="education_doc_title" class="form-control" style="margin-bottom: 20px" required>
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <input type="file" name="education_doc_files" id="education_doc_files" class="form-control">
                                                                    </div>
                                                                    <div class="col-md-5" style="text-align: right;">
                                                                        <button class="btn btn-primary" type="submit" id="add_mul_doc">Upload</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered mg-b-0 text-md-nowrap" style="width: 100%;">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col">PID</th>
                                                                            <th scope="col" class="table_title_width">Document Name / Description</th>
                                                                            <th scope="col">Actions</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        $i = 1;
                                                                        foreach ($education_doc as $key => $value) { ?>
                                                                            <tr>
                                                                                <td><?php echo $i;?></td>
                                                                               <td><?php echo $value->tbl_all_documents_title;?></td>
                                                                                <td>
																				<button style="width:65%" data-toggle="dropdown" class="btn btn-primary btn-block button_width"><i class="la la-cog setting"></i></button>
															<div class="dropdown-menu">
                                                                                    <a href="<?php echo base_url(); ?>assets/users/education_document/<?php echo $value->tbl_all_documents_document;?>" target="_blank" class="btn btn-success btn-block btn_width"><i class="far fa-eye"></i></a>
                                                                                    <a href="<?php echo site_url("Profile/delete_doc/" . $value->tbl_all_documents_id); ?>" class="btn btn-danger btn-block btn_width"><i class="fa fa-trash"></i></a>
                                                                            </div>
																			</td>
                                                                            </tr>
                                                                        <?php $i++; }
                                                                        ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>  
                                                        <?php echo form_close(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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


                $('.edit_photo').hide();

                $('.profile-edit').click(function(){                    
                    $('.edit_photo').toggle();
                });

                $('.tabCont2').click(function(){
                  $('.nav-tabs a[href="#tabCont2"]').tab('show');
                });

                $('.tabCont3').click(function(){
                  $('.nav-tabs a[href="#tabCont3"]').tab('show');
                });

                $('#tbl_users_photo').change(function() {
                  var file = $('#tbl_users_photo')[0].files[0].name;
                  $('#tbl_users_photo_label').text(file);
                });



            });
        </script>
    </body>
</html>
