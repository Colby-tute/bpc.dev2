<?= $header ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" rel="stylesheet">

<div class="container">
	<div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex"><h4 class="content-title mb-0 my-auto">Edit Calendar Entry</h4></div>
        </div>
    </div>
    <div class="main-content-app pd-b-0  main-content-calendar pt-0">
        <div class="card">
            <div class="card-body">
                <form action="<?= site_url("user/smme/Calender/edit/".$event_id) ?>" method="post">
                    <div class="row">
                        <input type="hidden" name="user_id" value="<?= $user_id ?>">
                        <div class="col-sm-6" style="margin-bottom: 15px;">
                            <label class="form-label">
                                Please enter the event title
                            </label>
                            <input type="text" name="title" value="<?= $model->title ?>" class="form-control">
                        </div>
                        <div class="col-sm-6" style="margin-bottom: 15px;">
                            <label class="form-label">
                                Provide event address
                            </label>
                            <input type="text" name="address" value="<?= $model->address ?>" class="form-control">
                        </div>
                        <div class="col-sm-6" style="margin-bottom: 15px;">
                            <label class="form-label">
                                Select Incubator
                            </label>
                            <select class="form-control" id="incubator" name="incubator_id">
                                <option value=""></option>
                                <?php foreach ($inc as $user) {
                                    echo "<option ".($user->id == $model->incubator_id ? 'selected' : '')." value='{$user->id}'>{$user->name} {$user->last_name}</option>";
                                } ?>
                            </select>
                        </div>
                        <div class="col-sm-6" style="margin-bottom: 15px;">
                            <label class="form-label">
                                Select BDSP, Coach or Mentor
                            </label>
                            <select class="form-control" id="bdsp" name="bdsp_id">
                                <option value=""></option>
                                <?php foreach ($bdsp as $user) {
                                    echo "<option ".($user->id == $model->bdsp_id ? 'selected' : '')." value='{$user->id}'>{$user->name} {$user->last_name}</option>";
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
                                Event Start Date/Time
                            </label>
                            <input class="form-control" type="text" id="start_date" name="start_date" />
                        </div>
                        <div class="col-sm-6" style="margin-bottom: 15px;">
                            <label class="form-label">
                                Event End Date/Time
                            </label>
                            <input class="form-control" type="text" id="end_date" name="end_date" />
                        </div>
                        <div class="col-sm-6" style="margin-bottom: 15px;">
                            <label class="form-label">
                                Select Event Type
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
                            <button class="btn btn-primary">Update Event</button>
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
    document.getElementById('meetingType').value = "<?= $model->type ?>";
	
	$(document).ready(function () {
		bindCalendars();
	});
	
	function bindCalendars() {
		var startDate;
        $("#start_date").datetimepicker({
			timepicker:true,
			closeOnDateSelect:false,
			closeOnTimeSelect: true,
			initTime: true,
			format: 'd-m-Y H:i',
			value: '<?= $model->start_date ?>',
			minDate: 0,
			roundTime: 'ceil',
			onChangeDateTime: function(dp,$input){
				startDate = $("#start_date").val();
			}
		});
		
        $("#end_date").datetimepicker({
			timepicker:true,
			closeOnDateSelect:false,
			closeOnTimeSelect: true,
			initTime: true,
			format: 'd-m-Y H:i',
			value: '<?= $model->end_date ?>',
			onClose: function(current_time, $input){
				var endDate = $("#end_date").val();
				if(startDate>endDate){
					//alert('Please select correct date');
					startDate = $("#start_date").val();
					$("#end_date").val(startDate);
					return false;
				}
            }
        });
	}
</script>