<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style type="text/css">
    .modal-dialog.modal-dialog-centered {
        width: 500px!important;
    }
</style>
<div class="sidebar sidebar-right sidebar-animate">
                    <div class="panel panel-primary card mb-0">
                        <div class="panel-body tabs-menu-body p-0 border-0">
                            <ul class="Date-time">
                                <li class="time">
                                    <h1 class="animated ">21:00</h1>
                                    <p class="animated ">Sat,October 1st 2029</p>
                                </li>
                            </ul>
                            <div class="tabs-menu ">
                                <!-- Tabs -->
                                <ul class="nav panel-tabs">
                                    <li class=""><a href="#side1" class="active" data-toggle="tab"><i class="" lass="typcn icon typcn-bell"></i> Task Notifications <span id="tasks_count"></span></a></li>
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

        <!-- JQuery min js -->
        <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>

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
                });
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

        <!-- Datatable js -->
        <script src="<?php echo base_url(); ?>assets/js/table-data.js"></script>

        <script src="<?php echo base_url(); ?>assets/js/form-editor.js"></script>

        <script src="<?php echo base_url(); ?>assets/plugins/quill/quill.min.js"></script>

        <script src="<?php echo base_url(); ?>assets/plugins/mscrollbar/jquery.mCustomScrollbar.concat.min.js"></script>

        <script src="<?php echo base_url(); ?>assets/plugins/inputtags/inputtags.js"></script>
               <script type="text/javascript">
            $(document).ready(function () {
                loadQuestionTasksNotifications();
                //loadTasksNotifications();
            });
            function loadTasksNotifications() {
                let incubatorId = <?= $this->session->userdata('id_user') ?>;
                $.ajax({
                    method: "post",
                    url: '<?= base_url() ?>incubator/Smme/processMilestoneTasks/'+incubatorId,
                    data: {
                        taskAction: "getAllMilestoneTasks",
                        incubatorId: incubatorId
                    },
                    success:function(data) {
                        updateTasksNotification(data);
                    }
                })
            }
            function updateTasksNotification(tasksData) {
                var tasks = JSON.parse(tasksData)["tasks"];
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
                                                "<a href='/incubator/smme/Smme/createMilestoneTask/'"+task['smme_id']+">" + 
                                                "<h5 class='mt-1 mb-1'>"+task['task_name']+"</h5>" +
                                                "</a>"+
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

            function loadQuestionTasksNotifications() {
                let incubatorId = <?= $this->session->userdata('id_user') ?>;
                $.ajax({
                    method: "post",
                    url: '<?= base_url() ?>incubator/Smme/processQuestions/'+incubatorId,
                    data: {
                        questionAction: "getAllQuestions",
                        incubatorId: incubatorId
                    },
                    success:function(data) {
                        updateTaskQuestionsNotification(data);
                    }
                })
            }
            function updateTaskQuestionsNotification(tasksData) {
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