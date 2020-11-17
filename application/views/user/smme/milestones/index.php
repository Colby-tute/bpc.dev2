<?php
?>
<?php echo $header ?>
<link href="<?php echo base_url(); ?>assets/css/timeline.min.css" rel="stylesheet">
<div class="container">

	<!-- breadcrumb -->
	<div class="breadcrumb-header justify-content-between">
		<div>
			<h4 class="content-title mb-2">Operations</h4>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= site_url('home') ?>">Dashboard</a></li>
					<li class="breadcrumb-item active" aria-current="page">Milestone Tasks</li>
				</ol>
			</nav>
		</div>
		<div class="my-auto breadcrumb-right">
							<a href="<?= site_url('user/smme/Application') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-bell mr-2"></i></span><span class="btn-text">Status </span></button></a>
							<a href="<?= site_url('user/smme/Analytics/incprogress') ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-bars mr-2"></i> </span><span class="btn-text">Monitoring & Reports </span></button></a>
							<button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-question-circle mr-2"></i> </span><span class="btn-text">Help </span></button>
						</div>
	</div>
	<!-- breadcrumb -->

	<!-- row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="card custom-card">
				<div class="card-header custom-card-header">



<button class="btn btn-secondary" data-placement="right" data-toggle="tooltip-primary" title="Milestones are set for you by the incubation manager" type="button"><i class="fa fa-question"></i></button>


				</div>
				<div class="card-body">
					<div class="vtimeline">
						<?php if ($milestones) {
							foreach ($milestones as $k => $ms) {
								if ($k % 2 == 0) {
									$class = "timeline-wrapper timeline-wrapper-primary";
								} else {
									$class = "timeline-wrapper timeline-inverted timeline-wrapper-secondary";
								}
								?>
								<div class="<?= $class ?>">
									<div class="timeline-badge"></div>
									<div class="timeline-panel">
										<div class="timeline-heading">
											<h6 class="timeline-title"><?= $ms->title ?></h6>
										</div>
										<div class="timeline-body">
											<p><?= $ms->description ?></p>
										</div>
										<div class="timeline-footer d-flex align-items-center flex-wrap">
											<span class="ml-md-auto"><i class="fe fe-calendar text-muted mr-1"></i><?= $ms->end_date ?></span>
										</div>
									</div>
								</div>
							<?php }
						}  ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /row -->
</div>
<?php echo $footer ?>

