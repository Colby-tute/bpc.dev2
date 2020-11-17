<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?= $header; ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" rel="stylesheet">

<div class="container">

    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div>
            <h4 class="content-title mb-2"> Broadcast Messages </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= site_url('admin/Home') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Send Broadcast Messages </li>
                </ol>
            </nav>
        </div>
		
		<div class="my-auto breadcrumb-right">
            <button class="btn btn-outline-primary mr-3" data-toggle="modal" data-target="#newMessage"><span class="icon-label" ><i class="fa fa-comments mr-2"></i></span><span class="btn-text">Send Broadcast </span></button>
			<a href="<?= site_url('admin/Home/profile') ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Personal Details </span></button></a>
			<button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-question-circle mr-2"></i> </span><span class="btn-text">Help </span></button>
		</div>
		
    </div>
    <div class="">
	
			<!-- main-content opened 
			<div class="main-content horizontal-content">-->

				<!-- Container opened -->
				<div class="container">
					<!-- row -->
					<div class="row row-sm">

						<!-- Col -->
						<div class="col-lg-12">
							<div class="card">
								<div class="card-body">
									<div class="mb-4 main-content-label">Broadcast Messages List</div>
										<div class="card-body iconfont text-left">
                            <p><?php if ($this->session->flashdata('danger')) { ?>
                                 <div id="infoMessage" class="alert alert-danger mt25"><?php echo $this->session->flashdata('danger');?></div>
                            <?php } else if ($this->session->flashdata('success')) { ?>
                                 <div id="infoMessage" class="alert alert-success mt25"><?php echo $this->session->flashdata('success');?></div>
                            <?php }
                            ?>
                            </p>

							<div class="table-responsive">
                                <table class="table text-md-nowrap dataTable no-footer" id="example1" role="grid" aria-describedby="example1_info">
    								<thead>
    								<tr>
    									<tr>
                                            <th scope="col" width="10%">PID</th>
                                            <th scope="col" width="50%">Broadcast Messages List</th>
                                            <th scope="col" width="15%">Created Date</th>
                                            <th scope="col" width="15%">Expiry Date</th>
                                            <th scope="col" width="10%">Actions</th>
                                        </tr>
    								</tr>
    								</thead>
    								<tbody class="t4 main-message-list chat-scroll ps broadcast-box" id="broadcast-box">
                                     <?php   
                                        foreach($messages as $message) { ?>
                                            <tr>
                                                <td><?= $message->tbl_broadcast_id ?></td>
                                                <td><?= $message->tbl_broadcast_message ?></td>
                                                <td><?= $message->tbl_broadcast_insertdate ?></td>
                                                <td><?php if($message->tbl_broadcast_expiry != '') { ?>
                                                    <?= $message->tbl_broadcast_expiry ?>
                                                <?php }else{
                                                    echo "Not Specified";
                                                }
                                                ?></td>
                                                <td>
                                                    <span class="text-right edit" data-toggle="modal" data-target="#editMessage"  data-message="<?php echo $message->tbl_broadcast_message; ?>" data-id="<?php echo $message->tbl_broadcast_id; ?>" style="float: right;"><i class="fa fa-edit"></i></span>
                                                    <span class="text-right delete" data-id="<?php echo $message->tbl_broadcast_id; ?>" style="float: right;"><i class="fa fa-trash"> </i></span>
                                                </td>
                                            </tr>
                                        <?php } ?>
    								</tbody>
    							</table>
    						</div>


                            </div>
                            
                         </div>
									
								</div>
								
							</div>
						</div>
						<!-- /Col -->
					</div>
					<!-- row closed 
				</div>-->
				<!-- Container closed -->
			</div>
			<!-- main-content closed -->
	
	
        </div>
</div>

<?= $footer; ?>

<div class="modal fade" id="newMessage">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">New Broadcast Message</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
            <div class="modal-body">
                <div class="card mg-b-20">
                    <div class="card-body">
                        <div class="pl-0">
                            <div class="main-profile-overview">
                                
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <textarea class="form-control ckeditor" name="example-textarea-input" rows="3"  id="message" maxlength="130" placeholder="Enter Message"></textarea>
                                            <p style="padding-top: 5px;"><small>Max length 160 characters </small></p>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="form-group ">
                                    <div class="row">
                                        
                                        <div class="col-md-12">
                                            <input type="text" id="expiry" class="form-control" placeholder="Expiry Date">
                                        </div>
                                    </div>
                                </div>
                            </div><!-- main-profile-overview -->
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" id="send-message" class="btn btn-primary waves-effect waves-light">Broadcast</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editMessage">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Update Broadcast</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
            <textarea class="form-control ckeditor" name="messageText" rows="3"  id="messageText" maxlength="130" placeholder="Enter Message"></textarea>
            <p style="padding-top: 5px;"><small>Max length 160 characters </small></p>
          <input type="hidden" name="messageId" id="messageId">
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success updateMessage" data-dismiss="modal">Update</button>
        </div>
        
      </div>
    </div>
  </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
