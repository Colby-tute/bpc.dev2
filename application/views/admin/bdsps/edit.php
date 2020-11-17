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
                                        <?php echo form_open_multipart("admin/bdsps/Bdsps/update/".$user->tbl_users_id, 'class="login" data-toggle="validator"'); ?>
                                         <div id="companyform">
                                            <div class="col-md-12"> 
                                                    <div class="row">
                                                        <div id="error_msg"></div>

                                                        <div class="col-md-4 form-group mb-3">
                                                            <label for="lastName1">First Name</label>
                                                            <input type="text" name="tbl_users_firstname" class="form-control" id="tbl_users_firstname" placeholder="First Name" value="<?php echo  $user->tbl_users_firstname; ?>" required=""/>
                                                        </div>
                                                        <div class="col-md-4 form-group mb-3">
                                                            <label for="lastName1">Last Name</label>
                                                            <input type="text" name="tbl_users_lastname" class="form-control" id="tbl_users_lastname" placeholder="Last Name" value="<?php echo  $user->tbl_users_lastname; ?>" required=""/>
                                                        </div>
                                                        <div class="col-md-4 form-group mb-3">
                                                            <label for="exampleInputEmail1">Email Address*</label>
                                                            <input type="email" name="tbl_users_email" class="form-control" id="tbl_users_email"  placeholder="Enter Email Address" value="<?php echo  $user->tbl_users_email; ?>" required="" />
                                                            <span></span>
                                                        </div>
                                                        <!-- <div class="col-md-4 form-group mb-3">
                                                            <label for="credit1">Password*</label>
                                                            <div class="row">
                                                                <div class="col-md-10">
                                                                    <input type="text" name="tbl_users_password" class="form-control" id="password" minlength="8" title="Password should have atleast 8 Character"  placeholder="Enter your Password" />
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <button type="button" name="generatepass" id="generatepass" class="btn btn-success"><i class="typcn typcn-arrow-shuffle"></i></button> 
                                                                </div>
                                                            </div>
                                                        </div>   -->
                                                        <div class="col-md-4 form-group mb-3"> 
                                                            <label for="firstName1">Mobile Number*</label><br>
                                                             <input class="form-control" id="phone" name="tbl_users_mobile" type="tel" value="<?php if(!empty($userdt)){ echo $user->tbl_users_mobile; } ?>" required="">
                                                                    <input type="hidden" name="country_code" id="country_code" class="form-control" value="<?php if(!empty($userdt)){ echo $user->tbl_users_contrycode; } ?>">
                                                        </div>
                                                        <!-- <div class="col-md-4 form-group mb-3">
                                                            <label for="firstName1">Photo</label>
                                                                    <div class="custom-file">
                                                                        <input type="file" name="tbl_users_photo" class="custom-file-input" id="tbl_users_photo">
                                                                        <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                                    </div>
                                                        </div> -->
                                                            
                                                        <div class="col-md-4">
                                                                <label for="firstName1">Gender</label>
                                                            <!-- <div class="custom-file"> -->
                                                                <div class="row">
                                                                    <?php
                                                                    if(!empty($user) && $user->tbl_users_gender == 'M')
                                                                    {
                                                                    ?>
                                                                    <div class="col-md-4">
                                                                       <label class="rdiobox"><input name="tbl_users_gender" type="radio" value="M" checked="" > <span>Male</span></label>
                                                                     </div>
                                                                    <div class="col-md-4">
                                                                        <label class="rdiobox"><input name="tbl_users_gender" type="radio" value="F"> <span>Female</span></label>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label class="rdiobox"><input name="tbl_users_gender" type="radio" value="O"> <span>Other</span></label>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                    }else if(!empty($user) && $user->tbl_users_gender == 'F')
                                                                    {
                                                                    ?>
                                                                    <div class="col-md-4">
                                                                       <label class="rdiobox"><input name="tbl_users_gender" type="radio" value="M" > <span>Male</span></label>
                                                                     </div>
                                                                    <div class="col-md-4">
                                                                        <label class="rdiobox"><input name="tbl_users_gender" type="radio" value="F" checked=""> <span>Female</span></label>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label class="rdiobox"><input name="tbl_users_gender" type="radio" value="O"> <span>Other</span></label>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                    }else
                                                                    {
                                                                    ?>
                                                                    <div class="col-md-4">
                                                                       <label class="rdiobox"><input name="tbl_users_gender" type="radio" value="M" > <span>Male</span></label>
                                                                     </div>
                                                                    <div class="col-md-4">
                                                                        <label class="rdiobox"><input name="tbl_users_gender" type="radio" value="F" > <span>Female</span></label>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label class="rdiobox"><input name="tbl_users_gender" type="radio" value="O" checked=""> <span>Other</span></label>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                    }?>
                                                                    
                                                                </div>
																<div class="col-md-4"> 
                                                                   <label>User Status</label> 
																    <div class="row">
																   <?php if($user->login_approve==1){ ?>
																  
																  <div class="col-md-4"> 
																    <label class="rdiobox"><input name="tbl_users_status" type="radio" value="1" checked=""> <span>Enable</span></label>
                                                                     </div><div class="col-md-4"> 
																	 <label class="rdiobox"><input name="tbl_users_status" type="radio" value="0" > <span>Disable</span></label>
																   </div>
																   <?php }else{ ?>
																   <div class="col-md-4"> 
																   <label class="rdiobox"><input name="tbl_users_status" type="radio" value="1" > <span>Enable</span></label>                                                                    
																    </div><div class="col-md-4"> 
																	<label class="rdiobox"><input name="tbl_users_status" type="radio" value="0" checked=""> <span>Disable</span></label>
                                                                   	</div>															   
																   <?php } ?>
																	   </div>
																    
                                                                </div>
                                                                
                                                        <div class="col-md-12 table-responsive"> 
                                                             <h4>Personal Details</h4> 
                                                        </div>
                                                        <div class="col-md-4 form-group mb-3">
                                                            <label for="lastName1">Occupation</label>
                                                            <input type="text" name="tbl_personal_details_occupation" class="form-control" id="tbl_personal_details_occupation" placeholder="Occupation" value="<?php if(!empty($personal)){echo $per->tbl_personal_details_occupation; }?>" required=""/>
                                                        </div>
                                                        <div class="col-md-4 form-group mb-3">
                                                            <label for="firstName1">Date of Birth</label>
                                                            <input type="date" name="tbl_personal_details_dob" class="form-control" id="tbl_personal_details_dob" value="<?php if(!empty($personal)){ echo $per->tbl_personal_details_dob; } ?>" required=""/>
                                                           
                                                        </div>
                                                        <div class="col-md-4 form-group mb-3">
                                                            <label for="phone">Optional Phone Number</label>
                                                            <input type="text" name="tbl_personal_details_optional_telephone" class="form-control" id="tbl_personal_details_optional_telephone" maxlength="13" minlength="8" pattern="[0-9]{8,13}" title="Phone Number length should be between 8-13" placeholder="Enter Optional Number" value="<?php if(!empty($personal)){ echo $per->tbl_personal_details_optional_telephone; } ?>"required=""/>
                                                        </div>
                                                        <div class="col-md-4 form-group mb-3">
                                                            <label for="phone">How did you hear about the VBI?</label>
                                                                <?php $social = 
                                                                array('Referral','Advertisements','Social Media','University','Business Plan Competition','Conference','Exhibition','Other');
                                                                //print_r($social);
                                                                ?>
                                                                <select name="tbl_personal_details_howdidyouknow" class="form-control" id="tbl_personal_details_howdidyouknow" required="">
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
                                                        <div class="col-md-4 form-group mb-3">
                                                            <label for="lastName1">Eduction</label>
                                                            <input type="text" name="tbl_personal_details_education" class="form-control" id="tbl_personal_details_education" placeholder="Education" value="<?php if(!empty($personal)){ echo $per->tbl_personal_details_education; } ?>"required=""/>
                                                        </div>
                                                        <!-- <div class="col-md-4 form-group mb-3">
                                                            <label for="firstName1">Eduction Doc.</label>
                                                            <div class="custom-file">
                                                                <input type="file" name="tbl_personal_details_educational_doc" class="custom-file-input" id="tbl_personal_details_educational_doc">
                                                                <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose
                                                                            file</label>
                                                            </div>
                                                        </div> -->
                                                        <div class="col-md-4 form-group mb-3">
                                                            <label for="lastName1">District</label>
                                                            <input type="text" name="tbl_personal_details_district" class="form-control" id="tbl_personal_details_district" placeholder="District" value="<?php if(!empty($personal)){ echo $per->tbl_personal_details_district; } ?>" required=""/>
                                                        </div>
                                                        <div class="col-md-4 form-group mb-3">
                                                            <label for="lastName1">Town/Village</label>
                                                            <input type="text" name="tbl_personal_details_town_village" class="form-control" id="tbl_personal_details_town_village" placeholder="Town/Village" value="<?php if(!empty($personal)){ echo $per->tbl_personal_details_town_village; } ?>" required=""/>
                                                        </div>
                                                        <div class="col-md-4 form-group mb-3">
                                                            <label for="lastName1">Post Code</label>
                                                            <input type="text" name="tbl_personal_details_postcode" class="form-control" id="tbl_personal_details_postcode" placeholder="Post Code" value="<?php if(!empty($personal)){ echo $per->tbl_personal_details_postcode; } ?>" required=""/>
                                                        </div>
                                                        <div class="col-md-12 table-responsive"> 
                                                             <h4>Business Details</h4> 
                                                        </div>  
                                                        <div class="col-md-4 form-group mb-3">
                                                            <label for="lastName1">Business Name</label>
                                                            <input type="text" name="tbl_business_details_name" class="form-control" id="tbl_business_details_name" placeholder="Business Name" value="<?php if(!empty($business)){ echo $buss->tbl_business_details_name; } ?>" required=""/>
                                                        </div>
                                                        <div class="col-md-4 form-group mb-3">
                                                            <label for="firstName1">Industry </label>
                                                            <!-- <input type="text" name="tbl_business_details_industry" class="form-control" id="Insustry" value="<?php if(!empty($business)){ echo $buss->tbl_business_details_industry; } ?>"/> -->
                                                            <select id="tbl_business_details_industry" class="form-control" name="tbl_business_details_industry" required="">
                                                                <option value="">Select Industry</option>
                                                                <?php
                                                                foreach ($industrys as $key => $industry) { ?>

                                                                    <option value="<?php echo $industry->tbl_industry_id;?>" <?php ?> <?php if(!empty($business)){
                                                                        
                                                                        if ($buss->tbl_business_details_industry == $industry->tbl_industry_id){echo "selected";}} ?>><?php echo $industry->tbl_industry_name;?></option>
                                                                <?php }
                                                                ?>
                                                            </select>
                                                           <input type="hidden" name="ind" id="ind" value="<?php if(!empty($business)){echo $buss->tbl_business_details_industry;} ?>">
                                                        </div>
                                                        <div class="col-md-4 form-group mb-3">
                                                            <label for="firstName1">Sub Industry</label>
                                                            <select id="tbl_business_details_subindustry" class="form-control" name="tbl_business_details_subindustry" required="">
                                                                <option value="<?php if(!empty($business)){echo $buss->tbl_business_details_sub_industry;} ?>"><?php if(!empty($business)){ echo $buss->tbl_sub_industry_name; }else{echo 'Select Sub Industry';} ?></option>
                                                            </select>
                                                            <input type="hidden" name="sub_ind" id="sub_ind" value="<?php if(!empty($business)){echo $buss->tbl_business_details_sub_industry;} ?>">
                                                        </div>
                                                        <div class="col-md-4 form-group mb-3">
                                                            <label for="exampleInputEmail1">Business Email</label>
                                                            <input type="email" name="tbl_business_details_email" class="form-control" id="tbl_business_details_email"  placeholder="Enter your Email Address" value="<?php if(!empty($business)){ echo $buss->tbl_business_details_email; } ?>"required=""/>
                                                        </div>
                                                        <div class="col-md-4 form-group mb-3">
                                                            <label for="phone">Business Phone No.</label>
                                                            <input type="text" name="tbl_business_details_phone" class="form-control" id="tbl_business_details_phone" maxlength="13" minlength="8" pattern="[0-9]{8,13}" title="Phone Number length should be between 8-13" placeholder="Enter Optopnal Phone Number" value="<?php if(!empty($business)){ echo $buss->tbl_business_details_phone; } ?>"required=""/>
                                                        </div>
                                                        <div class="col-md-4 form-group mb-3">
                                                            <label for="lastName1">Business District</label>
                                                            <input type="text" name="tbl_business_details_district" class="form-control" id="tbl_business_details_district" placeholder="Business District" value="<?php if(!empty($business)){ echo $buss->tbl_business_details_district; } ?>"required=""/>
                                                        </div>
                                                        <div class="col-md-4 form-group mb-3">
                                                            <label for="lastName1">Business Town/Village</label>
                                                            <input type="text" name="tbl_business_details_town_village" class="form-control" id="tbl_business_details_town_village" placeholder="Business Town/Village" value="<?php if(!empty($business)){ echo $buss->tbl_business_details_town_village; } ?>"required=""/>
                                                        </div>
                                                        <!-- <div class="col-md-4 form-group mb-3">
                                                            <label for="firstName1">Business Doc.</label>
                                                            <div class="custom-file">
                                                                <input type="file" name="tbl_business_details_business_doc" class="custom-file-input" id="tbl_business_details_business_doc">
                                                                <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose
                                                                            file</label>
                                                            </div>
                                                        </div> -->
                                                        <div class="col-md-4 form-group mb-3">
                                                            <label for="lastName1">No of Employees</label>
                                                            <input type="Number" name="tbl_business_details_employees" class="form-control" id="tbl_business_details_employees" placeholder="No Of Employees" value="<?php if(!empty($business)){ echo $buss->tbl_business_details_employees; } ?>"required=""/>
                                                        </div>
                                                        <div class="col-md-4 form-group mb-3">
                                                            <label for="lastName1">Investment Need</label>
                                                            <input type="number" name="tbl_business_details_investmant_need" class="form-control" id="tbl_business_details_investmant_need" placeholder="Investment Need" value="<?php if(!empty($business)){ echo $buss->tbl_business_details_investmant_need; } ?>"required=""/>
                                                        </div>
                                                        <div class="col-md-4 form-group mb-3">
                                                                <label for="firstName1">Are You a Team?</label>
                                                            <!-- <div class="custom-file"> -->
                                                                 <?php
                                                            if(!empty($business) && $buss->tbl_business_details_areyouteam == '1')
                                                            {
                                                            ?>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label class="rdiobox"><input name="tbl_business_details_areyouteam" type="radio" value="1" checked=""> <span>Yes</span></label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="rdiobox"><input name="tbl_business_details_areyouteam" type="radio" value="0"> <span>No</span></label>
                                                                    </div>
                                                                </div>
                                                            <?php
                                                            }
                                                            else
                                                            {?>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label class="rdiobox"><input name="tbl_business_details_areyouteam" type="radio" value="1"> <span>Yes</span></label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="rdiobox"><input name="tbl_business_details_areyouteam" type="radio" value="0" checked=""> <span>No</span></label>
                                                                    </div>
                                                                </div>
                                                            <?php
                                                            }?> 
                                                        </div>  

                                                    </div> 
                                            </div>
                                        </div>
                                        <div class="col-md-12 teams">
                                            <div class="row ">
                                                 <section class="container col-xs-12">
                                                    <h4>Select Team Details</h4>
                                                    <table id="ppsale" class="table table-striped table-bordered">
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
                                                              <input name="tbl_smme_teams_first_name[]" class="sku form-control" id="tbl_smme_teams_first_name" type="text"  placeholder="Enter First Name" value="<?php echo $value->tbl_smme_teams_first_name; ?>">
                                                            </td>
                                                            <td>
                                                              <input  name="tbl_smme_teams_last_name[]" class="form-control" id="tbl_smme_teams_last_name" type="text" placeholder="Enter Last Name" value="<?php echo $value->tbl_smme_teams_last_name; ?>">
                                                            </td>
                                                            <td>
                                                              <input name="tbl_smme_teams_email[]" class="gst form-control" id="tbl_smme_teams_email"  type="email" placeholder="Enter Emailid"  value="<?php echo $value->tbl_smme_teams_email; ?>">
                                                            </td>
                                                            <td>
                                                              <input name="tbl_smme_teams_mobile[]" class="qty form-control" id="tbl_smme_teams_mobile"  type="tel" maxlength="10" placeholder="Enter Mobile No."value="<?php echo $value->tbl_smme_teams_mobile; ?>" maxlength="13" minlength="8" pattern="[0-9]{8,13}" title="Phone Number length should be between 8-13">
                                                            </td>                                           
                                                            <td><button type="button" class="btn btn-danger remove" data-toggle="tooltip" data-original-title="Remove" style="float: right;padding: 4px 10px;"><i class="typcn typcn-archive"></i></button></td>
                                                       </tr>
                                                       <?php
                                                        } 
                                                        }
                                                        else
                                                        {?>
                                                            <td>
                                                              <input name="tbl_smme_teams_first_name[]" class="sku form-control" id="tbl_smme_teams_first_name" type="text"  placeholder="Enter First Name">
                                                            </td>
                                                            <td>
                                                              <input  name="tbl_smme_teams_last_name[]" class="price form-control" id="tbl_smme_teams_last_name" type="text" placeholder="Enter Last Name">
                                                            </td>
                                                            <td>
                                                              <input name="tbl_smme_teams_email[]" class="gst form-control" id="tbl_smme_teams_email"  type="text" placeholder="Enter Emailid">
                                                            </td>
                                                            <td>
                                                              <input name="tbl_smme_teams_mobile[]" class="qty form-control" id="tbl_smme_teams_mobile"  type="text" placeholder="Enter Mobile No." maxlength="13" minlength="8" pattern="[0-9]{8,13}" title="Phone Number length should be between 8-13">
                                                            </td>                                           
                                                            <td>&nbsp;
                                                                
                                                            </td>
                                                            </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                      </tbody>
                                                      <tfoot>
                                                        <tr>
                                                          <th colspan="6">
                                                          <button id="btnAdd" type="button" class="btn btn-success" data-toggle="tooltip" data-original-title="Add more" style="float: right;padding: 4px 10px;"><i class="typcn typcn-plus"></i></button></th>
                                                        </tr>
                                                      </tfoot>
                                                    </table>
                                                  </section>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                                    <button class="btn btn-primary sub">Submit</button>
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