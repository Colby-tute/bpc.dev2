<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?= $header; ?>
<div class="container">
	<div class="breadcrumb-header justify-content-between">
		<div>
			<h4 class="content-title mb-2">Data & Demographics</h4>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= site_url('bdsp/home') ?>">Dashboard</a></li>
					<li class="breadcrumb-item active" aria-current="page">Demographics Chart</li>
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
											<thead>
												<tr>
													<th>Uniqueid</th>
													<th>Name</th>
													<th>Registration Date</th>
													<th>Age</th>
													<th>Gender</th>
													<th>District</th>
													<th>Town/Village</th>
													<th>Mobile</th>
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
										<td><?=$users['age'] ; ?></td>
										<td><?=$users['tbl_users_gender'] ; ?></td>
										<td><?=$users['tbl_personal_details_district'] ; ?></td>
										<td><?=$users['tbl_personal_details_town_village'] ; ?></td>
										<td><?=$users['tbl_users_mobile'] ; ?></td>
										<td><?=$role; ?></td>
										<td></td>
									</tr>
									<?php 	}	?>
																						 
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
							<li id="gender" class="list-group-item" onclick="loadGenderChart(this)">Gender</li>
							<li class="list-group-item" onclick="loadAgeChart(this)">Age</li>
							<li class="list-group-item" onclick="loadDistrictChart(this)">District</li>
							<li class="list-group-item" onclick="loadTownVillageChart(this)">Town/Village</li>
						</ul>
					</div>
				</div>	
			</div>		
		<div class="col-xl-10 col-lg-10 col-md-10 col-sm-10">
			<div class="card">
				<div class="card-body">
					<div class="main-content-label mg-b-5">
						Demographics
					</div>
					<p class="mg-b-20">Chart for demographics</p>
					<div class="ht-200 ht-sm-300" id="demographicsChart"></div>
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


<script type="text/javascript">
$(document).ready(function () {
	document.getElementById('gender').click();
});
var genderData = <?= $gender ?>;
var ageData = <?= $age ?>;
var districtData = <?= $district ?>;
var townVillageData = <?= $town_village ?>;

function loadGenderChart(ele) {
	toggle(ele);
	var chartData = [];
	for(var index in genderData) {
		data = genderData[index];
		gender= ""+data['gender'];
		count = ""+data['count'];
		chartData.push({
			label: gender,
			data: [
				[1, count]
			],
			color: getRandomColor()
		});
	}
	drawChart(chartData);
	drawTable(genderData, "Gender", "gender");
}

function loadAgeChart(ele) {
	toggle(ele);
	var chartData = [];
	var ageGroupData = {};
	for(var index in ageData) {
		data =  ageData[index];
		age= data['age'];
		count = data['count'];
		if(age >= 0 && age <= 18) {
			if(ageGroupData.hasOwnProperty("0 - 18")) {
				ageGroupData["0 - 18"] += count; 
			} else {
				ageGroupData["0 - 18"] = count;
			}
		} else 	if(age >= 18 && age <= 25) {
			if(ageGroupData.hasOwnProperty("18 - 25")) {
				ageGroupData["18 - 25"] += count; 
			} else {
				ageGroupData["18 - 25"] = count;
			}
		}
		else if(age >= 26 && age <= 35) {
			if(ageGroupData.hasOwnProperty("26 - 35")) {
				ageGroupData["26 - 35"] += count; 
			} else {
				ageGroupData["26 - 35"] = count;
			}			
		}
		else if(age >= 36 && age <= 45) {
			if(ageGroupData.hasOwnProperty("36 - 45")) {
				ageGroupData["36 - 45"] += count; 
			} else {
				ageGroupData["36 - 45"] = count;
			}			
		}
		else if(age >= 46 && age <= 60) {
			if(ageGroupData.hasOwnProperty("46 - 60")) {
				ageGroupData["46 - 60"] += count; 
			} else {
				ageGroupData["46 - 60"] = count;
			}			
		}
		else if(age >= 61) {
			if(ageGroupData.hasOwnProperty("> 60")) {
				ageGroupData["> 60"] += count; 
			} else {
				ageGroupData["> 60"] = count;
			}			
		}

	}
	for(var index in ageGroupData) {
		data =  ageGroupData[index];
		chartData.push({
			label: index,
			data: [
				[1, data]
			],
			color: getRandomColor()
		});
	}
	/*
	for(var index in ageData) {
		data =  ageData[index];
		age= ""+data['age'];
		count = ""+data['count'];
		chartData.push({
			label: age,
			data: [
				[1, count]
			],
			color: getRandomColor()
		});
	}
	*/
	drawChart(chartData);
	drawTable(ageGroupData, "Age Range", "age");
}

function loadDistrictChart(ele) {
	toggle(ele);
	var chartData = [];
	for(var index in districtData) {
		data = districtData[index];
		district= ""+data['district'];
		count = ""+data['count'];
		chartData.push({
			label: district,
			data: [
				[1, count]
			],
			color: getRandomColor()
		});
	}
	drawChart(chartData);
	drawTable(districtData, "District", "district");
}


function loadTownVillageChart(ele) {
	toggle(ele);
	var chartData = [];
	for(var index in townVillageData) {
		data = townVillageData[index];
		townVillage= ""+data['town_village'];
		count = ""+data['count'];
		chartData.push({
			label: townVillage,
			data: [
				[1, count]
			],
			color: getRandomColor()
		});
	}
	drawChart(chartData);
	drawTable(townVillageData, "Town/Village", "town_village");
}

function getRandomColor() {
  var letters = '0123456789ABCDEF';
  var color = '#';
  for (var i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
  }
  return color;
}

function toggle(ele) {

    var liItems = ele.parentNode.getElementsByTagName("li");

    for (var i = 0, len = liItems.length; i < len; i++ ) {
        liItems[i].className = 'list-group-item';
    }
    ele.className = 'list-group-item active';
}

function drawChart(chartData) {
	$.plot('#demographicsChart', chartData, {
		series: {
			pie: {
				show: true,
				radius: 1,
				label: {
					show: true,
					radius: 2 / 3,
					formatter: labelFormatter,
					threshold: 0.1
				}
			}
		},
		grid: {
			hoverable: true,
			clickable: true
		}
	});
	function labelFormatter(label, series) {
		return '<div style="font-size:8pt; text-align:center; padding:2px; color:white;">' + label + '<br/>' + Math.round(series.percent) + '%</div>';
	}
}

function drawTable(data, type, key){
   var tableContent = "<table id='example' class='table key-buttons text-md-nowrap'>" + 
        '<thead>' +
            '<tr>' +
            '<th scope="col">#</th>' +
            '<th scope="col">'+type+'</th>' +
    		'<th scope="col">Count</th>' +
            '</tr>' +
        '</thead>' +
	    '<tbody>';
	var i = 1;
	for(var index in data) {
		rowData = data[index];
    	tableContent +=	'<tr>';
    	if(key == 'age') {
    		tableContent +=	'<td>' + i + '</td>' +
    			'<td>' + index + '</td>' +
	    		'<td>'+rowData + '</td>'+
	    		'</tr>';
	    		i++;
    	} else  {
    		tableContent +=	'<td>' + (parseInt(index,10) + 1) + '</td>' + 
    			'<td>' + rowData[key] + '</td>' +
	    		'<td>' + rowData['count'] + '</td>'+
	    		'</tr>';
    	}
	}
	tableContent +=	'</tbody>' +
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
