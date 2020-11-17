<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="sidebar sidebar-right sidebar-animate">
                    <div class="panel panel-primary card mb-0">
                        <div class="panel-body tabs-menu-body p-0 border-0">
                            <ul class="Date-time">
                                <li class="time">
                                    <h1 class="animated ">21:00</h1>
                                    <p class="animated ">Sat,October 1st 2029</p>
                                </li>
                            </ul>
                            <div class="tabs-menu">
                                <!-- Tabs -->
                                <ul class="nav panel-tabs">
                                    <li class=""><a href="#side1" class="active" data-toggle="tab"><i class="" lass="typcn icon typcn-bell"></i> Task Notifications<span id="tasks_count"></span></a></li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane active" id="side1">
                                    <div class="chat">
                                        <div class="contacts_card">
                                            <div class="input-group mb-0 p-3">
                                                <input type="search" class="form-control form-control-sm" placeholder="Search..." onkeyup="searchNotificationList()" id="tasks_notification_search">
                                                <div class="input-group-prepend mr-0">
                                                    <span class="input-group-text search_btn  btn-primary"><i class="fa fa-search text-white"></i></span>
                                                </div>
                                            </div>
                                            <ul class="contacts mb-0" role="search" id="tasks_notification_list">
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/Sidebar-right-->
            </div>
                <!-- Container closed -->
       
<div class="main-footer ht-40">
                <div class="container pd-t-0-f ht-100p">
                    <span>Copyright &copy; <?php echo date ('Y'); ?> BEDCO Virtual Business Incubator.  All Rights Reserved. | Developed & Maintained by <a href="https://standafric.com">Standafric (PTY) Ltd</a></span>
                </div> 
            </div>
            <!-- Footer closed -->
        </div>
        <div class="modal" id="terms-modal"  role="dialog">
            <div class="modal-dialog modal-xl">
          <div class="modal-content">
          
            <!-- Modal Header -->
            <div class="modal-header">
              <h1 class="modal-title">Terms and conditions</h1>
              <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body" style="text-align:justify;">
             <p>
              Terms and Conditions of Participation on the Virtual Business Incubation Platform. These Terms and Conditions must be read and signed in order to register on the Virtual Business Incubation (VBI) platform.</p><p>
