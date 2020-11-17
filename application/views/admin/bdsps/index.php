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
					<li class="breadcrumb-item active" aria-current="page">Bdsp, Coaches and Mentors</li>
				</ol>
			</nav>

		</div>
		
		<div class="my-auto breadcrumb-right">
							<a href="<?= site_url('admin/bdsps/Bdsps/add') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i></span><span class="btn-text">Create BDSP Profile </span></button></a>
							<a href="<?= site_url('admin/incubators/Incubators/bbm') ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-tasks mr-2"></i> </span><span class="btn-text">BBM Progress (%) </span></button></a>
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
									<!-- <th scope="col">Photo</th> -->
									<th scope="col">Profile Name</th>
									<th scope="col">Email Address</th>
									<th scope="col">Mobile Number</th>
									<th scope="col">Approvals</th>
									<th scope="col">Rights</th>
									<th scope="col">Actions</th>
								</tr>
								</thead>
								<tbody>
								<?php
								foreach ($tdata as $row) { ?>
									<tr>
										<td><?php echo $row->tbl_users_id; ?></td>
										<td>BDSP-<?php echo $row->tbl_users_user_uniqueid; ?></td>
										<!-- <td><img src="<?php echo base_url(); ?>assets/users/<?php echo $row->tbl_users_photo; ?>" style="width: 50px; height: auto;"></td> -->
										<td><?php echo $row->tbl_users_firstname . " " . $row->tbl_users_lastname; ?></td>
										<td><?php echo $row->tbl_users_email; ?></td>
										<td><?php echo $row->tbl_users_mobile; ?></td>
										<!-- <td><?php if ($row->tbl_users_gender == 'M') {
											echo "Male";

										} else if ($row->tbl_users_gender == 'F') {
											echo "Female";

										} else {
											echo "Other";

										} ?></td>
                                        <td>
                                        <?php echo $row->tbl_roles_title; ?></td>  -->
										<td>
											<?php if ($row->login_approve != 1) : ?>
												<a class="btn btn-success"
												   style="width: 100%; font-size: 12px; padding: 3px 10px"
												   href="<?= site_url("/admin/Approve/approve/" . $row->tbl_users_id . "/" . 4) ?>"><i
															class="fa fa-check"></i></a>
											<?php else : ?>
												<span style="color: green"><strong>Approved</strong></span>
											<?php endif; ?>
										</td>
										<td>
											<?php
											$roles = [
													2 => 'MSME',
													3 => 'Incubator',
													4 => 'BDSP',
											];
											?>
											<select name="role" id="roles" class="form-control" data-user="<?= $row->tbl_users_id ?>">
												<?php foreach ($roles as $key => $role){
													echo "<option ".($row->tbl_users_role_id == $key ? "selected" : "")." value='{$key}'>{$role}</option>";
												}; ?>
											</select>
										</td>
										<td>
											<button data-toggle="dropdown"
													class="btn btn-primary btn-block button_width"><i
														class="la la-cog setting"></i></button>
											<div class="dropdown-menu">
											     <a href="<?= site_url('admin/bdsps/Bdsps/viewdetails/'.$row->tbl_users_id) ?>" class="dropdown-item"> <i class="fa fa-eye"></i> View
                                                </a>
												<a href="<?= site_url('admin/bdsps/Bdsps/edit/' . $row->tbl_users_id) ?>"
												   class="dropdown-item"><i class="fa fa-edit"></i> Edit
													<!-- <i class="typcn typcn-edit"></i> -->
												</a>
												
												<a href="<?= site_url('admin/bdsps/Bdsps/status/' . $row->tbl_users_id) ?>"
												   class="dropdown-item"><i class="fa fa-lock"></i> Access
													<!-- <i class="typcn typcn-edit"></i> -->
												</a>
												<a href="<?= site_url('admin/bdsps/Bdsps/delete/' . $row->tbl_users_id) ?>"
												   class="dropdown-item"><i class="fa fa-trash"></i> Delete
													<!-- <i class="typcn typcn-delete"></i> -->
												</a>
												<a class="dropdown-item login_view" data-target="#scrollmodal"
												   data-toggle="modal" href=""
												   data-id="<?php echo $row->tbl_users_id; ?>"><i class="fa fa-unlock-alt"></i> Activities
													<!-- <i class="far fa-clock"></i> --></a>
												</a>
											</div>
										</td>
									</tr>
									<?php
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
											<th scope="col">pid</th>
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
<script type="text/javascript">
	$(document).ready(function () {
		$('.login_view').click(function () {
			var id = $(this).data('id');
			//alert(id);
			//$('.view_payments').html('');
			var dataTable = $(".view_history_table").DataTable();
			dataTable.clear().draw();
			//alert(id);
			jQuery.ajax({
				type: "POST",
				url: "<?=base_url()?>admin/bdsps/Bdsps/login_history",
				dataType: 'text',
				data: {user_id: id},
				success: function (data) {
					var obj = jQuery.parseJSON(data);
					var subcat_data = obj;
					console.log(subcat_data);
					//view_payment_table

					var html = '';
					var i = 1;
					$.each(subcat_data, function (index, data) {

						dataTable.row.add([i, data.tbl_login_history_ip, data.tbl_login_history_login_from, data.tbl_login_history_result, data.tbl_login_history_insertdate]).draw(false);
						i++;
					});
					//$('.view_payments').html(html);

					//alert(html);

				}

			});
		});
	});
</script>
<script>
	$("#roles").on("change", function () {
		$.ajax({
			method: "POST",
			url: '<?= base_url() ?>admin/smme/Smme/changeRights',
			data: {
				id: $(this).data('user'),
				role: $(this).val(),
			}
		})
	})
</script>
