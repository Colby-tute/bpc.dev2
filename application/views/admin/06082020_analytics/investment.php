<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?= $header; ?>
<div class="container">
	<div class="breadcrumb-header justify-content-between">
		<div>
			<h4 class="content-title mb-2">Investment Chart</h4>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= site_url('admin/home') ?>">Dashboard</a></li>
					<li class="breadcrumb-item active" aria-current="page">Investment Chart</li>
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
													<th>Role</th>
													<th>Uniqueid</th>
													<th>Name</th>
 													<th>Gender</th>											
													<th>Investment Need</th>
													<th>Revenue Raised</th>
													<th>Personal Funds</th>
													<th>Funding Gap</th>
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
													<td><?=$role; ?></td>
													<td><?=$users['tbl_users_user_uniqueid'] ; ?></td>
													<td><?=$users['tbl_users_firstname'] .' '. $users['tbl_users_lastname'] ; ?></td>
 													<td><?=$users['tbl_users_gender'] ; ?></td>
													<td><?=$users['investment_need'] ; ?></td>
													<td><?=$users['revenue_raised'] ; ?></td>
													<td><?=$users['personal_funds'] ; ?></td>
													<td><?=$users['funding_gap'] ; ?></td>
                                                   <td></td>
												</tr>
									<?php 
										}	
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
						<div class="main-content-label mg-b-5">
							Chart Options
						</div>
						<ul id="usersList">
							<li><a href="#">MSME</a>
								<ul>
								<?php 
								$_smmes = json_decode($smmes);
								foreach($_smmes as $smme) {
								?>
									<li onclick='loadChart("MSME", <?= $smme->user_id ?>, this)' class="smmeTreeMenu"><?= $smme->user_fname . ' ' . $smme->user_lname ?></li>
								<?php
								}
								?>
								</ul>
							</li>
						</ul>
					</div>
				</div>	
			</div>		
		<div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
			<div class="card">
				<div class="card-body">
					<div class="main-content-label mg-b-5" id="investmentTitle">
					</div>
					<div class="ht-200 ht-sm-300" id="investmentChart"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="row row-sm">
		<div class="col-xl-11 col-lg-11 col-md-11 col-sm-11">
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

<!-- treeview -->
<link href="../../assets/plugins/treeview/treeview-rtl.css" rel="stylesheet" type="text/css" />
<style type="text/css">
li:hover {
  color: blue;
}	
</style>>
<!-- Flot js -->
<script src="../../assets/plugins/jquery.flot/jquery.flot.js"></script>
<script src="../../assets/plugins/jquery.flot/jquery.flot.pie.js"></script>
<script src="../../assets/plugins/jquery.flot/jquery.flot.time.js"></script>
<script src="../../assets/plugins/jquery.flot/jquery.flot.resize.js"></script>	
<!-- Chart flot js -->
<script src="../../assets/js/chart.flot.js"></script>

<script src="../../assets/plugins/treeview/treeview.js"></script>

<script type="text/javascript">
$(document).ready(function () {
	$('#usersList').treed();
	smmes = document.getElementsByClassName("smmeTreeMenu");
	if(smmes.length) {
		smmes[0].click();
	}
});
var smmes = <?= $smmes ?>;

function loadChart(type, id, element) {	
    $.ajax({
        method: "post",
        url: '<?= base_url() ?>admin/analytics/getUserInvestmentReport',
        data: {
            'userId': id
        },
        success:function(data) {
			$('#investmentTitle').empty();
			$('#investmentTitle').append('Investment Chart for ' + element.innerHTML);
            updateChart(data);
        }
    });
}
function updateChart(investmentData) {
	investmentData = JSON.parse(investmentData);
	investmentData = investmentData[0];
	var chartData = [];
	for(var index in investmentData) {
		data = investmentData[index];
		if(index != 'investment_need') {
			chartData.push({
				label: index.replace("_", " "),
				data: [
					[1, data]
				],
				color: getRandomColor()
			});
		}
	}
	drawChart(chartData);
	drawTable(investmentData);
}

function getRandomColor() {
  var letters = '0123456789ABCDEF';
  var color = '#';
  for (var i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
  }
  return color;
}

function drawChart(chartData) {
	$.plot('#investmentChart', chartData, {
		series: {
			pie: {
				show: true,
				radius: 1,
				innerRadius: 0.5,
				label: {
					show: true,
					radius: 2 / 3,
					formatter: labelFormatter,
					threshold: 0.1
				}
			}
		},
		grid: {
			borderWidth: 1,
			borderColor: 'rgba(171, 167, 167,0.2)',
			hoverable: true
		}
	});
	function labelFormatter(label, series) {
		return '<div style="font-size:8pt; text-align:center; padding:2px; color:white;">' + label + '<br/>' + Math.round(series.percent) + '%</div>';
	}
}

function drawTable(data){
	console.log(data);
   var tableContent = "<table id='example' class='table key-buttons text-md-nowrap'>" + 
        '<thead>' +
            '<tr>' +
            '<th scope="col">#</th>' +
            '<th scope="col">Type</th>' + 
            '<th scope="col">Amount</th>' +
            '</tr>' +
        '</thead>' +
	    '<tbody>';
	var index = 1;
	for(var key in data) {
		amount = Math.round(data[key]);
    	tableContent +=	'<tr><td>' + index + '</td>' +
    		'<td style="text-transform: capitalize;">' + key.replace("_", " ") + '</td>' + 
    		'<td>' + amount + '</td></tr>';
    	index++;	
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
