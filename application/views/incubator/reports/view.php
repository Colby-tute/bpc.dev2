<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?= $header; ?>
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/rating/ratings.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/rating/themes/bars-1to10.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/rating/themes/bars-movie.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/rating/themes/bars-square.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/rating/themes/bars-pill.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/rating/themes/bars-reversed.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/rating/themes/bars-horizontal.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/rating/themes/fontawesome-stars.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/rating/themes/css-stars.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/rating/themes/bootstrap-stars.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/rating/themes/fontawesome-stars-o.css">
<style>
    .select2 {
        width: 100% !important;
    }
    .box-body {
        text-align: center;
    }
</style>
<style type="text/css">
    .box-example-movie .br-wrapper {
        width: 320px;
        position: absolute;
        margin: 0px 0 0 -125px;
        left: 45%;
    }
    .br-current-rating {
        width: unset!important;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/css/bootstrap-datepicker.min.css" rel="stylesheet">
<div class="container">
	<div class="breadcrumb-header justify-content-between">
		<div>
			<h4 class="content-title mb-2">Evaluations</h4>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= site_url('incubator/home') ?>">Dashboard</a></li>
					<li class="breadcrumb-item active" aria-current="page">View Evaluation</li>
				</ol>
			</nav>
		</div>
		
		<div class="my-auto breadcrumb-right">
			<button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-envelope mr-2"></i></span><span class="btn-text">Email </span></button>
			<button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-print mr-2"></i> </span><span class="btn-text">Print </span></button>
			<!--<a class="btn btn-success mr-0" href="<?= site_url('incubator/Reports/create') ?>"><span
					class="icon-label"></span><span class="btn-text">Evaluate </span></a> -->
		</div>
	</div>

	<div class="">
		<!-- row opened -->
		<div class="row row-sm">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
				<div class="card">
					<div class="card-body iconfont text-left">
						<?php if ($this->session->flashdata('danger')) { ?>
							<div id="infoMessage" class="alert alert-danger"
								 style="margin-top: 25px;"><?php echo $this->session->flashdata('danger'); ?></div>
						<?php } ?>
						<?php echo form_open_multipart("incubator/Reports/create", 'class="login" data-toggle="validator"'); ?>
						<input type="hidden" name="report[reporter_id]" value="<?= $this->session->userdata('id_user') ?>">
						<div class="row">
							<div class="col-sm-12">
								<h3 style="margin-bottom: 20px">Submitter : <?= $user->tbl_users_firstname ?>  <?= $user->tbl_users_lastname ?></h3>
							</div>

							<?php foreach($evaluation as $key => $value) : ?>
								<?php if (!isset($questions[$key])) {
									continue;
								} else {
									$question = $questions[$key];
								}?>
								
								<div class="col-sm-6 col-md-6">
	                                <div class="card custom-card">
	                                    <div class="card-body">
	                                        <div>
	                                            <h6 class="card-title mb-1"><?= $question ?></h6>
	                                        </div>
	                                        <div class="box box-example-movie" style="pointer-events: none!important">
	                                            <div class="box-body">
	                                                <select id="<?= $key ?>" name="rating" autocomplete="off">
	                                                    <option <?= $value == 1 ? 'selected' : '' ?> class="<?= $value == 1 ? 'br-selected' : '' ?>"  value="1" data-rating-text="Not at all Satisfied">Not at all Satisfied</option>
	                                                    <option <?= $value == 2 ? 'selected' : '' ?> class="<?= $value == 2 ? 'br-selected' : '' ?>"  value="2" data-rating-text="Not at all Satisfied">Partly Satisfied</option>
	                                                    <option <?= $value == 3 ? 'selected' : '' ?> class="<?= $value == 3 ? 'br-selected' : '' ?>"  value="3" data-rating-text="Not at all Satisfied">Satisfied</option>
	                                                    <option <?= $value == 4 ? 'selected' : '' ?> value="4" class="<?= $value == 4 ? 'br-selected' : '' ?>"  data-rating-text="Not at all Satisfied">More than Satisfied</option>
	                                                    <option value="5" class="<?= $value == 5 ? 'br-selected' : '' ?>" <?= $value == 5 ? 'selected' : '' ?> data-rating-text="Not at all Satisfied">Very Satisfied </option>
	                                                </select>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
                        	<?php endforeach; ?>


                        		<div class="col-sm-12 col-md-12">
	                                <div class="card custom-card">
	                                    <div class="card-body">
	                                        <div>
	                                            <h6 class="card-title mb-1">Comment</h6>
	                                        </div>
	                                        <div class="box box-example-movie" style="pointer-events: none!important">
	                                            <div class="box-body">
													<p><?= $evaluation->comment ?></p>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>


						</div>
						<?php echo form_close(); ?>
					</div>

				</div>
			</div>
		</div>
		<!-- row closed -->
	</div>
</div>
<?= $footer; ?>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.min.js"></script>
<script>
	$("#incubators").select2()
	$(".datepicker").datepicker({
		format: "yyyy-mm-dd"
	})
</script>
<script src="<?= base_url() ?>assets/plugins/rating/jquery.rating-stars.js"></script>

<!-- Rating js-->
<script src="<?= base_url() ?>assets/plugins/rating/jquery.rating-stars.js"></script>
<script src="<?= base_url() ?>assets/plugins/rating/jquery.barrating.js"></script>
<script src="<?= base_url() ?>assets/plugins/rating/ratings.js"></script>

<!-- Rating js-->
<script src="<?= base_url() ?>assets/plugins/rating/jquery.rating-stars.js"></script>
<script src="<?= base_url() ?>assets/plugins/rating/jquery.barrating.js"></script>
<script type="text/javascript">
    $(function () {
        $('document').ready(function(){

                let phases = JSON.parse('<?= $json ?>')

                $.each(phases, function(key, phase) {
                    if (phase.value == "1") {
                        $('#'+phase.id).barrating('set', '1');
                    } 
                    else if (phase.value == "2") {
                        $('#'+phase.id).barrating('set', '2');
                    }
                    else if (phase.value == "3") {
                        $('#'+phase.id).barrating('set', '3');
                    }
                    else if (phase.value == "4") {
                        $('#'+phase.id).barrating('set', '4');
                    }
                    else if (phase.value == "5") {
                        $('#'+phase.id).barrating('set', '5');
                    }
                    $('#'+phase.id).barrating('show', {
                        theme: 'bars-movie'
                    });
                })
            })

    })
</script>
