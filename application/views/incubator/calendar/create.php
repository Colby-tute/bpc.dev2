<?= $header ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" rel="stylesheet">

<div class="container">
		
	 <!-- breadcrumb -->
                    <div class="breadcrumb-header justify-content-between">
                        <div>
			<h4 class="content-title mb-2">Operations</h4>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= site_url('incubator/home') ?>">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="<?= site_url('incubator/Calendar') ?>">Calendar & Events</a></li>
					<li class="breadcrumb-item active" aria-current="page">Create Calendar Event</li>
				</ol>
			</nav>
		</div>
                        <div class="my-auto breadcrumb-right">
							<a href="<?= site_url('incubator/Calendar') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-bell mr-2"></i></span><span class="btn-text">My Calendar </span></button></a>
							<a href="<?= site_url('incubator/Profile/view_profile/'.$this->session->userdata('id_user')) ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Personal Details </span></button></a>
							<button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-question-circle mr-2"></i> </span><span class="btn-text">Help </span></button>
						</div>
                    </div>
                    <!-- breadcrumb -->
    <div class="main-content-app pd-b-0  main-content-calendar pt-0">

        <div class="card">
            <?php if ($this->session->flashdata('danger')) { ?>
                        <div id="infoMessage" class="alert alert-danger"
                             style="margin: 0px;"><?php echo $this->session->flashdata('danger'); ?></div><br>
                    <?php } else if ($this->session->flashdata('success')) { ?>
                        <div id="infoMessage" class="alert alert-success"
                             style="margin: 0px;"><?php echo $this->session->flashdata('success'); ?></div>
                             <br>
                    <?php }
                    ?>
            <div class="card-body mt-5">
                <form action="<?= site_url("incubator/Calendar/create") ?>" method="post">
                	<div class="row">
                		<input type="hidden" name="user_id" value="<?= $user_id ?>">
                		<div class="col-sm-6" style="margin-bottom: 15px;">
                			<label class="form-label">
                				Enter Event Title
                			</label>
                			<input type="text" name="title" value="" class="form-control">
                		</div>
                		<div class="col-sm-6" style="margin-bottom: 15px;">
                			<label class="form-label">
                				Enter Event Address
                			</label>
                			<input type="text" name="address" value="" class="form-control">
                		</div>
                		<div class="col-sm-6" style="margin-bottom: 15px;">
                			<label class="form-label">
                				Select MSME
                			</label>
                			<select class="form-control" id="smme" name="smme_id">
                                <option value=""></option>
                				<?php foreach ($smmes as $user) {
                                    echo "<option value='{$user->id}'>{$user->name} {$user->last_name}</option>";
                                } ?>
                			</select>
                		</div>
                		<div class="col-sm-6" style="margin-bottom: 15px;">
                			<label class="form-label">
                				Select BDSP | COACH | MENTOR
                			</label>
                			<select class="form-control" id="bdsp" name="bdsp_id">
                                <option value=""></option>
                				<?php foreach ($bdsp as $user) {
                                    echo "<option value='{$user->tbl_users_id}'>{$user->tbl_users_firstname} {$user->tbl_users_lastname}</option>";
                                } ?>
                			</select>
                		</div>
                		<div class="col-sm-12" style="margin-bottom: 15px;">
                			<label class="form-label">
                				Provide Event Description
                			</label>
                			<textarea class="form-control ckeditor" name="description" rows="4"></textarea>
                		</div>
                		<div class="col-sm-6" style="margin-bottom: 15px;">
                			<label class="form-label">
                				Event Start Date and Date
                			</label>
                			<input class="form-control" type="text" id="start_date" name="start_date" />
                		</div>
                		<div class="col-sm-6" style="margin-bottom: 15px;">
                			<label class="form-label">
                				Event End Date and Date
                			</label>
                			<input class="form-control" type="text" id="end_date" name="end_date" />
                		</div>
                        <div class="col-sm-6" style="margin-bottom: 15px;">
                            <label class="form-label">
                                Event Type
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
                            <button class="btn btn-primary">Create</button>
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
        $('#start_date').datetimepicker({
            format: "Y-m-d H:i",
			onSelect: function (selected) {
				var dt = new Date(selected);
				dt.setDate(dt.getDate() + 1);
				$("#end_date").datepicker("option", "minDate", dt);
			}
        });
        $('#end_date').datetimepicker({
            format: "Y-m-d H:i",
			onSelect: function (selected) {
				var dt = new Date(selected);
				dt.setDate(dt.getDate() - 1);
				$("#start_date").datepicker("option", "maxDate", dt);
			}
        });
    })
</script>