<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
        <?= $header; ?>
        <div class="container">
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">Applications</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/Home') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Incubation Application</li>
                    </ol>
                </nav>

            </div>
			<div class="my-auto breadcrumb-right">
							<a href="<?= site_url('admin/smme/Application/add') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-check-square mr-2"></i></span><span class="btn-text">Add New Application </span></button></a>
							<a href="<?= site_url('admin/Home/Profile') ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Personal Details </span></button></a>
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
                                 <table class="table text-md-nowrap dataTable no-footer" id="example1" role="grid" aria-describedby="example1_info">
                                    <thead>
                                        <tr>
                                            <th scope="col">PID</th>
                                            <!-- <th scope="col">Motivation Text</th> -->
                                            <th scope="col">MSME</th>
                                            <th scope="col">Incubator</th>
                                            <th scope="col">Bdsp | Coach | Mentor </th>
                                            <th scope="col">Application Date</th>
											<th scope="">Update Date</th>
                                            <th scope="">Status</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php
                                        $i = 1;
                                    		foreach ($view_data as $key => $value) { ?>
                                    			<tr>
                                    				<td><?php echo $i;?></td>
                                    				<!-- <td><?php echo $value->tbl_application_motivation_text;?></td> -->
                                                    <td><?php echo $value->smme_firstname.' '.$value->smme_lastname;?></td>
                                                    <td><?php echo $value->inc_firstname; ?> <!--.' '.$value->inc_lastname;?> --></td>
                                                    <td><?php echo $value->bdsp_firstname;?> <!--.' '.$value->bdsp_lastname; --></td>
                                                    <td><?php echo $value->tbl_application_insertdate;?></td>
                                    				<td><?php echo $value->tbl_application_admin_approve_date;?></td>
													<td><?php echo $value->tbl_application_status;?></td>
                                    				<td>
			                                            <!-- <a href="<?= site_url('user/smme/Application/edit/'.$value->tbl_application_id) ?>" class="text-success mr-2">
			                                                    <i class="typcn typcn-edit"></i>
			                                            </a>
			                                            <a href="<?= site_url('user/smme/Application/delete/'.$value->tbl_application_id) ?>" class="text-danger mr-2">
			                                                    <i class="typcn typcn-delete"></i>
			                                            </a>       -->
                                                        <button onclick="window.location.href='<?= site_url('admin/smme/Application/view/'.$value->tbl_application_id.'/'.$value->smme_id) ?>'" class="btn btn-primary button_width" style="padding: 3px 6px 0px 6px;" data-toggle="tooltip" data-original-title="View Application"><i class="la la-eye iconsetting"></i></button> 
                                                

                                                        <!-- <button class="btn btn-success button_width statuscheck" data-status="Approved" data-id="<?php echo $value->tbl_application_id;?>" style="padding: 3px 6px 0px 6px;" data-toggle="tooltip" data-original-title="Approve Application"><i class="la la-check iconsetting"></i></button> -->

                                                        <!-- <button class="btn btn-warning button_width statuscheck" data-id="<?php echo $value->tbl_application_id;?>" data-status="Declined" style="padding: 3px 6px 0px 6px;" data-toggle="tooltip" data-original-title="Decline Application"><i class="la la-times iconsetting"></i></button> -->

                                                        <button onclick="window.location.href='<?= site_url('admin/smme/Application/delete/'.$value->tbl_application_id) ?>'" class="btn btn-danger button_width" style="padding: 3px 6px 0px 6px;" data-toggle="tooltip" data-original-title="Delete Application"><i class="la la-trash iconsetting"></i></button>
			                                        </td>
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
            <!-- row closed -->
        </div>
    </div>
        <?= $footer; ?>
    <script type="text/javascript">
    $(document).ready(function() {
        $('.statuscheck').click(function(){
            var id = $(this).data('id');
            var status = $(this).data('status');
            //alert(id);
            //$('.view_payments').html(''); 
             var dataTable = $(".view_history_table").DataTable();
             dataTable.clear().draw();
            //alert(id);
            jQuery.ajax({
                type: "POST",
                url: "<?=base_url()?>admin/smme/Application/stats_change",
                dataType: 'text',
                data: {status:status,id:id},
                success: function(data) 
                { 
                    alert(data);
                    location.reload();
                    
                }

            });
        });
    });
</script>