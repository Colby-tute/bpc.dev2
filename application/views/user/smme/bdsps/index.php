<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?= $header; ?>
    
    <div class="container">
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">Operations</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url('Home') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">BDSP, Coaches or Mentors</li>
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
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-body iconfont text-left">
                            <p><?php if ($this->session->flashdata('danger')) { ?>
                                 <div id="infoMessage" class="alert alert-danger mt25"><?php echo $this->session->flashdata('danger');?></div>
                            <?php } else if ($this->session->flashdata('success')) { ?>
                                 <div id="infoMessage" class="alert alert-success mt25"><?php echo $this->session->flashdata('success');?></div>
                            <?php }
                            ?>
                            </p>
                            <div class="table-responsive">
                               <!-- <table id="example" class="table key-buttons text-md-nowrap"> -->
							   <table class="table text-md-nowrap dataTable no-footer" id="example1" role="grid" aria-describedby="example1_info">
                                    <thead>
                                        <tr>
                                            <th scope="col">PID</th>
                                            <th scope="col">Reference </th>
                                            <th scope="col">Full Name</th>
                                            <th scope="col">Email Address</th>
                                            <th scope="col">Mobile Number</th>
											 <th scope="col">Business Industry</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
										$i=1;
										if(!empty($businessdata)){
										 foreach($businessdata as $row2){
											 $business[$i]=$row2->tbl_industry_name;
											 $i++;
											
										 }
										}else{
											$business[$i]="";
										}
										 $j=1;
                                        foreach($tdata as $row)
                                        { ?>
                                        <tr>
                                        <td><?php echo $row->tbl_users_id;?></td> 
                                        <td>BDSP-<?php echo $row->tbl_users_user_uniqueid;?></td> 
                                        <td><?php echo $row->tbl_users_firstname." ".$row->tbl_users_lastname;?></td>  
                                        <td><?php echo $row->tbl_users_email;?></td>
                                        <?php
                                        $exp = explode('-',$row->tbl_users_contrycode);
                                        ?>
                                        <td><?php echo '+'.$exp[1].'-'.$row->tbl_users_mobile;?></td>
										<td><?php echo $business[$j]; $j=$j+1;?></td>
										
										 <td>
										<button data-toggle="dropdown"
													class="btn btn-primary btn-block button_width"><i
														class="la la-cog setting"></i></button>
											<div class="dropdown-menu">
											                                              
											     <a href="<?= site_url('user/smme/Bdsp/view/'.$row->tbl_users_id) ?>" class="dropdown-item"> <i class="fa fa-eye"></i> View
                                                </a>
												
												<a href="<?= site_url('user/smme/Evaluations') ?>" class="dropdown-item"><i class="fa fa-check-square"></i> Evaluate
                                                </a> 
												<!-- <a href="<?= site_url('user/smme/Bdsp/evaluate/'.$row->tbl_users_id) ?>" class="dropdown-item"> <i class="fa fa-eye"></i> Evaluate
                                                </a> -->
												
												 <a style="curson:pointer; padding-left:15px;" class="btn  feedback" data-target="#modaldemo1" data-toggle="modal" data-id="<?php echo $row->tbl_users_user_uniqueid;?>"><i class="fa fa-comment"></i> Feedback</a>
												</div>
											  </td>
                                       
                                        </tr>
                                        <?php
                                        } 
                                        ?>
                                    </tbody>
                               </table>
                            </div>
                         </div>

                        <div class="modal" id="modaldemo1">
                            <div class="modal-dialog modal_small" role="document">
                                <div class="modal-content modal-content-demo">
                                <?php echo admin_form_open("user/smme/Bdsp/feedback", 'class="login" data-toggle="validator"'); ?>
                                    <div class="modal-header">
                                        <h6 class="modal-title">Feedback</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body feedback_user_id">
                                        <input type="hidden" name="user_unique_id" id="user_unique_id">
                                        <label for="subject">Subject*</label>
                                        <input type="text" name="subject" id="subject" class="form-control">
                                        <label for="bdsp_feedback">Please give your feedback*</label>
                                        <textarea id="bdsp_feedback" name="bdsp_feedback" class="form-control ckeditor" rows="7" required=""></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn ripple btn-primary" type="submit">Save</button>
                                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
                                    </div>
                                <?php echo form_close(); ?>
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
    $('.feedback').click(function(){
        var id = $(this).data('id');
        //alert(id);
        $('.feedback_user_id #user_unique_id').val(id);
    });
</script>

