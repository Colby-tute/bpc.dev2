<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- RatingThemes css-->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/rating/ratings.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/rating/themes/bars-1to10.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/rating/themes/bars-movie.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/rating/themes/bars-square.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/rating/themes/bars-pill.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/rating/themes/bars-reversed.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/rating/themes/bars-horizontal.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/rating/themes/fontawesome-stars.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/rating/themes/css-stars.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/rating/themes/bootstrap-stars.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/rating/themes/fontawesome-stars-o.css">
<?= $header; ?>
<div class="container">

    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div>
            <h4 class="content-title mb-2">Business Details</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= site_url('Home') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Business Details</li>
                </ol>
            </nav>

        </div>

        <?php

        foreach ($business as $key => $buss) {
# code...
        } 

        ?>

        <div class="my-auto breadcrumb-right">
            <a href="<?= site_url('user/smme/team'); ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-users mr-2"></i></span><span class="btn-text">Business Team Members </span></button></a>
            <a href="<?= site_url('Profile/view_profile/'.$this->session->userdata('id_user')) ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Personal Details </span></button></a>
            <button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-question-circle mr-2"></i> </span><span class="btn-text">Help </span></button>
        </div>




    </div>
    <!-- breadcrumb -->

    <!-- row -->


    <div class="row row-sm">
        <!-- Col -->

        <div class="col-lg-12">
            <div class="card">
                
            <div class="card-body">  
            <p><?php if ($this->session->flashdata('danger')) { ?>
                    <div id="infoMessage"
                    class="alert alert-danger mt25"><?php echo $this->session->flashdata('danger'); ?></div>
                <?php } else if ($this->session->flashdata('success')) { ?>
                    <div id="infoMessage"
                    class="alert alert-success mt25"><?php echo $this->session->flashdata('success'); ?></div>
                <?php }
                ?>
            </p>                                  
                <div class="border">
                    <div class="bg-gray-300 nav-bg">
                        <nav class="nav nav-tabs">
                            <a class="nav-link active" data-toggle="tab" href="#tabCont1">Business Details</a>
                            <a class="nav-link tabCont2" data-toggle="tab" href="#tabCont2">Business Documents</a>
                            <a class="nav-link tabCont3" data-toggle="tab" href="#tabCont3">Business Financial Details</a>
                            <a class="nav-link tabCont4" data-toggle="tab" href="#tabCont4">Business Building Model</a>
                            <a class="nav-link tabCont5" data-toggle="tab" href="#tabCont5">BBM Milestones Tasks</a>
                            <a class="nav-link tabCont6" data-toggle="tab" href="#tabCont6">Incubator Documents</a>
                        </nav>
                    </div>
                    <div class="card-body tab-content">
                        <div class="tab-pane active show" id="tabCont1">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col text-right">
                                        <?php if (!empty($business[0]->tbl_business_details_email)) { ?>
                                            <a href="javascript:void(0)" class="btn btn-outline-primary mr-3 edit_biz"><span class="icon-label"><i class="fa fa-pen"></i></span> <span class="btn-text"> Update Details</span></a>
                                            <a href="javascript:void(0)" class="btn btn-outline-danger mr-3 close_biz" style="display: none;"><span class="icon-label"></span> <span class="btn-text">Close</span></a>

                                        <?php } else { ?>
                                            <a style="display: none;" href="javascript:void(0)" class="btn btn-outline-primary mr-3 edit_biz"><span class="icon-label"><i class="fa fa-pen"></i></span> <span class="btn-text"> Update Details</span></a>
                                            <a href="javascript:void(0)" class="btn btn-outline-danger mr-3 close_biz"><span class="icon-label"></span> <span class="btn-text">Close</span></a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="business_details_show" <?php if (!empty($business[0]->tbl_business_details_email)) { echo "style='display:none !important;'"; } ?>>
<!-- <div class="form-group" style="margin-bottom: 20px;">
<a href="javascript:void(0)" class="btn btn-primary pull-right edit">Edit</a><br>
</div> -->
<div class="form-group">
    <div class="row">
       <input type="hidden" name="tbl_business_details_id" id="tbl_business_details_id" value="<?php if(!empty($business)){ echo $business[0]->tbl_business_details_id; } ?>">
       <div class="col-md-3">
        <label class="form-label label_font">Business Name</label>
        <b class="b_font">
            <?php
            if (!empty($business)) {
                echo $business[0]->tbl_business_details_name;
            }else {
                echo '[Unspecified]';
            }
            ?></b>
        </div>

        <div class="col-md-3">
            <label class="form-label label_font">Business Industry</label>
            <b class="b_font">
                <?php 
                if(!empty($business)){ 
                    echo $business[0]->tbl_industry_name; 
                }else{
                    echo "[Unspecified]";
                } ?>
            </b>
        </div>

        <div class="col-md-3">
            <label class="form-label label_font">
            Business Sub Industry </label>
            <b class="b_font">
                <?php 
                if(!empty($business)){ 
                    echo $business[0]->tbl_sub_industry_name; 
                }else{
                    echo "[Unspecified]";
                } ?>
            </b>
        </div>

        <div class="col-md-3">
            <label class="form-label label_font">Business Email Address</label>
            <b class="b_font">
                <?php if(!empty($business)){ echo $business[0]->tbl_business_details_email; 
                }else{
                    echo "[Unspecified]";
                } ?>
            </b>
        </div>

    </div>
</div>

<div class="form-group ">
    <div class="row">

        <div class="col-md-3">
            <label class="form-label label_font">Business Telephone</label>
            <b class="b_font">
                <?php
                if (!empty($business)) {
                    if ($business[0]->tbl_business_details_countrycode != '') {
                        $exp = explode('-',$business[0]->tbl_business_details_countrycode);
                        $code = '+'.$exp[1];
                    }
                    else{
                        $code = '';
                    }
                }
                ?>
                <?php if(!empty($business)){  echo $code.''.$business[0]->tbl_business_details_phone; 
            }else{
                echo "[Unspecified]";
            } ?>
        </b>
    </div>

    <div class="col-md-3">
        <label class="form-label label_font">Business District</label>
        <b class="b_font">
            <?php if(!empty($business)){ echo $business[0]->tbl_business_details_district; }else{
                echo "[Unspecified]";
            } ?>
        </b>
    </div>

    <div class="col-md-3">
        <label class="form-label label_font">Business Village/Town</label>
        <b class="b_font">
            <?php if(!empty($business)){ echo $business[0]->tbl_business_details_town_village; 
            }else{
                echo "[Unspecified]";
            } ?>
        </b>
    </div>

    <div class="col-md-3">
       <label class="form-label label_font">Business Start Date</label>
       <b class="b_font">
          <?php if(!empty($business))
          { 

              echo $business[0]->tbl_business_details_date_hired;
          }else{
              echo "[Unspecified]";
          } ?> 
      </b>
  </div>
</div>
</div>

<div class="form-group ">
    <div class="row">
        <div class="col-md-3">
           <label class="form-label label_font">Business Logo</label>
           <b class="b_font">
              <?php if(!empty($business))
              { 

                  echo "<img src='".base_url().'assets/users/'.$business[0]->tbl_business_details_business_logo."' width='100' />";
              }else{
                  echo "[Unspecified]";
              } ?> 
          </b>
      </div>

      <div class="col-md-3">
        <label class="form-label label_font">Do you work in a team?</label>
        <b class="b_font">
            <?php 
            if(!empty($business))
            {
                if(!(empty($business) && $business[0]->tbl_business_details_areyouteam == '1'))
                {
                    echo "Yes";
                }else{
                    echo "No";
                }
            }   
            ?>
        </b>
    </div>
</div>
</div>

<div class="form-group ">
    <div class="row">
<!--  
<div class="col-md-3">
    <label class="form-label label_font">MSME Investment Need</label>
    <b class="b_font">
    <?php if(!empty($business)){ echo $business[0]->tbl_business_details_investmant_need; }
    else{
        echo "[Unspecified]";
    } ?>
    </b>
</div>

<div class="col-md-3">
    <label class="form-label label_font">BI Revenue Raised</label>
    <b class="b_font">
    <?php if(!empty($business)){ echo round($business[0]->tbl_business_details_revenue_raised); }
    else{
        echo "[Unspecified]";
    } ?>
    </b>
</div>

<div class="col-md-3">
    <label class="form-label label_font">MSME Personal Funds</label>
    <b class="b_font">
    <?php if(!empty($business)){ echo round($business[0]->tbl_business_details_personal_funds); }
    else{
        echo "[Unspecified]";
    } ?>
    </b>
</div>
-->


</div>
</div>
</div>


<div class="business_details_edit" <?php if (empty($business[0]->tbl_business_details_email)) { echo "style='display:block !important;'"; }?>>
    <?php echo form_open_multipart("user/smme/BusinessDetails/update/".$this->session->userdata('id_user'), 'class="login" data-toggle="validator"'); ?>


    <div class="form-group">
        <div class="row">
           <input type="hidden" name="tbl_business_details_id" value="<?php if(!empty($business)){ echo $business[0]->tbl_business_details_id; } ?>">
           <div class="col-md-2">
            <label class="form-label">Business Name</label>
        </div>
        <div class="col-md-2">
            <input type="text" name="tbl_business_details_name" class="form-control" id="tbl_business_details_name" placeholder="Business Name" value="<?php if(!empty($business)){ echo $business[0]->tbl_business_details_name; } ?>" required/>
        </div>
        <div class="col-md-2">
            <label class="form-label">Business Industry</label>
        </div>
        <div class="col-md-2">

            <select id="tbl_business_details_industry" class="form-control js-example-basic-single" name="tbl_business_details_industry" required>
                <option value="">Select Industry</option>
                <?php
                if ($industrys) {
                    foreach ($industrys as $key => $industry) { ?>
                        <option value="<?php echo $industry->tbl_industry_id;?>" <?php ?> <?php if (isset($business[0]) && $business[0]->tbl_business_details_industry == $industry->tbl_industry_id){echo "selected";} ?>><?php echo $industry->tbl_industry_name;?></option>
                    <?php }
                } 
                ?>
            </select>
            <input type="hidden" name="ind" id="ind" value="<?php if(!empty($business)){echo $business[0]->tbl_business_details_industry;} ?>">
        </div>
        <div class="col-md-2">
            <label class="form-label">Business Sub Industry</label>
        </div>
        <div class="col-md-2">
            <select id="tbl_business_details_subindustry" class="form-control js-example-basic-single" name="tbl_business_details_subindustry" required>
                <option value="<?php echo $business[0]->tbl_business_details_sub_industry?>"><?php echo $business[0]->tbl_sub_industry_name;?></option>
                <option value="">Select Sub Industry</option>
            </select>
            <input type="hidden" name="sub_ind" id="sub_ind" value="<?php if(!empty($business)){echo $business[0]->tbl_business_details_sub_industry;} ?>" required>
        </div>
    </div>
</div>

<div class="form-group ">
    <div class="row">
        <div class="col-md-2">
            <label class="form-label">Business Email Address</label>
        </div>
        <div class="col-md-2">
            <input type="email" name="tbl_business_details_email" class="form-control" id="tbl_business_details_email" pattern="^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$"  placeholder="Enter your Email Address" value="<?php if(!empty($business)){ echo $business[0]->tbl_business_details_email; } ?>" required/>
        </div>
        <div class="col-md-2">
            <label class="form-label">Business Telephone</label>
        </div>
        <div class="col-md-2">
            <!-- <input type="tel" name="tbl_business_details_phone" class="form-control" id="tbl_business_details_phone" placeholder="Enter Optopnal Phone Number" value="<?php if(!empty($business)){ echo $business[0]->tbl_business_details_phone; } ?>" /> -->

            <input class="form-control" id="phone" name="tbl_business_details_phone" type="text" placeholder="0123456789" value="<?php if(!empty($business)){ echo $business[0]->tbl_business_details_phone; } ?>" maxlength="10">
            <input type="hidden" name="country_code" id="country_code" class="form-control" value="<?php if(!empty($business)){ echo $business[0]->tbl_business_details_countrycode; }else{ echo 'ls-266'; } ?>">

        </div>
        <div class="col-md-2">
            <label class="form-label">Business District</label>
        </div>
        <div class="col-md-2">
            <input type="text" name="tbl_business_details_district" class="form-control" id="tbl_business_details_district" placeholder="Business District" value="<?php if(!empty($business)){ echo $business[0]->tbl_business_details_district; } ?>" required/>
        </div>
    </div>
</div>

<div class="form-group ">
    <div class="row">
        <div class="col-md-2">
            <label class="form-label">Business Village/Town</label>
        </div>
        <div class="col-md-2">
            <input type="text" name="tbl_business_details_town_village" class="form-control" id="tbl_business_details_town_village" placeholder="Business Town/Village" value="<?php if(!empty($business)){ echo $business[0]->tbl_business_details_town_village; } ?>" required/>
        </div>


        <div class="col-md-2">
            <label class="form-label">Business Start Date</label>
        </div>
        <div class="col-md-2">
            <input name="tbl_business_details_date_hired" class="qty form-control" id="tbl_business_details_date_hired"  type="date" placeholder="" value="<?php if(!empty($business)){ echo $business[0]->tbl_business_details_date_hired; } ?>"  required>
        </div>

        <div class="col-md-2">
            <label class="form-label">Business Logo</label>
        </div>
        <div class="col-md-2">
            <input name="tbl_business_details_business_logo" class="qty form-control <?php if(!empty($business) && ($business[0]->tbl_business_details_business_logo != "")){ echo 'd-none1'; } ?>" id="tbl_business_details_business_logo"  type="file" placeholder=""  <?php if(!empty($business) && ($business[0]->tbl_business_details_business_logo == "")){ ?>required <?php } ?>>
            <?php if(!empty($business) && ($business[0]->tbl_business_details_business_logo != "")){ echo '<img src="'.base_url().'assets/users/'.$business[0]->tbl_business_details_business_logo.'" width="50" />'; } ?>
            <input type="hidden" name="tbl_business_details_business_logo_old" class="form-control" id="tbl_business_details_business_logo_old" value="<?php if(!empty($business)){ echo $business[0]->tbl_business_details_business_logo; } ?>" />
        </div>

        <div class="col-md-2">
           <label class="form-label">Do you work in a team?</label>
       </div>
       <?php
       if(!empty($business) && $business[0]->tbl_business_details_areyouteam == '1')
       {
        ?>
        <div  class="col-md-1">
         <label class="rdiobox"><input name="tbl_business_details_areyouteam" type="radio" value="1" checked="" class='one'> <span>Yes</span></label>

     </div>
     <div  class="col-md-1">
         <label class="rdiobox"><input name="tbl_business_details_areyouteam" type="radio" value="0" class="zero"> <span>No</span></label>
     </div>
     <?php
 }else
 {
    ?>
    <div  class="col-md-1">
     <label class="rdiobox"><input name="tbl_business_details_areyouteam" type="radio" value="1" class='one'> <span>Yes</span></label>

 </div>
 <div  class="col-md-1">
     <label class="rdiobox"><input name="tbl_business_details_areyouteam" type="radio" value="0" checked="" class="zero"> <span>No</span></label>
 </div>
 <?php
}
?>
<!--
<div class="col-md-2">
    <label class="form-label">MSME Investment Need</label>
</div>
<div class="col-md-2">
    <input type="number" name="tbl_business_details_investmant_need" class="form-control" id="tbl_business_details_investmant_need" placeholder="MSME Investment Need" value="<?php if(!empty($business)){ echo $business[0]->tbl_business_details_investmant_need; } ?>"/>
</div>
 <div class="col-md-2">
    <label class="form-label">BI Revenue Raised</label>
</div>
<div class="col-md-2">
    <input type="number" name="tbl_business_details_revenue_raised" class="form-control" id="tbl_business_details_revenue_raised" placeholder="MSME Investment Need" value="<?php if(!empty($business)){ echo round($business[0]->tbl_business_details_revenue_raised); } ?>"/>
</div>
 <div class="col-md-2">
    <label class="form-label">MSME Personal Funds</label>
</div>
<div class="col-md-2">
    <input type="number" name="tbl_business_details_personal_funds" class="form-control" id="tbl_business_details_personal_funds" placeholder="MSME Investment Need" value="<?php if(!empty($business)){ echo round($business[0]->tbl_business_details_personal_funds); } ?>"/>
</div>
-->
</div>
</div>

<div class="col-md-12">
    <button class="btn btn-primary sub5">Update</button>
</div>
<?php echo form_close(); ?>
</div>

</div>

<div class="tab-pane" id="tabCont2">
    <div class="row row-sm">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <?php echo form_open_multipart("user/smme/BusinessDetails/insert_business_doc", 'class="login" data-toggle="validator"'); ?>


            <div class="card-body iconfont text-left">
                <div class="form-group">
                    <input type="hidden" name="tbl_business_details_id" value="<?php if(!empty($business)){ echo $business[0]->tbl_business_details_id; } ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="business_doc_title" id="business_doc_title" class="form-control" placeholder="Enter document name or description" required>
                        </div>
                        <div class="col-md-3">
                            <input type="file" name="business_doc_files" id="business_doc_files" class="form-control">
                        </div>
                        <div class="col-md-3">
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
                            foreach ($business_doc as $key => $value) { ?>
                                <tr>
                                    <td><?php echo $i;?></td>
                                    <td><?php echo $value->tbl_all_documents_title;?></td>                                      
                                    <td>      
                                        <a href="<?php echo base_url(); ?>assets/Application/Business_Document/<?php echo $value->tbl_all_documents_document;?>" target="_blank" class="btn btn-success btn-block btn_width"><i class="far fa-eye"></i></a>
                                        <a href="<?= site_url('user/smme/BusinessDetails/delete/'.$value->tbl_all_documents_id) ?>" class="btn btn-danger btn-block btn_width"><i class="fa fa-trash"></i></a>		

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
        <div class="row">
            <div class="col text-right">
                <?php if (!empty($business[0]->tbl_business_details_email)) { ?>
                <a href="javascript:void(0)" class="btn btn-outline-primary mr-3 edit_fin"><span class="icon-label"><i class="fa fa-pen"></i></span> <span class="btn-text"> Update Details</span></a>
                <a href="javascript:void(0)" class="btn btn-outline-danger mr-3 close_fin" style="display: none;"><span class="icon-label"></span> <span class="btn-text">Close</span></a>
                <?php } else { ?>
                    <a style="display: none;" href="javascript:void(0)" class="btn btn-outline-primary mr-3 edit_fin"><span class="icon-label"><i class="fa fa-pen"></i></span> <span class="btn-text"> Update Details</span></a>
                <a href="javascript:void(0)" class="btn btn-outline-danger mr-3 close_fin" ><span class="icon-label"></span> <span class="btn-text">Close</span></a>
                <?php }?>
            </div>
        </div>
        <div class="business_fin_details_edit">
            <?php echo form_open_multipart("user/smme/BusinessDetails/update_fin", 'class="login" data-toggle="validator"'); ?>
            <div class="row">
                <div class="col-md-2" style="margin-top: 20px">
                    <label class="form-label">Account Number</label>
<!-- </div>
    <div  class="col-md-2" style="margin-top: 20px"> -->
        <input type="hidden" name="fin_details[user_id]" value="<?= $user_id ?>">
        <input type="text" name="fin_details[bank_account]" class="form-control" id="bank_account" value="<?php if(!empty($fin_details)){ echo $fin_details[0]->bank_account; } ?>"/>
    </div>
    <div class="col-md-2" style="margin-top: 20px">
        <label class="form-label">Bank Name</label>
<!--       </div>
    <div class="col-md-2" style="margin-top: 20px"> -->
        <input type="text" name="fin_details[bank_name]" class="form-control" id="bank_name" value="<?php if(!empty($fin_details)){ echo $fin_details[0]->bank_name; } ?>"/>
    </div>

    <div class="col-md-2" style="margin-top: 20px">
        <label class="form-label">MSME Investment Need</label>
        <input type="text" name="business[tbl_business_details_investmant_need]" class="form-control" id="inv_need"
        value="<?php if(!empty($business)){ echo $business[0]->tbl_business_details_investmant_need; }
         ?>"/>

    </div>

    <div class="col-md-2" style="margin-top: 20px">
        <label class="form-label ">Incubator Raised Funds</label>
        <input readonly type="text" name="business[tbl_business_details_revenue_raised]" class="form-control" id="revenue_raised" value="<?php if(!empty($business)){ echo round($business[0]->tbl_business_details_revenue_raised); }
         ?>"/>
    </div>



</div>
<div class="row">
    <div class="col-md-2" style="margin-top: 20px">
        <label class="form-label">Branch Name</label>
<!-- </div>
    <div  class="col-md-2" style="margin-top: 20px"> -->
        <input type="text" name="fin_details[branch_name]" class="form-control" id="branch_name" value="<?php if(!empty($fin_details)){ echo $fin_details[0]->branch_name; } ?>"/>
    </div>
    <div class="col-md-2" style="margin-top: 20px">
        <label class="form-label">Branch Code</label>
<!--   </div>
    <div  class="col-md-2" style="margin-top: 20px"> -->
        <input type="text" name="fin_details[branch_code]" class="form-control" id="branch_code" value="<?php if(!empty($fin_details)){ echo $fin_details[0]->branch_code; } ?>"/>
    </div>

    <div class="col-md-2" style="margin-top: 20px">
        <label class="form-label">MSME Personal Funds</label>
        <input type="text" name="business[tbl_business_details_personal_funds]" id="personal_funds" class="form-control" value=" <?php if(!empty($business)){ echo round($business[0]->tbl_business_details_personal_funds); }
         ?>"/>
    </div>
    <div class="col-md-12" style="margin-top: 20px">
        <button class="btn btn-primary sub5">Update</button>
    </div>
</div>
<?php echo form_close(); ?>
</div>
<div class="business_fin_details_show">
    <div class="form-group">
        <div class="row">
            <div class="col-md-3">
                <label class="form-label">Account Number</label>
                <b class="b_font">
                    <?php
                    if (!empty($fin_details)) {
                        echo $fin_details[0]->bank_account;;
                    }else {
                        echo '[Unspecified]';
                    }
                    ?></b>
                </div>

                <div class="col-md-3">
                    <label class="form-label label_font">Bank Name</label>
                    <b class="b_font">
                        <?php 
                        if(!empty($fin_details)){ 
                            echo $fin_details[0]->bank_name; 
                        }else{
                            echo "[Unspecified]";
                        } ?>
                    </b>
                </div>

                <div class="col-md-3">
                    <label class="form-label label_font">MSME Investment Need</label>
                    <b class="b_font">M
                        <?php if(!empty($business)){ echo $business[0]->tbl_business_details_investmant_need; }
                        else{
                            echo "[Unspecified]";
                        } ?>
                    </b>
                </div>

                <div class="col-md-3">
                    <label class="form-label label_font">Incubator Raised Funds</label>
                    <b class="b_font">M
                        <?php if(!empty($business)){ echo round($business[0]->tbl_business_details_revenue_raised); }
                        else{
                            echo "[Unspecified]";
                        } ?>
                    </b>
                </div>


            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label class="form-label label_font">Branch Name</label>
                    <b class="b_font">
                        <?php 
                        if(!empty($fin_details)){ 
                            echo $fin_details[0]->branch_name; 
                        }else{
                            echo "[Unspecified]";
                        } ?>
                    </b>
                </div>

                <div class="col-md-3">
                    <label class="form-label label_font">Branch Code</label>
                    <b class="b_font">
                        <?php if(!empty($fin_details)){ echo $fin_details[0]->branch_code; 
                        }else{
                            echo "[Unspecified]";
                        } ?>
                    </b>
                </div>

                <div class="col-md-3">
                    <label class="form-label label_font">MSME Personal Funds</label>
                    <b class="b_font">M
                        <?php if(!empty($business)){ echo round($business[0]->tbl_business_details_personal_funds); }
                        else{
                            echo "[Unspecified]";
                        } ?>
                    </b>
                </div>


            </div>
        </div>
    </div>
</div>

<div class="tab-pane" id="tabCont4">
    <div class="row">
        <?php 
        $barList = json_decode( $bar, true );
        foreach ($barList as $phase) : ?>


            <div class="col-sm-6 col-md-6">
                <div class="card custom-card">
                    <div class="card-body">
                        <div>
                            <h6 class="card-title mb-1"><?= $phase['phase'] ?></h6>
                        </div>
                        <div class="box box-example-movie">
                            <div class="box-body">
                                <select id="<?= str_replace(" ", "", $phase['phase']) ?>" name="rating" autocomplete="off">
                                    <option class="<?= $phase['percent'] == 25 ? 'br-selected' : '' ?>" value="Bad">25 %</option>
                                    <option class="<?= $phase['percent'] ==  50 ? 'br-selected' : '' ?>" value="Mediocre">50 %</option>
                                    <option value="Good" class="<?= $phase['percent'] == 75 ? 'br-selected' : '' ?>" >75 %</option>
                                    <option value="Awesome" class="<?= $phase['percent'] == 100 ? 'br-selected' : '' ?>" >100 %</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        <?php endforeach; ?>
    </div>
</div>

<div class="tab-pane" id="tabCont5">
    <div class="row">
        <div class="card-body tab-content">
            <div class="tab-pane active show" id="tabCont">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive card-body">
                            <!--<table id="example" class="table key-buttons text-md-nowrap">-->
                              <table class="table text-md-nowrap dataTable no-footer" id="example1" role="grid" aria-describedby="example1_info">
                                <thead>
                                    <tr>
                                        <th scope="col" width="20%">PID</th>
                                        <th scope="col" width="60%">BBM Question</th>
                                        <th scope="col" width="20%">Completion Status</th>
                                    </tr>
                                </thead>
                                <tbody id="question_tbody">
                                    <?php 
                                    foreach ($answered as $key=>$question) : ?>
                                        <tr>
                                            <td> <span><?= ($key+1) ?></span>
                                                <td><?= $question->question_text ?></td>
                                                <td><i class='fa fa-check'></i></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane" id="tabCont6">

        <div class="alert alert-success" role="alert">
            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>Business Incubator Documents!</strong> <br />Display contracts, agreements or any other business incubation's related documents.
        </div>
        <div class="row row-sm">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card-body iconfont text-left">
                    <div class="table-responsive">
                        <table class="table table-bordered mg-b-0 text-md-nowrap" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th scope="col">PID</th>
                                    <th scope="col" class="table_title_width">Contracts | Agreements | Other</th>                           
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($incu_doc as $key => $value) { ?>
                                    <tr>
                                        <td style="font-size: 13px;"><?php echo $i;?></td>
                                        <td style="font-size: 13px;"><a href="<?php echo base_url(); ?>assets/users/<?php echo $value->tbl_all_documents_document;?>" target="_blank"><?php echo $value->tbl_all_documents_title;?></a></td> 

                                    </tr>

                                    <?php $i++; }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<!-- <div class="tab-pane" id="tabCont3">

<button type="submit" class="btn btn-primary waves-effect waves-light sub1">Update Profile</button>
</div> -->
</div>
</div>
<!-- <?php echo form_close(); ?> -->
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

<!-- Rating js-->
<script src="<?= base_url() ?>assets/plugins/rating/jquery.rating-stars.js"></script>

<!-- Rating js-->
<script src="<?= base_url() ?>assets/plugins/rating/jquery.rating-stars.js"></script>
<script src="<?= base_url() ?>assets/plugins/rating/jquery.barrating.js"></script>
<script src="<?= base_url() ?>assets/plugins/rating/ratings.js"></script>

<!-- Rating js-->
<script src="<?= base_url() ?>assets/plugins/rating/jquery.rating-stars.js"></script>
<script src="<?= base_url() ?>assets/plugins/rating/jquery.barrating.js"></script>


<script type="text/javascript">
    $('document').ready(function(){

        if ($('#tbl_business_details_id').val() == '' || $("#tbl_business_details_email").val() == '') {
            $('.business_details_edit').show();
            $('.business_details_show').hide();
            $('.business_fin_details_edit').show();
            $('.business_fin_details_show').hide();
            $(".sub5").show();
        } else {
            $(".tabCont2").show();
            $('.business_details_edit').hide();
            $('.business_details_show').show();
            $('.business_fin_details_edit').hide();
            $('.business_fin_details_show').show();
            $(".sub5").hide();
        }

        let phases = JSON.parse('<?= $bar ?>')
        $.each(phases, function(key, phase) {
            rating = "None";
            if (parseFloat(phase.percent) == 0) {
                $('#'+phase.phaseName).barrating('set', 'Bad');
                rating = "None";
            }
            if (parseFloat(phase.percent) == 25) {
                $('#'+phase.phaseName).barrating('set', 'Bad');
                rating = "Bad"
            }
            if (parseFloat(phase.percent) == 50) {
                $('#'+phase.phaseName).barrating('set', 'Mediocre');
                rating = "Mediocre"
            }
            if (parseFloat(phase.percent) == 75) {
                $('#'+phase.phaseName).barrating('set', 'Good');
                rating = "Good"
            }
            if (parseFloat(phase.percent) == 100) {
                $('#'+phase.phaseName).barrating('set', 'Awesome');
                rating = "Awesome"
            }
            $('#'+phase.phaseName).barrating('show', {
                theme: 'bars-movie',
                allowEmpty: true,
                emptyValue: "None",
                readonly: true, 
                initialRating: rating
            });
        })              

// $('.iti__selected-flag .iti__flag').removeClass('iti__us').addClass('iti__ls');

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

/*$(".tabCont2").hide();*/

/*
// Commented by Munjal
if ($('#tbl_business_details_id').val() == '') {
$('.business_details_edit').show();
$('.sub5').show();
$('.business_details_show').hide();
}
else{
$(".tabCont2").show();
$('.business_details_edit').hide();
$('.business_details_show').show();
}*/

$('.tabCont2').click(function(){
    $('.nav-tabs a[href="#tabCont2"]').tab('show');
});

$(".teams").hide();
$(".teamdt").hide();
$(".sub").show();
$(".sub1").hide();

$('.edit_biz').click(function() {
//$("input").removeClass("textbox-border-hide");
$(".sub5").show();
$('.business_details_edit').show();
$('.business_details_show').hide();
$('.close_biz').show();
$('.edit_biz').hide();

});

$('.close_biz').click(function() {
    $('.business_details_edit').hide();
    $('.business_details_show').show();
    $('.edit_biz').show();
    $('.close_biz').hide();
});

$('.edit_fin').click(function() {
//$("input").removeClass("textbox-border-hide");
$(".sub5").show();
$('.business_fin_details_show').hide();
$('.business_fin_details_edit').show();
$('.close_fin').show();
$('.edit_fin').hide();

});

$('.close_fin').click(function() {
    $('.business_fin_details_show').show();
    $('.business_fin_details_edit').hide();
    $('.edit_fin').show();
    $('.close_fin').hide();
});

$('#tbl_business_details_employees').keyup(function() {
//alert($(this).val());
if ($(this).val() != 0) {
//alert('if');
$(".one").prop('checked',true);
$(".teamdt").show();
$(".teams").show();
/*$(".sub").hide();
$(".sub1").show();*/

}else {
    $(".zero").prop('checked',true);
    $(".teamdt").hide();
    $(".teams").hide();
/* $(".sub").show();
$(".sub1").hide();*/
}
});

var radioValue = $("input[name='tbl_business_details_areyouteam']:checked").val();
if(radioValue == 1){

    $(".teamdt").show();
    $(".teams").show();
    $(".team_data").attr('required', 'required');
/*$(".sub").hide();
$(".sub1").show(); */
}
else
{

    $(".teamdt").hide();
    $(".teams").hide();
    $(".team_data").removeAttr('required');
/*$(".sub").show();
$(".sub1").hide();*/

}
$("input[name='tbl_business_details_areyouteam']").click(function(){
    var radioValue = $(this).val();

    if(radioValue == 1){
        $(".teamdt").show();
        $(".teams").show();
        $(".team_data").attr('required', 'required');
/*$(".sub").hide();
$(".sub1").show();*/

}
else
{
    $(".teamdt").hide();
    $(".teams").hide();
    $(".team_data").removeAttr('required');
/* $(".sub").show();
$(".sub1").hide();*/
}
});

if ($('#tbl_business_details_id').val() == '') {
    $('.sub5').show();
}
});
</script>
<script type="text/javascript">
    $(document).ready(function() {

        $("#btnAdd").bind("click", function () {
//alert('click');
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
        return '<td><input name="tbl_smme_teams_first_name[]" class="sku form-control" id="tbl_smme_teams_first_name" type="text"  placeholder="Enter First Name"></td><td><input  name="tbl_smme_teams_last_name[]" class="form-control" id="tbl_smme_teams_last_name" type="text" placeholder="Enter Last Name"></td><td><input name="tbl_smme_teams_email[]" class="gst form-control" id="tbl_smme_teams_email" pattern="^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$" type="email" placeholder="Enter Emailid" required></td><td><input name="tbl_smme_teams_mobile[]" class="qty form-control" id="tbl_smme_teams_mobile"  type="tel" placeholder="Enter Mobile No." maxlength="10" required></td>'+
        '<td><select id="tbl_smme_teams_gender" class="form-control" name="tbl_smme_teams_gender[]">'+
        '<option value="Male">Male</option>'+
        '<option value="Female">Female</option>'+
        '<option value="Other">Other</option>'+
        '</select></td>'+
        '<td><input type="date" name="tbl_smme_teams_date_hired[]" class="form-control" id="tbl_smme_teams_date_hired" value=""/></td>'+	
        '<td><button type="button" class="btn btn-danger remove" data-toggle="tooltip" data-original-title="Remove" style="float: right;padding: 4px 10px;"><i class="fa fa-trash"></i></button></td>';
    }
</script>
<script type="text/javascript">
    $('#tbl_business_details_industry').change(function() {
//alert($(this).val());
var ind_id = $(this).val();
jQuery.ajax({
    type: "POST",
    url: "<?=base_url()?>user/smme/BusinessDetails/get_sub_industries",
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
});
</script>
<script type="text/javascript">
    var ind_id = $('#ind').val();
    var sub_ind = $('#sub_ind').val();
//alert(sub_ind);
jQuery.ajax({
    type: "POST",
    url: "<?=base_url()?>user/smme/BusinessDetails/get_sub_industries",
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
</body>
</html>