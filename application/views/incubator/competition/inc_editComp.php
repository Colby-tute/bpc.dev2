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
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>

            </div>
			<div class="my-auto breadcrumb-right">
                            <a href="<?= site_url('inc/competition')?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-check-square mr-2"></i></span><span class="btn-text">Back</span></button></a>
							
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
                                <?php echo form_open('inc/comp/up')?>
                                <?php foreach ($comp as $rows){?>
                               <div class="row">
                                    <div class="col-md-12">
                                        <div>
                                            <input type="hidden" name="id" value="<?= $rows->tbl_competitions_id ?>"/> 
                                        </div>

                                       <div class="col-md-4 form-group mb-3 float-lg-left">
                                           <label>Competition Name*</label>
                                           <input name="compName" type="text" value="<?= $rows->tbl_competitions_name ?>" class="form-control"/>
                                       </div>
                                       <div class="col-md-4 form-group mb-3 float-lg-right">
                                           <label>Number of qualifying entries*</label>
                                           <input name="nEnty" type="number" value="<?= $rows->tbl_competitions_entry_num?>" class="form-control"/>
                                       </div>
                                       <div class="col-md-4 form-group mb-8 float-lg-right">
                                           <label>Submission Start Date:*</label>
                                           <input type="date" value="<?= $rows->tbl_competitions_starting_date ?>" name="ssd" class="form-control"/>
                                       </div>

                                       <div class="col-md-4 form-group mb-3 float-lg-left">
                                           <label>Submission End Date*</label>
                                           <input name="sed" value="<?= $rows->tbl_competitions_end_date ?>" type="date" class="form-control"/>
                                       </div>
                                        <div class="col-md-4 form-group mb-3 float-lg-left">
                                           <label>Pre-screening End Date*</label>
                                           <input  name="psed" type="date" value="<?= $rows->pre_screeningenddate ?>"  class="form-control" />
                                       </div>
                                        <div class="col-md-4 form-group mb-3 float-lg-left">
                                           <label>Final Selection End Date*</label>
                                           <input  name="fsed" type="date" value="<?= $rows->finalselectionenddate ?>"  class="form-control" />
                                       </div>
                                       <div class="col-md-4 form-group mb-3 float-lg-left">
                                           <label>Selection Criteria*</label>
                                           <textarea  name = "selectCr" class="form-control" >
                                              <?= $rows->tbl_competitions_criteria?>
                                           </textarea><br>
                                       </div>
                                        <div class="col-md-4 form-group mb-3 float-lg-left">
                                           <label>Prizes to be Won*</label>
                                           <textarea  name = "prize" class="form-control" >
                                              <?= $rows->tbl_competitions_prize?>
                                           </textarea><br>
                                       </div>
                                       <div class="col-md-4 form-group mb-3 float-lg-right">
                                           <label>Competion Description*</label>
                                           <textarea  name = "description" class="form-control" >
                                              <?= $rows->tbl_competitions_description?>
                                           </textarea><br>
                                       </div>
                                       <div></div>

                                       <div class="col-md-4 form-group mb-3">
                                           <input type="submit" value="Update Competitions" class="btn btn-primary sub"/>
                                       </div>

                                   </div>
                               </div>
                                <?php } echo form_close();?>

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
