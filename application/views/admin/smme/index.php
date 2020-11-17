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
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/home') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">MSME Management</li>
                    </ol>
                </nav>

            </div>
            <div class="my-auto breadcrumb-right">
							<a href="<?= site_url('admin/smme/smme/add') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i></span><span class="btn-text">Create MSME Profile </span></button></a>
							<a href="<?= site_url('admin/incubators/Incubators/bbm') ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-tasks mr-2"></i> </span><span class="btn-text">BBM % Progress </span></button></a>
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
                                            <th scope="col">Reference</th>
                                            <!-- <th scope="col">Photo</th> -->
                                            <th scope="col">Full Name</th>
                                            <th scope="col">Email Address</th>
                                            <th scope="col">Mobile Number</th>
                                            <th scope="col">Incubation Status</th>
											<th scope="col">Rights</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        foreach($tdata as $row)
                                        { ?>
                                        <tr>
                                        <td><?php echo $row->tbl_users_id;?></td> 
                                        <td>MSME-<?php echo $row->tbl_users_user_uniqueid;?></td> 
                                        <!-- <td><img src="<?php echo base_url(); ?>assets/users/<?php echo $row->tbl_users_photo;?>" style="width: 50px; height: auto;"></td> -->
                                        <td><?php echo $row->tbl_users_firstname." ".$row->tbl_users_lastname;?></td>  
                                        <td><?php echo $row->tbl_users_email;?></td>
                                         <?php
                                        //print_r($row->tbl_users_contrycode);
                                        if ($row->tbl_users_mobile != '') {
                                            if ($row->tbl_users_contrycode != '') {
                                                $exp = explode('-',$row->tbl_users_contrycode);
                                                /*print_r($exp);*/
                                                $code = $exp[1];
                                            }
                                            else{
                                                $code = '';
                                            }
                                            
                                            $mobile = '+'.$code.''.$row->tbl_users_mobile;
                                        }else{
                                            $mobile = '';
                                        }
                                        ?>
                                        <td><?php echo $mobile;?></td>
                                        <!-- <td><?php if($row->tbl_users_gender == 'M')
                                        {
                                            echo "Male";

                                        }else if($row->tbl_users_gender == 'F')
                                        {
                                            echo "Female";

                                        }
                                        else
                                        {
                                            echo "Other";

                                        }?></td>
                                        <td><?php echo $row->tbl_roles_title;?></td>  -->
										<td>
											<select disabled name="stage" id="stage" class="form-control stage" data-user="<?= $row->tbl_users_id ?>">
												<?php foreach ($stages as $stage){
													echo "<option ".($row->tbl_users_status == $stage->id ? "selected" : "")." value='{$stage->id}'>{$stage->stage}</option>";
												}; ?>
											</select>
										</td>
										<td>
											<?php
											$roles = [
												2 => 'MSME',
												4 => 'BDSP',
												3 => 'INCUBATOR',
											];
											?>
											<select name="role" id="roles" class="form-control roles" data-user="<?= $row->tbl_users_id ?>">
												<?php foreach ($roles as $key => $role){
													echo "<option ".($row->tbl_users_role_id == $key ? "selected" : "")." value='{$key}'>{$role}</option>";
												}; ?>
											</select>
										</td>
                                        <td>
                                            <!-- <a href="<?= site_url('admin/smme/Smme/edit/'.$row->tbl_users_id) ?>" class="text-success mr-2">
                                                    <i class="typcn typcn-edit"></i>
                                            </a>
                                            <a href="<?= site_url('admin/smme/Smme/delete/'.$row->tbl_users_id) ?>" class="text-danger mr-2">
                                                    <i class="typcn typcn-delete"></i>
                                            </a>
                                            <a class="text-secondary login_view" data-target="#scrollmodal" data-toggle="modal" href="" data-id="<?php echo $row->tbl_users_id;?>"><i class="far fa-clock"></i></a> -->
                                            <!--<button onclick="window.location.href='<?= site_url('admin/smme/Smme/viewdetails/'.$row->tbl_users_id) ?>'" class="btn btn-primary button_width" style="padding: 3px 6px 0px 6px;" data-toggle="tooltip" data-original-title="View SMME">view</button> --> 
                                                
											<button data-toggle="dropdown" class="btn btn-primary btn-block button_width"><i class="la la-cog setting"></i></button>
                                            <div class="dropdown-menu">
                                                <a href="<?= site_url('admin/smme/Smme/viewdetails/'.$row->tbl_users_id) ?>" class="dropdown-item"> <i class="fa fa-eye"></i> View
                                                </a>
												
												<a href="<?= site_url('admin/smme/Smme/edit/'.$row->tbl_users_id) ?>" class="dropdown-item"> <i class="fa fa-edit"></i> Edit 
                                                </a>
                                                <a href="<?= site_url('admin/smme/Smme/createTask/' . $row->tbl_users_id) ?>"
                                                   class="dropdown-item"><i class="fa fa-plus-square"></i> Boards
                                                </a>
                                                <!-- <a href="<?= site_url('admin/smme/Smme/' . $row->tbl_users_id) ?>"
                                                   class="dropdown-item"><i class="fa fa-calendar-plus"></i> Create Milestone
                                                </a> -->

                                                <!--<a href="<?= site_url('admin/smme/Smme/createMilestoneTask/' . $row->tbl_users_id) ?>"
                                                   class="dropdown-item"><i class="fa fa-calendar-plus"></i> Create Milestone Task
                                                </a>-->


                                                <a href="<?= site_url('admin/smme/Smme/handleMilestoneQuestions/' . $row->tbl_users_id) ?>"
                                                   class="dropdown-item"><i class="fa fa-calendar-plus"></i> Milestones
                                                </a>
                                                <a href="<?= site_url('admin/smme/Smme/viewFunds/' . $row->tbl_users_id) ?>"
                                                   class="dropdown-item"><i class="fa fa-dollar-sign"></i> Funds
                                                </a>
                                                <a href="#" class="dropdown-item delete-smme" data-id="<?= $row->tbl_users_id ?>"><i class="fa fa-trash"></i> Delete
                                                </a>
                                                <a class="dropdown-item login_view" data-target="#scrollmodal" data-toggle="modal" href="" data-id="<?php echo $row->tbl_users_id;?>"><i class="fa fa-unlock-alt"></i> Activities</a>
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
                        <div class="modal history" id="scrollmodal">
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <div class="modal-content modal-content-demo">
                                    <div class="modal-header">
                                        <h6 class="modal-title">Login History</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <table id="example" class="table key-buttons text-md-nowrap view_history_table">
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
                                    </tbody>
                                    </table>
                                    </div>
                                    <div class="modal-footer">
                                        <!-- <button class="btn ripple btn-primary" type="button">Save changes</button> -->
                                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
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
    $(document).ready(function() {
        $('.login_view').click(function(){
            var id = $(this).data('id');
            //alert(id);
            //$('.view_payments').html(''); 
             var dataTable = $(".view_history_table").DataTable();
             dataTable.clear().draw();
            //alert(id);
            jQuery.ajax({
                type: "POST",
                url: "<?=base_url()?>admin/smme/Smme/login_history",
                dataType: 'text',
                data: {user_id:id},
                success: function(data) 
                { 
                    var obj = jQuery.parseJSON(data);
                    var subcat_data = obj;
                    console.log(subcat_data);
                    //view_payment_table
                    
                    var html = '';
                    var i = 1;
                    $.each(subcat_data,function(index,data)
                    {
                        
                        dataTable.row.add([i, data.tbl_login_history_ip, data.tbl_login_history_login_from,data.tbl_login_history_result,data.tbl_login_history_insertdate]).draw(false);
                        i++;
                    });
                    //$('.view_payments').html(html); 

                    //alert(html);
                    
                }

            });
        });
    });
</script>
<script>
	$(function () {
		$(".stage").on("change", function () {
			$.ajax({
				method: "POST",
				url: '<?= base_url() ?>admin/smme/Smme/changeStatus',
				data: {
					id: $(this).data('user'),
					status: $(this).val(),
				}
			})
            .done(function(res) {
                alert("Status successfully changed!")
            })
		})
		$(".roles").on("change", function () {
			$.ajax({
				method: "POST",
				url: '<?= base_url() ?>admin/smme/Smme/changeRights',
				data: {
					id: $(this).data('user'),
					role: $(this).val(),
				}
			})
            .done(function(res) {
                alert("The current role has been successfully changed!")
            })
		})

        $(".delete-smme").on("click", function (event) {
            let conf = confirm("Are you sure you want to delete this MSME?")
            if (!conf) {
                event.preventDefault()
                return false
            }

            location.href = '<?= site_url('admin/smme/Smme/delete/') ?>' + $(this).data('id')
        })
	})
</script>
