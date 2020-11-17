<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?= $header; ?>
<div class="container">
	<div class="breadcrumb-header justify-content-between">
		<div>
			<h4 class="content-title mb-2">Registration Chart</h4>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= site_url('admin/home') ?>">Dashboard</a></li>
					<li class="breadcrumb-item active" aria-current="page">Registration Chart</li>
				</ol>
			</nav>

		</div>
		<div class="my-auto breadcrumb-right">
			<button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-envelope mr-2"></i></span><span class="btn-text">Email </span></button>
			<button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-print mr-2"></i> </span><span class="btn-text">Print </span></button>
			<button class="btn btn-success ml-0"><span class="icon-label"><i class="fa fa-download"></i></span> <span class="btn-text">Export</span></button>
		</div>
	</div>
<!-------------- ---->

<div class="row-xs">
							<div class="card mg-b-20">
								 
								<div class="card-body">
 
 									<div class="table-responsive">

										<table id="example-kk" class="table key-buttons text-md-nowrap">
										<!-- <div id="date_filter" class="datePickerSelect col-sm-12 col-md-6">
 											    <span id="date-label-from" class="date-label">From: </span><input class="date_range_filter date" type="text" id="datepicker_from" />
											    <span id="date-label-to" class="date-label">To:<input class="date_range_filter date" type="text" id="datepicker_to" />
											 
											    <button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-paper-plane mr-2"></i></span><span class="btn-text">Submit </span></button>
											    <button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-envelope mr-2"></i></span><span class="btn-text">Email </span></button>
											 </div>  -->
											<thead>
												<tr>
													<th>Uniqueid</th>
													<th>Name</th>
													<th>Registration Date</th>
													<th>Mobile</th>
													<th>Gender</th>
													<th>Role</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
									<?php 
										$userData = json_decode($reportTabledata,true);
										foreach ($userData as $users) {	
										$role = $users['tbl_roles_title'];
										if($users['tbl_roles_title']=='SMME'){
											$role = 'MSME';
										}											
									 ?>  
									<tr>
										<td><?=$users['tbl_users_user_uniqueid'] ; ?></td>
										<td><?=$users['tbl_users_firstname'] .' '. $users['tbl_users_lastname'] ; ?></td>
										<td><?=$users['tbl_users_insertdate'] ; ?></td>
										<td><?=$users['tbl_users_mobile'] ; ?></td>
										<td><?=$users['tbl_users_gender'] ; ?></td>
										<td><?=$role; ?></td>
                                                                                <td></td>
									</tr>
									<?php }	?>
																						 
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
<!----- ------->




	<div class="row row-sm">
			<div class="row row-sm">
				<div class="card mg-b-20">
					<div class="card-body">
						<div class="main-content-label mg-b-5">
							Chart Options
						</div>
						<ul id="chartType" class="list-group">
							<li id="yearly" class="list-group-item" onclick="loadYearly(this)">Yearly</li>
							<li class="list-group-item" onclick="loadMonthly(this)">Monthly</li>
							<li class="list-group-item" onclick="loadWeeky(this)">Weekly</li>
						</ul>
					</div>
				</div>	
			</div>		
		<div class="col-xl-10 col-lg-10 col-md-10 col-sm-10">
			<div class="card">
				<div class="card-body">
					<div class="main-content-label mg-b-5">
						Registration
					</div>
					<p class="mg-b-20">Chart for site registration</p>
					<div class="ht-200 ht-sm-300" id="registrationChart"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="row row-sm">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
			<div class="card">
				<div class="card-body iconfont text-left">
					<div class="table-responsive">
						<div id="data_table">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>		
</div>
<?= $footer; ?>

<!-- Flot js -->
<script src="../../assets/plugins/jquery.flot/jquery.flot.js"></script>
<script src="../../assets/plugins/jquery.flot/jquery.flot.pie.js"></script>
<script src="../../assets/plugins/jquery.flot/jquery.flot.time.js"></script>
<script src="../../assets/plugins/jquery.flot/jquery.flot.resize.js"></script>	
<!-- Chart flot js -->
<script src="../../assets/js/chart.flot.js"></script>

<!-- Morris js -->
<script src="../../assets/plugins/raphael/raphael.min.js"></script>
<script src="../../assets/plugins/morris.js/morris.min.js"></script>
<script src="../../assets/js/chart.morris.js"></script>
 <script type="text/javascript">
$(document).ready(function () {
	document.getElementById('yearly').click();
});
var yearlyData = <?= $registrations_by_year ?>;
var monthlyData = <?= $registrations_by_month ?>;
var weeklyData = <?= $registrations_by_week ?>;

function loadYearly(ele) {
	toggle(ele);
	var yearlyDataByRoles = {};
	for(var index in yearlyData) {
		data = yearlyData[index];
		role = ""+data['role_id'];
		year= ""+data['registration_year'];
		count = ""+data['registration_count'];
		if(role in yearlyDataByRoles) {
			yearlyDataByRoles[role].push(new Array(year, count));
		} else {
			yearlyDataByRoles[role] = [];	
			yearlyDataByRoles[role].push(new Array(year, count));
		}
	}
	var bdsp = yearlyDataByRoles['4'];
	var incubators = yearlyDataByRoles['3'];
	var msmes = yearlyDataByRoles['2'];
	drawChart(bdsp, incubators, msmes, 2017, 2021);
	drawTable(yearlyData, "yearly");
}

