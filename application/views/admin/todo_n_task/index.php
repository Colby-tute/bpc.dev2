<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
        <?= $header; ?>
        <div class="container">
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">To-Do & Tasks</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/Home') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">To-Do & Tasks</li>
                    </ol>
                </nav>

            </div>
            <div class="my-auto breadcrumb-right">
                <!-- <button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-envelope mr-2"></i></span><span class="btn-text">Email </span></button>
                <button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-print mr-2"></i> </span><span class="btn-text">Print </span></button> -->
                <!-- <a class="btn btn-success mr-0" href="<?= site_url('admin/todo_n_task/Todo_n_task/add') ?> "><span class="icon-label"></span><span class="btn-text">Add </span></a> -->
            </div>
        </div>

        <div class="">
            <!-- row opened -->
            <div class="row row-sm">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-body iconfont text-left">
                            <p><?php if ($this->session->flashdata('danger')) { ?>
                                <div id="infoMessage" class="alert alert-danger mt25"><?php echo $this->session->flashdata('danger');?></div>
                                  <?php } else if ($this->session->flashdata('success')) { ?>
                                <div id="infoMessage" class="alert alert-success mt25"><?php echo $this->session->flashdata('success');?></div>
                                  <?php }?>
                            </p>
                            <div class="table-responsive">
                                 <table id="example" class="table key-buttons text-md-nowrap">
                                    <thead>
                                        <tr>
                                           <!--  <th scope="col">#</th> -->
                                            <!-- <th scope="col">Motivation Text</th> -->
                                            <th scope="col" style="width: 60%;">Tasks</th>
                                            <th scope="col" style="width: 20%;">Status</th>
                                            <th scope="col" style="width: 20%;">Date</th>
                                            <!-- <th scope="col">Apply Date</th>
                                            <th scope="">Status</th>
                                            <th scope="">Approve Date</th>
                                            <th scope="col">Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php
                                        /*$i = 1;
                                    		foreach ($view_data as $key => $value) { ?>
                                    			<tr>
                                    				<td><?php echo $i;?></td>
                                    				<!-- <td><?php echo $value->tbl_application_motivation_text;?></td> -->
                                                    <td><?php echo $value->smme_firstname.' '.$value->smme_lastname;?></td>
                                                    <td><?php echo $value->inc_firstname.' '.$value->inc_lastname;?></td>
                                                    <td><?php echo $value->bdsp_firstname.' '.$value->bdsp_lastname;?></td>
                                                    <td><?php echo $value->tbl_application_insertdate;?></td>
                                    				<td><?php echo $value->tbl_application_status;?></td>
                                    				<td><?php echo $value->tbl_application_admin_approve_date;?></td>
                                    				<td>
			                                            <a href="<?= site_url('user/smme/Application/edit/'.$value->tbl_application_id) ?>" class="text-success mr-2">
			                                                    <i class="typcn typcn-edit"></i>
			                                            </a>
			                                            <a href="<?= site_url('user/smme/Application/delete/'.$value->tbl_application_id) ?>" class="text-danger mr-2">
			                                                    <i class="typcn typcn-delete"></i>
			                                            </a>      
                                                        <button onclick="window.location.href='<?= site_url('admin/smme/Application/view/'.$value->tbl_application_id.'/'.$value->smme_id) ?>'" class="btn btn-primary button_width"><i class="la la-eye iconsetting"></i></button> 
                                                        <button class="btn btn-success button_width"><i class="la la-check iconsetting"></i></button>
                                                        <button class="btn btn-warning button_width"><i class="la la-times iconsetting"></i></button>
                                                        <button onclick="window.location.href='<?= site_url('admin/smme/Application/delete/'.$value->tbl_application_id) ?>'" class="btn btn-danger button_width"><i class="la la-trash iconsetting"></i></button>
			                                        </td>
                                    			</tr>
                                    		<?php $i++; }*/
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
    