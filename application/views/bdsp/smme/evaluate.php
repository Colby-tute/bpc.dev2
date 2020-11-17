<?php echo $header ?>
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
			<h4 class="content-title mb-2">MSME / <?= $smme[0]->name ?> <?= $smme[0]->last_name ?> / <?= $incubator[0]->name ?> <?= $incubator[0]->last_name ?></h4>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= site_url('bdsp/home') ?>">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="<?= site_url('bdsp/Operations') ?>">MSME Management</a></li>
					<li class="breadcrumb-item active" aria-current="page">MSME Evaluation</li>
				</ol>
			</nav>

		</div>
		
		<div class="my-auto breadcrumb-right">
							<a href="<?= site_url('bdsp/application') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-bell mr-2"></i></span><span class="btn-text">Status </span></button></a>
							<a href="<?= site_url('bdsp/Profile/view_profile/'.$this->session->userdata('id_user')) ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Personal Details </span></button></a>
							<button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-question-circle mr-2"></i> </span><span class="btn-text">Help </span></button>
						</div>


	</div>
	<div class="">
		<!-- row opened -->
		<div class="row row-sm">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
				<div class="card">
					<div class="card-body iconfont text-left">
						<form action="<?= site_url("/bdsp/Smme/evaluate/" . $smmeId) ?>" method="POST"
							  id="milestone_form">
							<input type="hidden" name="user_id" value="<?= $this->session->userdata('id_user') ?>">
							<input type="hidden" name="smme_id" value="<?= $smmeId ?>">
							<div class="row">
								<!--<div class="col-sm-12" style="margin-top: 15px">
									<label for=""><strong>SMME</strong></label>
									<p><strong><?= $smme[0]->name ?> <?= $smme[0]->last_name ?></strong></p>
								</div> -->

								<input type="hidden" name="incubator_id" value="<?= $incubator[0]->id ?>">
								<!-- <div class="col-sm-12" style="margin-top: 15px">
									<label for=""><strong>Incubator</strong></label>
									<p><strong><?= $incubator[0]->name ?> <?= $incubator[0]->last_name ?></strong></p>
								</div> -->

								<div class="col-sm-6 col-md-6">
                                    <div class="card custom-card">
                                        <div class="card-body">
                                            <div class="box box-example-movie"
                                                 style="">
                                                <div class="box-body">
									<label for="">Was this a useful engagement</label>
									<select name="was_useful" id="rating1" class="form-control">
										<option value="1">Not at all Satisfied</option>
                                                        <option value="2">Partly Satisfied</option>
                                                        <option value="3">Satisfied</option>
                                                        <option value="4">More than Satisfied</option>
                                                        <option value="5">Very Satisfied</option>
									</select>
								</div></div></div></div></div>

								<div class="col-sm-6 col-md-6">
                                    <div class="card custom-card">
                                        <div class="card-body">
                                            <div class="box box-example-movie"
                                                 style="">
                                                <div class="box-body">
									<label for="">Did the entrepreneur apply your recommendations</label>
									<select name="did_entre" id="rating2" class="form-control">
										<option value="1">Not at all Satisfied</option>
                                                        <option value="2">Partly Satisfied</option>
                                                        <option value="3">Satisfied</option>
                                                        <option value="4">More than Satisfied</option>
                                                        <option value="5">Very Satisfied</option>
									</select>
								</div></div></div></div></div>

								<div class="col-sm-6 col-md-6">
                                    <div class="card custom-card">
                                        <div class="card-body">
                                            <div class="box box-example-movie"
                                                 style="">
                                                <div class="box-body">
									<label for="">Did the MSME attend to the task / required inputs timely</label>
									<select name="did_smme_attend" id="rating3" class="form-control">
										<option value="1">Not at all Satisfied</option>
                                                        <option value="2">Partly Satisfied</option>
                                                        <option value="3">Satisfied</option>
                                                        <option value="4">More than Satisfied</option>
                                                        <option value="5">Very Satisfied</option>
									</select>
								</div></div></div></div></div>

								<div class="col-sm-6 col-md-6">
                                    <div class="card custom-card">
                                        <div class="card-body">
                                            <div class="box box-example-movie"
                                                 style="">
                                                <div class="box-body">
									<label for="">Was the MSME committed to growing his/her business</label>
									<select name="was_smme_commited" id="rating4" class="form-control">
										<option value="1">Not at all Satisfied</option>
                                                        <option value="2">Partly Satisfied</option>
                                                        <option value="3">Satisfied</option>
                                                        <option value="4">More than Satisfied</option>
                                                        <option value="5">Very Satisfied</option>
									</select>
								</div></div></div></div></div>

								<div class="col-sm-12 col-md-12">
                                    
									<label for="">Comment</label>
									<textarea class="form-control ckeditor" name="description" id="" rows="4"></textarea>
								</div>

								<div class="col-sm-12" style="margin-top: 15px">
									<button class="btn btn-primary" id="create">Submit</button>
								</div>


							</div>
						</form>
					</div>

				</div>
			</div>
		</div>
	</div>
	<!-- row closed -->
</div>

<?= $footer; ?>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
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

        $("#incubator_id").select2()

        for (let i = 1; i < 5; i++) {
            $("#rating" + i).barrating("set", "1")
            $('#rating' + i).barrating('show', {
                theme: 'bars-movie'
            });
        }

    })
</script>
