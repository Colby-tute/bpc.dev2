<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>

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

		<!-- Icons css -->
        <link href="<?php echo base_url()."/"; ?>assets/css/icons.css" rel="stylesheet">

        <!--  Right-sidemenu css -->
        <link href="<?php echo base_url()."/"; ?>assets/plugins/sidebar/sidebar.css" rel="stylesheet">

        <!--  Custom Scroll bar-->
        <link href="<?php echo base_url()."/"; ?>assets/plugins/mscrollbar/jquery.mCustomScrollbar.css" rel="stylesheet"/>

        <!--  Left-Sidebar css -->
        <link rel="stylesheet" href="<?php echo base_url()."/"; ?>assets/plugins/side-menu/closed/sidemenu.css">

        <!--- Dashboard-1 css-->
        <link href="<?php echo base_url()."/"; ?>assets/css/bootstrap-custom.css" rel="stylesheet">
        <link href="<?php echo base_url()."/"; ?>assets/css/style.css" rel="stylesheet">
        <link href="<?php echo base_url()."/"; ?>assets/css/style-dark.css" rel="stylesheet">

        <!--- Animations css-->
        <link href="<?php echo base_url()."/"; ?>assets/css/animate.css" rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/telephoneinput/telephoneinput.css">

        <link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet"> 

        <link rel="icon" href="<?php echo base_url(); ?>assets/img/brand/favicon.ico" type="image/x-icon"/>

	</head>
	<body class="main-body">

		<!-- Loader -->
		<div id="global-loader">
			<img src="<?php echo base_url()."/"; ?>assets/img/loader.svg" class="loader-img" alt="Loader" />
		</div>
		<!-- /Loader -->

		<div class="page">

			<!-- main-signin-wrapper -->
			<div class="my-auto page page-h">
				<div class="main-signin-wrapper">
					<div class="main-card-signin d-md-flex wd-100p">
					<div class="wd-md-50p login d-none d-md-block page-signin-style p-5 text-white" >
						<div class="my-auto authentication-pages">
							<div>
								<a href="<?php echo base_url('Registration');?>"><img src="<?php echo base_url()."/"; ?>assets/img/brand/logo-white.png" class="main-logo-pages m-0 mb-4" alt="logo"></a>
								<h5 class="mb-4">All the tools you need for your business incubation needs.</h5>
                                <p class="mb-5" style="text-align: justify;text-justify: distribute;text-align-last: left;">The Virtual Business Incubator is a BEDCO initiative to support Enterprise Development and drive entrepreneurship changes in Lesotho. Development, support, networks and resources form the core of this ground-breaking initiative - everything you need to get your vision off the ground.</p>
                                <a href="tel:+26622216100" class="btn btn-pink">HelpDesk | +266 2221 6100</a>
							</div>
						</div>
					</div>
					<div class="sign-up-body wd-md-50p">
						<div class="main-signin-header">
							<h2>Profile Registration</h2>
							<?php if ($this->session->flashdata('success')) { ?>
                                 <div id="infoMessage" class="alert alert-success"><?php echo $this->session->flashdata('success');?></div>
                            <?php }else if($this->session->flashdata('danger')) { ?>
                                <div id="infoMessage" class="alert alert-danger"><?php echo $this->session->flashdata('danger');?></div>
                            <?php } ?>
							<?php echo form_open_multipart("Registration/add", 'class="login" data-toggle="validator"'); ?>

								<!-- <div class="form-group">
									<label for="image">Upload Your Photo</label>
									<input type="file" name="image" id="image" class="form-control">
								</div> -->
								<div class="form-group">
									<label for="type">Select Profile Type <b style="color: red">*</b></label>
									<select id="type" name="type" class="form-control" required="">
										<?php
										foreach ($type as $key => $value) { ?>
											<option value="<?php echo $value->tbl_roles_id; ?>">
												<?php
													$tbl_roles_title = strtolower($value->tbl_roles_title);
													if($tbl_roles_title == "smme")
													{
														echo "MSME";
													}
													else if($tbl_roles_title == "bdsp")
													{
														echo 'BDSP | COACH | MENTOR';
													}
													else 
													{
														echo $value->tbl_roles_title;
													}
														
												?>
											</option>
										<?php }
										?>
									</select>
								</div>
								<div class="form-group">
									<label for="firstname">Full Name <b style="color: red">*</b></label>
									<div class="row">
										<div class="col-md-6">
											<input class="form-control" placeholder="Firstname" type="text" name="firstname" id="firstname" required="">
										</div>
										<div class="col-md-6">
											<input class="form-control" placeholder="Lastname" type="text" name="lastname" id="lastname" required="">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label id="email">Email Address<b style="color: red">*</b></label> 
									<input class="form-control" placeholder="youremail@domain.com" type="email" name="email" id="email" required="">
								</div>
								<div class="form-group">
									<label id="password">Password <b style="color: red">*</b></label> 
									<input class="form-control" placeholder="********" type="password" name="password" id="password" required="">
								</div>
								<div class="form-group">
									<label for="mobile_no">Mobile Number <b style="color: red">*</b></label>
									<input class="form-control" maxlength="10" id="phone" name="mobile_no" required type="tel" placeholder="9876543210">
                                    <input type="hidden" name="contrycode" id="contrycode" class="form-control" value="ls-266">
								</div>
								<!-- <div class="form-group">
									<label for="gender">Select Gender <b style="color: red">*</b></label>
									<input type="radio" name="gender" id="M" value="M" required=""><label for="M">Male</label>
									<input type="radio" name="gender" id="F" value="F"><label for="F">Female</label>
									<input type="radio" name="gender" id="O" value="O"><label for="O">Other</label>
								</div> -->
								<button class="btn btn-main-primary btn-block">Create Account</button>
							<?php echo form_close(); ?>
						</div>
						<div class="main-signup-footer mg-t-10">
							<p>Already have an account? <a href="<?php echo base_url('Login');?>">Sign In</a></p>
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

        <script src="<?php echo base_url(); ?>assets/plugins/telephoneinput/telephoneinput.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/telephoneinput/inttelephoneinput.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

        <script type="text/javascript">
        	$('document').ready(function(){
        		$('.js-example-basic-single').select2();

        		$('.iti__selected-flag .iti__flag').removeClass('iti__us').addClass('iti__ls');

                $('#country-listbox li').click(function() {
                    var country_code = $(this).data("dial-code");
                    var country_code_flag = $(this).data("country-code");
                    $('#contrycode').val(country_code_flag+'-'+country_code);
                });
        	});
        </script>

	</body>
</html>