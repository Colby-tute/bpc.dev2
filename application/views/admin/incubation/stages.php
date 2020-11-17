<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>
<?= $header; ?>

<div class="container">
	<div class="breadcrumb-header justify-content-between">
		<div>
			<h4 class="content-title mb-2">General Settings</h4>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= site_url('admin/home') ?>">Dashboard</a></li>
					<li class="breadcrumb-item active" aria-current="page">Incubation Stages</li>
				</ol>
			</nav>

		</div>
		
		
		<div class="my-auto breadcrumb-right">
							<a href="<?= site_url('admin/incubation/Incubation/createStage') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-check-square mr-2"></i></span><span class="btn-text">Create New Stage </span></button></a>
							<a href="<?= site_url('admin/incubation/Incubation/create') ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Create New Incubator </span></button></a>
							<button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-question-circle mr-2"></i> </span><span class="btn-text">Help </span></button>
</div>
		
		
	</div>

	<div class="">
		<!-- row opened -->
		<div class="row row-sm">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
				<div class="card">
					<div class="card-body iconfont text-left">
						<div class="table-responsive">
							<!-- <table id="example" class="table key-buttons text-md-nowrap"> -->
							<table class="table text-md-nowrap dataTable no-footer" id="example1" role="grid" aria-describedby="example1_info">
								<thead>
								<tr>
									<th scope="col">PID</th>
									<th scope="col">Stage Name / Description</th>
									<th scope="col">Actions</th>
								</tr>
								</thead>
								<tbody>
								<?php
								if ($stages) {
									foreach ($stages as $k => $row) { ?>
										<tr>
											<td><?php echo $row->id; ?></td>
											<td><?php echo $row->stage; ?></td>

											<td>
												<a href="<?= site_url('admin/incubation/Incubation/updateStage/'.$row->id) ?>"  style="margin-right: 10px;"><i class="fa fa-edit"></i></a>
												<a href="<?= site_url('admin/incubation/Incubation/deleteStage/'.$row->id) ?>"><i class="fa fa-trash"></i></a>
												
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
