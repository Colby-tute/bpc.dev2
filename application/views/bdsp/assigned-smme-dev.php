<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>
<?= $header; ?>

<div class="container">
	<div class="breadcrumb-header justify-content-between">
		<div>
			<h4 class="content-title mb-2">Assigned SMMEs</h4>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= site_url('bdsp/home') ?>">Dashboard</a></li>
					<li class="breadcrumb-item active" aria-current="page">Assigned SMMEs</li>
				</ol>
			</nav>

		</div>
		<div class="my-auto breadcrumb-right">
			<button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-envelope mr-2"></i></span><span class="btn-text">Email </span></button>
			<button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-print mr-2"></i> </span><span class="btn-text">Print </span></button>
			<button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-download mr-2"></i> </span><span class="btn-text">Export </span></button>
			<!--<a class="btn btn-success mr-0" href="<?/*= site_url('admin/smme/Smme/add') */?>"><span
					class="icon-label"></span><span class="btn-text">Add </span></a>-->
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
							<table id="example" class="table key-buttons text-md-nowrap">
								<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Reference</th>
									<!-- <th scope="col">Photo</th> -->
									<th scope="col">Full Name</th>
									<th scope="col">Email Address</th>
									<th scope="col">Mobile Number</th>
									<!--  <th scope="col">Gender</th>
									 <th scope="col">Role</th> -->
									<th scope="col">Actions</th>
								</tr>
								</thead>
								<tbody>
								<?php
								if (isset($smmes)) {
									foreach ($smmes as $k => $row) {
										if (empty($row)) {
											continue;
										}
										if (gettype($row) == "array" && isset($row[0]) && !empty($row[0])) {
											$row = $row[0];
										}
										?>
										<tr>
											<td><?php echo $row->tbl_users_id; ?></td>
											<td><?php echo $row->tbl_users_user_uniqueid; ?></td>
											<td><?php echo $row->tbl_users_firstname . " " . $row->tbl_users_lastname; ?></td>
											<td><?php echo $row->tbl_users_email; ?></td>
											<td><?php echo $row->tbl_users_mobile; ?></td>
											<td>
												<button data-toggle="dropdown"
														class="btn btn-primary btn-block button_width"><i
														class="la la-cog setting"></i></button>
												<div class="dropdown-menu">
													<a href="<?= site_url('bdsp/Smme/createTask/' . $row->tbl_users_id) ?>"
													   class="dropdown-item"><i class="fa fa-edit"></i> Manage Notice Board
													</a>
													<!-- <a href="<?= site_url('bdsp/Smme/createMilestone/' . $row->tbl_users_id) ?>"
													   class="dropdown-item">Create Milestone
													</a> -->
													<a href="<?= site_url('bdsp/Smme/createMilestoneTask/' . $row->tbl_users_id) ?>"
													   class="dropdown-item"><i class="fa fa-edit"></i> Manage Milestone
													</a>
													<a href="<?= site_url('bdsp/Smme/evaluate/' . $row->tbl_users_id) ?>"
													   class="dropdown-item"><i class="fa fa-check-square"></i> MSME Evaluation
													</a>
												</div>
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
					<div class="modal history" id="scrollmodal">
						<div class="modal-dialog modal-dialog-scrollable" role="document">
							<div class="modal-content modal-content-demo">
								<div class="modal-header">
									<h6 class="modal-title">Login History</h6>
									<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span
											aria-hidden="true">&times;</span></button>
								</div>
								<div class="modal-body">
									<table id="example" class="table key-buttons text-md-nowrap view_history_table">
										<thead>
										<tr>
											<th scope="col">#</th>
											<th scope="col">IP</th>
											<th scope="col">Login From</th>
											<th scope="col">Result</th>
											<th scope="col">Date & Time</th>
										</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
								<div class="modal-footer">
									<!-- <button class="btn ripple btn-primary" type="button">Save changes</button> -->
									<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close
									</button>
								</div>
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
