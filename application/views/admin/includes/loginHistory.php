<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<div class="modal history" id="scrollmodal">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Login History</h6>
            </div>
            <div class="modal-body">
                <table class="table key-buttons text-md-nowrap view_history_table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>IP</th>
                            <th>Login Form</th>
                            <th>Result</th>
                            <th>Date & Time</th>
                        </tr>
                    </thead>
                    <tbody>  
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
       $('.login_view').click(function(){
           var id = $(this).data('id');
           var dataTable= $(".view_history_table").DataTable();
           dataTable.clear().draw();
           
           jQuery.ajax({
               type: "POST",
               url: "<?= base_url()?>admin/smme/Smme/login_history",
               dataType: 'text',
               data: {user_id:id},
               
               success: function(data){
                   var obj = jQuery.parseJSON(data);
                   var subcat_data = obj;
                   console.log(subcat_data);
                   
                   var html='';
                   var i = 1;
                   $.each(subcat_data, function(index, data){
                       dataTable.row.add([i, data.tbl_login_history_ip, data.tbl_login_history_from, data.tbl_login_history_result, data.tbl_login_history_insertdate]).draw(false);
                   });
               }
           });
       }); 
    });
</script>