<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?= $header; ?>

                <div class="container">
                    <p><?php if ($this->session->flashdata('danger')) { ?>
                     <div id="infoMessage" class="alert alert-danger mt25"><?php echo $this->session->flashdata('danger');?></div>
                <?php } else if ($this->session->flashdata('success')) { ?>
                     <div id="infoMessage" class="alert alert-success mt25"><?php echo $this->session->flashdata('success');?></div>
                <?php }
                //echo count($tdata);
                //print_r($tdata);?></p>
                    <div class="breadcrumb-header justify-content-between">
                        <div>
                            <h4 class="content-title mb-2">Dashboard</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= site_url('Home') ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Analytics &amp; Monitoring</li>
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
                        <div class="row row-sm">
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                <div class="card">
                                    <div class="card-body iconfont text-left">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title mb-3">REFERENCE NUMBER</h4>
                                            <i class="mdi mdi-dots-horizontal text-gray"></i>
                                        </div>
                                        <div class="d-flex mb-0">
                                            <div class="">
                                                <h4 class="mb-1 font-weight-bold"><?php echo 'MSME-'.$this->session->userdata('user_unique_id');?></h4>
                                                <p class="mb-2 tx-12 text-muted">Created date: <?php echo $user_data[0]->tbl_users_insertdate;?></p>
                                            </div>
                                            <div class="card-chart bg-primary-transparent brround ml-auto mt-0">
                                                <i class="typcn typcn-info-large-outline text-primary tx-24"></i>
                                                
                                            </div>
                                        </div>

                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                <div class="card">
                                    <div class="card-body iconfont text-left">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title mb-3">MSME TEAM MEMBERS</h4>
                                            <i class="mdi mdi-dots-horizontal text-gray"></i>
                                        </div>
                                        <div class="d-flex mb-0">
                                            <div class="">
                                                <h4 class="mb-1 font-weight-bold"><?php echo $total_count_team+1;?></h4>
                                                
                                                <p class="mb-2 tx-12 text-muted">Total number of people in the team</p>
                                            </div>
                                            <div class="card-chart bg-pink-transparent brround ml-auto mt-0">
                                                <a href="<?=site_url('user/smme/team') ?>"><i class="typcn typcn-user-add text-pink tx-24"></i></a>
                                            </div>
                                        </div>

                                        <!-- <div class="progress progress-sm mt-2">
                                            <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" class="progress-bar bg-pink wd-50p" role="progressbar"></div>
                                        </div>
                                        <small class="mb-0  text-muted">Monthly<span class="float-right text-muted">50%</span></small> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                <div class="card">
                                    <div class="card-body iconfont text-left">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title mb-3">INCUBATION STATUS</h4>
                                            <i class="mdi mdi-dots-horizontal text-gray"></i>
                                        </div>
                                        <div class="d-flex mb-0">
                                            <div class="">
                                                
                                                <h4 class="mb-1   font-weight-bold"><?php echo $stage;?></h4>
                                            <p class="mb-2 tx-12 text-muted">MSME's incubation application status</p>
                                            </div>
                                            <div class="card-chart bg-teal-transparent brround ml-auto mt-0">
                                                <a href="<?=site_url('user/smme/Application') ?>"><i class="typcn typcn-starburst text-teal tx-20"></i></a>
                                            </div>
                                        </div>

                                        <!-- <div class="progress progress-sm mt-2">
                                            <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" class="progress-bar bg-teal wd-60p" role="progressbar"></div>
                                        </div>
                                        <small class="mb-0  text-muted">Monthly<span class="float-right text-muted">60%</span></small> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                <div class="card">
                                    <div class="card-body iconfont text-left">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title mb-3">BDSP | COACH | MENTOR</h4>
                                            <i class="mdi mdi-dots-horizontal text-gray"></i>
                                        </div>
                                        <div class="d-flex mb-0">

                                            <div class="">
                                                <h4 class="mb-1 font-weight-bold"><?php echo $incubators_count;?></h4>
                                                <p class="mb-2 tx-12 text-muted">Total BDSPs, Coaches and Mentors</p>
                                            </div>
                                            <div class="card-chart bg-purple-transparent brround ml-auto mt-0">
                                                <a href="<?=site_url('user/smme/Bdsp/allbdsp') ?>"><i class="typcn typcn-group  text-purple tx-24"></i></a>
                                            </div>
                                        </div>

                                        <!-- <div class="progress progress-sm mt-2">
                                            <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" class="progress-bar bg-purple wd-40p" role="progressbar"></div>
                                        </div>
                                        <small class="mb-0  text-muted">Monthly<span class="float-right text-muted">40%</span></small> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- row closed -->

                        <!-- row opened -->
                        <div class="row row-sm">
                            <div class="col-md-12">
                                <div class="card overflow-hidden">
                                    <div class="card-body row row-sm">
                                        <div class="col-4 d-sm-flex align-items-center">
                                            <?php
                                            /*echo "<pre>";
                                            print_r($persoanl_details[0]);*/
                                            if(count($persoanl_details)>0)
											{
											    $count = 0; 
                                                $tot_rec = 0;
                                                foreach ($persoanl_details[0] as $key => $value) {
                                                        if ($value != '') {
                                                            if ($value != '0') {
                                                                $count ++;
                                                            }    
                                                        }
                                                    $tot_rec++;
                                                }
                                                
                                                $total_pr = $count * (100/$tot_rec);
											}	
											else
											{
												$count = $tot_rec = $total_pr = 0; 
											}
                                            ?>
                                            <div class="mg-sm-b-0 mg-sm-r-10">
                                                <span class="peity-donut" data-peity='{ "fill": ["#7571f9", "rgba(158, 158, 158,0.3)"],  "innerRadius": 14, "radius": 20 }'><?php echo $count.'/'.$tot_rec?></span>
                                            </div>
                                            <div>
                                                <label class="tx-12 mb-0">MSME Personal Details</label>
                                                <h4 class="mb-0 font-weight-bold"><?php echo sprintf("%.2f",$total_pr).'%';?></h4>
                                            </div>
                                        </div><!-- col -->
                                        <div class="col-4 d-sm-flex align-items-center">
                                            <?php
                                            //echo "<pre>";
                                            //print_r($business_details[0]); exit;
											if(count($business_details)>0)
											{
                                                $count1 = 0; 
                                                $tot_rec1 = 0;
                                                foreach ($business_details[0] as $key => $value) {
													if($key == 'tbl_business_details_employees')
													{
													}
													else
													{
														if ($value != '') {
															if ($value != '0') {
																$count1 ++;
															}    
														}
														$tot_rec1++;
													}
                                                }
                                                
                                                $total_pr1 = $count1 * (100/$tot_rec1);
											}
											else
											{
												$count1 = $tot_rec1 = $total_pr1 = 0; 
											}
                                            ?>
                                            <div class="mg-sm-b-0 mg-sm-r-10">
                                                <span class="peity-donut" data-peity='{ "fill": ["#ffc107", "rgba(158, 158, 158,0.3)"],  "innerRadius": 14, "radius": 20 }'><?php echo $count1.'/'.$tot_rec1?></span>
                                            </div>
                                            <div>
                                                <label class="tx-12 mb-0">MSME Business Details</label>
                                                <h4 class="mb-0 font-weight-bold"><?php echo sprintf("%.2f",$total_pr1).'%';?></h4>
                                            </div>
                                        </div>
                                        <div class="col-4 d-sm-flex align-items-center">
                                            <?php
                                                //print_r($application_details);
                                                //$count2 = 0; 
                                             if($application_details['result1'][0]->count>0)
											 {
											    $tot_stats = 0;
                                                foreach ($application_details['result'][0] as $key => $value)
                                                {
                                                    $tot_stats+=$value;
                                                }
                                                //echo ;
                                                $count2 = $tot_stats/20;
                                                //print_r($application_details['result1'][0]->count);
                                                $tot_rec2 = 5*$application_details['result1'][0]->count;

                                                $total_pr2 = ($count2 * 100)/$tot_rec2;
                                            }
											else
											{
												$tot_stats = $count2 = $total_pr2 = $tot_rec2 = 0; 
											}
                                            ?>
                                            <div class="mg-sm-b-0 mg-sm-r-10">
                                                <span class="peity-donut" data-peity='{ "fill": ["#22c03c", "rgba(158, 158, 158,0.3)"],  "innerRadius": 14, "radius": 20 }'><?php //echo $count2.'/'.$tot_rec2
                                                    echo $bbmprogress.'/100'; ?></span>
                                            </div>
                                            <div>
                                                <label class="tx-12 mb-0">Business Building Model Status</label>
                                                <!--<h4 class="mb-0 font-weight-bold"><?php echo sprintf("%.2f",$total_pr2);?>%</h4>-->
                                                <h4 class="mb-0 font-weight-bold"><?php echo sprintf("%.2f",$bbmprogress);?>%</h4>
                                            </div>
                                        </div><!-- col -->
                                    </div><!-- card-body -->
                                </div>
                            </div>
                        </div>
                        <!-- row closed -->

                        <!-- row opened -->
                        <div class="row row-sm " style="display:none;">
                           <!-- col -->
                            <div class="col-md-6 col-lg-6 col-xl-4 col-sm-12">
                                <div class="card">
                                    <div class="card-header pb-0 pt-3">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title pt-1">Latest Ratings and Reviews</h4>
                                            <i class="mdi mdi-dots-horizontal text-gray"></i>
                                        </div>
                                    </div>
                                    <p class="tx-12 tx-gray-500 mb-0 pl-3 pr-3">A review is an evaluation of a publication, service, or company .<a href="">Learn more</a></p>
                                    <div class="rating-scroll">
                                        <div class="pl-3 pr-3 py-3 border-bottom">
                                            <div class="media mt-0">
                                                <div class="d-flex mr-3">
                                                    <a href="#">
                                                        <img class="media-object avatar brround w-7 h-7" alt="64x64" src="<?php echo base_url(); ?>assets/img/faces/5.jpg">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <div class="d-flex">
                                                        <h6 class="mt-0 mb-0 font-weight-semibold ">Joanne Scott</h6>
                                                        <span class="tx-12 ml-auto">
                                                            <i class="ion ion-md-star text-warning"></i>
                                                            <i class="ion ion-md-star text-warning"></i>
                                                            <i class="ion ion-md-star text-warning"></i>
                                                            <i class="ion ion-md-star text-warning"></i>
                                                            <i class="ion ion-md-star-half text-warning"></i>
                                                        </span>
                                                    </div>
                                                    <div class="d-flex">
                                                        <p class="tx-12 text-muted mb-0">long established fact..</p>
                                                        <small class="ml-auto text-right">5 reviews</small>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="pl-3 pr-3 py-3 border-bottom">
                                            <div class="media mt-0">
                                                <div class="d-flex mr-3">
                                                    <a href="#">
                                                        <img class="media-object avatar brround w-7 h-7" alt="64x64" src="<?php echo base_url(); ?>assets/img/faces/9.jpg">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <div class="d-flex">
                                                        <h6 class="mt-0 mb-0 font-weight-semibold ">Cristobal Sharp</h6>
                                                        <span class="tx-12 ml-auto">
                                                            <i class="ion ion-md-star text-warning"></i>
                                                            <i class="ion ion-md-star text-warning"></i>
                                                            <i class="ion ion-md-star text-warning"></i>
                                                            <i class="ion ion-md-star-half text-warning"></i>
                                                            <i class="ion ion-md-star-outline text-warning"></i>
                                                        </span>
                                                    </div>
                                                    <div class="d-flex">
                                                        <p class="tx-12 text-muted mb-0">The point of using Lorem..</p>
                                                        <small class="ml-auto text-right">5 reviews</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pl-3 pr-3 py-3 border-bottom">
                                            <div class="media mt-0">
                                                <div class="d-flex mr-3">
                                                    <a href="#">
                                                        <img class="media-object avatar brround w-7 h-7" alt="64x64" src="<?php echo base_url(); ?>assets/img/faces/4.jpg">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <div class="d-flex">
                                                        <h6 class="mt-0 mb-0 font-weight-semibold ">Velma Wellons </h6>
                                                        <span class="tx-12 ml-auto">
                                                            <i class="ion ion-md-star text-warning"></i>
                                                            <i class="ion ion-md-star text-warning"></i>
                                                            <i class="ion ion-md-star text-warning"></i>
                                                            <i class="ion ion-md-star text-warning"></i>
                                                            <i class="ion ion-md-star-half text-warning"></i>
                                                        </span>
                                                    </div>
                                                    <div class="d-flex">
                                                        <p class="tx-12 text-muted mb-0">Various versions have..</p>
                                                        <small class="ml-auto text-right">5 reviews</small>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="pl-3 pr-3 py-3 border-bottom">
                                            <div class="media mt-0">
                                                <div class="d-flex mr-3">
                                                    <a href="#">
                                                        <img class="media-object avatar brround w-7 h-7" alt="64x64" src="<?php echo base_url(); ?>assets/img/faces/7.jpg">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <div class="d-flex">
                                                        <h6 class="mt-0 mb-0 font-weight-semibold ">Cathie Madonna </h6>
                                                        <span class="tx-12 ml-auto">
                                                            <i class="ion ion-md-star text-warning"></i>
                                                            <i class="ion ion-md-star text-warning"></i>
                                                            <i class="ion ion-md-star text-warning"></i>
                                                            <i class="ion ion-md-star-half text-warning"></i>
                                                            <i class="ion ion-md-star-outline text-warning"></i>
                                                        </span>
                                                    </div>
                                                    <div class="d-flex">
                                                        <p class="tx-12 text-muted mb-0">long established fact..</p>
                                                        <small class="ml-auto text-right">5 reviews</small>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="pl-3 pr-3 py-3 border-bottom">
                                            <div class="media mt-0">
                                                <div class="d-flex mr-3">
                                                    <a href="#">
                                                        <img class="media-object avatar brround w-7 h-7" alt="64x64" src="<?php echo base_url(); ?>assets/img/faces/12.jpg">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <div class="d-flex">
                                                        <h6 class="mt-0 mb-0 font-weight-semibold ">Aurelio Dahmer </h6>
                                                        <span class="tx-12 ml-auto">
                                                            <i class="ion ion-md-star text-warning"></i>
                                                            <i class="ion ion-md-star text-warning"></i>
                                                            <i class="ion ion-md-star text-warning"></i>
                                                            <i class="ion ion-md-star text-warning"></i>
                                                            <i class="ion ion-md-star-half text-warning"></i>
                                                        </span>
                                                    </div>
                                                    <div class="d-flex">
                                                        <p class="tx-12 text-muted mb-0">Ut enim ad minim veniam..</p>
                                                        <small class="ml-auto text-right">5 reviews</small>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="pl-3 pr-3 py-3 border-bottom">
                                            <div class="media mt-0">
                                                <div class="d-flex mr-3">
                                                    <a href="#">
                                                        <img class="media-object avatar brround w-7 h-7" alt="64x64" src="<?php echo base_url(); ?>assets/img/faces/13.jpg">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <div class="d-flex">
                                                        <h6 class="mt-0 mb-1 font-weight-semibold ">Cyrus Macarthur </h6>
                                                        <span class="tx-12 ml-auto">
                                                            <i class="ion ion-md-star text-warning"></i>
                                                            <i class="ion ion-md-star text-warning"></i>
                                                            <i class="ion ion-md-star text-warning"></i>
                                                            <i class="ion ion-md-star-half text-warning"></i>
                                                            <i class="ion ion-md-star-outline text-warning"></i>
                                                        </span>
                                                    </div>
                                                    <div class="d-flex">
                                                        <p class="tx-12 text-muted mb-0">variations of passages..</p>
                                                        <small class="ml-auto text-right">5 reviews</small>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="pl-3 pr-3 py-3 border-bottom">
                                            <div class="media mt-0">
                                                <div class="d-flex mr-3">
                                                    <a href="#">
                                                        <img class="media-object avatar brround w-7 h-7" alt="64x64" src="<?php echo base_url(); ?>assets/img/faces/2.jpg">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <div class="d-flex">
                                                        <h6 class="mt-0 mb-1 font-weight-semibold ">Bernardo Sykes </h6>
                                                        <span class="tx-12 ml-auto">
                                                            <i class="ion ion-md-star text-warning"></i>
                                                            <i class="ion ion-md-star text-warning"></i>
                                                            <i class="ion ion-md-star text-warning"></i>
                                                            <i class="ion ion-md-star-half text-warning"></i>
                                                            <i class="ion ion-md-star-outline text-warning"></i>
                                                        </span>
                                                    </div>
                                                    <div class="d-flex">
                                                        <p class="tx-12 text-muted mb-0">you are going to use..</p>
                                                        <small class="ml-auto text-right">5 reviews</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12 col-xl-4 col-sm-12">
                                <div class="card overflow-hidden">
                                    <div class="card-header pb-0 pt-3">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title pt-1">Sessions By Channel</h4>
                                            <i class="mdi mdi-dots-horizontal text-gray"></i>
                                        </div>
                                        <p class="tx-12 tx-gray-500 mb-0">Sessions by channel is the number of sessions attributed to each channel grouping.<a href="">Learn more</a></p>
                                    </div>
                                    <div class="card-body">
                                        <div class="row text-center">
                                            <div class="col dash-1">
                                                <p class="mb-0">Organic</p>
                                                <h3 class="mb-0 ">80%</h3>
                                            </div>
                                            <div class="col dash-1">
                                                <p class="mb-0">Direct</p>
                                                <h3 class="mb-0 ">68%</h3>
                                            </div>
                                            <div class="col">
                                                <p class="mb-0">Campagion</p>
                                                <h3 class="mb-0 ">45%</h3>
                                            </div>
                                            <div class="col dash-1">
                                                <p class="mb-0">Refferal</p>
                                                <h3 class="mb-0 ">32%</h3>
                                            </div>
                                        </div>
                                        <div class="chart-wrapper mt-3">
                                            <canvas id="bar-chart-horizontal" class="ht-238"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- row close -->
                         <div class="row row-sm">
                            <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12">
                                <div class="card ">
                                    <div class="card-header pb-0">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title">MSME PERSONAL TO-DOS</h4>
                                            <a href="javascipt:void(0)" class="btn btn-outline-primary mr-3"  data-target="#todo" data-toggle="modal"><span class="icon-label"><i class="mdi mdi-account-edit"></i></span><span class="btn-text"> Add a task</span></a>
                                            <!-- <i class="mdi mdi-dots-horizontal text-gray"></i> -->
                                        </div>
                                        <p class="mb-0 tx-12 tx-gray-500">Manage, prioritize, and complete the most important things you need to achieve every day.</p>
                                    </div>
                                    <div class="table-responsive card-body">
                                        <table class="table mg-b-0 table-bordered text-sm-nowrap text-lg-nowrap text-xl-nowrap">
                                            <thead>
                                                <tr>
                                                    <th class="wd-5p pd-t-6">PID</th>
                                                    <th class="wd-45p pd-t-6">Todo Subject</th>
                                                    <th class="pd-t-6">Todo Entry Date</th>
                                                    <th class="pd-t-6">Todo Due Date</th>
                                                    <th class="pd-t-6">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($personal_todos as $key => $value) { ?>
                                                    <tr>
                                                        <td><i class="ion ion-md-star text-warning"></i></td>
                                                        <td><strong><?php echo $value->tbl_personal_todos_subject;?></strong></td>
                                                        <?php
                                                            $entry_date = Date('F j Y',strtotime($value->tbl_personal_todos_insertdate));
                                                        ?>
                                                        <td><?php echo $entry_date;?></td>
                                                        <?php
                                                            $due_date = Date('F j Y',strtotime($value->tbl_personal_todos_due_date));
                                                        ?>
                                                        <td><?php echo $due_date?></td>
                                                        <td>
                                                            <button data-toggle="dropdown" class="btn btn-primary btn-block button_width"><i class="la la-cog setting"></i></button>
                                                            <div class="dropdown-menu">
                                                                <a href="javascript:void(0)" class="dropdown-item todo_id" data-target="#edittodo" data-toggle="modal" data-id="<?php echo $value->tbl_personal_todos_id;?>"><i class="fa fa-edit"></i> Edit
                                                                </a>
                                                                <a href="<?= site_url('user/smme/PersonalTodo/delete/'.$value->tbl_personal_todos_id) ?>" class="dropdown-item"><i class="fa fa-trash"></i> Delete 
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div><!-- table-responsive -->
                                </div><!-- card -->
                            </div>

                            <div class="modal" id="todo">
                                <div class="modal-dialog modal_small" role="document">
                                    <div class="modal-content modal-content-demo">
                                    <?php echo admin_form_open("user/smme/PersonalTodo/add", 'class="login" data-toggle="validator"'); ?>
                                        <div class="modal-header">
                                            <h6 class="modal-title">Personal TO-Do List</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body feedback_user_id">
                                            <label for="subject">Subject*</label>
                                            <input type="text" name="subject" id="subject" class="form-control" required="">
                                            <label for="due_date">Enter Due Date*</label>
                                            <input type="date" name="due_date" id="due_date" class="form-control" required="">
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn ripple btn-primary" type="submit">Save</button>
                                            <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
                                        </div>
                                    <?php echo form_close(); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="modal" id="edittodo">
                                <div class="modal-dialog modal_small" role="document">
                                    <div class="modal-content modal-content-demo">
                                    <?php echo admin_form_open("user/smme/PersonalTodo/update", 'class="login" data-toggle="validator"'); ?>
                                        <div class="modal-header">
                                            <h6 class="modal-title">Update Personal TO-Do</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body EditToDo">
                                            <input type="hidden" name="personal_todo_id" id="personal_todo_id">
                                            <label for="subject">Subject*</label>
                                            <input type="text" name="subject" id="subject" class="form-control" required="">
                                            <label for="due_date">Enter Due Date*</label>
                                            <input type="date" name="due_date" id="due_date" class="form-control" required="">
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn ripple btn-primary" type="submit">Update</button>
                                            <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
                                        </div>
                                    <?php echo form_close(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- row opened -->
                        <!-- <div class="row row-sm">
                            <div class="col-xl-5 col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title">Customer Satisfaction</h4>
                                            <i class="mdi mdi-dots-horizontal text-gray"></i>
                                        </div>
                                        <p class="tx-12 tx-gray-500 mb-0">Measures the quality or your support team’s efforts. It is important to monitor your customer satisfaction status... <a href="">Learn more</a></p>
                                    </div>
                                    <div class="card-body row pd-25 pt-2">
                                        <div class="col-sm-8 col-md-7">
                                            <div class="wd-100p ht-200" id="flotPie"></div>
                                        </div>
                                        <div class="col-sm-4 col-md-5 mg-t-30 mg-sm-t-0 my-auto">
                                            <ul class="list-unstyled">
                                                <li class="d-flex align-items-center"><span class="d-inline-block wd-10 ht-10 bg-purple mg-r-10"></span> Very Satisfied (26%)</li>
                                                <li class="d-flex align-items-center mg-t-5"><span class="d-inline-block wd-10 ht-10 bg-primary mg-r-10"></span> Satisfied (39%)</li>
                                                <li class="d-flex align-items-center mg-t-5"><span class="d-inline-block wd-10 ht-10 bg-teal mg-r-10"></span> Not Satisfied (20%)</li>
                                                <li class="d-flex align-items-center mg-t-5 mb-0"><span class="d-inline-block wd-10 ht-10 bg-pink mg-r-10"></span> Satisfied (15%)</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-7">
                                <div class="card ">
                                    <div class="card-header pb-0">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title">What pages do your users visit</h4>
                                            <i class="mdi mdi-dots-horizontal text-gray"></i>
                                        </div>
                                        <p class="mb-0 tx-12 tx-gray-500">Part of this date range occurs before the new users metric had been calculated, so the old users metric is displayed.</p>
                                    </div>
                                    <div class="table-responsive card-body">
                                        <table class="table mg-b-0 table-bordered text-sm-nowrap text-lg-nowrap text-xl-nowrap">
                                            <thead>
                                                <tr>
                                                    <th class="wd-5p pd-t-6">&nbsp;</th>
                                                    <th class="wd-45p pd-t-6">Country</th>
                                                    <th class="pd-t-6">Entrances</th>
                                                    <th class="pd-t-6">Bounce Rate</th>
                                                    <th class="pd-t-6">Exits</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><i class="flag-icon flag-icon-us flag-icon-squared"></i></td>
                                                    <td><strong>United States</strong></td>
                                                    <td><strong>134</strong> (1.51%)</td>
                                                    <td>33.58%</td>
                                                    <td>15.47%</td>
                                                </tr>
                                                <tr>
                                                    <td><i class="flag-icon flag-icon-gb flag-icon-squared"></i></td>
                                                    <td><strong>United Kingdom</strong></td>
                                                    <td><strong>290</strong> (3.30%)</td>
                                                    <td>9.22%</td>
                                                    <td>7.99%</td>
                                                </tr>
                                                <tr>
                                                    <td><i class="flag-icon flag-icon-in flag-icon-squared"></i></td>
                                                    <td><strong>India</strong></td>
                                                    <td><strong>250</strong> (3.00%)</td>
                                                    <td>20.75%</td>
                                                    <td>2.40%</td>
                                                </tr>
                                                <tr>
                                                    <td><i class="flag-icon flag-icon-ca flag-icon-squared"></i></td>
                                                    <td><strong>Canada</strong></td>
                                                    <td><strong>216</strong> (2.79%)</td>
                                                    <td>32.07%</td>
                                                    <td>15.09%</td>
                                                </tr>
                                                <tr>
                                                    <td><i class="flag-icon flag-icon-fr flag-icon-squared"></i></td>
                                                    <td><strong>France</strong></td>
                                                    <td><strong>216</strong> (2.79%)</td>
                                                    <td>32.07%</td>
                                                    <td>15.09%</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div> 
                                </div>
                            </div>
                        </div> -->
                        <!-- row closed -->
                    </div>
                </div>
                <!-- Container closed -->

                <!--Sidebar-right-->
                
        <?= $footer; ?>
        <script type="text/javascript">
            $('.todo_id').click(function(){
            var id = $(this).data('id');
            //alert(id);
           $('.EditToDo #personal_todo_id').val(id);
            jQuery.ajax({
                type: "POST",
                url: "<?=base_url()?>user/smme/PersonalTodo/get_todo",
                dataType: 'text',
                data: {id:id},
                success: function(data) 
                {
                    //console.log(data);
                    var obj = JSON.parse(data);
                    //console.log(obj[0].tbl_personal_todos_subject);
                    $('.EditToDo #subject').val(obj[0].tbl_personal_todos_subject);
                    $('.EditToDo #due_date').val(obj[0].tbl_personal_todos_due_date);
                   
                }
            });
        });
        </script>
        
