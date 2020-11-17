<?php
defined('BASEPATH') or exit('No direct script access allowed');

?><!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="UTF-8">
	<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Virtual Business Incubation (VBI), a VBI is a platform that offers you the ability to access, manage, monitor and evaluate your incubation BEDCO offers you a platform for Data Management, Monitoring, Evaluation and Reporting portal for entrepreneurs, business incubators, mentors and coaches.">
	<meta name="Author" content="Standafric | admin@standafric.com">
	<meta name="Keywords" content="Small and Medium Enterprises, Entrepreneurship, Entrepreneurs, Incubators, Business Development Service Providers"/>

	<!-- Title -->
	<title>BEDCO :: Virtual Business Incubator </title>

	<!-- Favicon -->
	<link rel="icon" href="<?php echo base_url(); ?>assets/img/brand/favicon.ico" type="image/x-icon"/>

	<!-- Icons css -->
	<link href="<?php echo base_url(); ?>assets/css/icons.css" rel="stylesheet">

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/telephoneinput/telephoneinput.css">

	<link href="<?php echo base_url(); ?>assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/plugins/pickerjs/picker.min.css" rel="stylesheet">

	<link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">

	<link href="<?php echo base_url(); ?>assets/plugins/quill/quill.snow.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/plugins/quill/quill.bubble.css" rel="stylesheet">

	<link href="<?php echo base_url(); ?>assets/plugins/inputtags/inputtags.css" rel="stylesheet">


	<!--  Custom Scroll bar-->

	<!--  Sidebar css -->
	<link href="<?php echo base_url(); ?>assets/plugins/sidebar/sidebar.css" rel="stylesheet">

	<link href="<?php echo base_url(); ?>assets/plugins/mscrollbar/jquery.mCustomScrollbar.css" rel="stylesheet"/>

	<!--- Dashboard-1 css-->
	<link href="<?php echo base_url(); ?>assets/css/bootstrap-custom.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/style-dark.css" rel="stylesheet">

	<link href="<?php echo base_url(); ?>assets/css/animate.css" rel="stylesheet">
	<!--- Morris css-->
	<link href="<?php echo base_url(); ?>assets/plugins/morris.js/morris.css" rel="stylesheet">

</head>
<body class="main-body app">
<!-- Loader -->
<div id="global-loader">
	<img src="<?php echo base_url(); ?>assets/img/loader.svg" class="loader-img" alt="Loader">
