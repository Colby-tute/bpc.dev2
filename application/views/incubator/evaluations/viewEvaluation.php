<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>
<?= $header; ?>
<link href="<?php echo base_url(); ?>assets/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet"/>

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
<div class="container">
	<div class="breadcrumb-header justify-content-between">
		<div>
			<h4 class="content-title mb-2">Evaluations / <?= $evaluation_details->evaluatee_firstname.' '.$evaluation_details->evaluatee_lastname.' ('.$evaluation_details->uniqueid.')' ?> </h4>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= site_url('incubator/home') ?>">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="<?= site_url('incubator/Evaluations/viewEvaluations') ?>">Evaluations</a></li>
					<li class="breadcrumb-item" aria-current="page">View Evaluation</li>
				</ol>
			</nav>
		</div>
		<div class="my-auto breadcrumb-right">
							<a href="<?= site_url('incubator/Evaluations/viewEvaluations') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-arrow-circle-left mr-2"></i></span><span class="btn-text">Go Back </span></button></a>
							<a href="<?= site_url('incubator/Profile/view_profile/'.$this->session->userdata('id_user')) ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Personal Details </span></button></a>
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
						<div id="infoMessage"
							 class="alert alert-danger mt25"><?php echo $this->session->flashdata('danger'); ?></div>
						<?php } else if ($this->session->flashdata('success')) { ?>
							<div id="infoMessage"
								 class="alert alert-success mt25"><?php echo $this->session->flashdata('success'); ?></div>
						<?php }
						?>
						</p>
						<div class="row">
                            <div class="col-md-6">
                                <label class="form-label label_font">Evaluation Title</label>
                                 <b class="b_font"><?= $evaluation_details->evaluation_title ?></b>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label label_font">Evaluation Description</label>
                                 <?= $evaluation_details->evaluation_desc ?>
                            </div>	
						</div>
						<div class="row">
							<div class="col-sm-3" style="margin-top: 15px">
								<label class="form-label label_font">Evaluation Response</label>
							</div>
	                        <input type="hidden" name="evaluation[evaluator_id]" value="<?= $evaluator_id ?>">
	                        <input type="hidden" name="evaluation[evaluatee_id]" value="<?= $evaluatee_id ?>">
                        </div>
                        <div class="row">
							<?php
							$index=0;
							if (isset($evaluation)) {
								foreach ($evaluation as $key => $evaluation_info) {
									?>
		                            <div class="col-sm-6 col-md-6">
		                                <div class="card custom-card">
		                                    <div class="card-body">
		                                        <div class="box box-example-movie" style="">
		                                            <div class="box-body">
		                                                <label for=""><?= $evaluation_info->question_text ?></label>
		                                                <select name="evaluation[answers][<?= $evaluation_info->evaluation_question_id ?>]" id="rating_<?= $key ?>" class="form-control">
		                                                    <option value="1">Not at all Satisfied</option>
		                                                    <option value="2">Partly Satisfied</option>
		                                                    <option value="3">Satisfied</option>
		                                                    <option value="4">More than Satisfied</option>
		                                                    <option value="5">Very Satisfied</option>
		                                                </select>
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>
							<?php
								}
							}
							?>
						</div>
						<div class="row">
                            <div class="col-md-12">
                                <label class="form-label label_font">Evaluation Comment</label>
                                 <?= $evaluation_details->evaluation_comments ?>
                            </div>	
							<!-- <div class="col-sm-12" style="margin-top: 15px">
								<button class="btn btn-primary sub">Back</button>
							</div> -->
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- row closed -->
	</div>
</div>
<?= $footer; ?>
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

        $("#evaluatee_id").select2();	

        var answersList = <?php echo json_encode($evaluation) ?>;
        console.log(answersList.length);
        for (let i = 0; i < answersList.length; i++) {
        	console.log("index: " + i);
        	console.log("rating: "+answersList[i]["evaluation_answer"]);
            $('#rating_' + i).barrating('show', {
                theme: 'bars-movie'
            });
        	$("#rating_" + i).barrating('readonly', true);
            $("#rating_" + i).barrating("set", answersList[i]["evaluation_answer"])	
        }

    });		
</script>