<script type="text/javascript">
    $(function() {
        $('#expiry').datetimepicker({
            format: "Y-m-d H:i",
            autoHide: true,
        });
    });

	$(document).ready(function() {
		//updateMessage();

        $('#send-message').click(function(){
        	var message = CKEDITOR.instances['message'].getData();
            if(message == ''){
                alert("Please Enter message");
                return false;
            }else{
                sendMessage(message);   
            }
        });
     });

	function sendMessage(message){
        if($("#expiry").val() == ''){
           var tbl_broadcast_expiry = null; 
        }else{
            var tbl_broadcast_expiry = $("#expiry").val();
        }
		var id = "<?= $this->session->userdata('id_admin') ?>";
        jQuery.ajax({
            type: "POST",
            url: "<?=base_url()?>admin/Broadcast/sendMessage",
            dataType: 'text',
            data: {tbl_broadcaster_id:id,tbl_broadcast_message:message,tbl_broadcast_expiry:tbl_broadcast_expiry},
            success: function(data) 
            { 
        		location.reload();
            },
            error: function(){
            	alert('Error');
            }
        });
	}

	// function updateMessage(){
	// 	var id = "<?= $this->session->userdata('id_user') ?>";
	// 	jQuery.ajax({
 //            type: "POST",
 //            url: "<?=base_url()?>incubator/Broadcast/getMessage",
 //            dataType: 'html',
 //            data: {tbl_broadcaster_id:id},
 //            success: function(data) 
 //            { 
 //            	$("#broadcast-box").html(data);
 //            	var scroller = $('#broadcast-box');
	// 		    var height = scroller[0].scrollHeight - $(scroller).height()+100;
	// 		    $(scroller).stop().animate({ scrollTop: height }, "slow");
 //                $("#message").val('');
 //            	$("#expiry").val('');
 //            },
 //            error: function(){
 //            	alert('Error');
 //            }
 //        });
	// }

    $(".updateMessage").click(function(){
         var message = CKEDITOR.instances['messageText'].getData();
        var id = $("#messageId").val();
        // if($("#expiry").val() == ''){
        //    var tbl_broadcast_expiry = null; 
        // }else{
        //     var tbl_broadcast_expiry = $("#expiry").val();
        // }
        jQuery.ajax({
            type: "POST",
            url: "<?=base_url()?>admin/Broadcast/updateMessage",
            dataType: 'text',
            data: {tbl_broadcast_id:id,tbl_broadcast_message:message},
            success: function(data) 
            { 
                if(data == true){
                    alert('Message Updated Successfully.');
                    location.reload();
                }else{

                    alert('Something went wrong. Please try again!');
                }
            },
            error: function(){
                alert('Error');
            }
        });
    });

    $("body").delegate('.edit','click', function(){
        var id = $(this).data('id');
        var message = $(this).data('message');
        $("#messageId").val(id);
        CKEDITOR.instances['messageText'].setData(message);
    });

    $("body").delegate('.delete','click', function(){
        var id = $(this).data('id');
        if(confirm('Are you sure want to delete this message?') == true){
            jQuery.ajax({
                type: "POST",
                url: "<?=base_url()?>admin/Broadcast/deleteMessage",
                dataType: 'json',
                data: {tbl_broadcast_id:id},
                success: function(data) 
                { 
                    if(data == true){
                        alert('Message Deleted Successfully.');
                        location.reload();
                    }else{
                        alert('Something went wring. please try again!');
                    }
                },
                error: function(){
                    alert('Error');
                }
            });
        }else{
            return false;
        }
    });
</script>
<style type="text/css">
    .edit, .delete{
        padding: 0 10px;
        color: #000;
    }
    .edit:hover, .delete:hover{
        padding: 0 10px;
        color: blue;
    }
    .ui-datepicker, .xdsoft_datetimepicker {
      z-index: 22222222222 !important; /* has to be larger than 1050 */
    }
</style>