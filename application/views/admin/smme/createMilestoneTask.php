<?php
?>
<?php echo $header ?>
<link href="<?php echo base_url(); ?>assets/css/jkanban.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/bootstrap-datepicker.min.css" rel="stylesheet">

<div class="container">
	<!-- Modal -->
	<div class="modal fade" id="editTaskModal" tabindex="-1" role="dialog" aria-labelledby="editTaskModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="editTaskModalLabel">Edit Milestone Task</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	        </button>
	      </div>
	      <form id="task-edit-form">
	      <div class="modal-body">
			<div class="col-sm-12">
				<input type="hidden" id="editTaskId" name="title" placeholder="Id" class="form-control task_id"/>
				<label>Task Name</label>
				<input type="text" id="editTaskName" name="title" placeholder="Task Name" class="form-control task_name"/>
			</div><br />
			<div class="col-sm-12">
				<label>Task Description</label>
				<input type="text" id="editTaskDesc" name="taskDesc" placeholder="Task Description" class="form-control task_description"/>
			</div><br />
			<div class="col-sm-12">
				<label>Task Target Date</label>
				<input type="text" id="editTaskEndDate" name="end_date" placeholder="Task End date"
					   class="form-control datepicker task_target_date"/>
			</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" id="submit_task_edit" onclick="editMilestoneTask()"  class="btn btn-primary submit_task_edit">Save changes</button>
	      </div>
	      </form>
	    </div>
	  </div>
	</div>	
	<div class="breadcrumb-header justify-content-between">
		<div>
			<h4 class="content-title mb-2">BBM Milestone Tasks	</h4>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= site_url('admin/home') ?>">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="<?= site_url('admin/Operations') ?>">MSME Management</a></li>
					<li class="breadcrumb-item active" aria-current="page"><?= $smme->tbl_users_firstname ?> <?= $smme->tbl_users_lastname ?> / MSME-<?= $smme->tbl_users_user_uniqueid ?></li>
				</ol>
			</nav>
		</div>
		
		
		<div class="my-auto breadcrumb-right">
							<a href="<?= site_url('admin/smme/Application') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-bell mr-2"></i></span><span class="btn-text">Status </span></button></a>
							<a href="<?= site_url('admin/smme/Application/add') ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-check-square mr-2"></i> </span><span class="btn-text">Add New Application </span></button></a>
							<button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-question-circle mr-2"></i> </span><span class="btn-text">Help </span></button>
						</div>

		
		
		
		
		
		
	</div>
	<div class="row row-sm">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					<div class="border">
						<div class="bg-gray-300 nav-bg">
							<nav class="nav nav-tabs">
	                            <?php 
	                            foreach($phases as $key => $phase) : 
	                            	$activeTab = "";
	                            	if($key == 0)
	                            		$activeTab = " active";
	                            	?>	                            	
	                            	<a class="nav-link<?= $activeTab ?>" data-toggle="tab" onclick="selectPhase(<?= $phase->id ?>);"><?= $phase->phase ?></a>
	                            <?php endforeach; ?>
							</nav>
						</div>
						<div class="bg-gray-300 nav-bg">
							<nav class="nav nav-tabs">
                            <?php foreach($subphases as $key => $subphase) : 
                            	$activeTab = "";
                            	if($key == 0)
                            		$activeTab = " active";
                            	?>
                            	<a class="nav-link<?= $activeTab ?>" data-toggle="tab" onclick="selectSubPhase(<?= $subphase->id ?>);"><?= $subphase->phase ?></a>
                            <?php endforeach; ?>
							</nav>
						</div>
						<div class="card-body tab-content">
							<div class="tab-pane active show" id="tabCont">
								<div class="row">
									<div class="col-sm-3">
										<label>Task Name</label>
										<input type="text" id="taskName" name="title" placeholder="Task Name" class="form-control"/>
									</div>
									<div class="col-sm-3">
										<label>Task Description</label>
										<input type="text" id="taskDesc" name="taskDesc" placeholder="Task Description" class="form-control"/>
									</div>
									<div class="col-sm-3">
										<label>Task Target Date</label>
										<input type="text" id="taskEndDate" name="end_date" placeholder="Task End date"
											   class="form-control datepicker"/>
									</div>
									<div class="col-sm-12 mg-t-15">
										<button class="btn btn-primary" onclick="createMilestoneTask()" id="create">Create</button>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="table-responsive card-body">
											<table id="example" class="table key-buttons text-md-nowrap">
												<thead>
												<tr>
													<th scope="col">PID</th>
													<th scope="col">Task Name</th>
													<th scope="col">Task Description</th>
													<th scope="col">Task Target Date</th>
													<th scope="col">Actions</th>
												</tr>
												</thead>
												<tbody id="tasks_tbody">
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php echo $footer ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
	$(function () {

		$(".datepicker").datepicker({
			format: "yyyy-mm-dd"
		})
	})
