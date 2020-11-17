<?php echo $header ?>
<link href="<?php echo base_url(); ?>assets/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet"/>
<style>
	.select2 {
		width: 100% !important;
	}
</style>
<div class="container">
	<div class="breadcrumb-header justify-content-between">
		<div>
			<h4 class="content-title mb-2">SMME Evaluation</h4>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= site_url('incubator/home') ?>">Dashboard</a></li>
					<li class="breadcrumb-item active" aria-current="page">Evaluation</li>
				</ol>
			</nav>

		</div>

	</div>
	<div class="">
		<!-- row opened -->
		<div class="row row-sm">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
				<div class="card">
					<div class="card-body iconfont text-left">

							<div class="row">
								<div class="col-sm-12">

									<label><strong>SMME</strong></label>
									<p><?= $evaluation->smme ?></p>

								</div>

								<div class="col-sm-12">

									<label><strong>BDSP</strong></label>
									<p><?= $evaluation->bdsp ?></p>

								</div>

								<div class="col-sm-12">

									<label><strong>Was this a useful engagement</strong></label>
									<p><?= $evaluation->was_useful ?></p>

								</div>

								<div class="col-sm-12">

									<label><strong>Did the entrepreneur apply your recommendations</strong></label>
									<p><?= $evaluation->did_entre ?></p>

								</div>

								<div class="col-sm-12">

									<label><strong>Did the MSME attend to the task / required inputs timely</strong></label>
									<p><?= $evaluation->did_smme_attend ?></p>

								</div>

								<div class="col-sm-12">

									<label><strong>Was the MSME committed to growing his/her business</strong></label>
									<p><?= $evaluation->was_smme_commited ?></p>

								</div>

								<div class="col-sm-12">

									<label><strong>Title</strong></label>
									<p><?= $evaluation->title ?></p>

								</div>

								<div class="col-sm-12">

									<label><strong>Comment</strong></label>
									<p><?= $evaluation->description ?></p>

								</div>

							</div>
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
<script type="text/javascript">
	$(function () {

		$("#incubator_id").select2()

	})
</script>
