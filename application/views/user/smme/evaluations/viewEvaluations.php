<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>
<?= $header; ?>

<div class="container">
	<div class="breadcrumb-header justify-content-between">
		<div>
			<h4 class="content-title mb-2">Evaluations</h4>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= site_url('home') ?>">Dashboard</a></li>
					<li class="breadcrumb-item" aria-current="page">Evaluations</li>
				</ol>
			</nav>
		</div>
		<div class="my-auto breadcrumb-right">
							<a href="<?= site_url('user/smme/Evaluations/index') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-bell mr-2"></i></span><span class="btn-text">Evaluate </span></button></a>
							<a href="<?= site_url('Profile/view_profile/'.$this->session->userdata('id_user')) ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Personal Details </span></button></a>
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
						<div class="table-responsive">
							<table class="table text-md-nowrap dataTable no-footer" id="example1" role="grid" aria-describedby="example1_info">
								<thead>
								<tr>
									<th scope="col">PID</th>
									<th scope="col">Evaluation Title</th>
									<th scope="col">Entity Evaluated</th>
									<th scope="col">Evaluation Date</th>
									<th scope="col">Actions</th>
								</tr>
								</thead>
								<tbody>
								<?php
								$index=0;
								if (isset($evaluations)) {
									foreach ($evaluations as $evaluation) {
										?>
											<tr>
												<td><?= ++$index ?></td>
												<td><?= $evaluation->evaluation_title ?></td>
												<!-- <td><?= $evaluation->evaluatee_id ?></td> -->
												<td><?= $evaluation->evaluatee_firstname.' '.$evaluation->evaluatee_lastname ?> </td>
												<td><?= $evaluation->evaluation_time ?></td>
												<td>
													<a href="<?= site_url('user/smme/Evaluations/viewEvaluation/'.$evaluation->evaluation_id.'/'.$evaluation->evaluatee_id) ?>">
														<i class="fa fa-eye"></i>
													</a>
												</td>
											</tr>
								<?php

									}
								}
								?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- row closed -->
	</div>
</div>
<?= $footer; ?>
