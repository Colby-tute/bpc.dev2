<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?= $header; ?>
<div class="container">
	<div class="breadcrumb-header justify-content-between">
		<div>
			<h4 class="content-title mb-2">Login Activity</h4>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= site_url('admin/home') ?>">Dashboard</a></li>
					<li class="breadcrumb-item active" aria-current="page">Login Activity</li>
				</ol>
			</nav>

		</div>
		<div class="my-auto breadcrumb-right">
			<!-- <button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-envelope mr-2"></i></span><span class="btn-text">Email </span></button>
			<button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-print mr-2"></i> </span><span class="btn-text">Print </span></button>
			<button class="btn btn-success ml-0"><span class="icon-label"><i class="fa fa-download"></i></span> <span class="btn-text">Export</span></button> -->
			<form id="form-filter" class="form-horizontal">
			 	<div id="date_filter" class="datePickerSelect col-sm-12 col-md-12">
				   <!-- <span id="date-label-from" class="date-label">From: </span> -->
				   <input class="date_range_filter date" type="text" id="datepicker_from" placeholder="From Date" />
				    <!-- <span id="date-label-to" class="date-label">To:</span> -->
				    <input class="date_range_filter date" type="text" id="datepicker_to" placeholder="To Date" />
					 <div class="btn-icon-list">
						<button type="button" id="dateRangeSearch" class="btn btn-indigo btn-icon" title="Search"><i class="fas fa-search"></i></button>
						<button type="button" id="dateRangeReset" class="btn btn-indigo btn-icon" title="Reset"><i class="fas fa-sync-alt"></i></button>
					  </div> 
				</div>
			</form>
		</div>
	</div>

	<!-------------- ---->

<div class="row-xs">
							<div class="card mg-b-20">
								 
								<div class="card-body">
 
 									<div class="table-responsive">

<!-- <form id="form-filter" class="form-horizontal">
 	<div id="date_filter" class="datePickerSelect col-sm-12 col-md-6">
		    <span id="date-label-from" class="date-label">From: </span>
		    <input class="date_range_filter date" type="text" id="datepicker_from"/>
	    <span id="date-label-to" class="date-label">To:</span>
	    <input class="date_range_filter date" type="text" id="datepicker_to"/>
		 <div class="btn-icon-list">
			<button type="button" id="dateRangeSearch" class="btn btn-indigo btn-icon" title="Search"><i class="fas fa-search"></i></button>
			<button type="button" id="dateRangeReset" class="btn btn-indigo btn-icon" title="Reset"><i class="fas fa-sync-alt"></i></button>
		  </div> 
	</div>
</form> -->										
										<table id="example-kk" class="table key-buttons text-md-nowrap">
											 

											<thead>
												<tr>
													<th>Uniqueid</th>
													<th>Name</th>
													<th>Last Login Time</th>
													<th>Last login IP</th>
													<th>Last Login Country</th>
													<th>Status</th>											
													<th>Browser</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
									<?php 
									/*
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
													<td><?=$users['lastLoginTime'] ; ?></td>
													<td><?=$users['tbl_login_history_ip'] ; ?></td>
													<td><?=$users['tbl_login_history_country'] ; ?></td>
													<td><?=$users['loginStatus'] ; ?></td>
													<td><?=ucfirst(strtolower($users['browser'])) ; ?></td>
													<td></td>
												</tr>
									<?php 
										}	*/
									?>
																						 
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
                            <p><?php if ($this->session->flashdata('danger')) { ?>
                             <div id="infoMessage" class="alert alert-danger mt25"><?php echo $this->session->flashdata('danger');?></div>
                             <?php } else if ($this->session->flashdata('success')) { ?>
                             <div id="infoMessage" class="alert alert-success mt25"><?php echo $this->session->flashdata('success');?></div>
                             <?php }
                             ?>
                            </p>
						<div class="main-content-label mg-b-5">
							Chart Options
						</div>
						<ul id="chartType" class="list-group">
							<li id="results" class="list-group-item" onclick="loadResultsChart(this)">Login Results</li>
							<li class="list-group-item" onclick="loadBrowsersChart(this)">Browsers</li>
							<li class="list-group-item" onclick="loadCountriesChart(this)">Countries</li>
						</ul>
					</div>
				</div>	
			</div>		
		<div class="col-xl-10 col-lg-10 col-md-10 col-sm-10">
			<div class="card">
				<div class="card-body">
					<div class="main-content-label mg-b-5">
						Login Activity
					</div>
					<p class="mg-b-20">Chart for Login Activity</p>
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
<div class="modal" id="modaldemo2">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title">Error</h6><button aria-label="Close" class="close closePopup" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<p>Please choose From and To date range </p>
			</div>
			<div class="modal-footer justify-content-center">
				<button class="btn ripple btn-secondary closePopup" data-dismiss="modal" type="button">Close</button>
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
	document.getElementById('results').click();
});
var resultsData = <?= $results ?>;
var browserData = <?= $browsers ?>;
var countriesData = <?= $countries ?>;

