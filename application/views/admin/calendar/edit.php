<?= $header ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" rel="stylesheet">

<div class="container">
	<div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex"><h4 class="content-title mb-0 my-auto">Edit Entry</h4></div>
        </div>
    </div>
    <div class="main-content-app pd-b-0  main-content-calendar pt-0">
        <div class="card">
            <div class="card-body">
                <form action="<?= site_url("admin/Calendar/edit/".$event_id) ?>" method="post">
                    <div class="row">
                        <input type="hidden" name="user_id" value="<?= $user_id ?>">
                        <div class="col-sm-6" style="margin-bottom: 15px;">
                            <label class="form-label">
                                Event Title
                            </label>
                            <input type="text" name="title" value="<?= $model->title ?>" class="form-control">
                        </div>
                        <div class="col-sm-6" style="margin-bottom: 15px;">
                            <label class="form-label">
                                Event Address
                            </label>
                            <input type="text" name="address" value="<?= $model->address ?>" class="form-control">
                        </div>
                        <div class="col-sm-6" style="margin-bottom: 15px;">
                            <label class="form-label">
                                MSME
                            </label>
                            <select class="form-control" id="smme" name="smme_id">
                                <option value=""></option>
                                <?php foreach ($smmes as $user) {
                                    echo "<option value='{$user->tbl_users_id}'>{$user->tbl_users_firstname} {$user->tbl_users_lastname}</option>";
                                } ?>
                            </select>
                        </div>
                        <div class="col-sm-6" style="margin-bottom: 15px;">
                            <label class="form-label">
                                BDSP
                            </label>
                            <select class="form-control" id="bdsp" name="bdsp_id">
                                <option value=""></option>
                                <?php foreach ($bdsp as $user) {
                                    echo "<option value='{$user->tbl_users_id}'>{$user->tbl_users_firstname} {$user->tbl_users_lastname}</option>";
                                } ?>
                            </select>
                        </div>
                        <div class="col-sm-6" style="margin-bottom: 15px;">
                            <label class="form-label">
                                Incubator
                            </label>
                            <select class="form-control" id="incubator" name="incubator_id">
                                <option value=""></option>
                                <?php foreach ($inc as $user) {
                                    echo "<option value='{$user->tbl_users_id}'>{$user->tbl_users_firstname} {$user->tbl_users_lastname}</option>";
                                } ?>
                            </select>
                        </div>
                        <div class="col-sm-12" style="margin-bottom: 15px;">
                            <label class="form-label">
                                Event Description
                            </label>
                            <textarea class="form-control ckeditor" name="description" rows="4"><?= $model->description ?></textarea>
                        </div>
                        <div class="col-sm-6" style="margin-bottom: 15px;">
                            <label class="form-label">
                                Start Date
                            </label>
                            <input class="form-control" type="text" id="start_date" name="start_date" />
                        </div>
                        <div class="col-sm-6" style="margin-bottom: 15px;">
                            <label class="form-label">
                                End Date
                            </label>
                            <input class="form-control" type="text" id="end_date" name="end_date" />
                        </div>
                        <div class="col-sm-6" style="margin-bottom: 15px;">
                            <label class="form-label">
                                Event Type
                            </label>
                            <select id="meetingType" name="type" class="form-control">
                                <option value="Meeting">Meeting</option>
                                <option value="Training">Training</option>
                                <option value="Feedback">Feedback</option>
                                <option value="Workshop">Workshop</option>
                                <option value="One on One">One on One</option>
                                <option value="Evaluation">Evaluation</option>
                                <option value="Assessment">Assessment</option>
                            </select>
                        </div>
                        <div class="col-sm-12">
                            <button class="btn btn-primary">Update</button>
                        </div>
                    </div>
                 </form>
            </div>
        </div>
        
    </div>
</div>



<?= $footer ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
<script type="text/javascript">
    $(function() {
        document.getElementById('incubator').value = <?= $model->incubator_id ?>;
        document.getElementById('bdsp').value = <?= $model->bdsp_id ?>;
        document.getElementById('smme').value = <?= $model->smme_id ?>;
        document.getElementById('meetingType').value = "<?= $model->type ?>";
		
		$('#start_date').datetimepicker({
            format: "Y-m-d H:i",
			value: '<?= $model->start_date ?>',
			onSelect: function (selected) {
				var dt = new Date(selected);
				dt.setDate(dt.getDate() + 1);
				$("#end_date").datepicker("option", "minDate", dt);
			}
        });
        $('#end_date').datetimepicker({
            format: "Y-m-d H:i",
			value: '<?= $model->end_date ?>',
			onSelect: function (selected) {
				var dt = new Date(selected);
				dt.setDate(dt.getDate() - 1);
				$("#start_date").datepicker("option", "maxDate", dt);
			}
        });
    })
</script>