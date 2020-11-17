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
                    <li class="breadcrumb-item" ><a href="<?= site_url('admin/smme') ?>">MSME</a></li>
					<li class="breadcrumb-item active" aria-current="page">Edit Milestone</li>
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
						<form action="<?= site_url("/admin/smme/Smme/editMilestone/" . $id) ?>" method="POST"
							  id="milestone_form">
							<div class="row">
								<div class="col-sm-3">

									<label>Milestone Title</label>
									<input type="text" value="<?= $milestone[0]->title ?>" name="title" placeholder="Title" class="form-control"/>

								</div>

								<div class="col-sm-3">

									<label>Milestone target date</label>
									<input type="text" name="end_date" value="<?= $milestone[0]->end_date ?>" placeholder="End date"
										   class="form-control datepicker"/>

								</div>

								<div class="col-sm-3">
									<label>Allocated tasks</label>
									<select class="form-control select_tasks" name="tasks[]" multiple>
										<?php if (isset($tasks)) {
											foreach ($tasks as $task) { ?>
												<option <?= in_array($task->id, $selectedTasks) ? "selected" : "" ?> value="<?= $task->id ?>"><?= $task->title ?></option>
											<?php }
										} ?>
									</select>
								</div>

								<div class="col-sm-3">

									<label>Milestone description</label>
									<textarea rows="2" name="description" placeholder="Description" class="form-control ckeditor">
										<?= $milestone[0]->description ?>
									</textarea>

								</div>

								<div class="col-sm-12 mg-t-15">
									<button class="btn btn-primary" id="create">Update</button>
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

</script>