</div>
<!-- /Loader -->
<?php /*var_dump($this->session->userdata);die; */ ?>
<div class="page">
<?php 

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1200)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
	redirect("Login");
}
$_SESSION['LAST_ACTIVITY'] = time();
?>
	<!-- main-header opened -->
	<div class="main-header nav nav-item hor-header">
		<div class="container">
			<div class="main-header-left ">
				<a class="animated-arrow hor-toggle horizontal-navtoggle"><span></span></a><!-- sidebar-toggle-->
				<a class="header-brand" href="<?= site_url('home') ?>">
					<img src="<?php echo base_url(); ?>assets/img/brand/logo-white.png" class="desktop-dark">
					<img src="<?php echo base_url(); ?>assets/img/brand/logo.png" class="desktop-logo">
					<img src="<?php echo base_url(); ?>assets/img/brand/favicon.png" class="desktop-logo-1">
					<img src="<?php echo base_url(); ?>assets/img/brand/favicon-white.png" class="desktop-logo-dark">
				</a>
				<div class="main-header-center ml-5">
					<input class="form-control" placeholder="Search" type="search">
					<button class="btn"><i class="fas fa-search"></i></button>
				</div>
			</div><!-- search -->
			<div class="main-header-right">
				<div class="nav nav-item  navbar-nav-right ml-auto">
					<form class="navbar-form nav-item my-auto d-lg-none" role="search">
						<div class="input-group nav-item my-auto">
							<input type="text" class="form-control" placeholder="Search">
							<span class="input-group-btn">
                                        <button type="reset" class="btn btn-default">
                                            <i class="ti-close"></i>
                                        </button>
                                        <button type="submit" class="btn btn-default nav-link">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </span>
						</div>
					</form>
					<div class="nav-item full-screen fullscreen-button">
						<a class="new nav-link full-screen-link" href="#"><i
									class="typcn typcn-arrow-minimise"></i></span></a>
					</div><!-- full-screen -->
					<div class="dropdown nav-item main-header-message ">
                                <a class="new nav-link" href="#"><i class="typcn typcn-mail" ></i><span class=" pulse-danger"></span></a>
                                <div class="dropdown-menu">
                                    <div class="menu-header-content bg-primary text-left d-flex">
                                        <div class="">
                                            <h6 class="menu-header-title text-white mb-0">Quick Help</h6>
                                        </div>
                                        <div class="my-auto ml-auto">
                                            <span class="badge badge-pill badge-warning float-right">Support Centre</span>
                                        </div>
                                    </div>
                                    <div class="main-message-list chat-scroll">
                                        <a href="#" class="p-3 d-flex border-bottom">
                                       <div class="wd-90p">
                                            <div class="d-flex">
                                                <h5 class="mb-1 name">HelpDesk</h5>
                                                </div>
                                            <p class="mb-0 desc">+266 2221 6100</p>
                                        </div>
                                    </a>
                                    <a href="#" class="p-3 d-flex border-bottom">
                                        
                                        <div class="wd-90p">
                                            <div class="d-flex">
                                                <h5 class="mb-1 name">Email Support</h5>
                                               
                                            </div>
                                            <p class="mb-0 desc">itadmin@bedco.org.ls</p>
                                        </div>
                                    </a>
                                    <a href="#" class="p-3 d-flex border-bottom">
                                        
                                        <div class="wd-90p">
                                            <div class="d-flex">
                                                <h5 class="mb-1 name">WhatsApp Support</h5>
                                               
                                            </div>
                                            <p class="mb-0 desc">+266 6206 5599</p>
                                        </div>
                                    </a>
                                   
                                    
                                    </div>
                                    <div class="text-center dropdown-footer">
                                        <!-- <a href="text-center">VIEW ALL</a> -->
                                    </div>
                                </div>
                            </div><!-- message -->
					<div class="dropdown nav-item main-header-notification">
                                <a class="new nav-link" href="#"><i class="typcn icon typcn-bell"></i><span class=" pulse"></span></a>
                                <div class="dropdown-menu">
                                    <div class="menu-header-content bg-primary text-left d-flex">
                                        <div class="">
                                            <h6 class="menu-header-title text-white mb-0">
											Virtual Incubator</h6>
                                        </div>
                                        <div class="my-auto ml-auto">
                                            <span class="badge badge-pill badge-warning float-right">3 Stages</span>
                                        </div>
                                    </div>
                                    <div class="main-notification-list Notification-scroll">
                                        <a class="d-flex p-3 border-bottom">
                                            <div class="ml-3">
                                                <h5 class="notification-label mb-1">Investigation Phase</h5>
                                                <div class="notification-subtext"> > Investigation</div>
                                            </div>
                                            <div class="ml-auto" >
                                                <i class="las la-angle-right text-right text-muted"></i>
                                            </div>
                                        </a>
                                        <a class="d-flex p-3 border-bottom">
                                           <div class="ml-3">
                                                <h5 class="notification-label mb-1">Development Phase</h5>
                                                <div class="notification-subtext"> > Feasibility</div>
												<div class="notification-subtext"> > Planning</div>
												<div class="notification-subtext"> > Introduction</div>
                                            </div>
                                            <div class="ml-auto" >
                                                <i class="las la-angle-right text-right text-muted"></i>
                                            </div>
                                        </a>
                                        <a class="d-flex p-3 border-bottom">
                                           
                                            <div class="ml-3">
                                                <h5 class="notification-label mb-1">Commercial Phase</h5>
                                                <div class="notification-subtext"> > Full Scale Production</div>
												<div class="notification-subtext"> > Maturity</div>
                                            </div>
                                            <div class="ml-auto" >
                                                <i class="las la-angle-right text-right text-muted"></i>
                                            </div>
                                        </a>
                                        
                                        
                                    </div>
                                    <div class="dropdown-footer">
                                        <!-- <a href="">VIEW ALL</a> -->
                                    </div>
                                </div>
                            </div><!-- notification -->
					<?php
					//$profile_image = $this->Home_modal->select_profile_image($this->session->userdata('id_user'));
					$profile_image = $this->session->userdata('user_profile_image');
					// print_r($profile_image);

					 if (empty($profile_image) || $profile_image == '') {
						?>

						<div class="dropdown main-profile-menu nav nav-item nav-link">
							<a class="profile-user" href="">
								<div class="demo-avatar-group avatar-list">
									<div class="avatar bg-secondary rounded-circle">
										<?php
										if ($this->session->userdata('username') != '') {
											$explode = explode(' ', $this->session->userdata('username'));
											echo substr(ucfirst($explode[0]), 0, 1) . substr(ucfirst($explode[1]), 0, 1);
										}
										?>
									</div>
								</div>
							</a>
							<div class="dropdown-menu">
								<!-- <div class="main-header-profile header-img">
                                                    <div class="main-img-user"><img alt="" src="<?php echo base_url(); ?>assets/users/<?php echo $this->session->userdata('user_profile_image'); ?>"></div>
                                                    <h6><?php echo ucfirst($this->session->userdata('user_type_name')) . ' - ' . $this->session->userdata('user_unique_id'); ?></h6><span><?php echo $this->session->userdata('username'); ?></span>
                                                </div> -->
								<div class="main-header-profile header-img">
									<div class="demo-avatar-group avatar-list">
										<div class="avatar avatar-lg bg-secondary rounded-circle">
											<?php
											if ($this->session->userdata('username') != '') {
												$explode = explode(' ', $this->session->userdata('username'));
												echo substr(ucfirst($explode[0]), 0, 1) . substr(ucfirst($explode[1]), 0, 1);
											}
											?>
										</div>
									</div>
									<h6><?php echo 'INCU-' . $this->session->userdata('user_unique_id'); ?></h6>
									<span><?php echo $this->session->userdata('username'); ?></span>
								</div>
								<a class="dropdown-item"
								   href="<?= site_url('incubator/Profile/view_profile/' . $this->session->userdata('id_user')) ?>"><i
											class="far fa-user"></i> View Profile</a>
								<a href="<?= site_url('incubator/Profile/edit_profile/' . $this->session->userdata('id_user')) ?>"
								   class="dropdown-item"><i class="mdi mdi-account-edit font_size"></i>Edit Profile</a>
								<a href="<?= site_url('change_password') ?>" class="dropdown-item"><i
											class="mdi mdi-account-key font_size"></i>Change Password</a>
								<a class="dropdown-item" href="<?= site_url('user/activity_log') ?>"><i
											class="far fa-clock"></i> Activity Logs</a>
								<a class="dropdown-item" href="<?= site_url('home/logout') ?>"><i
											class="fas fa-sign-out-alt"></i> Sign Out</a>
							</div>
						</div>
					<?php } else {
						?>
						<div class="dropdown main-profile-menu nav nav-item nav-link">
							<a class="profile-user" href=""><img alt=""
																 src="<?php echo base_url(); ?>assets/users/<?php echo $profile_image; ?>"></a>
							<div class="dropdown-menu">
								<div class="main-header-profile header-img">
									<div class="main-img-user"><img alt=""
																	src="<?php echo base_url(); ?>assets/users/<?php echo $profile_image; ?>">
									</div>
									<h6><?php echo 'INCU-' . $this->session->userdata('user_unique_id'); ?></h6>
									<span><?php echo $this->session->userdata('username'); ?></span>
								</div>
								<a class="dropdown-item"
								   href="<?= site_url('incubator/Profile/view_profile/' . $this->session->userdata('id_user')) ?>"><i
											class="far fa-user"></i> View Profile</a>
								<a href="<?= site_url('incubator/Profile/edit_profile/' . $this->session->userdata('id_user')) ?>"
								   class="dropdown-item"><i class="mdi mdi-account-edit font_size"></i>Edit Profile</a>
   								<a href="<?= site_url('change_password') ?>" class="dropdown-item"><i
											class="mdi mdi-account-key font_size"></i>Change Password</a>
								<a class="dropdown-item" href="<?= site_url('user/activity_log') ?>"><i
											class="far fa-clock"></i> Activity Logs</a>
								<a class="dropdown-item" href="<?= site_url('home/logout') ?>"><i
											class="fas fa-sign-out-alt"></i> Sign Out</a>
							</div>
						</div>
					<?php }
					?>
					<!-- profile -->
					<div class="dropdown main-header-message right-toggle">
						<a class="nav-link " data-toggle="sidebar-right" data-target=".sidebar-right">
							<i class="ion ion-md-menu tx-20 bg-transparent"></i>
						</a>
					</div><!-- right-toggle -->
				</div>
			</div>
		</div>
	</div>
	<!-- main-header closed -->
	<!--Horizontal-main -->
	<div class="sticky">
		<div class="horizontal-main hor-menu clearfix side-header">
			<div class="horizontal-mainwrapper container clearfix">
				<!--Nav-->
				<nav class="horizontalMenu clearfix">
					<ul class="horizontalMenu-list">
						<!-- SMME Users -->
						<li aria-haspopup="true"><a href="<?= site_url('incubator/home') ?>" class=""><i
										class="typcn typcn-home menu-icon"></i> Dashboard </a>
						</li>
						
						<li aria-haspopup="true"><a href="<?= site_url('incubator/BusinessDetails') ?>" class="sub-icon"><i class="typcn typcn-contacts menu-icon"></i>Business Details</a>
						</li>
						<li aria-haspopup="true"><a href="#" class="sub-icon"><i class="typcn typcn-document-add menu-icon"></i>Applications <i class="fe fe-chevron-down horizontal-icon"></i></a>
