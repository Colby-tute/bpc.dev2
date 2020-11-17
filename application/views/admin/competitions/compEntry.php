<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
        <?= $header; ?>
        <div class="container">
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">Settings</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/Home') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Settings</li>
                    </ol>
                </nav>

            </div>
			<div class="my-auto breadcrumb-right">
                            <a href="<?= site_url('admin/comp/create') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-check-square mr-2"></i></span><span class="btn-text">Create Competitions</span></button></a>
							
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
                                            <th scope="col">Reference</th>
                                            <th scope="col">Registered E-mail</th>
                                            <th scope="col">Business / Contact Name</th>
                                            <th scope="col">Registered Date</th>
                                            <th scope="col">Entry Status</th>
                                            <th scope="col">Score</th>
                                            
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                         <?php foreach ($comp as $rows){ ?>
                                    	<tr>
                                                    <td><?= $rows->tbl_competitions_id ?></td>
                                                    <td><?= $rows->tbl_competitions_unique_id ?></td>
                                                    <td></td>
                                                    <td><?= $rows->tbl_competitions_entry_num ?></td>
                                                     <td><?= $rows->tbl_competitions_starting_date ?></td>
                                                      <td></td>
                                                      
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
