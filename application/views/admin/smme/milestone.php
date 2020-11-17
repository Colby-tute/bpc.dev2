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
			<h4 class="content-title mb-2">Operations</h4>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= site_url('admin/home') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item" ><a href="<?= site_url('admin/smme') ?>">MSME Management</a></li>
					<li class="breadcrumb-item active" aria-current="page">Milestone Tasks</li>
				</ol>
			</nav>

		</div>
		<div class="my-auto breadcrumb-right">
							<a href="<?= site_url('admin/smme/Application') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-bell mr-2"></i></span><span class="btn-text">Status </span></button></a>
							<a href="<?= site_url('admin/smme/Application/add') ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-check-square mr-2"></i> </span><span class="btn-text">Add New Application </span></button></a>
							<button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-question-circle mr-2"></i> </span><span class="btn-text">Help </span></button>
						</div>
	</div>
	<div class="">
		<!-- row opened -->
		<div class="row row-sm">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
				<div class="card">
					<div class="card-body iconfont text-left">
						<form action="<?= site_url("/admin/smme/Smme/createMilestone/" . $smmeId) ?>" method="POST"
							  id="milestone_form">
							<div class="row">
								<div class="col-sm-3">

									<label>Milestone title</label>
									<input type="text" name="title" placeholder="Title" class="form-control"/>

								</div>

								<div class="col-sm-3">

									<label>Specify target date</label>
									<input type="text" name="end_date" placeholder="End date"
										   class="form-control datepicker"/>

								</div>

								<div class="col-sm-3">
									<label>Allocate tasks</label>
									<select class="form-control select_tasks" name="tasks[]" multiple>
										<?php if ($tasks) {
											foreach ($tasks as $task) { ?>
												<option value="<?= $task->id ?>"><?= $task->title ?></option>
											<?php }
										} ?>
									</select>
								</div>

								<div class="col-sm-3">

									<label>Provide milestone description</label>
									<textarea rows="2" name="description" placeholder="Description" class="form-control ckeditor"></textarea>

								</div>
								
								<div class="col-sm-12 mg-t-15">
									<button class="btn btn-primary" id="create">Create Milestone</button>
								</div>
								

							</div>

							<div class="row">
								<div class="col-sm-12">
									<div class="table-responsive card-body">
										<table
											class="table mg-b-0 table-bordered text-sm-nowrap text-lg-nowrap text-xl-nowrap">
											<thead>
											<tr>
												<th class="wd-5p pd-t-6">#</th>
												<th class="pd-t-6">Milestone Title</th>
												<th width="500" class="pd-t-6">Milestone Description</th>
												<th class="pd-t-6">Target Date</th>
												<th class="pd-t-6">Allocated Tasks</th>
												<th class="pd-t-6">Actions</th>
											</tr>
											</thead>
											<tbody>
											<?php if ($milestones) {
												foreach ($milestones as $k => $ms) { ?>
													<tr>
														<td><?= $k + 1 ?></td>
														<td><?= $ms['milestone']->title ?></td>
														<td><?= $ms['milestone']->description ?></td>
														<td><?= $ms['milestone']->end_date ?></td>
														<td><?php
														$tsks = [];
														if (isset($ms['tasks'])) {
															foreach ($ms['tasks'] as $task) {
																$tsks[] = $task[0]->title . " ( ID: {$task[0]->id} )";
															}
															echo implode("<br />", $tsks);
														}
														?>
														</td>
														<td>
															<i class="fa fa-edit" onclick="editMilestone('<?= site_url("/admin/smme/Smme/editMilestone/".$ms['milestone']->id) ?>')" style="cursor: pointer"></i>
															<i class="fa fa-trash" onclick="deleteMilestone('<?= site_url("/admin/smme/Smme/deleteMilestone/".$ms['milestone']->id)."/".$smmeId ?>')" style="margin-left: 5px; cursor: pointer"></i>
														</td>
													</tr>
												<?php }
											} ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</form>
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

		$(".select_tasks").select2()

		$(".datepicker").datepicker({
			format: "yyyy-mm-dd"
		})
	})

	function editMilestone(url) {
		location.href = url
	}

	function deleteMilestone(url) {
		location.href = url
	}

</script>

