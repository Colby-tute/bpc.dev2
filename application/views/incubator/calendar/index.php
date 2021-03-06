<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?= $header; ?>
<link href="<?php echo base_url(); ?>assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css" rel="stylesheet">
<link href="<?= base_url() ?>assets/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet">
        <div class="page">

            <!-- main-content opened -->
            <div class="main-content horizontal-content" style="margin-top: 0!important">

                <!-- Container opened -->
                <div class="container">

                    <!-- breadcrumb -->
                    <div class="breadcrumb-header justify-content-between">
                        <div>
			<h4 class="content-title mb-2">Operations</h4>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= site_url('incubator/home') ?>">Dashboard</a></li>
					<li class="breadcrumb-item active" aria-current="page">Calendar & Events</li>
				</ol>
			</nav>
		</div>
		
		
		<div class="my-auto breadcrumb-right">
							<a href="<?= site_url('incubator/Calendar/create') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-plus-square mr-2"></i></span><span class="btn-text">Create Calendar Event</span></button></a>
							<a href="<?= site_url('incubator/Profile/view_profile/'.$this->session->userdata('id_user')) ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Personal Details </span></button></a>
							<button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-question-circle mr-2"></i> </span><span class="btn-text">Help </span></button>
						</div>
		
		
		
		
		
		
		
                    </div>
                    <!-- breadcrumb -->

                    <div class="main-content-app pd-b-0  main-content-calendar pt-0">
                        
                        <!-- row -->
                        <div class="row row-sm">
                            <div class="col-lg-12 col-xl-4">
                                <div class=" card card--calendar p-0 mg-b-20">
                                    <div class="p-4 border-bottom">
                                        <h2 class="main-content-title mg-b-15 tx-16">MY CALENDAR</h2>
                                        <div class="fc-datepicker main-datepicker border"></div>
                                    </div>
                                    <div class="p-4">
                                        <label class="main-content-label tx-14 tx-bold mg-b-10">Event List</label>
                                        <nav class="nav main-nav-column main-nav-calendar-event">
                                            <a class="nav-link" href=""><i class="icon ion-ios-calendar tx-primary"></i>
                                                <div>
                                                    Meeting
                                                </div>
                                            </a> 
                                            <a class="nav-link" href=""><i class="icon ion-ios-calendar tx-success"></i>
                                            <div>
                                                Training
                                            </div></a> <a class="nav-link" href=""><i class="icon ion-ios-calendar tx-danger"></i>
                                            <div>
                                                Feedback
                                            </div></a> <a class="nav-link" href=""><i class="icon ion-ios-calendar tx-warning"></i>
                                            <div>
                                                Workshop
                                            </div></a> 
                                            <a class="nav-link" href=""><i class="icon ion-ios-calendar tx-primary"></i>
                                                <div>
                                                    One on One
                                                </div>
                                            </a> 
                                            <a class="nav-link" href=""><i class="icon ion-ios-calendar tx-success"></i>
                                            <div>
                                                Evaluation
                                            </div></a> <a class="nav-link" href=""><i class="icon ion-ios-calendar tx-danger"></i>
                                            <div>
                                                Assessment
                                            </div></a> 
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-8">
                                <div class="main-content-body main-content-body-calendar card p-4">
                                    <div class="main-calendar" id="calendar"></div>
                                </div>
                            </div>
                        </div>
                        <!-- /row -->
                    </div>
                </div>
                <!-- Container closed -->
            </div>
            <!-- main-content closed -->

            <!--Sidebar-right-->
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
                                <li class=""><a href="#side1" class="active" data-toggle="tab"><i class="fas fa-comments"></i> Setting</a></li>
                                <li><a href="#side2" data-toggle="tab"><i class="fas fa-bell"></i> Notifications</a></li>
                                <li><a href="#side3" data-toggle="tab"><i class="fas fa-user-friends"></i> Friends</a></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active " id="side1">
                                <div class="chat">
                                    <div class="contacts_card">
                                        <div class="input-group mb-0 p-3">
                                            <input type="text" placeholder="Search..." class="form-control search">
                                            <div class="input-group-prepend mr-0">
                                                <span class="input-group-text  search_btn  btn-primary"><i class="fa fa-search text-white"></i></span>
                                            </div>
                                        </div>
                                        <ul class="contacts mb-0">
                                            <li class="active">
                                                <div class="d-flex bd-highlight w-100">
                                                    <div class="img_cont">
                                                        <img src="../../assets/img/faces/12.jpg" class="rounded-circle user_img" alt="img">
                                                        <span class="online_icon"></span>
                                                    </div>
                                                    <div class="user_info">
                                                        <h5 class="mt-1 mb-1">Maryam Naz</h5>
                                                        <small class="text-muted">is online</small>
                                                    </div>
                                                    <div class="float-right text-right ml-auto mt-auto mb-auto"><small>01-02-2019</small></div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex bd-highlight w-100">
                                                    <div class="img_cont">
                                                        <img src="../../assets/img/faces/2.jpg" class="rounded-circle user_img" alt="img">
                                                        <span class=" online_icon"></span>
                                                    </div>
                                                    <div class="user_info">
                                                        <h5 class="mt-1 mb-1">Sahar Darya</h5>
                                                        <small class="text-muted">left 7 mins ago</small>
                                                    </div>
                                                    <div class="float-right text-right ml-auto mt-auto mb-auto"><small>01-02-2019</small></div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex bd-highlight w-100">
                                                    <div class="img_cont">
                                                        <img src="../../assets/img/faces/5.jpg" class="rounded-circle user_img" alt="img">
                                                        <span class="online_icon"></span>
                                                    </div>
                                                    <div class="user_info">
                                                        <h5 class="mt-1 mb-1">Maryam Naz</h5>
                                                        <small class="text-muted">online</small>
                                                    </div>
                                                    <div class="float-right text-right ml-auto mt-auto mb-auto"><small>01-02-2019</small></div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex bd-highlight w-100">
                                                    <div class="img_cont">
                                                        <img src="../../assets/img/faces/7.jpg" class="rounded-circle user_img" alt="img">
                                                        <span class="online_icon"></span>
                                                    </div>
                                                    <div class="user_info">
                                                        <h5 class="mt-1 mb-1">Yolduz Rafi</h5>
                                                        <small class="text-muted">online</small>
                                                    </div>
                                                    <div class="float-right text-right ml-auto mt-auto mb-auto"><small>02-02-2019</small></div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex bd-highlight w-100">
                                                    <div class="img_cont">
                                                        <img src="../../assets/img/faces/8.jpg" class="rounded-circle user_img" alt="img">
                                                        <span class="online_icon"></span>
                                                    </div>
                                                    <div class="user_info">
                                                        <h5 class="mt-1 mb-1">Nargis Hawa</h5>
                                                        <small class="text-muted">30 mins ago</small>
                                                    </div>
                                                    <div class="float-right text-right ml-auto mt-auto mb-auto"><small>02-02-2019</small></div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex bd-highlight w-100">
                                                    <div class="img_cont">
                                                        <img src="../../assets/img/faces/3.jpg" class="rounded-circle user_img" alt="img">
                                                        <span class="online_icon"></span>
                                                    </div>
                                                    <div class="user_info">
                                                        <h5 class="mt-1 mb-1">Khadija Mehr</h5>
                                                        <small class="text-muted">50 mins ago</small>
                                                    </div>
                                                    <div class="float-right text-right ml-auto mt-auto mb-auto"><small>03-02-2019</small></div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex bd-highlight w-100">
                                                    <div class="img_cont">
                                                        <img src="../../assets/img/faces/14.jpg" class="rounded-circle user_img" alt="img">
                                                        <span class="online_icon"></span>
                                                    </div>
                                                    <div class="user_info">
                                                        <h5 class="mt-1 mb-1">Petey Cruiser</h5>
                                                        <small class="text-muted">1hr ago</small>
                                                    </div>
                                                    <div class="float-right text-right ml-auto mt-auto mb-auto"><small>03-02-2019</small></div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex bd-highlight w-100">
                                                    <div class="img_cont">
                                                        <img src="../../assets/img/faces/11.jpg" class="rounded-circle user_img" alt="img">
                                                    </div>
                                                    <div class="user_info">
                                                        <h5 class="mt-1 mb-1">Khadija Mehr</h5>
                                                        <small class="text-muted">2hr ago</small>
                                                    </div>
                                                    <div class="float-right text-right ml-auto mt-auto mb-auto"><small>03-02-2019</small></div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane  " id="side2">
                                <div class="list-group list-group-flush ">
                                    <div class="list-group-item d-flex  align-items-center">
                                        <div class="mr-3">
                                            <span class="avatar avatar-md brround cover-image" data-image-src="../../assets/img/faces/12.jpg"><span class="avatar-status bg-success"></span></span>
                                        </div>
                                        <div>
                                            <strong>Madeleine</strong> Hey! there I' am available....
                                            <div class="small text-muted">
                                                3 hours ago
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-group-item d-flex  align-items-center">
                                        <div class="mr-3">
                                            <span class="avatar avatar-md brround cover-image" data-image-src="../../assets/img/faces/3.jpg"></span>
                                        </div>
                                        <div>
                                            <strong>Anthony</strong> New product Launching...
                                            <div class="small text-muted">
                                                5 hour ago
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-group-item d-flex  align-items-center">
                                        <div class="mr-3">
                                            <span class="avatar avatar-md brround cover-image" data-image-src="../../assets/img/faces/9.jpg"><span class="avatar-status bg-success"></span></span>
                                        </div>
                                        <div>
                                            <strong>Olivia</strong> New Schedule Realease......
                                            <div class="small text-muted">
                                                45 mintues ago
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-group-item d-flex  align-items-center">
                                        <div class="mr-3">
                                            <span class="avatar avatar-md brround cover-image" data-image-src="../../assets/img/faces/5.jpg"><span class="avatar-status bg-success"></span></span>
                                        </div>
                                        <div>
                                            <strong>Madeleine</strong> Hey! there I' am available....
                                            <div class="small text-muted">
                                                3 hours ago
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-group-item d-flex  align-items-center">
                                        <div class="mr-3">
                                            <span class="avatar avatar-md brround cover-image" data-image-src="../../assets/img/faces/11.jpg"></span>
                                        </div>
                                        <div>
                                            <strong>Anthony</strong> New product Launching...
                                            <div class="small text-muted">
                                                5 hour ago
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-group-item d-flex  align-items-center">
                                        <div class="mr-3">
                                            <span class="avatar avatar-md brround cover-image" data-image-src="../../assets/img/faces/7.jpg"><span class="avatar-status bg-success"></span></span>
                                        </div>
                                        <div>
                                            <strong>Olivia</strong> New Schedule Realease......
                                            <div class="small text-muted">
                                                45 mintues ago
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-group-item d-flex  align-items-center">
                                        <div class="mr-3">
                                            <span class="avatar avatar-md brround cover-image" data-image-src="../../assets/img/faces/6.jpg"><span class="avatar-status bg-success"></span></span>
                                        </div>
                                        <div>
                                            <strong>Olivia</strong> New Schedule Realease......
                                            <div class="small text-muted">
                                                1 hour ago
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane  " id="side3">
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item d-flex align-items-center">
                                        <div class="mr-2">
                                            <span class="contact-img brround avatar cover-image" data-image-src="../../assets/img/faces/1.jpg"><span class="avatar-status bg-teal"></span></span>
                                        </div>
                                        <div class="">
                                            <div class="font-weight-semibold">
                                                Darlena Torian
                                            </div>
                                        </div>
                                        <div class="ml-auto d-flex">
                                            <a class="btn btn-sm btn-light btn-icon mr-2" href="#"><i class="fe fe-phone"></i></a>
                                            <a class="btn btn-sm btn-light btn-icon" href="#"><i class="fe fe-message-square"></i></a>
                                        </div>
                                    </div>
                                    <div class="list-group-item d-flex align-items-center">
                                        <div class="mr-2">
                                            <span class="contact-img brround avatar cover-image" data-image-src="../../assets/img/faces/2.jpg"></span>
                                        </div>
                                        <div class="">
                                            <div class="font-weight-semibold">
                                                Richie Verrill
                                            </div>
                                        </div>
                                        <div class="ml-auto d-flex">
                                            <a class="btn btn-sm btn-light btn-icon mr-2" href="#"><i class="fe fe-phone"></i></a> <a class="btn btn-sm btn-light btn-icon" href="#"><i class="fe fe-message-square"></i></a>
                                        </div>
                                    </div>
                                    <div class="list-group-item d-flex align-items-center">
                                        <div class="mr-2">
                                            <span class="contact-img brround avatar cover-image" data-image-src="../../assets/img/faces/3.jpg"><span class="avatar-status bg-teal"></span></span>
                                        </div>
                                        <div class="">
                                            <div class="font-weight-semibold">
                                                Cheree Morgan
                                            </div>
                                        </div>
                                        <div class="ml-auto d-flex">
                                            <a class="btn btn-sm btn-light btn-icon mr-2" href="#"><i class="fe fe-phone"></i></a> <a class="btn btn-sm btn-light btn-icon" href="#"><i class="fe fe-message-square"></i></a>
                                        </div>
                                    </div>
                                    <div class="list-group-item d-flex align-items-center">
                                        <div class="mr-2">
                                            <span class="contact-img brround avatar  cover-image" data-image-src="../../assets/img/faces/4.jpg"><span class="avatar-status bg-teal"></span></span>
                                        </div>
                                        <div class="">
                                            <div class="font-weight-semibold">
                                                Katerine Coit
                                            </div>
                                        </div>
                                        <div class="ml-auto d-flex">
                                            <a class="btn btn-sm btn-light btn-icon mr-2" href="#"><i class="fe fe-phone"></i></a> <a class="btn btn-sm btn-light btn-icon" href="#"><i class="fe fe-message-square"></i></a>
                                        </div>
                                    </div>
                                    <div class="list-group-item d-flex align-items-center">
                                        <div class="mr-2">
                                            <span class="contact-img brround avatar cover-image" data-image-src="../../assets/img/faces/5.jpg"><span class="avatar-status bg-teal"></span></span>
                                        </div>
                                        <div class="">
                                            <div class="font-weight-semibold">
                                                Hai Indelicato
                                            </div>
                                        </div>
                                        <div class="ml-auto d-flex">
                                            <a class="btn btn-sm btn-light btn-icon mr-2" href="#"><i class="fe fe-phone"></i></a> <a class="btn btn-sm btn-light btn-icon" href="#"><i class="fe fe-message-square"></i></a>
                                        </div>
                                    </div>
                                    <div class="list-group-item d-flex align-items-center">
                                        <div class="mr-2">
                                            <span class="contact-img brround avatar cover-image" data-image-src="../../assets/img/faces/6.jpg" ></span>
                                        </div>
                                        <div class="">
                                            <div class="font-weight-semibold">
                                                Cecilia Kerfoot
                                            </div>
                                        </div>
                                        <div class="ml-auto d-flex">
                                            <a class="btn btn-sm btn-light btn-icon mr-2" href="#"><i class="fe fe-phone"></i></a> <a class="btn btn-sm btn-light btn-icon" href="#"><i class="fe fe-message-square"></i></a>
                                        </div>
                                    </div>
                                    <div class="list-group-item d-flex align-items-center">
                                        <div class="mr-2">
                                            <span class="contact-img brround avatar cover-image" data-image-src="../../assets/img/faces/7.jpg"><span class="avatar-status bg-teal"></span></span>
                                        </div>
                                        <div class="">
                                            <div class="font-weight-semibold">
                                                Ronald Zirbel
                                            </div>
                                        </div>
                                        <div class="ml-auto d-flex">
                                            <a class="btn btn-sm btn-light btn-icon mr-2" href="#"><i class="fe fe-phone"></i></a> <a class="btn btn-sm btn-light btn-icon" href="#"><i class="fe fe-message-square"></i></a>
                                        </div>
                                    </div>
                                    <div class="list-group-item d-flex align-items-center">
                                        <div class="mr-2">
                                            <span class="contact-img brround avatar cover-image" data-image-src="../../assets/img/faces/8.jpg" ><span class="avatar-status bg-teal"></span></span>
                                        </div>
                                        <div class="">
                                            <div class="font-weight-semibold">
                                                Darren Niemann
                                            </div>
                                        </div>
                                        <div class="ml-auto d-flex">
                                            <a class="btn btn-sm btn-light btn-icon mr-2" href="#"><i class="fe fe-phone"></i></a> <a class="btn btn-sm btn-light btn-icon" href="#"><i class="fe fe-message-square"></i></a>
                                        </div>
                                    </div>
                                    <div class="list-group-item d-flex align-items-center">
                                        <div class="mr-2">
                                            <span class="contact-img brround avatar cover-image" data-image-src="../../assets/img/faces/9.jpg"><span class="avatar-status bg-teal"></span></span>
                                        </div>
                                        <div class="">
                                            <div class="font-weight-semibold">
                                                Sibyl Cogley
                                            </div>
                                        </div>
                                        <div class="ml-auto d-flex">
                                            <a class="btn btn-sm btn-light btn-icon mr-2" href="#"><i class="fe fe-phone"></i></a> <a class="btn btn-sm btn-light btn-icon" href="#"><i class="fe fe-message-square"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/Sidebar-right-->

            <!-- Modal -->
            <div aria-hidden="true" class="modal main-modal-calendar-event" id="modalCalendarEvent" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <nav class="nav nav-modal-event">
                                <a class="nav-link" href="#"><i class="icon ion-md-open"></i></a>
                                <a class="nav-link" href="#"><i class="icon ion-md-trash"></i></a>
                                <a class="nav-link" data-dismiss="modal" href="#">
                                <i class="icon ion-md-close"></i></a>
                            </nav>
                        </div>
                        <div class="modal-body">
                            <div class="row row-sm">
                                <!-- <div class="col-sm-6">
                                    <label class="tx-13 tx-gray-600 mg-b-2"><strong>Title</strong></label>
                                    <p class="event-title"></p>
                                </div> -->
                                <div class="col-sm-6">
                                    <label class="tx-13 mg-b-2"><strong>User</strong></label>
                                    <p class="event-user"></p>
                                </div>
                                <div class="col-sm-6">
                                    <label class="tx-13 mg-b-2"><strong>Address</strong></label>
                                    <p class="event-address"></p>
                                </div>
                                <div class="col-sm-6">
                                    <label class="tx-13 tx-gray-600 mg-b-2"><strong>Start Date</strong></label>
                                    <p class="event-start-date"></p>
                                </div>
                                <div class="col-sm-6">
                                    <label class="tx-13 mg-b-2"><strong>End Date</strong></label>
                                    <p class="event-end-date"></p>
                                </div>
                                
                            </div><label class="tx-13 tx-gray-600 mg-b-2"><strong>Description</strong></label>
                            <p class="event-desc tx-gray-900 mg-b-30"></p><a class="btn btn-secondary wd-80" data-dismiss="modal" href="">Close</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    <?= $footer; ?>
