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
					<li class="breadcrumb-item"><a href="<?= site_url('incubator/home') ?>">Dashboard</a></li>
					<li class="breadcrumb-item active" aria-current="page">MSME Management</li>
				</ol>
			</nav>

		</div>
		<div class="my-auto breadcrumb-right">
							<a href="<?= site_url('incubator/BusinessDetails/uploaddocMsme') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-handshake mr-2"></i></span><span class="btn-text">MSME Contracts </span></button></a>
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
						<div class="table-responsive">
							<!-- <table id="example" class="table key-buttons text-md-nowrap"> -->
							<table class="table text-md-nowrap dataTable no-footer" id="example1" role="grid" aria-describedby="example1_info">
								<thead>
								<tr>
									<th scope="col">PID</th>
									<th scope="col">Reference</th>
									<th scope="col">Full Name</th>
									<th scope="col">Email Address</th>
									<th scope="col">Mobile Number</th>
									<th scope="col">Stages</th>
									<th scope="col">Actions</th>
								</tr>
								</thead>
								<tbody>
								<?php
								if (isset($smmes)) {
									foreach ($smmes as $row) {
										if (empty($row)) {
											continue;
										}
										if (gettype($row) == "array" && isset($row[0]) && !empty($row[0])) {
											$row = $row[0];
										}
										?>
										<tr>
											<td><?php echo $row->tbl_users_id; ?></td>
											<td>MSME-<?php echo $row->tbl_users_user_uniqueid; ?></td>
											<td><?php echo $row->tbl_users_firstname . " " . $row->tbl_users_lastname; ?></td>
											<td><?php echo $row->tbl_users_email; ?></td>
											<td><?php echo $row->tbl_users_mobile; ?></td>
											<td>
												<select name="stage" id="stage<?php echo $row->tbl_users_id; ?>" class="form-control" data-user="<?= $row->tbl_users_id ?>" data-app="<?= $row->app_id ?>">
													<?php foreach ($stages as $stage){
														echo "<option ".($row->tbl_application_status == $stage->stage ? "selected" : "")." value='{$stage->stage}' data-stage='{$stage->id}'>{$stage->stage}</option>";
													}; ?>
												</select>
											</td>
											<td>
												<button data-toggle="dropdown"
														class="btn btn-primary btn-block button_width"><i
														class="la la-cog setting"></i></button>
												<div class="dropdown-menu">
												<a href="<?= site_url('incubator/Smme/viewdetails/' . $row->tbl_users_id) ?>"
													   class="dropdown-item"><i class="fa fa-eye"></i> View </a>
													<a href="<?= site_url('incubator/Smme/createTask/' . $row->tbl_users_id) ?>"
													   class="dropdown-item"><i class="fa fa-bookmark"></i> Boards
													</a>
													<!--<a href="<?= site_url('incubator/Smme/createMilestone/' . $row->tbl_users_id) ?>"
													   class="dropdown-item">Create Milestone
													</a> -->
													<!--<a href="<?= site_url('incubator/Smme/createMilestoneTask/' . $row->tbl_users_id) ?>"
													   class="dropdown-item"><i class="fa fa-edit"></i> Manage Milestones
													</a>-->
													<a href="<?= site_url('incubator/Smme/handleMilestoneQuestions/' . $row->tbl_users_id) ?>"
													   class="dropdown-item"><i class="fa fa-edit"></i> Milestones
													</a>
													<a href="<?= site_url('incubator/BusinessDetails/viewFunds/' . $row->tbl_users_id) ?>"
													   class="dropdown-item"><i class="fa fa-credit-card"></i> Funds
													</a>
													
													<!--<a href="<?= site_url('incubator/Smme/evaluate/' . $row->tbl_users_id) ?>"
													   class="dropdown-item"><i class="fa fa-check-square"></i> MSME Evaluation
													</a> -->
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
											<th scope="col">PID</th>
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
<script>
	$(function () {
		<?php
			if (isset($smmes)) {
				foreach ($smmes as $row) {
					if (empty($row)) {
						continue;
					}
					if (gettype($row) == "array" && isset($row[0]) && !empty($row[0])) {
						$row = $row[0];
					}
		?>
		$("#stage<?php echo $row->tbl_users_id; ?>").on("change", function () {
			var stage = $('#stage<?php echo $row->tbl_users_id; ?> option:selected').attr('data-stage');
			//alert(stage); return false;
			
			$.ajax({
				method: "POST",
				url: '<?= base_url() ?>/incubator/Operations/changeStatus',
				data: {
					id: $(this).data('user'),
					app_id: $(this).data('app'),
					status: $(this).val(),
					stage_id: stage,
				}
			})
		});
		<?php
				}
			}
		?>
	})
</script>
