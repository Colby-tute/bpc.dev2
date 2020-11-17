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
                                    <li class="breadcrumb-item"><a href="<?= site_url('admin/home') ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Analytics &amp; Monitoring </li>
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
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
							
                                <div class="card">
                                    <div class="card-body iconfont text-left">
									
                                        <div class="d-flex justify-content-between">
                                           <h4 class="card-title mb-3">TOTAL COMPETITIONS</h4>
                                           <i class="mdi mdi-dots-horizontal text-gray"></i>
                                           
                                        </div>
                                        
                                        <div class="d-flex mb-0">
                                            <div class="">
                                                <h4 class="mb-1 font-weight-bold"><?php echo $role['smme'];?></h4>
                                                <p class="mb-2 tx-12 text-muted">Total competitions in the BPC system.</p>
                                            </div>
                                            <div class="card-chart bg-primary-transparent brround ml-auto mt-0">
                                                 <a href="<?=site_url('admin/smme') ?>"><i class="typcn typcn-star text-primary tx-24"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
                            </div>
							
							 <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
							
								<div class="card">
									<div class="card-body iconfont text-left">
										<div class="d-flex justify-content-between">
											<h4 class="card-title mb-3">ACTIVE COMPETITIONS</h4>
											<i class="mdi mdi-dots-horizontal text-gray"></i>
										</div>
										<div class="d-flex mb-0">
											<div class="">
												<h4 class="mb-1 font-weight-bold"><?php echo $smmeApps ?><!-- <span class="text-success tx-13 ml-2">(<?php echo $role['app_active'];?>)</span> --></h4>
												 <p class="mb-2 tx-12 text-muted">Total active competitions</p>
											</div>
											<div class="card-chart bg-teal-transparent brround ml-auto mt-0">
												<a href="<?=site_url('admin/smme/application') ?>"><i class="typcn typcn-folder-add  text-teal tx-24"></i></a>
											</div>
										</div>
									</div>
								</div>
								
							</div>
							
							<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
							
                             <div class="card">
                                    <div class="card-body iconfont text-left">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title mb-3">DISABLED COMPETITIONS</h4>
                                            <i class="mdi mdi-dots-horizontal text-gray"></i>
                                        </div>
                                        <div class="d-flex mb-0">
                                            <div class="">
                                                <h4 class="mb-1 font-weight-bold"><?php echo $declinedApps ?></h4>
                                                <p class="mb-2 tx-12 text-muted">Total declined applications.</p>
                                            </div>
                                            <div class="card-chart bg-pink-transparent brround ml-auto mt-0">
                                                <a href="<?=site_url('admin/smme/application') ?>"><i class="typcn typcn-cancel text-pink tx-24"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
                            </div>
							
							
							<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
							
								<div class="card">
									<div class="card-body iconfont text-left">
										<div class="d-flex justify-content-between">
											<h4 class="card-title mb-3">CLOSED COMPETITIONS</h4>
											<i class="mdi mdi-dots-horizontal text-gray"></i>
										</div>
										<div class="d-flex mb-0">
											<div class="">
												<h4 class="mb-1 font-weight-bold"><?php

												 echo $incSmmes ?></h4>
												 <p class="mb-2 tx-12 text-muted">Total number of MSMEs in incubation</p>
											</div>
											<div class="card-chart bg-purple-transparent brround ml-auto mt-0">
												<a href="<?=site_url('admin/smme') ?>"><i class="typcn typcn-group text-purple tx-24"></i></a>
											</div>
										</div>
									</div>
								</div>
								
							</div>
							
							
							<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
							
								<div class="card">
									<div class="card-body iconfont text-left">
										<div class="d-flex justify-content-between">
											<h4 class="card-title mb-3">FEMALES IN INCUBATION</h4>
											<i class="mdi mdi-dots-horizontal text-gray"></i>
										</div>
										<div class="d-flex mb-0">
											<div class="">
												<h4 class="mb-1 font-weight-bold"><?php echo $graduated ?></h4>
												 <p class="mb-2 tx-12 text-muted">Total female MSMEs in incubation.</p>
											</div>
											<div class="card-chart bg-warning-transparent brround ml-auto mt-0">
												<a href="<?=site_url('admin/smme') ?>"><i class="typcn typcn-user-delete  text-warning tx-24"></i></a>
											</div>
										</div>
									</div>
								</div>
								
							</div>
							
							<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
							
								<div class="card">
									<div class="card-body iconfont text-left">
										<div class="d-flex justify-content-between">
											<h4 class="card-title mb-3">MALES IN INCUBATION</h4>
											<i class="mdi mdi-dots-horizontal text-gray"></i>
										</div>
										<div class="d-flex mb-0">
											<div class="">
												<h4 class="mb-1 font-weight-bold"><?php echo $msAchieved ?></h4>
												 <p class="mb-2 tx-12 text-muted">Total male MSMEs in incubation.</p>
											</div>
											<div class="card-chart bg-success-transparent brround ml-auto mt-0">
												<a href="<?=site_url('admin/smme') ?>"><i class="typcn typcn-user-add  text-success tx-24"></i></a>
											</div>
										</div>
									</div>
								</div>
								
							</div>
							
							<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
							
								<div class="card">
									<div class="card-body iconfont text-left">
										<div class="d-flex justify-content-between">
											<h4 class="card-title mb-3">MSME Milestone Tasks</h4>
											<i class="mdi mdi-dots-horizontal text-gray"></i>
										</div>
										<div class="d-flex mb-0">
											<div class="">
												<h4 class="mb-1 font-weight-bold"><?php echo $jobs ?></h4>
                                                <p class="mb-2 tx-12 text-muted">Total MSMEs' milestone tasks</p>
											</div>
											<div class="card-chart bg-purple-transparent brround ml-auto mt-0">
												<a href="<?=site_url('admin/incubators/Incubators/bbm') ?>"><i class="typcn typcn-location text-purple tx-24"></i></a>
											</div>
										</div>
									</div>
								</div>
								
							</div>
							<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
							
								<div class="card">
									<div class="card-body iconfont text-left">
										<div class="d-flex justify-content-between">
											<h4 class="card-title mb-3">MSME CREATED JOBS</h4>
											<i class="mdi mdi-dots-horizontal text-gray"></i>
										</div>
										<div class="d-flex mb-0">
											<div class="">
												<h4 class="mb-1 font-weight-bold"><?php echo $jobs1 ?></h4>
                                                <p class="mb-2 tx-12 text-muted">Total casual or seasonal jobs created</p>
											</div>
											<div class="card-chart bg-primary-transparent brround ml-auto mt-0">
												<a href="<?=site_url('admin/smme') ?>"><i class="typcn typcn-briefcase text-primary tx-24"></i></a>
											</div>
										</div>
									</div>
								</div>
								
							</div>
							
							
						<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
							
								<div class="card">
									<div class="card-body iconfont text-left">
										<div class="d-flex justify-content-between">
											<h4 class="card-title mb-3">TOTAL BI RAISED FUNDS</h4>
											<i class="mdi mdi-dots-horizontal text-gray"></i>
										</div>
										<div class="d-flex mb-0">
											<div class="">
												<h4 class="mb-1 font-weight-bold">M<?php echo $inc_revenue ?></h4>
                                                <p class="mb-2 tx-12 text-muted">Business incubator's raised funds</p>
											</div>
											<div class="card-chart bg-pink-transparent brround ml-auto mt-0">
												<a href="<?=site_url('admin/smme') ?>"><i class="typcn typcn-chart-pie text-pink tx-24"></i></a>
											</div>
										</div>
									</div>
								</div>
								
							</div>
							<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
								<div class="card">
									<div class="card-body iconfont text-left">
										<div class="d-flex justify-content-between">
											<h4 class="card-title mb-3">GRADUATED MSMES</h4>
											<i class="mdi mdi-dots-horizontal text-gray"></i>
										</div>
										<div class="d-flex mb-0">
											<div class="">
												<h4 class="mb-1 font-weight-bold"><?php echo $graduated00 ?></h4>
												 <p class="mb-2 tx-12 text-muted">Total number of graduated MSMEs.</p>
											</div>
											<div class="card-chart bg-purple-transparent brround ml-auto mt-0">
												<a href="<?=site_url('admin/smme') ?>"><i class="typcn typcn-mortar-board text-purple tx-24"></i></a>
											</div>
										</div>
									</div>
								</div>
							</div>


						
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
							
                                <div class="card">
                                    <div class="card-body iconfont text-left">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title mb-3">Registered Incubators</h4>
                                            <i class="mdi mdi-dots-horizontal text-gray"></i>
                                        </div>
                                        <div class="d-flex mb-0">
                                            <div class="">
                                                <h4 class="mb-1 font-weight-bold"><?php echo $role['inc']?></h4>
                                                <p class="mb-2 tx-12 text-muted">Total number of registered incubators</p>
                                            </div>
                                            <div class="card-chart bg-pink-transparent brround ml-auto mt-0">
                                                <a href="<?=site_url('admin/incubators') ?>"><i class="typcn typcn-th-large text-pink tx-24"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
                            </div>
							
													
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
							
                                <div class="card">
                                    <div class="card-body iconfont text-left">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title mb-3">BDSP | Coaches | Mentors</h4>
                                            <i class="mdi mdi-dots-horizontal text-gray"></i>
                                        </div>
                                        <div class="d-flex mb-0">
                                            <div class="">
                                                <h4 class="mb-1   font-weight-bold"><?php echo $role['bdsp']?></h4>
                                                <p class="mb-2 tx-12 text-muted">Total BDSP, coaches and mentors.</p>
                                            </div>
                                            <div class="card-chart bg-teal-transparent brround ml-auto mt-0">
                                                <a href="<?=site_url('admin/bdsps') ?>"><i class="typcn typcn-th-small text-teal tx-20"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
                            </div>
                            
							
							
							
							

							
							
							
							
							
							<!-- row closed -->

                         <!-- <div class="row row-sm">
                            <div class="col-lg-4 col-xl-4">
                                <div class="card ">
                                    <div class="card-header pb-0">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title">Top 10 SMME</h4>
                                            <i class="mdi mdi-dots-horizontal text-gray"></i>
                                        </div>
                                        <p class="mb-0 tx-12 tx-gray-500">Part of this date range occurs before the new users metric had been calculated, so the old users metric is displayed.</p>
                                    </div>
                                    <div class="table-responsive card-body h461">
                                        <table class="table table-bordered mg-b-0 text-md-nowrap">
                                            <thead>
                                                <tr>
                                                    <th class="wd-5p pd-t-6">&nbsp;</th>
                                                    <th class="pd-t-6">Unique id</th>
                                                    <th class="pd-t-6">Email id</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php 
                                                $i=1;
                                                foreach ($role['smmedt'] as $key => $smme) {?>
                                                   
                                                <tr>
                                                    <td><?php echo $i;?></td>
                                                    <td><?php echo $smme->tbl_users_user_uniqueid;?></td>
                                                    <td><?php echo $smme->tbl_users_email;?></td>
                                                </tr>
                                                <?php
                                                if($i == 10)
                                                {
                                                    break;
                                                }
                                                $i++;
                                                } 
                                                ?>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xl-4">
                                <div class="card ">
                                    <div class="card-header pb-0">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title">Top 10 Incubators</h4>
                                            <i class="mdi mdi-dots-horizontal text-gray"></i>
                                        </div>
                                        <p class="mb-0 tx-12 tx-gray-500">Part of this date range occurs before the new users metric had been calculated, so the old users metric is displayed.</p>
                                    </div>
                                    <div class="table-responsive card-body h461">
                                        <table class="table table-bordered mg-b-0 text-md-nowrap">
                                            <thead>
                                                <tr>
                                                    <th class="wd-5p pd-t-6">&nbsp;</th>
                                                    <th class="pd-t-6">Unique id</th>
                                                    <th class="pd-t-6">Email id</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php 
                                                $j=1;
                                                foreach ($role['incdt'] as $key => $inc) {?>
                                                   
                                                <tr>
                                                    <td><?php echo $j;?></td>
                                                    <td><?php echo $inc->tbl_users_user_uniqueid;?></td>
                                                    <td><?php echo $inc->tbl_users_email;?></td>
                                                </tr>
                                                <?php
                                                if($j == 10)
                                                {
                                                    break;
                                                }
                                                $j++;
                                                } 
                                                ?>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-lg-4 col-xl-4">
                                <div class="card ">
                                    <div class="card-header pb-0">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title">Top 10 Bdsp</h4>
                                            <i class="mdi mdi-dots-horizontal text-gray"></i>
                                        </div>
                                        <p class="mb-0 tx-12 tx-gray-500">Part of this date range occurs before the new users metric had been calculated, so the old users metric is displayed.</p>
                                    </div>
                                    <div class="table-responsive card-body h461">
                                        <table class="table table-bordered mg-b-0 text-md-nowrap">
                                            <thead>
                                                <tr>
                                                    <th class="wd-5p pd-t-6">&nbsp;</th>
                                                    <th class="pd-t-6">Unique id</th>
                                                    <th class="pd-t-6">Email id</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php 
                                                $i=1;
                                                foreach ($role['bdspdt'] as $key => $bdsp) {?>
                                                   
                                                <tr>
                                                    <td><?php echo $i;?></td>
                                                    <td><?php echo $bdsp->tbl_users_user_uniqueid;?></td>
                                                    <td><?php echo $bdsp->tbl_users_email;?></td>
                                                </tr>
                                                <?php
                                                if($i == 10)
                                                {
                                                    break;
                                                }
                                                $i++;
                                                } 
                                                ?>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            
                        </div> -->
                        <!-- row closed -->
                    </div>

                    <!-- <div class="row row-sm">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body iconfont text-left">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="card-title mb-3">TO-DO & TASKS</h4>
                                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                                    </div>
                                    <div class="d-flex mb-0">
                                        <div class="">
                                            <h4 class="mb-1 font-weight-bold">154<span class="text-success tx-13 ml-2">(143 active)</span></h4>
                                            <p class="mb-2 tx-12 text-muted">Last Approved: 2020-04-10 05:40PM</p>
                                        </div>
                                        <div class="card-chart bg-purple-transparent brround ml-auto mt-0">
                                            <i class="typcn typcn-time  text-purple tx-24"></i>
                                        </div>
                                    </div> -->

                                    <!-- <div class="progress progress-sm mt-2">
                                        <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" class="progress-bar bg-purple wd-40p" role="progressbar"></div>
                                    </div>
                                     <small class="mb-0  text-muted">last Updated<span class="float-right text-muted"><?php echo $role['app_inserted']?></span></small> -->
                                <!-- </div>
                            </div>
                        </div>
                    </div> -->
                    
                    <div class="col-md-12 col-lg-12 col-xl-4 col-sm-12" style="display: none;">
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

                </div>
                <!-- Container closed -->

                <!--Sidebar-right-->
                
        <?= $footer; ?>
        
     