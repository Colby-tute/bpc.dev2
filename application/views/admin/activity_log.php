<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
   <?= $header; ?>
        <div class="container">
                    <div class="breadcrumb-header justify-content-between">
                        <div>
                            <h4 class="content-title mb-2">Activity Log</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= site_url('admin/home') ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Activity Log</li>
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
                                        <div class="table-responsive">
                                           <table id="example" class="table key-buttons text-md-nowrap">
                                                <thead>
                                                    <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">IP</th>
                                                    <th scope="col">Login From</th>
                                                    <th scope="col">Result</th>
                                                    <th scope="col">Date & Time</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                    $i =1;
                                                    foreach($tdata as $row)
                                                    { ?>
                                                    <tr>
                                                    <td><?php echo $i;?></td> 
                                                    <td><?php echo $row->tbl_login_history_ip;?></td>
                                                    <td><?php echo $row->tbl_login_history_login_from;?></td> 
                                                    <td><?php echo $row->tbl_login_history_result;?></td> 
                                                    <td><?php echo $row->tbl_login_history_insertdate;?></td>                                                  
                                                    </tr>
                                                    <?php
                                                    $i++;
                                                    } 
                                                    ?>
                                                </tbody>
                                           </table>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- row closed -->
                    </div>
        </div>
        <?= $footer; ?>