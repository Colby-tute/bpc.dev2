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
					<li class="breadcrumb-item"><a href="<?= site_url('admin/home') ?>">Dashboard</a></li>
					<li class="breadcrumb-item active" aria-current="page">Evaluations</li>
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
							<!-- <table id="example" class="table key-buttons text-md-nowrap"> -->
<table class="table text-md-nowrap dataTable no-footer" id="example1" role="grid" aria-describedby="example1_info">
								<thead>
								<tr>
									
									<th scope="col">Evaluator Full Name</th>
									<th scope="col">Evaluated</th>
									<th scope="col">Evaluation Date</th>
									<th scope="col">Actions</th>
								</tr>
								</thead>
								<tbody>
								<?php if ($evaluations) : ?>
								<?php foreach($evaluations as $evaluation) : ?>
									<?php foreach($evaluation as $data) : ?>
										<?php 
										if ($data->reporter) {
											$reporter = $data->reporter->tbl_users_firstname . " " . $data->reporter->tbl_users_lastname;
										}else {
											$reporter = "";
										}
										if ($data->reported) {
											$reported = $data->reported->tbl_users_firstname . " " . $data->reported->tbl_users_lastname;
										}else {
											$reported = "";
										}
										?>
										<tr>
											<td><?= $reporter ?></td>
											<td><?= $reported ?></td>
											<td><?= $data->date ?></td>
											<td>
												<button data-toggle="dropdown"
													class="btn btn-primary btn-block button_width"><i
														class="la la-cog setting"></i></button>
											<div class="dropdown-menu">
												<a href="<?= site_url('admin/reports/Reports/edit/' . $data->id . "/" . $data->type . "/" . $reporter . "/" . $reported ) ?>"
												   class="dropdown-item"><i class="fa fa-eye"></i> View
													<!-- <i class="typcn typcn-edit"></i> -->
												</a>
												<a href="<?= site_url('admin/reports/Reports/delete/' . $data->id . "/" . $data->type) ?>"
												   class="dropdown-item"><i class="fa fa-trash"></i> Delete
													<!-- <i class="typcn typcn-delete"></i> -->
												</a>
											</div>
											</td>
										</tr>
									<?php endforeach; ?>
								<?php endforeach; ?>
								<?php endif; ?>
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
