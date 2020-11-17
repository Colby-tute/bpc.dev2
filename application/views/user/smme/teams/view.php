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
                        <li class="breadcrumb-item"><a href="<?= site_url('Home') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('user/smme/Incubator') ?>">Incubation Managers</a></li>
                        <li class="breadcrumb-item active" aria-current="page">View Profile</li>
                    </ol>
                </nav>

            </div>
           <div class="my-auto breadcrumb-right">
							<a href="<?= site_url('user/smme/Application') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-bell mr-2"></i></span><span class="btn-text">Status </span></button></a>
							<a href="<?= site_url('Profile/view_profile/'.$this->session->userdata('id_user')) ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Personal Details </span></button></a>
							<button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-question-circle mr-2"></i> </span><span class="btn-text">Help </span></button>
						</div>
        </div>

        <div class="">
            <!-- row opened -->
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
            <div class="row row-sm">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-body iconfont text-left">
                            <div class="border">
                                <div class="bg-gray-300 nav-bg">
                                    <nav class="nav nav-tabs">
                                        <a class="nav-link active" data-toggle="tab" href="#tabCont2">Incubator Business Details</a>
                                        <a class="nav-link" data-toggle="tab" href="#tabCont3">Incubator Contact Person</a>
                                         <a class="nav-link" data-toggle="tab" href="#tabCont4">Products & Services</a>
                                        <a class="nav-link" data-toggle="tab" href="#tabCont5">Partners</a>
                                        
                                    </nav>
                                </div>
                                <div class="card-body tab-content">

                                    <div class="tab-pane active" id="tabCont2">
                                        <div class="business_details_show">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label class="form-label label_font">Business Name</label>
                                                             <b class="b_font">
                                                            <?php
                                                                if (!empty($business)) {
                                                                    echo $buss->tbl_business_details_name;
                                                                }else {
                                                                    echo '[Unspecified]';
                                                                }
                                                                ?></b>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <label class="form-label label_font">Incubator Industry</label>
                                                            <b class="b_font">
                                                            <?php 
                                                                if(!empty($business)){ 
                                                                    echo $buss->tbl_industry_name; 
                                                                }else{
                                                                    echo "[Unspecified]";
                                                                } ?>
                                                            </b>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <label class="form-label label_font">Sub Industry</label>
                                                            <b class="b_font">
                                                            <?php 
                                                                if(!empty($business)){ 
                                                                    echo $buss->tbl_sub_industry_name; 
                                                                }else{
                                                                    echo "[Unspecified]";
                                                                } ?>
                                                            </b>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <label class="form-label label_font">Business Email</label>
                                                            <b class="b_font">
                                                            <?php if(!empty($business)){ echo $buss->tbl_business_details_email; 
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
                                                            <?php if(!empty($business)){ echo $buss->tbl_business_details_phone; 
                                                            }else{
                                                                echo "[Unspecified]";
                                                            } ?>
                                                            </b>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <label class="form-label label_font">Business District</label>
                                                            <b class="b_font">
                                                            <?php if(!empty($business)){ echo $buss->tbl_business_details_district; }else{
                                                                echo "[Unspecified]";
                                                            } ?>
                                                            </b>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <label class="form-label label_font">Business Village/Town</label>
                                                            <b class="b_font">
                                                            <?php if(!empty($business)){ echo $buss->tbl_business_details_town_village; 
                                                            }else{
                                                                echo "[Unspecified]";
                                                            } ?>
                                                            </b>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <label class="form-label label_font">Number Of Employees</label>
                                                        <b class="b_font">
                                                        <?php if(!empty($business)){ echo $buss->tbl_business_details_employees; 
                                                        }else{
                                                            echo "[Unspecified]";
                                                        } ?>
                                                        </b>
                                                        </div>

                                                    </div>
                                                </div>

                                               
                                            </div>
                                    </div>
                                    
                                    <div class="tab-pane" id="tabCont3">
                                        <div class="form-group ">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label class="form-label label_font">First Name</label>
                                                        <b class="b_font"><?php if(!empty($userdt)){ echo $user->tbl_users_firstname; } ?></b>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label label_font">Last Name</label>
                                                        <b class="b_font"><?php if(!empty($userdt)){ echo $user->tbl_users_lastname; } ?></b>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label label_font">Mobile Number</label>
                                                        <?php
                                                            if(!empty($userdt)){
                                                                if ($user->tbl_users_mobile != '') {
                                                                    if ($user->tbl_users_contrycode != '') {
                                                                        $exp = explode('-',$user->tbl_users_contrycode);
                                                                        /*print_r($exp);*/
                                                                        $code = $exp[1];
                                                                    }
                                                                    else{
                                                                        $code = '';
                                                                    }
                                                                    
                                                                    $mobile = '+'.$code.''.$user->tbl_users_mobile;
                                                                }else{
                                                                    $mobile = '';
                                                                }
                                                            }
                                                        ?>
                                                        <b class="b_font"><?php echo $mobile; ?></b>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label label_font">Email Address</label>
                                                        <b class="b_font"><?php if(!empty($userdt)){ echo $user->tbl_users_email; } ?></b>
                                                    </div>
                                                </div>
                                        </div>

                                       
                                    </div>

                                    <div class="tab-pane" id="tabCont4">
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <?= !empty($business) ? $business->product_service : "" ?>
                                                </div>  
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="tabCont5">
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Partner</th>
                                                                <th>Email</th>
                                                                <th>Phone</th>
                                                                <th>Address</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php if ($partners) : 
                                                            foreach($partners as $k => $partner) :
                                                            ?>
                                                            <tr>
                                                                <td><?= $k+1 ?></td>
                                                                <td><?= $partner->name ?></td>
                                                                <td><?= $partner->email ?></td>
                                                                <td><?= $partner->phone ?></td>
                                                                <td><?= $partner->address ?></td>
                                                            </tr>
                                                        <?php endforeach; endif; ?>
                                                        </tbody>
                                                    </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
            $('document').ready(function(){

                $('.tabCont2').click(function(){
                  $('.nav-tabs a[href="#tabCont2"]').tab('show');
                });

                $('.tabCont3').click(function(){
                  $('.nav-tabs a[href="#tabCont3"]').tab('show');
                });




            });
        </script>
    