function loadResultsChart(ele) {
	toggle(ele);
	var chartData = [];
	for(var index in resultsData) {
		data = resultsData[index];
		gender= ""+data['login_result'];
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
	drawTable(resultsData, "Login Results", "login_result");
}

function loadBrowsersChart(ele) {
	toggle(ele);
	var chartData = [];
	for(var index in browserData) {
		data =  browserData[index];
		age= ""+data['browser'];
		count = ""+data['count'];
		chartData.push({
			label: age,
			data: [
				[1, count]
			],
			color: getRandomColor()
		});
	}
	drawChart(chartData);
	drawTable(browserData, "Browsers", "browser");
}

function loadCountriesChart(ele) {
	toggle(ele);
	var chartData = [];
	for(var index in countriesData) {
		data = countriesData[index];
		district= ""+data['country'];
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
	drawTable(countriesData, "Countries", "country");
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
	for(var index in data) {
		rowData = data[index];
    	tableContent +=	'<tr>' +
    		'<td>'+(parseInt(index,10)+1)+'</td>' +
    		'<td>'+rowData[key]+'</td>' +
    		'<td>'+rowData['count']+'</td>'+
    		'</tr>';
	}
	tableContent +=	'</tbody>' +
				'</table>';
	$('#data_table').empty();
	$('#data_table').append(tableContent);
}

/* $(function(e) {
	var table = $('#example-kk').DataTable({ 
		buttons: [ 'excel','csv', 'pdf' ],
		responsive: true,
		pageLength: 5,
		lengthMenu: [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
		searching: true,
		language: {
			searchPlaceholder: 'Search...',
			sSearch: '',
			lengthMenu: '_MENU_ ',
		}
 	});
 
	table.buttons().container()
	.appendTo( '#example-kk_wrapper .col-md-6:eq(0)' );
	}); */

	$(function(e) {

			$('#dateRangeSearch').click(function(){	
				var fromdate = $('#datepicker_from').val();
				var todate   = $('#datepicker_to').val();
				if(fromdate.length>0 && todate.length>0){
					$('#example-kk').DataTable().destroy();
						fetch_data('yes', fromdate, todate);
				} else{
			 		$('#modaldemo2').show();
				}

			});

			fetch_data('no');
			function fetch_data(is_date_search, fromdate='', todate='') {
				 var table = $('#example-kk').DataTable({
				 	responsive: true,
					pageLength: 5,
					lengthMenu: [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
					dom: 'Blfrtip',
					buttons: [ 'excel','csv', 'pdf' ],
					searching: false,
					language: {
						searchPlaceholder: 'Search...',
						sSearch: '',
						lengthMenu: '_MENU_ ',
					},
				   "processing" : true,
				   "serverSide" : true,
				   "order" : [],
					   "ajax" : {
						    url:"<?php echo site_url('admin/Analytics/securityReportAjaxData')?>",
						    type:"POST",
						    data:{
						     	is_date_search:is_date_search, fromdate:fromdate, todate:todate
						    }
					   },				  
 				});
				 
			}

		$('.closePopup').click(function(){ $('#modaldemo2').hide(); })
		$('#dateRangeReset').click(function(){ //$('#form-filter')[0].reset(); 
			location.reload();
		})

		$("#datepicker_from").datepicker({
		    dateFormat: "yy-mm-dd",
		    minDate: null,
		    onSelect: function (date) {
		        var dt2 = $('#datepicker_to');
		        var startDate = $(this).datepicker('getDate');
		        var minDate = $(this).datepicker('getDate');
		        dt2.datepicker('setDate', minDate);
		        dt2.datepicker('option', 'minDate', minDate);
		        $(this).datepicker('option', 'minDate', minDate);
		    }
		});
		$('#datepicker_to').datepicker({
		    dateFormat: "yy-mm-dd"
		});
});
</script>
