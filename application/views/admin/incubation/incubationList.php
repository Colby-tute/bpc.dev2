<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>
<?= $header; ?>

<div class="container">
	<div class="breadcrumb-header justify-content-between">
		<div>
			<h4 class="content-title mb-2">Operations</h4>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= site_url('admin/home') ?>">Dashboard</a></li>
					<li class="breadcrumb-item active" aria-current="page">Incubator Programmes</li>
				</ol>
			</nav>

		</div>
		<div class="my-auto breadcrumb-right">
							<a href="<?= site_url('admin/incubation/Incubation/createStage') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-check-square mr-2"></i></span><span class="btn-text">Create New Stage </span></button></a>
							<a href="<?= site_url('admin/incubation/Incubation/create') ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Create Programme </span></button></a>
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
								<!-- <table id="example" class="table key-buttons text-md-nowrap"> -->
								<table class="table text-md-nowrap dataTable no-footer" id="example1" role="grid" aria-describedby="example1_info">
									<thead>
									<tr>
										<th scope="col">PID</th>
										<th scope="col">Programme Name</th>
										<th scope="col">Physical Address</th>
										<th scope="col">Telephone Number</th>
										<th scope="col">Actions</th>
									</tr>
									</thead>
									<tbody>
									<?php
									if ($incubations) {
										foreach ($incubations as $k => $row) { ?>
											<tr>
												<td><?php echo $k+1; ?></td>
												<td><?php echo $row->title; ?></td>
												<td><?php echo $row->address; ?></td>
												<td><?php echo $row->phone; ?></td>
												<td>
													<a href="<?= site_url('admin/incubation/Incubation/incubationDetails/'.$row->id) ?>" style="margin-right: 10px;"><i class="fa fa-eye"></i></a>
													
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
		</div>
		<!-- row closed -->
	</div>
</div>
<?= $footer; ?>
