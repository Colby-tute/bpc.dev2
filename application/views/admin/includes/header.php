<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
        <title>Incuflex :: Business Plan Competition <?php if (!empty($page_title)) { echo $page_title; } else { echo "Incubator"; } ?> </title>

        <!-- Favicon -->
        <link rel="icon" href="<?php echo base_url(); ?>assets/img/brand/favicon.ico" type="image/x-icon"/>

        <!-- Icons css -->
        <link href="<?php echo base_url(); ?>assets/css/icons.css" rel="stylesheet">

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/telephoneinput/telephoneinput.css">

        <link href="<?php echo base_url(); ?>assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/plugins/pickerjs/picker.min.css" rel="stylesheet">

        <link href="<?php echo base_url(); ?>assets/css/custom.css?v=1.2" rel="stylesheet">        

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
                        <a class="header-brand" href="<?= site_url('admin/home') ?>">
                            <img src="<?php echo base_url(); ?>assets/img/brand/logo-white.png" class="desktop-dark">
                            <img src="<?php echo base_url(); ?>assets/img/brand/logo.png" class="desktop-logo">
                            <img src="<?php echo base_url(); ?>assets/img/brand/favicon.png" class="desktop-logo-1">
                            <img src="<?php echo base_url(); ?>assets/img/brand/favicon-white.png" class="desktop-logo-dark">
                        </a>
                        <div class="main-header-center ml-5">
                            <input class="form-control" placeholder="Search" type="text" id="search-key" onkeyup="search(event);"> <button type="button" class="btn" onclick="search_result();"><i class="fas fa-search"></i></button>
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
                                <a class="new nav-link full-screen-link" href="#"><i class="typcn typcn-arrow-minimise"></i></span></a>
                            </div>
							
							
							<!-- full-screen -->
							<div class="dropdown nav-item main-header-message ">
                                <a class="new nav-link" href="#"><i class="typcn typcn-bell" ></i></a>
                                <div class="dropdown-menu">
                                    <div class="menu-header-content bg-primary text-left d-flex">
                                        <div class="">
                                            <h6 class="menu-header-title text-white mb-0">Notification Centre</h6>
                                        </div>
                                        <div class="my-auto ml-auto">
                                            <span class="badge badge-pill badge-warning float-right">Broadcast</span>
                                        </div>
                                    </div>
                                    <div class="main-message-list chat-scroll">
                                        <a href="<?=site_url('admin/Broadcast/index') ?>" class="p-3 d-flex border-bottom">
                                       <div class="wd-90p">
                                            <div class="d-flex">
                                                <h5 class="mb-1 name">Broadcast Messages</h5>
                                                </div>
                                            <p class="mb-0 desc">Sending broadcast messages to all system users.</p>
                                        </div>
                                    </a>
                                   
                                                                
                                    
                                    </div>
                                    <div class="text-center dropdown-footer">
                                       
                                    </div>
                                </div>
                            </div><!-- message -->
                            <div class="dropdown nav-item main-header-message ">
                                <a class="new nav-link" href="#"><i class="typcn typcn-support" ></i></a>
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
                            </div>
                            <!-- notification -->
                            <?php 
                                if (empty($this->session->userdata('admin_profile_image')) || $this->session->userdata('admin_profile_image') == '') { 
                            ?>

                                    <div class="dropdown main-profile-menu nav nav-item nav-link">
                                    <a class="profile-user" href="">
                                        <div class="demo-avatar-group avatar-list">
                                                <div class="avatar bg-secondary rounded-circle">
                                                    <?php echo substr(ucfirst($this->session->userdata('adminfname')),0,1).substr(ucfirst($this->session->userdata('adminlname')),0,1);?>
                                                </div>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu">
                                       
                                        <div class="main-header-profile header-img">
                                            <div class="demo-avatar-group avatar-list">
                                                <div class="avatar avatar-lg bg-secondary rounded-circle">
                                                    <?php echo substr(ucfirst($this->session->userdata('adminfname')),0,1).substr(ucfirst($this->session->userdata('adminlname')),0,1);?>
                                                </div>
                                            </div>
                                        </div>
                                        <a class="dropdown-item" href="<?= site_url('admin/Home/profile') ?>"><i class="far fa-user"></i> View Profile</a>

                                        <a href="<?= site_url('admin/Home/profile') ?>" class="dropdown-item"><i class="mdi mdi-account-edit font_size"></i>Edit Profile</a>
                                        <a href="<?= site_url('admin/change_password') ?>" class="dropdown-item" ><i class="mdi mdi-account-key font_size"></i>Change Password</a>
                                     
                                        <a class="dropdown-item" href="<?= site_url('admin/activity_log') ?>"><i class="far fa-clock"></i> Activity Logs</a>
                                       
                                        <a class="dropdown-item" href="<?= site_url('admin/Home/logout') ?>"><i class="fas fa-sign-out-alt"></i> Sign Out</a>
                                    </div>
                                    </div>
                                <?php
                               }else
                               {
                               ?>
                                 <div class="dropdown main-profile-menu nav nav-item nav-link">
                                    <a class="profile-user" href=""><img alt="" src="<?php echo base_url(); ?>assets/admin/<?php echo $this->session->userdata('admin_profile_image'); ?>"></a>
                                            <div class="dropdown-menu">
                                                <div class="main-header-profile header-img">
                                                    <div class="main-img-user"><img alt="" src="<?php echo base_url(); ?>assets/admin/<?php echo $this->session->userdata('admin_profile_image'); ?>"></div>
                                                    <h6><?php echo ucfirst($this->session->userdata('adminfname')).' '.ucfirst($this->session->userdata('adminlname'));?></h6><span><?php echo $this->session->userdata('admin_type_name');?></span>
                                                </div>
                                        <a class="dropdown-item" href="<?= site_url('admin/Home/profile') ?>"><i class="far fa-user"></i> View Profile</a>


                                        <a href="<?= site_url('admin/Home/profile') ?>" class="dropdown-item"><i class="mdi mdi-account-edit font_size"></i>Edit Profile</a>
                                        <a href="<?= site_url('admin/change_password') ?>" class="dropdown-item" ><i class="mdi mdi-account-key font_size"></i>Change Password</a>

                                       
                                        <a class="dropdown-item" href="<?= site_url('admin/activity_log') ?>"><i class="far fa-clock"></i> Activity Logs</a>
                                  
                                        
                                        <a class="dropdown-item" href="<?= site_url('admin/Home/logout') ?>"><i class="fas fa-sign-out-alt"></i> Sign Out</a>
                                        
                                    </div>
                            </div>
                            <?php } ?>
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
                                
                                    <li aria-haspopup="true"><a href="<?= site_url('admin/home') ?>" class=""><i class="typcn typcn-home menu-icon"></i>Dashboard </a></li>

                                    <li aria-haspopup="true"><a href="#" class="sub-icon"><i class="typcn typcn-briefcase menu-icon"></i>Packages<i class="fe fe-chevron-down horizontal-icon"></i></a>
                                        <ul class="sub-menu">
                                            <li aria-haspopup="true"><a href="<?= site_url('package/entry') ?>" class="">Manage</a></li>
                                            <li aria-haspopup="true"><a href="<?= site_url('package/assign') ?>" class="">Assign Package</a></li>
                                            
                                        </ul>

                                    </li>
                                    <li aria-haspopup="true"><a href="#" class="sub-icon"><i class="typcn typcn-user menu-icon"></i>Users<i class="fe fe-chevron-down horizontal-icon"></i></a>
                                        <ul class="sub-menu">
                                            <li aria-haspopup="true"><a href="<?= site_url('admin/smme/application') ?>" class="">Incubation & Status</a></li>
                                            <li aria-haspopup="true"><a href="<?= site_url('admin/incubators') ?>" class="">Incubator Managers</a></li>
                                            <li aria-haspopup="true"><a href="<?= site_url('admin/smme') ?>">MSME Management</a></li>
                                            <li aria-haspopup="true"><a href="<?= site_url('admin/bdsps') ?>" class="">Coaches & Mentors</a></li>
                                        </ul>
                                    </li>
                                    
                                    <li aria-haspopup="true"><a href="#" class="sub-icon"><i class="typcn typcn-document-add menu-icon"></i>Competitions<i class="fe fe-chevron-down horizontal-icon"></i></a>
                                        <ul class="sub-menu">
                                            <li aria-haspopup="true"><a href="<?= site_url('admin/smme/application') ?>" class="">Entries</a></li>
                                            <li aria-haspopup="true"><a href="<?= site_url('admin/smme/application') ?>" class="">Manage</a></li>
                                            <li aria-haspopup="true"><a href="<?= site_url('admin/competition') ?>" class="">Settings</a></li>
                                        </ul>

                                    </li>


                                    <li aria-haspopup="true"><a href="#" class="sub-icon"><i class="typcn typcn-briefcase menu-icon"></i>Operations <i class="fe fe-chevron-down horizontal-icon"></i></a>
                                        <ul class="sub-menu">
                                            
                                            
                                            <li aria-haspopup="true"><a href="<?= site_url('admin/calendar') ?>" class="sub-icon">Calendar & Events</a></li>                                           <li aria-haspopup="true"><a href="<?= site_url('admin/incubators/Incubators/bbm') ?>" class="sub-icon">Business Building Model</a>
                                            <li aria-haspopup="true">
                                                <a href="<?= site_url('admin/Broadcast/index') ?>" class="">Message Broadcast </a>
                                            </li>
                                            <li aria-haspopup="true"><a href="<?= site_url('admin/incubation/Incubation/incubationList') ?>" class="">Incubator Programmes</a></li>
										
                                        </ul>
                                    </li>

                                    
                                    <li aria-haspopup="true"><a href="#" class="sub-icon"><i class="typcn typcn-point-of-interest menu-icon"></i>Resources <i class="fe fe-chevron-down horizontal-icon"></i></a>
                                        <ul class="sub-menu">
                                            <li aria-haspopup="true"><a href="<?= site_url('admin/SearchBlogs') ?>" class="">Knowledge Centre</a></li>    
                                            <li aria-haspopup="true"><a href="<?= site_url('admin/faq') ?>" class="">Frequently Asked Questions</a></li>               
                                            <li aria-haspopup="true"><a href="<?= site_url('admin/smme/Smme/directory') ?>" class="">MSME Directory</a></li>
                                            <li aria-haspopup="true"><a href="<?= site_url('admin/Repositories/index') ?>" class="">Repositories</a></li>

                                        </ul>
                                    </li>
					
                                    <li aria-haspopup="true"><a href="#" class="sub-icon"><i class="typcn typcn-chart-pie menu-icon"></i> Monitoring & Reports <i class="fe fe-chevron-down horizontal-icon"></i></a>
                                        <ul class="sub-menu">
                                            <li aria-haspopup="true"><a href="<?= site_url('/admin/Analytics/registrationsReport') ?>" class="">Registration</a></li>
                                            <li aria-haspopup="true"><a href="<?= site_url('/admin/Analytics/demographicsReport') ?>" class="">Demographics</a></li>
                                            <li aria-haspopup="true"><a href="<?= site_url('/admin/Analytics/incubationStatusReport') ?>" class="">Incubation Status</a></li>
                                            <li aria-haspopup="true"><a href="<?= site_url('/admin/Analytics/channelsReport') ?>" class="">Channels</a></li>
                                            <li aria-haspopup="true"><a href="<?= site_url('/admin/Analytics/securityReport') ?>" class="">Security</a></li>
                                            <li aria-haspopup="true"><a href="<?= site_url('/admin/Analytics/evaluationReport') ?>" class="">Evaluations</a></li>
                                            <li aria-haspopup="true"><a href="<?= site_url('/admin/Analytics/incubationProgressReport') ?>" class="">Incubation Progress</a></li>
                                            <li aria-haspopup="true"><a href="<?= site_url('/admin/Analytics/investmentReport') ?>" class="">Revenues & Investment</a></li>
                                             <li aria-haspopup="true"><a href="<?= site_url('/admin/Analytics/activitylogReport') ?>" class="">Activity Log</a></li>
                                        </ul>                                        
                                    </li>
                                    <li aria-haspopup="true"><a href="#" class="sub-icon"><i class="typcn typcn-cog menu-icon"></i> General Settings <i class="fe fe-chevron-down horizontal-icon"></i></a>
                                        <ul class="sub-menu">
                                            <li aria-haspopup="true"><a href="<?= site_url('admin/incubation/Incubation/index') ?>" class="">Programmes</a></li>
                                            <li aria-haspopup="true"><a href="<?= site_url('admin/EmailTemplate/index') ?>" class="">Notifications</a></li>
					<hr>
					<li aria-haspopup="true"><a href="<?= site_url("admin/incubation/Incubation/stages") ?>" class="">Stages</a></li>
					<li aria-haspopup="true"><a href="<?= site_url('admin/role') ?>" class="">Users & Roles</a></li>
                                    <li aria-haspopup="true"><a href="<?= site_url('admin/role_rights') ?>" class="">Permissions</a></li>   

<li aria-haspopup="true"><a href="<?= site_url('admin/adminmaster') ?>" class="">Administrators</a></li>						   
                            
                               

                     
                            </ul>
                        </nav>
                        <!--Nav-->
                    </div>
                </div>
            </div>
            <!--Horizontal-main -->
            <div class="main-content horizontal-content">
<script type="text/javascript">
    
   function search(event){
    if(event.keyCode === '13'){
        search_result();
    }
   }

   function search_result() {
    var value = $("#search-key").val();
    if(value === '' || value === null){
        return false;
    }
    window.location.href = "<?php echo site_url('admin/smme/Smme/directory');?>" +"?key="+value;
   }
</script>