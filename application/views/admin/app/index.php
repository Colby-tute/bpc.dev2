<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?= $header; ?>
    
    <div class="container">
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">Users</h4>
               <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=site_url('admin/home') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Analytics &amp; Monitoring</li>
                    </ol>
                </nav> 

            </div>
			<div class="my-auto breadcrumb-right">
							<a href="<?= site_url('admin/user/User/add') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i></span><span class="btn-text">Add User </span></button></a>
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
                            <p><?php if ($this->session->flashdata('danger')) { ?>
                                 <div id="infoMessage" class="alert alert-danger mt25"><?php echo $this->session->flashdata('danger');?></div>
                            <?php } else if ($this->session->flashdata('success')) { ?>
                                 <div id="infoMessage" class="alert alert-success mt25"><?php echo $this->session->flashdata('success');?></div>
                            <?php }
                            ?>
                            </p>
                            <div class="table-responsive">
                               <table id="example" class="table key-buttons text-md-nowrap">
                                    <thead>
                                        <tr>
                                            <th scope="col">Pid</th>
                                            <th scope="col">Unique Code</th>
                                            <th scope="col">Photo</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Mobile Number</th>
                                            <th scope="col">Gender</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        foreach($tdata as $row)
                                        { ?>
                                        <tr>
                                        <td><?php echo $row->tbl_users_id;?></td> 
                                        <td><?php echo $row->tbl_users_user_uniqueid;?></td> 
                                        <td><img src="<?php echo base_url(); ?>assets/users/<?php echo $row->tbl_users_photo;?>" style="width: 50px; height: auto;"></td>
                                        <td><?php echo $row->tbl_users_firstname." ".$row->tbl_users_lastname;?></td>  
                                        <td><?php echo $row->tbl_users_email;?></td>
                                        <td><?php echo "+".$row->tbl_users_contrycode."".$row->tbl_users_mobile;?></td>
                                        <td><?php if($row->tbl_users_gender == 'M')
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
                                        <td><?php echo $row->tbl_roles_title;?></td> 
                                        <td>
                                            <a href="<?= site_url('admin/user/User/edit/'.$row->tbl_users_id) ?>" class="text-success mr-2">
                                                    <i class="typcn typcn-edit"></i>
                                            </a>
                                            <a href="<?= site_url('admin/user/User/delete/'.$row->tbl_users_id) ?>" class="text-danger mr-2">
                                                    <i class="typcn typcn-delete"></i>
                                            </a>
                                            <a class="btn ripple btn-secondary login_view" data-target="#scrollmodal" data-toggle="modal" href="" data-id="<?php echo $row->tbl_users_id;?>">View Login Hitory</a>
                                            </a>       
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
                                            <th scope="col">User/Admin</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">IP</th>
                                            <th scope="col">Login From</th>
                                            <th scope="col">Result</th>
                                            <th scope="col">Date & Time </th>
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
                url: "<?=base_url()?>admin/user/User/login_history",
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
                        
                        dataTable.row.add([i, data.tbl_users_id+"("+data.tbl_roles_title+")", data.tbl_users_firstname+" "+data.tbl_users_lastname, data.tbl_login_history_ip, data.tbl_login_history_login_from,data.tbl_login_history_result,data.tbl_login_history_insertdate]).draw(false);
                        i++;
                    });
                    //$('.view_payments').html(html); 

                    //alert(html);
                    
                }

            });
        });
    });
</script>
    


