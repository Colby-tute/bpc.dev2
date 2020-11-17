<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
        <?= $header; ?>
        <div class="container">
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">Assign Packages</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/Home') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Assign Packages</li>
                    </ol>
                </nav>

            </div>
			<div class="my-auto breadcrumb-right">
                            <a href="<?= site_url('package/entry') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-check-square mr-2"></i></span><span class="btn-text">Back</span></button></a>
							
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
                                            <th scope="col">REFERENCE</th>
                                            <th scope="col">FULLNAME</th>
                                            <th scope="col">CONTACT</th>
                                            <th scope="col">EMAIL</th>
                                            <th scope="">ASSIGN PACKAGE</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php foreach($pack as $row){
                                         if($row->tbl_packages_name == NULL){
                                             $packName = "Not Assign";
                                         }else{
                                             $packName = $row->tbl_packages_name;
                                         }?>
                                    	<tr>
                                                    <td><?= $row->tbl_users_id?></td>
                                                    <td>INC-<?= $row->tbl_users_user_uniqueid?></td>
                                                    <td><?= $row->tbl_users_firstname?>  <?= $row->tbl_users_lastname?></td>
                                                    <td><?= $row->tbl_users_mobile?></td>
                                                    <td><?= $row->tbl_users_email?></td>
                                                    <td>
                                                        <form method="POST" accept-charset="utf-8" action="<?= site_url('package/assign/up/'.$row->tbl_users_id)?>">
                                                            <select name="packageType" class="form-control roles" data-user="<?= $row->tbl_users_id?>" onchange="this.form.submit()">
                                                                <option  value="<?= $row->tbl_packages_id?>" selected> <?= $packName?></option>
                                                                <?php foreach($packList as $val){ 
                                                                    if($packName == $val->tbl_packages_name){
                                                                        continue;
                                                                    }else{
                                                                        $packlist = $val->tbl_packages_name;
                                                                    }?>
                                                                <option value="<?= $val->tbl_packages_id;?>"><?= $packlist?></option> <?php }?>
                                                            </select>
                                                        </form>
                                                    </td>
                                                    <td>
			                                      
                                                        <button onclick="window.location.href='<?= site_url('admin/smme/Application/view/') ?>'" class="btn btn-primary button_width" style="padding: 3px 6px 0px 6px;" data-toggle="tooltip" data-original-title="View Application"><i class="la la-eye iconsetting"></i></button> 
                                                        <button onclick="window.location.href='<?= site_url('admin/smme/Application/delete/') ?>'" class="btn btn-danger button_width" style="padding: 3px 6px 0px 6px;" data-toggle="tooltip" data-original-title="Delete Application"><i class="la la-trash iconsetting"></i></button>
			                            </td>
                                    	</tr>
                                                            <?php }?>
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
