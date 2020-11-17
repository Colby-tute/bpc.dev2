<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
        <?= $header; ?>
        <div class="container">
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">Application</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url('Home') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Incubation Status</li>
                    </ol>
                </nav>

            </div>
            <div class="my-auto breadcrumb-right">
                <!-- <button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-envelope mr-2"></i></span><span class="btn-text">Email </span></button>
                <button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-print mr-2"></i> </span><span class="btn-text">Print </span></button> -->
                <?php if(!empty($view_data))
                {
                    if($view_data[0]->tbl_application_status == 'Declin')
                    {
                    ?>
                    
                    <?php
                    }
                }?>
           
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
                                           
                                            <th scope="col">Incubator</th>
                                            <th scope="col">Coache / Mentor</th>
                                            <th scope="col">Application Date</th>
                                        
                                      
                                            <th scope="col" id="status">Application Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php
                                    		foreach ($view_data as $key => $value) { ?>
                                    			<tr>
                                    			<!--	<td><?php echo $value->tbl_application_id;?></td> -->
                                                    <td><?php echo $value->inc_firstname.' '.$value->inc_lastname;?></td>
                                                    <td><?php echo $value->bdsp_firstname.' '.$value->bdsp_lastname;?></td>
                                    				<td><?php echo $value->tbl_application_insertdate;?></td>
                                                   <!--  <td><?php echo $value->tbl_application_incubation_date;?></td>
                                                    <td><?php echo $value->tbl_application_bdsp_date;?></td> -->
                                    				<td><span class="badge badge-info"><?php echo $value->tbl_application_status;?></span></td>
                                    				<td>
			                                            <!-- <a href="<?= site_url('user/smme/Application/edit/'.$value->tbl_application_id) ?>" class="text-success mr-2">
			                                                    <i class="typcn typcn-edit"></i>
			                                            </a>
			                                            <a href="<?= site_url('user/smme/Application/delete/'.$value->tbl_application_id) ?>" class="text-danger mr-2">
			                                                    <i class="typcn typcn-delete"></i>
			                                            </a>       --> 
                                                        <button data-toggle="dropdown" class="btn btn-primary btn-block button_width"><i class="la la-cog setting"></i></button>
                                                        <div class="dropdown-menu">
                                                            <a href="<?= site_url('user/smme/Application/edit/'.$value->tbl_application_id) ?>" class="dropdown-item">Edit
                                                            </a>
                                                            <a href="<?= site_url('user/smme/Application/delete/'.$value->tbl_application_id) ?>" class="dropdown-item">Delete
                                                            </a>
                                                        </div>
			                                        </td>
                                    			</tr>
                                    		<?php }
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
    