By applying to register on the VBI platform, I agree to be bound by the following conditions:</p>
<strong>AGREEMENT TO PUBLICITY </strong><p>
By registering to engage with other VBI registrants, I agree that the Business Incubator in whose incubation programme I participate has the right to print, publish, broadcast, and use, responsibly, in any media my name, picture, andall other information as news or for promotional purposes.</p>
<strong>COMMITMENT TO THE TERMS AND CONDITIONS </strong><p>
I have reviewed the Terms and Conditionsand by my signature of this document, confirm that I have and shall conform to the Terms and Conditions andthat I agree to be governed by said Terms and Conditions.</p>
<strong>OWNERSHIP OF BUSINESS MATERIAL</strong><p>
I hereby confirm and guarantee that the Business information that I submit pertaining to my business and the tools, templates and training material I may upload is my own original idea, or I have permission from the original author to do so, and that I am under no restriction or agreement (legal or otherwise) prohibiting me divulging or submitting this content on the VBI.</p>
<strong>COMMITMENT TO THE BUSINESS INCUBATION PROCESS AND OBJECTIVES </strong>
<p>
I agree to commit myself in person, my time and resources to attend all Incubator-organized trainings, coaching and mentoring sessions as agreed upon in writing with the Incubation Manager, and to submit updates on activities and progress made by my MSME client as may be reasonably requested by the Incubation Manager. </p><p>
I agree to the regular assessment of my performance by the Incubation Manager and BEDCO, understanding that they will be taking into account feedback from the MSMEs to whom I have been providing support.</p><p>
I acknowledge that should I fail in any of the aforementioned categories, I shall lose all rights of participation and may be removed by the Incubation Manager or the BEDCO System Administrator from the VBI.</p>
<strong>RENUNCIATION OF JUDICIAL ACTION</strong><p>
I understand and acknowledge that the MSME retains the absolute right to accept or reject any advice I provide, and will not hold me liable for any decisions or action s/he takes based on my advice. 
Further, I agree to absolve other registrants on the VBI from any and all legalliability that could arise out of or in any way related to my participation on the VBI.</p>
<strong>COMMITMENT TO PROVIDE BUSINESS DATA </strong><p>
With this Letter of Agreement, I commit to provide businessdata to the BEDCO Administrator and / or Business Incubator Officer that is appointed for progress monitoring. I furthermore agree to complete feedback assessments on MSMEs with whom I have engaged. 
I hereby declare that I understandand agree to the terms of this Participation Letter of Agreement.</p>
</p>
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" onclick="acceptTerms();">Accept & Continue</button>
            </div>
            
          </div>
            </div>
        </div>
        <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
        <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
        <!-- Bootstrap Bundle js -->
        <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Ionicons js -->
        <script src="<?php echo base_url(); ?>assets/plugins/ionicons/ionicons.js"></script>

        <!-- Moment js -->
        <script src="<?php echo base_url(); ?>assets/plugins/moment/moment.js"></script>

        <!-- Sparkline js -->
        <script src="<?php echo base_url(); ?>assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>

        <!-- Moment js -->
        <script src="<?php echo base_url(); ?>assets/plugins/raphael/raphael.min.js"></script>

        <!-- Piety js -->
        <script src="<?php echo base_url(); ?>assets/plugins/peity/jquery.peity.min.js"></script>

        <!-- Flot js-->
        <script src="<?php echo base_url(); ?>assets/plugins/jquery.flot/jquery.flot.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/jquery.flot/jquery.flot.pie.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/jquery.flot/jquery.flot.resize.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/jquery.flot/jquery.flot.categories.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/dashboard.sampledata.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/chart.flot.sampledata.js"></script>

        <!-- Sticky js -->
        <script src="<?php echo base_url(); ?>assets/js/sticky.js"></script>

        <!-- Rating js-->
        <script src="<?php echo base_url(); ?>assets/plugins/rating/jquery.rating-stars.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/rating/jquery.barrating.js"></script>

        <!-- P-scroll js -->
        <script src="<?php echo base_url(); ?>assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/perfect-scrollbar/p-scroll.js"></script>

        <!-- Horizontalmenu js-->
        <script src="<?php echo base_url(); ?>assets/plugins/sidebar/sidebar.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/sidebar/sidebar-custom.js"></script>

        <!-- Eva-icons js -->
        <script src="<?php echo base_url(); ?>assets/js/eva-icons.min.js"></script>

        <!-- Apexchart js-->
        <script src="<?php echo base_url(); ?>assets/js/apexcharts.js"></script>

        <!-- Horizontalmenu js-->
        <script src="<?php echo base_url(); ?>assets/plugins/horizontal-menu/horizontal-menu/horizontal-menu.js"></script>

        <!-- Chart js -->
        <script src="<?php echo base_url(); ?>assets/plugins/chart.js/Chart.bundle.min.js"></script>

        <!-- Index js -->
        <script src="<?php echo base_url(); ?>assets/js/dashboard-1.js"></script>

        <!-- Custom js -->
        <script src="<?php echo base_url(); ?>assets/js/custom.js"></script>

        <script src="<?php echo base_url(); ?>assets/plugins/telephoneinput/telephoneinput.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/telephoneinput/inttelephoneinput.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>


        <script type="text/javascript">
            $(document).ready(function(){
               $('.js-example-basic-single').select2();
               checkTerms();
            });

            function checkTerms(){
                let terms = "<?php echo is_terms_accepted();?>";
                if(terms == 0){
                    $("#terms-modal").modal('show');
                }
            }
            $("#terms-modal").on('hidden.bs.modal', function(e){
                checkTerms();
            });

            function acceptTerms(){
                $.ajax({
                    url: "<?php echo site_url('Terms/index');?>",
                    success:function(data){
                        if(data == 1){
                            location.reload();
                        }else{
                            $("#terms-modal").modal('show');
                        }
                    },
                    error:function(err){
                        console.log('Error');
                    }
                });
            }
        </script>

        <!-- Data tables -->
        <script src="<?php echo base_url(); ?>assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/datatables.net-dt/js/dataTables.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/datatables.net-responsive-dt/js/responsive.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/datatable/js/jquery.dataTables.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/datatable/js/dataTables.bootstrap4.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/datatable/js/dataTables.buttons.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/datatable/js/buttons.bootstrap4.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/datatable/js/jszip.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/datatable/js/pdfmake.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/datatable/js/vfs_fonts.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/datatable/js/buttons.html5.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/datatable/js/buttons.print.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/datatable/js/buttons.colVis.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/datatable/dataTables.responsive.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/datatable/responsive.bootstrap4.min.js"></script>

         <!-- Date picker js -->
        <script src="<?php echo base_url(); ?>assets/plugins/jquery-ui/ui/widgets/datepicker.js"></script>

        <!-- Fullcalendar js -->
        <!-- <script src="<?php echo base_url(); ?>assets/plugins/fullcalendar/fullcalendar.min.js"></script> -->
        
        <!-- Datatable js -->
        <script src="<?php echo base_url(); ?>assets/js/table-data.js"></script>

        <script src="<?php echo base_url(); ?>assets/js/form-editor.js"></script>

        <script src="<?php echo base_url(); ?>assets/plugins/quill/quill.min.js"></script>

        <script src="<?php echo base_url(); ?>assets/plugins/mscrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
        <!-- <script src="<?php echo base_url(); ?>assets/js/fullcalendar.min.js"></script> -->
        <script src="<?php echo base_url(); ?>assets/plugins/inputtags/inputtags.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                //loadTasksNotifications();
                loadTasksNotificationsForQuestions();
            });
            function loadTasksNotifications() {
                let bdspId = <?= $this->session->userdata('id_user') ?>;
                $.ajax({
                    method: "post",
                    url: '<?= base_url() ?>bdsp/Smme/processMilestoneQurss/'+bdspId,
                    data: {
                        taskAction: "getAllMilestoneTasks"
                    },
                    success:function(data) {
                        updateTasksNotification(data);
                    }
                })
            }
            function loadTasksNotificationsForQuestions() {
                let bdspId = <?= $this->session->userdata('id_user') ?>;
                $.ajax({
                    method: "post",
                    url: '<?= base_url() ?>bdsp/Smme/processQuestions/'+bdspId,
                    data: {
                        questionAction: "getAllQuestions"
                    },
                    success:function(data) {
                        updateQuestionsNotification(data);
                        //updateTasksNotification(data);
                    }
                })
            }
            function updateQuestionsNotification(tasksData) {
                var tasks = JSON.parse(tasksData)["task_notifications"];
                tasksList = "";
                $('#tasks_count').empty();
                $('#tasks_count').text("  ");
                $("#tasks_count").append("<span class='badge badge-light'>" + tasks.length +"</span>");
                if(tasks.length) {
                    for(var tasksIdx = 0; tasksIdx < tasks.length; tasksIdx++) {
                        var task = tasks[tasksIdx];
                        if (task['question_text'].length > 27) {
                            task['question_text'] = task['question_text'].substring(0,26) + "...";
                        }
                        tasksList += "<li class='active'>" + 
                                        "<div class='d-flex bd-highlight w-100'>" +
                                            "<div class='user_info'>" +
                                                "<h5 class='mt-1 mb-1'>"+task['question_text']+"</h5>" +
                                            "</div>" +
                                            "<div class='float-right text-right ml-auto mt-auto mb-auto'><small>"+ task['target_date']+"</small></div>"+
                                        "</div>"
                                    "</li>";
                    }
                    $('#tasks_notification_list').empty();
                    $('#tasks_notification_list').append(tasksList);
                } else {
                    $('#tasks_notification_list').empty();
                    $('#tasks_notification_list').append("<li>No tasks to display</li>");           
                }
            }

            function updateTasksNotification(tasksData) {
                var tasks = JSON.parse(tasksData)["task_notifications"];
                tasksList = "";
                $('#tasks_count').empty();
                $('#tasks_count').text(" ");
                $("#tasks_count").append("<span class='badge badge-light'>" + tasks.length +"</span>");
                if(tasks.length) {
                    for(var tasksIdx = 0; tasksIdx < tasks.length; tasksIdx++) {
                        var task = tasks[tasksIdx];
                        if (task['task_name'].length > 27) {
                            task['task_name'] = task['task_name'].substring(0,26) + "...";
                        }
                        tasksList += "<li class='active'>" + 
                                        "<div class='d-flex bd-highlight w-100'>" +
                                            "<div class='user_info'>" +
                                                "<h5 class='mt-1 mb-1'>"+task['task_name']+"</h5>" +
                                            "</div>" +
                                            "<div class='float-right text-right ml-auto mt-auto mb-auto'><small>"+ task['task_target_date']+"</small></div>"+
                                        "</div>"
                                    "</li>";
                    }
                    $('#tasks_notification_list').empty();
                    $('#tasks_notification_list').append(tasksList);
                } else {
                    $('#tasks_notification_list').empty();
                    $('#tasks_notification_list').append("<li>No tasks to display</li>");           
                }
            }

            function searchNotificationList() {
                var input, filter, ul, li, a, i, txtValue;
                input = document.getElementById('tasks_notification_search');
                filter = input.value.toUpperCase();
                ul = document.getElementById("tasks_notification_list");
                li = ul.getElementsByTagName('li');
                for (i = 0; i < li.length; i++) {
                    taskName = li[i].getElementsByTagName("h5")[0];
                    taskNameValue = taskName.innerHTML;
                    taskDate = li[i].getElementsByTagName("small")[0];
                    taskDateValue = taskDate.innerHTML;
                    if (taskNameValue.toUpperCase().indexOf(filter) > -1 || taskDateValue.indexOf(filter) > -1) {
                        li[i].style.display = "";
                    } else {
                        li[i].style.display = "none";
                    }
                }
            }
        </script>
    </body>
</html>