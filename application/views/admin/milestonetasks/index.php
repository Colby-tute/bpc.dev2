<?php
?>
<?php echo $header ?>
<link href="<?php echo base_url(); ?>assets/css/timeline.min.css" rel="stylesheet">
<div class="container">

	<!-- breadcrumb -->
	<div class="breadcrumb-header justify-content-between">
		<div>
			<h4 class="content-title mb-2">Manage Milestone Tasks</h4>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= site_url('admin/home') ?>">Dashboard</a></li>
					<li class="breadcrumb-item active" aria-current="page">Operations</li>
					<li class="breadcrumb-item active" aria-current="page">Manage Milestone Tasks</li>
				</ol>
			</nav>
		</div>
		<div class="d-flex my-auto breadcrumb-right">
			<button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-envelope"></i></span> <span class="btn-text">Email</span></button> <button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-print"></i></span> <span class="btn-text">Print</span></button> <button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-download"></i></span> <span class="btn-text">Export</span></button>
		</div>
	</div>
	<!-- breadcrumb -->

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
									<div class="col-sm-12">
										<div class="table-responsive card-body">
											<table id="example" class="table key-buttons text-md-nowrap">
												<thead>
												<tr>
													<th scope="col">Task #</th>
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
	<!-- /row -->
</div>
<?php echo $footer ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 
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
	function completeMilestoneTask(task_id) {
		let url = window.location.href.split("/");
		let smmeId = <?= $smme_id ?>;	
		$.ajax({
			method: "post",
			url: '<?= base_url() ?>user/smme/MilestoneTasks/processMilestoneTasks/'+smmeId,
			data: {
				taskAction: "completeMilestoneTask",
				taskId: task_id
			},
            success:function(data) {
              loadMilestoneTasks();
            }
		})
	}
	function loadMilestoneTasks() {
		let url = window.location.href.split("/");
		let smmeId = <?= $smme_id ?>;
		$.ajax({
			method: "post",
			url: '<?= base_url() ?>user/smme/MilestoneTasks/processMilestoneTasks/'+smmeId,
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
								"<td class='task_target_date'>" + task['task_target_date'] + "</td>";
				if(task['task_status'] == "N") {
					tasksTable += "<td>" + 
									"<i class='fa fa-check' onclick='completeMilestoneTask("+task['id']+")' style='margin-left: 5px; cursor: pointer'></i>" +
								"</td>";
				} else if(task['task_status'] == "Y") {
					tasksTable += "<td>Completed</td>";
				} else {
					tasksTable += "<td>Error</td>";
				}
				tasksTable += "</tr>";
			}
			$('#tasks_tbody').empty();
			$('#tasks_tbody').append(tasksTable);
		} else {
			$('#tasks_tbody').empty();
			$('#tasks_tbody').append("<tr>No data to display!</tr>");			
		}
	}	
</script>