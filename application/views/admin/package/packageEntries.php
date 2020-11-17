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
                            <a href="<?= site_url('package/create') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-check-square mr-2"></i></span><span class="btn-text">Create Subscription Package</span></button></a>
							
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
                                            <th scope="col">Reference</th>
                                            <th scope="col">Package Name</th>
                                            <th scope="col">Total Assigned User</th>
                                            <th scope="col">Total Competitor</th>
                                            <th scope="col">Total Competition</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                         <?php 
                                           // $count = 0;
                                            foreach ($pack as $rows){ 
                                                $count = 0;
                                                $compet = 0;
                                                $comp = 0;
                                                 foreach ($assign as $total){
                                                     if($rows->tbl_packages_id == $total->tbl_packages_id){
                                                         $count ++;
                                                     }else{ 
                                                         continue;
                                                     }
                                                 }
                                                foreach ($totalC as $total2){
                                                    if($rows->tbl_packages_id == $total2->tbl_packages_id){
                                                         $comp ++;
                                                     }else{ 
                                                         continue;
                                                     }
                                                }
                                                foreach ($competitor as $com){
                                                    if($rows->tbl_packages_id == $com->tbl_packages_id){
                                                         $compet ++;
                                                     }else{ 
                                                         continue;
                                                     }
                                                }
                                             
                                             ?>
                                    	<tr id="<?php echo $rows->tbl_packages_id  ; ?>">
                                                    <td><?= $rows->tbl_packages_id  ?></td>
                                                    <td>PACK-<?= $rows->tbl_packages_unique_code ?></td>
                                                    <td><?= $rows->tbl_packages_name ?></td>
                                                    
                                                    <td><?= $count ?></td>
                                                     <td><?= $compet ?></td>
                                                     <td><?= $comp ?></td>
                                                      
                                                      
                                                    <td>
                                                        <button data-toggle="dropdown" class="btn btn-primary btn-block button_width">
                                                            <i class="la la-cog setting"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a  href="<?= site_url('package/edit/' .$rows->tbl_packages_id )?>"  class="dropdown-item editcomp"><i class="la la-edit"></i> Edit</a>
                                                            <a class="dropdown-item remove"><i class="fa fa-trash-alt"></i> Delete</a>
                                                            
                                                        </div>
                                                        
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
<script type="text/javascript">
    $(".remove").click(function(){
        var id = $(this).parents("tr").attr("id");


        if(confirm('Are you sure to remove this record ?'))
        {
            $.ajax({
               url: '<?= site_url('package/delete/')?>'+ id,
               type: 'DELETE',
               error: function() {
                  alert('Something is wrong');
               },
               success: function(data) {
                    $("#"+id).remove();
                    alert(data);  
               }
            });
        }
       
        
    });
    


</script>
<script>    
     $("#edit").click(function(){
        var id = $(this).parents("tr").attr("id");


        if(confirm('Are you sure to edit this record ?'))
        {
            $.ajax({
               url: '<?= site_url('package/delete/')?>'+ id,
               type: 'DELETE',
               error: function() {
                  alert('Something is wrong');
               },
               success: function(data) {
                   // $("#"+id).remove();
                    alert(data);  
               }
            )};
        }
    });
</script>
