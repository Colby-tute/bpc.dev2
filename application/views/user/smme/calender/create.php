<?= $header ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" rel="stylesheet">

<div class="container">
 <div class="breadcrumb-header justify-content-between">
                        <div>
                            <h4 class="content-title mb-2">Operations</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= site_url('Home') ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active"><a href="<?= site_url('user/smme/Calender') ?>">Calendar & Events</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Create Calendar Event</li>
                                </ol>
                            </nav>

                        </div>
                       <div class="my-auto breadcrumb-right">
							<a href="<?= site_url('user/smme/Calender/create') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-calendar mr-2"></i></span><span class="btn-text">Create Calendar Event</span></button></a>
							<a href="<?= site_url('user/smme/Calender') ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-bell mr-2"></i> </span><span class="btn-text">Manage Calendar </span></button></a>
							<button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-question-circle mr-2"></i> </span><span class="btn-text">Help </span></button>
						</div>
                    </div>

<div class="main-content-app pd-b-0  main-content-calendar pt-0">
        <div class="card">
                <p><?php if ($this->session->flashdata('danger')) { ?>
                        <div id="infoMessage"
                             class="alert alert-danger mt25"><?php echo $this->session->flashdata('danger'); ?></div><br>
                        <?php } else if ($this->session->flashdata('success')) { ?>
                            <div id="infoMessage"
                                 class="alert alert-success mt25"><?php echo $this->session->flashdata('success'); ?></div><br>
                        <?php }
                        ?>
                        </p>
            <div class="card-body mt-5">
                <form action="<?= site_url("user/smme/Calender/create") ?>" method="post">
                	<div class="row">
                		<input type="hidden" name="user_id" value="<?= $user_id ?>">
                		<div class="col-sm-6" style="margin-bottom: 15px;">
                			<label class="form-label">
                				Please enter the event title
                			</label>
                			<input type="text" name="title" value="" class="form-control">
                		</div>
                		<div class="col-sm-6" style="margin-bottom: 15px;">
                			<label class="form-label">
                				Provide event address
                			</label>
                			<input type="text" name="address" value="" class="form-control">
                		</div>
                		<div class="col-sm-6" style="margin-bottom: 15px;">
                			<label class="form-label">
                				Select Incubator
                			</label>
                			<select class="form-control" id="incubator" name="incubator_id">
                                <option value=""></option>
                				<?php foreach ($inc as $user) {
                                    echo "<option value='{$user->id}'>{$user->name} {$user->last_name}</option>";
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
                                    echo "<option value='{$user->id}'>{$user->name} {$user->last_name}</option>";
                                } ?>
                			</select>
                		</div>
                		<div class="col-sm-12" style="margin-bottom: 15px;">
                			<label class="form-label">
                				Provide event description
                			</label>
                			<textarea class="form-control ckeditor" name="description" rows="4"></textarea>
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
                            <select name="type" class="form-control">
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
                            <button <?php if($underIncubation == 0){ echo "disabled";} ?> class="btn btn-primary">Create Event</button>
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
			format: 'Y-m-d H:i',
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
			format: 'Y-m-d H:i',
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