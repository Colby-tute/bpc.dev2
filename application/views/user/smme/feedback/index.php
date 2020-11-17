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
                        <li class="breadcrumb-item"><a href="<?= site_url('Home') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Feedback</li>
                    </ol>
                </nav>

            </div>
             <div class="my-auto breadcrumb-right">
							<a href="<?=site_url('user/smme/Application') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-bell mr-2"></i></span><span class="btn-text">Status </span></button></a>
							<a href="<?= site_url('Profile/view_profile/'.$this->session->userdata('id_user')) ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Personal Details </span></button></a>
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
                                 <!--<table id="example" class="table key-buttons text-md-nowrap"> -->
                                   <table class="table text-md-nowrap dataTable no-footer" id="example1" role="grid" aria-describedby="example1_info">
                                    <thead>
                                        <tr>
                                            <th scope="col">Feed #</th>
                                            <th scope="col">Addressee</th>
                                            <th scope="col">Created  Date</th>
                                            <th scope="col">Feedback Subject</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id='feedback_table_body'>
                                        <?php
                                        foreach ($feedback as $key => $value) { ?>
                                            <tr>
                                                <td><?php echo $value->tbl_feedback_id;?></td>
                                                <td><?php echo $value->tbl_users_firstname.' '.$value->tbl_users_lastname;?></td>
                                                <?php $date = Date('j-m-Y H:i',strtotime($value->tbl_feedback_insertdate));
                                                    ?>
                                                <td><?php echo $date;?></td>
                                                <td><?php echo $value->tbl_feedback_subject;?></td>
                                                <td><?php echo $value->tbl_roles_title;?></td>
                                                <td>
                                                    <a href="javascript:void(0)" data-target="#modaldemo1" data-toggle="modal" data-id="<?php echo $value->tbl_feedback_id;?>" class="feedback" class="btn btn-success btn-block btn_width feedback"><i class="far fa-eye"style="decoration:none; padding-right:10px;"></i></a>
                                                    
																								
													<i class="fa fa-trash" onclick="deleteFeedBack(<?php echo $value->tbl_feedback_id;?>)"></i>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                         </div>
                         <div class="modal" id="modaldemo1">
                            <div class="modal-dialog modal_small" role="document">
                                <div class="modal-content modal-content-demo">
                                <!-- <?php echo admin_form_open("user/smme/Bdsp/feedback", 'class="login" data-toggle="validator"'); ?> -->
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="feedbackdetail">Feedback Details</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body feedback_user_id" style="height: 400px;overflow-y: auto;">
                                        <input type="hidden" name="user_unique_id" id="user_unique_id">
                                         <label for="subject">Subject</label>
                                        <textarea readonly id="subject" class="form-control ckeditor"></textarea> 
                                        <label for="bdsp_feedback">Your feedback</label>
                                        <textarea readonly id="bdsp_feedback" class="form-control ckeditor"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <!-- <button class="btn ripple btn-primary" type="submit">Save</button> -->
                                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
                                    </div>
                               <!--  <?php echo form_close(); ?> -->
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
        $('.feedback').click(function(){
            var id = $(this).data('id');
            // alert(id);
            //$('.feedback_user_id #user_unique_id').val(id);
            jQuery.ajax({
                type: "POST",
                url: "<?=base_url()?>user/smme/Feedback/get_feedback",
                dataType: 'text',
                data: {id:id},
                success: function(data) 
                {
                    console.log(data);
                    var obj = JSON.parse(data);
                    console.log(obj);
                    $('#subject').html(obj[0].tbl_feedback_subject);
                    $('.feedback_user_id #bdsp_feedback').html(obj[0].tbl_feedback_feedback);
                  
                }
            });
            
        });

        function deleteFeedBack(id) {
            // alert("hi praveen");
            $.ajax({
                method: "post",
                url: '<?= base_url()?>user/smme/Feedback/delete_feedback',
                data: {
                    feedb_id: id
                },
                success: function(data) {
                    get_all_feedback();
                }
            })
        }

        function get_all_feedback() {
            $.ajax({
                method: "post",
                url: "<?= base_url()?>user/smme/Feedback/get_all_feedback",
                success: function(data) {
                    load_feedback(data)
                }
            })
        }

        function load_feedback(feedback_data) {
            var feedbacks = JSON.parse(feedback_data)["feedback"]
            feedback_table_body = "";
            if (feedbacks.length) {
                for(var idx=0; idx < feedbacks.length; idx++) {
                    var feedback = feedbacks[idx];
                    feedback_table_body+= "<tr>" +
                                            "<td>" + feedback['tbl_feedback_id'] + "</td>" +
                                            "<td>" + feedback['tbl_users_firstname'] + " "+ feedback['tbl_users_lastname'] + "</td>" +
                                            "<td>" + feedback['tbl_feedback_insertdate'] + "</td>" +
                                            "<td>" + feedback['tbl_feedback_subject'] + "</td>" + 
                                            "<td>" + feedback['tbl_roles_title'] + "</td>" +
                                            '<td><a href="javascript:void(0)" data-target="#modaldemo1" data-toggle="modal" data-id="' + feedback['tbl_feedback_id']+ '" class="feedback" cclass="btn btn-success btn-block btn_width feedback"><i class="far fa-eye"></i> View</a>' + 
                                                    '<i class="fa fa-trash" onclick="deleteFeedBack('+ feedback["tbl_feedback_id"] +'></i></td>' + 
                                            '</tr>'

                }
                $('#feedback_table_body').empty();
                $('#feedback_table_body').append(feedback_table_body);
            } else {
                $('#feedback_table_body').empty();
                $('#feedback_table_body').append("<tr> No data to display!</tr>");
            }

        }
        
    </script>
    