<ul class="sub-menu">
             <li aria-haspopup="true"><a href="<?= site_url('incubator/Application') ?>" class="">Incubation</a></li>


                                                </ul>

</li>
						
						
						
						
						<li aria-haspopup="true"><a href="#" class="sub-icon"><i
										class="typcn typcn-briefcase menu-icon"></i>Operations <i
										class="fe fe-chevron-down horizontal-icon"></i></a>
							<ul class="sub-menu">
							<li aria-haspopup="true"><a href="<?= site_url('incubator/Operations/indexsmme') ?>" class="">MSME Management</a></li>
									<!--<li aria-haspopup="true"><a href="<?= site_url('incubator/BusinessDetails/uploaddocMsme') ?>" class="">Upload Doc For MSME</a></li> -->
								<li aria-haspopup="true"><a href="<?= site_url('incubator/Operations/index') ?>" class="">BDSP, Coaches & Mentors</a></li>
								
								<li aria-haspopup="true"><a href="<?= site_url('incubator/BusinessDetails/bbm') ?>" class="">
									Business Building Model</a></li>
									<li aria-haspopup="true"><a href="<?= site_url('incubator/calendar') ?>" class="">Calendar & Events </a>
									<li aria-haspopup="true"><a href="<?= site_url('incubator/Operations/incubationstatus') ?>" class="">Incubation Progress </a>
						</li>
							</ul>
						</li>
						
						<li aria-haspopup="true"><a href="#" class="sub-icon"><i class="typcn typcn-point-of-interest menu-icon"></i> Resources  <i class="fe fe-chevron-down horizontal-icon"></i></a>
								<ul class="sub-menu">
								<li aria-haspopup="true"><a href="<?= site_url('incubator/Operations/allbdsp') ?>" class="">BDSP, Coaches & Mentors</a></li>
									<li aria-haspopup="true"><a href="<?= site_url('incubator/SearchBlogs') ?>" class="">Knowledge Centre</a></li>
									<li aria-haspopup="true"><a href="<?= site_url('incubator/FacilityManagement/viewBookings') ?>" class="">Facility Management</a>
										
									</li>
								</ul>										
						</li>
						<li aria-haspopup="true"><a href="<?= site_url('incubator/Evaluations/viewEvaluations') ?>" class="sub-icon"><i
										class="typcn typcn-thumbs-up menu-icon"></i> Evaluations</a>
								
						</li>
						<li aria-haspopup="true"><a href="#" class="sub-icon"><i class="typcn typcn-chart-pie menu-icon"></i> Monitoring & Reports <i class="fe fe-chevron-down horizontal-icon"></i></a>
                                        <ul class="sub-menu">
                                            <li aria-haspopup="true"><a href="<?= site_url('/incubator/Analytics/registrationsReport') ?>" class="">Registration</a></li>
                                            <li aria-haspopup="true"><a href="<?= site_url('/incubator/Analytics/demographicsReport') ?>" class="">Demographics</a></li>
                                            <li aria-haspopup="true"><a href="<?= site_url('/incubator/Analytics/incubationStatusReport') ?>" class="">Incubation Status</a></li>
                                            <li aria-haspopup="true"><a href="<?= site_url('/incubator/Analytics/channelsReport') ?>" class="">Channels</a></li>
                                            <li aria-haspopup="true"><a href="<?= site_url('/incubator/Analytics/securityReport') ?>" class="">Security</a></li>
                                            
                                       </li>
					</ul>
				</nav>
				<!--Nav-->
			</div>
		</div>
	</div>
	<!--Horizontal-main -->
	<div class="main-content horizontal-content">
