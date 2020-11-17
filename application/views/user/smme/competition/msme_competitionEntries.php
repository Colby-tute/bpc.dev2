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
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Settings</li>
                    </ol>
                </nav>

            </div>
			<div class="my-auto breadcrumb-right">
                            <a href="<?= site_url('msme/comp/create')?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-check-square mr-2"></i></span><span class="btn-text">Create Competitions</span></button></a>
							
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
                                            <th scope="col">Competition Name</th>
                                            <th scope="col">Competition Description</th>
                                            <th scope="col">Start Date</th>
                                            <th scope="col">End Date</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                         <?php foreach ($incData as $rows){ ?>
                                    	<tr id="<?php echo $rows->tbl_competitions_id ; ?>">
                                                    <td><?= $rows->tbl_competitions_id ?></td>
                                                    <td>COMP-<?= $rows->tbl_competitions_unique_id ?></td>
                                                    <td><?= $rows->tbl_competitions_name ?></td>
                                                    <td><?= $rows->tbl_competitions_description?></td>
                                                     <td><?= $rows->tbl_competitions_starting_date ?></td>
                                                     <td><?= $rows->tbl_competitions_end_date ?></td>
                                                      
                                                      
                                                    <td>
                                                        <button data-toggle="dropdown" class="btn btn-primary btn-block button_width">
                                                            <i class="la la-cog setting"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a href="<?= site_url('inc/comp/edit/' .$rows->tbl_competitions_id )?>" class="dropdown-item editcomp"><i class="la la-edit"></i> Edit</a>
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
                   <?= $hist?>            
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
               url: '<?= site_url('inc/comp/del/')?>'+ id,
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
               url: '<?= site_url('admin/comp/edit/')?>'+ id,
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