$('#editTaskModal').on('show.bs.modal', function (e) {
	if (e.namespace === 'bs.modal') {
	    var edit_button = $(e.relatedTarget);
	    var task_row = edit_button.parents("tr");
	    var task_id = task_row.find(".task_id").val();
	    var task_name = task_row.find(".task_name").text();
	    var task_description = task_row.find(".task_description").text();
	    var task_target_date = task_row.find(".task_target_date").text();
	    $(this).find(".task_id").val(task_id);
	    $(this).find(".task_name").val(task_name);
	    $(this).find(".task_description").val(task_description);
	    $(this).find(".task_target_date").val(task_target_date);
    }
});
</script>  
<script type="text/javascript">
	var phase = 1;
	var subPhase = 1;
	$(document).ready(function () {
		loadMilestoneTasks();
	});
	function selectPhase(phaseId)
	{
		phase = phaseId;
		loadMilestoneTasks();
	}
	function selectSubPhase(subphaseId)
	{
		subPhase = subphaseId;
		loadMilestoneTasks();
	}
	function createMilestoneTask() {
		let name = $("#taskName").val();
		let desc = $("#taskDesc").val();
		let endDate = $("#taskEndDate").val();
		let url = window.location.href.split("/");
		let smmeId = url[url.length - 1];
		if(name == "" || desc == "" || endDate == "" || smmeId == "") {
			alert("Please enter valid inputs!")
		} else {
			$.ajax({
				method: "post",
				url: '<?= base_url() ?>admin/Smme/processMilestoneTasks/'+smmeId,
				data: {
					taskAction: "createMilestoneTask",
					taskName: name,
					taskDesc: desc,
					taskEndDate: endDate,
					phaseId: phase,
					subPhaseId: subPhase,
					smmeId: smmeId
				},
		        success:function(data) {
		          loadMilestoneTasks();
		          $("#taskName").val('');
		          $("#taskDesc").val('');
		          $("#taskEndDate").val('');
		        }
			})
		}
	}
	function deleteMilestoneTask(task_id) {
		let url = window.location.href.split("/");
		let smmeId = url[url.length - 1];		
		$.ajax({
			method: "post",
			url: '<?= base_url() ?>admin/Smme/processMilestoneTasks/'+smmeId,
			data: {
				taskAction: "deleteMilestoneTask",
				taskId: task_id
			},
            success:function(data) {
              loadMilestoneTasks();
            }
		})
	}
	function loadMilestoneTasks() {
		let text = $("#question_textarea").val();
		let url = window.location.href.split("/");
		let smmeId = url[url.length - 1];
		$.ajax({
			method: "post",
			url: '<?= base_url() ?>admin/Smme/processMilestoneTasks/'+smmeId,
			data: {
				taskAction: "getMilestoneTasks",
				phaseId: phase,
				subPhaseId: subPhase,
				smmeId: smmeId
			},
            success:function(data) {
            	updateMilestoneTasksTable(data);
            }
		})
	}
	function editMilestoneTask() {
		let taskId = $("#editTaskId").val();
		let taskName = $("#editTaskName").val();
		let taskDesc = $("#editTaskDesc").val();
		let taskTargetDate = $("#ediTaskEndDate").val();;
		let url = window.location.href.split("/");
		let smmeId = url[url.length - 1];		
		$.ajax({
			method: "post",
			url: '<?= base_url() ?>admin/Smme/processMilestoneTasks/'+smmeId,
			data: {
				taskAction: "editMilestoneTask",
				taskId: taskId,
				taskName: taskName,
				taskDesc: taskDesc,
				taskTargetDate: taskTargetDate
			},
            success:function(data) {
              loadMilestoneTasks();
              $('#editTaskModal').hide();
              $('.modal-backdrop').remove();
            }
		})
	}	

	function updateMilestoneTasksTable(tasksData) {
		var tasks = JSON.parse(tasksData)["tasks"];
		tasksTable = "";
		if(tasks.length) {
			for(var tasksIdx = 0; tasksIdx < tasks.length; tasksIdx++) {
	    		var task = tasks[tasksIdx];
				tasksTable += "<tr>" + 
                                "<td> <span>" + (tasksIdx+1) + "</span>" +
                                    "<input type='hidden' class='task_id' value=" + task['id'] + " /></td>" +
								"<td class='task_name'>" + task['task_name'] + "</td>"  +
								"<td class='task_description'>" + task['task_description'] + "</td>" +
								"<td class='task_target_date'>" + task['task_target_date'] + "</td>" +
								"<td>" + 
									"<i class='fa fa-edit'  data-toggle='modal' data-target='#editTaskModal'  style='cursor: pointer'></i>" +
									"<i class='fa fa-trash' onclick='deleteMilestoneTask("+task['id']+")' style='margin-left: 5px; cursor: pointer'></i>" +
								"</td>" + 
							"</tr>";
			}
			$('#tasks_tbody').empty();
			$('#tasks_tbody').append(tasksTable);
		} else {
			$('#tasks_tbody').empty();
			$('#tasks_tbody').append("<tr>No data to display!</tr>");			
		}
	}
</script>