function loadMonthly(ele) {
	toggle(ele);
	var monthlyDataByRoles = {};
	for(var index in monthlyData) {
		data = monthlyData[index];
		role = "" + data['role_id'];
		year= "" + data['registration_year'];
		month = "" + data['registration_month'];
		count = "" + data['registration_count'];
		if(role in monthlyDataByRoles) {
			monthlyDataByRoles[role].push(new Array(month, count));
		} else {
			monthlyDataByRoles[role] = [];	
			monthlyDataByRoles[role].push(new Array(month, count));
		}
	}
	var bdsp = monthlyDataByRoles['4'];
	var incubators = monthlyDataByRoles['3'];
	var msmes = monthlyDataByRoles['2'];
	drawChart(bdsp, incubators, msmes, 0, 12);
	drawTable(monthlyData, "monthly");
}

function loadWeeky(ele) {
	toggle(ele);
	var weeklyDataByRoles = {};
	for(var index in weeklyData) {
		data = weeklyData[index];
		role = "" + data['role_id'];
		year= "" + data['registration_year'];
		week = "" + data['registration_week'];
		count = "" + data['registration_count'];
		if(year == "2020") {
			if(role in weeklyDataByRoles) {
				weeklyDataByRoles[role].push(new Array(week, count));
			} else {
				weeklyDataByRoles[role] = [];	
				weeklyDataByRoles[role].push(new Array(week, count));
			}
		}
	}
	var bdsp = weeklyDataByRoles['4'];
	var incubators = weeklyDataByRoles['3'];
	var msmes = weeklyDataByRoles['2'];
	drawChart(bdsp, incubators, msmes, 0, 55);
	drawTable(weeklyData, "weekly");
}

function toggle(ele) {

    var liItems = ele.parentNode.getElementsByTagName("li");

    for (var i = 0, len = liItems.length; i < len; i++ ) {
        liItems[i].className = 'list-group-item';
    }
    ele.className = 'list-group-item active';
}

function drawChart(bdsp, incubators, msmes, minX, maxX) {
	var plot = $.plot($('#registrationChart'), [{
		data: bdsp,
		label: 'BDSP',
		color: '#007bff'
	},{
		data: incubators,
		label: 'Incubators',
		color: '#a47bff'
	},{
		data: msmes,
		label: 'MSME',
		color: '#cf7bff'
	}], {
		series: {
			lines: {
				show: true,
				lineWidth: 2	
			},
			shadowSize: 0
		},
		points: {
			show: true,
		},
		legend: {
			noColumns: 1,
			position: 'nw'
		},
		grid: {
			borderWidth: 1,
			borderColor: 'rgba(171, 167, 167,0.2)',
			hoverable: true
		},
		yaxis: {
			min: 0,
			max: 20,
			color: '#eee',
			tickColor: 'rgba(171, 167, 167,0.2)',
			font: {
				size: 10,
				color: '#999'
			}
		},
		xaxis: {
			min: minX,
			max: maxX,
			plotOffset: 1,	
			autoscaleMargin: 1,		
			color: '#eee',
			tickColor: 'rgba(171, 167, 167,0.2)',
			font: {
				size: 10,
				color: '#999'
			}
		}
	});	
}

function drawTable(data, type){
	var roles = ["", "", "MSME", "Incubators", "BDSP"]
   var tableContent = "<table id='example' class='table key-buttons text-md-nowrap'>" + 
        '<thead>' +
            '<tr>' +
            '<th scope="col">#</th>' +
            '<th scope="col">Year</th>';
    if(type == "monthly")
        tableContent += '<th scope="col">Month</th>';
    if(type == "weekly")
        tableContent += '<th scope="col">Week</th>';
    tableContent += "<th scope='col'>Role</th>" +
    				"<th scope='col'>Count</th>" +
            '</tr>' +
        '</thead>' +
	    '<tbody>';
	for(var index in data) {
		rowData = data[index];
    	tableContent +=	'<tr><td>'+(parseInt(index,10)+1)+'</td>' +
    		'<td>'+rowData['registration_year']+'</td>';
		if(type == "monthly")
    		tableContent += '<td>'+rowData['registration_month']+'</td>';
		if(type == "weekly")
    		tableContent += '<td>'+rowData['registration_week']+'</td>';
		tableContent += '<td>'+roles[parseInt(rowData['role_id'],10)]+'</td>' +
						'<td>'+rowData['registration_count']+'</td></tr>';
	}
    				'</tbody>' +
   					'</table>';
	$('#data_table').empty();
	$('#data_table').append(tableContent);
}


$(function(e) {
	var table = $('#example-kk').DataTable({
		buttons: [ 'excel','csv', 'pdf' ],
		responsive: true,
		pageLength: 5,
		lengthMenu: [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
		searching: false,
		language: {
			searchPlaceholder: 'Search...',
			sSearch: '',
			lengthMenu: '_MENU_ ',
		}
 	});
	table.buttons().container()
	.appendTo( '#example-kk_wrapper .col-md-6:eq(0)' );
	});
</script>
