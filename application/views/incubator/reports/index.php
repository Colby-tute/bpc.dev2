<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>
<?= $header; ?>

<div class="container">
	<div class="breadcrumb-header justify-content-between">
		<div>
			<h4 class="content-title mb-2">Manage Evaluations</h4>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= site_url('incubator/home') ?>">Dashboard</a></li>
					<li class="breadcrumb-item active" aria-current="page">Manage Evaluations</li>
				</ol>
			</nav>

		</div>
		<div class="my-auto breadcrumb-right">
							<button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-envelope mr-2"></i></span><span class="btn-text">Email </span></button>
							<button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-print mr-2"></i> </span><span class="btn-text">Print </span></button>
							<button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-download mr-2"></i> </span><span class="btn-text">Export </span></button>
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
									<th scope="col">id</th>
									<th scope="col">User</th>
									<th scope="col">Role</th>
									<th scope="col">Date</th>
									<th scope="col">Actions</th>
								</tr>
								</thead>
								<tbody>
								<?php
								if (isset($evaluations)) {
									foreach ($evaluations as $report) {
										?>
											<tr>
												<td><?= $report->id ?></td>
												<td><?= $report->user->tbl_users_firstname . " " . $report->user->tbl_users_lastname ?></td>
												<td><?= $report->role ?></td>
												<td><?= $report->date ?></td>
												<td>
													<a style="margin-left: 10px" href="<?= site_url('incubator/Reports/view/'.$report->id . '/' . $report->role) ?>"><i class="fa fa-edit"></i></a>
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
