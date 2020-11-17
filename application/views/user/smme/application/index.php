<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
        <?= $header; ?>
        <div class="container">
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">Incubation</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url('Home') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Application & Status</li>
                    </ol>
                </nav>
            </div>
            <div class="my-auto breadcrumb-right">
				<?php if(!empty($view_data))
                {
                    if($user_status == 'Declined') //view_data[0]->tbl_application_status
                    {
                    ?>
                    <a href="<?= site_url('user/smme/Application/add') ?>" class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-envelope mr-2"></i></span>Submit Application</a>
                    <?php
                    }
                }
				else
				{
				?>
				<a href="<?= site_url('user/smme/Application/add') ?>" class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-envelope mr-2"></i></span>Submit Application</a>
				<?php
				}
				?>
				
               <a href="<?= site_url('Profile/view_profile/'.$this->session->userdata('id_user')) ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Personal Details </span></button></a>
				<button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-question-circle mr-2"></i> </span><span class="btn-text">Help </span></button>
				
                
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
                                 <!--<table id="example" class="table key-buttons text-md-nowrap"> -->
<table class="table text-md-nowrap dataTable no-footer" id="example1" role="grid" aria-describedby="example1_info">
                                    <thead>
                                        <tr>
                                            <!--<th scope="col">#</th> -->
                                            <th scope="col" id="status">Incubation Status</th>
                                            <th scope="col">Incubator Name</th>
                                            <th scope="col">BDSP | Coach | Mentor</th>
                                            <th scope="col">Application Date</th>
                                            <!-- <th scope="col">Incubation Date</th>
                                            <th scope="col">BDSP Date</th> -->
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php
                                    		foreach ($view_data as $key => $value) { ?>
                                    			<tr>
                                    				<!-- <td><?php echo $value->tbl_application_id;?></td> -->
                                                    <td><?php echo $value->tbl_application_status;?></td>


                                                    <td>
														<?php 
														$this->db->join('tbl_users as user_bdsp','user_bdsp.tbl_users_id = tbl_application_assignment.incubator_id','LEFT');
														$this->db->where('app_id',$value->tbl_application_id);
														$this->db->where('incubator_id is NOT NULL', NULL, FALSE);
														$query1 = $this->db->get('tbl_application_assignment');
														$num_rows = $query1->num_rows();
														
														if($num_rows > 0)
														{
															$result_bdsp = $query1->result();
															foreach($result_bdsp as $bdsp)
															{
																echo $bdsp->tbl_users_firstname .' '. $bdsp->tbl_users_lastname.'<br />'; 
															}
														}
														else 
														{
															echo "no bdsp assigned";
														}
														//echo $incubator[0]->tbl_users_firstname .' '. $incubator[0]->tbl_users_lastname?>
														
													</td>
                                                    <td><?php 
														//echo $value->bdsp_firstname.' '.$value->bdsp_lastname;
														
														$this->db->join('tbl_users as user_bdsp','user_bdsp.tbl_users_id = tbl_application_assignment.bdsp_id','LEFT');
														$this->db->where('app_id',$value->tbl_application_id);
														$this->db->where('bdsp_id is NOT NULL', NULL, FALSE);
														$query1 = $this->db->get('tbl_application_assignment');
														$num_rows = $query1->num_rows();
														
														if($num_rows > 0)
														{
															$result_bdsp = $query1->result();
															foreach($result_bdsp as $bdsp)
															{
																echo $bdsp->tbl_users_firstname .' '. $bdsp->tbl_users_lastname.'<br />'; 
															}
														}
														else 
														{
															echo "no bdsp assigned";
														}
                                                    ?></td>
                                    				

                                                    <td><?php echo $value->tbl_application_insertdate;?></td>
                                                   <!--  <td><?php echo $value->tbl_application_incubation_date;?></td>
                                                    <td><?php echo $value->tbl_application_bdsp_date;?></td> -->
                                    				
                                    				<td>
			                                            <!-- <a href="<?= site_url('user/smme/Application/edit/'.$value->tbl_application_id) ?>" class="text-success mr-2">
			                                                    <i class="typcn typcn-edit"></i>
			                                            </a>
			                                            <a href="<?= site_url('user/smme/Application/delete/'.$value->tbl_application_id) ?>" class="text-danger mr-2">
			                                                    <i class="typcn typcn-delete"></i>
			                                            </a>       -->
														<?php if ($value->tbl_application_status == "Declined") : ?>
                                                        <button data-toggle="dropdown" class="btn btn-primary btn-block button_width"><i class="la la-cog setting"></i></button>
                                                        <div class="dropdown-menu">
                                                            <a href="<?= site_url('user/smme/Application/add') ?>" class="dropdown-item"><i class="fa fa-edit"></i> Re-submit
                                                            </a>
                                                        </div>
														<?php endif; ?>
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