<script src="<?= base_url() ?>assets/plugins/fullcalendar/fullcalendar.min.js"></script>
<script type="text/javascript">
    $(function() {
    'use strict'
    // Datepicker found in left sidebar of the page
    var highlightedDays = ['2020-5-10'];
    var date = new Date();
    $('.fc-datepicker').datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        dateFormat: 'yy-mm-dd',
        beforeShowDay: function(date) {
            var m = date.getMonth(),
                d = date.getDate(),
                y = date.getFullYear();
            for (var i = 0; i < highlightedDays.length; i++) {
                if ($.inArray(y + '-' + (m + 1) + '-' + d, highlightedDays) != -1) {
                    return [true, 'ui-date-highlighted', ''];
                }
            }
            return [true];
        }
    });
    var generateTime = function(element) {
        var n = 0,
            min = 30,
            periods = [' AM', ' PM'],
            times = [],
            hours = [12, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11];
        for (var i = 0; i < hours.length; i++) {
            times.push(hours[i] + ':' + n + n + periods[0]);
            while (n < 60 - min) {
                times.push(hours[i] + ':' + ((n += min) < 10 ? 'O' + n : n) + periods[0])
            }
            n = 0;
        }
        times = times.concat(times.slice(0).map(function(time) {
            return time.replace(periods[0], periods[1])
        }));
        //console.log(times);
        $.each(times, function(index, val) {
            $(element).append('<option value="' + val + '">' + val + '</option>');
        });
    }
    generateTime('.main-event-time');
    // Initialize fullCalendar
    let events = <?= json_encode($events) ?>;
    //events = events.replace("***", "'");
    events = JSON.parse(events);

    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,listWeek'
        },
        navLinks: true,
        selectable: true,
        selectLongPressDelay: 100,
        editable: true,
        nowIndicator: true,
        defaultView: 'listMonth',
        views: {
            agenda: {
                columnHeaderHtml: function(mom) {
                    return '<span>' + mom.format('ddd') + '</span>' + '<span>' + mom.format('DD') + '</span>';
                }
            },
            day: {
                columnHeader: false
            },
            listMonth: {
                listDayFormat: 'ddd DD',
                listDayAltFormat: false
            },
            listWeek: {
                listDayFormat: 'ddd DD',
                listDayAltFormat: false
            },
            agendaThreeDay: {
                type: 'agenda',
                duration: {
                    days: 3
                },
                titleFormat: 'MMMM YYYY'
            }
        },
        eventSources: events,
        eventAfterAllRender: function(view) {
            if (view.name === 'listMonth' || view.name === 'listWeek') {
                var dates = view.el.find('.fc-list-heading-main');
                dates.each(function() {
                    var text = $(this).text().split(' ');
                    var now = moment().format('DD');
                    $(this).html(text[0] + '<span>' + text[1] + '</span>');
                    if (now === text[1]) {
                        $(this).addClass('now');
                    }
                });
            }
            console.log(view.el);
        },
        eventRender: function(event, element) {
            if (event.description) {
                element.find('.fc-list-item-title').append('<span class="fc-desc">' + event.description + '</span>');
                element.find('.fc-content').append('<span class="fc-desc">' + event.description + '</span>');
            }
            var eBorderColor = (event.source.borderColor) ? event.source.borderColor : event.borderColor;
            element.find('.fc-list-item-time').css({
                color: eBorderColor,
                borderColor: eBorderColor
            });
            element.find('.fc-list-item-title').css({
                borderColor: eBorderColor
            });
            element.css('borderLeftColor', eBorderColor);
        },
    });
    var azCalendar = $('#calendar').fullCalendar('getCalendar');
    // change view to week when in tablet
    if (window.matchMedia('(min-width: 576px)').matches) {
        azCalendar.changeView('agendaWeek');
    }
    // change view to month when in desktop
    if (window.matchMedia('(min-width: 992px)').matches) {
        azCalendar.changeView('month');
    }
    // change view based in viewport width when resize is detected
    azCalendar.option('windowResize', function(view) {
        if (view.name === 'listWeek') {
            if (window.matchMedia('(min-width: 992px)').matches) {
                azCalendar.changeView('month');
            } else {
                azCalendar.changeView('listWeek');
            }
        }
    });
    // display current date
    var azDateNow = azCalendar.getDate();
    azCalendar.option('select', function(startDate, endDate) {
        $('#modalSetSchedule').modal('show');
        $('#mainEventStartDate').val(startDate.format('LL'));
        $('#EventEndDate').val(endDate.format('LL'));
        $('#mainEventStartTime').val(startDate.format('LT')).trigger('change');
        $('#EventEndTime').val(endDate.format('LT')).trigger('change');
    });
    // Display calendar event modal
    azCalendar.on('eventClick', function(calEvent, jsEvent, view) {
        var modal = $('#modalCalendarEvent');
        modal.modal('show');
        if (calEvent.description) {
            modal.find('.event-desc').text(calEvent.description);
            modal.find('.event-desc').prev().removeClass('d-none');
        } else {
            modal.find('.event-desc').text('');
            modal.find('.event-desc').prev().addClass('d-none');
        }
        modal.find('.event-title').text(calEvent.title);
        modal.find('.event-start-date').text(moment(calEvent.start).format('LLL'));
        modal.find('.event-end-date').text(moment(calEvent.end).format('LLL'));
        modal.find('.event-address').text(calEvent.address);
        console.log(calEvent.inc)
        console.log(calEvent.smme)
        console.log(calEvent.bdsp)
        modal.find('.event-user').text(calEvent.inc.length > 0 ? calEvent.inc + " (Incubator)" : calEvent.smme + " (MSME)");
        modal.find('.event-user').text(calEvent.bdsp.length > 0 ? calEvent.bdsp + " (BDSP)" : (calEvent.smme.length > 0 ? calEvent.smme + " (MSME)" : calEvent.inc + " (Incubator)"));
        //styling
        modal.find('.modal-header').css('backgroundColor', (calEvent.source.borderColor) ? calEvent.source.borderColor : calEvent.borderColor);

        modal.find(".ion-md-trash").parent().attr("href", "<?= site_url('admin/Calendar/delete/') ?>" + calEvent.id)
        modal.find(".ion-md-open").parent().attr("href", "<?= site_url('admin/Calendar/edit/') ?>" + calEvent.id)
    });
    // Enable/disable calendar events from displaying in calendar
    $('.main-nav-calendar-event a').on('click', function(e) {
        e.preventDefault();
        console.log(events)
        if ($(this).hasClass('exclude')) {
            $(this).removeClass('exclude');
            console.log(azCalendar)
            $(this).is(':first-child') ? azCalendar.addEventSource(events[0]) : '';
            $(this).is(':nth-child(2)') ? azCalendar.addEventSource(events[1]) : '';
            $(this).is(':nth-child(3)') ? azCalendar.addEventSource(events[2]) : '';
            $(this).is(':nth-child(4)') ? azCalendar.addEventSource(events[3]) : '';
            $(this).is(':nth-child(5)') ? azCalendar.addEventSource(events[4]) : '';
            $(this).is(':nth-child(6)') ? azCalendar.addEventSource(events[5]) : '';
            $(this).is(':nth-child(7)') ? azCalendar.addEventSource(events[6]) : '';
        } else {
            $(this).addClass('exclude');
            $(this).is(':first-child') ? azCalendar.removeEventSource(1) : '';
            $(this).is(':nth-child(2)') ? azCalendar.removeEventSource(2) : '';
            $(this).is(':nth-child(3)') ? azCalendar.removeEventSource(3) : '';
            $(this).is(':nth-child(4)') ? azCalendar.removeEventSource(4) : '';
            $(this).is(':nth-child(5)') ? azCalendar.removeEventSource(5) : '';
            $(this).is(':nth-child(6)') ? azCalendar.removeEventSource(6) : '';
            $(this).is(':nth-child(7)') ? azCalendar.removeEventSource(7) : '';
        }
        azCalendar.render();
        if (window.matchMedia('(max-width: 575px)').matches) {
            $('body').removeClass('main-content-left-show');
        }
    });
})
</script>