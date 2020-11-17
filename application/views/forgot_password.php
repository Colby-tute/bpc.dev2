<!DOCTYPE html>
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
        <link rel="icon" href="<?php echo base_url()."/"; ?>assets/img/brand/favicon.ico" type="image/x-icon"/>

        <!-- Icons css -->
        <link href="<?php echo base_url()."/"; ?>assets/css/icons.css" rel="stylesheet">

        <!--  Right-sidemenu css -->
        <link href="<?php echo base_url()."/"; ?>assets/plugins/sidebar/sidebar.css" rel="stylesheet">

        <!--  Custom Scroll bar-->
        <link href="<?php echo base_url()."/"; ?>assets/plugins/mscrollbar/jquery.mCustomScrollbar.css" rel="stylesheet"/>

        <!--  Left-Sidebar css -->
        <link rel="stylesheet" href="<?php echo base_url()."/"; ?>assets/plugins/side-menu/closed/sidemenu.css">

        <link rel="icon" href="<?php echo base_url(); ?>assets/img/brand/favicon.ico" type="image/x-icon"/>

        <!--- Dashboard-1 css-->
        <link href="<?php echo base_url()."/"; ?>assets/css/bootstrap-custom.css" rel="stylesheet">
        <link href="<?php echo base_url()."/"; ?>assets/css/style.css" rel="stylesheet">
        <link href="<?php echo base_url()."/"; ?>assets/css/style-dark.css" rel="stylesheet">

        <!--- Animations css-->
        <link href="<?php echo base_url()."/"; ?>assets/css/animate.css" rel="stylesheet">

    </head>
    <body class="main-body">

        <!-- Loader -->
        <div id="global-loader">
            <img src="<?php echo base_url()."/"; ?>assets/img/loader.svg" class="loader-img" alt="Loader">
        </div>
        <!-- /Loader -->

        <div class="page">

            <!-- main-signin-wrapper -->
            <div class="my-auto page">
                <div class="main-signin-wrapper">
                    <div class="main-card-signin forgot-password d-md-flex wd-100p">
                        <div class="wd-md-50p  page-signin-style p-md-5 p-4 text-white d-none d-md-block ">
                            <div class="my-auto authentication-pages">
                                <div>
                                    <a href="<?php echo base_url('ForgotPassword');?>"><img src="<?php echo base_url()."/"; ?>assets/img/brand/logo-white.png" class="main-logo-pages m-0 mb-4" alt="logo"></a>
                                    <h5 class="mb-4">All the tools you need for your business incubation needs.</h5>
                                    <p class="mb-5" style="text-align: justify;text-justify: distribute;text-align-last: left;">The Virtual Business Incubator is a BEDCO initiative to support Enterprise Development and drive entrepreneurship changes in Lesotho. Development, support, networks and resources form the core of this ground-breaking initiative - everything you need to get your vision off the ground.</p>
                                <a href="tel:+26622216100" class="btn btn-pink">HelpDesk | +266 2221 6100</a>
                                </div>
                            </div>
                        </div>
                        <div class="p-5 wd-md-50p">
                            <div class="main-signin-header">
                                <h2>Forgot Password!</h2>
                                <h4>Please enter your email</h4>
                                <?php if ($this->session->flashdata('email_not_sent')) { ?>
                                    <div id="infoMessage" class="alert alert-danger"><?php echo $this->session->flashdata('email_not_sent');?></div>
                                <?php }else if($this->session->flashdata('email_sent')) { ?>
                                    <div id="infoMessage" class="alert alert-success"><?php echo $this->session->flashdata('email_sent');?></div>
                                <?php } ?>
                                 <?php echo admin_form_open("ForgotPassword/send", 'class="login" data-toggle="validator"'); ?>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="youremail@domain.com" type="email" id="email" name="email" required="">
                                    </div>
                                    <button class="btn btn-main-primary btn-block">Send</button>
                                <?php echo form_close(); ?>
                            </div>
                            <div class="main-signup-footer mg-t-10">
                                <p>Forget it, <a href="<?php echo base_url('Login');?>"> Send me back</a> to the sign in screen.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /main-signin-wrapper -->
        </div>

        <!-- JQuery min js -->
        <script src="<?php echo base_url()."/"; ?>assets/plugins/jquery/jquery.min.js"></script>

        <!-- Bootstrap Bundle js -->
        <script src="<?php echo base_url()."/"; ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Ionicons js -->
        <script src="<?php echo base_url()."/"; ?>assets/plugins/ionicons/ionicons.js"></script>

        <!-- Moment js -->
        <script src="<?php echo base_url()."/"; ?>assets/plugins/moment/moment.js"></script>

        <!-- eva-icons js -->
        <script src="<?php echo base_url()."/"; ?>assets/js/eva-icons.min.js"></script>

        <!-- Rating js-->
        <script src="<?php echo base_url()."/"; ?>assets/plugins/rating/jquery.rating-stars.js"></script>
        <script src="<?php echo base_url()."/"; ?>assets/plugins/rating/jquery.barrating.js"></script>

        <!-- Custom js -->
        <script src="<?php echo base_url()."/"; ?>assets/js/custom.js"></script>

    </body>
</html>