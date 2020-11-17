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

								<label><strong>BDSP</strong></label>
								<p><?= $evaluation->bdsp ?></p>

							</div>

							<div class="col-sm-12">

								<label><strong>Shared services/equipment and office space offered by the Incubator</strong></label>
								<p><?= $evaluation->services ?></p>

							</div>

							<div class="col-sm-12">

								<label><strong>Relevant Training / Workshops offered by the Incubator</strong></label>
								<p><?= $evaluation->rel_train ?></p>

							</div>

							<div class="col-sm-12">

								<label><strong>Networking opportunities created by the Incubator</strong></label>
								<p><?= $evaluation->network ?></p>

							</div>

							<div class="col-sm-12">

								<label><strong>Incubator's responsiveness to requests by BDSP / MSME</strong></label>
								<p><?= $evaluation->respnosive ?></p>

							</div>

							<div class="col-sm-12">

								<label><strong>Relevant and updated information in Knowledge Bank</strong></label>
								<p><?= $evaluation->rel_and_upd ?></p>

							</div>

							<div class="col-sm-12">

								<label><strong>Professionalism of Incubator's infrastructure and office space</strong></label>
								<p><?= $evaluation->prof ?></p>

							</div>

							<div class="col-sm-12">

								<label><strong>Professionalism of Incubator's staff</strong></label>
								<p><?= $evaluation->prof_staff ?></p>

							</div>


							<div class="col-sm-12">

								<label><strong>Comment</strong></label>
								<p><?= $evaluation->comment ?></p>

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
